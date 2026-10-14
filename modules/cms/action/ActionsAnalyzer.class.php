<?php

namespace cms\action;

header('Content-Type: text/plain');

/**
 * Using the Component classes and generating a XSD-File.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use cms\base\Startup;

Startup::initialize();

use ReflectionNamedType;
use ReflectionUnionType;
use util\FileUtils;
use util\json\JSON;
use util\Session;
use util\YAML;
use cms\action\UiInClass;

class ActionsAnalyzer
{
	private $paths = [];

	public function __construct()
	{
		foreach( FileUtils::readDir(__DIR__) as $file ) {
			if   ( substr($file, -16, 16) == 'Action.class.php' ) {
				$this->analyzeAction($file);
			}
		}

		$this->createOpenAPISpecification();
	}


	private function analyzeAction($file)
	{
		$actionName = strtolower(substr($file, 0, strlen($file)-16));
		$actionClassName = substr($file, 0, strlen($file)-10);
		$actionClass = new \ReflectionClass('cms\action\\'.$actionClassName);
		if   ( $actionClass->isAbstract() ) {
			echo("Action class $actionName is abstract\n");
			return;
		}
		echo("Analyzing $actionName ...\n");
		$this->analyzeMethod($actionName);
	}


	private function analyzeMethod($action)
	{

		if   ( ! is_dir(__DIR__.'/'.$action.'/'))
			return;
		foreach( FileUtils::readDir(__DIR__.'/'.$action.'/') as $file ) {
			if   ( substr($file, -16, 16) == 'Action.class.php' ) {
				$actionName = strtolower(substr($file, strlen($action), strlen($file)-16-strlen($action)));
				$actionClassName = substr($file, 0, strlen($file)-10);

				echo("Analyzing $action => $file ...\n");
				$actionClass = new \ReflectionClass('cms\action\\'.$action.'\\'.$actionClassName);

				$viewMethod = $actionClass->getMethod('view');
				$attrs = $viewMethod->getAttributes(UiOutClass::class);
				if   ( sizeof($attrs)>0) {

					$viewOut = [
						'$ref'=>'#/components/schemas/'.substr(strrchr($attrs[0]->newInstance()->className, '\\'), 1)
						];
				}else{
					$viewOut = [
						'type'                 => 'object',
						'additionalProperties' => true,
					];
				}


				$postMethod = $actionClass->getMethod('post');
				$attrs = $postMethod->getAttributes(UiInClass::class);
				if   ( sizeof($attrs)>0) {

					$attrs[0]->newInstance();
					$postIn = [
						'$ref'=>'#/components/schemas/'.substr(strrchr($attrs[0]->newInstance()->className, '\\'), 1)
					];
				}else{
					$postIn = [
						'type'                 => 'object',
						'additionalProperties' => true,
					];
				}
				//if   ( !$actionClass->hasMethod('view') )
				//	throw new ClientException("no method view in $action => $file ...");
				$this->paths['/'.$action.'/{id}/'.$actionName] = [
					'summary' => $this->getSummary($actionClass->getDocComment()),
					'get'  => [
						'responses'=>[
							'2XX'=>[
								'description'=> $this->clearDocComment($viewMethod->getDocComment()),
								'content'=>['application/json'=>[
									'schema'=>$viewOut
									,
								]],
							],
							'default'=>[
								'description'=> 'Client error',
								'content'=>['application/json'=>[
									'schema'=>['$ref'=>"#/components/schemas/APIResponse"],
								]],
							],
						],
						'operationId'=>'get'.ucfirst($action).ucfirst($actionName),
						#'summary'    =>$this->getSummary    ($actionClass->getMethod('view')->getDocComment()),
						'description'=>$this->clearDocComment($viewMethod->getDocComment()),
						'parameters' =>$this->getParameters ($viewMethod),
						'tags'       =>[ucfirst($action)],

					],
					'post' => [
						'requestBody' => [
							'description' => '',
							'required'    => true, // Gibt an, ob der Body zwingend mitgeschickt werden muss
							'content'     => [
								'application/json' => [
									'schema' => $postIn
								]
							]
						],
						'responses'=>[
							'default'=>[
								'description'=> 'API response',
								'content'=>['application/json'=>[
									'schema'=>['$ref'=>"#/components/schemas/APIResponse"]
								]
								]
							],
						],
						'operationId'=>'save'.ucfirst($action).ucfirst($actionName),
						'summary'    =>$this->getSummary    ($postMethod->getDocComment()),
						'description'=>$this->getDescription($postMethod->getDocComment()),
						'parameters' =>$this->getParameters ($postMethod),
						'tags'       =>[ucfirst($action)],
					]
				];
			}
		}

	}



	private function analyzeComponents(): array
	{
		$schemas = [];

		if   ( ! is_dir(__DIR__.'/../api/'))
			return [];
		foreach( FileUtils::readDir(__DIR__.'/../api/') as $file ) {
			if   ( substr($file, -10, 10) == '.class.php' ) {
				$schema = [];
				$schema['type'] = 'object';
				$properties = [];
				$className = substr($file, 0, strlen($file)-10);

				echo("Analyzing component in $file ...\n");
				$class = new \ReflectionClass('cms\api\\'.$className);
				$schema['description'] = $this->clearDocComment($class->getDocComment());

				foreach( $class->getProperties() as $property ) {
					$name = $property->getName();
					// 1. Prüfen, ob überhaupt ein Typ deklariert ist (z.B. public $data; hat keinen)
					if (!$property->hasType()) {
						$properties[$name] = ['type' => 'string', 'description' => 'Untyped property']; // Fallback
					}
					else{

						// 2. Umgang mit Union Types (z.B. string|int) – OpenAPI nutzt hier meist 'oneOf'
						$type = $property->getType();
						if ($type instanceof ReflectionUnionType) {
							$subTypes = [];
							foreach ($type->getTypes() as $subType) {
								$subTypes[] = $this->mapSingleType($subType);
							}
							$properties[$name] = ['oneOf' => $subTypes] + ['description' => $this->clearDocComment($property->getDocComment())];
						}
						// 3. Normaler, einzelner Typ (ReflectionNamedType)
						elseif ($type instanceof ReflectionNamedType) {
							$properties[$name] = $this->mapSingleType($type) + ['description' => $this->clearDocComment($property->getDocComment()) ];
						}
					}

				}
				$schema['properties'] = $properties;


				$schemas[$className] = $schema;
			}
		}
		return $schemas;

	}


	private function createOpenAPISpecification()
	{
		$spec = [
			"openapi" => "3.1.0",
			'info' => $this->getInfo(),
			'webhooks' => $this->getWebhooks(),
			'servers'=> $this->getServers(),
			'paths'=>$this->paths,
			'components'=> [
				'securitySchemes'=> $this->getSecuritySchemes(),
				'schemas'=>$this->analyzeComponents(),
			],
			'security'=>[array_map( function () {return [];},$this->getSecuritySchemes() )],
		];

		$openapiYamlFile = @fopen(__DIR__ . '/../../../openapi.yaml', 'w');
		fwrite($openapiYamlFile, "# OpenAPI specification\n".YAML::dump($spec));
		$openapiJsonFile = @fopen(__DIR__ . '/../../../openapi.json', 'w');
		fwrite($openapiJsonFile, JSON::encode($spec));
	}




	private function getSummary( $docComment )
	{
		$docComment = ltrim($docComment,'/* ');
		$docComment = str_replace(["\n","*"],['',''],$docComment);
		$posFirstAt = strpos($docComment,'@');
		if   ( $posFirstAt )
			$docComment = substr($docComment,0,$posFirstAt-1);
		$posFirstDot = strpos($docComment,'.');
		if   ( $posFirstDot )
			$docComment = substr($docComment,0,$posFirstDot);
		return trim($docComment);
	}

	private function getDescription( $docComment )
	{
		$docComment = ltrim($docComment,'/* ');
		$docComment = str_replace(["\n","*"],['',''],$docComment);
		$posFirstAt = strpos($docComment,'@');
		if   ( $posFirstAt )
			$docComment = substr($docComment,0,$posFirstAt-1);
		return trim($docComment);
	}

	private function getParameters( \ReflectionMethod $method ): array
	{
		$docComment = $method->getDocComment();

		$params = [ 0=>[
			'in'=>'path',
			'name'=>'id',
			'schema'=>['type'=>'integer'],
			'required'=>true,
			'description'=>'ID',
			]
		];
		while(true) {
			$posApi = strpos($docComment,'@api');
			if   ( $posApi ) {
				$posEndApi = strpos($docComment,'@',$posApi+1);
				$paramDef = substr($docComment,$posApi+4,$posEndApi-$posApi-4);
				$paramParts = explode('|',$paramDef );
				$params[] = [
					'in'  =>'query',
					'name'=>str_replace('*','',@$paramParts[0]),
					'schema'=>['type'=>@$paramParts[1]],
					'required'=>strpos($paramParts[0],'*')!==false,
					'description'=>trim(@$paramParts[2],"\n\r\t\v\0*/"),
				];
				$docComment = substr($docComment,$posEndApi-1);
			}
			else
				break;
		}


		$attrs = $method->getAttributes(UiInParameter::class);
		/** @var \ReflectionAttribute $attr */
		foreach ($attrs as $attr) {

			$params[] = [
				'in' => 'query',
				'name' => $attr->newInstance()->name,
				'schema' => ['type' => 'string'],
				'required' => true,
				#'description' => '',
			];

		}
		return $params;
	}


	function mapSingleType(ReflectionNamedType $namedType): array
	{
		$typeName = $namedType->getName();
		$isNullable = $namedType->allowsNull();

		// Mapping von PHP-Typen auf OpenAPI-Standardtypen
		$mapping = [
			'int'    => 'integer',
			'float'  => 'number',
			'string' => 'string',
			'bool'   => 'boolean',
			'array'  => 'array',
			'mixed'  => 'string', // mixed wird im klassischen OpenAPI oft als string oder ohne typ deklariert
		];

		// Wenn es ein primitiver PHP-Typ ist
		if (isset($mapping[$typeName])) {
			$result = ['type' => $mapping[$typeName]];

			// Für Listen (Arrays) musst du im Generator später oft noch die 'items' bestimmen
			if ($typeName === 'array') {
				$result['items'] = ['type' => 'string']; // Standard-Fallback oder via DocBlock auflösen
			}

			if ($isNullable) {
				$result['nullable'] = true; // Gültig für OpenAPI 3.0
			}
			return $result;
		}

		// Wenn der Typ kein primitiver Typ ist, ist es eine Klasse/ein Objekt
		// Hier erzeugst du die Referenz auf deine Components
		if (class_exists($typeName)) {
			// Bereinigt den Namespace für OpenAPI (z.B. App\DTO\User -> App.DTO.User)
			$componentName = str_replace('\\', '.', $typeName);

			if ($isNullable) {
				// Da $ref keine Geschwister-Keys (wie nullable) haben darf, verpacken wir es in allOf
				return [
					'nullable' => true,
					'allOf' => [
						['$ref' => "#/components/schemas/{$componentName}"]
					]
				];
			}

			return ['$ref' => "#/components/schemas/{$componentName}"];
		}

		return ['type' => 'object'];
	}

	private function getInfo():array
	{
		return
		[
			'title' => 'OpenRat Content Management System API',
			'description' => 'OpenRat Content Management System',
			'version' => '2.0.0',
			'license' => [
				'name'=>'GPL v3',
				'url' => 'https://www.gnu.org/licenses/gpl-3.0.de.html',
			],
			'contact' => [
				'email' => 'kontakt-website@openrat.de',
				'name'  => 'OpenRat CMS API support',
			],
		];
	}

	private function getSecuritySchemes():array
	{
		return [
			'BasicAuth'=>[
				'type'  =>'http',
				'scheme'=>'basic',
			],
			'BearerAuth'=>[
				'type'  =>'http',
				'scheme'=>'bearer',
			],
			'ApiKeyAuth'=>[
				'type'=>'apiKey',
				'in'  =>'header',
				'name'=>'X-API-Key',
			],
			'TokenAuth'=>[
				'type'=>'http',
				'scheme' =>'token',
			],
		];
	}

	private function getServers():array
	{
		return
			[
				['url'=> '//demo.openrat.de'    ,'description'=>'OpenRat Demo'],
				['url'=> '//localhost:8000/rest','description'=>'OpenRat local development'],
				['url'=> '//localhost:8090'     ,'description'=>'OpenRat local development'],
			];
	}


	function clearDocComment(string|bool $comment):string {

		if   ( !$comment ) return '';

		$comment = str_replace('/*','',$comment);
		$comment = str_replace('*/','',$comment);
		$comment = str_replace('*','',$comment);
		$comment = str_replace("\n",' ',$comment);

		$idx = strpos($comment,'@');
		if   ( $idx !== false )
			$comment = substr( $comment,0,$idx-1);

		return trim($comment);
	}

	private function getWebhooks(): array
	{
		return [
			'userCreated' => [ // Der Name des Events / Webhooks
				'post' => [
					'summary' => 'Wird ausgelöst, wenn ein neuer Benutzer registriert wird',
					'description' => 'Dein Server sendet dieses Event an die konfigurierte Webhook-URL des Clients.',

					// Hier definierst du, was dein System an den Client SENDET
					'requestBody' => [
						'required' => true,
						'content' => [
							'application/json' => [
								'schema' => [
									// HIER verweist du ganz normal auf deine Component!
									'$ref' => '#/components/schemas/Event'
								]
							]
						]
					],

					// Hier definierst du, welche Antwort dein System vom Client ERWARTET
					'responses' => [
						'200' => [
							'description' => 'Client hat das Event erfolgreich verarbeitet und bestätigt.'
						]
					]
				]
			]
		];
	}

}
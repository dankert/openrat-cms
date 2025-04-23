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

use util\FileUtils;
use util\json\JSON;
use util\Session;
use util\YAML;

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

				//if   ( !$actionClass->hasMethod('view') )
				//	throw new ClientException("no method view in $action => $file ...");
				$this->paths['/'.$action.'/{id}/'.$actionName] = [
					'summary' => $this->getSummary($actionClass->getDocComment()),
					'get'  => [
						'responses'=>[
							'200'=>[
								'description'=> 'API response',
								'content'=>['application/json'=>[
									'schema'=>['$ref'=>"#/components/schemas/APIResponse"],
								]],
							],
						],
						'operationId'=>'get'.ucfirst($action).ucfirst($actionName),
						'summary'    =>$this->getSummary    ($actionClass->getMethod('view')->getDocComment()),
						'description'=>$this->getDescription($actionClass->getMethod('view')->getDocComment()),
						'parameters' =>$this->getParameters ($actionClass->getMethod('view')->getDocComment()),
						'tags'       =>[ucfirst($action)],

					],
					'post' => [
						'responses'=>[
							'200'=>[
								'description'=> 'API response',
								'content'=>['application/json'=>[
									'schema'=>['$ref'=>"#/components/schemas/APIResponse"]
								]
								]
							],
						],
						'operationId'=>'save'.ucfirst($action).ucfirst($actionName),
						'summary'    =>$this->getSummary    ($actionClass->getMethod('post')->getDocComment()),
						'description'=>$this->getDescription($actionClass->getMethod('post')->getDocComment()),
						'parameters' =>$this->getParameters ($actionClass->getMethod('post')->getDocComment()),
						'tags'       =>[ucfirst($action)],
					]
				];
			}
		}

	}


	private function createOpenAPISpecification()
	{
		$spec = [
			"openapi" => "3.1.0",
			'info' => [
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
				],
			'servers'=>[
				['url'=> '//demo.openrat.de','description'=>'OpenRat Demo'],
				['url'=> '//localhost:8000/rest','description'=>'OpenRat local development'],
			],
			'paths'=>$this->paths,
			'components'=> [
				'securitySchemes'=>[
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
				],
				'schemas'=>[
					'APIResponse'=>[
						'type'=>'object',
						'properties'=>[
							'output'        => ['type'=>'object'],
							'notices'       => ['type'=>'array'],
							'errors'        => ['type'=>'array'],
							'status'        => ['type'=>'string'],
							'notice_status' => ['type'=>'string'],
							'success'       => ['type'=>'boolean'],
							'session'       => ['type'=>'object'],
							'version'       => ['type'=>'string'],
							'api'           => ['type'=>'integer'],
						]
					]
				]
			],
			'security'=>[
				['BasicAuth' =>[]],
				['BearerAuth'=>[]],
				['ApiKeyAuth'=>[]],
			],
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

	private function getParameters( $docComment )
	{
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
		return $params;
	}


}
<?php


namespace cms\generator;


use cms\base\Configuration as C;
use cms\generator\target\Local;
use cms\generator\target\NoTarget;
use cms\generator\target\BaseTarget;
use cms\model\ModelBase;
use cms\model\Project;
use logger\Logger;
use cms\generator\target\TargetFactory;
use util\exception\PublisherException;
use util\Session;
use util\text\TextMessage;
use util\text\variables\VariableResolver;

/**
 * Publisher for publishing files.
 *
 * This publisher is publishing files to the live server.
 *
 * It doesn't care about the node type, it just publishes files, which means, all node types
 * are recognized as bare files.
 *
 * @package cms\generator
 */
class Publisher
{
	/**
	 * The target to which the file will be copied to.
	 *
	 * @var BaseTarget
	 */
	private $target;

	/**
	 * @var PublishOrder[]
	 */
	private $publishingOrders = [];

	/**
	 * @var Project
	 */
	private $project;


	public function __construct( $projectid )
	{
		$this->project = Project::create( $projectid );
		$this->project->load();

		$this->init();
	}

	/**
	 * Adds a file to the publishing process.
	 *
	 * @param PublishOrder order
	 */
	public function addOrderForPublishing($publishOrder ) {

		$this->publishingOrders[] = $publishOrder;
	}


	/**
	 * The target is cleaned up, which means, older files (older than the start time of the request) are removed.
	 *
	 * @param int $time unused (always using the start time)
	 */
	public function cleanOlderThan( $time ) {

		if   ( $this->target instanceof Local )
			$this->target->clean();
	}



	/**
	 * Initializing the Publisher.
	 */
	public function init()
	{
		if	( C::subset('security')->is('nopublish') )
		{
			$this->target = new NoTarget();
			Logger::warn('publishing is disabled.');
		} else {
			$this->target = TargetFactory::getTargetForUrl( $this->project->target_dir );
		}
	}


	/**
	 * All files are being processed and published.
	 *
	 * @throws PublisherException
	 */
	public function publish()
	{
		$this->target->open(); // Open the connection to the target.

		foreach($this->publishingOrders as $publishOrder )

			$this->target->put( $publishOrder->localFilename,$publishOrder->destinationFilename,$publishOrder->fileTime );

		$this->target->close();

		$this->executeSystemCommand();
	}


	/**
	 * Gets an array with all destination filenames.
	 *
	 * @return array
	 */
	public function getDestinationFilenames() {

		return array_map( function($order) {
			return $order->destinationFilename;
		}, $this->publishingOrders );
	}


	/**
	 * @return array
	 * @throws PublisherException
	 */
	protected function executeSystemCommand()
	{
		$systemCommand = $this->getSystemCommand();

		if ( $systemCommand ) {
			$ausgabe = array();
			$rc = false;
			Logger::debug( TextMessage::create('Executing system command: ${0}',[$systemCommand]) );

			/** @var ModelBase $baseObjectToEnv */
			foreach (['user' => Session::getUser(),
						 'project' => $this->project]
					 as $key => $baseObjectToEnv) {

				foreach ($baseObjectToEnv->getProperties() as $name => $property)
					putenv('CMS_' . strtoupper($key) . '_' . strtoupper($name) . '=' . $property);

			}

			exec($systemCommand, $ausgabe, $rc);

			if ($rc != 0) // Wenn Returncode ungleich 0, dann Fehler melden.
				throw new PublisherException('System command failed - returncode is ' . $rc . "\n" .
					implode("\n",$ausgabe) );
			else
				Logger::debug('System command successful');

		}
	}


	/**
	 * Calculates the system command to execute after publishing.
	 *
	 * @return string|null The system command (or null, if there is no command)
	 */
	private function getSystemCommand()
	{
		$confPublish   = C::subset('publish');
		$commandConfig = $confPublish->subset('command');

		if	( ! $commandConfig->is('enable') )
			return null;

		if	( $commandConfig->is('per_project') && !empty($this->project->cmd_after_publish) )
			$commandAfterPublish   = $this->project->cmd_after_publish;
		else
			$commandAfterPublish   = @$commandConfig->get('command');

		// Im Systemkommando Variablen ersetzen
		$resolver = new VariableResolver();
		$resolver->addResolver('project', function( $property) {
			return @$this->project->getProperties()[$property];
		});
		$resolver->addResolver('target', function( $property) {
			return @parse_url( $this->project->target_dir )[$property];
		});

		$commandAfterPublish = $resolver->resolveVariables( $commandAfterPublish );

		return $commandAfterPublish;
	}


}
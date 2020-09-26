<?php


namespace cms\generator;


use cms\generator\target\Dav;
use cms\generator\target\Fax;
use cms\generator\target\Ftp;
use cms\generator\target\Ftps;
use cms\generator\target\Local;
use cms\generator\target\NoBaseTarget;
use cms\generator\target\Scp;
use cms\generator\target\SFtp;
use cms\generator\target\BaseTarget;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\Url;
use logger\Logger;
use util\exception\PublisherException;
use util\Session;
use util\text\variables\VariableResolver;

/**
 * Publisher for publishing files.
 *
 * This publisher is publishing files to the live server. It doesn't care about the node type, it just publishes files.
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

	private $localDestinationDirectory = '';

	/**
	 * Enthaelt die gleichnamige Einstellung aus dem Projekt.
	 * @var boolean
	 */
	private $contentNegotiation = false;

	/**
	 * Enthaelt die gleichnamige Einstellung aus dem Projekt.
	 * @var boolean
	 */
	private $cutIndex           = false;

	/**
	 * Enthaelt die gleichnamige Einstellung aus dem Projekt.
	 * @var String
	 */
	private $commandAfterPublish = '';

	/**
	 * Enthaelt am Ende der Ver�ffentlichung ein Array mit den ver�ffentlichten Objekten.
	 * @var Array
	 */
	public $publishedObjects    = array();

	/**
	 * Enthaelt im Fehlerfall (wenn 'ok' auf 'false' steht) eine
	 * Fehlermeldung.
	 *
	 * @var String
	 */
	public $log                 = array();

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

	public function publish( $filename,$destination,$time  ) {
		$this->target->put( $filename,$destination,$time );

		$this->publishedObjects[] = $destination;
	}


	public function cleanOlderThan( $time ) {

		if   ( $this->target instanceof Local )
			$this->target->clean();

	}



	/**
	 * Konstruktor.<br>
	 * <br>
	 * Oeffnet ggf. Verbindungen.
	 *
	 * @return Publish
	 */
	public function init()
	{
		$confPublish = \cms\base\Configuration::config('publish');

		if	( \cms\base\Configuration::config('security','nopublish') )
		{
			$this->target = new NoBaseTarget();
			Logger::warn('publishing is disabled.');
		}


		$targetScheme = parse_url( $this->project->target_dir,PHP_URL_SCHEME );

		$availableTargets = [ Local::class,Ftp::class,Ftps::class,Fax::class,SFtp::class,Scp::class,Dav::class ];

		/** @var BaseTarget $target */
		foreach($availableTargets as $target )
		{
			if   ( $target::accepts( $targetScheme ))
			{
				if   ( ! $target::isAvailable() )
					throw new PublisherException('The target "'.$targetScheme.'" is not available.' );

				$this->target = new $target( $this->project->target_dir );
				break;
			}
		}

		if   ( empty( $this->target ) )
			throw new PublisherException('The scheme "'.$targetScheme.'" is not supported.' );

		$this->contentNegotiation = ( $this->project->content_negotiation == '1' );
		$this->cutIndex           = ( $this->project->cut_index           == '1' );

		if	( $confPublish['command']['enable'] )
		{
			if	( $confPublish['command']['per_project'] && !empty($project->cmd_after_publish) )
				$this->commandAfterPublish   = $project->cmd_after_publish;
			else
				$this->commandAfterPublish   = @$confPublish['command']['command'];
		}

		// Im Systemkommando Variablen ersetzen
		$resolver = new VariableResolver();
		$resolver->addResolver('project', function( $property) {
			return @$this->project->getProperties()[$property];
		});
		$resolver->addResolver('target', function( $property) {
			return @parse_url( $this->project->target_dir )[$property];
		});

		$this->commandAfterPublish = $resolver->resolveVariables( $this->commandAfterPublish );

	}



	/**
	 * Beenden des Ver�ffentlichungs-Vorganges.<br>
	 * Eine vorhandene FTP-Verbindung wird geschlossen.<br>
	 * Falls entsprechend konfiguriert, wird ein Systemkommando ausgef�hrt.
	 */
	public function end()
	{
		$this->target->close();

		// Ausfuehren des Systemkommandos.
		if	( !empty($this->commandAfterPublish) )
		{
			$ausgabe = array();
			$rc      = false;
			Logger::debug('Executing system command: '.Logger::sanitizeInput($this->commandAfterPublish) );
			$user = Session::getUser();
			putenv("CMS_USER_NAME=".$user->name  );
			putenv("CMS_USER_ID="  .$user->userid);
			putenv("CMS_USER_MAIL=".$user->mail  );

			exec( $this->commandAfterPublish,$ausgabe,$rc );

			if	( $rc != 0 ) // Wenn Returncode ungleich 0, dann Fehler melden.
				throw new PublisherException('System command failed - returncode is ' . $rc . "\n" .
					$ausgabe);
			else
				Logger::debug('System command successful' );

		}
	}


}
<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\base\Startup;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\File;
use cms\model\Page;
use cms\model\Permission;
use cms\model\Folder;
use cms\model\Template;
use language\Messages;
use util\Session;


class FolderPubAction extends FolderAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_PUBLISH;
	}



	public function view() {
		// Schalter nur anzeigen, wenn sinnvoll

        // TODO texts, urls....
		$this->setTemplateVar('files'  ,count($this->folder->getFiles()) >= 0 );
        $this->setTemplateVar('pages'  ,count($this->folder->getPages()) > 0 );
        $this->setTemplateVar('subdirs',count($this->folder->getSubFolderIds()) > 0 );

		//$this->setTemplateVar('clean'  ,$this->folder->isRoot );
		// Gefaehrliche Option, da dies bestehende Dateien, die evtl. nicht zum CMS gehören, überschreibt.
		// Daher deaktiviert.
		$this->setTemplateVar('clean'  ,false );
    }


    public function post() {

		$project = $this->folder->getProject();
		$project->load();

		// Nothing is written to the session from this point. so we should free the session.
		Session::close();

		$publisher = new Publisher( $project->projectid );

		// Create a list of all folders.
		$folderList = [ $this->folder->objectid ];

		// Add all subfolders to the list
		if   ( $this->request->has('subdirs') )
			$folderList = array_merge( $folderList, $this->folder->getAllSubFolderIds() );

		foreach( $folderList as $folderId ) {

			$folder = new Folder( $folderId );
			$folder->load();

			// Publish all pages
			if   ( $this->request->has('pages'  ) ) {

				foreach( $folder->getPages() as $pageObjectId ) {

					$page = new Page( $pageObjectId );
					$page->load();

					$template = new Template( $page->templateid );
					$template->load();

					if   ( ! $template->publish )
						continue; // Template should not be published.

					$page->setPublishedTimestamp();

					foreach( $project->getModelIds() as $modelId ) {

						foreach( $project->getLanguageIds() as $languageId ) {

							$pageContext = new PageContext( $pageObjectId, Producer::SCHEME_PUBLIC );
							$pageContext->modelId    = $modelId;
							$pageContext->languageId = $languageId;

							$pageGenerator = new PageGenerator( $pageContext );

							$publisher->addOrderForPublishing( new PublishOrder( $pageGenerator->getCache()->load()->getFilename(),$pageGenerator->getPublicFilename(), 0 ) );
						}
					}
				}
			}


			// Publish all files
			if   ( $this->request->has('files'  ) ) {

				foreach( $folder->getFiles() as $fileid ) {

					(new File($fileid))->setPublishedTimestamp();

					$fileGenerator = new FileGenerator( new FileContext( $fileid, Producer::SCHEME_PUBLIC));
					$publisher->addOrderForPublishing( new PublishOrder( $fileGenerator->getCache()->load()->getFilename(),$fileGenerator->getPublicFilename(),0 ) );

				}
			}

			$publisher->publish();
		}




		// Cleanup the target directory (if supported by the underlying target)
		if	( $this->request->has('clean')      )
			$publisher->cleanOlderThan( Startup::getStartTime() );


		$this->addNoticeFor( $this->folder,
			Messages::PUBLISHED,
			array(),
			'Published items:'."\n".implode("\n",$publisher->getDestinationFilenames() )
		);
    }
}

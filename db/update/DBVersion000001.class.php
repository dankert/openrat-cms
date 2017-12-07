<?php

use database\Database;
use database\DbVersion;


/**
 * Baseline database structure.
 * 
 * @author dankert
 *
 */
class DBVersion000001 extends DbVersion
{
	public function update()
	{
		$not_nullable = false;
		$nullable     = true;
		
		$this->addTable('project');

		$this->addColumn('project','name'               ,'VARCHAR', 128,null,$not_nullable);
		$this->addColumn('project','target_dir'         ,'VARCHAR', 255,null,$not_nullable);
		$this->addColumn('project','ftp_url'            ,'VARCHAR', 255,null,$not_nullable);
		$this->addColumn('project','ftp_passive'        ,'INT'    ,null,null,$not_nullable);
		$this->addColumn('project','cmd_after_publish'  ,'VARCHAR', 255,null,$not_nullable);
		$this->addColumn('project','content_negotiation','INT'    ,   1,   0,$not_nullable);
		$this->addColumn('project','cut_index'          ,'INT'    ,   1,   0,$not_nullable);
		
		$this->addPrimaryKey('project','id');
		$this->addIndex('project','name');
		
		/*
		 * 
		$this->addColumn('id','INT',null,null,$not_nullable);
		$this->addColumn('name','VARCHAR',128,null,$not_nullable);
		$this->addColumn('target_dir','VARCHAR',255,null,$not_nullable);
		$this->addColumn('ftp_url','VARCHAR',255,null,$not_nullable);
		$this->addColumn('ftp_passive','INT',1,0,$not_nullable);
		$this->addColumn('cmd_after_publish','VARCHAR',255,null,$not_nullable);
		$this->addColumn('content_negotiation','INT',1,0,$not_nullable);
		$this->addColumn('cut_$this->addIndex('','INT');',1,0,$not_nullable);
		$this->addPrimaryKey('','id');
		close_table
		unique_$this->addIndex('','name');
		 */
		
		
		
				
		$this->addTable('user');
		$this->addColumn('user','name','VARCHAR',128,null,$not_nullable);
		$this->addColumn('user','password','VARCHAR',50,null,$not_nullable);
		$this->addColumn('user','ldap_dn','VARCHAR',255,null,$not_nullable);
		$this->addColumn('user','fullname','VARCHAR',128,null,$not_nullable);
		$this->addColumn('user','tel','VARCHAR',128,null,$not_nullable);
		$this->addColumn('user','mail','VARCHAR',255,null,$not_nullable);
		$this->addColumn('user','descr','VARCHAR',255,null,$not_nullable);
		$this->addColumn('user','style','VARCHAR',64,null,$not_nullable);
		$this->addColumn('user','is_admin','INT',1,0,$not_nullable);
		$this->addPrimaryKey('user','id');
		$this->addUniqueIndex('user','name');
		
		$this->addTable('group');
		$this->addColumn('group','name','VARCHAR',100,null,$not_nullable);
		$this->addPrimaryKey('group','id');
		$this->addUniqueIndex('group','name');
		
		$this->addTable('object');
		$this->addColumn('object','parentid','INT',null,null,$nullable);
		$this->addColumn('object','projectid','INT',0,0,$not_nullable);
		$this->addColumn('object','filename','VARCHAR',255,null,$not_nullable);
		$this->addColumn('object','orderid','INT',0,null,$not_nullable);
		$this->addColumn('object','create_date','INT',0,null,$not_nullable);
		$this->addColumn('object','create_userid','INT',0,null,$nullable);
		$this->addColumn('object','lastchange_date','INT',0,null,$not_nullable);
		$this->addColumn('object','lastchange_userid','INT',0,null,$nullable);
		$this->addColumn('object','is_folder','INT',1,null,$not_nullable);
		$this->addColumn('object','is_file','INT',1,null,$not_nullable);
		$this->addColumn('object','is_page','INT',1,null,$not_nullable);
		$this->addColumn('object','is_link','INT',1,null,$not_nullable);
		$this->addPrimaryKey('object','id');
		$this->addConstraint('object','projectid','project','id');
		$this->addConstraint('object','lastchange_userid','user','id');
		$this->addConstraint('object','create_userid','user','id');
		
		$this->addIndex('object','parentid');
		$this->addIndex('object','projectid');
		$this->addIndex('object','is_folder');
		$this->addIndex('object','is_file');
		$this->addIndex('object','is_page');
		$this->addIndex('object','is_link');
		$this->addIndex('object','orderid');
		$this->addIndex('object','create_userid');
		$this->addIndex('object','lastchange_userid');
		$this->addUniqueIndex('object','parentid,filename');
		
		
		
		
		$this->addTable('template');
		$this->addColumn('template','projectid','INT',null,null,$not_nullable);
		$this->addColumn('template','name','VARCHAR',50,null,$not_nullable);
		$this->addPrimaryKey('template','id');
		$this->addConstraint('template','projectid','project','id');
		
		$this->addIndex('template','projectid');
		$this->addIndex('template','name');
		$this->addUniqueIndex('template','projectid,name');
		
		
		
		$this->addTable('language');
		$this->addColumn('language','projectid','INT',0,null,$not_nullable);
		$this->addColumn('language','isocode','VARCHAR',10,null,$not_nullable);
		$this->addColumn('language','name','VARCHAR',50,null,$not_nullable);
		$this->addColumn('language','is_default','INT',1,0,$not_nullable);
		$this->addPrimaryKey('language','id');
		$this->addConstraint('language','projectid','project','id');
		$this->addUniqueIndex('language','projectid,isocode');
		
		
		
		
		$this->addTable('page');
		$this->addColumn('page','objectid','INT',0,null,$not_nullable);
		$this->addColumn('page','templateid','INT',0,null,$not_nullable);
		$this->addPrimaryKey('page','id');
		$this->addConstraint('page','templateid','template','id');
		$this->addConstraint('page','objectid','object','id');
		 
		$this->addUniqueIndex('page','objectid');
		$this->addIndex('page','templateid');
		
		
		
		
		$this->addTable('projectmodel');
		$this->addColumn('projectmodel','projectid','INT',0,null,$not_nullable);
		$this->addColumn('projectmodel','name','VARCHAR',50,null,$not_nullable);
		$this->addColumn('projectmodel','extension','VARCHAR',10,null,$nullable);
		$this->addColumn('projectmodel','is_default','INT',1,0,$not_nullable);
		$this->addPrimaryKey('projectmodel','id');
		$this->addConstraint('projectmodel','projectid','project','id');
		
		$this->addIndex('projectmodel','projectid');
		$this->addUniqueIndex('projectmodel','projectid,name');
		
		
		$this->addTable('element');
		$this->addColumn('element','templateid','INT',0,0,$not_nullable);
		$this->addColumn('element','name','VARCHAR',50,null,$not_nullable);
		$this->addColumn('element','descr','VARCHAR',255,null,$not_nullable);
		$this->addColumn('element','type','VARCHAR',20,null,$not_nullable);
		$this->addColumn('element','subtype','VARCHAR',20,null,$nullable);
		$this->addColumn('element','with_icon','INT',1,0,$not_nullable);
		$this->addColumn('element','dateformat','VARCHAR',100,null,$nullable);
		$this->addColumn('element','wiki','INT',1,0,$nullable);
		$this->addColumn('element','html','INT',1,0,$nullable);
		$this->addColumn('element','all_languages','INT',1,0,$not_nullable);
		$this->addColumn('element','writable','INT',1,0,$not_nullable);
		$this->addColumn('element','decimals','INT',0,null,$nullable);
		$this->addColumn('element','dec_point','VARCHAR',5,null,$nullable);
		$this->addColumn('element','thousand_sep','VARCHAR',1,null,$nullable);
		$this->addColumn('element','code','TEXT',null,null,$nullable);
		$this->addColumn('element','default_text','TEXT',null,null,$nullable);
		$this->addColumn('element','folderobjectid','INT',null,null,$nullable);
		$this->addColumn('element','default_objectid','INT',null,null,$nullable);
		$this->addPrimaryKey('element','id');
		$this->addConstraint('element','default_objectid','object','id');
		$this->addConstraint('element','folderobjectid','object','id');
		$this->addConstraint('element','templateid','template','id');
		
		$this->addIndex('element','templateid');
		$this->addIndex('element','name');
		$this->addUniqueIndex('element','templateid,name');
		
		
		
		
		$this->addTable('file');
		$this->addColumn('file','objectid','INT',0,null,$not_nullable);
		$this->addColumn('file','extension','VARCHAR',10,null,$not_nullable);
		$this->addColumn('file','size','INT',0,null,$not_nullable);
		$this->addColumn('file','value','BLOB',null,null,$not_nullable);
		$this->addPrimaryKey('file','id');
		$this->addConstraint('file','objectid','object','id');
		
		$this->addUniqueIndex('file','objectid');
		
		
		
		$this->addTable('folder');
		$this->addColumn('folder','objectid','INT',0,null,$not_nullable);
		$this->addPrimaryKey('folder','id');
		$this->addConstraint('folder','objectid','object','id');
		
		$this->addUniqueIndex('folder','objectid');
		
		
		
		
		
		$this->addTable('link');
		$this->addColumn('link','objectid','INT',0,null,$not_nullable);
		$this->addColumn('link','link_objectid','INT',null,null,$nullable);
		$this->addColumn('link','url','VARCHAR',255,null,$nullable);
		$this->addPrimaryKey('link','id');
		$this->addConstraint('link','objectid','object','id');
		$this->addConstraint('link','link_objectid','object','id');
		
		$this->addUniqueIndex('link','objectid');
		$this->addIndex('link','link_objectid');
		
		
		
		
		
		$this->addTable('name');
		$this->addColumn('name','objectid','INT',0,null,$not_nullable);
		$this->addColumn('name','name','VARCHAR',255,null,$not_nullable);
		$this->addColumn('name','descr','VARCHAR',255,null,$not_nullable);
		$this->addColumn('name','languageid','INT',0,null,$not_nullable);
		$this->addPrimaryKey('name','id');
		$this->addConstraint('name','objectid','object','id');
		$this->addConstraint('name','languageid','language','id');
		
		$this->addIndex('name','objectid');
		$this->addIndex('name','languageid');
		$this->addUniqueIndex('name','objectid,languageid');
		
		
		
		
		
		$this->addTable('templatemodel');
		$this->addColumn('templatemodel','templateid','INT',0,null,$not_nullable);
		$this->addColumn('templatemodel','projectmodelid','INT',0,null,$not_nullable);
		$this->addColumn('templatemodel','extension','VARCHAR',10,null,$nullable);
		$this->addColumn('templatemodel','text','TEXT',null,null,$not_nullable);
		$this->addPrimaryKey('templatemodel','id');
		$this->addConstraint('templatemodel','templateid','template','id');
		$this->addConstraint('templatemodel','projectmodelid','projectmodel','id');
		
		$this->addIndex('templatemodel','templateid');
		$this->addUniqueIndex('templatemodel','templateid,extension');
		$this->addUniqueIndex('templatemodel','templateid,projectmodelid');
		
		
		
		
		
		$this->addTable('usergroup');
		$this->addColumn('usergroup','userid','INT',null,null,$not_nullable);
		$this->addColumn('usergroup','groupid','INT',null,null,$not_nullable);
		$this->addPrimaryKey('usergroup','id');
		$this->addConstraint('usergroup','groupid','group','id');
		$this->addConstraint('usergroup','userid','user','id');
		
		$this->addIndex('usergroup','groupid');
		$this->addIndex('usergroup','userid');
		$this->addUniqueIndex('usergroup','userid,groupid');
		
		
		
		
		$this->addTable('value');
		$this->addColumn('value','pageid','INT',0,null,$not_nullable);
		$this->addColumn('value','languageid','INT',null,null,$not_nullable);
		$this->addColumn('value','elementid','INT',0,null,$not_nullable);
		$this->addColumn('value','linkobjectid','INT',null,null,$nullable);
		$this->addColumn('value','text','TEXT',null,null,$nullable);
		$this->addColumn('value','number','INT',null,null,$nullable);
		$this->addColumn('value','date','INT',null,null,$nullable);
		$this->addColumn('value','active','INT',0,null,$not_nullable);
		$this->addColumn('value','lastchange_date','INT',0,null,$not_nullable);
		$this->addColumn('value','lastchange_userid','INT',null,null,$nullable);
		$this->addColumn('value','publish','INT',null,null,$not_nullable);
		$this->addPrimaryKey('value','id');
		$this->addConstraint('value','pageid','page','id');
		$this->addConstraint('value','elementid','element','id');
		$this->addConstraint('value','languageid','language','id');
		$this->addConstraint('value','lastchange_userid','user','id');
		$this->addConstraint('value','linkobjectid','object','id');
		
		$this->addIndex('value','pageid');
		$this->addIndex('value','languageid');
		$this->addIndex('value','elementid');
		$this->addIndex('value','active');
		$this->addIndex('value','lastchange_date');
		$this->addIndex('value','publish');
		
		
		
		
		
		$this->addTable('acl');
		$this->addColumn('acl','userid','INT',null,null,$nullable);
		$this->addColumn('acl','groupid','INT',null,null,$nullable);
		$this->addColumn('acl','objectid','INT',null,null,$not_nullable);
		$this->addColumn('acl','languageid','INT',0,null,$nullable);
		$this->addColumn('acl','is_write','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_prop','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_create_folder','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_create_file','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_create_link','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_create_page','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_delete','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_release','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_publish','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_grant','INT',1,0,$not_nullable);
		$this->addColumn('acl','is_transmit','INT',1,0,$not_nullable);
		$this->addPrimaryKey('acl','id');
		$this->addConstraint('acl','groupid','group','id');
		$this->addConstraint('acl','userid','user','id');
		$this->addConstraint('acl','objectid','object','id');
		$this->addConstraint('acl','languageid','language','id');
		
		$this->addIndex('acl','userid');
		$this->addIndex('acl','groupid');
		$this->addIndex('acl','languageid');
		$this->addIndex('acl','objectid');
		$this->addIndex('acl','is_transmit');

		$this->afterUpdate( $this->getDb() );
	}



    /**
     * Initialisieren der frisch aktualisierten Datenbank.
     *
     * @param DB $db
     */
    private function afterUpdate( Database $db )
    {
        // Benutzer zählen.
        $sql = $db->sql('SELECT COUNT(*) From {{user}}',$db->id);
        $countUsers = $sql->getOne( $sql );

        // Wenn noch kein Benutzer vorhanden, dann einen anlegen.
        if	( $countUsers == 0 )
        {
            $sql = $db->sql("INSERT INTO {{user}} (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Account for administration tasks.','default',1)",$db->id);
            $sql->query( $sql );
            $db->commit();
        }
    }


}

?>
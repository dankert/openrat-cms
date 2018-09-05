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

		$this->addColumn('project','name'               ,OR_DB_COLUMN_TYPE_VARCHAR, 128,null,$not_nullable);
		$this->addColumn('project','target_dir'         ,OR_DB_COLUMN_TYPE_VARCHAR, 255,null,$not_nullable);
		$this->addColumn('project','ftp_url'            ,OR_DB_COLUMN_TYPE_VARCHAR, 255,null,$not_nullable);
		$this->addColumn('project','ftp_passive'        ,OR_DB_COLUMN_TYPE_INT    ,null,null,$not_nullable);
		$this->addColumn('project','cmd_after_publish'  ,OR_DB_COLUMN_TYPE_VARCHAR, 255,null,$not_nullable);
		$this->addColumn('project','content_negotiation',OR_DB_COLUMN_TYPE_INT    ,   1,   0,$not_nullable);
		$this->addColumn('project','cut_index'          ,OR_DB_COLUMN_TYPE_INT    ,   1,   0,$not_nullable);
		
		$this->addPrimaryKey('project','id');
		$this->addIndex('project','name');
		

		$this->addTable('user');
		$this->addColumn('user','name',OR_DB_COLUMN_TYPE_VARCHAR,128,null,$not_nullable);
		$this->addColumn('user','password',OR_DB_COLUMN_TYPE_VARCHAR,50,null,$not_nullable);
		$this->addColumn('user','ldap_dn',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		$this->addColumn('user','fullname',OR_DB_COLUMN_TYPE_VARCHAR,128,null,$not_nullable);
		$this->addColumn('user','tel',OR_DB_COLUMN_TYPE_VARCHAR,128,null,$not_nullable);
		$this->addColumn('user','mail',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		$this->addColumn('user','descr',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		$this->addColumn('user','style',OR_DB_COLUMN_TYPE_VARCHAR,64,null,$not_nullable);
		$this->addColumn('user','is_admin',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addPrimaryKey('user','id');
		$this->addUniqueIndex('user','name');
		
		$this->addTable('group');
		$this->addColumn('group','name',OR_DB_COLUMN_TYPE_VARCHAR,100,null,$not_nullable);
		$this->addPrimaryKey('group','id');
		$this->addUniqueIndex('group','name');
		
		$this->addTable('object');
		$this->addColumn('object','parentid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('object','projectid',OR_DB_COLUMN_TYPE_INT,0,0,$not_nullable);
		$this->addColumn('object','filename',OR_DB_COLUMN_TYPE_VARCHAR,150,null,$not_nullable);
		$this->addColumn('object','orderid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('object','create_date',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('object','create_userid',OR_DB_COLUMN_TYPE_INT,0,null,$nullable);
		$this->addColumn('object','lastchange_date',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('object','lastchange_userid',OR_DB_COLUMN_TYPE_INT,0,null,$nullable);
		$this->addColumn('object','is_folder',OR_DB_COLUMN_TYPE_INT,1,null,$not_nullable);
		$this->addColumn('object','is_file',OR_DB_COLUMN_TYPE_INT,1,null,$not_nullable);
		$this->addColumn('object','is_page',OR_DB_COLUMN_TYPE_INT,1,null,$not_nullable);
		$this->addColumn('object','is_link',OR_DB_COLUMN_TYPE_INT,1,null,$not_nullable);
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
		$this->addColumn('template','projectid',OR_DB_COLUMN_TYPE_INT,null,null,$not_nullable);
		$this->addColumn('template','name',OR_DB_COLUMN_TYPE_VARCHAR,50,null,$not_nullable);
		$this->addPrimaryKey('template','id');
		$this->addConstraint('template','projectid','project','id');
		
		$this->addIndex('template','projectid');
		$this->addIndex('template','name');
		$this->addUniqueIndex('template','projectid,name');
		
		
		
		$this->addTable('language');
		$this->addColumn('language','projectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('language','isocode',OR_DB_COLUMN_TYPE_VARCHAR,10,null,$not_nullable);
		$this->addColumn('language','name',OR_DB_COLUMN_TYPE_VARCHAR,50,null,$not_nullable);
		$this->addColumn('language','is_default',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addPrimaryKey('language','id');
		$this->addConstraint('language','projectid','project','id');
		$this->addUniqueIndex('language','projectid,isocode');
		
		
		
		
		$this->addTable('page');
		$this->addColumn('page','objectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('page','templateid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addPrimaryKey('page','id');
		$this->addConstraint('page','templateid','template','id');
		$this->addConstraint('page','objectid','object','id');
		 
		$this->addUniqueIndex('page','objectid');
		$this->addIndex('page','templateid');
		
		
		
		
		$this->addTable('projectmodel');
		$this->addColumn('projectmodel','projectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('projectmodel','name',OR_DB_COLUMN_TYPE_VARCHAR,50,null,$not_nullable);
		$this->addColumn('projectmodel','extension',OR_DB_COLUMN_TYPE_VARCHAR,10,null,$nullable);
		$this->addColumn('projectmodel','is_default',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addPrimaryKey('projectmodel','id');
		$this->addConstraint('projectmodel','projectid','project','id');
		
		$this->addIndex('projectmodel','projectid');
		$this->addUniqueIndex('projectmodel','projectid,name');
		
		
		$this->addTable('element');
		$this->addColumn('element','templateid',OR_DB_COLUMN_TYPE_INT,0,0,$not_nullable);
		$this->addColumn('element','name',OR_DB_COLUMN_TYPE_VARCHAR,50,null,$not_nullable);
		$this->addColumn('element','descr',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		$this->addColumn('element','type',OR_DB_COLUMN_TYPE_VARCHAR,20,null,$not_nullable);
		$this->addColumn('element','subtype',OR_DB_COLUMN_TYPE_VARCHAR,20,null,$nullable);
		$this->addColumn('element','with_icon',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('element','dateformat',OR_DB_COLUMN_TYPE_VARCHAR,100,null,$nullable);
		$this->addColumn('element','wiki',OR_DB_COLUMN_TYPE_INT,1,0,$nullable);
		$this->addColumn('element','html',OR_DB_COLUMN_TYPE_INT,1,0,$nullable);
		$this->addColumn('element','all_languages',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('element','writable',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('element','decimals',OR_DB_COLUMN_TYPE_INT,0,null,$nullable);
		$this->addColumn('element','dec_point',OR_DB_COLUMN_TYPE_VARCHAR,5,null,$nullable);
		$this->addColumn('element','thousand_sep',OR_DB_COLUMN_TYPE_VARCHAR,1,null,$nullable);
		$this->addColumn('element','code',OR_DB_COLUMN_TYPE_TEXT,null,null,$nullable);
		$this->addColumn('element','default_text',OR_DB_COLUMN_TYPE_TEXT,null,null,$nullable);
		$this->addColumn('element','folderobjectid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('element','default_objectid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addPrimaryKey('element','id');
		$this->addConstraint('element','default_objectid','object','id');
		$this->addConstraint('element','folderobjectid','object','id');
		$this->addConstraint('element','templateid','template','id');
		
		$this->addIndex('element','templateid');
		$this->addIndex('element','name');
		$this->addUniqueIndex('element','templateid,name');
		
		
		
		
		$this->addTable('file');
		$this->addColumn('file','objectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('file','extension',OR_DB_COLUMN_TYPE_VARCHAR,10,null,$not_nullable);
		$this->addColumn('file','size',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('file','value',OR_DB_COLUMN_TYPE_BLOB,null,null,$not_nullable);
		$this->addPrimaryKey('file','id');
		$this->addConstraint('file','objectid','object','id');
		
		$this->addUniqueIndex('file','objectid');
		
		
		
		$this->addTable('folder');
		$this->addColumn('folder','objectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addPrimaryKey('folder','id');
		$this->addConstraint('folder','objectid','object','id');
		
		$this->addUniqueIndex('folder','objectid');
		
		
		
		
		
		$this->addTable('link');
		$this->addColumn('link','objectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('link','link_objectid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('link','url',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$nullable);
		$this->addPrimaryKey('link','id');
		$this->addConstraint('link','objectid','object','id');
		$this->addConstraint('link','link_objectid','object','id');
		
		$this->addUniqueIndex('link','objectid');
		$this->addIndex('link','link_objectid');
		
		
		
		
		
		$this->addTable('name');
		$this->addColumn('name','objectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('name','name',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		$this->addColumn('name','descr',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		$this->addColumn('name','languageid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addPrimaryKey('name','id');
		$this->addConstraint('name','objectid','object','id');
		$this->addConstraint('name','languageid','language','id');
		
		$this->addIndex('name','objectid');
		$this->addIndex('name','languageid');
		$this->addUniqueIndex('name','objectid,languageid');
		
		
		
		
		
		$this->addTable('templatemodel');
		$this->addColumn('templatemodel','templateid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('templatemodel','projectmodelid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('templatemodel','extension',OR_DB_COLUMN_TYPE_VARCHAR,10,null,$nullable);
		$this->addColumn('templatemodel','text',OR_DB_COLUMN_TYPE_TEXT,null,null,$not_nullable);
		$this->addPrimaryKey('templatemodel','id');
		$this->addConstraint('templatemodel','templateid','template','id');
		$this->addConstraint('templatemodel','projectmodelid','projectmodel','id');
		
		$this->addIndex('templatemodel','templateid');
		$this->addUniqueIndex('templatemodel','templateid,extension');
		$this->addUniqueIndex('templatemodel','templateid,projectmodelid');
		
		
		
		
		
		$this->addTable('usergroup');
		$this->addColumn('usergroup','userid',OR_DB_COLUMN_TYPE_INT,null,null,$not_nullable);
		$this->addColumn('usergroup','groupid',OR_DB_COLUMN_TYPE_INT,null,null,$not_nullable);
		$this->addPrimaryKey('usergroup','id');
		$this->addConstraint('usergroup','groupid','group','id');
		$this->addConstraint('usergroup','userid','user','id');
		
		$this->addIndex('usergroup','groupid');
		$this->addIndex('usergroup','userid');
		$this->addUniqueIndex('usergroup','userid,groupid');
		
		
		
		
		$this->addTable('value');
		$this->addColumn('value','pageid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('value','languageid',OR_DB_COLUMN_TYPE_INT,null,null,$not_nullable);
		$this->addColumn('value','elementid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('value','linkobjectid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('value','text',OR_DB_COLUMN_TYPE_TEXT,null,null,$nullable);
		$this->addColumn('value','number',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('value','date',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('value','active',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('value','lastchange_date',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
		$this->addColumn('value','lastchange_userid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('value','publish',OR_DB_COLUMN_TYPE_INT,null,null,$not_nullable);
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
		$this->addColumn('acl','userid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('acl','groupid',OR_DB_COLUMN_TYPE_INT,null,null,$nullable);
		$this->addColumn('acl','objectid',OR_DB_COLUMN_TYPE_INT,null,null,$not_nullable);
		$this->addColumn('acl','languageid',OR_DB_COLUMN_TYPE_INT,0,null,$nullable);
		$this->addColumn('acl','is_write',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_prop',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_create_folder',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_create_file',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_create_link',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_create_page',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_delete',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_release',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_publish',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_grant',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
		$this->addColumn('acl','is_transmit',OR_DB_COLUMN_TYPE_INT,1,0,$not_nullable);
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
     * @param Database $db
     */
    private function afterUpdate( Database $db )
    {
        // Benutzer zählen.
        $sql = $db->sql('SELECT COUNT(*) From {{user}}',$db->id);
        $countUsers = $sql->getOne();

        // Wenn noch kein Benutzer vorhanden, dann einen anlegen.
        if	( $countUsers == 0 )
        {
            // Hashing the admin password with MD5. In Version 6 the Algo will be set to 2 (=MD5).
            $sql = $db->sql("INSERT INTO {{user}} (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','21232f297a57a5a743894a0e4a801fc3','','Administrator','','','Account for administration tasks.','default',1)",$db->id);
            $sql->query();
            $db->commit();
        }
    }


}

?>
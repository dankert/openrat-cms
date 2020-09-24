<?php

namespace cms\update\version;

use database\Database;
use database\DbVersion;
use database\Column;


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
		$table = $this->table('project')->add();

		$table->column('name'               )->type(Column::TYPE_VARCHAR)->size( 128)->add();
		$table->column('target_dir'         )->type(Column::TYPE_VARCHAR)->size( 255)->add();
		$table->column('ftp_url'            )->type(Column::TYPE_VARCHAR)->size( 255)->add();
		$table->column('ftp_passive'        )->type(Column::TYPE_INT    )->add();
		$table->column('cmd_after_publish'  )->type(Column::TYPE_VARCHAR)->size( 255)->add();
		$table->column('content_negotiation')->type(Column::TYPE_INT    )->size(   1)->defaultValue(   0)->add();
		$table->column('cut_index'          )->type(Column::TYPE_INT    )->size(   1)->defaultValue(   0)->add();
		
		$table->addPrimaryKey('id');
		$table->addIndex('name');
		

		$table = $this->table('user')->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(128)->add();
		$table->column('password')->type(Column::TYPE_VARCHAR)->size(50)->add();
		$table->column('ldap_dn')->type(Column::TYPE_VARCHAR)->size(255)->add();
		$table->column('fullname')->type(Column::TYPE_VARCHAR)->size(128)->add();
		$table->column('tel')->type(Column::TYPE_VARCHAR)->size(128)->add();
		$table->column('mail')->type(Column::TYPE_VARCHAR)->size(255)->add();
		$table->column('descr')->type(Column::TYPE_VARCHAR)->size(255)->add();
		$table->column('style')->type(Column::TYPE_VARCHAR)->size(64)->add();
		$table->column('is_admin')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->addPrimaryKey('id');
		$table->addUniqueIndex('name');
		
		$table = $this->table('group')->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(100)->add();
		$table->addPrimaryKey('id');
		$table->addUniqueIndex('name');
		
		$table = $this->table('object')->add();
		$table->column('parentid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('projectid')->type(Column::TYPE_INT)->size(0)->defaultValue(0)->add();
		$table->column('filename')->type(Column::TYPE_VARCHAR)->size(150)->add();
		$table->column('orderid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('create_date')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('create_userid')->type(Column::TYPE_INT)->size(0)->nullable()->add();
		$table->column('lastchange_date')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('lastchange_userid')->type(Column::TYPE_INT)->size(0)->nullable()->add();
		$table->column('is_folder')->type(Column::TYPE_INT)->size(1)->add();
		$table->column('is_file')->type(Column::TYPE_INT)->size(1)->add();
		$table->column('is_page')->type(Column::TYPE_INT)->size(1)->add();
		$table->column('is_link')->type(Column::TYPE_INT)->size(1)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('projectid', 'project', 'id');
		$table->addConstraint('lastchange_userid', 'user', 'id');
		$table->addConstraint('create_userid', 'user', 'id');
		
		$table->addIndex('parentid');
		$table->addIndex('projectid');
		$table->addIndex('is_folder');
		$table->addIndex('is_file');
		$table->addIndex('is_page');
		$table->addIndex('is_link');
		$table->addIndex('orderid');
		$table->addIndex('create_userid');
		$table->addIndex('lastchange_userid');
		$table->addUniqueIndex( ['parentid','filename'] );
		
		
		
		
		$table = $this->table('template')->add();
		$table->column('projectid')->type(Column::TYPE_INT)->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(50)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('projectid', 'project', 'id');
		
		$table->addIndex('projectid');
		$table->addIndex('name');
		$table->addUniqueIndex(['projectid','name']);
		
		
		
		$table = $this->table('language')->add();
		$table->column('projectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('isocode')->type(Column::TYPE_VARCHAR)->size(10)->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(50)->add();
		$table->column('is_default')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('projectid', 'project', 'id');
		$table->addUniqueIndex(['projectid','isocode']);
		
		
		
		
		$table = $this->table('page')->add();
		$table->column('objectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('templateid')->type(Column::TYPE_INT)->size(0)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('templateid', 'template', 'id');
		$table->addConstraint('objectid', 'object', 'id');
		 
		$table->addUniqueIndex('objectid');
		$table->addIndex('templateid');
		
		
		
		
		$table = $this->table('projectmodel')->add();
		$table->column('projectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(50)->add();
		$table->column('extension')->type(Column::TYPE_VARCHAR)->size(10)->nullable()->add();
		$table->column('is_default')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('projectid', 'project', 'id');
		
		$table->addIndex('projectid');
		$table->addUniqueIndex(['projectid','name'] );
		
		
		$table = $this->table('element')->add();
		$table->column('templateid')->type(Column::TYPE_INT)->size(0)->defaultValue(0)->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(50)->add();
		$table->column('descr')->type(Column::TYPE_VARCHAR)->size(255)->add();
		$table->column('type')->type(Column::TYPE_VARCHAR)->size(20)->add();
		$table->column('subtype')->type(Column::TYPE_VARCHAR)->size(20)->nullable()->add();
		$table->column('with_icon')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('dateformat')->type(Column::TYPE_VARCHAR)->size(100)->nullable()->add();
		$table->column('wiki')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->nullable()->add();
		$table->column('html')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->nullable()->add();
		$table->column('all_languages')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('writable')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('decimals')->type(Column::TYPE_INT)->size(0)->nullable()->add();
		$table->column('dec_point')->type(Column::TYPE_VARCHAR)->size(5)->nullable()->add();
		$table->column('thousand_sep')->type(Column::TYPE_VARCHAR)->size(1)->nullable()->add();
		$table->column('code')->type(Column::TYPE_TEXT)->nullable()->add();
		$table->column('default_text')->type(Column::TYPE_TEXT)->nullable()->add();
		$table->column('folderobjectid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('default_objectid')->type(Column::TYPE_INT)->nullable()->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('default_objectid', 'object', 'id');
		$table->addConstraint('folderobjectid', 'object', 'id');
		$table->addConstraint('templateid', 'template', 'id');
		
		$table->addIndex('templateid');
		$table->addIndex('name');
		$table->addUniqueIndex(['templateid','name']);
		
		
		
		
		$table = $this->table('file')->add();
		$table->column('objectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('extension')->type(Column::TYPE_VARCHAR)->size(10)->add();
		$table->column('size')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('value')->type(Column::TYPE_BLOB)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('objectid', 'object', 'id');
		
		$table->addUniqueIndex('objectid');
		
		
		
		$table = $this->table('folder')->add();
		$table->column('objectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('objectid', 'object', 'id');
		
		$table->addUniqueIndex('objectid');
		
		
		
		
		
		$table = $this->table('link')->add();
		$table->column('objectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('link_objectid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('url')->type(Column::TYPE_VARCHAR)->size(255)->nullable()->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('objectid', 'object', 'id');
		$table->addConstraint('link_objectid', 'object', 'id');
		
		$table->addUniqueIndex('objectid');
		$table->addIndex('link_objectid');
		
		
		
		
		
		$table = $this->table('name')->add();
		$table->column('objectid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('name')->type(Column::TYPE_VARCHAR)->size(255)->add();
		$table->column('descr')->type(Column::TYPE_VARCHAR)->size(255)->add();
		$table->column('languageid')->type(Column::TYPE_INT)->size(0)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('objectid', 'object', 'id');
		$table->addConstraint('languageid', 'language', 'id');
		
		$table->addIndex('objectid');
		$table->addIndex('languageid');
		$table->addUniqueIndex(['objectid','languageid']);
		
		
		
		
		
		$table = $this->table('templatemodel')->add();
		$table->column('templateid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('projectmodelid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('extension')->type(Column::TYPE_VARCHAR)->size(10)->nullable()->add();
		$table->column('text')->type(Column::TYPE_TEXT)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('templateid', 'template', 'id');
		$table->addConstraint('projectmodelid', 'projectmodel', 'id');
		
		$table->addIndex('templateid');
		$table->addUniqueIndex(['templateid','extension'     ]);
		$table->addUniqueIndex(['templateid','projectmodelid']);
		
		
		
		
		
		$table = $this->table('usergroup')->add();
		$table->column('userid')->type(Column::TYPE_INT)->add();
		$table->column('groupid')->type(Column::TYPE_INT)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('groupid', 'group', 'id');
		$table->addConstraint('userid', 'user', 'id');
		
		$table->addIndex('groupid');
		$table->addIndex('userid');
		$table->addUniqueIndex(['userid','groupid']);
		
		
		
		
		$table = $this->table('value')->add();
		$table->column('pageid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('languageid')->type(Column::TYPE_INT)->add();
		$table->column('elementid')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('linkobjectid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('text')->type(Column::TYPE_TEXT)->nullable()->add();
		$table->column('number')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('date')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('active')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('lastchange_date')->type(Column::TYPE_INT)->size(0)->add();
		$table->column('lastchange_userid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('publish')->type(Column::TYPE_INT)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('pageid', 'page', 'id');
		$table->addConstraint('elementid', 'element', 'id');
		$table->addConstraint('languageid', 'language', 'id');
		$table->addConstraint('lastchange_userid', 'user', 'id');
		$table->addConstraint('linkobjectid', 'object', 'id');
		
		$table->addIndex('pageid');
		$table->addIndex('languageid');
		$table->addIndex('elementid');
		$table->addIndex('active');
		$table->addIndex('lastchange_date');
		$table->addIndex('publish');
		
		
		
		
		
		$table = $this->table('acl')->add();
		$table->column('userid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('groupid')->type(Column::TYPE_INT)->nullable()->add();
		$table->column('objectid')->type(Column::TYPE_INT)->add();
		$table->column('languageid')->type(Column::TYPE_INT)->size(0)->nullable()->add();
		$table->column('is_write')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_prop')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_create_folder')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_create_file')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_create_link')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_create_page')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_delete')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_release')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_publish')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_grant')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->column('is_transmit')->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();
		$table->addPrimaryKey('id');
		$table->addConstraint('groupid', 'group', 'id');
		$table->addConstraint('userid', 'user', 'id');
		$table->addConstraint('objectid', 'object', 'id');
		$table->addConstraint('languageid', 'language', 'id');
		
		$table->addIndex('userid');
		$table->addIndex('groupid');
		$table->addIndex('languageid');
		$table->addIndex('objectid');
		$table->addIndex('is_transmit');

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

<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Install RBAC scheme
 * - groups in groups
 * - roles in roles
 * - group-role assocication
 *
 * @author Jan Dankert
 *
 */
class DBVersion000024 extends DbVersion
{
    /**
     * Create table 'role' and some other changes for RBAC.
     */
    public function update()
    {

        $groupTable = $this->table('group');
		$groupTable->column('parentid')->type(Column::TYPE_INT )->nullable()->add();

        $roleTable = $this->table('role')->add();
		$roleTable->column('parentid')->type(Column::TYPE_INT    )->nullable()->add();
		$roleTable->column('name'    )->type(Column::TYPE_VARCHAR)->size(100)->add();
		$roleTable->addPrimaryKey('id');
		$roleTable->addUniqueIndex('name');

		$groupRoleTable = $this->table('grouprole')->add();
		$groupRoleTable->column('groupid')->type(Column::TYPE_INT)->add();
		$groupRoleTable->column('roleid' )->type(Column::TYPE_INT)->add();
		$groupRoleTable->addPrimaryKey('id');
		$groupRoleTable->addConstraint('groupid', 'group', 'id');
		$groupRoleTable->addConstraint('roleid' , 'role' , 'id');
		$groupRoleTable->addIndex('groupid');
		$groupRoleTable->addIndex('roleid' );
		$groupRoleTable->addUniqueIndex(['roleid','groupid']);

		$db = $this->getDb();
		$stmt = $db->sql('SELECT id,name FROM {{group}}');
		foreach( $stmt->getAssoc() as $id => $name ) {
			$stmt = $db->sql('INSERT INTO {{role}} VALUES(NULL,{id},{name})');
			$stmt->setInt( $id );
			$stmt->setString( $name );
			$stmt->execute();

			$stmt = $db->sql('INSERT INTO {{grouprole}} VALUES({id},{id},{id})');
			$stmt->setInt( $id );
			$stmt->execute();
		}

		// Upgrade table ACL: only roleid is necessary from now.
		$aclTable = $this->table('acl');
		$aclTable->column('roleid')->type(Column::TYPE_INT    )->nullable()->add();

		$db->sql('DELETE FROM {{acl}} WHERE groupid IS NULL')->execute();
		$db->sql('UPDATE {{acl}} SET roleid=groupid')->execute();

		$aclTable->column('userid')->drop();
		$aclTable->column('groupid')->drop();
	}
}


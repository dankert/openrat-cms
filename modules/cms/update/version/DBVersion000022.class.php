<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * External user ids from sso services like openid.
 * The user name alone is not unique any more
 *
 * @author Jan Dankert
 *
 */
class DBVersion000022 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $table = $this->table('user');

        $table->column('ldap_dn'    )->drop();

        $table->column('auth_type'  )->type(Column::TYPE_INT )->size(2)->defaultValue(1 )->add();
        $table->column('issuer'     )->type(Column::TYPE_VARCHAR )->size(50)->nullable()->add();
		$table->dropUniqueIndex( ['name'] );
		$table->addUniqueIndex ( ['name','auth_type','issuer'] );

		// OpenId subject identifiers may have up to 255 chars, so we have to increase the length
        $table->column('name'       )->type(Column::TYPE_VARCHAR )->size(255)->modify();
        $table->column('fullname'   )->type(Column::TYPE_VARCHAR )->size(255)->modify();

    }
}


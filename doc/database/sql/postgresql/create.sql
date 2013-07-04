-- DDL-Script for postgresql

-- Table node
CREATE TABLE or_node(
   id INTEGER NOT NULL
  ,type INTEGER NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,left INTEGER NOT NULL
  ,right INTEGER NOT NULL
  ,order INTEGER NOT NULL
  ,lastmodified DATE NOT NULL
  ,lastmodified_user INTEGER NOT NULL
  ,creation DATE NOT NULL
  ,creation_user INTEGER NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_node_name
                 ON or_node (name);
CREATE INDEX or_idx_node_type
          ON or_node (type);
CREATE INDEX or_idx_node_left
          ON or_node (left);
CREATE INDEX or_idx_node_right
          ON or_node (right);
CREATE INDEX or_idx_node_order
          ON or_node (order);

-- Table prop
CREATE TABLE or_prop(
   id INTEGER NOT NULL
  ,type INTEGER NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,label VARCHAR(255) NOT NULL
);

-- Table props
CREATE TABLE or_props(
   node INTEGER NOT NULL
  ,prop INTEGER NOT NULL
  ,value VARCHAR(255) NOT NULL
);

-- Table target
CREATE TABLE or_target(
   node INTEGER NOT NULL
  ,type INTEGER NOT NULL
  ,hostname VARCHAR(255) NOT NULL
  ,path VARCHAR(255) NOT NULL
  ,mask INTEGER NOT NULL
  ,CONSTRAINT or_fk_target_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table url
CREATE TABLE or_url(
   node INTEGER NOT NULL
  ,url VARCHAR(255) NOT NULL
  ,CONSTRAINT or_fk_url_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table link
CREATE TABLE or_link(
   node INTEGER NOT NULL
  ,targetnode INTEGER NOT NULL DEFAULT 0
  ,CONSTRAINT or_fk_link_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_link_targetnode
     FOREIGN KEY (targetnode) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_link_node
                 ON or_link (node);
CREATE INDEX or_idx_link_targetnode
          ON or_link (targetnode);

-- Table user
CREATE TABLE or_user(
   node INTEGER NOT NULL
  ,label VARCHAR(128) NOT NULL
  ,password VARCHAR(255) NOT NULL
  ,dn VARCHAR(255) NOT NULL
  ,fullname VARCHAR(128) NOT NULL
  ,tel VARCHAR(128) NOT NULL
  ,mail VARCHAR(255) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,style VARCHAR(64) NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_user_name
                 ON or_user (name);

-- Table group
CREATE TABLE or_group(
   node INTEGER NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_group_name
                 ON or_group (name);

-- Table usergroup
CREATE TABLE or_usergroup(
   userid INTEGER NOT NULL
  ,groupid INTEGER NOT NULL
  ,CONSTRAINT or_fk_usergroup_groupid
     FOREIGN KEY (groupid) REFERENCES or_group (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_usergroup_userid
     FOREIGN KEY (userid) REFERENCES or_user (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_usergroup_groupid
          ON or_usergroup (groupid);
CREATE INDEX or_idx_usergroup_userid
          ON or_usergroup (userid);
CREATE UNIQUE INDEX or_uidx_usergroup_userid_groupid
                 ON or_usergroup (userid,groupid);

-- Table acl
CREATE TABLE or_acl(
   node INTEGER NOT NULL
  ,userid INTEGER NULL
  ,groupid INTEGER NULL
  ,variant INTEGER NULL DEFAULT 0
  ,mask INTEGER NOT NULL DEFAULT 0
  ,CONSTRAINT or_fk_acl_groupid
     FOREIGN KEY (groupid) REFERENCES or_group (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_userid
     FOREIGN KEY (userid) REFERENCES or_user (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_acl_userid
          ON or_acl (userid);
CREATE INDEX or_idx_acl_groupid
          ON or_acl (groupid);
CREATE INDEX or_idx_acl_variantid
          ON or_acl (variantid);
CREATE INDEX or_idx_acl_node
          ON or_acl (node);

-- Table variant
CREATE TABLE or_variant(
   node INTEGER NOT NULL
  ,type INTEGER NOT NULL
  ,default INTEGER NOT NULL
  ,iso VARCHAR(255) NOT NULL
  ,extension VARCHAR(255) NOT NULL
);

-- Table page
CREATE TABLE or_page(
   node INTEGER NOT NULL
  ,templateid INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_page_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table template
CREATE TABLE or_template(
   node INTEGER NOT NULL
  ,projectnode INTEGER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_template_projectnode
     FOREIGN KEY (projectnode) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_template_projectid
          ON or_template (projectid);
CREATE INDEX or_idx_template_name
          ON or_template (name);
CREATE UNIQUE INDEX or_uidx_template_projectid_name
                 ON or_template (projectid,name);

-- Table element
CREATE TABLE or_element(
   id INTEGER NOT NULL
  ,templateid INTEGER NOT NULL DEFAULT 0
  ,name VARCHAR(50) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,type VARCHAR(20) NOT NULL
  ,subtype VARCHAR(20) NULL
  ,with_icon INTEGER(1) NOT NULL DEFAULT 0
  ,dateformat VARCHAR(100) NULL
  ,wiki INTEGER(1) NULL DEFAULT 0
  ,html INTEGER(1) NULL DEFAULT 0
  ,all_languages INTEGER(1) NOT NULL DEFAULT 0
  ,writable INTEGER(1) NOT NULL DEFAULT 0
  ,decimals INTEGER NULL DEFAULT 0
  ,dec_point VARCHAR(5) NULL
  ,thousand_sep VARCHAR(1) NULL
  ,code TEXT NULL
  ,default_text TEXT NULL
  ,folderobjectid INTEGER NULL
  ,default_objectid INTEGER NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_element_default_objectid
     FOREIGN KEY (default_objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_element_folderobjectid
     FOREIGN KEY (folderobjectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_element_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_element_templateid
          ON or_element (templateid);
CREATE INDEX or_idx_element_name
          ON or_element (name);
CREATE UNIQUE INDEX or_uidx_element_templateid_name
                 ON or_element (templateid,name);

-- Table file
CREATE TABLE or_file(
   node INTEGER NOT NULL
  ,extension VARCHAR(10) NOT NULL
  ,size INTEGER NOT NULL DEFAULT 0
  ,width INTEGER NOT NULL
  ,height INTEGER NOT NULL
  ,value TEXT NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_file_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_file_objectid
                 ON or_file (objectid);

-- Table name
CREATE TABLE or_name(
   node INTEGER NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,variant INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_name_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table templatemodel
CREATE TABLE or_templatemodel(
   id INTEGER NOT NULL
  ,templateid INTEGER NOT NULL DEFAULT 0
  ,projectmodelid INTEGER NOT NULL DEFAULT 0
  ,extension VARCHAR(10) NULL
  ,text TEXT NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_templatemodel_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_templatemodel_projectmodelid
     FOREIGN KEY (projectmodelid) REFERENCES or_projectmodel (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_templatemodel_templateid
          ON or_templatemodel (templateid);
CREATE UNIQUE INDEX or_uidx_templatemodel_templateid_extension
                 ON or_templatemodel (templateid,extension);
CREATE UNIQUE INDEX or_uidx_templatemodel_templateid_projectmodelid
                 ON or_templatemodel (templateid,projectmodelid);

-- Table value
CREATE TABLE or_value(
   id INTEGER NOT NULL
  ,pageid INTEGER NOT NULL DEFAULT 0
  ,languageid INTEGER NOT NULL
  ,elementid INTEGER NOT NULL DEFAULT 0
  ,linkobjectid INTEGER NULL
  ,text TEXT NULL
  ,number INTEGER NULL
  ,date INTEGER NULL
  ,active INTEGER NOT NULL DEFAULT 0
  ,publish INTEGER NOT NULL
  ,lastchange_date INTEGER NOT NULL DEFAULT 0
  ,lastchange_userid INTEGER NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_value_pageid
     FOREIGN KEY (pageid) REFERENCES or_page (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_elementid
     FOREIGN KEY (elementid) REFERENCES or_element (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_languageid
     FOREIGN KEY (languageid) REFERENCES or_language (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_lastchange_userid
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_linkobjectid
     FOREIGN KEY (linkobjectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_value_pageid
          ON or_value (pageid);
CREATE INDEX or_idx_value_languageid
          ON or_value (languageid);
CREATE INDEX or_idx_value_elementid
          ON or_value (elementid);
CREATE INDEX or_idx_value_active
          ON or_value (active);
CREATE INDEX or_idx_value_lastchange_date
          ON or_value (lastchange_date);
CREATE INDEX or_idx_value_publish
          ON or_value (publish);
INSERT INTO or_user (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Admin user','default',1);

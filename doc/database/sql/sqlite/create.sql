-- DDL-Script for sqlite

-- Table project
CREATE TABLE or_project(
   id INTEGER NOT NULL
  ,name VARCHAR(128) NOT NULL
  ,target_dir VARCHAR(255) NOT NULL
  ,ftp_url VARCHAR(255) NOT NULL
  ,ftp_passive INTEGER(1) NOT NULL DEFAULT 0
  ,cmd_after_publish VARCHAR(255) NOT NULL
  ,content_negotiation INTEGER(1) NOT NULL DEFAULT 0
  ,cut_index INTEGER(1) NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_project_name
                 ON or_project (name);

-- Table user
CREATE TABLE or_user(
   id INTEGER NOT NULL
  ,name VARCHAR(128) NOT NULL
  ,password VARCHAR(50) NOT NULL
  ,ldap_dn VARCHAR(255) NOT NULL
  ,fullname VARCHAR(128) NOT NULL
  ,tel VARCHAR(128) NOT NULL
  ,mail VARCHAR(255) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,style VARCHAR(64) NOT NULL
  ,is_admin INTEGER(1) NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_user_name
                 ON or_user (name);

-- Table group
CREATE TABLE or_group(
   id INTEGER NOT NULL
  ,name VARCHAR(100) NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_group_name
                 ON or_group (name);

-- Table object
CREATE TABLE or_object(
   id INTEGER NOT NULL
  ,parentid INTEGER NULL
  ,projectid INTEGER NOT NULL DEFAULT 0
  ,filename VARCHAR(255) NOT NULL
  ,orderid INTEGER NOT NULL DEFAULT 0
  ,create_date INTEGER NOT NULL DEFAULT 0
  ,create_userid INTEGER NULL DEFAULT 0
  ,lastchange_date INTEGER NOT NULL DEFAULT 0
  ,lastchange_userid INTEGER NULL DEFAULT 0
  ,is_folder INTEGER(1) NOT NULL
  ,is_file INTEGER(1) NOT NULL
  ,is_page INTEGER(1) NOT NULL
  ,is_link INTEGER(1) NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_object_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_object_lastchange_userid
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_object_create_userid
     FOREIGN KEY (create_userid) REFERENCES or_user (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_object_parentid
          ON or_object (parentid);
CREATE INDEX or_idx_object_projectid
          ON or_object (projectid);
CREATE INDEX or_idx_object_is_folder
          ON or_object (is_folder);
CREATE INDEX or_idx_object_is_file
          ON or_object (is_file);
CREATE INDEX or_idx_object_is_page
          ON or_object (is_page);
CREATE INDEX or_idx_object_is_link
          ON or_object (is_link);
CREATE INDEX or_idx_object_orderid
          ON or_object (orderid);
CREATE INDEX or_idx_object_create_userid
          ON or_object (create_userid);
CREATE INDEX or_idx_object_lastchange_userid
          ON or_object (lastchange_userid);
CREATE UNIQUE INDEX or_uidx_object_parentid_filename
                 ON or_object (parentid,filename);

-- Table template
CREATE TABLE or_template(
   id INTEGER NOT NULL
  ,projectid INTEGER NOT NULL
  ,name VARCHAR(50) NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_template_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_template_projectid
          ON or_template (projectid);
CREATE INDEX or_idx_template_name
          ON or_template (name);
CREATE UNIQUE INDEX or_uidx_template_projectid_name
                 ON or_template (projectid,name);

-- Table language
CREATE TABLE or_language(
   id INTEGER NOT NULL
  ,projectid INTEGER NOT NULL DEFAULT 0
  ,isocode VARCHAR(10) NOT NULL
  ,name VARCHAR(50) NOT NULL
  ,is_default INTEGER(1) NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_language_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_language_projectid_isocode
                 ON or_language (projectid,isocode);

-- Table page
CREATE TABLE or_page(
   id INTEGER NOT NULL
  ,objectid INTEGER NOT NULL DEFAULT 0
  ,templateid INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_page_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_page_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_page_objectid
                 ON or_page (objectid);
CREATE INDEX or_idx_page_templateid
          ON or_page (templateid);

-- Table projectmodel
CREATE TABLE or_projectmodel(
   id INTEGER NOT NULL
  ,projectid INTEGER NOT NULL DEFAULT 0
  ,name VARCHAR(50) NOT NULL
  ,extension VARCHAR(10) NULL
  ,is_default INTEGER(1) NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_projectmodel_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_projectmodel_projectid
          ON or_projectmodel (projectid);
CREATE UNIQUE INDEX or_uidx_projectmodel_projectid_name
                 ON or_projectmodel (projectid,name);

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
   id INTEGER NOT NULL
  ,objectid INTEGER NOT NULL DEFAULT 0
  ,extension VARCHAR(10) NOT NULL
  ,size INTEGER NOT NULL DEFAULT 0
  ,value TEXT NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_file_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_file_objectid
                 ON or_file (objectid);

-- Table folder
CREATE TABLE or_folder(
   id INTEGER NOT NULL
  ,objectid INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_folder_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_folder_objectid
                 ON or_folder (objectid);

-- Table link
CREATE TABLE or_link(
   id INTEGER NOT NULL
  ,objectid INTEGER NOT NULL DEFAULT 0
  ,link_objectid INTEGER NULL
  ,url VARCHAR(255) NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_link_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_link_link_objectid
     FOREIGN KEY (link_objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX or_uidx_link_objectid
                 ON or_link (objectid);
CREATE INDEX or_idx_link_link_objectid
          ON or_link (link_objectid);

-- Table name
CREATE TABLE or_name(
   id INTEGER NOT NULL
  ,objectid INTEGER NOT NULL DEFAULT 0
  ,name VARCHAR(255) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,languageid INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_name_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_name_languageid
     FOREIGN KEY (languageid) REFERENCES or_language (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_name_objectid
          ON or_name (objectid);
CREATE INDEX or_idx_name_languageid
          ON or_name (languageid);
CREATE UNIQUE INDEX or_uidx_name_objectid_languageid
                 ON or_name (objectid,languageid);

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

-- Table usergroup
CREATE TABLE or_usergroup(
   id INTEGER NOT NULL
  ,userid INTEGER NOT NULL
  ,groupid INTEGER NOT NULL
  ,PRIMARY KEY (id)
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

-- Table acl
CREATE TABLE or_acl(
   id INTEGER NOT NULL
  ,userid INTEGER NULL
  ,groupid INTEGER NULL
  ,objectid INTEGER NOT NULL
  ,languageid INTEGER NULL DEFAULT 0
  ,is_write INTEGER(1) NOT NULL DEFAULT 0
  ,is_prop INTEGER(1) NOT NULL DEFAULT 0
  ,is_create_folder INTEGER(1) NOT NULL DEFAULT 0
  ,is_create_file INTEGER(1) NOT NULL DEFAULT 0
  ,is_create_link INTEGER(1) NOT NULL DEFAULT 0
  ,is_create_page INTEGER(1) NOT NULL DEFAULT 0
  ,is_delete INTEGER(1) NOT NULL DEFAULT 0
  ,is_release INTEGER(1) NOT NULL DEFAULT 0
  ,is_publish INTEGER(1) NOT NULL DEFAULT 0
  ,is_grant INTEGER(1) NOT NULL DEFAULT 0
  ,is_transmit INTEGER(1) NOT NULL DEFAULT 0
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_acl_groupid
     FOREIGN KEY (groupid) REFERENCES or_group (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_userid
     FOREIGN KEY (userid) REFERENCES or_user (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_languageid
     FOREIGN KEY (languageid) REFERENCES or_language (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_acl_userid
          ON or_acl (userid);
CREATE INDEX or_idx_acl_groupid
          ON or_acl (groupid);
CREATE INDEX or_idx_acl_languageid
          ON or_acl (languageid);
CREATE INDEX or_idx_acl_objectid
          ON or_acl (objectid);
CREATE INDEX or_idx_acl_is_transmit
          ON or_acl (is_transmit);
INSERT INTO or_user (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Admin user','default',1)

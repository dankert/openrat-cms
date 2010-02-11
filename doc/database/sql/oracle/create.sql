-- DDL-Script for oracle

-- Table project
CREATE TABLE or_project(
   "ID" NUMBER NOT NULL
  ,"NAME" VARCHAR(128) NOT NULL
  ,"TARGET_DIR" VARCHAR(255) NOT NULL
  ,"FTP_URL" VARCHAR(255) NOT NULL
  ,"FTP_PASSIVE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"CMD_AFTER_PUBLISH" VARCHAR(255) NOT NULL
  ,"CONTENT_NEGOTIATION" NUMBER(1) DEFAULT 0 NOT NULL
  ,"CUT_INDEX" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_project_name
                 ON or_project (name);

-- Table user
CREATE TABLE or_user(
   "ID" NUMBER NOT NULL
  ,"NAME" VARCHAR(128) NOT NULL
  ,"PASSWORD" VARCHAR(50) NOT NULL
  ,"LDAP_DN" VARCHAR(255) NOT NULL
  ,"FULLNAME" VARCHAR(128) NOT NULL
  ,"TEL" VARCHAR(128) NOT NULL
  ,"MAIL" VARCHAR(255) NOT NULL
  ,"DESCR" VARCHAR(255) NOT NULL
  ,"STYLE" VARCHAR(64) NOT NULL
  ,"IS_ADMIN" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_user_name
                 ON or_user (name);

-- Table group
CREATE TABLE or_group(
   "ID" NUMBER NOT NULL
  ,"NAME" VARCHAR(100) NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_group_name
                 ON or_group (name);

-- Table object
CREATE TABLE or_object(
   "ID" NUMBER NOT NULL
  ,"PARENTID" NUMBER NULL
  ,"PROJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"FILENAME" VARCHAR(255) NOT NULL
  ,"ORDERID" NUMBER DEFAULT 0 NOT NULL
  ,"CREATE_DATE" NUMBER DEFAULT 0 NOT NULL
  ,"CREATE_USERID" NUMBER DEFAULT 0 NULL
  ,"LASTCHANGE_DATE" NUMBER DEFAULT 0 NOT NULL
  ,"LASTCHANGE_USERID" NUMBER DEFAULT 0 NULL
  ,"IS_FOLDER" NUMBER(1) NOT NULL
  ,"IS_FILE" NUMBER(1) NOT NULL
  ,"IS_PAGE" NUMBER(1) NOT NULL
  ,"IS_LINK" NUMBER(1) NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_object_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
  ,CONSTRAINT or_fk_object_lastchange_userid
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_object_create_userid
     FOREIGN KEY (create_userid) REFERENCES or_user (id)
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
   "ID" NUMBER NOT NULL
  ,"PROJECTID" NUMBER NOT NULL
  ,"NAME" VARCHAR(50) NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_template_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
);
CREATE INDEX or_idx_template_projectid
          ON or_template (projectid);
CREATE INDEX or_idx_template_name
          ON or_template (name);
CREATE UNIQUE INDEX or_uidx_template_projectid_name
                 ON or_template (projectid,name);

-- Table language
CREATE TABLE or_language(
   "ID" NUMBER NOT NULL
  ,"PROJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"ISOCODE" VARCHAR(10) NOT NULL
  ,"NAME" VARCHAR(50) NOT NULL
  ,"IS_DEFAULT" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_language_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
);
CREATE UNIQUE INDEX or_uidx_language_projectid_isocode
                 ON or_language (projectid,isocode);

-- Table page
CREATE TABLE or_page(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_page_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
  ,CONSTRAINT or_fk_page_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_page_objectid
                 ON or_page (objectid);
CREATE INDEX or_idx_page_templateid
          ON or_page (templateid);

-- Table projectmodel
CREATE TABLE or_projectmodel(
   "ID" NUMBER NOT NULL
  ,"PROJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"NAME" VARCHAR(50) NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"IS_DEFAULT" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_projectmodel_projectid
     FOREIGN KEY (projectid) REFERENCES or_project (id)
);
CREATE INDEX or_idx_projectmodel_projectid
          ON or_projectmodel (projectid);
CREATE UNIQUE INDEX or_uidx_projectmodel_projectid_name
                 ON or_projectmodel (projectid,name);

-- Table element
CREATE TABLE or_element(
   "ID" NUMBER NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,"NAME" VARCHAR(50) NOT NULL
  ,"DESCR" VARCHAR(255) NOT NULL
  ,"TYPE" VARCHAR(20) NOT NULL
  ,"SUBTYPE" VARCHAR(20) NULL
  ,"WITH_ICON" NUMBER(1) DEFAULT 0 NOT NULL
  ,"DATEFORMAT" VARCHAR(100) NULL
  ,"WIKI" NUMBER(1) DEFAULT 0 NULL
  ,"HTML" NUMBER(1) DEFAULT 0 NULL
  ,"ALL_LANGUAGES" NUMBER(1) DEFAULT 0 NOT NULL
  ,"WRITABLE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"DECIMALS" NUMBER DEFAULT 0 NULL
  ,"DEC_POINT" VARCHAR(5) NULL
  ,"THOUSAND_SEP" VARCHAR(1) NULL
  ,"CODE" CLOB NULL
  ,"DEFAULT_TEXT" CLOB NULL
  ,"FOLDEROBJECTID" NUMBER NULL
  ,"DEFAULT_OBJECTID" NUMBER NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_element_default_objectid
     FOREIGN KEY (default_objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_element_folderobjectid
     FOREIGN KEY (folderobjectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_element_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
);
CREATE INDEX or_idx_element_templateid
          ON or_element (templateid);
CREATE INDEX or_idx_element_name
          ON or_element (name);
CREATE UNIQUE INDEX or_uidx_element_templateid_name
                 ON or_element (templateid,name);

-- Table file
CREATE TABLE or_file(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"EXTENSION" VARCHAR(10) NOT NULL
  ,"SIZE" NUMBER DEFAULT 0 NOT NULL
  ,"VALUE" TEXT NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_file_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_file_objectid
                 ON or_file (objectid);

-- Table folder
CREATE TABLE or_folder(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_folder_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_folder_objectid
                 ON or_folder (objectid);

-- Table link
CREATE TABLE or_link(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"LINK_OBJECTID" NUMBER NULL
  ,"URL" VARCHAR(255) NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_link_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_link_link_objectid
     FOREIGN KEY (link_objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_link_objectid
                 ON or_link (objectid);
CREATE INDEX or_idx_link_link_objectid
          ON or_link (link_objectid);

-- Table name
CREATE TABLE or_name(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"NAME" VARCHAR(255) NOT NULL
  ,"DESCR" VARCHAR(255) NOT NULL
  ,"LANGUAGEID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_name_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_name_languageid
     FOREIGN KEY (languageid) REFERENCES or_language (id)
);
CREATE INDEX or_idx_name_objectid
          ON or_name (objectid);
CREATE INDEX or_idx_name_languageid
          ON or_name (languageid);
CREATE UNIQUE INDEX or_uidx_name_objectid_languageid
                 ON or_name (objectid,languageid);

-- Table templatemodel
CREATE TABLE or_templatemodel(
   "ID" NUMBER NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,"PROJECTMODELID" NUMBER DEFAULT 0 NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"TEXT" CLOB NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_templatemodel_templateid
     FOREIGN KEY (templateid) REFERENCES or_template (id)
  ,CONSTRAINT or_fk_templatemodel_projectmodelid
     FOREIGN KEY (projectmodelid) REFERENCES or_projectmodel (id)
);
CREATE INDEX or_idx_templatemodel_templateid
          ON or_templatemodel (templateid);
CREATE UNIQUE INDEX or_uidx_templatemodel_templateid_extension
                 ON or_templatemodel (templateid,extension);
CREATE UNIQUE INDEX or_uidx_templatemodel_templateid_projectmodelid
                 ON or_templatemodel (templateid,projectmodelid);

-- Table usergroup
CREATE TABLE or_usergroup(
   "ID" NUMBER NOT NULL
  ,"USERID" NUMBER NOT NULL
  ,"GROUPID" NUMBER NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_usergroup_groupid
     FOREIGN KEY (groupid) REFERENCES or_group (id)
  ,CONSTRAINT or_fk_usergroup_userid
     FOREIGN KEY (userid) REFERENCES or_user (id)
);
CREATE INDEX or_idx_usergroup_groupid
          ON or_usergroup (groupid);
CREATE INDEX or_idx_usergroup_userid
          ON or_usergroup (userid);
CREATE UNIQUE INDEX or_uidx_usergroup_userid_groupid
                 ON or_usergroup (userid,groupid);

-- Table value
CREATE TABLE or_value(
   "ID" NUMBER NOT NULL
  ,"PAGEID" NUMBER DEFAULT 0 NOT NULL
  ,"LANGUAGEID" NUMBER NOT NULL
  ,"ELEMENTID" NUMBER DEFAULT 0 NOT NULL
  ,"LINKOBJECTID" NUMBER NULL
  ,"TEXT" CLOB NULL
  ,"NUMBER" NUMBER NULL
  ,"DATE" NUMBER NULL
  ,"ACTIVE" NUMBER DEFAULT 0 NOT NULL
  ,"PUBLISH" NUMBER NOT NULL
  ,"LASTCHANGE_DATE" NUMBER DEFAULT 0 NOT NULL
  ,"LASTCHANGE_USERID" NUMBER NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_value_pageid
     FOREIGN KEY (pageid) REFERENCES or_page (id)
  ,CONSTRAINT or_fk_value_elementid
     FOREIGN KEY (elementid) REFERENCES or_element (id)
  ,CONSTRAINT or_fk_value_languageid
     FOREIGN KEY (languageid) REFERENCES or_language (id)
  ,CONSTRAINT or_fk_value_lastchange_userid
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_value_linkobjectid
     FOREIGN KEY (linkobjectid) REFERENCES or_object (id)
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
   "ID" NUMBER NOT NULL
  ,"USERID" NUMBER NULL
  ,"GROUPID" NUMBER NULL
  ,"OBJECTID" NUMBER NOT NULL
  ,"LANGUAGEID" NUMBER DEFAULT 0 NULL
  ,"IS_WRITE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_PROP" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_CREATE_FOLDER" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_CREATE_FILE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_CREATE_LINK" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_CREATE_PAGE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_DELETE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_RELEASE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_PUBLISH" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_GRANT" NUMBER(1) DEFAULT 0 NOT NULL
  ,"IS_TRANSMIT" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_acl_groupid
     FOREIGN KEY (groupid) REFERENCES or_group (id)
  ,CONSTRAINT or_fk_acl_userid
     FOREIGN KEY (userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_acl_objectid
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_acl_languageid
     FOREIGN KEY (languageid) REFERENCES or_language (id)
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

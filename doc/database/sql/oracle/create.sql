-- DDL-Script for oracle

-- Table project
CREATE TABLE or_project(
   "ID" NUMBER NOT NULL
  ,"NAME" VARCHAR(128) NULL
  ,"TARGET_DIR" VARCHAR(255) NULL
  ,"FTP_URL" VARCHAR(255) NULL
  ,"FTP_PASSIVE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"CMD_AFTER_PUBLISH" VARCHAR(255) NULL
  ,"CONTENT_NEGOTIATION" NUMBER(1) DEFAULT 0 NOT NULL
  ,"CUT_INDEX" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_1
                 ON or_project (name);

-- Table user
CREATE TABLE or_user(
   "ID" NUMBER NOT NULL
  ,"NAME" VARCHAR(128) NULL
  ,"PASSWORD" VARCHAR(50) NULL
  ,"LDAP_DN" VARCHAR(255) NULL
  ,"FULLNAME" VARCHAR(128) NULL
  ,"TEL" VARCHAR(128) NULL
  ,"MAIL" VARCHAR(255) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"STYLE" VARCHAR(64) NULL
  ,"IS_ADMIN" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_2
                 ON or_user (name);

-- Table group
CREATE TABLE or_group(
   "ID" NUMBER NOT NULL
  ,"NAME" VARCHAR(100) NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_3
                 ON or_group (name);

-- Table object
CREATE TABLE or_object(
   "ID" NUMBER NOT NULL
  ,"PARENTID" NUMBER NULL
  ,"PROJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"FILENAME" VARCHAR(255) NULL
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
  ,CONSTRAINT or_fk_4
     FOREIGN KEY (projectid) REFERENCES or_project (id)
  ,CONSTRAINT or_fk_5
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_6
     FOREIGN KEY (create_userid) REFERENCES or_user (id)
);
CREATE INDEX or_idx_7
          ON or_object (parentid);
CREATE INDEX or_idx_8
          ON or_object (projectid);
CREATE INDEX or_idx_9
          ON or_object (is_folder);
CREATE INDEX or_idx_10
          ON or_object (is_file);
CREATE INDEX or_idx_11
          ON or_object (is_page);
CREATE INDEX or_idx_12
          ON or_object (is_link);
CREATE INDEX or_idx_13
          ON or_object (orderid);
CREATE INDEX or_idx_14
          ON or_object (create_userid);
CREATE INDEX or_idx_15
          ON or_object (lastchange_userid);
CREATE UNIQUE INDEX or_uidx_16
                 ON or_object (parentid,filename);

-- Table template
CREATE TABLE or_template(
   "ID" NUMBER NOT NULL
  ,"PROJECTID" NUMBER NOT NULL
  ,"NAME" VARCHAR(50) NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_17
     FOREIGN KEY (projectid) REFERENCES or_project (id)
);
CREATE INDEX or_idx_18
          ON or_template (projectid);
CREATE INDEX or_idx_19
          ON or_template (name);
CREATE UNIQUE INDEX or_uidx_20
                 ON or_template (projectid,name);

-- Table language
CREATE TABLE or_language(
   "ID" NUMBER NOT NULL
  ,"PROJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"ISOCODE" VARCHAR(10) NULL
  ,"NAME" VARCHAR(50) NULL
  ,"IS_DEFAULT" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_21
     FOREIGN KEY (projectid) REFERENCES or_project (id)
);
CREATE UNIQUE INDEX or_uidx_22
                 ON or_language (projectid,isocode);

-- Table page
CREATE TABLE or_page(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_23
     FOREIGN KEY (templateid) REFERENCES or_template (id)
  ,CONSTRAINT or_fk_24
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_25
                 ON or_page (objectid);
CREATE INDEX or_idx_26
          ON or_page (templateid);

-- Table projectmodel
CREATE TABLE or_projectmodel(
   "ID" NUMBER NOT NULL
  ,"PROJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"NAME" VARCHAR(50) NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"IS_DEFAULT" NUMBER(1) DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_27
     FOREIGN KEY (projectid) REFERENCES or_project (id)
);
CREATE INDEX or_idx_28
          ON or_projectmodel (projectid);
CREATE UNIQUE INDEX or_uidx_29
                 ON or_projectmodel (projectid,name);

-- Table element
CREATE TABLE or_element(
   "ID" NUMBER NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,"NAME" VARCHAR(50) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"TYPE" VARCHAR(20) NULL
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
  ,CONSTRAINT or_fk_30
     FOREIGN KEY (default_objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_31
     FOREIGN KEY (folderobjectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_32
     FOREIGN KEY (templateid) REFERENCES or_template (id)
);
CREATE INDEX or_idx_33
          ON or_element (templateid);
CREATE INDEX or_idx_34
          ON or_element (name);
CREATE UNIQUE INDEX or_uidx_35
                 ON or_element (templateid,name);

-- Table file
CREATE TABLE or_file(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"SIZE" NUMBER DEFAULT 0 NOT NULL
  ,"VALUE" CLOB NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_36
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_37
                 ON or_file (objectid);

-- Table folder
CREATE TABLE or_folder(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_38
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_39
                 ON or_folder (objectid);

-- Table link
CREATE TABLE or_link(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"LINK_OBJECTID" NUMBER NULL
  ,"URL" VARCHAR(255) NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_40
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_41
     FOREIGN KEY (link_objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_42
                 ON or_link (objectid);
CREATE INDEX or_idx_43
          ON or_link (link_objectid);

-- Table name
CREATE TABLE or_name(
   "ID" NUMBER NOT NULL
  ,"OBJECTID" NUMBER DEFAULT 0 NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"LANGUAGEID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_44
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_45
     FOREIGN KEY (languageid) REFERENCES or_language (id)
);
CREATE INDEX or_idx_46
          ON or_name (objectid);
CREATE INDEX or_idx_47
          ON or_name (languageid);
CREATE UNIQUE INDEX or_uidx_48
                 ON or_name (objectid,languageid);

-- Table templatemodel
CREATE TABLE or_templatemodel(
   "ID" NUMBER NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,"PROJECTMODELID" NUMBER DEFAULT 0 NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"TEXT" CLOB NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_49
     FOREIGN KEY (templateid) REFERENCES or_template (id)
  ,CONSTRAINT or_fk_50
     FOREIGN KEY (projectmodelid) REFERENCES or_projectmodel (id)
);
CREATE INDEX or_idx_51
          ON or_templatemodel (templateid);
CREATE UNIQUE INDEX or_uidx_52
                 ON or_templatemodel (templateid,extension);
CREATE UNIQUE INDEX or_uidx_53
                 ON or_templatemodel (templateid,projectmodelid);

-- Table usergroup
CREATE TABLE or_usergroup(
   "ID" NUMBER NOT NULL
  ,"USERID" NUMBER NOT NULL
  ,"GROUPID" NUMBER NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_54
     FOREIGN KEY (groupid) REFERENCES or_group (id)
  ,CONSTRAINT or_fk_55
     FOREIGN KEY (userid) REFERENCES or_user (id)
);
CREATE INDEX or_idx_56
          ON or_usergroup (groupid);
CREATE INDEX or_idx_57
          ON or_usergroup (userid);
CREATE UNIQUE INDEX or_uidx_58
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
  ,CONSTRAINT or_fk_59
     FOREIGN KEY (pageid) REFERENCES or_page (id)
  ,CONSTRAINT or_fk_60
     FOREIGN KEY (elementid) REFERENCES or_element (id)
  ,CONSTRAINT or_fk_61
     FOREIGN KEY (languageid) REFERENCES or_language (id)
  ,CONSTRAINT or_fk_62
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_63
     FOREIGN KEY (linkobjectid) REFERENCES or_object (id)
);
CREATE INDEX or_idx_64
          ON or_value (pageid);
CREATE INDEX or_idx_65
          ON or_value (languageid);
CREATE INDEX or_idx_66
          ON or_value (elementid);
CREATE INDEX or_idx_67
          ON or_value (active);
CREATE INDEX or_idx_68
          ON or_value (lastchange_date);
CREATE INDEX or_idx_69
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
  ,CONSTRAINT or_fk_70
     FOREIGN KEY (groupid) REFERENCES or_group (id)
  ,CONSTRAINT or_fk_71
     FOREIGN KEY (userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_72
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_73
     FOREIGN KEY (languageid) REFERENCES or_language (id)
);
CREATE INDEX or_idx_74
          ON or_acl (userid);
CREATE INDEX or_idx_75
          ON or_acl (groupid);
CREATE INDEX or_idx_76
          ON or_acl (languageid);
CREATE INDEX or_idx_77
          ON or_acl (objectid);
CREATE INDEX or_idx_78
          ON or_acl (is_transmit);
INSERT INTO or_user (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Admin user','default',1);

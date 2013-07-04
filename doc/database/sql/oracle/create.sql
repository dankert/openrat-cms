-- DDL-Script for oracle

-- Table node
CREATE TABLE or_node(
   "ID" NUMBER NOT NULL
  ,"TYPE" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"LEFT" NUMBER NOT NULL
  ,"RIGHT" NUMBER NOT NULL
  ,"ORDER" NUMBER NOT NULL
  ,"LASTMODIFIED" DATE NOT NULL
  ,"LASTMODIFIED_USER" NUMBER NOT NULL
  ,"CREATION" DATE NOT NULL
  ,"CREATION_USER" NUMBER NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_1
                 ON or_node (name);
CREATE INDEX or_idx_2
          ON or_node (type);
CREATE INDEX or_idx_3
          ON or_node (left);
CREATE INDEX or_idx_4
          ON or_node (right);
CREATE INDEX or_idx_5
          ON or_node (order);

-- Table prop
CREATE TABLE or_prop(
   "ID" NUMBER NOT NULL
  ,"TYPE" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"LABEL" VARCHAR(255) NULL
  ,"LABEL" VARCHAR(255) NULL
);

-- Table props
CREATE TABLE or_props(
   "NODE" NUMBER NOT NULL
  ,"PROP" NUMBER NOT NULL
  ,"VALUE" VARCHAR(255) NULL
);

-- Table target
CREATE TABLE or_target(
   "NODE" NUMBER NOT NULL
  ,"TYPE" NUMBER NOT NULL
  ,"HOSTNAME" VARCHAR(255) NULL
  ,"PATH" VARCHAR(255) NULL
  ,"MASK" NUMBER NOT NULL
  ,CONSTRAINT or_fk_6
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table url
CREATE TABLE or_url(
   "NODE" NUMBER NOT NULL
  ,"URL" VARCHAR(255) NULL
  ,CONSTRAINT or_fk_7
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table link
CREATE TABLE or_link(
   "NODE" NUMBER NOT NULL
  ,"TARGETNODE" NUMBER DEFAULT 0 NOT NULL
  ,CONSTRAINT or_fk_8
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_9
     FOREIGN KEY (targetnode) REFERENCES or_node (id)
);
CREATE UNIQUE INDEX or_uidx_10
                 ON or_link (node);
CREATE INDEX or_idx_11
          ON or_link (targetnode);

-- Table user
CREATE TABLE or_user(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(128) NULL
  ,"PASSWORD" VARCHAR(255) NULL
  ,"DN" VARCHAR(255) NULL
  ,"FULLNAME" VARCHAR(128) NULL
  ,"TEL" VARCHAR(128) NULL
  ,"MAIL" VARCHAR(255) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"STYLE" VARCHAR(64) NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_12
                 ON or_user (name);

-- Table group
CREATE TABLE or_group(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(255) NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_13
                 ON or_group (name);

-- Table usergroup
CREATE TABLE or_usergroup(
   "USERID" NUMBER NOT NULL
  ,"GROUPID" NUMBER NOT NULL
  ,CONSTRAINT or_fk_14
     FOREIGN KEY (groupid) REFERENCES or_group (id)
  ,CONSTRAINT or_fk_15
     FOREIGN KEY (userid) REFERENCES or_user (id)
);
CREATE INDEX or_idx_16
          ON or_usergroup (groupid);
CREATE INDEX or_idx_17
          ON or_usergroup (userid);
CREATE UNIQUE INDEX or_uidx_18
                 ON or_usergroup (userid,groupid);

-- Table acl
CREATE TABLE or_acl(
   "NODE" NUMBER NOT NULL
  ,"USERID" NUMBER NULL
  ,"GROUPID" NUMBER NULL
  ,"VARIANT" NUMBER DEFAULT 0 NULL
  ,"MASK" NUMBER DEFAULT 0 NOT NULL
  ,CONSTRAINT or_fk_19
     FOREIGN KEY (groupid) REFERENCES or_group (id)
  ,CONSTRAINT or_fk_20
     FOREIGN KEY (userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_21
     FOREIGN KEY (objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_22
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);
CREATE INDEX or_idx_23
          ON or_acl (userid);
CREATE INDEX or_idx_24
          ON or_acl (groupid);
CREATE INDEX or_idx_25
          ON or_acl (variantid);
CREATE INDEX or_idx_26
          ON or_acl (node);

-- Table variant
CREATE TABLE or_variant(
   "NODE" NUMBER NOT NULL
  ,"TYPE" NUMBER NOT NULL
  ,"DEFAULT" NUMBER NOT NULL
  ,"ISO" VARCHAR(255) NULL
  ,"EXTENSION" VARCHAR(255) NULL
);

-- Table page
CREATE TABLE or_page(
   "NODE" NUMBER NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_27
     FOREIGN KEY (templateid) REFERENCES or_template (id)
);

-- Table template
CREATE TABLE or_template(
   "NODE" NUMBER NOT NULL
  ,"PROJECTNODE" NUMBER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_28
     FOREIGN KEY (projectnode) REFERENCES or_node (id)
);
CREATE INDEX or_idx_29
          ON or_template (projectid);
CREATE INDEX or_idx_30
          ON or_template (name);
CREATE UNIQUE INDEX or_uidx_31
                 ON or_template (projectid,name);

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
  ,CONSTRAINT or_fk_32
     FOREIGN KEY (default_objectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_33
     FOREIGN KEY (folderobjectid) REFERENCES or_object (id)
  ,CONSTRAINT or_fk_34
     FOREIGN KEY (templateid) REFERENCES or_template (id)
);
CREATE INDEX or_idx_35
          ON or_element (templateid);
CREATE INDEX or_idx_36
          ON or_element (name);
CREATE UNIQUE INDEX or_uidx_37
                 ON or_element (templateid,name);

-- Table file
CREATE TABLE or_file(
   "NODE" NUMBER NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"SIZE" NUMBER DEFAULT 0 NOT NULL
  ,"WIDTH" NUMBER NOT NULL
  ,"HEIGHT" NUMBER NOT NULL
  ,"VALUE" CLOB NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_38
     FOREIGN KEY (objectid) REFERENCES or_object (id)
);
CREATE UNIQUE INDEX or_uidx_39
                 ON or_file (objectid);

-- Table name
CREATE TABLE or_name(
   "NODE" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"VARIANT" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_40
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);

-- Table templatemodel
CREATE TABLE or_templatemodel(
   "ID" NUMBER NOT NULL
  ,"TEMPLATEID" NUMBER DEFAULT 0 NOT NULL
  ,"PROJECTMODELID" NUMBER DEFAULT 0 NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"TEXT" CLOB NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_41
     FOREIGN KEY (templateid) REFERENCES or_template (id)
  ,CONSTRAINT or_fk_42
     FOREIGN KEY (projectmodelid) REFERENCES or_projectmodel (id)
);
CREATE INDEX or_idx_43
          ON or_templatemodel (templateid);
CREATE UNIQUE INDEX or_uidx_44
                 ON or_templatemodel (templateid,extension);
CREATE UNIQUE INDEX or_uidx_45
                 ON or_templatemodel (templateid,projectmodelid);

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
  ,CONSTRAINT or_fk_46
     FOREIGN KEY (pageid) REFERENCES or_page (id)
  ,CONSTRAINT or_fk_47
     FOREIGN KEY (elementid) REFERENCES or_element (id)
  ,CONSTRAINT or_fk_48
     FOREIGN KEY (languageid) REFERENCES or_language (id)
  ,CONSTRAINT or_fk_49
     FOREIGN KEY (lastchange_userid) REFERENCES or_user (id)
  ,CONSTRAINT or_fk_50
     FOREIGN KEY (linkobjectid) REFERENCES or_object (id)
);
CREATE INDEX or_idx_51
          ON or_value (pageid);
CREATE INDEX or_idx_52
          ON or_value (languageid);
CREATE INDEX or_idx_53
          ON or_value (elementid);
CREATE INDEX or_idx_54
          ON or_value (active);
CREATE INDEX or_idx_55
          ON or_value (lastchange_date);
CREATE INDEX or_idx_56
          ON or_value (publish);
INSERT INTO or_user (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Admin user','default',1);

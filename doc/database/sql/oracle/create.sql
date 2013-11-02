-- DDL-Script for oracle

-- Table node
CREATE TABLE or_node(
   "ID" NUMBER NOT NULL
  ,"TYP" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"HASH" VARCHAR(255) NULL
  ,"LFT" NUMBER NOT NULL
  ,"RGT" NUMBER NOT NULL
  ,"LASTMODIFIED" DATE NOT NULL
  ,"LASTMODIFIED_USER" NUMBER NOT NULL
  ,"CREATION" DATE NOT NULL
  ,"CREATION_USER" NUMBER NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_1
                 ON or_node (lft,rgt);
CREATE UNIQUE INDEX or_uidx_2
                 ON or_node (hash);
CREATE INDEX or_idx_3
          ON or_node (typ);
CREATE INDEX or_idx_4
          ON or_node (lft);
CREATE INDEX or_idx_5
          ON or_node (rgt);

-- Table hnode
CREATE TABLE or_hnode(
   "ID" NUMBER NOT NULL
  ,"NODE" NUMBER NOT NULL
  ,"VERSION" NUMBER NOT NULL
  ,"ACTUAL" NUMBER NOT NULL
  ,"CREATION" DATE NOT NULL
  ,"CREATION_USER" NUMBER NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_6
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table vnode
CREATE TABLE or_vnode(
   "ID" NUMBER NOT NULL
  ,"NODE" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_7
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_8
     FOREIGN KEY (variant) REFERENCES or_node (id)
);

-- Table project
CREATE TABLE or_project(
   "NODE" NUMBER NOT NULL
  ,"HOSTNAME" VARCHAR(255) NULL
  ,CONSTRAINT or_fk_9
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,PRIMARY KEY (node)
);

-- Table prop
CREATE TABLE or_prop(
   "ID" NUMBER NOT NULL
  ,"TYP" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
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
  ,"TYP" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,"HOSTNAME" VARCHAR(255) NULL
  ,"PATH" VARCHAR(255) NULL
  ,"CONFIG" NUMBER NOT NULL
  ,"SCRIPT" VARCHAR(255) NULL
  ,"USER" VARCHAR(255) NULL
  ,"PASSWORD" VARCHAR(255) NULL
  ,CONSTRAINT or_fk_10
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table meta_keys
CREATE TABLE or_meta_keys(
   "NAME" NUMBER NOT NULL
  ,"TYP" NUMBER NOT NULL
);

-- Table meta_values
CREATE TABLE or_meta_values(
   "NODE" NUMBER NOT NULL
  ,"META_KEY" NUMBER NOT NULL
  ,"LANGUAGE" NUMBER NOT NULL
  ,"VALUE_TEXT" VARCHAR(255) NULL
  ,"VALUE_DATE" DATE NOT NULL
  ,CONSTRAINT or_fk_11
     FOREIGN KEY (node) REFERENCES or_node (id)
);
CREATE UNIQUE INDEX or_uidx_12
                 ON or_meta_values (node);

-- Table url
CREATE TABLE or_url(
   "NODE" NUMBER NOT NULL
  ,"URL" VARCHAR(255) NULL
  ,CONSTRAINT or_fk_13
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table file
CREATE TABLE or_file(
   "NODE" NUMBER NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"SIZE" NUMBER DEFAULT 0 NOT NULL
  ,"WIDTH" NUMBER NOT NULL
  ,"HEIGHT" NUMBER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_14
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table folder
CREATE TABLE or_folder(
   "NODE" NUMBER NOT NULL
  ,"ORDER_TYPE" NUMBER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_15
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table file_value
CREATE TABLE or_file_value(
   "NODE" NUMBER NOT NULL
  ,"VALUE" CLOB NOT NULL
  ,"STATUS" NUMBER NOT NULL
  ,"CREATION" DATE NOT NULL
  ,"CREATION_USER" NUMBER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_16
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table link
CREATE TABLE or_link(
   "NODE" NUMBER NOT NULL
  ,"TARGETNODE" NUMBER NOT NULL
  ,CONSTRAINT or_fk_17
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_18
     FOREIGN KEY (targetnode) REFERENCES or_node (id)
);
CREATE UNIQUE INDEX or_uidx_19
                 ON or_link (node);
CREATE INDEX or_idx_20
          ON or_link (targetnode);

-- Table user
CREATE TABLE or_user(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(128) NULL
  ,"PASSWORD" VARCHAR(255) NULL
  ,"ALGO" NUMBER NOT NULL
  ,"EXPIRES" DATE NOT NULL
  ,"LAST_LOGIN" DATE NOT NULL
  ,"DN" VARCHAR(255) NULL
  ,"FULLNAME" VARCHAR(128) NULL
  ,"TEL" VARCHAR(128) NULL
  ,"MAIL" VARCHAR(255) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"STYLE" VARCHAR(64) NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_21
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table token
CREATE TABLE or_token(
   "USER_NODE" NUMBER NOT NULL
  ,"SERIES" VARCHAR(255) NULL
  ,"TOKEN" VARCHAR(255) NULL
  ,"EXPIRES" DATE NOT NULL
  ,PRIMARY KEY (user_node)
  ,CONSTRAINT or_fk_22
     FOREIGN KEY (user_node) REFERENCES or_user (node)
);

-- Table group
CREATE TABLE or_group(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(255) NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_23
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table usergroup
CREATE TABLE or_usergroup(
   "USER" NUMBER NOT NULL
  ,"GRP" NUMBER NOT NULL
  ,CONSTRAINT or_fk_24
     FOREIGN KEY (grp) REFERENCES or_group (node)
  ,CONSTRAINT or_fk_25
     FOREIGN KEY (user) REFERENCES or_user (node)
);
CREATE INDEX or_idx_26
          ON or_usergroup (grp);
CREATE INDEX or_idx_27
          ON or_usergroup (user);
CREATE UNIQUE INDEX or_uidx_28
                 ON or_usergroup (user,grp);

-- Table variant
CREATE TABLE or_variant(
   "NODE" NUMBER NOT NULL
  ,"TYPE" NUMBER NOT NULL
  ,"DEF" NUMBER NOT NULL
  ,"ISO" VARCHAR(255) NULL
  ,"EXTENSION" VARCHAR(255) NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_29
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table acl
CREATE TABLE or_acl(
   "NODE" NUMBER NOT NULL
  ,"USER" NUMBER NULL
  ,"GRP" NUMBER NULL
  ,"VARIANT" NUMBER NULL
  ,"MASK" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_30
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_31
     FOREIGN KEY (grp) REFERENCES or_group (node)
  ,CONSTRAINT or_fk_32
     FOREIGN KEY (user) REFERENCES or_user (node)
  ,CONSTRAINT or_fk_33
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);
CREATE INDEX or_idx_34
          ON or_acl (user);
CREATE INDEX or_idx_35
          ON or_acl (grp);
CREATE INDEX or_idx_36
          ON or_acl (variant);

-- Table template
CREATE TABLE or_template(
   "NODE" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,"EXTENSION" VARCHAR(255) NULL
  ,"TEXT" CLOB NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_37
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_38
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);

-- Table page
CREATE TABLE or_page(
   "NODE" NUMBER NOT NULL
  ,"TEMPLATE" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_39
     FOREIGN KEY (template) REFERENCES or_template (node)
);

-- Table input
CREATE TABLE or_input(
   "NODE" NUMBER NOT NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"TYPE" NUMBER NOT NULL
  ,"SUBTYPE" NUMBER NOT NULL
  ,"WITH_ICON" NUMBER(1) DEFAULT 0 NOT NULL
  ,"FORMAT" VARCHAR(255) NULL
  ,"WIKI" NUMBER(1) DEFAULT 0 NULL
  ,"HTML" NUMBER(1) DEFAULT 0 NULL
  ,"ALL_LANGUAGES" NUMBER(1) DEFAULT 0 NOT NULL
  ,"WRITABLE" NUMBER(1) DEFAULT 0 NOT NULL
  ,"DECIMALS" NUMBER DEFAULT 0 NULL
  ,"DEC_POINT" VARCHAR(5) NULL
  ,"THOUSAND_SEP" VARCHAR(1) NULL
  ,"CODE" CLOB NULL
  ,"DEFAULT_TEXT" CLOB NULL
  ,"FOLDERNODE" NUMBER NULL
  ,"DEFAULT_NODE" NUMBER NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_40
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_41
     FOREIGN KEY (foldernode) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_42
     FOREIGN KEY (default_node) REFERENCES or_node (id)
);

-- Table meta
CREATE TABLE or_meta(
   "TYPE" NUMBER NOT NULL
  ,"INPUT" NUMBER NOT NULL
  ,PRIMARY KEY (type,input)
  ,CONSTRAINT or_fk_43
     FOREIGN KEY (input) REFERENCES or_input (node)
);

-- Table value
CREATE TABLE or_value(
   "NODE" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,"INPUT" NUMBER NOT NULL
  ,"LINKNODE" NUMBER NULL
  ,"TEXT" CLOB NULL
  ,"NUMBER" NUMBER NULL
  ,"EXP" NUMBER NULL
  ,"DATE" DATE NULL
  ,"STATUS" NUMBER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_44
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_45
     FOREIGN KEY (input) REFERENCES or_input (node)
  ,CONSTRAINT or_fk_46
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);
CREATE INDEX or_idx_47
          ON or_value (variant);
CREATE INDEX or_idx_48
          ON or_value (input);
CREATE INDEX or_idx_49
          ON or_value (status);

-- Table label
CREATE TABLE or_label(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(255) NULL
  ,"DESCR" CLOB NULL
  ,"VARIANT" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_50
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);

-- Table docnode
CREATE TABLE or_docnode(
   "NODE" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,"TYP" NUMBER NOT NULL
  ,"VALUE" CLOB NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_51
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);

-- Table attribute
CREATE TABLE or_attribute(
   "DOCNODE" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"VALUE" VARCHAR(255) NULL
  ,CONSTRAINT or_fk_52
     FOREIGN KEY (docnode) REFERENCES or_docnode (node)
  ,PRIMARY KEY (docnode)
);

-- Table version
CREATE TABLE or_version(
   "VERSION" NUMBER NOT NULL
  ,PRIMARY KEY (version)
);
INSERT INTO or_node (id,lft,rgt,typ,name,hash) VALUES(1,1,4,1,'Root','270f3bc470457203e3ad5d5d7f626485');
INSERT INTO or_node (id,lft,rgt,typ,name,hash) VALUES(2,2,3,13,'admin','37acac6f13ad72e420b717b0356e9981');
INSERT INTO or_user (node,label,password,algo,expires,dn,fullname,tel,mail,descr,style) VALUES(2,'admin','admin',1,'1900-00-00','','Administrator','','','Admin user','default');

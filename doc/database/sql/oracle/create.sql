-- DDL-Script for oracle

-- Table node
CREATE TABLE or_node(
   "ID" NUMBER NOT NULL
  ,"TYP" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
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
                 ON or_node (name);
CREATE INDEX or_idx_3
          ON or_node (typ);
CREATE INDEX or_idx_4
          ON or_node (lft);
CREATE INDEX or_idx_5
          ON or_node (rgt);

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
  ,"HOSTNAME" VARCHAR(255) NULL
  ,"PATH" VARCHAR(255) NULL
  ,"CONFIG" NUMBER NOT NULL
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
  ,"TARGETNODE" NUMBER NOT NULL
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
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_12
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table group
CREATE TABLE or_group(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(255) NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_13
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table usergroup
CREATE TABLE or_usergroup(
   "USER" NUMBER NOT NULL
  ,"GRP" NUMBER NOT NULL
  ,CONSTRAINT or_fk_14
     FOREIGN KEY (grp) REFERENCES or_group (node)
  ,CONSTRAINT or_fk_15
     FOREIGN KEY (user) REFERENCES or_user (node)
);
CREATE INDEX or_idx_16
          ON or_usergroup (grp);
CREATE INDEX or_idx_17
          ON or_usergroup (user);
CREATE UNIQUE INDEX or_uidx_18
                 ON or_usergroup (user,grp);

-- Table variant
CREATE TABLE or_variant(
   "NODE" NUMBER NOT NULL
  ,"TYPE" NUMBER NOT NULL
  ,"DEF" NUMBER NOT NULL
  ,"ISO" VARCHAR(255) NULL
  ,"EXTENSION" VARCHAR(255) NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_19
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
  ,CONSTRAINT or_fk_20
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_21
     FOREIGN KEY (grp) REFERENCES or_group (node)
  ,CONSTRAINT or_fk_22
     FOREIGN KEY (user) REFERENCES or_user (node)
  ,CONSTRAINT or_fk_23
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);
CREATE INDEX or_idx_24
          ON or_acl (user);
CREATE INDEX or_idx_25
          ON or_acl (grp);
CREATE INDEX or_idx_26
          ON or_acl (variant);

-- Table template
CREATE TABLE or_template(
   "NODE" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,"EXTENSION" VARCHAR(255) NULL
  ,"TEXT" CLOB NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_27
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_28
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);

-- Table page
CREATE TABLE or_page(
   "NODE" NUMBER NOT NULL
  ,"TEMPLATE" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_29
     FOREIGN KEY (template) REFERENCES or_template (node)
);

-- Table element
CREATE TABLE or_element(
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
  ,CONSTRAINT or_fk_30
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_31
     FOREIGN KEY (foldernode) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_32
     FOREIGN KEY (default_node) REFERENCES or_node (id)
);

-- Table file
CREATE TABLE or_file(
   "NODE" NUMBER NOT NULL
  ,"EXTENSION" VARCHAR(10) NULL
  ,"SIZE" NUMBER DEFAULT 0 NOT NULL
  ,"WIDTH" NUMBER NOT NULL
  ,"HEIGHT" NUMBER NOT NULL
  ,"VALUE" CLOB NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_33
     FOREIGN KEY (node) REFERENCES or_node (id)
);

-- Table name
CREATE TABLE or_name(
   "NODE" NUMBER NOT NULL
  ,"LABEL" VARCHAR(255) NULL
  ,"DESCR" VARCHAR(255) NULL
  ,"VARIANT" NUMBER DEFAULT 0 NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_34
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);

-- Table attribute
CREATE TABLE or_attribute(
   "NODE" NUMBER NOT NULL
  ,"NAME" VARCHAR(255) NULL
  ,"VALUE" VARCHAR(255) NULL
);
CREATE INDEX or_idx_35
          ON or_attribute (node);

-- Table value
CREATE TABLE or_value(
   "NODE" NUMBER NOT NULL
  ,"VARIANT" NUMBER NOT NULL
  ,"ELEMENT" NUMBER NOT NULL
  ,"LINKNODE" NUMBER NULL
  ,"TEXT" CLOB NULL
  ,"NUMBER" NUMBER NULL
  ,"EXP" NUMBER NULL
  ,"DATE" DATE NULL
  ,"ACTIVE" NUMBER DEFAULT 0 NULL
  ,"PUBLISH" NUMBER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_36
     FOREIGN KEY (node) REFERENCES or_node (id)
  ,CONSTRAINT or_fk_37
     FOREIGN KEY (element) REFERENCES or_element (node)
  ,CONSTRAINT or_fk_38
     FOREIGN KEY (variant) REFERENCES or_variant (node)
);
CREATE INDEX or_idx_39
          ON or_value (variant);
CREATE INDEX or_idx_40
          ON or_value (element);
CREATE INDEX or_idx_41
          ON or_value (active);
CREATE INDEX or_idx_42
          ON or_value (publish);
INSERT INTO or_node (id,lft,rgt,typ,name) VALUES(1,1,4,1,'Root');
INSERT INTO or_node (id,lft,rgt,typ,name) VALUES(2,2,3,13,'admin');
INSERT INTO or_user (node,label,password,dn,fullname,tel,mail,descr,style) VALUES(2,'admin','admin','','Administrator','','','Admin user','default');

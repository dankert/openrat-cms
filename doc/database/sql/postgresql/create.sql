-- DDL-Script for postgresql

-- Table node
CREATE TABLE or_node(
   id INTEGER NOT NULL
  ,typ INTEGER NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,lft INTEGER NOT NULL
  ,rgt INTEGER NOT NULL
  ,lastmodified DATETIME NOT NULL
  ,lastmodified_user INTEGER NOT NULL
  ,creation DATETIME NOT NULL
  ,creation_user INTEGER NOT NULL
  ,PRIMARY KEY (id)
);
CREATE UNIQUE INDEX or_uidx_node_lft_rgt
                 ON or_node (lft,rgt);
CREATE UNIQUE INDEX or_uidx_node_name
                 ON or_node (name);
CREATE INDEX or_idx_node_typ
          ON or_node (typ);
CREATE INDEX or_idx_node_lft
          ON or_node (lft);
CREATE INDEX or_idx_node_rgt
          ON or_node (rgt);

-- Table prop
CREATE TABLE or_prop(
   id INTEGER NOT NULL
  ,typ INTEGER NOT NULL
  ,name VARCHAR(255) NOT NULL
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
  ,typ INTEGER NOT NULL
  ,hostname VARCHAR(255) NOT NULL
  ,path VARCHAR(255) NOT NULL
  ,config INTEGER NOT NULL
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
  ,targetnode INTEGER NOT NULL
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
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_user_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table group
CREATE TABLE or_group(
   node INTEGER NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_group_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table usergroup
CREATE TABLE or_usergroup(
   user INTEGER NOT NULL
  ,grp INTEGER NOT NULL
  ,CONSTRAINT or_fk_usergroup_grp
     FOREIGN KEY (grp) REFERENCES or_group (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_usergroup_user
     FOREIGN KEY (user) REFERENCES or_user (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_usergroup_grp
          ON or_usergroup (grp);
CREATE INDEX or_idx_usergroup_user
          ON or_usergroup (user);
CREATE UNIQUE INDEX or_uidx_usergroup_user_grp
                 ON or_usergroup (user,grp);

-- Table variant
CREATE TABLE or_variant(
   node INTEGER NOT NULL
  ,type INTEGER NOT NULL
  ,def INTEGER NOT NULL
  ,iso VARCHAR(255) NOT NULL
  ,extension VARCHAR(255) NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_variant_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table acl
CREATE TABLE or_acl(
   node INTEGER NOT NULL
  ,user INTEGER NULL
  ,grp INTEGER NULL
  ,variant INTEGER NULL
  ,mask INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_acl_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_grp
     FOREIGN KEY (grp) REFERENCES or_group (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_user
     FOREIGN KEY (user) REFERENCES or_user (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_acl_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_acl_user
          ON or_acl (user);
CREATE INDEX or_idx_acl_grp
          ON or_acl (grp);
CREATE INDEX or_idx_acl_variant
          ON or_acl (variant);

-- Table template
CREATE TABLE or_template(
   node INTEGER NOT NULL
  ,variant INTEGER NOT NULL
  ,extension VARCHAR(255) NULL
  ,text TEXT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_template_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_template_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table page
CREATE TABLE or_page(
   node INTEGER NOT NULL
  ,template INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_page_template
     FOREIGN KEY (template) REFERENCES or_template (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table element
CREATE TABLE or_element(
   node INTEGER NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,type INTEGER NOT NULL
  ,subtype INTEGER NOT NULL
  ,with_icon INTEGER(1) NOT NULL DEFAULT 0
  ,format VARCHAR(255) NULL
  ,wiki INTEGER(1) NULL DEFAULT 0
  ,html INTEGER(1) NULL DEFAULT 0
  ,all_languages INTEGER(1) NOT NULL DEFAULT 0
  ,writable INTEGER(1) NOT NULL DEFAULT 0
  ,decimals INTEGER NULL DEFAULT 0
  ,dec_point VARCHAR(5) NULL
  ,thousand_sep VARCHAR(1) NULL
  ,code TEXT NULL
  ,default_text TEXT NULL
  ,foldernode INTEGER NULL
  ,default_node INTEGER NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_element_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_element_foldernode
     FOREIGN KEY (foldernode) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_element_default_node
     FOREIGN KEY (default_node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table file
CREATE TABLE or_file(
   node INTEGER NOT NULL
  ,extension VARCHAR(10) NOT NULL
  ,size INTEGER NOT NULL DEFAULT 0
  ,width INTEGER NOT NULL
  ,height INTEGER NOT NULL
  ,value TEXT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_file_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table name
CREATE TABLE or_name(
   node INTEGER NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,variant INTEGER NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_name_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Table attribute
CREATE TABLE or_attribute(
   node INTEGER NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,value VARCHAR(255) NOT NULL
);
CREATE INDEX or_idx_attribute_node
          ON or_attribute (node);

-- Table value
CREATE TABLE or_value(
   node INTEGER NOT NULL
  ,variant INTEGER NOT NULL
  ,element INTEGER NOT NULL
  ,linknode INTEGER NULL
  ,text TEXT NULL
  ,number INTEGER NULL
  ,exp INTEGER NULL
  ,date DATETIME NULL
  ,active INTEGER NULL DEFAULT 0
  ,publish INTEGER NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_value_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_element
     FOREIGN KEY (element) REFERENCES or_element (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX or_idx_value_variant
          ON or_value (variant);
CREATE INDEX or_idx_value_element
          ON or_value (element);
CREATE INDEX or_idx_value_active
          ON or_value (active);
CREATE INDEX or_idx_value_publish
          ON or_value (publish);
INSERT INTO or_node (id,lft,rgt,typ,name) VALUES(1,1,4,1,'Root');
INSERT INTO or_node (id,lft,rgt,typ,name) VALUES(2,2,3,13,'admin');
INSERT INTO or_user (node,label,password,dn,fullname,tel,mail,descr,style) VALUES(2,'admin','admin','','Administrator','','','Admin user','default');

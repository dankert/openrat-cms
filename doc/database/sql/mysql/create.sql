-- DDL-Script for mysql

-- Table node
CREATE TABLE or_node(
   id INT NOT NULL
  ,typ INT NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,lft INT NOT NULL
  ,rgt INT NOT NULL
  ,lastmodified DATETIME NOT NULL
  ,lastmodified_user INT NOT NULL
  ,creation DATETIME NOT NULL
  ,creation_user INT NOT NULL
  ,PRIMARY KEY (id)
) ENGINE=InnoDB;
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
   id INT NOT NULL
  ,typ INT NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,label VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Table props
CREATE TABLE or_props(
   node INT NOT NULL
  ,prop INT NOT NULL
  ,value VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Table target
CREATE TABLE or_target(
   node INT NOT NULL
  ,typ INT NOT NULL
  ,hostname VARCHAR(255) NOT NULL
  ,path VARCHAR(255) NOT NULL
  ,config INT NOT NULL
  ,CONSTRAINT or_fk_target_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table url
CREATE TABLE or_url(
   node INT NOT NULL
  ,url VARCHAR(255) NOT NULL
  ,CONSTRAINT or_fk_url_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table link
CREATE TABLE or_link(
   node INT NOT NULL
  ,targetnode INT NOT NULL
  ,CONSTRAINT or_fk_link_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_link_targetnode
     FOREIGN KEY (targetnode) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;
CREATE UNIQUE INDEX or_uidx_link_node
                 ON or_link (node);
CREATE INDEX or_idx_link_targetnode
          ON or_link (targetnode);

-- Table user
CREATE TABLE or_user(
   node INT NOT NULL
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
) ENGINE=InnoDB;

-- Table group
CREATE TABLE or_group(
   node INT NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_group_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table usergroup
CREATE TABLE or_usergroup(
   user INT NOT NULL
  ,grp INT NOT NULL
  ,CONSTRAINT or_fk_usergroup_grp
     FOREIGN KEY (grp) REFERENCES or_group (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_usergroup_user
     FOREIGN KEY (user) REFERENCES or_user (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;
CREATE INDEX or_idx_usergroup_grp
          ON or_usergroup (grp);
CREATE INDEX or_idx_usergroup_user
          ON or_usergroup (user);
CREATE UNIQUE INDEX or_uidx_usergroup_user_grp
                 ON or_usergroup (user,grp);

-- Table variant
CREATE TABLE or_variant(
   node INT NOT NULL
  ,type INT NOT NULL
  ,def INT NOT NULL
  ,iso VARCHAR(255) NOT NULL
  ,extension VARCHAR(255) NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_variant_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table acl
CREATE TABLE or_acl(
   node INT NOT NULL
  ,user INT NULL
  ,grp INT NULL
  ,variant INT NULL
  ,mask INT NOT NULL DEFAULT 0
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
) ENGINE=InnoDB;
CREATE INDEX or_idx_acl_user
          ON or_acl (user);
CREATE INDEX or_idx_acl_grp
          ON or_acl (grp);
CREATE INDEX or_idx_acl_variant
          ON or_acl (variant);

-- Table template
CREATE TABLE or_template(
   node INT NOT NULL
  ,variant INT NOT NULL
  ,extension VARCHAR(255) NULL
  ,text MEDIUMTEXT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_template_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_template_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table page
CREATE TABLE or_page(
   node INT NOT NULL
  ,template INT NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_page_template
     FOREIGN KEY (template) REFERENCES or_template (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table element
CREATE TABLE or_element(
   node INT NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,type INT NOT NULL
  ,subtype INT NOT NULL
  ,with_icon TINYINT(1) NOT NULL DEFAULT 0
  ,format VARCHAR(255) NULL
  ,wiki TINYINT(1) NULL DEFAULT 0
  ,html TINYINT(1) NULL DEFAULT 0
  ,all_languages TINYINT(1) NOT NULL DEFAULT 0
  ,writable TINYINT(1) NOT NULL DEFAULT 0
  ,decimals INT NULL DEFAULT 0
  ,dec_point VARCHAR(5) NULL
  ,thousand_sep VARCHAR(1) NULL
  ,code MEDIUMTEXT NULL
  ,default_text MEDIUMTEXT NULL
  ,foldernode INT NULL
  ,default_node INT NULL
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
) ENGINE=InnoDB;

-- Table file
CREATE TABLE or_file(
   node INT NOT NULL
  ,extension VARCHAR(10) NOT NULL
  ,size INT NOT NULL DEFAULT 0
  ,width INT NOT NULL
  ,height INT NOT NULL
  ,value MEDIUMBLOB NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_file_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table name
CREATE TABLE or_name(
   node INT NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,descr VARCHAR(255) NOT NULL
  ,variant INT NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_name_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table attribute
CREATE TABLE or_attribute(
   node INT NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,value VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
CREATE INDEX or_idx_attribute_node
          ON or_attribute (node);

-- Table value
CREATE TABLE or_value(
   node INT NOT NULL
  ,variant INT NOT NULL
  ,element INT NOT NULL
  ,linknode INT NULL
  ,text MEDIUMTEXT NULL
  ,number INT NULL
  ,exp INT NULL
  ,date DATETIME NULL
  ,active INT NULL DEFAULT 0
  ,publish INT NOT NULL
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
) ENGINE=InnoDB;
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

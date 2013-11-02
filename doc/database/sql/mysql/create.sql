-- DDL-Script for mysql

-- Table node
CREATE TABLE or_node(
   id INT NOT NULL
  ,typ INT NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,hash VARCHAR(255) NOT NULL
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
CREATE UNIQUE INDEX or_uidx_node_hash
                 ON or_node (hash);
CREATE INDEX or_idx_node_typ
          ON or_node (typ);
CREATE INDEX or_idx_node_lft
          ON or_node (lft);
CREATE INDEX or_idx_node_rgt
          ON or_node (rgt);

-- Table hnode
CREATE TABLE or_hnode(
   id INT NOT NULL
  ,node INT NOT NULL
  ,version INT NOT NULL
  ,actual INT NOT NULL
  ,creation DATETIME NOT NULL
  ,creation_user INT NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_hnode_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table vnode
CREATE TABLE or_vnode(
   id INT NOT NULL
  ,node INT NOT NULL
  ,variant INT NOT NULL
  ,PRIMARY KEY (id)
  ,CONSTRAINT or_fk_vnode_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_vnode_variant
     FOREIGN KEY (variant) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table project
CREATE TABLE or_project(
   node INT NOT NULL
  ,hostname VARCHAR(255) NOT NULL
  ,CONSTRAINT or_fk_project_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,PRIMARY KEY (node)
) ENGINE=InnoDB;

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
  ,variant INT NOT NULL
  ,hostname VARCHAR(255) NOT NULL
  ,path VARCHAR(255) NOT NULL
  ,config INT NOT NULL
  ,script VARCHAR(255) NOT NULL
  ,user VARCHAR(255) NOT NULL
  ,password VARCHAR(255) NOT NULL
  ,CONSTRAINT or_fk_target_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table meta_keys
CREATE TABLE or_meta_keys(
   name INT NOT NULL
  ,typ INT NOT NULL
) ENGINE=InnoDB;

-- Table meta_values
CREATE TABLE or_meta_values(
   node INT NOT NULL
  ,meta_key INT NOT NULL
  ,language INT NOT NULL
  ,value_text VARCHAR(255) NOT NULL
  ,value_date DATETIME NOT NULL
  ,CONSTRAINT or_fk_meta_values_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;
CREATE UNIQUE INDEX or_uidx_meta_values_node
                 ON or_meta_values (node);

-- Table url
CREATE TABLE or_url(
   node INT NOT NULL
  ,url VARCHAR(255) NOT NULL
  ,CONSTRAINT or_fk_url_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table file
CREATE TABLE or_file(
   node INT NOT NULL
  ,extension VARCHAR(10) NOT NULL
  ,size INT NOT NULL DEFAULT 0
  ,width INT NOT NULL
  ,height INT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_file_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table folder
CREATE TABLE or_folder(
   node INT NOT NULL
  ,order_type INT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_folder_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table file_value
CREATE TABLE or_file_value(
   node INT NOT NULL
  ,value MEDIUMBLOB NOT NULL
  ,status INT NOT NULL
  ,creation DATETIME NOT NULL
  ,creation_user INT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_file_value_node
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
  ,algo INT NOT NULL
  ,expires DATETIME NOT NULL
  ,last_login DATETIME NOT NULL
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

-- Table token
CREATE TABLE or_token(
   user_node INT NOT NULL
  ,series VARCHAR(255) NOT NULL
  ,token VARCHAR(255) NOT NULL
  ,expires DATETIME NOT NULL
  ,PRIMARY KEY (user_node)
  ,CONSTRAINT or_fk_token_user_node
     FOREIGN KEY (user_node) REFERENCES or_user (node)
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

-- Table input
CREATE TABLE or_input(
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
  ,CONSTRAINT or_fk_input_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_input_foldernode
     FOREIGN KEY (foldernode) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_input_default_node
     FOREIGN KEY (default_node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table meta
CREATE TABLE or_meta(
   type INT NOT NULL
  ,input INT NOT NULL
  ,PRIMARY KEY (type,input)
  ,CONSTRAINT or_fk_meta_input
     FOREIGN KEY (input) REFERENCES or_input (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table value
CREATE TABLE or_value(
   node INT NOT NULL
  ,variant INT NOT NULL
  ,input INT NOT NULL
  ,linknode INT NULL
  ,text MEDIUMTEXT NULL
  ,number INT NULL
  ,exp INT NULL
  ,date DATETIME NULL
  ,status INT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_value_node
     FOREIGN KEY (node) REFERENCES or_node (id)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_input
     FOREIGN KEY (input) REFERENCES or_input (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,CONSTRAINT or_fk_value_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;
CREATE INDEX or_idx_value_variant
          ON or_value (variant);
CREATE INDEX or_idx_value_input
          ON or_value (input);
CREATE INDEX or_idx_value_status
          ON or_value (status);

-- Table label
CREATE TABLE or_label(
   node INT NOT NULL
  ,label VARCHAR(255) NOT NULL
  ,descr MEDIUMTEXT NOT NULL
  ,variant INT NOT NULL DEFAULT 0
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_label_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table docnode
CREATE TABLE or_docnode(
   node INT NOT NULL
  ,variant INT NOT NULL
  ,typ INT NOT NULL
  ,value MEDIUMTEXT NOT NULL
  ,PRIMARY KEY (node)
  ,CONSTRAINT or_fk_docnode_variant
     FOREIGN KEY (variant) REFERENCES or_variant (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB;

-- Table attribute
CREATE TABLE or_attribute(
   docnode INT NOT NULL
  ,name VARCHAR(255) NOT NULL
  ,value VARCHAR(255) NOT NULL
  ,CONSTRAINT or_fk_attribute_docnode
     FOREIGN KEY (docnode) REFERENCES or_docnode (node)
     ON DELETE RESTRICT ON UPDATE RESTRICT
  ,PRIMARY KEY (docnode)
) ENGINE=InnoDB;

-- Table version
CREATE TABLE or_version(
   version INT NOT NULL
  ,PRIMARY KEY (version)
) ENGINE=InnoDB;
INSERT INTO or_node (id,lft,rgt,typ,name,hash) VALUES(1,1,4,1,'Root','270f3bc470457203e3ad5d5d7f626485');
INSERT INTO or_node (id,lft,rgt,typ,name,hash) VALUES(2,2,3,13,'admin','37acac6f13ad72e420b717b0356e9981');
INSERT INTO or_user (node,label,password,algo,expires,dn,fullname,tel,mail,descr,style) VALUES(2,'admin','admin',1,'1900-00-00','','Administrator','','','Admin user','default');

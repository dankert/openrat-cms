-- OpenRat Content Management System
-- SQL-Dump
--
-- (c) Jan Dankert
-- Licensed under the GNU General Public Licence


DROP TABLE or_acl;
DROP TABLE or_value;
DROP TABLE or_usergroup;
DROP TABLE or_templatemodel;
DROP TABLE or_name;
DROP TABLE or_link;
DROP TABLE or_folder;
DROP TABLE or_file;
DROP TABLE or_element;
DROP TABLE or_projectmodel;
DROP TABLE or_page;
DROP TABLE or_language;
DROP TABLE or_template;
DROP TABLE or_object;
DROP TABLE or_group;
DROP TABLE or_user;
DROP TABLE or_project;

CREATE TABLE or_project (
       id INT NOT NULL
     , name VARCHAR(128) NOT NULL
     , target_dir VARCHAR(255) NOT NULL
     , ftp_url VARCHAR(255) NOT NULL
     , ftp_passive CHAR(1) DEFAULT '0' NOT NULL
     , cmd_after_publish VARCHAR(255) NOT NULL
     , content_negotiation CHAR(1) DEFAULT '0' NOT NULL
     , cut_index CHAR(1) DEFAULT '0' NOT NULL
     , PRIMARY KEY (id)
);
CREATE UNIQUE INDEX projectname ON or_project (name);

CREATE TABLE or_user (
       id INT NOT NULL
     , name VARCHAR(128) NOT NULL
     , password VARCHAR(50) NOT NULL
     , ldap_dn VARCHAR(255) NOT NULL
     , fullname VARCHAR(128) NOT NULL
     , tel VARCHAR(128) NOT NULL
     , mail VARCHAR(255) NOT NULL
     , descr VARCHAR(255) NOT NULL
     , style VARCHAR(64) NOT NULL
     , is_admin INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
);
CREATE UNIQUE INDEX name ON or_user (name);

CREATE TABLE or_group (
       id INT NOT NULL
     , name VARCHAR(100) NOT NULL CONSTRAINT UQ_or_group_1 UNIQUE
     , PRIMARY KEY (id)
);

CREATE TABLE or_object (
       id INT NOT NULL
     , parentid INT
     , projectid INT DEFAULT 0 NOT NULL
     , filename VARCHAR(256) NOT NULL
     , orderid INT DEFAULT 0 NOT NULL
     , create_date INT DEFAULT 0 NOT NULL
     , create_userid INT DEFAULT 0
     , lastchange_date INT DEFAULT 0 NOT NULL
     , lastchange_userid INT DEFAULT 0
     , is_folder INT DEFAULT 0 NOT NULL
     , is_file INT DEFAULT 0 NOT NULL
     , is_page INT DEFAULT 0 NOT NULL
     , is_link INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_object_1 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_object_2 FOREIGN KEY (lastchange_userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_object_3 FOREIGN KEY (create_userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX parentid ON or_object (parentid);
CREATE INDEX object_projectid ON or_object (projectid);
CREATE INDEX is_folder ON or_object (is_folder);
CREATE INDEX is_file ON or_object (is_file);
CREATE INDEX is_page ON or_object (is_page);
CREATE INDEX is_link ON or_object (is_link);
CREATE INDEX orderid ON or_object (orderid);
CREATE INDEX object_create_userid ON or_object (create_userid);
CREATE INDEX object_lastchange_userid ON or_object (lastchange_userid);
CREATE UNIQUE INDEX IX_or_object_11 ON or_object (parentid, filename);

CREATE TABLE or_template (
       id INT NOT NULL
     , projectid INT
     , name VARCHAR(50) NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_template_1 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX projectid ON or_template (projectid);
CREATE INDEX templatename ON or_template (name);

CREATE TABLE or_language (
       id INT NOT NULL
     , projectid INT DEFAULT 0 NOT NULL
     , isocode VARCHAR(10) NOT NULL
     , name VARCHAR(50) NOT NULL
     , is_default INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_language_1 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX IX_or_language_2 ON or_language (projectid, isocode);

CREATE TABLE or_page (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , templateid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_page_1 FOREIGN KEY (templateid)
                  REFERENCES or_template (id) ON DELETE RESTRICT ON UPDATE NO ACTION
     , CONSTRAINT FK_page_2 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE NO ACTION
);
CREATE UNIQUE INDEX objectid ON or_page (objectid);
CREATE INDEX page_templateid ON or_page (templateid);

CREATE TABLE or_projectmodel (
       id INT NOT NULL
     , projectid INT DEFAULT 0 NOT NULL
     , name VARCHAR(50) NOT NULL
     , extension VARCHAR(10) NOT NULL
     , is_default INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_projectmodel_1 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX projectmodel_projectid ON or_projectmodel (projectid);
CREATE INDEX IX_or_projectmodel_3 ON or_projectmodel (projectid, extension);

CREATE TABLE or_element (
       id INT NOT NULL
     , templateid INT DEFAULT 0 NOT NULL
     , name VARCHAR(50) NOT NULL
     , descr VARCHAR(255) NOT NULL
     , type VARCHAR(20) NOT NULL
     , subtype VARCHAR(20)
     , with_icon CHAR(1) DEFAULT '0' NOT NULL
     , dateformat VARCHAR(100)
     , wiki CHAR(1) DEFAULT '0'
     , html CHAR(1) DEFAULT '0'
     , all_languages CHAR(1) DEFAULT '0' NOT NULL
     , writable CHAR(1) DEFAULT '0' NOT NULL
     , decimals CHAR(4) DEFAULT '0'
     , dec_point VARCHAR(5)
     , thousand_sep CHAR(1)
     , code TEXT
     , default_text TEXT
     , folderobjectid INT
     , default_objectid INT
     , PRIMARY KEY (id)
     , CONSTRAINT FK_or_element_1 FOREIGN KEY (default_objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_or_element_2 FOREIGN KEY (folderobjectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_or_element_3 FOREIGN KEY (templateid)
                  REFERENCES or_template (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX element_templateid ON or_element (templateid);
CREATE UNIQUE INDEX IX_or_element_3 ON or_element (templateid, name);

CREATE TABLE or_file (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , extension VARCHAR(10) NOT NULL
     , size INT DEFAULT 0 NOT NULL
     , value TEXT NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_file_1 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE NO ACTION
);
CREATE UNIQUE INDEX file_objectid ON or_file (objectid);

CREATE TABLE or_folder (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_folder_objectid FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX folder_objectid ON or_folder (objectid);

CREATE TABLE or_link (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , link_objectid INT
     , url VARCHAR(255)
     , PRIMARY KEY (id)
     , CONSTRAINT FK_link_1 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_link_2 FOREIGN KEY (link_objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX link_objectid ON or_link (objectid);
CREATE INDEX link_linkobjectid ON or_link (link_objectid);

CREATE TABLE or_name (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , name VARCHAR(128) NOT NULL
     , descr TEXT NOT NULL
     , languageid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_name_1 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE NO ACTION
     , CONSTRAINT FK_name_2 FOREIGN KEY (languageid)
                  REFERENCES or_language (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX name_objectid ON or_name (objectid);
CREATE INDEX name_languageid ON or_name (languageid);

CREATE TABLE or_templatemodel (
       id INT NOT NULL
     , templateid INT DEFAULT 0 NOT NULL
     , projectmodelid INT DEFAULT 0 NOT NULL
     , extension VARCHAR(10)
     , text TEXT NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT UQ_or_templatemodel_1 UNIQUE (templateid, extension)
     , CONSTRAINT FK_templatemodel_1 FOREIGN KEY (templateid)
                  REFERENCES or_template (id) ON DELETE RESTRICT ON UPDATE NO ACTION
     , CONSTRAINT FK_templatemodel_2 FOREIGN KEY (projectmodelid)
                  REFERENCES or_projectmodel (id) ON DELETE RESTRICT ON UPDATE NO ACTION
);
CREATE INDEX templateid ON or_templatemodel (templateid);

CREATE TABLE or_usergroup (
       id INT NOT NULL
     , userid INT DEFAULT 0 NOT NULL
     , groupid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT FK_usergroup_1 FOREIGN KEY (groupid)
                  REFERENCES or_group (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_usergroup_2 FOREIGN KEY (userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX groupid ON or_usergroup (groupid);
CREATE INDEX userid ON or_usergroup (userid);

CREATE TABLE or_value (
       id INT NOT NULL
     , pageid INT DEFAULT 0 NOT NULL
     , languageid INT NOT NULL
     , elementid INT DEFAULT 0 NOT NULL
     , linkobjectid INT
     , text TEXT
     , number INT
     , date INT
     , active INT DEFAULT 0 NOT NULL
     , lastchange_date INT DEFAULT 0 NOT NULL
     , lastchange_userid INT DEFAULT 0
     , PRIMARY KEY (id)
     , CONSTRAINT FK_value_1 FOREIGN KEY (pageid)
                  REFERENCES or_page (id) ON DELETE RESTRICT ON UPDATE NO ACTION
     , CONSTRAINT FK_value_2 FOREIGN KEY (elementid)
                  REFERENCES or_element (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_value_3 FOREIGN KEY (languageid)
                  REFERENCES or_language (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_value_4 FOREIGN KEY (lastchange_userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_value_5 FOREIGN KEY (linkobjectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE or_acl (
       id INT NOT NULL
     , userid INT
     , groupid INT
     , objectid INT DEFAULT 0 NOT NULL
     , languageid INT DEFAULT 0
     , is_write INT DEFAULT 0 NOT NULL
     , is_prop INT DEFAULT 0 NOT NULL
     , is_create_folder INT DEFAULT 0 NOT NULL
     , is_create_file INT DEFAULT 0 NOT NULL
     , is_create_link INT DEFAULT 0 NOT NULL
     , is_create_page INT DEFAULT 0 NOT NULL
     , is_delete INT DEFAULT 0 NOT NULL
     , is_publish INT DEFAULT 0 NOT NULL
     , is_grant INT DEFAULT 0 NOT NULL
     , is_transmit INT NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_acl_groupid FOREIGN KEY (groupid)
                  REFERENCES or_group (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_acl_userid FOREIGN KEY (userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_acl_objectid FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT FK_or_acl_languageid FOREIGN KEY (languageid)
                  REFERENCES or_language (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_acl_userid ON or_acl (userid);
CREATE INDEX idx_acl_groupid ON or_acl (groupid);
CREATE INDEX idx_acl_languageid ON or_acl (languageid);
CREATE INDEX idx_acl_objectid ON or_acl (objectid);
CREATE INDEX idx_acl_transmit ON or_acl (is_transmit);


-- Insert 1 Admin-User

INSERT INTO or_user
   (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin)
   VALUES( 1,'admin','21232f297a57a5a743894a0e4a801fc3','','Administrator','','','The Admin User','default',1 )

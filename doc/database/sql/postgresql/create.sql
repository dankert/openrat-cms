-- OpenRat Content Management System
-- SQL-Dump
--
-- (c) Jan Dankert
-- Licensed under the GNU General Public Licence


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
CREATE UNIQUE INDEX idx_project_uk ON or_project (name);

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
CREATE UNIQUE INDEX idx_user_uk ON or_user (name);

CREATE TABLE or_group (
       id INT NOT NULL
     , name VARCHAR(100) NOT NULL
     , PRIMARY KEY (id)
);
CREATE UNIQUE INDEX idx_group_uk ON or_group (name);

CREATE TABLE or_object (
       id INT NOT NULL
     , parentid INT
     , projectid INT DEFAULT 0 NOT NULL
     , filename VARCHAR(255) NOT NULL
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
     , CONSTRAINT fk_object_01 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_object_02 FOREIGN KEY (lastchange_userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_object_03 FOREIGN KEY (create_userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_object_01 ON or_object (parentid);
CREATE INDEX idx_object_02 ON or_object (projectid);
CREATE INDEX idx_object_03 ON or_object (is_folder);
CREATE INDEX idx_object_04 ON or_object (is_file);
CREATE INDEX idx_object_05 ON or_object (is_page);
CREATE INDEX idx_object_06 ON or_object (is_link);
CREATE INDEX idx_object_07 ON or_object (orderid);
CREATE INDEX idx_object_08 ON or_object (create_userid);
CREATE INDEX idx_object_09 ON or_object (lastchange_userid);
CREATE UNIQUE INDEX idx_object_uk ON or_object (parentid, filename);

CREATE TABLE or_template (
       id INT NOT NULL
     , projectid INT NOT NULL
     , name VARCHAR(50) NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_template_01 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
COMMENT ON COLUMN or_template.id IS 'auto_increment';
CREATE INDEX idx_template_01 ON or_template (projectid);
CREATE INDEX idx_template_02 ON or_template (name);
CREATE UNIQUE INDEX idx_template_uk ON or_template (projectid, name);

CREATE TABLE or_language (
       id INT NOT NULL
     , projectid INT DEFAULT 0 NOT NULL
     , isocode VARCHAR(10) NOT NULL
     , name VARCHAR(50) NOT NULL
     , is_default INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_language_01 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX idx_language_uk ON or_language (projectid, isocode);

CREATE TABLE or_page (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , templateid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_page_01 FOREIGN KEY (templateid)
                  REFERENCES or_template (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_page_02 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX idx_page_uk ON or_page (objectid);
CREATE INDEX idx_page_01 ON or_page (templateid);

CREATE TABLE or_projectmodel (
       id INT NOT NULL
     , projectid INT DEFAULT 0 NOT NULL
     , name VARCHAR(50) NOT NULL
     , extension VARCHAR(10)
     , is_default CHAR(10) DEFAULT '0' NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_projectmodel_01 FOREIGN KEY (projectid)
                  REFERENCES or_project (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
COMMENT ON COLUMN or_projectmodel.extension IS 'not in use';
CREATE INDEX idx_projectmodel_01 ON or_projectmodel (projectid);
CREATE UNIQUE INDEX idx_projectmodel_uk ON or_projectmodel (projectid, name);

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
     , CONSTRAINT fk_element_01 FOREIGN KEY (default_objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_element_02 FOREIGN KEY (folderobjectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_element_03 FOREIGN KEY (templateid)
                  REFERENCES or_template (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
COMMENT ON COLUMN or_element.templateid IS 'Template fuer das dieses Element gilt';
COMMENT ON COLUMN or_element.name IS 'Name des Elementes';
COMMENT ON COLUMN or_element.descr IS 'Beschreibung fuer den Redakteur';
COMMENT ON COLUMN or_element.type IS 'interner Typ des Elementes';
COMMENT ON COLUMN or_element.subtype IS 'Untertyp, fuer bestimmte Typen notwendig';
COMMENT ON COLUMN or_element.with_icon IS 'ja/nein ob Editier-Ikon vor Element erscheint';
COMMENT ON COLUMN or_element.dateformat IS 'Datumsformat (nur bei Datums-Elementen)';
COMMENT ON COLUMN or_element.wiki IS 'ja/nein ob Text-Schnellauszeichnung erfolgen soll (nur bei Textelementen)';
COMMENT ON COLUMN or_element.html IS 'ja/nein ob HTML im Text erlaubt ist (nur bei Textelementen)';
COMMENT ON COLUMN or_element.all_languages IS 'ja/nein ob Inhalt fuer alle Sprachen gilt';
COMMENT ON COLUMN or_element.writable IS 'ja/nein ob Inhalt vom Redakteur veraenderbar';
COMMENT ON COLUMN or_element.decimals IS 'Anzahl Nachkommastellen (bei Typ Zahl)';
COMMENT ON COLUMN or_element.dec_point IS 'Dezimalstelle (bei Typ Zahl)';
COMMENT ON COLUMN or_element.thousand_sep IS 'Tausenderpunkt (bei Typ Zahl)';
COMMENT ON COLUMN or_element.code IS 'PHP-Code fuer dynamische Inhalte';
COMMENT ON COLUMN or_element.default_text IS 'Standard-Inhalt wenn kein Inhalt vorhanden ist';
COMMENT ON COLUMN or_element.folderobjectid IS 'Verweis auf Ordner';
COMMENT ON COLUMN or_element.default_objectid IS 'verlinktes Objekt, wenn kein anderer Inhalt verfuegbar ist.';
CREATE INDEX idx_element_01 ON or_element (templateid);
CREATE INDEX idx_element_02 ON or_element (name);
CREATE UNIQUE INDEX idx_element_uk ON or_element (templateid, name);

CREATE TABLE or_file (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , extension VARCHAR(10) NOT NULL
     , size INT DEFAULT 0 NOT NULL
     , value TEXT NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_file_01 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX idx_file_01 ON or_file (objectid);

CREATE TABLE or_folder (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_folder_01 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX idx_folder_01 ON or_folder (objectid);

CREATE TABLE or_link (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , link_objectid INT
     , url VARCHAR(255)
     , PRIMARY KEY (id)
     , CONSTRAINT fk_link_01 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_link_02 FOREIGN KEY (link_objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE UNIQUE INDEX idx_link_01 ON or_link (objectid);
CREATE INDEX idx_link_02 ON or_link (link_objectid);

CREATE TABLE or_name (
       id INT NOT NULL
     , objectid INT DEFAULT 0 NOT NULL
     , name VARCHAR(255) NOT NULL
     , descr VARCHAR(255) NOT NULL
     , languageid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_name_01 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_name_02 FOREIGN KEY (languageid)
                  REFERENCES or_language (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_name_01 ON or_name (objectid);
CREATE INDEX idx_name_02 ON or_name (languageid);
CREATE UNIQUE INDEX idx_name_uk ON or_name (objectid, languageid);

CREATE TABLE or_templatemodel (
       id INT NOT NULL
     , templateid INT DEFAULT 0 NOT NULL
     , projectmodelid INT DEFAULT 0 NOT NULL
     , extension VARCHAR(10)
     , text TEXT NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT UQ_or_templatemodel_1 UNIQUE (templateid, extension)
     , CONSTRAINT fk_templatemodel_01 FOREIGN KEY (templateid)
                  REFERENCES or_template (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_templatemodel_02 FOREIGN KEY (projectmodelid)
                  REFERENCES or_projectmodel (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_templatemodel_01 ON or_templatemodel (templateid);
CREATE UNIQUE INDEX idx_templatemodel_uk_01 ON or_templatemodel (templateid, projectmodelid);

CREATE TABLE or_usergroup (
       id INT NOT NULL
     , userid INT DEFAULT 0 NOT NULL
     , groupid INT DEFAULT 0 NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_usergroup_01 FOREIGN KEY (groupid)
                  REFERENCES or_group (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_usergroup_02 FOREIGN KEY (userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_usergroup_01 ON or_usergroup (groupid);
CREATE INDEX idx_usergroup_02 ON or_usergroup (userid);
CREATE UNIQUE INDEX idx_usergroup_uk ON or_usergroup (userid, groupid);

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
     , public INT NOT NULL
     , lastchange_date INT DEFAULT 0 NOT NULL
     , lastchange_userid CHAR(10) DEFAULT '0'
     , PRIMARY KEY (id)
     , CONSTRAINT fk_value_01 FOREIGN KEY (pageid)
                  REFERENCES or_page (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_value_02 FOREIGN KEY (elementid)
                  REFERENCES or_element (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_value_03 FOREIGN KEY (languageid)
                  REFERENCES or_language (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_value_04 FOREIGN KEY (lastchange_userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_value_05 FOREIGN KEY (linkobjectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_value_01 ON or_value (pageid);
CREATE INDEX idx_value_02 ON or_value (languageid);
CREATE INDEX idx_value_03 ON or_value (elementid);
CREATE INDEX idx_value_04 ON or_value (active);
CREATE INDEX idx_value_05 ON or_value (lastchange_date);
CREATE INDEX idx_value_06 ON or_value (elementid);
CREATE INDEX idx_value_07 ON or_value (public);

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
     , is_release INT NOT NULL
     , is_publish INT DEFAULT 0 NOT NULL
     , is_grant INT DEFAULT 0 NOT NULL
     , is_transmit CHAR(10) NOT NULL
     , PRIMARY KEY (id)
     , CONSTRAINT fk_acl_01 FOREIGN KEY (groupid)
                  REFERENCES or_group (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_acl_02 FOREIGN KEY (userid)
                  REFERENCES or_user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_acl_03 FOREIGN KEY (objectid)
                  REFERENCES or_object (id) ON DELETE RESTRICT ON UPDATE RESTRICT
     , CONSTRAINT fk_acl_04 FOREIGN KEY (languageid)
                  REFERENCES or_language (id) ON DELETE RESTRICT ON UPDATE RESTRICT
);
CREATE INDEX idx_acl_01 ON or_acl (userid);
CREATE INDEX idx_acl_02 ON or_acl (groupid);
CREATE INDEX idx_acl_03 ON or_acl (languageid);
CREATE INDEX idx_acl_04 ON or_acl (objectid);
CREATE INDEX idx_acl_05 ON or_acl (is_transmit);


-- Insert 1 Admin-User

INSERT INTO or_user
   (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin)
   VALUES( 1,'admin','21232f297a57a5a743894a0e4a801fc3','','Administrator','','','The Admin User','default',1 )

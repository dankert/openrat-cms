#!/bin/bash
#
#


prefix=or_
outfile=tmp.sql
type=
db=
db_fc=0
table=

open_table()
{
    echo "" >> $outfile
    echo "-- Table $1" >> $outfile
    echo "CREATE TABLE ${prefix}$1(" >> $outfile
    db_fc=1
    table=$1
}

close_table()
{
    echo ")" >> $outfile
}

column()
{
    if	[ $db_fc -eq 1 ]; then
		echo -n "   " >> $outfile
    else
		echo -n "  ," >> $outfile
	fi
	if	[ "$type" == "oracle" ]; then
		uc=`echo $1|tr 'a-z' 'A-Z'`
    	echo -n "\"$uc\"" >> $outfile # column name
	else
    	echo -n "$1" >> $outfile # column name
    fi
    echo -n " $2" >> $outfile # type
    if [ "$3" != "" ]; then
    	echo -n "($3)" >> $outfile
    fi
    if [ "$4" != "" ]; then
    	echo -n " DEFAULT $4" >> $outfile
    fi
    if [ "$5" == "0" ]; then
    	echo -n " NOT NULL" >> $outfile
    else
    	echo -n " NULL" >> $outfile
    fi
    echo >> $outfile
    db_fc=0
}

primary_key()
{
    echo "  ,PRIMARY KEY ($1)" >> $outfile
}
unique_index()
{
    echo "CREATE UNIQUE INDEX ${prefix}uidx_${table}_`echo $1|tr ',' '_'`" >> $outfile
    echo "                 ON ${prefix}$table ($1);" >> $outfile
}

index()
{
    echo "CREATE INDEX ${prefix}idx_${table}_`echo $1|tr ',' '_'`" >> $outfile
    echo "          ON ${prefix}$table ($1);" >> $outfile
}

constraint()
{
    echo "  ,CONSTRAINT ${prefix}fk_${table}_$1" >> $outfile
    echo "     FOREIGN KEY ($1) REFERENCES ${prefix}${2} ($3)" >> $outfile
    if	[ "$type" != "oracle" ]; then
    	echo "     ON DELETE RESTRICT ON UPDATE RESTRICT" >> $outfile
    fi

}


insert()
{
	echo "INSERT INTO ${prefix}$1 ($2) VALUES($3)" >> $outfile
}

for	db in mysql postgresql oracle sqlite; do

    type=$db
    outfile=${db}_tmp_create.sql
    echo "-- DDL-Script for $db" > $outfile
    
    open_table project
    column id                  INT      ""  0 1
    column name                text    128  0 1
	column target_dir          VARCHAR 255 "" 0
    column ftp_url             VARCHAR 255 "" 0
    column ftp_passive         tinyint 1   0 0
    column cmd_after_publish   VARCHAR 255 "" 0
    column content_negotiation tinyint 1   0 0
    column cut_index           tinyint 1   0 0
    primary_key id
    close_table
    unique_index name


	open_table user  
	column       id INT 0
	column      name VARCHAR 128  0
	column      password VARCHAR 50  0
	column      ldap_dn VARCHAR 255  0
	column      fullname VARCHAR 128  0
	column      tel VARCHAR 128  0
	column      mail VARCHAR 255  0
	column      descr VARCHAR 255  0
	column      style VARCHAR 64  0
	column      is_admin INT 0 0
	primary_key id 
     close_table
	unique_index name
	
	open_table group  
	column       id INT 0
	column      name VARCHAR 100  0
	primary_key  id 
     close_table
	unique_index name
	
	open_table object  
	column       id INT 0
	column      parentid INT
	column      projectid INT 0 0
	column      filename VARCHAR 255  0
	column      orderid INT 0 0
	column      create_date INT 0 0
	column      create_userid INT 0
	column      lastchange_date INT 0 0
	column      lastchange_userid INT 0
	column      is_folder INT 0 0
	column      is_file INT 0 0
	column      is_page INT 0 0
	column      is_link INT 0 0
	primary_key  id 
      constraint projectid project id
      constraint lastchange_userid                    user  id  
      constraint create_userid user  id
     close_table
 
	index   parentid 
	index projectid 
	index is_folder 
	index is_file 
	index is_page 
	index is_link 
	index orderid 
	index create_userid 
	index lastchange_userid 
	unique_index parentid filename 

	open_table template  
	column       id INT 0
	column      projectid INT 0
	column      name VARCHAR 50  0
	 primary_key  id 
	constraint   projectid   project  id  
     close_table
	 
	index projectid 
	index name 
	unique_index projectid,name 
	
	open_table language  
	column       id INT 0
	column      projectid INT 0 0
	column      isocode VARCHAR 10  0
	column      name VARCHAR 50  0
	column      is_INT 0 0column
	primary_key  id 
	constraint   projectid     project  id  
     close_table
	unique_index projectid,isocode 
	
	open_table page  
	column       id INT 0
	column      objectid INT 0 0
	column      templateid INT 0 0
      primary_key  id 
      constraint  templateid             template  id  
      constraint  objectid                   object  id  
     close_table
     
	unique_index objectid 
	index templateid 
	
	open_table projectmodel  
	column       id INT 0
	column      projectid INT 0 0
	column      name VARCHAR 50  0
	column      extension VARCHAR 10 
	column      is_CHAR 10  '0' 0
      primary_key  id 
      constraint  projectid  project  id  
      close_table
 
	index   projectid 
	unique_index projectid,name 

	
	open_table element  
	column       id INT 0
	column      templateid INT 0 0
	column      name VARCHAR 50  0
	column      descr VARCHAR 255  0
	column      type VARCHAR 20  0
	column      subtype VARCHAR 20 
	column      with_icon CHAR 1  '0' 0
	column      dateformat VARCHAR 100 
	column      wiki CHAR 1  '0'
	column      html CHAR 1  '0'
	column      all_languages CHAR 1  '0' 0
	column      wriopen_table CHAR 1  '0' 0
	column      decimals INT 0
	column      dec_point VARCHAR 5 
	column      thousand_sep CHAR 1 
	column      code TEXT
	column      default_text TEXT
	column      folderobjectid INT
	column      default_objectid INT
      primary_key  id 
      constraint  default_objectid     object  id  
      constraint  folderobjectid   object  id  
      constraint  templateid   template  id  
     close_table
 
	index   templateid 
	index  name 
	unique_index templateid,name 


	open_table file  
	column       id INT 0
	column      objectid INT 0 0
	column      extension VARCHAR 10  0
	column      size INT 0 0
	column      value MEDIUMBLOB 0
	      primary_key  id 
	      constraint  objectid   object  id  
     close_table
	 
	unique_index objectid 

	
	open_table folder  
	column       id INT 0
	column      objectid INT 0 0
	      primary_key  id 
	      constraint object,id  
     close_table
 
	unique_index objectid 
	

	open_table link  
	column       id INT 0
	column      objectid INT 0 0
	column      link_objectid INT
	column      url VARCHAR 255 
      primary_key  id 
      constraint objectid  object  id  
      constraint link_objectid object  id  
     close_table
 
	unique_index objectid 
	index link_objectid 

	
	open_table name  
	column       id INT 0
	column      objectid INT 0 0
	column      name VARCHAR 255  0
	column      descr VARCHAR 255  0
	column      languageid INT 0 0
      primary_key  id 
      constraint objectid   object  id  
      constraint languageid  language  id  
     close_table
 
	index objectid 
	index languageid 
	unique_index objectid,languageid 


	open_table templatemodel  
	column       id INT 0
	column      templateid INT 0 0
	column      projectmodelid INT 0 0
	column      extension VARCHAR 10 
	column      text TEXT 0
      primary_key  id 
      unique_index templateid,extension 
      constraint templateid   template  id  
      constraint projectmodelid projectmodel  id  
     close_table
 
	index templateid 
	unique_index templateid,projectmodelid 
	
	open_table usergroup  
	column       id INT 0
	column      userid INT 0 0
	column      groupid INT 0 0
      primary_key  id 
      constraint   groupid  group  id  
      constraint   userid  user  id  
     close_table
 
	index  groupid 
	index userid 
	unique_index userid,groupid 
	
	open_table value  
	column       id INT 0
	column      pageid INT 0 0
	column      languageid INT 0
	column      elementid INT 0 0
	column      linkobjectid INT
	column      text TEXT
	column      number INT
	column      date INT
	column      active INT 0 0
	column      publish INT 0
	column      lastchange_date INT 0 0
	column      lastchange_userid INT 0
      primary_key  id 
      constraint pageid     page  id  
      constraint elementid    element  id  
      constraint   languageid   language  id  
      constraint  lastchange_userid user  id  
      constraint  linkobjectid  object  id  
     close_table
 
	index pageid 
	index languageid 
	index elementid 
	index  active 
	index  lastchange_date 
	index  elementid 
	index publish 
	
	open_table acl  
	column id INT 0
	column      userid INT
	column      groupid INT
	column      objectid INT 0 0
	column      languageid INT 0
	column      is_write INT 0 0
	column      is_prop INT 0 0
	column      is_create_folder INT 0 0
	column      is_create_file INT 0 0
	column      is_create_link INT 0 0
	column      is_create_page INT 0 0
	column      is_delete INT 0 0
	column      is_release INT 0
	column      is_publish INT 0 0
	column      is_grant INT 0 0
	column      is_transmit CHAR 10  0
      primary_key  id 
      constraint  groupid     group  id  
      constraint    userid    user  id  
      constraint   objectid   object  id  
      constraint languageid  language  id  
     close_table
 
	index userid 
	index groupid 
	index languageid 
	index objectid 
	index is_transmit 


	insert user "id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin" "1,'admin','admin','','Administrator','','','Admin user','default',1"

done

exit 0
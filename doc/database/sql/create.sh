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
    echo -n ")" >> $outfile
    
    case "$type" in
     mysql)
            echo -n " ENGINE MyISAM" >> $outfile
            ;;
     mysql_innodb)
            echo -n " ENGINE InnoDB" >> $outfile
            ;;
     *)
             ;;
	esac
    echo ";" >> $outfile
    
}


# param 1: column name
# param 2: type
# param 3: size
# param 4: default
# param 5: nullable j/n
column()
{
    if	[ $db_fc -eq 1 ]; then
		echo -n "   " >> $outfile
    else
		echo -n "  ," >> $outfile
	fi
	if	[ "$type" == "oracle" ]; then
		# Oracle needs uppercase
		uc=`echo $1|tr 'a-z' 'A-Z'`
    	echo -n "\"$uc\"" >> $outfile # column name
	else
    	echo -n "$1" >> $outfile # column name
    fi
    
    echo -n " " >> $outfile
    case "$2" in
     tinyint|INT)
        echo -n "INTEGER" >> $outfile
        ;;
     VARCHAR|CHAR)
        echo -n "VARCHAR" >> $outfile
        ;;
     TEXT)
     	if	[ "$type" == "oracle" ]; then
            echo -n "CLOB" >> $outfile
        elif	[ "$type"=="postgresql" ]; then
            echo -n "TEXT" >> $outfile
        else
            echo -n "TEXT" >> $outfile
        fi
            ;;
     BLOB)
     	if	[ "$type"=="postgresql" ]; then
            echo -n "TEXT" >> $outfile
        else
            echo -n "BLOB" >> $outfile
        fi
            ;;
     *)
     	echo "failed: unknown column type $2"
     	exit 4
             ;;
	esac
    
    
    # Column-size
    if [ "$3" != "" -a "$3" != "-" ]; then
    	echo -n "($3)" >> $outfile
    fi
    
    # Nullable?
    if [ "$5" == "J" -o "$5" == "1" ]; then
    	echo -n " NULL" >> $outfile
    else
    	echo -n " NOT NULL" >> $outfile
    fi
    
    # DEFAULT-value
    if [ "$4" != "" -a "$4" != "-" ]; then
    	echo -n " DEFAULT $4" >> $outfile
    fi
    
    echo >> $outfile
    db_fc=0
}

# param 1: column name
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
   	# Oracle doesn't support "ON DELETE RESTRICT"-Statements
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
    column id                  INT     -   0 N
    column name                VARCHAR 128 - N
    column target_dir          VARCHAR 255 - N
    column ftp_url             VARCHAR 255 - N
    column ftp_passive         tinyint 1   0 N
    column cmd_after_publish   VARCHAR 255 - N
    column content_negotiation tinyint 1   0 N
    column cut_index           tinyint 1   0 N
    primary_key id
    close_table
    unique_index name


	open_table user  
	column id       INT     -   - N
	column name     VARCHAR 128 - N
	column password VARCHAR 50  - N
	column ldap_dn  VARCHAR 255 - N
	column fullname VARCHAR 128 - N
	column tel      VARCHAR 128 - N
	column mail     VARCHAR 255 - N
	column descr    VARCHAR 255 - N
	column style    VARCHAR 64  - N
	column is_admin INT     -   0 N
	primary_key id 
    close_table
	unique_index name
	
	
	open_table group  
	column id   INT     -   - N 
	column name VARCHAR 100 - N
	primary_key id 
    close_table
	unique_index name
	
	open_table object  
	column id                INT
	column parentid          INT     -   - 1
	column projectid         INT     -   0 0
	column filename          VARCHAR 255 -
	column orderid           INT     -   0
	column create_date       INT     -   0
	column create_userid     INT     -   0 J
	column lastchange_date   INT     -   0
	column lastchange_userid INT     -   0 J
	column is_folder         INT     -   0
	column is_file           INT     -   0 
	column is_page           INT     -   0
	column is_link           INT     -   0
	primary_key  id 
    constraint projectid          project id
    constraint lastchange_userid  user    id
    constraint create_userid      user    id
    close_table
 
	index parentid
	index projectid
	index is_folder
	index is_file
	index is_page
	index is_link
	index orderid
	index create_userid
	index lastchange_userid
	unique_index parentid,filename 

	open_table template  
	column id        INT
	column projectid INT
	column name      VARCHAR 50
	primary_key id 
	constraint projectid project  id
	close_table

	index projectid 
	index name 
	unique_index projectid,name 

	open_table language  
	column id         INT
	column projectid  INT     -  0
	column isocode    VARCHAR 10
	column name       VARCHAR 50
	column is_default INT     -  0
	primary_key  id
	constraint projectid project id
	close_table
	unique_index projectid,isocode 
	
	open_table page
	column id         INT
	column objectid   INT - 0
	column templateid INT - 0
	primary_key  id 
	constraint  templateid template id
	constraint  objectid   object   id  
	close_table
     
	unique_index objectid 
	index templateid 
	
	open_table projectmodel  
	column id         INT
	column projectid  INT     -  0
	column name       VARCHAR 50
	column extension  VARCHAR 10 - J
	column is_default INT     -  0
	primary_key  id 
	constraint  projectid  project  id  
	close_table
 
	index        projectid
	unique_index projectid,name

	
	open_table element
	column      id               INT
	column      templateid       INT     -   0 0
	column      name             VARCHAR 50
	column      descr            VARCHAR 255
	column      type             VARCHAR 20
	column      subtype          VARCHAR 20  - J
	column      with_icon        INT     1   0
	column      dateformat       VARCHAR 100 - J
	column      wiki             INT     1   0 J
	column      html             INT     1   0 J
	column      all_languages    INT     1   0
	column      writable         INT     1   0
	column      decimals         INT     -   0
	column      dec_point        VARCHAR 5   - J 
	column      thousand_sep     CHAR    1   - J
	column      code             TEXT    -   - J
	column      default_text     TEXT    -   - J
	column      folderobjectid   INT     -   - J
	column      default_objectid INT     -   - J
    primary_key  id 
    constraint  default_objectid     object  id  
    constraint  folderobjectid   object  id  
    constraint  templateid   template  id  
    close_table
 
	index  templateid 
	index  name 
	unique_index templateid,name 


	open_table file  
	column      id        INT
	column      objectid  INT     -  0
	column      extension VARCHAR 10 
	column      size      INT     -  0
	column      value     BLOB
	primary_key  id 
	constraint  objectid   object  id  
    close_table
	 
	unique_index objectid 

	
	open_table folder  
	column id       INT
	column objectid INT - 0
	primary_key  id 
	constraint objectid object id  
    close_table
 
	unique_index objectid 
	

	open_table link  
	column id            INT     -   - N
	column objectid      INT     -   0 N
	column link_objectid INT     -   - J
	column url           VARCHAR 255 - N
    primary_key  id 
    constraint objectid      object  id  
    constraint link_objectid object  id  
    close_table
 
	unique_index objectid 
	index link_objectid 

	
	open_table name  
	column id         INT
	column objectid   INT     -   0
	column name       VARCHAR 255 - N
	column descr      VARCHAR 255
	column languageid INT     -   0 N
    primary_key  id 
    constraint objectid   object   id  
    constraint languageid language id  
    close_table
 
	index objectid 
	index languageid 
	unique_index objectid,languageid 


	open_table templatemodel  
	column      id             INT     -  - N
	column      templateid     INT     -  0 N
	column      projectmodelid INT     -  0 N
	column      extension      VARCHAR 10 - J 
	column      text           TEXT
    primary_key  id 
    constraint templateid     template     id  
    constraint projectmodelid projectmodel id  
    close_table
    
	index templateid 
    unique_index templateid,extension 
	unique_index templateid,projectmodelid 
 
	
	open_table usergroup  
	column      id       INT
	column      userid   INT - 0
	column      groupid  INT - 0
    primary_key id 
    constraint groupid group id  
    constraint userid  user  id  
    close_table
 
	index  groupid 
	index userid 
	unique_index userid,groupid 

	
	open_table value  
	column      id                INT
	column      pageid            INT  - 0
	column      languageid        INT
	column      elementid         INT  - 0
	column      linkobjectid      INT  - - J
	column      text              TEXT - - J
	column      number            INT  - - J
	column      date              INT  - - J
	column      active            INT  - 0
	column      publish           INT  - - N
	column      lastchange_date   INT  - 0 N
	column      lastchange_userid INT  - - J
    primary_key  id 
    constraint pageid            page     id  
    constraint elementid         element  id  
    constraint languageid        language id  
    constraint lastchange_userid user     id  
    constraint linkobjectid      object   id  
    close_table
 
	index pageid 
	index languageid 
	index elementid 
	index active 
	index lastchange_date 
	index publish 

	
	open_table acl  
	column id INT
	column      userid           INT - - J
	column      groupid          INT - - J
	column      objectid         INT - - N
	column      languageid       INT - 0
	column      is_write         INT 1 0
	column      is_prop          INT 1 0
	column      is_create_folder INT 1 0
	column      is_create_file   INT 1 0
	column      is_create_link   INT 1 0
	column      is_create_page   INT 1 0
	column      is_delete        INT 1 0
	column      is_release       INT 1 0
	column      is_publish       INT 1 0
	column      is_grant         INT 1 0
	column      is_transmit      INT 1 0
    primary_key  id 
    constraint groupid    group    id  
    constraint userid     user     id  
    constraint objectid   object   id  
    constraint languageid language id  
    close_table
 
	index userid 
	index groupid 
	index languageid 
	index objectid 
	index is_transmit 


	insert user "id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin" "1,'admin','admin','','Administrator','','','Admin user','default',1"

done

exit 0
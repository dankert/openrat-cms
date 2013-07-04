#!/bin/bash
#
#


# table name prefix
prefix=or_

# table name suffix
suffix=

# Standard Storing engine for MySQL
mysql_engine=InnoDB

outfile=
type=
db=
db_fc=0
table=
cnt=0

# Creating a new table
# param 1: table name
open_table()
{
    echo "" >> $outfile
    echo "-- Table $1" >> $outfile
    echo "CREATE TABLE ${prefix}${1}${suffix}(" >> $outfile
    db_fc=1
    table=$1
}

# Closing the table
close_table()
{
    echo -n ")" >> $outfile
    
    case "$type" in
     mysql)
            #echo -n " ENGINE=$mysql_engine" >> $outfile
            echo -n " TYPE=$mysql_engine" >> $outfile
            ;;
     *)
             ;;
	esac
    echo ";" >> $outfile
    
}


# Creating a new column
# param 1: column name
# param 2: type (available are: INT,VARCHAR,TEXT,BLOB)
# param 3: size (number value)
# param 4: default (number value)
# param 5: nullable (available are: J,N)
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
     INT)
     	if	[ "$type" == "mysql" ]; then
     		if	[ "$3" == "1" ]; then
        		echo -n "TINYINT" >> $outfile
        	else
        		echo -n "INT" >> $outfile
        	fi
     	elif	[ "$type" == "oracle" ]; then
        	echo -n "NUMBER" >> $outfile
     	else
        	echo -n "INTEGER" >> $outfile
        fi
        ;;
     VARCHAR)
        echo -n "VARCHAR" >> $outfile
        ;;
     TEXT)
     	if	[ "$type" == "mysql" ]; then
            echo -n "MEDIUMTEXT" >> $outfile
     	elif	[ "$type" == "oracle" ]; then
            echo -n "CLOB" >> $outfile
        elif	[ "$type" == "postgresql" ]; then
            echo -n "TEXT" >> $outfile
        else
            echo -n "TEXT" >> $outfile
        fi
            ;;
     DATE)
     	if	[ "$type" == "mysql" ]; then
            echo -n "DATE" >> $outfile
     	elif	[ "$type" == "oracle" ]; then
            echo -n "DATE" >> $outfile
        elif	[ "$type" == "postgresql" ]; then
            echo -n "DATE" >> $outfile
        else
            echo -n "DATE" >> $outfile
        fi
            ;;
     BLOB)
     	if	[ "$type" == "mysql" ]; then
            echo -n "MEDIUMBLOB" >> $outfile
     	elif	[ "$type" == "postgresql" ]; then
            echo -n "TEXT" >> $outfile
     	elif	[ "$type" == "oracle" ]; then
            echo -n "CLOB" >> $outfile
     	elif	[ "$type" == "sqlite" ]; then
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
    
    if	[ "$type" == "oracle" ]; then
    	# Oracle wants the DEFAULT-command as first
    
	    # DEFAULT-value
	    if [ "$4" != "" -a "$4" != "-" ]; then
	    	echo -n " DEFAULT $4" >> $outfile
	    fi
	    
	    # Nullable?
	    # TEXT-columns should be nullable in Oracle, because empty strings are treated as NULL :(
	    if [ "$5" == "J" -o "$5" == "1" -o "$2" == "VARCHAR" -o  "$2" == "TEXT" ]; then
	    	echo -n " NULL" >> $outfile
	    else
	    	echo -n " NOT NULL" >> $outfile
    	fi
    else
    	# ANSI-SQL: DEFAULT after NULL-command
    	
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
	    
    fi
    
    
    echo >> $outfile
    db_fc=0
}

# Creating a primary key
# param 1: column name
primary_key()
{
    echo "  ,PRIMARY KEY ($1)" >> $outfile
}

# Creating a unique key
# param 1: name of index column. Seperate multiple columns with ','
unique_index()
{
	if	[ "$type" == "oracle" ]; then
		cnt=$(($cnt+1))
    	echo "CREATE UNIQUE INDEX ${prefix}uidx_${cnt}" >> $outfile
	else
    	echo "CREATE UNIQUE INDEX ${prefix}uidx_${table}${suffix}_`echo $1|tr ',' '_'`" >> $outfile
    fi
    echo "                 ON ${prefix}${table}${suffix} ($1);" >> $outfile
}

# Creating a non-unique key
# param 1: name of index column. Seperate multiple columns with ','
index()
{
	if	[ "$type" == "oracle" ]; then
		cnt=$(($cnt+1))
		echo "CREATE INDEX ${prefix}idx_${cnt}" >> $outfile
	else
    	echo "CREATE INDEX ${prefix}idx_${table}${suffix}_`echo $1|tr ',' '_'`" >> $outfile
    fi
    echo "          ON ${prefix}${table}${suffix} ($1);" >> $outfile
}

# Creating a foreign key
# param 1: column name
# param 2: target table name
# param 3: target column name
constraint()
{
	if	[ "$type" == "oracle" ]; then
		cnt=$(($cnt+1))
	    echo "  ,CONSTRAINT ${prefix}fk_${cnt}" >> $outfile
	else
	    echo "  ,CONSTRAINT ${prefix}fk_${table}${suffix}_$1" >> $outfile
	fi

    echo "     FOREIGN KEY ($1) REFERENCES ${prefix}${2}${suffix} ($3)" >> $outfile
   	# Oracle doesn't support "ON DELETE RESTRICT"-Statements, but its the default.
    if	[ "$type" != "oracle" ]; then
    	echo "     ON DELETE RESTRICT ON UPDATE RESTRICT" >> $outfile
    fi

}

# Inserting values
# param 1: table name
# param 2: name of columns. Seperate multiple columns with ','
# param 3: values. Seperate multiple values with ','
insert()
{
	echo "INSERT INTO ${prefix}${1}${suffix} ($2) VALUES($3);" >> $outfile
}





for	db in mysql postgresql oracle sqlite; do

    type=$db
    outfile=${db}/create.sql
    echo "-- DDL-Script for $db" > $outfile
    

   
    # Now beginning the table definitions
    
    
	open_table node
    column id          INT - - N
	column type        INT - - N
    column name        VARCHAR 255 - N
    column left        INT - - N,
    column right       INT - - N
    column order       INT - - N
    column lastmodified DATE - - N
    column lastmodified_user       INT - - Y
    column creation     DATE - - N
    column creation_user           INT - - Y
    primary_key id
	close_table
  	unique_index name
  	index type
  	index left
  	index right
  	index order


	open_table prop
    column id            INT - - N
    column type          INT - - N
    column name          VARCHAR 255 - N
    column label         VARCHAR 255 - N
    column label         VARCHAR 255 - N
	close_table


	open_table props
    column node          INT - - N
    column prop          INT - - N
    column value         VARCHAR 255 - N
	close_table


    open_table target
    column node INT - - N
    column type INT - - N
    column hostname VARCHAR 255 - N
    column path VARCHAR 255 - N
    column mask INT - - N
    constraint node node  id  
    close_table

   
    open_table url
    column node INT - - N
    column url  VARCHAR 255 - N
    constraint node node id  
    close_table

   
    open_table link  
    column node          INT     -   - N
    column targetnode    INT     -   0 N
    constraint node node  id  
    constraint targetnode node  id  
    close_table
    unique_index node
    index targetnode


	open_table user  
    column node    INT     - - N
	column label    VARCHAR 128 - N
	column password VARCHAR 255 - N
	column dn       VARCHAR 255 - N
	column fullname VARCHAR 128 - N
	column tel      VARCHAR 128 - N
	column mail     VARCHAR 255 - N
	column descr    VARCHAR 255 - N
	column style    VARCHAR 64  - N
	primary_key id 
    close_table
	unique_index name
	
	
	open_table group  
	column node   INT     -   - N 
	column label VARCHAR 255 - N
	primary_key id 
    close_table
	unique_index name
	
	
	open_table usergroup  
	column      userid   INT - - N
	column      groupid  INT - - N
    constraint groupid group id  
    constraint userid  user  id  
    close_table
	index groupid 
	index userid 
	unique_index userid,groupid
	

    open_table acl  
	column node INT
	column userid           INT - - J
	column groupid          INT - - J
	column variant       INT - 0 J
	column mask          INT - 0 N
    constraint groupid    group    id  
    constraint userid     user     id  
    constraint objectid   object   id  
    constraint variant variant node
    close_table
	index userid 
	index groupid 
	index variantid 
	index node 


    open_table variant
	column node       INT - - N
	column type       INT - - N
	column default    INT - - N
	column iso     VARCHAR 255 - Y
	column extension      VARCHAR 255 - Y
    close_table
	
	
	open_table page
	column node       INT
	column templateid INT - 0
	primary_key  id 
	constraint  templateid template id
	close_table
	
	
	open_table template  
	column node         INT
	column projectnode INT
	primary_key node
	constraint projectnode node id
	close_table
	index projectid 
	index name 
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
	column      decimals         INT     -   0 J
	column      dec_point        VARCHAR 5   - J 
	column      thousand_sep     VARCHAR 1   - J
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
	column node        INT
	column extension VARCHAR 10 
	column size      INT     -  0
	column width  INT - - Y
	column height INT - - Y
	column value     BLOB
	primary_key  id 
	constraint  objectid   object  id  
    close_table
	 
	unique_index objectid 

	
	open_table name  
	column node       INT - - N
	column name       VARCHAR 255 - N
	column descr      VARCHAR 255
	column variant INT     -   0 N
    primary_key node 
    constraint variant variant node  
    close_table
 

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


	insert user "id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin" "1,'admin','admin','','Administrator','','','Admin user','default',1"




    # end of table definitions

    

done

exit 0
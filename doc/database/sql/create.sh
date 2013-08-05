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
            echo -n " ENGINE=$mysql_engine" >> $outfile
            #echo -n " TYPE=$mysql_engine" >> $outfile
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
            echo -n "DATETIME" >> $outfile
     	elif	[ "$type" == "oracle" ]; then
            echo -n "DATE" >> $outfile
        elif	[ "$type" == "postgresql" ]; then
            echo -n "DATETIME" >> $outfile
        else
            echo -n "DATETIME" >> $outfile
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
    
    
	open_table project
    column id          INT       - - N
    column hostname    VARCHAR 255 - N
    primary_key id
	close_table


	open_table node
    column id          INT       - - N
	column typ         INT       - - N
    column name        VARCHAR 255 - N
    column lft         INT       - - N
    column rgt         INT       - - N
    column lastmodified      DATE - - N
    column lastmodified_user INT  - - Y
    column creation          DATE - - N
    column creation_user     INT  - - Y
    primary_key id
	close_table
  	unique_index lft,rgt
  	unique_index name
  	index typ
  	index lft
  	index rgt


	open_table prop
    column id            INT - - N
    column typ           INT - - N
    column name          VARCHAR 255 - N
    column label         VARCHAR 255 - N
	close_table


	open_table props
    column node          INT - - N
    column prop          INT - - N
    column value         VARCHAR 255 - N
	close_table


    open_table target
    column node     INT       - - N
    column typ      INT       - - N
    column hostname VARCHAR 255 - N
    column path     VARCHAR 255 - N
    column config   INT       - - N
    column script   VARCHAR 255 - N
    column user     VARCHAR 255 - N
    column password VARCHAR 255 - N
    constraint node node id  
    close_table

   
    open_table meta_keys
    column name     INT       - - N
    column typ      INT       - - N
    close_table

   
    open_table meta_values
    column node     INT       - - N
    column key      INT       - - N
    column language INT       - - N
    column value_text VARCHAR 255 - N
    column value_date DATE    -   - N
    constraint node node id  
    unique_index node key language
    close_table

   
    open_table url
    column node INT       - - N
    column url  VARCHAR 255 - N
    constraint node node id  
    close_table

   
	open_table file  
	column node       INT
	column extension  VARCHAR 10 
	column size       INT     -  0
	column width      INT - - Y
	column height     INT - - Y
	primary_key  node 
	constraint  node node id  
    close_table


	open_table file_value  
	column node       INT - - N
	column value      BLOB
	column status     INT - - N
    column creation          DATE - - N
    column creation_user     INT  - - Y
	primary_key  node 
	constraint  node node id  
    close_table


    open_table link  
    column node          INT - - N
    column targetnode    INT - - N
    constraint node       node id  
    constraint targetnode node id  
    close_table
    unique_index node
    index targetnode


	open_table user  
    column node     INT     -   - N
	column label    VARCHAR 128 - N
	column password VARCHAR 255 - N
	column expires  DATE      - - N
	column last_login DATE      - - N
	column dn       VARCHAR 255 - N
	column fullname VARCHAR 128 - N
	column tel      VARCHAR 128 - N
	column mail     VARCHAR 255 - N
	column descr    VARCHAR 255 - N
	column style    VARCHAR 64  - N
	primary_key node
    constraint node       node id  
    close_table
	
	
	open_table token  
    column userid   INT     -   - N
	column series  VARCHAR 255 - N
	column token   VARCHAR 255 - N
	column expires  DATE      - - N
	primary_key id
    constraint userid user id  
    close_table
	
	
	open_table group  
	column node  INT     -   - N 
	column label VARCHAR 255 - N
	primary_key node 
    constraint node node id  
    close_table
	
	
	open_table usergroup  
	column      user   INT - - N
	column      grp  INT - - N
    constraint grp group node  
    constraint user  user  node
    close_table
	index grp 
	index user 
	unique_index user,grp
	

    open_table variant
	column node       INT - - N
	column type       INT - - N
	column def        INT - - N
	column iso     VARCHAR 255 - Y
	column extension      VARCHAR 255 - Y
	primary_key node 
    constraint node node id  
    close_table
	
	
    open_table acl  
	column node        INT - - N
	column user        INT - - J
	column grp         INT - - J
	column variant     INT - - J
	column mask        INT - 0 N
	primary_key node 
    constraint node    node    id  
    constraint grp     group   node  
    constraint user    user    node
    constraint variant variant node
    close_table
	index user 
	index grp 
	index variant 


	open_table template  
	column      node           INT       - - N
	column      variant        INT       - - N
	column      extension      VARCHAR 255 - J 
	column      text           TEXT
    primary_key node
    constraint node    node    id
    constraint variant variant node  
    close_table

	
	open_table page
	column node     INT - - N
	column template INT - 0 N
	primary_key node 
	constraint  template template node
	close_table
	
	
	open_table input
	column      node             INT     -   - N
	column      descr            VARCHAR 255
	column      type             INT - - N
	column      subtype          INT - - N
	column      with_icon        INT     1   0
	column      format           VARCHAR 255 - J
	column      wiki             INT     1   0 J
	column      html             INT     1   0 J
	column      all_languages    INT     1   0
	column      writable         INT     1   0
	column      decimals         INT     -   0 J
	column      dec_point        VARCHAR 5   - J 
	column      thousand_sep     VARCHAR 1   - J
	column      code             TEXT    -   - J
	column      default_text     TEXT    -   - J
	column      foldernode   INT     -   - J
	column      default_node INT     -   - J
    primary_key node 
    constraint  node         node id  
    constraint  foldernode   node id  
    constraint  default_node node id  
    close_table


	open_table meta
	column      type             INT     -   - N
	column      input            INT     -   - N
    primary_key type,input 
    constraint  input input node  
    close_table


	open_table value  
	column      node              INT  - - N
	column      variant           INT  - - Y
	column      input             INT  - - N
	column      linknode          INT  - - J
	column      text              TEXT - - J
	column      number            INT  - - J
	column      exp               INT  - - J
	column      date              DATE - - J
	column      status            INT  - - N
	
    primary_key node 
    constraint node          node     id  
    constraint element       element  node  
    constraint variant       variant  node  
    close_table
	index variant 
	index element 
	index active 
	index publish 


	
	open_table label
	column node       INT - - N
	column label      VARCHAR 255 - N
	column descr      TEXT
	column variant    INT     -   0 N
    primary_key node
    constraint variant variant node  
    close_table
 


	open_table docnode
	column node       INT - - N
	column variant    INT - - Y
	column type       INT - - N
	column value      TEXT
    primary_key node
    constraint variant variant node  
    close_table
 


	open_table attribute  
	column      node           INT     -  - N
	column      name           VARCHAR 255 - N 
	column      value          VARCHAR 255 - N 
    close_table
	index node 


	insert node "id,lft,rgt,typ,name" "1,1,4,1,'Root'"
	insert node "id,lft,rgt,typ,name" "2,2,3,13,'admin'"
	insert user "node,label,password,dn,fullname,tel,mail,descr,style" "2,'admin','admin','','Administrator','','','Admin user','default'"


    # end of table definitions

    

done

exit 0
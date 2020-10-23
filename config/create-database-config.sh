#!/bin/bash

usage() {
  echo "Usage: $0 [-r <root-username>] [-p <root password>] [-d <database>] [ -u username ] [ -c password ]" 1>&2;
  exit 1;
}

ROOT_USER=root
ROOT_PASSWORD=
DATABASE=openrat
USER=openrat
PASSWORD=

while getopts "r:p:d:u:c:h" o; do
    case "${o}" in
        r)
            ROOT_USER=${OPTARG}
            ;;
        p)
            ROOT_PASSWORD=${OPTARG}
            ;;
        d)
            DATABASE=${OPTARG}
            ;;
        h)
            usage; exit 1;
            ;;
        u)
            USER=${OPTARG}
            ;;
        c)
            PASSWORD=${OPTARG}
            ;;
        *)
            usage
            ;;
    esac
done
shift $((OPTIND-1))

if [ -z "${PASSWORD}" ]; then
  PASSWORD=`< /dev/urandom tr -dc _A-Z-a-z-0-9 | head -c${1:-32}`
fi


function mysqlcmd {
  CMD=$1
  mysql --silent --user=$ROOT_USER --password=$ROOT_PASSWORD --execute="$CMD"
}

mysqlcmd "CREATE DATABASE $DATABASE;"
mysqlcmd "CREATE USER '$USER'@'%';"
mysqlcmd "ALTER USER '$USER'@'%' IDENTIFIED BY '$PASSWORD';"
mysqlcmd "GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, DROP, ALTER ON $DATABASE.* TO '$USER'@'%';";
mysqlcmd "FLUSH PRIVILEGES;"

echo "# database configuration for openrat content management system"
echo "# copy this to config.yml or config-<host>.yml"
echo "database:"
echo "  db_$DATABASE:"
echo "    dsn : \"mysql:host=localhost; dbname=$DATABASE; charset=utf8\""
echo "    user: \"$USER\""
echo "    password: \"$PASSWORD\""
echo

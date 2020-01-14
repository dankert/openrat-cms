# OpenRat Content Management System

![Screenshot](doc/images/screenshot-overall.png)


## About

OpenRat is a satisfying CMS.

OpenRat generates static files, which are served by a dedicated live web server like Apache, Nginx, Boa etc.

Unlike popular static site generators like Jekyll, JBake etc. OpenRat CMS contains a complete Web UI with user management.

### Why OpenRat?

Yes, there are a lot of good CMS in the world, and a lot of them are available for free. Why should you use OpenRat CMS?

**OpenRat combines the world of static site generators with a complete web UI**. Editors do not have to use a version control system, they only use their browser.


## Install

### Requirements

You need a server with PHP >= 5.5 and a relational database.

MariaDB and MySQL are recommended, while PostgresQL and SQLite are supported too.
 

### Local installation
 
#### Download and untar it

Download the last release from Github and install it on your server:

https://github.com/dankert/openrat-cms/releases

#### Clone GIT repository

Or clone the GIT repository with the command

`git clone http://git.code.weiherhei.de/openrat-cms.git`

or from Github

`git clone https://github.com/dankert/openrat-cms.git`

#### Add database configuration

Edit the file `config/config.yml` and enter your database access data, like:
 
    database:
      db:
        enabled : true
        dsn     : "mysql:host=localhost; dbname=name_of_db; charset=utf8"
        user    : "user"
        password: "password"

### Docker

OpenRat-CMS is available [at Dockerhub](https://hub.docker.com/r/openrat/openrat-cms).

#### Run the docker container

Download and run the docker image from dockerhub:

`docker run -d -p 8080:8080 -e DB_HOST=$host -e DB_NAME=$name -e DB_USER=$user -e DB_PASS=$pass openrat/openrat-cms`

Be sure to replace the variables.

#### Environment variables for Docker

The following environment variables could be set in the docker container: 

| Name      | Description |   Default |
| ----------- | ----------- | ------- |
|DB_TYPE|database type|mysql
|DB_HOST|database hostname|localhost
|DB_NAME|database schema|cms
|DB_USER|database user|
|DB_PASS|database password|
|CMS_MOTD|Message of the day|Welcome to dockerized CMS
|CMS_NAME|Software name|OpenRat CMS (Docker)
|CMS_OPERATOR|Name of your company|Docker-Host


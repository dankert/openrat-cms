# Development Tools

These files are only necessary **for developers**!
 
## Starting development environment

In the subdirectory `docker/openrat-dev` exists a docker compose file. Just start it with

`docker-compose up -d`

If the command is not found you have to install it. For Debian just type `sudo apt-get install docker-compose`.

The containers will start up,
- the CMS is available under [localhost:8000](http://localhost:8000).
- the generated page is available under [localhost:8001](http://localhost:8001).

## Creating a release tag

Usage: `tag-version.sh <version>`. It

1. updates the file `modules/cms/base/Version.class.php` with the new version
2. creates a git tag
3. updates the file `modules/cms/base/Version.class.php` with the snapshot version


## Updating UI 

Some files need to be transpiled while developing.

`update.sh -u http://host/ -w -x <type>`

Makes the necessary output files writable, then updates them.

- `-u <url>` the current start url, where the CMS is installed.
- `-w` do not exit, **watch**es the files for modifications (you need `inotify` installed) 
- `-x <type>` where `type` is one of `tpl`,`lang`,`js`,`css`,`xsd` or `all`.
  - `tpl`: Transpiles the .tpl.xml files into .php files.
  - `lang`: Transpiles the language.yml into seperate files.
  - `js`: Minifies the JS files.
  - `css`: Starts the LESS compiler
  - `xsd`: Updates the XSD for templates.

You can to the same with [invoking the update via your browser](./update.php). 
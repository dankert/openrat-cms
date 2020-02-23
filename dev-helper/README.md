# Development Tools

These files are only necessary for developers!
 
## Generate output files

This tool is generating output files and is fixing file permissions.

`create-output-files.sh`

## Creating a release tag

`tag-version.sh <version>`

- updates the file `version.php` with the new version
- creates a git tag
- updates the file `version.php` with the snapshot version


## Watching for template modifications

`template-watcher.sh http://host/`

Watches for file modificatons in templates and components. If a file is saved, the template compiler is invoked via HTTP. This will save some of the developers time ;)
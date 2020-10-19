# Development Tools

These files are only necessary **for developers**!
 
## Creating a release tag

`tag-version.sh <version>`

- updates the file `version.php` with the new version
- creates a git tag
- updates the file `version.php` with the snapshot version


## Updating UI 

`update.sh -u http://host/ -w -x <type>`

Makes the necessary output files writable, then updates them.

- `-u <url>` the current start url, where the CMS is installed.
- `-w` do not exit, **watch**es the files for modifications 
- `-x <type>` where `type` is one of `tpl`,`lang`,`js`,`css`,`xsd` or `all`.

You can to the same while [invoking the update via your browser](./update.php). 
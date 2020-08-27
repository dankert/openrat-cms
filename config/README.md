# Configuration

This is the right place for your configuration files.

All configuration files are in the [YAML](https://en.wikipedia.org/wiki/YAML) syntax.

## Using includes

Configuration files may include other files, example:

```
include: other-config-file.yml
```

## Using environment variables

```
include: ${env:YOUR_ENV_VAR}.yml
```

or

```
include: /etc/openrat/config-${http:host}.yml
```

## Security warning

SECURITY WARNING **Do not place any sensitive data like passwords in world readable files here** 


### Best way for securing your configuration files


Outside of the document root, like

```
include:
  - /etc/openrat/config.yml
```

### Mask the configuration files as PHP files
 
```
include:
  - ./config.yml.php
```

And the file `config.yml.php`:

```
# vim: filetype=yaml
# <?php http_send_status(403); ?>

database:
  example:
    user       :  user
    password   :  pass
    host       :  localhost
```


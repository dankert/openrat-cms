# Updating

This module is intended to upgrade a database schema.

## Usage


The `isUpdateRequired()` method finds out the version of the actual db schema. If it is lower than the last known version, `true` is returned.

The `update()` applys all necessary changes from the subdirectory `version` to the database. 

## Example

```
$updater = new Update( $database );

if   ( $updater->isUpdateRequired() )
    $updater->update();
```

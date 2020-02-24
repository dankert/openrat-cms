# Database module

This module contains database specific functionality.

## Usage

### Initialisation

```
$database = new Database( [
                 'dsn'     =>'mysql:host=localhost; dbname=name; charset=utf8',
                 'user'    =>'user','
                 'password'=>'...'
            ] );
```

The `dsn` is described in the [PDO manual](https://www.php.net/manual/de/pdo.construct.php).

## Executing queries
The database object is able to create Statement objects. You only have to apply a SQL query.
```
$statement = $database->sql('select * from table');

$data = $statement->getRow();
$data = $data['column'];
// ...
```
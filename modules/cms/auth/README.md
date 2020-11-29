# Authentication backends

These authentication backends are used for user identification and authentication.

Every Authentication must implement [Auth](Auth.class.php) and must provide the 2 methods

1. `login()` must do an authentification. On successful logins, it should return `Auth::STATUS_SUCCESS`, otherwise this method must return `Auth::STATUS_FAILED`.
1. `username()` may find out the username of the user which want to log in. If this is not possible, this method must return `null`.
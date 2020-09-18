# Targets

While publishing files and pages are pushed to a target.

Possible publishing targets are
- Local filesystem
- FTP,FTPS
- WebDAV
- SCP
- SFTP

The corresponding scheme names are
- `file`
- `ftp`
- `ftps`
- `dav`
- `scp`
- `sftp`

The target is selected by the scheme in the target url in the project properties.

## Example

`scp://user@host/var/www` is publishing all files via SCP to the SSH-Server on host 'host'. 
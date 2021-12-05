# Targets

While publishing files and pages are pushed to a target.

Possible publishing targets are
- Local filesystem
- FTP,FTPS
- WebDAV
- SCP
- SFTP
- S3 (Amazon S3 Storage)

The corresponding scheme names are
- `file`: Local filesystem
- `ftp`:  FTP
- `ftps`: FTPS (FTP over SSL)
- `dav`:  WebDAV
- `scp`:  Secure copy (SCP)
- `sftp`: SFTP
- `s3`: Amazon S3 Storage

The target is selected by the scheme in the target url in the project properties.

## Example

`scp://user@host/var/www` is publishing all files via SCP to the SSH-Server on host 'host'.

## Requirements

Some targets need special php modules:
- `scp` and `sftp` need the php-ssh lib. On Ubuntu simply install it with `sudo apt-get install php-ssh2`.
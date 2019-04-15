
WebDAV für OpenRat Content Management System
===

**The virtual CMS file system is accessable via a DAV client**
 
WebDAV is specified in [RFC 2518](http://www.ietf.org/rfc/rfc2518.txt).

Implemented is DAV level 1 (without Locks).

Following impliciments:
- Login only with username/password
- Only 1 database
- DAV-client must support cookies (the most clients should)
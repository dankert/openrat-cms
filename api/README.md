# API

Every action in the CMS is callable via the API.

Every API call must contain the query parameters `action` and `subaction`.

The response is formatted as the client requested
- JSON
- XML
- YAML
- Serialized PHP-Array

The client may send a request header `Accept-Typpe` or the query parameter `output` with the pleasant output type.
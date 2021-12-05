# Filters

Filters are executed by the CMS after generating a node object.


## Implementation

Every filter must extend the class [AbstractFilter](AbstractFilter.class.php).

## Example

A script file is generated and before publishing it should be minified. This is done by the JavascriptMinifierFilter.
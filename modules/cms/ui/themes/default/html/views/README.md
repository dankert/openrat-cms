## OpenRat CMS Templates

All views are desribe within a XML file with the extension `.tpl.src.xml`.

These views are compiled to `.php` files.

# Components

You may use the following namespaces for the source xml files:

- `http://www.openrat.de/template` for special CMS components.
- `http://www.w3.org/1999/xhtml` for HTML5 components.

# Variables

- `${variable.name}` outputs a data variable
- `#{messagekey}` outputs a i18n message
- `%{config/subconfig/value}` outputs a configuration value


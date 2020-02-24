# OpenRat CMS Views

All views are desribe within a XML file with the extension `.tpl.src.xml`.

These views are compiled to `.php` files.

All XML files are linked to the [XSD schema](../../../../../../template_engine/components/README.md), this makes the creation of template files more simple. 

## Finding the view

Every request has an 'action' and a 'subaction'.

The matching template is `html/views/<action>/<subaction>.src.xml`

## Components

The following namespaces are available for the source xml files:

- `http://www.openrat.de/template` for special CMS components.
- `http://www.w3.org/1999/xhtml` for HTML5 components.

## Variables

- `${variable.name}` outputs a data variable
- `#{messagekey}` outputs a i18n message
- `%{config/subconfig/value}` outputs a configuration value

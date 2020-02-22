<?php
/**
 * Using the Component classes and generating a XSD-File.
 */

use util\FileUtils;

error_reporting(E_ALL);

require('../../util/FileUtils.class.php');

// Baseclass of all components.
require('html/Component.class.php');
require('html/HtmlComponent.class.php');
require('html/FieldComponent.class.php');
header('Content-Type: text/plain');

echo "XSD Generator\n\n";

$folder = FileUtils::readDir(__DIR__ . '/html');

$componentsFile = @fopen(__DIR__ . '/components.ini', 'w');
$xsdFile = @fopen(__DIR__ . '/template.xsd', 'w');

fwrite($componentsFile, '# generated by XSDGenerator. do not change manually.' . "\n");
fwrite($xsdFile, '<?xml version="1.0" encoding="utf-8"?>
<xsd:schema xmlns="http://www.openrat.de/template"
	targetNamespace="http://www.openrat.de/template" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	elementFormDefault="qualified" attributeFormDefault="unqualified">' . "\n");

foreach ($folder as $f) {

    $filename = __DIR__ . '/html/' . $f . '/' . ucfirst($f) . '.class.php';

    if (!is_file($filename))
        continue;

    echo 'Working on component: ' . $f . "\n";
    fwrite($componentsFile, $f . " = \n");

    fwrite($xsdFile, '<xsd:element name="' . $f . '" type="' . $f . 'Type" /><xsd:complexType name="' . $f . 'Type">');

    // Allowed Child-Elements (all)
    fwrite($xsdFile, '<xsd:choice maxOccurs="unbounded" minOccurs="0">');
    foreach ($folder as $f2) {
        $filename2 = __DIR__ . '/html/' . $f2 . '/' . ucfirst($f2) . '.class.php';
        if (is_file($filename2))
            fwrite($xsdFile, '<xsd:element ref="' . $f2 . '" maxOccurs="unbounded" minOccurs="0" />');
    }
    fwrite($xsdFile, '</xsd:choice>');


    $className = 'template_engine\\components\\' . ucfirst($f) . 'Component';
    include($filename);
    $vars = get_class_vars($className);
    foreach ($vars as $name => $value) {
        if (is_bool($value))
            $xsdtype = 'xsd:boolean';
        elseif (is_numeric($value))
            $xsdtype = 'xsd:int';
        else
            $xsdtype = 'xsd:string';


        fwrite($xsdFile, '<xsd:attribute name="' . $name . '" type="' . $xsdtype . '" />');
    }


    fwrite($xsdFile, '</xsd:complexType>');

}

fwrite($xsdFile, '</xsd:schema>');

fclose($xsdFile);
fclose($componentsFile);

echo "Finished.\n";
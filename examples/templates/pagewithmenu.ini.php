
; Template-Example for a simple page with a menu.

name="Example/Menu"
src = "<html>;<table><tr><td>{{Menu}}</td><td><h1>{{Headline}}</h1><br>;{{Text-Inhalt}};</td></tr></table></html>"
description = "Example Template with menu"
extension=html

[menu]
name=Menu
type=dynamic
subtype="ListMenu"

[text]
name="Text-Inhalt"
type=longtext
html=true
wiki=false
editable=true
defaultText="Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quisque ornare felis et orci. Phasellus blandit ultrices magna. Phasellus ornare lectus eget pede. Morbi nunc lectus, convallis elementum, egestas sit amet, accumsan nec, ante. Donec orci. Vivamus varius. Phasellus tristique lacinia magna. Cras mollis pede sed purus. Donec at erat. Cras hendrerit adipiscing orci. Pellentesque dignissim, enim quis tempor fringilla, felis neque faucibus augue, eu fermentum odio sem quis lacus. Nam malesuada fringilla nibh. Phasellus ut sem. Suspendisse ligula. Integer lacus tellus, pretium quis, scelerisque at, feugiat vel, augue. Praesent lorem nisi, vehicula vel, aliquet eget, bibendum at, orci. Praesent vulputate purus id nulla.;;Cras adipiscing tellus nec dui. Nam mattis quam ac justo. Curabitur purus turpis, convallis ut, ornare at, dignissim nec, nisl. Praesent nisl eros, gravida sit amet, cursus sed, sagittis in, elit. Nam ultrices diam sed leo. Ut imperdiet purus sit amet quam. Curabitur ut lorem. Sed vehicula aliquam quam. Pellentesque vitae orci. Sed lacinia, pede non rhoncus auctor, nibh nulla iaculis felis, at viverra quam ligula vitae massa. Vivamus posuere massa sit amet elit. Curabitur in magna eu arcu dignissim lacinia. Aliquam molestie libero sit amet purus.;;Donec odio metus, venenatis id, cursus sit amet, tempor vel, purus. Aenean justo. Integer euismod. In eu dolor. Pellentesque interdum. Nam ut pede sed arcu pellentesque tristique. Nam arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus quam. In pulvinar porttitor augue."

[headline]
name="Headline"
type=text
html=false
wiki=false
editable=true
defaultText="Welcome to this simple page"
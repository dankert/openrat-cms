<?php header('Content-Type: text/css',true) ?>
/*
OpenRat Content Management System
Copyright (C) 2002-2010 Jan Dankert

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

/*
Basis-Style for Openrat.
*/


/* R e s e t - Alle Elemente zuruecksetzen */
/* Source: http://meyerweb.com/eric/tools/css/reset/ */
html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, code, del, dfn, em, img, q, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {margin:0;padding:0;border:0;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;vertical-align:baseline;}
body {line-height:1.5;}
table {border-collapse:separate;border-spacing:0;}
caption, th, td {text-align:left;font-weight:normal;}
table, td, th {vertical-align:top;}
blockquote:before, blockquote:after, q:before, q:after {content:"";}
blockquote, q {quotes:"" "";}
a img {border:none;}


html
{
	scrollbar-face-color: <?php echo $_GET['title_background_color']; ?>;
	scrollbar-arrow-color: <?php echo $_GET['title_background_color']; ?>;
	scrollbar-base-color: <?php echo $_GET['title_text_color']; ?>;
} 


iframe
{
	width:100%;
	height:500px;
	display:block;
	border: 1px solid <?php echo $_GET['title_background_color']; ?>;
}

div.breadcrumb,
div.breadcrumb a,
div.panel > div.title
{
	x-background-color:<?php echo $_GET['title_background_color']; ?>;
	xsopacity:0.7;
	color:<?php echo $_GET['title_text_color']; ?>;
	font-weight:bold;
}

/*   H e a d e r   */
div#header
{
	width:100%;
	height:30px;
	overflow:hidden;
	padding:7px;
	margin:0px;
	margin-bottom:5px;
	float:left;
}

div#header div.title
{
	float:left;
}

div#header div.user,
div#header div.search,
div#header div.projects,
div#header div.history
{
	float:right;
	margin-right:0px;
	margin-left:24px;
}

/*

div#tree
{
	padding:5px;
	width:25%;
	margin-left:0px;
	float:left;
}
*/


/*   N o t i c e   */
div#noticebar
{
	display:block;
	position:fixed;
	bottom:40px;
	right:40px;
	width:250px;
	z-index:113;
}

div#noticebar div.notice
{
	border: 2px solid <?php echo $_GET['text_color']; ?>;
	
	padding:5px;
	margin:5px;
	
	-moz-border-radius:5px; /* Mozilla */
    -webkit-border-radius:5px; /* Webkit */
    -khtml-border-radius:5px; /* Konqui */
    border-radius:5px; /* CSS 3 */
        
	-webkit-box-shadow: 3px 2px 5px <?php echo $_GET['text_color']; ?>;
    -moz-box-shadow: 3px 2px 5px <?php echo $_GET['text_color']; ?>;
    box-shadow: 3px 2px 5px <?php echo $_GET['text_color']; ?>;
	
	display:none;
}
div#noticebar div.notice.ok
{
	background-color: green;
}
div#noticebar div.notice.warning
{
	background-color: yellow;
}
div#noticebar div.notice.error
{
	background-color:red;
}
div#noticebar div.notice.error div.text
{
	font-weight: bold;
}
div#noticebar div.log
{
	font-family: monospace;
}

/*   H o e h e n   */
html,body
{
	height:100%;
}


/*

div#tree, div#content
{
	height:auto;
}
*/

/*div.panel {
    height:90%;
}
*/

div.panel div.title
{
	height:20px;
}



div.panel div.status
{
	height:35px;
}
div.panel > div.content
{
	xxoverflow-x:auto;
}


ul#history > li,
div.content a.action,
div.content a.help,
div.filler div.headermenu > a.entry,
div.filler div.header a.back.button
{
	margin:9px;
	padding-top:4px;
	padding-bottom:4px;
	padding-left:7px;
	padding-right:7px;
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	-moz-border-radius:5px; /* Mozilla */
    -webkit-border-radius:5px; /* Webkit */
    -khtml-border-radius:5px; /* Konqui */
    border-radius:5px;
    background-color: <?php echo $_GET['title_text_color']; ?>;
	background: -moz-linear-gradient(top, <?php echo $_GET['title_background_color']; ?>, <?php echo $_GET['inactive_background_color']; ?>);
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $_GET['title_background_color']; ?>), to(<?php echo $_GET['inactive_background_color']; ?>));
	font-style:normal;
	font-weight:normal;
	text-decoration:none;
    color:<?php echo $_GET['text_color']; ?>;
}

ul#history > li.active
{
    background-color: <?php echo $_GET['title_text_color']; ?>;
    font-weight:bold;
    color:<?php echo $_GET['text_color']; ?>;
}


a.help
{
	float:right;
}

a.help
{
	cursor:help;
}

a.action:hover,
a.help:hover,
div.noaction:hover
{
	text-decoration:none;
	border-color:<?php echo $_GET['title_text_color']; ?>;
}

a.action:active,
a.help:active,
div.noaction:active,
input.ok:active
{
	border-color:red;
}


a
{
	color:<?php echo $_GET['text_color']; ?>;
}



/*   D r o p d o w n  -  M e n u e s  */
div.dropdown
{
	z-index:2;
	display:none;
	position: absolute;
	padding:5px 0px;
}

div.dropdownalignright
{
	right:0;
}

div.dropdown > a
{
	display:block;
}
div.dropdown div.entry
{
	padding:2px 5px;
}


/*Dropdown anzeigen!!!*/
div#header div:hover div.dropdown,
div.panel div:hover > div.dropdown,
div.icon:hover > div.dropdown
{
	display:block;
}



div.onrowvisible
{
	visibility: hidden;
	display:inline;
}
td:hover > div.onrowvisible
{
	visibility: visible;
}



/* Vorschau von Text-Inhalten */

td.preview { background-color:papayawhip; border-top:1px solid <?php echo $_GET['inactive_background_color']; ?>; border-bottom:1px solid <?php echo $_GET['inactive_background_color']; ?>; }
.preview h1 { font-size:138.5%; }
.preview h2 { font-size:123.1%; }
.preview h3 { font-size:108%;   }
.preview h1,.preview h2,.preview h3 {
	margin:1em 0;
}
.preview h1,
.preview h2,
.preview h3,
.preview h4,
.preview h5,
.preview h6,
.preview strong
{
	font-weight:bold; 
}
.preview abbr,.preview acronym {
	border-bottom:1px dotted #000;
	cursor:help;
} 
.preview em {
	font-style:italic;
}
.preview ol,.preview ul,.preview dl {
	margin-left:2em;
}
.preview ol li
{
	list-style: decimal outside;	
}
.preview ul li
{
	list-style: disc outside;
}
.preview a:link,
.preview a:visited,
.preview a:active,
.preview a:hover
{
	text-decoration:underline;
	color:blue;
}



/* Verweise */
a:link,
a:visited
{
	font-weight:normal;
	text-decoration:none;
}
a:active,
a:hover
{
	font-weight:normal;
	text-decoration:none;
}


a.editorlink:active,
a.editorlink:hover
{
	font-weight:normal;
	text-decoration:none;
}

a.editorlink:link,
a.editorlink:visited
{
	font-weight:normal;
	text-decoration:none;
}


/* Submenu-Entrys */
body.menu tr.menu td table tr td,
body.main tr.menu td table tr td
{
	padding:4px; padding-right:6px;padding-left:6px; width:30px;
	white-space:nowrap;
}

/* Submenu-Width */
body.menu tr.menu table { width:50px;}


/* Inaktive Menuepunkte werden ausgegraut */
body.menu tr.menu td table tr td.noaction,
body.main tr.menu td table tr td.noaction
{
	color:<?php echo $_GET['title_background_color']; ?>;
}

/* Icon-Innenabstand */
img[align=left],
img[align=right] {padding-right:1px;padding-left:1px;}

/* Vorformatierter Text */
pre
{
	font-family:Courier;
	font-size:13px;
}

/* Kleingedrucktes */
small
{
	color:<?php echo $_GET['title_background_color']; ?>;
}


/* Kurztasten */
body.menu span.accesskey,
body.main span.accesskey
{
	text-decoration:underline;
}




/* Menzue-Titel-Zeile */
body.menu tr.title td,
body.main tr.title td
{
	vertical-align:middle;
	padding:4px;
	height:30px;
}

/* Hinweis */
td.message { padding:10px; font-weight:bold; }


/* Allgemeine Inhaltszellen */
body.main table.main td.window td
{
	padding:4px;
}

/* Logo */
table.main td.window td.logo
{
	padding:10px;
}

/* Action-Button */
body.main table.main td.window td.act
{
	padding:15px;
	margin-top:20px;
	border-top:1px solid <?php echo $_GET['title_background_color']; ?>;
	text-align:right;
}

/* Lizenzhinweis  */
a.copyright
{
	font-size:0.7em;
	text-decoration:none;
}

/* Message of the day */
td.motd
{
	border-left: 3px solid red;
	border-right: 3px solid red;
	font-weight: bold;
	padding:10px;
	margin:10px;
}

/* Hauptfenster */
table.main
{
	x-border:3px solid;
}



div.panel input.checkbox,
div.panel input.radio
{
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
}

/* Eingabefeld fuer Beschreibung */
textarea.desc,
textarea.description
{
	font-family:Arial;
	font-size:13px;
}

/* Eingabefeld fuer Textabsatz */
textarea.longtext
{
	font-family:Arial;
	font-size:13px;
	width:100%;
	border:1px solid <?php echo $_GET['text_color']; ?>;
}





/* Hilfe-Texte */
tr td.help
{
	font-style: italic;
}

tr.headline td.help
{
	/*
	border-bottom:1px solid <?php echo $_GET['text_color']; ?>;
	*/
	font-style: normal;
	
}

/* Logo */
td.logo
{
	padding:10px;
	margin:0px;
}

h2.logo
{
	font-family:Verdana;
	font-weight:normal;
	font-size:24px;
	margin-left:110px;
}

p.logo
{
	margin-left:110px;
	font-family:Verdana;
	font-size:13px;
}

div#header div.search input
{
	margin:0px;
	padding:0px;
}



/* Notizen */
td.notice
{
	margin:0px;
	padding:5%;
	text-align:center;
}
table.notice
{
	width:100%;
	border:1px solid;
	border-spacing:0px;
}
table.notice th
{
	padding:2px;
	white-space:nowrap;
	border-bottom:1px solid <?php echo $_GET['text_color']; ?>;
	font-weight:normal;
	text-align:left;
}

table.notice tr.error
{
}

table.notice tr.warning
{
	margin:0px;
	padding:0px;
}



/* Kalender */
table.calendar
{
	table-layout:fixed;
	border-collapse:collapse;
	text-align: center;
}
table.calendar td
{
	border: 1px dotted;
}

textarea.editor
{
	width:100%;
}

label,
fieldset.open > legend,
.clickable
{
	cursor: pointer;
}

body {
    cursor:default;
}

input {
    xcursor:text;
}


div.menu
{
	float:none;
	xclear:left;
}

fieldset
{
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	
	border-bottom:0px;
	border-left:0px;
	border-right:0px;
	
	margin-top:20px;
	margin-bottom:20px;
	margin-left:0px;
	margin-right:0px;
	padding:10px;
}

fieldset > legend
{
	margin-left:30px;
	font-weight:normal;
}


fieldset.open > div.invisible
{
	display:none;
}



form.xlogin
{
	xbackground-color:#E0E0D5;
	border:2px solid <?php echo $_GET['inactive_background_color']; ?>;
	position:absolute;
	z-index:999;
	top:5%;
	left:5%;
	width:80%;
	margin:5%;
	padding:10%;
	opacity:1;
	
	-webkit-box-shadow: 3px 2px 5px <?php echo $_GET['title_background_color']; ?>;
    -moz-box-shadow: 3px 2px 5px <?php echo $_GET['title_background_color']; ?>;
    box-shadow: 3px 2px 5px <?php echo $_GET['title_background_color']; ?>;
}







/*   B a u m   */
ul.tree,
ul.tree ul
{
	list-style-type: none;
	background: url(../images/tree_line.gif) repeat-y;
	margin: 0; padding: 0; 
}

ul.tree ul
{
	margin-left:18px;
}

div.entry.selected,
div.dropdown > div.entry:hover,
div.dropdown > div.entry:hover > a,
a.element
{
	/*border:1px solid <?php echo $_GET['text_color']; ?>;*/
	background-color:<?php echo $_GET['title_background_color']; ?>;
	color:<?php echo $_GET['title_text_color']; ?>;
}



ul.tree div.tree
{
	width:18px;
	min-width:18px;
	height:18px;
	xbackground-color:red;
	float:left;
}
ul.tree div.tree,
ul.tree div.entry
{
	height:18px;
	max-height:18px;
	min-height:18px;
}

ul.tree div img
{
	cfloat:left;
}

ul.tree li
{margin: 0; padding: 0 0px; 
	line-height: 18px;
	background: url(../images/tree_none.gif) no-repeat;
	xcolor: #369;
	font-weight: normal;
	white-space:nowrap;
}

ul.tree li.last,
ul.tree li:last-child
{
	background: url(../images/tree_none_end.gif) no-repeat;
} 

div.tree.open
{
	background: url(../images/tree_minus.png) no-repeat;
}
div.tree.closed
{
	background: url(../images/tree_plus.png) no-repeat;
}


body > div
{
	display:none;
}


/* Strukturen 
div.structure ul
{
	padding-left:10px;
	margin-left:10px;
}
*/

div.structure em
{
	font-style: italic;
}




/*   T a b s   */

.drophover
{
	border:2px dotted green;
	cursor: move;
}
.dropactive
{
	border:1px dotted blue;
	cursor: move;
}

div.panel div.header > div.icons
{
	/*float:right;*/
}

div.backward_link
{
	float:left;
}
div.forward_link
{
	float:right;
}

div.panel > div.header
{
	padding:0px;
	width:100%;
	height:25px;
	border-bottom: 1px solid <?php echo $_GET['title_background_color'] ?>;
}


div.panel div.header ul.views
{
	text-align: left; /* set to left, right or center */
	list-style-type: none;
	overflow: hidden; /* Gescrollt wird hier mit JavaScript */
	white-space:nowrap;
}

img.icon
{
	padding:4px;
	width: 16px;
	height: 16px;
}

 
ul.views div.tabname
{
	overflow: hidden;
	white-space: nowrap;
	padding:4px;
	vertical-align: middle;
}
ul.views > li > img,
ul.views > li > div
{
	float:left;
}

div.header div.icons,
div.inputholder > div.icon
{
	float: right;
}


div.panel div.header > ul.views
{
	float:left;
	height: 25px;
}

div.panel div.header
{
	xborder-bottom: 1px solid <?php echo $_GET['title_background_color']; ?>;
}


div.content 
{
	clear: both;
}

div.panel ul.views li
{
	vertical-align: middle;
	padding:0px;
	
	cursor:pointer;
	
	border-right: 1px solid <?php echo $_GET['title_background_color']; ?>;
	
	-moz-border-radius-topleft:5px; /* Mozilla */
    -webkit-border-radius-topleft:5px; /* Webkit */
    -khtml-border-top-radius-topleft:5px; /* Konqui */
    border-top-right-radius:5px;
	-moz-border-radius-topright:5px; /* Mozilla */
    -webkit-border-radius-topright:5px; /* Webkit */
    -khtml-border-top-radius-topright:5px; /* Konqui */
    border-top-right-radius:5px;
    
    xborder-top:1px solid <?php echo $_GET['title_background_color']; ?>;
    xborder-left:1px solid <?php echo $_GET['title_background_color']; ?>;
    xborder-right:1px solid <?php echo $_GET['title_background_color']; ?>;
    xmargin-right:10px;
	display: block;
	float:left;
}






/*

div#workbench div.frame {
	padding:3px;
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	
	-moz-border-radius:3px;
    -webkit-border-radius:3px;
    -khtml-border-radius:3px;
    border-radius:3px;
}
*/



/*
div.panel {
	padding:3px;
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	
	-moz-border-radius:5px;
    -webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius:5px;
}
*/



div.panel {
	margin:0px;
	padding:0px;
}

div.panel div.content table
{
	overflow:auto;
	border:2px <?php echo $_GET['inactive_background_color']; ?>;
}


table tr.headline > td {
	
	/*
    background-color: <?php echo $_GET['inactive_background_color']; ?>;
	background: -moz-linear-gradient(top, <?php echo $_GET['title_background_color']; ?>, <?php echo $_GET['inactive_background_color']; ?>);
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $_GET['title_background_color']; ?>), to(<?php echo $_GET['inactive_background_color']; ?>));
	
    border-right:1px solid <?php echo $_GET['inactive_background_color']; ?>;
    
    */
    border-bottom:1px solid <?php echo $_GET['title_background_color']; ?>;
    padding:3px;
    font-weight: bold;
}


table tr.data > td {
    border-bottom:1px solid <?php echo $_GET['title_background_color']; ?>;
    /*
    border-right:1px solid <?php echo $_GET['inactive_background_color']; ?>;
    */
    padding:3px;
}



/*   F a r b e n   */

/* Ungerade Tabellenzeilen (funktioniert nicht im FF) */
table > tr.data:nth-child(2n) {
	background-color: <?php echo $_GET['inactive_background_color']; ?>;
}

/* Datenzeile - Mauseffekt */
table tr.data:hover,
div.content li div.entry:hover
{
	background-color:<?php echo $_GET['inactive_background_color']; ?>;;
}

ul.tree div
{
cursor:pointer;
}


/* Hintergrund Fenster */
/*

div.panel {
	background-color: #3399FF;
}
*/




/*   S t a t u s z e i l e   */
div.panel div.status
{
	padding:10px;
}


div.panel div.status div.error,
div.message.error
{
	background: url(../images/notice_error.png) no-repeat;
	background-position:5px 7px;
}
div.panel div.status div.warn,
div.message.warn
{
	background: url(../images/notice_warning.png) no-repeat;
	background-position:5px 7px;
}
div.panel div.status div.ok,
div.message.ok
{
	background: url(../images/notice_ok.png) no-repeat;
	background-position:5px 7px;
}
div.panel div.status div.info,
div.message.info
{
	background: url(../images/notice_info.png) no-repeat;
	background-position:5px 7px;
}

div.panel div.status div,
div.message
{
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	padding:5px 0px 5px 25px;
	margin:10px 10px 20px 10px;
	
	-moz-border-radius:5px;
    -webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius:5px;
}

/* Fortschrittsbalken */
div.loader,
div.progress
{
	background: url(../images/loader.gif) no-repeat;
	background-position: center;
	opacity: 0.5;
	cursor: wait;
}



/*   V o l l b i l d   */
div#workbench div.panel.fullscreen
{
	display:block;
	z-index:109;

    /*set the div in the top-left corner of the screen*/
    position:fixed;
    top:0;
    left:0;
    background-color:<?php echo $_GET['background_color']; ?>;
    margin:0px;
    
    /*set the width and height to 100% of the screen*/
    width:100% !important;
    height:100% !important;
}
div#workbench div.panel.fullscreen > div.content
{
    width:100% !important;
    height:100% !important;
}

.invisible
{
	visibility:hidden;
}
.visible
{
	visibility:visible;
}


div#workbench
{
	width:100%;
}

body
{
	overflow:hidden;
}

div#workbench div.panel
{
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	margin:0px;
	padding:0px;
	-moz-border-radius:5px;
    -webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius:5px;
}

div#workbench div.container,
div#workbench div.panel,
div#workbench div.divider
{
	display: inline;
	float: left;
	margin: 0px;
}

div#workbench
{
	padding:3px;
}


div#workbench div.panel > div.content
{
	overflow:auto;
}


/*
 * Formular-Button-Leiste
 */
div.panel {
	position:relative;
}
div.content div.bottom
{
	xbackground-color: <?php echo $_GET['background_color']; ?>;
	height:55px;
	width:100%;
	position:absolute;
	padding-right:40px;
	bottom:0px;
	right:0px;
	visibility:hidden;
}

div.content div.bottom > div.command
{
	xvisibility:visible;
	float:right;
	z-index:20;
}

div.content > form
{
	padding-bottom:45px;
}

input.submit
{
	background-color: <?php echo $_GET['title_background_color']; ?>;
	color: <?php echo $_GET['title_text_color']; ?>;
	padding: 7px;
	border:0px;
	-moz-border-radius:7px; /* Mozilla */
    -webkit-border-radius:7px; /* Webkit */
    -khtml-border-radius:7px; /* Konqui */
    border-radius:7px;
    margin-left:20px;
	-webkit-box-shadow: 0px 0px 15px <?php echo $_GET['background_color']; ?>;
    -moz-box-shadow: 0px 0px 15px <?php echo $_GET['background_color']; ?>;
    box-shadow: 0px 0px 15px 10px <?php echo $_GET['background_color']; ?>;
    cursor:pointer;
}


input.submit.ok
{
	font-weight:bold; /* Primäre Aktion in Fettdruck */
}


/* Pfeile nur anzeigen, wenn Maus über der Titelleiste */
div.views > div.backward_link,
div.views > div.forward_link
{
	visibility: hidden;
}
div.views:HOVER > div.backward_link,
div.views:HOVER > div.forward_link
{
	visibility: visible;
}


div#shortcuts {
	height:24px;
	margin-left:10px;
}
div#shortcuts > div.shortcut {
	width:24px;
	height:24px;
	margin-left:5px;
	float:left;
    opacity:0.8;
}

div#shortcuts > div.shortcut:HOVER {
	
	xborder: 1px solid <?php echo $_GET['title_background_color']; ?>;
	x-moz-border-radius:2px; /* Mozilla */
    x-webkit-border-radius:2px; /* Webkit */
    x-khtml-border-radius:2px; /* Konqui */
    opacity:1.0;
    position:relative;
    bottom:3px;
	
}




/* Smaller screens */

@media only screen and (max-width: 1023px) {

	body {
	font-size: 0.8em;
	line-height: 1.5em;
	}
	
	}


/* Mobile */

@media handheld, only screen and (max-width: 767px) {

	body {
		font-size: 16px;
		-webkit-text-size-adjust: none;
		overflow: visible;
	}
	div#header,
	div#workbench {
		width: 100%;
		height: auto;
		min-width: 0;
		margin-left: 0px;
		margin-right: 0px;
		padding-left: 0px;
		padding-right: 0px;
	}
	
	div#workbench div.panel
	{
		width:auto !important;
	}
	
	li.action div.tabname
	{
		width:auto !import;ant;
	}
	
	div#workbench div.panel
	{
		width: auto;
		float: none;
		margin-left: 0px;
		margin-right: 0px;
		padding-left: 20px;
		padding-right: 20px;
	}
	div#workbench div.panel > div.content
	{
		overflow:auto;
		height: auto !important;
	}
	
}


















body > div#header {
	display:block;
}

ul#history >  li {
	
	xdisplay:inline;
	margin:5px;
	padding:5px;
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	background-color: <?php echo $_GET['inactive_background_color']; ?>;
	color:<?php echo $_GET['text_color']; ?>;
}
ul#history >  li.active {
	
	xdisplay:inline;
	margin:5px;
	padding:5px;
	border:1px solid <?php echo $_GET['text_color']; ?>;
	background-color: <?php echo $_GET['title_text_color']; ?>;
	color:<?php echo $_GET['text_color']; ?>;
}

ul#history {
	display:none;
}


table td.readonly {
	font-style: italic;
	font-weight: normal;
}
table td.default {
	font-style: normal;
	font-weight: normal;
}
table td.changed {
	font-style: normal;
	font-weight: bold;
}


/* Modale Dialoge */

div#filler
{
	xxxxdisplay: block;
	position:absolute;
	z-index: 100;
	top: 0;
	left: 0;
	height:100%;
	width:100%;
	background-color: <?php echo $_GET['text_color']; ?>;
	opacity: 0.5;
}

div#workbench div.panel.modal
{
	
	/*width:60%;*/
	position:relative;
	xtop:0;
	xleft:0;
	
	z-index: 101;
	
	border:1px solid <?php echo $_GET['text_color']; ?> !important;
	/*
	border:3px solid <?php echo $_GET['text_color']; ?> !important;
	background-color:<?php echo $_GET['title_text_color']; ?> !important;
	*/
	/*
	
	margin:5% 20% !important;
	*/
	
	-webkit-box-shadow: 0px 0px 40px <?php echo $_GET['text_color']; ?>;
    -moz-box-shadow: 0px 0px 40px  <?php echo $_GET['text_color']; ?>;
    box-shadow: 0px 0px 40px <?php echo $_GET['text_color']; ?>;
    
}



div#dialog
{
	background-color:<?php echo $_GET['background_color']; ?>;
	color:<?php echo $_GET['text_color']; ?>;
	overflow: auto;

	/*width:60%;*/
	position:absolute;
	top:5%;
	left:10%;
	width:80%;
	height:80%;
	
	z-index: 104;
	
	border:1px solid <?php echo $_GET['text_color']; ?> !important;
	
	
	-webkit-box-shadow: 0px 0px 40px <?php echo $_GET['text_color']; ?>;
    -moz-box-shadow: 0px 0px 40px  <?php echo $_GET['text_color']; ?>;
    box-shadow: 0px 0px 40px <?php echo $_GET['text_color']; ?>;
    
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius:5px;
}
 


 /* Voreingestellte Schriftart */
body
{

}



/* Formulare breit */
div.panel.wide form div.line
{
	clear:left;
	margin-top:10px;
}

div.panel.wide form div.label
{
	display:inline-block;
	width:30%;
	vertical-align:top;
	text-align: right;
}

div.panel.wide form div.input
{
	display:inline-block;
	width:60%;
	vertical-align:top;
	text-align: left;
}

/* Formulare schmal */
div.panel.small form div.line
{
	clear:left;
	padding:10px;
}

div.panel.small form div.label
{
	display:block;
	width:100%;
	vertical-align:top;
	text-align: left;
}

div.panel.small form div.input
{
	display:block;
	width:100%;
	vertical-align:top;
	text-align: left;
}



form div.label > label,
form div.input > div.intputholder
{
	padding:0px 5px;
}

form div.input input[type=text],
form div.input input[type=password],
form div.input textarea,
form div.input select
{
	width:100%;
}
form div.input input[type=checkbox],
form div.input input[type=radio]
{
	vertical-align:top;
}

label
{
	display:inline-block;
}

input[type=checkbox] + label,
input[type=radio] + label
{
	width:80%;
}

label div.description
{
	font-size: 0.75em;
	color:<?php echo $_GET['title_background_color']; ?>;
}


div.inputholder
{
	background-color:<?php echo $_GET['title_text_color']; ?>;
	border:1px solid <?php echo $_GET['title_background_color']; ?>;
	margin:0px;
	padding:4px;
	-moz-border-radius:3px;
    -webkit-border-radius:3px;
    -khtml-border-radius:3px;
    border-radius:3px;
    
    -webkit-box-shadow:inset 0px 0px 3px <?php echo $_GET['title_background_color']; ?>;
    -moz-box-shadow:inset 0px 0px 3px  <?php echo $_GET['title_background_color']; ?>;
    box-shadow:inset 0px 0px 3px <?php echo $_GET['title_background_color']; ?>;
    
}


div.inputholder ul.tree,
div.inputholder ul.tree li.last,
div.inputholder ul.tree li:last-child
{
	background-color:<?php echo $_GET['title_text_color']; ?>;
}

div.inputholder > div.dropdown
{
	width:70%;
}

div.search > div.inputholder
{
	padding-top:1px;
}

div.inputholder > input,
div.inputholder > textarea,
div.inputholder > select
{
	border:0px;
	border-bottom:1px solid <?php echo $_GET['title_text_color']; ?>;
	padding:2px;
	margin:0px;
	background-color:<?php echo $_GET['title_text_color']; ?>;
}

input:focus,
textarea:focus,
select:focus
{
	border:0px;
	border-bottom:1px solid <?php echo $_GET['inactive_background_color']; ?>;
}


input.error,
textarea.error,
select.error
{
	border-bottom:1px dotted <?php echo $_GET['text_color']; ?> !important;
}

div.inputholder.error
{
	border:1px solid red !important;
}

input.hint
{
	color:<?php echo $_GET['title_background_color']; ?>;
}




/* Eingabfeld fuer Namen */
fieldset > div input.name,
fieldset > div span.name
{
	font-weight:bold;
}


/* Eingabfelder fuer Dateiname */
fieldset > div input.filename,
fieldset > div input.extension,
fieldset > div input.ansidate,
fieldset > div span.filename,
fieldset > div span.extension,
fieldset > div span.ansidate
{
	font-family:Courier;
	font-size:1em;
}


div#tree
{
	overflow:visible;
}





/* Anzeige von Text-Unterschieden */

/* Zeilen-Nr */
tr.diff > td.line
{
	background-color:<?php echo $_GET['title_text_color']; ?>;
	padding-right:2px;
	border-right:3px solid <?php echo $_GET['title_background_color']; ?>;
	text-align:right;
	margin-right:2px;
}

/* Unveränderter Text */
tr.diff > td.equal
{
}

/* Entfernter Text */
tr.diff > td.old
{
	background-color:red;
}

/* Hinzugefuegter Text */
tr.diff > td.new
{
	background-color:green;
}

/* Geaenderter Text */
tr.diff > td.notequal
{
	background-color:yellow;
}

dl.notice
{
	border-left:10px <?php echo $_GET['inactive_background_color']; ?> solid;
	border-right:1px <?php echo $_GET['inactive_background_color']; ?> solid;
	padding:15px;
}

dl.notice > dt
{
	border-top: 1px <?php echo $_GET['inactive_background_color']; ?> solid;
}
dl.notice > dd
{
	border-bottom: 1px <?php echo $_GET['inactive_background_color']; ?> solid;
}


/*   S c h a t t e n   */
div.content a.action,
div.content a.help
{
	-webkit-box-shadow: 3px 2px 5px <?php echo $_GET['title_background_color']; ?>;
    -moz-box-shadow: 3px 2px 5px <?php echo $_GET['title_background_color']; ?>;
    box-shadow: 3px 2px 5px <?php echo $_GET['title_background_color']; ?>;
}



/*   F a r b e n   */

/* Gesamt-Hintergrund */
body
{
	xxxbackground-color:#c9c9c9;
	background-color:<?php echo $_GET['inactive_background_color'] ?>;
}

/* Fenster-Hintergrund */
div.panel ul.views > li.active,
div.panel ul.views > li.active:hover
{
	background-color: <?php echo $_GET['title_background_color']; ?>;
	background-image: linear-gradient(<?php echo $_GET['inactive_background_color']; ?> 0%, <?php echo $_GET['title_background_color']; ?> 15%);
	color: <?php echo $_GET['title_text_color']; ?>;
}

div#header                   /* Titelleite-Hintergrund */
{
	background-color: <?php echo $_GET['title_background_color']; ?>;
	background-image: linear-gradient(<?php echo $_GET['title_background_color']; ?> 85%, <?php echo $_GET['inactive_background_color']; ?> 100%);
	color: <?php echo $_GET['title_text_color']; ?>;
}

div#header, /* Titelleite */
ul.views > li.action /* Tabreiter */
{
 	font-family: Arial, sans-serif;
	font-size:13px;
}

div.content
{
	font-family: Trebuchet MS, Helvetica, Arial, sans-serif;
	font-size:13px;
}


/* Reiter */
div.panel ul.views li
{
	/*
	background-color:<?php echo $_GET['background_color']; ?>;
	*/
}


div.panel > div.content
{
	background-color:<?php echo $_GET['background_color']; ?>;
}

div.panel > div.header
{
	background-color:<?php echo $_GET['background_color']; ?>;
	background-image: linear-gradient(<?php echo $_GET['inactive_background_color']; ?> 00%, <?php echo $_GET['background_color']; ?> 85%);
}
	



div.panel ul.views li:hover {
	background-color: <?php echo $_GET['inactive_background_color']; ?>;
	/*
	color: blue;
	*/
}



ul.tree li.last,
ul.tree li:last-child
{
	background-color:<?php echo $_GET['background_color']; ?>;
}

div.content pre,
div.dropdown
{
	background-color:<?php echo $_GET['title_text_color']; ?>;
}


/*   D r o p d o w n  -  M e n u e s  */
div.dropdown
{
	/* Schatten */
	-webkit-box-shadow: 3px 2px 10px <?php echo $_GET['title_background_color']; ?>;
    -moz-box-shadow: 3px 2px 10px <?php echo $_GET['title_background_color']; ?>;
    box-shadow: 3px 2px 10px <?php echo $_GET['title_background_color']; ?>;
	
	opacity:0.95;
	
	border:2px solid <?php echo $_GET['title_background_color']; ?>;
	-moz-border-radius:5px; /* Mozilla */
    -webkit-border-radius:5px; /* Webkit */
    -khtml-border-radius:5px; /* Konqui */
    border-radius:5px;
    
    /*
	background: -moz-linear-gradient(top, <?php echo $_GET['title_background_color']; ?>, <?php echo $_GET['inactive_background_color']; ?>);
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $_GET['title_background_color']; ?>), to(<?php echo $_GET['inactive_background_color']; ?>));
	*/
	font-style:normal;
	font-weight:normal;
	text-decoration:none;
}


div#header span.titletext
{
	color:<?php echo $_GET['title_text_color']; ?>;
}



div.filler div.headermenu > a.entry,
div.filler div.header a.back.button
{
	font-size: 0.8em;
}


div.container.axle-x > div.divider
{
	width:5px;
}
div.container.axle-y > div.divider
{
	height:5px;
}

/* Pfeile */
div.divider.to-left
{
	cursor: w-resize;
}
div.divider.to-right
{
	cursor: e-resize;
}
div.divider.to-top
{
	cursor: n-resize;
}
div.divider.to-bottom
{
	cursor: s-resize;
}

/* Mouseover */
div.container > div.divider.ui-draggable-dragging
{
	z-index: 150;
	background-color: <?php echo $_GET['title_background_color']; ?>;
}

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



/* Pfeile */
div#workbench div.panel div.arrow-down
{
	width:0;
	height:0;
	margin:6px;
	padding:0px;
	border-right  : 6px solid transparent;
	border-top    : 6px solid <?php echo $_GET['title_background_color']; ?>;
	border-left   : 6px solid transparent;
	border-bottom : 4px solid transparent;
	margin-top: 10px;
	font-size: 0;
}
/* Pfeile */
div#workbench div.panel div.arrow-right
{
	width:0;
	height:0;
	margin:6px;
	padding:0;
	border-top:    6px solid transparent;
	border-left:   6px solid <?php echo $_GET['title_background_color']; ?>;
	border-bottom: 6px solid transparent;
	border-right:  4px solid transparent;
	margin-left:  10px;
	font-size: 0;
}


div#workbench div.panel li.action.dirty
{
	font-weight: bold;
}
 
 


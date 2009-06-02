-- phpMyAdmin SQL Dump
-- version 3.1.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. Juni 2009 um 00:21
-- Server Version: 5.0.75
-- PHP-Version: 5.2.6-3ubuntu4.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `cmsdemo`
--

--
-- Daten für Tabelle `or_acl`
--

INSERT INTO `or_acl` (`id`, `userid`, `groupid`, `objectid`, `languageid`, `is_write`, `is_prop`, `is_create_folder`, `is_create_file`, `is_create_link`, `is_create_page`, `is_delete`, `is_release`, `is_publish`, `is_grant`, `is_transmit`) VALUES
(1, 2, NULL, 1, NULL, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '0'),
(2, 2, NULL, 2, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, '0'),
(3, 2, NULL, 3, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, '0'),
(4, 2, NULL, 4, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, '0'),
(5, 2, NULL, 5, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, '0'),
(6, 2, NULL, 6, NULL, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '0'),
(7, 2, NULL, 7, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, '0'),
(8, 2, NULL, 8, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, '0');

--
-- Daten für Tabelle `or_element`
--

INSERT INTO `or_element` (`id`, `templateid`, `name`, `descr`, `type`, `subtype`, `with_icon`, `dateformat`, `wiki`, `html`, `all_languages`, `writable`, `decimals`, `dec_point`, `thousand_sep`, `code`, `default_text`, `folderobjectid`, `default_objectid`) VALUES
(1, 1, 'stylesheet', '', 'link', 'file,page,link', '0', '', '0', '0', '0', '0', 0, '', '', '', '', 1, 3),
(2, 1, 'title', '', 'info', 'page_name', '0', '', '0', '0', '0', '0', 0, '', '', '', '', NULL, NULL),
(3, 1, 'text', '', 'longtext', '', '0', '', '1', '0', '0', '1', 0, '', '', '', '', NULL, NULL),
(4, 1, 'menu', '', 'dynamic', 'ClassicMenu', '0', '', '0', '0', '0', '0', 0, '', '', '', '', NULL, NULL),
(5, 1, 'username', '', 'info', 'lastch_user_username', '0', '', '0', '0', '0', '0', 0, '', '', '', '', NULL, NULL),
(6, 1, 'date', '', 'infodate', 'date_saved', '0', 'F j, Y, g:i a', '0', '0', '0', '0', 0, '', '', '', '', NULL, NULL);

--
-- Daten für Tabelle `or_file`
--

INSERT INTO `or_file` (`id`, `objectid`, `extension`, `size`, `value`) VALUES
(1, 3, '', 1966, 0x613a6c696e6b7b636f6c6f723a233032324135303b20666f6e742d7765696768743a626f6c643b20746578742d6465636f726174696f6e3a756e6465726c696e65207d0d0a613a6163746976657b636f6c6f723a233032324135303b20666f6e742d7765696768743a626f6c643b20746578742d6465636f726174696f6e3a756e6465726c696e65207d0d0a613a766973697465647b636f6c6f723a233032324135303b20666f6e742d7765696768743a626f6c643b20746578742d6465636f726174696f6e3a756e6465726c696e65207d0d0a613a686f7665727b636f6c6f723a233032324135303b20666f6e742d7765696768743a626f6c643b20746578742d6465636f726174696f6e3a756e6465726c696e65207d0d0a0d0a6c692e6d656e753220617b636f6c6f723a233032324135303b20666f6e742d7765696768743a6e6f726d616c3b20746578742d6465636f726174696f6e3a756e6465726c696e65207d0d0a0d0a626f64797b636f6c6f723a233030303030303b20666f6e742d66616d696c793a417269616c3b666f6e742d73697a653a313370783b206261636b67726f756e642d636f6c6f723a77686974653b206d617267696e3a3070783b207d0d0a20202020200d0a7464207b666f6e742d66616d696c793a417269616c3b666f6e742d73697a653a313370783b20766572746963616c2d616c69676e3a746f703b207d0d0a0d0a0d0a74642e6f62656e207b20626f726465722d626f74746f6d3a3235707820736f6c696420233742394342443b207d0d0a74642e7375626d656e75207b20626f726465722d72696768743a31707820736f6c696420233742394342443b207d0d0a74642e6d656e75207b20766572746963616c2d616c69676e3a626f74746f6d3b20746578742d616c69676e3a72696768743b207d0d0a0d0a756c2e7375626d656e75207b206c696e652d6865696768743a323570783b2070616464696e672d6c6566743a3070783b207d0d0a0d0a756c2e6d656e7530207b206c696e652d6865696768743a323570783b2070616464696e673a3070783b206d617267696e3a3070783b206c6973742d7374796c652d747970653a6e6f6e653b207d0d0a6c692e6d656e7530207b20666f6e742d73697a653a313670783b206d617267696e2d746f703a3570783b207d0d0a0d0a756c2e6d656e7531207b20626f726465722d6c6566743a2032707820736f6c696420233742394342443b2070616464696e673a3670783b206d617267696e3a3070783b206c6973742d7374796c652d747970653a6e6f6e653b207d0d0a6c692e6d656e7531207b20666f6e742d73697a653a313370783b20207d0d0a0d0a756c2e6d656e7532207b20626f726465722d6c6566743a2032707820736f6c696420233742394342443b206d617267696e3a3070783b2070616464696e673a3570783b206c6973742d7374796c652d747970653a6e6f6e653b20207d0d0a6c692e6d656e7532207b20666f6e742d7765696768743a6e6f726d616c3b20666f6e742d73697a653a313270783b20207d0d0a0d0a6474207b20626f726465722d6c6566743a31707820736f6c696420233742394342443b20626f726465722d746f703a31707820736f6c696420233742394342443b2070616464696e673a3270783b206d617267696e2d626f74746f6d3a3570783b207d0d0a6464207b20626f726465722d72696768743a31707820736f6c696420233742394342443b20626f726465722d626f74746f6d3a31707820736f6c696420233742394342443b2070616464696e673a3270783b206d617267696e2d626f74746f6d3a313070783b207d0d0a0d0a707265207b20626f726465723a31707820736f6c696420233742394342443b206261636b67726f756e642d636f6c6f723a234437453546333b2070616464696e673a3570783b207d0d0a636f6465207b20626f726465722d6c6566743a32707820736f6c696420233742394342443b626f726465722d72696768743a32707820736f6c696420233742394342443b206261636b67726f756e642d636f6c6f723a234437453546333b2070616464696e672d6c6566743a3370783b2070616464696e672d72696768743a3370783b207d0d0a0d0a626c6f636b71756f7465207b20626f726465722d6c6566743a3130707820736f6c696420233742394342443b20626f726465722d746f703a31707820736f6c696420234437453546333b626f726465722d72696768743a31707820736f6c696420234437453546333b626f726465722d626f74746f6d3a31707820736f6c696420234437453546333b206d617267696e2d6c6566743a313070783b2070616464696e672d6c6566743a313070783b207d0d0a0d0a6831207b20636f6c6f723a233742394342443b20666f6e742d7765696768743a6e6f726d616c3b20666f6e742d73697a653a322e32656d3b207d0d0a6832207b20636f6c6f723a233742394342443b20666f6e742d7765696768743a6e6f726d616c3b20666f6e742d73697a653a312e38656d3b7d0d0a6833207b20636f6c6f723a233742394342443b20666f6e742d7765696768743a6e6f726d616c3b20666f6e742d73697a653a312e34656d3b7d0d0a6834207b20636f6c6f723a233742394342443b20666f6e742d7765696768743a6e6f726d616c3b20666f6e742d73697a653a312e32656d3b7d);

--
-- Daten für Tabelle `or_folder`
--

INSERT INTO `or_folder` (`id`, `objectid`) VALUES
(1, 1),
(2, 6);

--
-- Daten für Tabelle `or_group`
--

INSERT INTO `or_group` (`id`, `name`) VALUES
(1, 'Redakteure'),
(2, 'LDAP-Test-1'),
(3, 'presidents');

--
-- Daten für Tabelle `or_language`
--

INSERT INTO `or_language` (`id`, `projectid`, `isocode`, `name`, `is_default`) VALUES
(1, 1, 'en', 'english', 1),
(2, 1, 'DE', 'German', 0);

--
-- Daten für Tabelle `or_link`
--


--
-- Daten für Tabelle `or_name`
--

INSERT INTO `or_name` (`id`, `objectid`, `name`, `descr`, `languageid`) VALUES
(1, 1, 'demo site', '', 1),
(2, 2, 'cars', '', 1),
(3, 3, 'demo stylesheet', '', 1),
(5, 5, 'tanks', '', 1),
(4, 4, 'bicycles', '', 1),
(6, 6, 'other', '', 1),
(7, 7, 'animals', '', 1),
(8, 8, 'oceans', '', 1);

--
-- Daten für Tabelle `or_object`
--

INSERT INTO `or_object` (`id`, `parentid`, `projectid`, `filename`, `orderid`, `create_date`, `create_userid`, `lastchange_date`, `lastchange_userid`, `is_folder`, `is_file`, `is_page`, `is_link`) VALUES
(1, NULL, 1, 'demo site', 99999, 1243978825, 2, 1243980196, 2, 1, 0, 0, 0),
(2, 1, 1, '2', 99999, 1243978825, 2, 1243980638, 2, 0, 0, 1, 0),
(3, 1, 1, 'demo.css', 99999, 1243979266, 2, 1243979283, 2, 0, 1, 0, 0),
(4, 1, 1, '4', 99999, 1243979699, 2, 1243979842, 2, 0, 0, 1, 0),
(5, 1, 1, '5', 99999, 1243980122, 2, 1243980500, 2, 0, 0, 1, 0),
(6, 1, 1, '6', 99999, 1243980196, 2, 1243980228, 2, 1, 0, 0, 0),
(7, 6, 1, '7', 99999, 1243980211, 2, 1243980421, 2, 0, 0, 1, 0),
(8, 6, 1, '8', 99999, 1243980228, 2, 1243980478, 2, 0, 0, 1, 0);

--
-- Daten für Tabelle `or_page`
--

INSERT INTO `or_page` (`id`, `objectid`, `templateid`) VALUES
(1, 2, 1),
(2, 4, 1),
(3, 5, 1),
(4, 7, 1),
(5, 8, 1);

--
-- Daten für Tabelle `or_project`
--

INSERT INTO `or_project` (`id`, `name`, `target_dir`, `ftp_url`, `ftp_passive`, `cmd_after_publish`, `content_negotiation`, `cut_index`) VALUES
(1, 'demo site', '', '', 0, '', 0, 0);

--
-- Daten für Tabelle `or_projectmodel`
--

INSERT INTO `or_projectmodel` (`id`, `projectid`, `name`, `extension`, `is_default`) VALUES
(1, 1, 'html', '', '0');

--
-- Daten für Tabelle `or_template`
--

INSERT INTO `or_template` (`id`, `projectid`, `name`) VALUES
(1, 1, 'my_template');

--
-- Daten für Tabelle `or_templatemodel`
--

INSERT INTO `or_templatemodel` (`id`, `templateid`, `projectmodelid`, `extension`, `text`) VALUES
(1, 1, 1, 'html', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"\r\n          "http://www.w3.org/TR/html4/loose.dtd">\r\n<html>\r\n  <head>\r\n    <title>{{2}}</title>\r\n    <meta name="author" content="Jan Dankert">\r\n    <link type="text/css" href="{{1}}" rel="stylesheet"> \r\n  </head>\r\n  <body>\r\n    <table width="100%" cellpadding="10" cellspacing="0">\r\n      <tr>\r\n\r\n        <td class="oben">\r\n          <table width="100%">\r\n            <tr>\r\n              <td class=""><h1>{{2}}</h2></td>\r\n              <td class="menu">... a simple openrat demo site</td>\r\n\r\n            </tr>\r\n          </table>\r\n        </td>\r\n      </tr>\r\n      <tr>\r\n        <td>\r\n          <table width="100%" cellpadding="10">\r\n            <tr>\r\n              <td class="submenu" width="100">\r\n{{4}}\r\n</td>\r\n              <td colspan="2">\r\n\r\n{{3}}\r\n\r\n<hr size="1">\r\nLast edited on {{6}} by the user \r\n{{5}}.\r\n</td>\r\n\r\n            </tr>\r\n          </table>\r\n        </td>\r\n      </tr>\r\n    </table>\r\n  </body>\r\n</html>\r\n\r\n\r\n');

--
-- Daten für Tabelle `or_user`
--

INSERT INTO `or_user` (`id`, `name`, `password`, `ldap_dn`, `fullname`, `tel`, `mail`, `descr`, `style`, `is_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'Administrator', '', '', 'Admin user', 'default', 1),
(2, 'dankert', '', 'uid=dankert,ou=users,dc=ss19a', 'dankert', '', '', '', '', 1),
(3, 'george', '', '', '', '', '', '', 'default', 0),
(4, 'barack', '', '', '', '', '', '', 'default', 0);

--
-- Daten für Tabelle `or_usergroup`
--

INSERT INTO `or_usergroup` (`id`, `userid`, `groupid`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 1),
(5, 3, 3),
(6, 4, 3);

--
-- Daten für Tabelle `or_value`
--

INSERT INTO `or_value` (`id`, `pageid`, `languageid`, `elementid`, `linkobjectid`, `text`, `number`, `date`, `active`, `publish`, `lastchange_date`, `lastchange_userid`) VALUES
(1, 1, 1, 3, NULL, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', NULL, NULL, 0, 0, 1243979831, 2),
(2, 2, 1, 3, NULL, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', NULL, NULL, 1, 1, 1243979842, 2),
(3, 1, 1, 3, NULL, 'Überall dieselbe alte Leier. Das Layout ist fertig, der Text lässt auf sich warten. Damit das Layout nun nicht nackt im Raume steht und sich klein und leer vorkommt, springe ich ein: der Blindtext. Genau zu diesem Zwecke erschaffen, immer im Schatten meines großen Bruders »Lorem Ipsum«, freue ich mich jedes Mal, wenn Sie ein paar Zeilen lesen. Denn esse est percipi - Sein ist wahrgenommen werden. Und weil Sie nun schon die Güte haben, mich ein paar weitere Sätze lang zu begleiten, möchte ich diese Gelegenheit nutzen, Ihnen nicht nur als Lückenfüller zu dienen, sondern auf etwas hinzuweisen, das es ebenso verdient wahrgenommen zu werden: Webstandards nämlich. Sehen Sie, Webstandards sind das Regelwerk, auf dem Webseiten aufbauen. So gibt es Regeln für HTML, CSS, JavaScript oder auch XML; Worte, die Sie vielleicht schon einmal von Ihrem Entwickler gehört haben. Diese Standards sorgen dafür, dass alle Beteiligten aus einer Webseite den größten Nutzen ziehen. Im Gegensatz zu früheren Webseiten müssen wir zum Beispiel nicht mehr zwei verschiedene Webseiten für den Internet Explorer und einen anderen Browser programmieren. Es reicht eine Seite, die - richtig angelegt - sowohl auf verschiedenen Browsern im Netz funktioniert, aber ebenso gut für den Ausdruck oder', NULL, NULL, 0, 0, 1243980076, 2),
(4, 3, 1, 3, NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', NULL, NULL, 0, 0, 1243980160, 2),
(5, 4, 1, 3, NULL, 'Uh, here are some *animals*.\r\n- elephant\r\n- mouse\r\n- tiger', NULL, NULL, 1, 1, 1243980421, 2),
(6, 5, 1, 3, NULL, 'Do you know some _oceans_?\r\n\r\nLike...\r\n- Atlantic\r\n- Pacific\r\n', NULL, NULL, 1, 1, 1243980478, 2),
(7, 3, 1, 3, NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\r\n\r\nAenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.\r\n\r\nVivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.\r\n\r\nMaecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', NULL, NULL, 1, 1, 1243980500, 2),
(8, 1, 1, 3, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, 1, 1, 1243980638, 2);

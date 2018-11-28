<?php

namespace {

    define('OR_FILE_FILTER_LESS',1);
}

namespace cms\action
{
    use cms\model\BaseObject;

    use cms\model\Text;
    use \Html;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


    /**
     * Action-Klasse zum Bearbeiten einer Datei
     * @author Jan Dankert
     * @package openrat.actions
     */
    class TextAction extends FileAction
    {
        public $security = SECURITY_USER;

        var $text;

        /**
         * Konstruktor
         */
        function __construct()
        {
            parent::__construct();
        }


        public function init()
        {

            $this->text = new Text($this->getRequestId());
            $this->text->load();

            $this->file = $this->text;

            parent::init();
        }


        public function valuePost()
        {
            $this->file->value = $this->getRequestVar('value', OR_FILTER_RAW);
            $this->file->saveValue();

            $this->addNotice($this->file->getType(), $this->file->name, 'VALUE_SAVED', 'ok');
            $this->file->setTimestamp();
        }


        function propView()
        {

            global $conf;

            if ($this->file->filename == $this->file->objectid)
                $this->file->filename = '';

            // Eigenschaften der Datei uebertragen
            $this->setTemplateVars($this->file->getProperties());

            $this->setTemplateVar('size', number_format($this->file->size / 1000, 0, ',', '.') . ' kB');
            $this->setTemplateVar('full_filename', $this->file->full_filename());

            if (is_file($this->file->tmpfile())) {
                $this->setTemplateVar('cache_filename', $this->file->tmpfile());
                $this->setTemplateVar('cache_filemtime', @filemtime($this->file->tmpfile()));
            }

            // Alle Seiten mit dieser Datei ermitteln
            $pages = $this->file->getDependentObjectIds();

            $list = array();
            foreach ($pages as $id) {
                $o = new BaseObject($id);
                $o->load();
                $list[$id] = array();
                $list[$id]['url'] = Html::url('main', 'page', $id);
                $list[$id]['name'] = $o->name;
            }
            asort($list);
            $this->setTemplateVar('pages', $list);
            $this->setTemplateVar('edit_filename', $conf['filename']['edit']);

            $this->setTemplateVar('filterlist', array(
                OR_FILE_FILTER_LESS => 'less'
            ));
        }


        /**
         * Abspeichern der Eigenschaften zu dieser Datei.
         *
         */
        function propPost()
        {
            // Eigenschaften speichern
            $this->file->filename = $this->getRequestVar('filename', OR_FILTER_FILENAME);
            $this->file->name = $this->getRequestVar('name', OR_FILTER_FULL);
            $this->file->extension = $this->getRequestVar('extension', OR_FILTER_FILENAME);
            $this->file->desc = $this->getRequestVar('description', OR_FILTER_FULL);
            $this->file->filterid = $this->getRequestVar('filterid', OR_FILTER_NUMBER);

            $this->file->save();
            $this->file->setTimestamp();
            $this->addNotice($this->file->getType(), $this->file->name, 'PROP_SAVED', 'ok');
        }


    }
}

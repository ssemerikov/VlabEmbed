<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ChemCollective Virtual Lab filter for Moodle 2.0
 *
 *  This filter will replace links to a Vlab file (.xml) in [vlab]...[/vlab] block 
 *  with a java applet that plays that ChemCollective Virtual Lab inline
 *
 * @package    filter_vlabembed
 * @copyright  2015 Pavlo Nechipurenko, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * __________________________________________________________________________
 */

$string['filtername'] = 'VlabEmbed';
$string['vlabembed_extsrc'] = 'Paths to download Vlab applet files';
$string['vlabembed_extsrc_comment'] = 'Try to automatically download Vlab applet files from external sources or ChemCollective site';
$string['vlabembed_width'] = 'Vlab applet width';
$string['vlabembed_height'] = 'Vlab applet height';
$string['vlabembed_lang'] = 'Vlab applet language';
$string['vlab_copyright'] = 'IrYdium Project\'s Virtual Lab is a project of the Chemistry Collective at the Carnegie Mellon';
$string['vlabembed_langcode_EN'] = 'English';
$string['vlabembed_langcode_AR'] = 'Arabic';
$string['vlabembed_langcode_CA'] = 'Catalan';
$string['vlabembed_langcode_ES'] = 'Spanish';
$string['vlabembed_langcode_GL'] = 'Galician';
$string['vlabembed_langcode_LT'] = 'Lithuanian';
$string['vlabembed_langcode_BR'] = 'Portuguese (Brasil)';
$string['vlabembed_langcode_ZH'] = 'Chinese';
$string['vlabembed_langcode_DE'] = 'German';
$string['vlabembed_langcode_FR'] = 'French';
$string['vlabembed_langcode_GR'] = 'Greek';
$string['vlabembed_langcode_RU'] = 'Russian';
$string['vlabembed_langcode_UK'] = 'Ukrainian';
$string['vlabembed_err_enableautoload'] = 'Contact your system administrator to activate autoload in the filter settings.';
$string['vlabembed_err_load'] = 'Applet files are not loaded:';
$string['vlabembed_info_ictchem'] = 'Try to get archive file from';
$string['vlabembed_info_write'] = 'Write downloaded data to vlab.zip in';
$string['vlabembed_info_open'] = 'Opening ZIP archive';
$string['vlabembed_info_with'] = 'with';
$string['vlabembed_info_files'] = 'files';
$string['vlabembed_info_extract'] = 'Extracting files...';
$string['vlabembed_info_remove'] = 'Remove downloaded archive at';
$string['vlabembed_info_chemcoll'] = 'Try to get a minimal set of Virtual Lab applet files from ChemCollective site';
$string['vlabembed_info_download'] = 'Downloading';
$string['vlabembed_info_bytes'] = 'bytes';
$string['vlabembed_info_integrity'] = 'Testing integrity ...';
$string['vlabembed_info_success'] = 'success';
$string['vlabembed_info_failed'] = 'failed';

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
 * @package    filter_vlabembed
 * @copyright  2015 Pavlo Nechipurenko, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * __________________________________________________________________________
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Paths to download Vlab applet files from external sources.
    $settings->add(new admin_setting_configtextarea('filter_vlabembed/extsrc',
                    get_string('vlabembed_extsrc', 'filter_vlabembed'),
                    // Link to vlabinstaller.php (site admins only).
                    '<a href=' . $CFG->wwwroot . '/filter/vlabembed/vlabinstaller.php  target=\"_blank\">' .
                    get_string('vlabembed_extsrc_comment', 'filter_vlabembed') . '</a>',
                    "http://ict-chem.ccjournals.eu/vlab_ukr.zip\nhttp://kdpu.edu.ua/download/kaf_chem/books/vlab_ukr.zip\n" .
                    "https://sites.google.com/site/kafedrahimiie/necipurenko-p/" .
                    "chemistry-virtual-lab-ukrainian-version/ukraienskaversiavirtuallab/vlab_ukr.zip\n"));

    // Vlab applet width (800 by default).
    $settings->add(new admin_setting_configtext('filter_vlabembed/width',
                    get_string('vlabembed_width', 'filter_vlabembed'), '', '800', PARAM_TEXT));
    // Vlab applet height (600 by default).
    $settings->add(new admin_setting_configtext('filter_vlabembed/height',
                    get_string('vlabembed_height', 'filter_vlabembed'), '', '600', PARAM_TEXT));
    // List of available languages for Virtual Lab.
    $languages = array(
                        'EN' => get_string('vlabembed_langcode_EN', 'filter_vlabembed'), // English.
                        'AR' => get_string('vlabembed_langcode_AR', 'filter_vlabembed'), // Arabic.
                        'CA' => get_string('vlabembed_langcode_CA', 'filter_vlabembed'), // Catalan.
                        'ES' => get_string('vlabembed_langcode_ES', 'filter_vlabembed'), // Spanish.
                        'GL' => get_string('vlabembed_langcode_GL', 'filter_vlabembed'), // Galician.
                        'LT' => get_string('vlabembed_langcode_LT', 'filter_vlabembed'), // Lithuanian.
                        'BR' => get_string('vlabembed_langcode_BR', 'filter_vlabembed'), // Portuguese (Brasil).
                        'ZH' => get_string('vlabembed_langcode_ZH', 'filter_vlabembed'), // Chinese.
                        'DE' => get_string('vlabembed_langcode_DE', 'filter_vlabembed'), // German.
                        'FR' => get_string('vlabembed_langcode_FR', 'filter_vlabembed'), // French.
                        'GR' => get_string('vlabembed_langcode_GR', 'filter_vlabembed'), // Greek.
                        'RU' => get_string('vlabembed_langcode_RU', 'filter_vlabembed'), // Russian.
                        'UK' => get_string('vlabembed_langcode_UK', 'filter_vlabembed')  // Ukrainian.
                        );
    // Vlab applet language (English by default).
    $settings->add(new admin_setting_configselect('filter_vlabembed/lang',
                        get_string('vlabembed_lang', 'filter_vlabembed'), '', 'EN', $languages));
}

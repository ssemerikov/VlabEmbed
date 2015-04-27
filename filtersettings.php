<?php

/*
 * __________________________________________________________________________
 *
 * ChemCollective Virtual Lab filter for Moodle 2.0
 *
 *  This filter will replace links to a Vlab file (.xml) in [vlab]...[/vlab] block 
 *  with a java applet that plays that ChemCollective Virtual Lab inline
 *
 * @package    filter
 * @subpackage vlabembed
 * @copyright  2015 Pavlo Nechipurenko  {@link http://ict-chem.ccjournals.eu/}, Sergey Semerikov {@link http://ccjournals.eu/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * __________________________________________________________________________
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
  $settings->add(new admin_setting_configtext('filter_vlabembed_width', get_string('vlabembed_width','filter_vlabembed'), '', '800', PARAM_TEXT));
  $settings->add(new admin_setting_configtext('filter_vlabembed_height', get_string('vlabembed_height','filter_vlabembed'), '', '600', PARAM_TEXT));
//  $settings->add(new admin_setting_configtext('filter_vlabembed_lang', get_string('vlabembed_lang','filter_vlabembed'), '', 'UK'));
  $languages = array(
                    'EN' => get_string('vlabembed_langcode_EN','filter_vlabembed'),  
                    'AR' => get_string('vlabembed_langcode_AR','filter_vlabembed'),  
                    'CA' => get_string('vlabembed_langcode_CA','filter_vlabembed'),  
                    'ES' => get_string('vlabembed_langcode_ES','filter_vlabembed'),  
                    'GL' => get_string('vlabembed_langcode_GL','filter_vlabembed'),  
                    'LT' => get_string('vlabembed_langcode_LT','filter_vlabembed'),  
                    'BR' => get_string('vlabembed_langcode_BR','filter_vlabembed'),  
                    'ZH' => get_string('vlabembed_langcode_ZH','filter_vlabembed'),  
                    'DE' => get_string('vlabembed_langcode_DE','filter_vlabembed'),  
                    'FR' => get_string('vlabembed_langcode_FR','filter_vlabembed'),  
                    'GR' => get_string('vlabembed_langcode_GR','filter_vlabembed'),  
                    'RU' => get_string('vlabembed_langcode_RU','filter_vlabembed'),  
                    'UK' => get_string('vlabembed_langcode_UK','filter_vlabembed')
                    );

  $settings->add(new admin_setting_configselect('filter_vlabembed_lang', get_string('vlabembed_lang','filter_vlabembed'), '', 'EN', $languages));
}

?>

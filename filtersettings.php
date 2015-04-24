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
  $settings->add(new admin_setting_configtext('filter_vlabembed_lang', get_string('vlabembed_lang','filter_vlabembed'), '', 'UK'));
}

?>

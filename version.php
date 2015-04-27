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

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2015042700;
$plugin->release   = 1.03;
$plugin->requires  = 2010112400;   
$plugin->component = 'filter_vlabembed'; 

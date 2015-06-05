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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/filelib.php');
require_once($CFG->dirroot.'/filter/vlabembed/javaappletinstaller.php');

/**
 * Automatic Vlab embedding filter class.
 *
 * @package    filter_vlabembed
 * @copyright  2015 Pavlo Nechipurenko, Sergey Semerikov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_vlabembed extends moodle_text_filter {

    /**
     * Check text for link to Vlab data in [vlab]...[/vlab].
     *
     * @param string $text
     * @param array $options
     * @return string
     */
    public function filter($text, array $options = array()) {
        global $CFG, $PAGE;

        if (!is_string($text)) {
            // Non string data can not be filtered anyway.
            return $text;
        }

        if (!preg_match('/\[vlab/i', $text)) {
            // Pre-check for Vlab data block.
            return $text;
        }

        $newtext = $text; // Fullclone is slow and not needed here.

        $search = '/\[vlab](.+?)\[\/vlab]/is'; // Regular expression for [vlab]...[/vlab].

        $newtext = preg_replace_callback($search, 'filter_vlabembed_callback', $newtext);

        if (is_null($newtext) or $newtext === $text) {
            // Error or not filtered.
            return $text;
        }

        return $newtext; // Return filtered text.
    }
}


/**
 * Replace URL to Vlab data with embedded Vlab applet, if possible.
 *
 * @param array $link
 * @return string
 */
function filter_vlabembed_callback($link) {

    global $CFG;

    // Get configuration data - Vlab applet width, height, language and autodownload flag.
    $width = $CFG->filter_vlabembed_width;
    $height = $CFG->filter_vlabembed_height;
    $lang = $CFG->filter_vlabembed_lang;
    $copyright = get_string('vlab_copyright', 'filter_vlabembed');
    $flagauto = $CFG->filter_vlabembed_flagauto;

    // Check for needfull Java archives and data files.
    if (file_exists ($CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar') == false) {
        // When vlab.jar is not exists in VlabEmbed filter directory, try to download it or to inform about impossibility.
        if ($flagauto == false) {
            // When autodownload forbidden, inform user about inability to use Virtual Lab.
            return $link[0] . get_string('vlabembed_err_enableautoload', 'filter_vlabembed');
        } else {
            // Check for VlabEmbed filter directory writeability.
            if (is_writable($CFG->dirroot . '/filter/vlabembed/')) {
                if (filter_vlabembed_javaappletinstaller() === false) {
                    // Return diagnostic message if all attempts to download Virtual Lab applet files are unhappy.
                    return $link[0] . get_string('vlabembed_err_enablemanualload', 'filter_vlabembed');
                }
            } else {
                // Cann't download applet files due to VlabEmbed filter directory writeinability.
                return $link[0] . get_string('vlabembed_err_enablemanualload', 'filter_vlabembed');
            }
        }
    }

    // Cut Virtual Lab data initial URL from [vlab]...[/vlab].
    $output = substr($link[0], strlen("[vlab]"), strlen($link) - strlen("[/vlab]"));

    $temp = strstr($output, 'http'); // Check for http-based URL.
    if ($temp !== false) {
        // When URL found look into it.
        if (strpos($temp, '"') !== false) {
            // When URL is double quoted, remove quotes.
            $temp = substr($temp, 0, strpos($temp, '"'));
        }
        if (strpos($temp, '>') !== false) {
            $temp = substr($temp, 0, strpos($temp, '>'));
        }
        $output =
                '<applet code="irydium.vlab.VLApplet.class" codebase="' . $CFG->wwwroot . '/filter/vlabembed/" ' .
                'archive="vlab.jar, logclient.jar, junit.jar" height="' . $height . '" width="' . $width . '">' .
                '<param name="language" value="' . $lang . '">' .
                '<param name="permissions" value="sandbox">' .
                '<param name="properties" value="' . $temp . '">' .
                '</applet>';

        return $output; // Return filtered text.
    } else {
        // Return source text in case of not-HTTP link.
        return $link[0];
    }
}

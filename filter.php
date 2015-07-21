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

    // Get configuration data - Vlab applet width, height, language and externals paths.
    $width = get_config('filter_vlabembed', 'width');
    $height = get_config('filter_vlabembed', 'height');
    $lang = get_config('filter_vlabembed', 'lang');
    $copyright = get_string('vlab_copyright', 'filter_vlabembed');
    $extsrc = get_config('filter_vlabembed', 'extsrc');

    // Minimal set of Virtual Lab applet files.
    $vlabminimalset = array(
             // First of all, 3 Java archives.
                  $CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar',
                  $CFG->dirroot . '/filter/vlabembed/' . 'junit.jar',
                  $CFG->dirroot . '/filter/vlabembed/' . 'logclient.jar',
            // Next - language files.
                  $CFG->dirroot . '/filter/vlabembed/' . 'lang.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'lang_ar.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'lang_ru.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'language.xml',
            // Default assignment No 1 - Default.
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/Default.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/filesystem.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/reactions.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/species.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/spectra.xml',
            // Default assignment No 2 - Walkthrough.
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/Walkthrough.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/filesystem.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/reactions.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/species.xml',
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/titration.htm',
            // Font file.
                  $CFG->dirroot . '/filter/vlabembed/' . 'fonts/ARIALUNI.TTF',
            // Interface images (tubes, flasks, buttons, etc.).
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/about.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/back.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/bottle100mLSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/bottle2500mLSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/buretSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/cabinetOpenEmptySR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/cabinetOpenSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/cabinetSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/carboySR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/closeMinor.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/closeMinorPressed.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/doorOpenSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/doorSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/erlenmeyerFlaskSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/fileSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/folder.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/forward.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/glassware.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/home.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/homeworkProblem.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon.ico',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon32.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon32.ico',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogo_B_LG.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogo_B_W.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogo_W_DG.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogoRotating_W_DG.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/phMeter.jpg',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/pour.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/refresh.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/remove.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/removeDisabled.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryGroup.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryHeader.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryLocal.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryRemote.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/retrieve.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/retrieveDisabled.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/solidbottleSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/splash.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/store.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/storeDisabled.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tab.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tab_hover.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tab_selected.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/thermal.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tools.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/volumetricSR.gif',
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/withdraw.gif');

    // Check for needfull Java archives and data files.
    $temp2 = '';
    foreach ($vlabminimalset as $path) {
        if (!file_exists ($path)) {
            $temp2 = $temp2 . '<br>' . $path;
        }
    }

    if (strlen($temp2) > 0) {
        // If any files is absent, return error message.
        return $link[0] . '<br>' . get_string('vlabembed_err_load', 'filter_vlabembed') . $temp2 . '<br>' .
               get_string('vlabembed_err_enableautoload', 'filter_vlabembed');
    }

    // Virtual Lab data initial URL from [vlab]...[/vlab].
    $output = $link[1];

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
                '<script src="http://java.com/js/deployJava.js"></script><div class="applet"><script>' .
                'var attributes = { code:"irydium.vlab.VLApplet.class", codebase: "' . $CFG->wwwroot . '/filter/vlabembed/", ' .
                'archive:"vlab.jar, logclient.jar, junit.jar", height:"' . $height . '", width:"' . $width . '",};' .
                'var parameters = { language : "' . $lang . '", ' .
                'redirect : "script1.php?url=", permissions : "sandbox", classloader_cache : "false",' .
                'properties : "' . $temp . '", };' .
                'var version = "1.3";' .
                'deployJava.runApplet(attributes, parameters, version);' .
                '</script></div>';
        return $output; // Return filtered text.
    } else {
        // Return source text in case of not-HTTP link.
        return $link[0];
    }
}

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

// Download Moodle config.
require_once("../../config.php");

// Check for filter enable.
if (!filter_is_enabled('vlabembed')) {
    print_error('filternotenabled');
}

require_once($CFG->libdir.'/filelib.php');

// Require login.
require_login();

// Install available only for Moodle site admins.
is_siteadmin() || die('Site admins only');

global $CFG;


/**
 * Vlab applet installer
 *
 * @return bool
 */
function filter_vlabembed_javaappletinstaller() {
    global $CFG;

    // Try to download archived Virtual Lab files from external sources.
    $extsrc = get_config('filter_vlabembed', 'extsrc');

    // Convert string with URLs into array.
    $urls = explode("\n", $extsrc);

    // Minimal set of Virtual Lab applet files.
    $vlabminimalset = array(
             // First of all, 3 Java archives.
            'http://chemcollective.org/assets/modules/activities/vlab/vlab.jar' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar',
            'http://chemcollective.org/assets/modules/activities/vlab/junit.jar' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'junit.jar',
            'http://chemcollective.org/assets/modules/activities/vlab/logclient.jar' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'logclient.jar',
            // Next - language files.
            'http://chemcollective.org/assets/modules/activities/vlab/lang.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'lang.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/lang_ar.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'lang_ar.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/lang_ru.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'lang_ru.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/language.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'language.xml',
            // Default assignment No 1 - Default.
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/Default.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/Default.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/filesystem.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/filesystem.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/reactions.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/reactions.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/species.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/species.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/spectra.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/spectra.xml',
            // Default assignment No 2 - Walkthrough.
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/Walkthrough.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/Walkthrough.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/filesystem.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/filesystem.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/reactions.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/reactions.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/species.xml' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/species.xml',
            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/titration.htm' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/titration.htm',
            // Font file.
            'http://chemcollective.org/assets/modules/activities/vlab/fonts/ARIALUNI.TTF' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'fonts/ARIALUNI.TTF',
            // Interface images (tubes, flasks, buttons, etc.).
            'http://chemcollective.org/assets/modules/activities/vlab/images/about.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/about.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/back.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/back.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/bottle100mLSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/bottle100mLSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/bottle2500mLSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/bottle2500mLSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/buretSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/buretSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/cabinetOpenEmptySR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/cabinetOpenEmptySR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/cabinetOpenSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/cabinetOpenSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/cabinetSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/cabinetSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/carboySR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/carboySR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/closeMinor.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/closeMinor.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/closeMinorPressed.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/closeMinorPressed.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/doorOpenSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/doorOpenSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/doorSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/doorSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/erlenmeyerFlaskSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/erlenmeyerFlaskSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/fileSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/fileSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/folder.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/folder.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/forward.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/forward.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/glassware.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/glassware.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/home.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/home.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/homeworkProblem.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/homeworkProblem.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/icon.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/icon.ico' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon.ico',
            'http://chemcollective.org/assets/modules/activities/vlab/images/icon32.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon32.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/icon32.ico' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/icon32.ico',
            'http://chemcollective.org/assets/modules/activities/vlab/images/irLogo_B_LG.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogo_B_LG.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/irLogo_B_W.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogo_B_W.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/irLogo_W_DG.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogo_W_DG.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/irLogoRotating_W_DG.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/irLogoRotating_W_DG.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/phMeter.jpg' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/phMeter.jpg',
            'http://chemcollective.org/assets/modules/activities/vlab/images/pour.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/pour.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/refresh.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/refresh.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/remove.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/remove.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/removeDisabled.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/removeDisabled.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/repositoryGroup.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryGroup.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/repositoryHeader.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryHeader.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/repositoryLocal.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryLocal.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/repositoryRemote.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/repositoryRemote.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/retrieve.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/retrieve.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/retrieveDisabled.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/retrieveDisabled.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/solidbottleSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/solidbottleSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/splash.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/splash.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/store.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/store.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/storeDisabled.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/storeDisabled.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/tab.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tab.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/tab_hover.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tab_hover.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/tab_selected.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tab_selected.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/thermal.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/thermal.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/tools.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/tools.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/volumetricSR.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/volumetricSR.gif',
            'http://chemcollective.org/assets/modules/activities/vlab/images/withdraw.gif' =>
                  $CFG->dirroot . '/filter/vlabembed/' . 'images/withdraw.gif');

    $successdownloadflag = false; // Initial value of $successdownloadflag.

    foreach ($urls as $address) { // Cycle through the available sources.
        if ($successdownloadflag == false and strlen(trim($address)) > 7) { // If previous source inaccessible.
            $allfile = file_get_contents(trim($address)); // Try to get archive file from external source.
            echo '<pre>' . get_string('vlabembed_info_ictchem', 'filter_vlabembed') . ' ' . $address;
            if ($allfile != false) { // When some data available check it for integrity as ZIP archive.
                // Write downloaded data to vlab.zip in VlabEmbed filter directory.
                file_put_contents($CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip' , $allfile);
                echo '<p>' . get_string('vlabembed_info_write', 'filter_vlabembed') . ' ' .
                    $CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip';
                $zip = new ZipArchive; // Creating new ZipArchive instance.
                // Try to open downloaded file vlab.zip as ZIP archive.
                if ($zip->open($CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip' ) === true) {
                    // Look inside archive.
                    echo '<p>' . get_string('vlabembed_info_open', 'filter_vlabembed') . ' ' .
                        $CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip ' . get_string('vlabembed_info_with', 'filter_vlabembed') .
                        ' ' . $zip->numFiles . ' ' . get_string('vlabembed_info_files', 'filter_vlabembed') . ':<p>';
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        echo '    ' . $zip->statIndex($i)['name'] . ' (' . $zip->statIndex($i)['size']. ' ' .
                            get_string('vlabembed_info_bytes', 'filter_vlabembed') . ')<br>';
                    }
                    // Unpack archive content into VlabEmbed filter directory.
                    echo '<p>' . get_string('vlabembed_info_extract', 'filter_vlabembed');
                    $zip->extractTo($CFG->dirroot . '/filter/vlabembed/' . '');
                    $zip->close(); // Close archive file.
                    unlink($CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip'); // Remove downloaded archive.
                    echo '<p>' . get_string('vlabembed_info_remove', 'filter_vlabembed') . ' ' . $CFG->dirroot .
                        '/filter/vlabembed/' . 'vlab.zip';
                    $successdownloadflag = true; // Rise $successdownloadflag.
                }
            }
        }
    }

    // When archived Virtual Lab files from external sources are unavailable,
    // try to download minimal set of Virtual Lab applet files separately from ChemCollective site.
    if ($successdownloadflag == false) {
        echo '<p>' . get_string('vlabembed_info_chemcoll', 'filter_vlabembed') . '<p>';
        // Minimal set of Virtual Lab applet directories.
        mkdir($CFG->dirroot . '/filter/vlabembed/' . 'assignments'); // Assignments.
        mkdir($CFG->dirroot . '/filter/vlabembed/' . 'assignments/default');
        mkdir($CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough');
        mkdir($CFG->dirroot . '/filter/vlabembed/' . 'fonts');       // Fonts.
        mkdir($CFG->dirroot . '/filter/vlabembed/' . 'images');      // Images.

        $successdownloadflag = true; // Initial rise $successdownloadflag.

        // Do it for each component of minimal set of Virtual Lab applet files.
        foreach ($vlabminimalset as $address => $path) {
            echo '<br>    ' . get_string('vlabembed_info_download', 'filter_vlabembed') . ' ' . $address . ' ... ';
            $allfile = file_get_contents($address); // Try to get next file.
            if ($allfile != false) {
                // Write file into VlabEmbed filter directory.
                file_put_contents($path , $allfile);
                echo get_string('vlabembed_info_success', 'filter_vlabembed') . ' (' . strlen($allfile) . ' ' .
                    get_string('vlabembed_info_bytes', 'filter_vlabembed') . ')';
            } else {
                // For any download error down $successdownloadflag.
                $successdownloadflag = false;
                echo get_string('vlabembed_info_failed', 'filter_vlabembed');
            }
        }

        $zip = new ZipArchive; // Creating new ZipArchive instance.
        // Try to check integrity of downloaded vlab.jar.
        echo '<p>' . get_string('vlabembed_info_integrity', 'filter_vlabembed') . ' ';
        if ($zip->open($CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar' ) === true) {
            $zip->close();
            echo get_string('vlabembed_info_success', 'filter_vlabembed');
            $successdownloadflag = true;
        } else {
            // For integrity error down $successdownloadflag.
            echo get_string('vlabembed_info_failed', 'filter_vlabembed');
            $successdownloadflag = false;
        }
    }

    echo '</pre>';

    return $successdownloadflag;
}

?>

<html>
    <head>
        <title>
            <?php 
                echo get_string('vlab_copyright', 'filter_vlabembed');
            ?>
        </title>
    </head>

    <body>
        <?php 
           filter_vlabembed_javaappletinstaller();
        ?>
    </body>
</html>

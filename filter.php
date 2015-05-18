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
            return $text;
        }

        $newtext = $text; // Fullclone is slow and not needed here.

        $search = '/\[vlab](.+?)\[\/vlab]/is';

        $newtext = preg_replace_callback($search, 'filter_vlabembed_callback', $newtext);

        if (is_null($newtext) or $newtext === $text) {
            // Error or not filtered.
                return $text;
        }

        return $newtext;
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

    $width = $CFG->filter_vlabembed_width;
    $height = $CFG->filter_vlabembed_height;
    $lang = $CFG->filter_vlabembed_lang;
    $copyright = get_string('vlab_copyright', 'filter_vlabembed');
    $flagauto = $CFG->filter_vlabembed_flagauto;

    if (file_exists ($CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar') == false) {
        if ($flagauto == false) {
            return $link[0] . 'Файлы апплета не загружены. Обратитесь к администратору для активации'.
                              ' режима автозагрузки в настройках фильтра';;
        } else {
            $urls = array('http://ict-chem.ccjournals.eu/vlab_ukr.zip',
                        'http://kdpu.edu.ua/download/kaf_chem/books/vlab_ukr.zip');

            $successdownloadflag = false;

            foreach ($urls as $address) {
                if ($successdownloadflag == false) {
                    $allfile = file_get_contents($address);
                    if ($allfile != false) {
                        file_put_contents($CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip' , $allfile);
                        $zip = new ZipArchive;
                        if ($zip->open($CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip' ) === true) {
                            $zip->extractTo($CFG->dirroot . '/filter/vlabembed/' . '');
                            $zip->close();
                            unlink($CFG->dirroot . '/filter/vlabembed/' . 'vlab.zip');
                            $successdownloadflag = true;
                        }
                    }
                }
            }

            if ($successdownloadflag == false) {
                $urls2 = array(
                            'http://chemcollective.org/assets/modules/activities/vlab/junit.jar' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'junit.jar',
                            'http://chemcollective.org/assets/modules/activities/vlab/lang.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'lang.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/lang_ar.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'lang_ar.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/lang_ru.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'lang_ru.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/language.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'language.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/logclient.jar' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'logclient.jar',
                            'http://chemcollective.org/assets/modules/activities/vlab/vlab.jar' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/Default.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/Default.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/Walkthrough.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/Walkthrough.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/filesystem.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/filesystem.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/reactions.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/reactions.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/species.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/species.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/default/spectra.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/default/spectra.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/filesystem.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/filesystem.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/reactions.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/reactions.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/species.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/species.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/spectra.xml' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough/spectra.xml',
                            'http://chemcollective.org/assets/modules/activities/vlab/fonts/ARIALUNI.TTF' =>
                                  $CFG->dirroot . '/filter/vlabembed/' . 'fonts/ARIALUNI.TTF',
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

                mkdir($CFG->dirroot . '/filter/vlabembed/' . 'assignments');
                mkdir($CFG->dirroot . '/filter/vlabembed/' . 'assignments/default');
                mkdir($CFG->dirroot . '/filter/vlabembed/' . 'assignments/walkthrough');
                mkdir($CFG->dirroot . '/filter/vlabembed/' . 'fonts');
                mkdir($CFG->dirroot . '/filter/vlabembed/' . 'images');

                $successdownloadflag = true;

                foreach ($urls2 as $address => $path) {
                    $allfile = file_get_contents($address);
                    if ($allfile != false) {
                        file_put_contents($path , $allfile);
                    } else {
                        $successdownloadflag = false;
                    }
                }

                $zip = new ZipArchive;
                if ($zip->open($CFG->dirroot . '/filter/vlabembed/' . 'vlab.jar' ) === true) {
                    $zip->close();
                    $successdownloadflag = true;
                } else {
                    $successdownloadflag = false;
                }

                if ($successdownloadflag == false) {
                    return $link[0] . 'Файлы апплета не загружены. Обратитесь к администратору для их загрузки с ' .
                                        'сайта ChemCollective';
                }
            }

        }
    }

    $output = substr($link[0], strlen("[vlab]"), strlen($link) - strlen("[/vlab]"));

    $temp = strstr($output, 'http');
    if ($temp !== false) {
        if (strpos($temp, '"') !== false) {
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

        return $output;
    } else {
        return $link[0];
    }
}

<?php 


/*
_____________________________________________________________________________

Copyright Information

The Chemistry Collective project is currently funded by the National Science 
Foundation. Our software is available free of charge to all educators and students 
under the creative commons license (Attribution-NonCommercial-NoDerivs CC BY-NC-ND - 
http://creativecommons.org/licenses/by-nc-nd/3.0). 
Instructors and students can use our materials on the web and on their computers 
immediately without any licensing requirements. We are very open to collaborations 
and the re-use of our materials. Please contact us (info@chemcollective.org) for 
any uses that go beyond the above creative commons license.

*/


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

require_once($CFG->libdir.'/filelib.php');

class filter_vlabembed extends moodle_text_filter {

    function filter($text, array $options = array()) {
        global $CFG, $PAGE;

        if (!is_string($text)) {
            // non string data can not be filtered anyway
            return $text;
        }

        if (!preg_match('/\[vlab/i',$text)) {
            return $text;
        }


        $newtext = $text; // fullclone is slow and not needed here

        //$search = '/\[vlab\][^\[]+?\[\/vlab\]/is'; 
	//$search = '/<a.*?href="([^<]+\.xml)"[^>]*>.*?<\/a>/is';
        $search = '/\[vlab\][^\[]+\[\/vlab\]/is';
	$newtext = preg_replace_callback($search, 'filter_vlabembed_callback', $newtext);

        if (is_null($newtext) or $newtext === $text) {
            // error or not filtered
                return $text;
        }

        return $newtext;
    }
}



function filter_vlabembed_callback($link) {

    global $CFG;

    $width = $CFG->filter_vlabembed_width;
    $height = $CFG->filter_vlabembed_height;
    $lang = $CFG->filter_vlabembed_lang;
    $copyright = get_string('vlab_copyright','filter_vlabembed');

/*

    $url = $link[1];
    $relative_url = str_replace($CFG->wwwroot . '/', '../../', $url);

    $path = explode("/", $link[1]);
    $filename = $path[count($path) - 1];

	
    $output = 
	'<applet code="irydium.vlab.VLApplet.class" codebase="' . $CFG->wwwroot . '/filter/vlabembed/" ' .
	'archive="vlab.jar, logclient.jar, junit.jar" height="' . $height . '" width="' . $width . '">' .
	'<param name="language" value="' . $lang . '">' .
	'<param name="permissions" value="sandbox">' .
	'<param name="properties" value="' . $relative_url . '">' .
	'</applet>' ;
	
    return $output;
*/
    $temp = substr(strstr($link[0],']'),1);
    $temp = substr($temp, 0, strpos($temp,'[/vlab]'));
    $temp = strstr($temp,'http'); 
    if (strpos($temp, '"') !== false)
    {
      $temp = substr($temp, 0, strpos($temp, '"'));
    }
    if (strpos($temp, '>') !== false)
    {
      $temp = substr($temp, 0, strpos($temp, '>'));
    }

    $output = 
	'<applet code="irydium.vlab.VLApplet.class" codebase="' . $CFG->wwwroot . '/filter/vlabembed/" ' .
	'archive="vlab.jar, logclient.jar, junit.jar" height="' . $height . '" width="' . $width . '">' .
	'<param name="language" value="' . $lang . '">' .
	'<param name="permissions" value="sandbox">' .
	'<param name="properties" value="' . $temp . '">' .
	'</applet>' ;
    
    //echo "<script>alert('$output');</script>";
    //echo "<script>alert('$temp');</script>";
    //return $temp;
    return $output;

}

?>

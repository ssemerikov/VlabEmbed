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
$string['vlabembed_flagauto'] = 'Автоматично завантажувати файли аплету Vlab';
$string['vlabembed_width'] = 'Ширина вікна аплета Vlab';
$string['vlabembed_height'] = 'Висота вікна аплета Vlab';
$string['vlabembed_lang'] = 'Мова локалізації аплета Vlab';
$string['vlab_copyright'] = 'IrYdium Project\'s Virtual Lab є проектом Chemistry Collective в університеті Carnegie Mellon';
$string['vlabembed_langcode_EN'] = 'Англійська';
$string['vlabembed_langcode_AR'] = 'Арабська';
$string['vlabembed_langcode_CA'] = 'Каталонська';
$string['vlabembed_langcode_ES'] = 'Іспанська';
$string['vlabembed_langcode_GL'] = 'Галісійська';
$string['vlabembed_langcode_LT'] = 'Литовська';
$string['vlabembed_langcode_BR'] = 'Португальська (Бразилія)';
$string['vlabembed_langcode_ZH'] = 'Китайська';
$string['vlabembed_langcode_DE'] = 'Німецька';
$string['vlabembed_langcode_FR'] = 'Французька';
$string['vlabembed_langcode_GR'] = 'Грецька';
$string['vlabembed_langcode_RU'] = 'Російська';
$string['vlabembed_langcode_UK'] = 'Українська';
$string['vlabembed_err_enableautoload'] = 'Файли аплету не завантажені. Зверніться до адміністратору для активації режиму автозавантаження у налаштуваннях фільтру.';
$string['vlabembed_err_enablemanualload'] = 'Файли аплету не завантажені. Зверніться до адміністратору для їх завантаження з сайту ChemCollective.';

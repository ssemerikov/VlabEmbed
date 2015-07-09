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
$string['vlabembed_extsrc'] = 'Откуда загружать файлы апплета Vlab';
$string['vlabembed_extsrc_comment'] = 'Попробовать автоматически загрузить файлы апплета Vlab из указанных источников или сайта ChemCollective';
$string['vlabembed_width'] = 'Ширина окна апплета Vlab';
$string['vlabembed_height'] = 'Высота окна апплета Vlab';
$string['vlabembed_lang'] = 'Язык локализации апплета Vlab';
$string['vlab_copyright'] = 'IrYdium Project Virtual Lab - проект Chemistry Collective в университете Carnegie Mellon';
$string['vlabembed_langcode_EN'] = 'Английский';
$string['vlabembed_langcode_AR'] = 'Арабский';
$string['vlabembed_langcode_CA'] = 'Каталонский';
$string['vlabembed_langcode_ES'] = 'Испанский';
$string['vlabembed_langcode_GL'] = 'Галисийский';
$string['vlabembed_langcode_LT'] = 'Литовский';
$string['vlabembed_langcode_BR'] = 'Португальский (Бразилия)';
$string['vlabembed_langcode_ZH'] = 'Китайский';
$string['vlabembed_langcode_DE'] = 'Немецкий';
$string['vlabembed_langcode_FR'] = 'Французский';
$string['vlabembed_langcode_GR'] = 'Греческий';
$string['vlabembed_langcode_RU'] = 'Русский';
$string['vlabembed_langcode_UK'] = 'Украинский';
$string['vlabembed_err_enableautoload'] = 'Обратитесь к администратору для активации режима автозагрузки в настройках фильтра.';
$string['vlabembed_err_load'] = 'Файлы апплета не загружены:';
$string['vlabembed_info_ictchem'] = 'Попытка получения файла архива по адресу';
$string['vlabembed_info_write'] = 'Запись загруженных данных в файл vlab.zip по пути';
$string['vlabembed_info_open'] = 'Открытие ZIP-архива';
$string['vlabembed_info_with'] = 'со';
$string['vlabembed_info_files'] = 'файлами';
$string['vlabembed_info_extract'] = 'Извлечение файлов...';
$string['vlabembed_info_remove'] = 'Удаление загруженного архива по пути';
$string['vlabembed_info_chemcoll'] = 'Попытка получения минимального набора файлов апплета Virtual Lab с сайта ChemCollective';
$string['vlabembed_info_download'] = 'Загружаю';
$string['vlabembed_info_bytes'] = 'байт';
$string['vlabembed_info_integrity'] = 'Проверка целостности ...';
$string['vlabembed_info_success'] = 'успешно';
$string['vlabembed_info_failed'] = 'неудача';

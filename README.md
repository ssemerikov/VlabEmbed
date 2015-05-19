VlabEmbed
=============

A Moodle filter plug-in to embed ChemCollective Virtual Lab problems using the Vlab Java applet.
It embeds any assigments (both local and global).

NOTICE: this software is in no way endorsed by or affiliated with the official ChemCollective project or team.

 *  This filter will replace links to a Vlab file (.xml) in [vlab]...[/vlab] block
 *  with a java applet that plays that ChemCollective Virtual Lab inline




Installation
------------
To install (on Moodle 2):

1. Un-compress the Zip/Gzip archive, and copy the folder renamed 'vlabembed' to your moodle/filter/ directory.
2. Log in to Moodle as admininstrator, go to Site Administration | Plugins | Filters | Manage Filters.
3. Choose 'On' or 'Off but available' in the drop-down menu next to 'VlabEmbed'.
4. Configure plugin width, height, language (available codes: BR - Brasilian Portugese, CA - Catala, DE - Deutsch, ES - Espanol, FR - Francais, GR - Greek, RU - Russian, UK - Ukrainian) and Vlab files autodownload facilities.


Usage
-----
The syntax to embed a project:

    [vlab]http-link to a Vlab problem file (.xml)[/vlab]

Links
-----
* Moodle plugin entry: <http://moodle.org/plugins/view.php?plugin=filter_vlabembed>;
* Code, Git: <https://github.com/ssemerikov/moodle-filter_vlabembed>;
* Demo : <http://ict-chem.ccjournals.eu>
* "Why square brackets?", <http://bitbucket.org/nfreear/timelinewidget/src/tip/filter.php#cl-36>;

Notes
-----
* Tested in Moodle 2.9.
* No javascript, no database access - very simple!
* Filter syntax is case-sensitive.
* The plug-in is internationalized in Moodle 2 in Deutsch, Russian, and Ukrainian.

Notices
-------
VlabEmbed plugin, Copyright (c) 2015 Pavlo Nechipurenko, Sergey Semerikov.

* License: <http://www.gnu.org/copyleft/gpl.html>; GNU GPL v3 or later.

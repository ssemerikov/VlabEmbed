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
5. Vlab files external sources are need to filter's work: by default, Virtual Lab applet files are not included into VlabEmbed filter package due to it license (CC BY-NC-ND 3.0) is not compatible with the GNU GPLv3. So you can install Vlab files via vlabinstaller.php.
   You can also manually download archive of Vlab applet files from http://ict-chem.ccjournals.eu/vlab_ukr.zip, http://kdpu.edu.ua/download/kaf_chem/books/vlab_ukr.zip or https://sites.google.com/site/kafedrahimiie/necipurenko-p/chemistry-virtual-lab-ukrainian-version/ukraienskaversiavirtuallab/vlab_ukr.zip and extract them into filter directory (yoursitemoodledirectory/filter/vlabembed) or download it separately from ChemCollective site:
   a) Download and put into yoursitemoodledirectory/filter/vlabembed:
      http://chemcollective.org/assets/modules/activities/vlab/vlab.jar
      http://chemcollective.org/assets/modules/activities/vlab/junit.jar
      http://chemcollective.org/assets/modules/activities/vlab/logclient.jar
      http://chemcollective.org/assets/modules/activities/vlab/lang.xml
      http://chemcollective.org/assets/modules/activities/vlab/lang_ar.xml
      http://chemcollective.org/assets/modules/activities/vlab/lang_ru.xml
      http://chemcollective.org/assets/modules/activities/vlab/language.xml
   b) Create subdir 'assignments' at yoursitemoodledirectory/filter/vlabembed/ and put int it:
      http://chemcollective.org/assets/modules/activities/vlab/assignments/Default.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/Walkthrough.xml
   c) Create subdir 'images' at yoursitemoodledirectory/filter/vlabembed/ and put int it:
      http://chemcollective.org/assets/modules/activities/vlab/images/about.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/back.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/bottle100mLSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/bottle2500mLSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/buretSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/cabinetOpenEmptySR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/cabinetOpenSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/cabinetSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/carboySR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/closeMinor.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/closeMinorPressed.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/doorOpenSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/doorSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/erlenmeyerFlaskSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/fileSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/folder.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/forward.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/glassware.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/home.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/homeworkProblem.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/icon.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/icon.ico
      http://chemcollective.org/assets/modules/activities/vlab/images/icon32.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/icon32.ico
      http://chemcollective.org/assets/modules/activities/vlab/images/irLogo_B_LG.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/irLogo_B_W.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/irLogo_W_DG.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/irLogoRotating_W_DG.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/phMeter.jpg
      http://chemcollective.org/assets/modules/activities/vlab/images/pour.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/refresh.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/remove.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/removeDisabled.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/repositoryGroup.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/repositoryHeader.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/repositoryLocal.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/repositoryRemote.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/retrieve.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/retrieveDisabled.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/solidbottleSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/splash.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/store.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/storeDisabled.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/tab.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/tab_hover.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/tab_selected.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/thermal.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/tools.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/volumetricSR.gif
      http://chemcollective.org/assets/modules/activities/vlab/images/withdraw.gif
   d) Create subdir 'fonts' at yoursitemoodledirectory/filter/vlabembed/ and put int it:
      http://chemcollective.org/assets/modules/activities/vlab/fonts/ARIALUNI.TTF
   e) Create subdir 'default' at yoursitemoodledirectory/filter/vlabembed/assignments/ and put int it:
      http://chemcollective.org/assets/modules/activities/vlab/assignments/default/filesystem.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/default/reactions.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/default/species.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/default/spectra.xml
   f) Create subdir 'walkthrough' at yoursitemoodledirectory/filter/vlabembed/assignments/ and put int it:
      http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/filesystem.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/reactions.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/species.xml
      http://chemcollective.org/assets/modules/activities/vlab/assignments/walkthrough/spectra.xml

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

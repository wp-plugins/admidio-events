=== Admidio Events ===
Contributors: fiwad
Donate link: http://fechten-in-waldkirch.de/kontakt/webmaster-english/
Tags: admidio, date, events, rss, widget
Requires at least: 3.6
Tested up to: 3.9.1
Stable tag: 0.4.0
License: GPLv3 or later
License URI:  http://www.gnu.org/licenses/gpl-3.0

A widget that displays event data from the online membership management system <a href="http://sourceforge.net/projects/admidio/">Admidio</a>.

== Description ==
[Admidio](http://sourceforge.net/projects/admidio/ "Admidio at SourceForge") is a free PHP based membership management system for organizations and groups. It also offers an event manager module to plan date, time and place of events.

**Admidio Events** displays such event data in the widget area of a WordPress page, for example the home page of the sports club the members belong to. The number of upcoming events shown is configurable. Also the widget provides a collapsed (event name, optional: date) or expanded (all event data) view which can be toggled between. The data from Admidio to WordPress is transferred via RSS.

Please note that the free icon font *Genericons* has to be available with your WordPress installation. Either by using a theme that includes *Genericons* out of the box (for example [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/) or [Twenty Fourteen](http://wordpress.org/themes/twentyfourteen/) or by using a Plugin that adds *Genericons* to your theme (for example [Genericon'd](http://wordpress.org/plugins/genericond/)).

== Installation ==

Detailed installation instructions can be found in the [WordPress Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

= Widget options =
* **Title**<br />
Widget title.

* **Enter the event RSS feed URL here**<br />
URL for file `rss_dates.php` of your Admidio installation. Typically like this: `http://YOUR_DOMAIN_HERE/adm_program/modules/dates/rss_dates.php`.<br /><br />
*Examples*<br />
URL in Admidio demo (English version): `http://www.admidio.org/demo_en/adm_program/modules/dates/rss_dates.php`,<br />
URL in Admidio demo (German version): `http://demo.admidio.org/adm_program/modules/dates/rss_dates.php`.

* **Date format setting in Admidio**<br />
This option has to be set equal to the date format setting in Admidio (see Administration - Organisation preferences - Organisation and regional preferences). *Hint: The time format setting in Admidio has to be set to either H:i or h:i.*

* **How many events would you like to display**<br />
Maximum number of events displayed.

* **Display event title with date**<br />
If checked, the event date is appended to the event title. Especially useful for collapsed view where otherwise only the event title is shown.

* **Date font color**<br />
Here you can select a font color for the event date that is different from the event title color.

* **Start with expanded view**<br />
If checked, then the Widget displays all event data after a page reload.

== Screenshots ==
1. Widget options on Widget admin screen.
2. Example for collapsed view with theme [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/).
3. Expanded view with theme [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/).


== Frequently Asked Questions ==

- Describe what Admidio can do.
- Explain error messages here.

== Changelog ==

= 0.4.0 =
* Addition of url scheme *http://* to RSS feed url if it has been omitted.
* Readme.txt updated.
* Screen shots added to folder *assets*.
* Tests done with the currently most popular WordPress themes: Customizr 3.1.17, Twenty Thirteen 1.2, Twenty Fourteen 1.1 worked out of the box. Eighties 1.1.0, Los 1.1.0, Oxygen 0.5.4, Twenty Ten 1.6, Twenty Eleven 1.8, Twenty Twelve 1.4 worked after installation of Plugin *Genericon'd*.

= 0.3.9 =
* Replaced some code in PHP 5.4 syntax by code that is compatible with older PHP versions.

= 0.3.8 =
* Added option to adapt to date format setting in Admidio. (Time format in Admidio has to start with 'H:i' or 'h:i'.)
* Changed feed cache time from one hour to one minute.

= 0.3.7 =
* Added color picker to select date color.
* Improved error handling when wrong RSS feed url is given.
* Improved handling if user has a nervous finger when changing views (queueing prevented).
* Moved css and js files to subdirectories.
* Pointed author uri in header to PlugIn directory.

= 0.3.6 =
* Updated stable flag in readme.txt (forgotten in version 0.3.5 =8-}).

= 0.3.5 =
* Added banner for Plugin Directory.
* Deleted default RSS feed URL and added it to installation instructions.
* Improved switching between collapsed and expanded view on devices with small screen: Now the whole widget title can be clicked.
* Restricted usable html tags in description to break tag.

= 0.3.4 =
* Added widget option for initial view.

= 0.3.3 =
* Improved expanded/collapsed view button.
* Updated readme.txt with hint regarding Genericons font. 

= 0.3.2 =
* First version hosted by WordPress.

== Upgrade Notice ==

= 1.0 =
This is the first released version. Please update, if you have used a previous version.

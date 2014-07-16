=== Admidio Events ===
Contributors: fiwad
Donate link: http://fechten-in-waldkirch.de/kontakt/webmaster-english/
Tags: admidio, date, events, rss, widget
Requires at least: 3.6
Tested up to: 3.9.1
Stable tag: 0.4.1
License: GPLv3 or later
License URI:  http://www.gnu.org/licenses/gpl-3.0

A Widget that displays event data from the online membership management system <a href="http://sourceforge.net/projects/admidio/">Admidio</a>.

== Description ==
[Admidio](http://sourceforge.net/projects/admidio/ "Admidio at SourceForge") is a free PHP based membership management system for organizations and groups. It also offers an event manager module to plan date, time and place of events.

**Admidio Events** displays such event data in the Widget area of a WordPress page, for example the home page of the sports club the members belong to. The number of upcoming events shown is configurable. Also the Widget provides a collapsed (event name, optional: date) or expanded (all event data) view which can be toggled between. The data from Admidio to WordPress is transferred via RSS.

Please note that the free icon font [Genericons](http://genericons.com) has to be available with your WordPress installation. Either by using a theme that includes *Genericons* out of the box (for example [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/) or [Twenty Fourteen](http://wordpress.org/themes/twentyfourteen/)) or by using a Plugin that adds *Genericons* to your theme (for example [Genericon'd](http://wordpress.org/plugins/genericond/)).

== Installation ==

= Plugin Installation =
Detailed installation instructions can be found in the [WordPress Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

= Widget Settings =
* **Title**<br />
Widget title.

* **Enter the event RSS feed URL here**<br />
URL to file `rss_dates.php` of your Admidio installation, like so: `http://YOUR_DOMAIN_HERE/adm_program/modules/dates/rss_dates.php`.<br /><br />
*Examples*<br />
URL for English Admidio demo server: `http://www.admidio.org/demo_en/adm_program/modules/dates/rss_dates.php`,<br />
URL for German Admidio demo server: `http://demo.admidio.org/adm_program/modules/dates/rss_dates.php`.

* **Date format setting in Admidio**<br />
This option has to be set to the date format setting in Admidio (see Administration - Organisation preferences - Organisation and regional preferences). *Hint: As possible, the time format setting in Admidio should be set to either H:i or h:i.*

* **How many events would you like to display**<br />
Maximum number of events displayed.

* **Display event title with date**<br />
If checked, the event date is appended to the event title. Especially useful for collapsed view as otherwise only the event title is shown.

* **Date font color**<br />
Here you can select a font color for the event date that is different from the event title color.

* **Start with expanded view**<br />
If checked, the Widget displays all event data after a page reload.

== Frequently Asked Questions ==

= How can I toggle between collapsed and expanded view? =
Just click on the Widget title.

= I can toggle between views. But there is a strange box showing up in the upper right of the Widget. What's that? =
Very likely this is because the free icon font [Genericons](http://genericons.com) is missing. This font has to be available with your WordPress installation. Either by using a theme that includes *Genericons* out of the box (for example [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/) or [Twenty Fourteen](http://wordpress.org/themes/twentyfourteen/)) or by using a Plugin that adds *Genericons* to your theme (for example [Genericon'd](http://wordpress.org/plugins/genericond/)).

= I cannot toggle between views. If I click on the Widget title, nothing happens. =
This is because some themes use css class names that are different from WordPress standard. Unfortunately it cannot get fixed easily. Instead please try one of the currently most popular themes that have been tested with *Admidio Events*: Customizr 3.1.17, Twenty Thirteen 1.2, Twenty Fourteen 1.1 worked out of the box. Eighties 1.1.0, Los 1.1.0, Oxygen 0.5.4, Twenty Ten 1.6, Twenty Eleven 1.8, Twenty Twelve 1.4 worked after installation of Plugin [Genericon'd](http://wordpress.org/plugins/genericond/).

= I need a membership management system for my club. Where can I find more information about Admidio? =
You can find an English page about [Admidio on SourceForge](http://sourceforge.net/projects/admidio/). Or use the [German home page of Admidio](http://admidio.de/).

= Is there a possibility to play around with Admidio without installing it before? =
There are Admidio demo servers available. Here you can check, if Admidio's features fit to your needs. You can choose between an [English Admidio demo server](http://www.admidio.org/demo_en/) or a [German Admidio demo server](http://demo.admidio.org/).

= The Widget doesn't display event data but a message. What does it mean? =
* **Error when fetching event data.**<br />
This message shows up if the URL to the file `rss_dates.php` doesn't work. Perhaps caused by a typo or because the Admidio server is down.

* **No event data available.**<br />
Admidio currently doesn't provides any event date.

* **Invalid event data.**<br />
The Widget wasn't able to get the event data. Typically caused by different settings for date format in Admidio and Admidio Events. Or by an RSS feed with wrong content.

= What will happen if I don't set the time format in Admidio as suggested (H:i or h:i)? =
The worst thing that could happen if you choose a different time format, is a wrong order for events on the same day. Normally *Admidio Events* shows the upcoming events in chronological order. The next event will be on top of the list. For most of the events only the event date is important for sorting. But if there is more than one event on the same day, the event time is used to put the events in correct order. If the time cannot be read due to an unknown time format, Admidio uses *00:00* as the event time.

== Screenshots ==
1. Widget settings on Widget admin screen.
2. Collapsed view on front end screen with theme [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/). Clicking on Widget title toggles between views.
3. Expanded view on front end screen with theme [Twenty Thirteen](http://wordpress.org/themes/twentythirteen/). Clicking on Widget title toggles between views.

== Changelog ==

= 0.4.1 =
* Further improvements for file readme.txt.

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
* Added Widget option for initial view.

= 0.3.3 =
* Improved expanded/collapsed view button.
* Updated readme.txt with hint regarding Genericons font. 

= 0.3.2 =
* First version hosted by WordPress.

== Upgrade Notice ==

= 1.0 =
This is the first released version. Please update, if you have used a previous version.
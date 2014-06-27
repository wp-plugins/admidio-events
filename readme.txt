=== Admidio Events ===
Contributors: fiwad
Donate link: http://fechten-in-waldkirch.de/kontakt/webmaster/
Tags: admidio, date, events, rss, widget
Requires at least: 3.6
Tested up to: 3.9.1
Stable tag: 0.3.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget that displays event data from the online membership management system <a href="http://sourceforge.net/projects/admidio/">Admidio</a>.

== Description ==

[Admidio](http://sourceforge.net/projects/admidio/ "Admidio at SourceForge") is a free PHP based membership management system for organizations and groups. It also offers an event manager module to plan date, time and place of events.

**Admidio Events** displays such event data in the widget area of a WordPress page, for example the home page of the sports club the members belong to. The number of upcoming events shown is configurable. Also the widget offers a collapsed (event name, optional: date) or expanded (all event data) view. The data from Admidio to WordPress is transferred via RSS.

Please note that the font *Genericons* has to be available with your WordPress installation. Either by using a theme that includes *Genericons* out of the box (e. g. <a href="http://wordpress.org/themes/twentythirteen/">Twenty Thirteen</a> or <a href="http://wordpress.org/themes/twentyfourteen/">Twenty Fourteen</a>) or by using a Plugin that adds *Genericons* to your theme (e. g. <a href="http://wordpress.org/plugins/genericond/">Genericon'd</a>).
== Installation ==

Quick and easy installation:

1. Upload the folder `admidio-events` and all sub-folders to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Done.
1. Example RSS feed URL: `http://demo.admidio.org/adm_program/modules/dates/rss_dates.php`.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Frequently Asked Questions ==

= What does this plugin actually do? =

(Answer) 

== Changelog ==

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
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.
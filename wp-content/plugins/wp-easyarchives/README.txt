=== WP-EasyArchives ===
Contributors: mg12
Donate link: http://www.neoease.com/plugins/
Tags: archives, page, AJAX
Requires at least: 2.2
Tested up to: 3.4.2
Stable tag: 3.1.2

Display your archive tree on custom page.

== Description ==

This plugin isn't only SEO friendly, but also provides a good user experience, you can filter achives and expand / collapse achive folder. It's more faster after version 3.0.

**Features:**

* Expand or collapse the monthly post archive listings.
* Support for filtering options on AUTHOR and YEAR.
* Caches the recent posts list, make page load faster.
* SEO friendly.

**Supported Languages:**

* US English/en_US (default)
* 简体中文/zh_CN (translate by [mg12](http://www.neoease.com/))
* Albanian/sq_AL (translate by [Romeo Shuka](http://www.romeolab.com/))
* Belorussian/by_BY (translate by Marcis Gasuns)
* Czech/cs_CZ (translate by [Ladislav Prskavec](http://blog.prskavec.net/))
* Dutch/nl_NL (translate by [Rene Kleine](http://wpwebshop.com/))
* Français/fr_FR (translate by [Jean-Michel MEYER](http://www.li-an.fr/blog/))
* Hungarian/hu_HU (translate by János Csárdi-Braunstein)
* Italian/it_IT (translate by [Gianni Diurno](http://gidibao.net/))
* Lithuania/lt_LT (translate by [Mantas Malcius](http://mantas.malcius.lt/))
* Polish/pl_PL (translate by [Artur](http://www.diariusz.net/))
* Russian/ru_RU (translate by kate)
* Spanish/es_ES (translate by David Tejedor)
* Türkçe/tr_TR (translate by [Hamdi Ömer Faruk](http://ramerta.com/))

**Demo:**

[http://www.neoease.com/archives/](http://www.neoease.com/archives/)

== Installation ==

1. Unzip archive to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In your template file add the following lines:
****

    <?php wp_easyarchives(); ?>

**Options:**

You can find the options on 'Setting -> WP-EasyArchives'.

**Custom CSS:**

* WP-EasyArchives will load wp-easyarchives.css from your theme directory if it exists.
* If it doesn't exists, it will load the default style that comes with WP-EasyArchives.

== Screenshots ==

1. Archives Page.

== Changelog ==

****

    VERSION DATE       TYPE   CHANGES
    3.1.2   2012/11/11 FIX    Fixed blank archives after change author.
    3.1.1   2012/11/11 FIX    Fixed for failure to expand and collapse folders on Firefox when using normal JavaScript lib.
    3.1     2012/10/08 NEW    Added 'comment counts' option.
                       NEW    Added 'open link in new tab/window' option.
                       MODIFY Updated Simplified Chinese translation.
    3.0     2012/09/28 NEW    It was rewritten, work faster and SEO friendly now.
                       NEW    Added Dutch language support. (Thanks Rene Kleine)
                       MODIFY Don't send asynchronous request when visitor change year.
					   REMOVE Removed comment counts.
					   REMOVE Removed 'last' mode.
					   FIX    Fixed translation errors.
    2.0     2010/08/22 NEW    Added 'Use CSS' option.
                       MODIFY Maked CSS sprite.
                       MODIFY Init actions on DOM ready.
                       MODIFY Moved options to setting page.
                       MODIFY Updated French translation. (Thanks Jean-Michel MEYER)
                       FIX    Change year or author and refresh page, first option of the selector is selected.
                       FIX    JavaScript error when chose 'Use jQuery library that is supported by WordPress', it's fixed now.
                       REMOVE Removed 'limit' feature.
                       REMOVE Removed widget feature.
    1.5.2   2010/06/24 NEW    Added Albanian language support. (Thanks Romeo Shuka)
                       NEW    Added Russian language support. (Thanks kate)
                       FIX    Hide 'auto-draft' and 'trash' posts.
                       REMOVE Removed the HTML comments.
    1.5.1   2009/08/05 NEW    Added Spanish language support. (Thanks David Tejedor)
                       MODIFY Updated Italian translation. (Thanks Gianni Diurno)
                       MODIFY Updated Hungarian translation. (Thanks János)
                       FIX    Fixed limit arguement.
    1.5     2009/06/12 NEW    Compatible with WordPress 2.8.
                       NEW    jQuery is now supported. (JavaScript library option)
                       NEW    Added Belorussian language support. (Thanks Marcis Gasuns)
                       MODIFY Decrease access time to access database.
                       MODIFY Updated Simplified Chinese translation.
                       FIX    Fixed the messy code when changed pages.
    1.0.3   2009/05/04 NEW    Added Polish language support. (Thanks Artur)
                       NEW    Added Lithuania language support. (Thanks Mantas Malcius)
                       FIX    Fixed the month links. (Thanks ZFreet CHeung)
    1.0.2   2009/04/18 NEW    Added Czech language support. (Thanks Ladislav Prskavec)
                       NEW    Added French language support. (Thanks Jean-Michel MEYER)
                       MODIFY Updated Italian translation.
                       MODIFY Updated Hungarian translation.
                       FIX    Fixed a bug about date to show the posts.
    1.0.1   2009/03/18 NEW    Added Turkish language support. (Thanks Ömer Faruk)
                       NEW    Added Hungarian language support. (Thanks János Csárdi-Braunstein)
                       FIX    Fixed bug: The script does not check the publication date, show all future posts.
    1.0     2009/02/05 NEW    Added WordPress Widget support.
                       NEW    Added 'limit' argument.
                       NEW    Added the number of posts in all the monthly archives.
                       FIX    Fixed a bug when WordPress root directory in sub folder.
                       FIX    Fixed a bug about year filter.
    0.2     2009/01/15 NEW    Added Italian language support. (Thanks Gianni Diurno)
                       MODIFY Changed author username to display name.
                       FIX    Apply translations to monthly dates.
    0.1     2009/01/14 NEW    Years filter.
                       NEW    Authors filter.
                       NEW    Basic features.

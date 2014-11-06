=== FEEDZY RSS Feeds ===
Contributors: briKou
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7Z6YVM63739Y8
Tags: RSS, SimplePie, shortcode, feed, thumbnail, image, rss feeds, aggregator
Requires at least: 3.7
Tested up to: 4.0
Stable tag: 1.03
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

 
FEEDZY RSS Feeds is a small and lightweight plugin. Fast and easy to use, it aggregates RSS feeds into your WordPress site through simple shortcodes.

== Description ==

FEEDZY RSS Feeds is a small and lightweight RSS aggregator plugin. Fast and very easy to use, it allows you to aggregate multiple RSS feeds into your WordPress site through fully customizable shortcodes. 

The plugin uses the SimplePie CLASS php natively included in WordPress. SimplePie is a RSS parser that can read the information contained in a feed, process it, and finally display it.

FEEDZY RSS Feeds therefore supports any additional library and uses only the bare minimum to ensure good performance (minimalistic CSS + cache). 

You may use this plugin in your widgets and your pages and reuse the shortcode several times within the same page.

By activating this plugin, your cover picture will be inserted into your RSS feeds. By doing so, you'll make it will easier for external sites to retrieve images from your feeds.


[CHECK OUT THE DEMO](http://b-website.com/feedzy-rss-feeds-wordpress-plugin-using-simplepie "Try It!")


**Please ask for help or report bugs if anything goes wrong. It is the best way to make the community benefit!**


 = Shortcode Parameters =

 **feeds**

* Description : The url of the RSS feed to display. You may use multiple feeds URL separated by commas. The items are displayed in chronological order even if there are several feeds. You might not see the elements of a single stream if the others are older.
* Format : URL
* Default : empty


**max**

* Description : Number of items to display. It may happen that the RSS feeds you want to display has less entries than the number you choose, in which case a maximum number of item will be displayed.
* Format : numeric
* Default : 5


**feed_title**

* Description : Should we display the RSS title ?
* Format : yes/no
* Default : yes


**target**

* Description : Links may be opened in the same window or a new tab. [See the official doc.](http://www.w3schools.com/tags/att_a_target.asp "HTML a target Attribute")
* Format : _blank/_self/_parent/_top/framename
* Default : _blank


**title**

* Description : Trim the title of the item after X characters. The title will ends with "..." if it has been cropped.
* Format : numeric
* Default : empty


**meta**

* Description : Should we display the date of publication and the author name of the retrieved item?
* Format : yes/no
* Default : yes


**summary**

* Description : Should we display a description (abstract) of the retrieved item?
* Format : yes/no
* Default : yes


**summarylength**

* Description : Crop description (summary) of the element after X characters. The title will ends with "..." if it has been cropped.
* Format : numeric
* Default : empty


**thumb**

* Description : Should we display the first image of the content if it is available?
* Format : yes/no
* Default : yes


**size**

* Description : If an image is available and is required to display, you may specify its size in pixels. The image is cropped with CSS to be perfectly square. Do not include "px".
* Format : numeric
* Default : 10
 

= Basic example =

`[feedzy-rss feeds="http://b-website.com/feed"]`


= Advanced example =

`[feedzy-rss feeds="http://b-website.com/feed" max="2" feed_title="yes" target="_blank" title="50" meta="yes" summary="yes" summarylength="300" thumb="yes" size="100"]`


== Installation ==

1. Upload and activate the plugin (or install it through the WP admin console)
2. Insert shortcode ! ;-)

== Frequently Asked Questions ==

= Is it responsive friendly? =

Yes it is.


== Screenshots ==

1. Simple example


== Changelog ==


= 1.03 =
* Shortcode can now be displayed everywhere in the page (CSS is loaded via global var)

= 1.02 =
* Error on svn tag

= 1.01 =
* Minor CSS fix.
* Minor PHP changes.
* Readme.txt updated

= 1.0 =
* First release.

== Upgrade Notice ==

= 1.0 =
* First release.
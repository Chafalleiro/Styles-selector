=== Styles selector ===
Contributors: AlfonsoAB
Donate link: https://chafalladas.com/styles-selector-plugin/
Plugin URI:  https://chafalladas.com/styles-selector-plugin/
Author URI:  https://chafalladas.com
Tags: styles, switcher, css, theme configuration
Stable tag: trunk
Tested up to: 5.2.3
License: GPLv2 or later
Version:           1.1.0
Requires at least: 5.2
Requires PHP:      7.1.32
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is made with fiction blogs and webnovels in mind so users can choose night mode or some styles they find better to read.
Changes the styles by classes dinamically. Needs some knowledge about the css styles of the templates to alter.

Acknownledments:
https://scotch.io/tutorials/how-to-build-a-wordpress-plugin-part-1
https://mraffaele.com/posts/2011/10/25/css-accordion-no-javascript/
https://stackoverflow.com/questions/21646738/convert-hex-to-rgba
https://www.w3schools.com/
https://www.wordpress.org/

== Description ==

Plugin for altering several items in a theme in order to change the visualization. You can choose which kind of item will be,
an individual CSS element or an entire class by specifing the type of element.
If you have a theme switcher, like "multidevice switcher", you can also alter several themes (up to five).
Once you have saved the themes, their elements and the name of the option, a widget will be created with a menu list of the options you did,
so the users can set the display options they want.


The main idea of this plugin came when reading some webnovel in my cellphone and couldn't change the color of the text when the light changed.
It provides the user an instant change of the colors of the screen, colors preselected by the administrator in order to not change very much the design of the page,
 also it has the advantage of not reloading the content, since there is no change of the theme, just an alteration of the CSS properties.
 


Usage
-----
This plugin creates a select menu that lets a user change the color style of a page or post to be changed acording the settings that the blog administrator sets.

## Admin menu

* The admin can choose up to five different themes from the installed ones to be changed by selecting them in a drop down at the beginning of each tab of the configuration page. Note that you can select the same theme several times if you run out of mods.
* You can force the selector to be displayed at the top of the page instead of using a widget or a shortcode.
* You can configure the style of the selector for each theme.
* At each theme tab the admin can set up to ten color modifications to classes or individual elements.
	### Admin menuOptions fields
	* Name an option to be displayed to the user. This option will be added in the select input field.
	* Select wich type of style will be changed, class or individual element. If you used the web developer tools of yor browser to determine the elements you want to alter, an individual element is named by an "id", and class by "class". A class often has several elements. Remember to enter exactly the name, errors will be thrown if the names are incorrect and maybe the page functionality will be altered.</p>
	* Type the element id or class to be altered.
	* Select the color of the background in the color selector tool.
	* Select the color of the font in the color selector tool.
	* Choose the transparency of the background, it will be dinamically updated over an image below.
	* Choose the transparency of the text, it will be dinamically updated over an image below.
	* The option button indicates if the edited option will be used by the plugin. No options will be added if they aren't active.
	* Save yor changes clicking the blue button at the end of the page</p>
	
### Displaying the select drop down
	* There are currently two options, fist is to add the "Style selector widget" that this plugin creates to any sidebar. You can also configure a title for the widget.
	* The second is via a shortcode. Place the shortcode "[s_selector]" anywherw to display the drop down menu
	* Additionally is a last minute adittion, you can uncoment the las line of the widget-selector.php file in the /public/partials dir of the pulugin directory using the wordpress plugin editor to show the drop down at the start of each page.

## Frontend
	* The user can choose between a default "Restore" option, and the ones defined by you. This option is persistent.
	* The user can select the size of the text. This option is not persistent.
	
== Installation ==

1 a. Upload `styleselector` directory to the `/wp-content/plugins/` directory
2 a. Activate the plugin through the 'Plugins' menu in WordPress

1 b. Upload the zip with the "Upload plugin" Administrator menu option.
2 b. Activate it.

3. An new option "Style selector" will appear in the settting menu. There will be the configuration screen.

== Frequently Asked Questions ==

= Works with multisites? =

Tested in a multisite with * domain names and works fine. Can't say yet if in a MU with only one domain will work the same.

= Works with xxx theme? =

Can't say. CSS is sometimes tricky and is nor always clear which element to change.
Some themes may prevent tampering or have dynamic HTML5 and javascript updates of the styles.

= Why can't I add my own stylesheet? =

This plugin isn't a theme switcher, neither a customizer, it just changes colors and size of the fonts for better reading.

= I have updated the plugin and fonts doesn't change size. =

Try refreshing all caches, sometimes it takes time to reload styles and scripts.


== Screenshots ==
1. Page dark themed by the plugin.
2. Page restored by the plugin.
3. Options panel. Here you configure the plugin
4. Inspector developer tool of a browser. You can use it to explore the elements of a page.

== Changelog ==

= 1.1.0 =
Added font size to frontend.
Configurable selector.
Optional force selector on head.
Added fields to options database.
Some spelling errors corrected.
Added "overflow:auto" to options boxes.
Added some nonsense to the FAQ.

= 1.0 =
First version

== Upgrade Notice ==
= 1.1.0 =

Added some fronted and backend options. Corrected spelling and deleted some unneded code.

= 1.0 =
Plugin release.

== TODO ==

Prepare code for translation.
Clean a bit the code.
Add background image backend option.

== Directories explanation ==
* styleselector: contains subdirectories, license, readme and unistall files.
 "styleselector.php" Bootstrap
 "uninstall.php" Unistall file made by the boilerplate plugin generator.
 "index.php" Blank file made by the boilerplate plugin generator.

* admin: Where the config routines reside. Has an css dir with the styles of the config page, a js dir with client side routines, mostly appearence related ones. Partials, where the display of options are made. And two files, index.php, bank, and class-styleselector where main routines reside.
* public: has the same structure of the admin one. In partial has also a widget management routines file. 
* assets: images and media needed by the plugin.
* includes: general routines to make the pluging integrate witn Wordpress.
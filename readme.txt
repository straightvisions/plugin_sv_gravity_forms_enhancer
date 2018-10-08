=== SV Gravity Forms Enhancer ===
Contributors: Matthias Reuter
Donate link: 
Tags: gravity forms, gforms, multi instance, multiple gravity forms
Requires at least: 4.7
Tested up to: 4.9.8
Stable tag: 1.0.5
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Requires PHP: 7.0
Donate link: https://straightvisions.com/product/sv-gravity-forms-enhancer-extended/

Improves Gravity Forms in various ways.

== Description ==

= Requires: =
* PHP 7.0 or higher
* WordPress 4.7.x or higher
* Gravity Forms Plugin

Please note that most recent version of Gravity Forms is recommended, as we will not test on older versions.

= Plugin Description =

SV Gravity Forms Enhancer fixes several issues we've seen when utilizing the great Gravity Forms plugin for our customers. While Gravity Forms is an easy to use feature rich form plugin, we see some technical limitations under the hood. This plugin improves some details which could become critical to your project, e.g. reaching Pagespeed 100 or allow multiple instances on a single page.

This plugin is provided in two editions. The free version will improve the outdated feature from https://wordpress.org/plugins/gravity-forms-multiple-form-instances/ and will allow multiple form instances for Gravity Forms.

== Free Version ==

= jQuery 3 Support =

Some javascript Code in Gravity Forms hasn't been prepared for use with jQuery 3 yet. As more and more websites will move to Bootstrap 4 which advices jQuery 3, this plugin will optimize the Gravity Forms javascript output to allow use of jQuery 3.

= Multi Instance per Page Support =

Multiple Form Instances are normally not possible with Gravity Forms. That means you won't be able to insert the same form multiple times on the same page. This plugin fixes this and also works with Multi Page Forms.

== Extended Version ==

This is available on [straightvisions store](https://straightvisions.com/product/sv-gravity-forms-enhancer-extended/) and includes free features as well as provides additional features. As these require more attention in maintenance, we cannot provide these features for free. The features of the Extended Version:

= Enhanced Multiple Instance =

Support for the following Gravity Forms extensions:

* Post Update
* User Update

= Pagespeed 100 =

When using Gravity Forms, you'll see that your heavily Google optimized website may get a drop in pagespeed. That's because of they way how Gravity Forms loads Javascript.

Default way: jQuery dependent code is inserted inline into the website's code output, so you won't be able to load jQuery within your footer (e.g. with outstanding WP Rocket Caching plugin) - you are required to load jQuery in head which results in Google Pagespeed warning [Remove Render-Blocking Javascript](https://developers.google.com/speed/docs/insights/BlockingJS)

We make it better: SV Gravity Forms Enhancer - Extended will search within the gravity forms output for inline Javascript, moves it into separate files and enqueues them which allows to load them into website's footer. Multiple instances are supported here as well.

== Roadmap ==

We will always look for ways on how to improve great plugins and features or build new ones where there is a demand. If you need more features, premium support or consulting and development for outstanding Pagespeed 100 WordPress sites, please never hesitate to [contact us](https://straightvisions.com)

= Team =

* Developed and maintenanced by <a href="https://straightvisions.com">straightvisions</a>

== Installation ==

This plugin is build to work out-of-the-box, no configuration required. Installation is quite simple:

1. Upload `sv-gravity-forms-enhancer`-directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. You are using a caching plugin? Don't forget to flush caches now.

== Frequently asked questions ==

= Is this plugin for free? =

This plugin is for free and licensed to GPL.
It's open source following the GPL policy.

= How can I revert all changes or reset the plugin? =
This plugin does not leave any ghost entries. Just deactivate and delete plugin on plugin listing page in WP-Admin.

= Does this plugin calls to another server? =

No.

= I've seen problems when using this plugin =

Please note that we do not support or test all extensions available for gravity forms. If you see any issues, your setup is currently not supported. As we love to improve this plugin, please open a support ticket in plugin's discussions on wordpress plugin repository and we will consider to add support in future - or [contact us](https://straightvisions.com) for premium support.

== Screenshots ==

1. Multiple Form Instances

== Changelog ==
= 1.0.5 =
Fixes for JS caching

= 1.0.4 =
Fixes for enhanced UI feature

= 1.0.3 =
Minor PHP Warnings fixed

= 1.0.2 =
Activation Error fixed

= 1.0.1 =
Tiny MCE Rich Text Editor (RTE) Support for multiple form instances

= 1.0 =
Initial Release

== Upgrade Notice ==
= 1.0.5 =
Fixes for JS caching

= 1.0.4 =
Fixes for enhanced UI feature

= 1.0.3 =
Minor PHP Warnings fixed

= 1.0.2 =
Activation Error fixed

= 1.0.1 =
Tiny MCE Rich Text Editor (RTE) Support for multiple form instances

= 1.0 =
Initial Release

== Missing a feature? ==

Please use the plugin support forum here on WordPress.org. We will add your wish - if achievable - on our todo list. Please note that we can not give any time estimate for that list or any feature request.

= Paid Services =
Nevertheless, feel free to hire our [full stack webdeveloper](https://straightvisions.com) team if you have any of the following needs:

* get a customization
* get a feature rapidly / on time
* get a custom WordPress plugin or theme developed to exactly fit your needs.
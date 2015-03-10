=== Plugin Name ===
Contributors: cristian.raiber
Tags: comments, spam, recaptcha, login protection, comment protection, spam protection, nocaptcha, recaptcha, captcha
Requires at least: 3.9
Tested up to: 4.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds the reCaptcha form to the WordPress login form, recover password form, register form and comment form.

== Description ==

A very useful plugin for everyone using WordPress. Adds reCaptcha security to the WordPress login form, register form and comment form. This plugin could help your blog get rid of a lot of spam comments or brute-force attacks.

Nothing gets passed it if the reCaptcha doesn't validate.

A few notes about the plugin:

*   Supports audio or image captcha types
*   Can generate the reCaptcha image / audio type in a number of predefined languages
*   Adds reCaptcha protection to the WordPress login form
*   Adds reCaptcha protection to the WordPress register form
*   Adds reCaptcha protection to the WordPress comment form
*   Adds reCaptcha protection to the WordPress recover password form

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the whole contents of the folder `uber-recaptcha` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Fill in your Site & Secret key, which you can get here: https://www.google.com/recaptcha/
1. Select the type of captcha you want: audio / image
1. Select where you'd want the reCaptcha form to be rendered: login, register or comment form
1. Enjoy a spam free blog & extra security for your back-end panel :)



== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.1 =
Added reCaptcha on recover password form
PHP 5.3.29 compatibility fix
Minor other fixes

= 1.0.0 = 
Initial release

=== Upgrade for Unattach and Re-attach Media Attachments ===
Contributors: laurencebahiirwa
Donate link: https://www.paypal.me/omukiguy
Tags: Attachments, Unattach, Re-Attach, Media Library, Upgrade
Requires at least: 4.9.0
Tested up to: 6.0
Stable tag: 1.2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Allows to unattach and reattach images and other attachments from within the media library page.

== Description ==

WordPress allows to attach (or assign) images and other attachments organized within the Media Library to posts and pages. A file will automatically be attached to a particular post when uploaded using the Add media button in that post. There are also "Attach" links in the Media Library to manually attach files to posts. Once attached there is no way to unattach or re-attach images, pdfs or any attachment in WordPress core.

This plugin fills this gap by providing two additional links next to "Attach" in the **Media Library**:

*   **Re-Attach**: Allows user to choose a new post to attach the media file.
*   **Unattach**: Totally removes an existing relation between an attachment and a post.

== Bulk Actions ==
The plugin also provides bulk actions for unattaching and re-attaching multiple files at once! Just mark the files you want to change, select your desired action from the *Bulk Actions* dropdown and hit *Apply*.

== Installation ==
1. Upload the plugin to the `/wp-content/plugins/` directory or from the repository.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Refer to plugin description in regards to setting up how the plugins works
1. **It will work out of the box**. Move to your media library and you can unattach and re-attach attachments to various posts.

== Upgrade Notice ==

= Version 1.2.1 (07.05.2020) =
1. Remove unused assets.
1. Add missing file links.
1. Test for 5.4.1

= Version 1.2.0 (22.04.2020) =
1. Improve Internalization for plugin.
1. Improve file structure for better code management.
1. Structured the code for WordPress code Standards.
1. Text for WP 5.4.

== Note ==
[My initial issue came from here](https://stackoverflow.com/questions/45690582/image-post-attachments-not-specific-to-post/45705413#45705413). Thanks to [Unattach and Re-attach Media Attachments](https://wordpress.org/plugins/unattach-and-re-attach-attachments//) which inspired this plugin. Just adding upgrades of the code to the latter so it is safer for use and have fixed some bugs.

== Frequently Asked Questions ==

= How can I contribute? =
You can raise lots of [issues](https://github.com/bahiirwa/upgrade-for-unattach-re-attach-media-attachments/) here and also make some [Pull Requests through github](https://github.com/bahiirwa/upgrade-for-unattach-re-attach-media-attachments/)

== Screenshots ==
1. Bulk actions "Unattach" and "Re-Attach" in the Media Library
1. The extended "Parent" column in the Media Library
1. Individual actions "Unattach" and "Re-Attach" per post
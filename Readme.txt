=== Upgrade Unattach and Re-attach Media Attachments ===
* Contributors: Laurence bahiirwa
* Tags: image,attachment,attachments,media,library,unattach,detach,reattach,unattached,un-attach,attach,assign
* Requires at least: 3.0.0
* Tested up to: 4.8.0
* Stable tag: 1.0

Allows to unattach and reattach images and other attachments from within the media library page.

== Description ==

WordPress allows to attach (or assign) images and other attachments organized within the Media Library to posts and pages. A file will automatically be attached when uploading it in the post creation form. There are also "Attach" links in the Media Library to manually attach files to posts. Once attached there is no way to unattach or re-attach images, pdfs or any attachment in WordPress core.

This plugin fills this gap by providing two additional links next to "Attach" in the **Media Library**:

*   **Re-Attach**: Allows to choose a new post to attach the file to
*   **Unattach**: Totally removes an existing relation between an attachment and a post

== Bulk Actions ==
The plugin also provides bulk actions for unattaching and re-attaching multiple files at once! Just mark the files you want to change, select your desired action from the *Bulk Actions* dropdown and hit *Apply*.

== Installation ==
Upload the plugin to your blog and activate it as any other plugin. **It will work out of the box**. Move to your media library and you can unattach and re-attach attachments to various posts.

== Note ==
Thanks to [tamlyn](http://profiles.wordpress.org/tamlyn/) who created the plugin [Unattach](http://wordpress.org/extend/plugins/unattach/) and [Unattach and Re-attach Media Attachments](https://wordpress.org/plugins/unattach-and-re-attach-attachments//) which inspired this plugin. Just adding upgrades of the code to the latter so it is safer for use. [My initial issue came from here](https://stackoverflow.com/questions/45690582/image-post-attachments-not-specific-to-post/45705413#45705413)

== Frequently Asked Questions ==
1. How can I contribute?
* You can raise lots of issues here and also make some Pull Requests.

== Screenshots ==
1. The extended "Parent" column in the Media Library
1. Bulk actions "Unattach" and "Re-Attach"

== Changelog ==

= Version 1.0.0 (16.08.2017)
* Security Upgrades added the inspire plugin
* Refactor the code to make it leaner
* Easy to read code.

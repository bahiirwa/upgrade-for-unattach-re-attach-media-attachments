# Upgrade Unattach and Re-attach Media Attachments
* Contributors: Laurence bahiirwa
* Tags: image,attachment,attachments,media,library,unattach,detach,reattach,unattached,un-attach,attach,assign
* Requires at least: 3.0.0
* Tested up to: 4.8.2
* Stable tag: 1.1.0

Allows to unattach and reattach images and other attachments from within the media library page.

## Description

WordPress allows to attach (or assign) images and other attachments organized within the Media Library to posts and pages. A file will automatically be attached to a particular post when uploaded using the Add media button in that post. There are also "Attach" links in the Media Library to manually attach files to posts. Once attached there is no way to unattach or re-attach images, pdfs or any attachment in WordPress core.

This plugin fills this gap by providing two additional links next to "Attach" in the **Media Library**:

*   **Re-Attach**: Allows to choose a new post to attach the file to
*   **Unattach**: Totally removes an existing relation between an attachment and a post

## Bulk Actions
The plugin also provides bulk actions for unattaching and re-attaching multiple files at once! Just mark the files you want to change, select your desired action from the *Bulk Actions* dropdown and hit *Apply*.

## Installation
1. Upload the plugin to the `/wp-content/plugins/` directory or from the repository.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Refer to plugin description in regards to setting up how the plugins works
1. **It will work out of the box**. Move to your media library and you can unattach and re-attach attachments to various posts.

## Note
[My initial issue came from here](https://stackoverflow.com/questions/45690582/image-post-attachments-not-specific-to-post/45705413#45705413). Thanks to [Unattach and Re-attach Media Attachments](https://wordpress.org/plugins/unattach-and-re-attach-attachments//) which inspired this plugin. Just adding upgrades of the code to the latter so it is safer for use and have fixed some bugs.

## Frequently Asked Questions
1. How can I contribute?
* You can raise lots of issues here and also make some Pull Requests.

## Screenshots
1. Bulk actions "Unattach" and "Re-Attach" in the Media Library
1. The extended "Parent" column in the Media Library
1. Individual actions "Unattach" and "Re-Attach" per post

## Changelog

### Version 1.1.0 (15.10.2017)
* Fixed issue/bug with attach and unattach options appearing on all bulk action select tags.
* Tested for WP Version 4.8.2
* Better Documentation

### Version 1.0.0 (16.08.2017)
* Security Upgrades added the inspire plugin
* Refactor the code to make it leaner
* Easy to read code.

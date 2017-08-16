<?php
  if ( ! defined( 'ABSPATH' ) ) {
   exit;
  }
/*
 * Plugin Functions
 * @package   Lurma
 * @link      https://github.com/bahiirwa/lurma
 */

/*
 * Deletes 'post_parent' from an attachment to unattach attachment.
 */
 function lurma_unattach_attachment() {
 	global $wpdb;

 	if (!empty($_REQUEST['post_id'])) {
 		$wpdb->update($wpdb->posts, array('post_parent'=>0),
 		  array('id' => (int)$_REQUEST['post_id'], 'post_type' => 'attachment'));
 	}

 	wp_redirect(admin_url('upload.php'));
 	exit;
 }


 /*
  * Implements action 'admin_menu' to provide a callback for lurma_unattach_attachment().
  */
 function lurma_admin_menu() {
 	if ( current_user_can( 'upload_files' ) ) {
 		//this is hacky but couldn't find the right hook
 		add_submenu_page('tools.php', 'Unattach Media', 'Unattach', 'upload_files', 'unattach', 'lurma_unattach_attachment');
 		remove_submenu_page('tools.php', 'unattach');
 	}
 }


 /*
  * Implements filter 'manage_upload_columns' to replace column 'parent' with
  * out custom column 'extended_parent'.
  */
 function lurma_manage_upload_columns($columns) {
 	unset($columns['parent']);
 	$columns['extended_parent'] = __( 'Parent', 'uar');
 	return $columns;
 }


 /*
  * Implementes action 'manage_media_custom_column' to add a column into the
  * media page with link Attach, Unattach, Re-Attach.
  */
 function lurma_manage_media_custom_column($column_name, $id) {
 	$post = get_post($id);

 	// Only act on our custom column extended_parent.
 	if ($column_name != 'extended_parent') return;

 	if ($post->post_parent) {
 		if (get_post($post->post_parent)) $title = _draft_or_post_title($post->post_parent);
 		$url_unattach = admin_url('tools.php?page=unattach&noheader=true&post_id=' . $post->ID);
 		?>
     <strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo 'Uploaded on ' . get_the_time(__('Y/m/d')); ?>
     <br />
     <a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>'); return false;" href="#the-list"><?php _e('Re-Attach'); ?> </a>
     <br />
     <a href="<?php echo esc_url( $url_unattach ); ?>" title="<?php echo __( "Unattach this media item.", 'uar'); ?>"><?php _e( 'Unattach') ?> </a>

    <?php
    } else {
      _e( '(Unattached)' ); ?>
     <br />
     <a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>'); return false;" href="#the-list"><?php _e('Attach'); ?> </a>
     <?php
 	  }
 }

 /**
  * Adds new buld actions 'unattach' and 're-attach' to the media lib.
  *
  * @see http://wordpress.stackexchange.com/questions/29822/custom-bulk-action
 */
 function lurma_custom_bulk_admin_footer() {
 	global $post_type;
 	if( is_admin() ) {
 		?>
      <script type="text/javascript">
 				jQuery(document).ready(function() {
 					$ = jQuery;
 					$('<option>').val('unattach').text('<?php _e('Unattach')?>').appendTo("select[name='action']");
 					$('<option>').val('reattach').text('<?php _e('Re-Attach')?>').appendTo("select[name='action']");
 					$('<option>').val('unattach').text('<?php _e('Unattach')?>').appendTo("select[name='action2']");
 					$('<option>').val('reattach').text('<?php _e('Re-Attach')?>').appendTo("select[name='action2']");

 					$('#doaction, #doaction2').click(function(e){
 					    $('select[name^="action"]').each(function(){
 							if ( $(this).val() == 'reattach' ) {
 								e.preventDefault();
 								findPosts.open();
 							}
 						});
 					});
 				});
 			</script>
 <?php
 	}
 }

 /*
  * Implements a bulk action for unattaching items in bulk.
  *
  * @see http://wordpress.stackexchange.com/questions/91874/how-to-make-custom-bulk-actions-work-on-the-media-upload-page
  * @see http://www.skyverge.com/blog/add-custom-bulk-action/
  */
 function lurma_custom_bulk_action() {

 	//  ***if($post_type == 'attachment') {  REPLACE WITH:
 	if ( !isset( $_REQUEST['detached'] ) ) {

 		// get the action
 		$wp_list_table = _get_list_table('WP_Media_List_Table');
 		$action = $wp_list_table->current_action();

 		$allowed_actions = array("unattach");
 		if(!in_array($action, $allowed_actions)) return;

 		// security check
 		//  ***check_admin_referer('bulk-posts'); REPLACE WITH:
 		check_admin_referer('bulk-media');

 		// make sure ids are submitted.  depending on the resource type, this may be 'media' or 'ids'
 		if(isset($_REQUEST['media'])) {
 			$post_ids = array_map('intval', $_REQUEST['media']);
 		}

 		if(empty($post_ids)) return;

 		// this is based on wp-admin/edit.php
 		$sendback = remove_query_arg( array('unattached', 'untrashed', 'deleted', 'ids'), wp_get_referer() );
 		if ( ! $sendback )
 			$sendback = admin_url( "upload.php?post_type=$post_type" );

 		$pagenum = $wp_list_table->get_pagenum();
 		$sendback = add_query_arg( 'paged', $pagenum, $sendback );

 		switch($action) {
 			case 'unattach':
 				global $wpdb;

 				// if we set up user permissions/capabilities, the code might look like:
 				//if ( !current_user_can($post_type_object->cap->export_post, $post_id) )
 				//  wp_die( __('You are not allowed to unattach this post.') );
 				if ( !is_admin() )
 					wp_die( __('You are not allowed to unattach this post.') );

 				$unattached = 0;
 				foreach( $post_ids as $post_id ) {
 					// Alter post to unattach media file.
 					if ( $wpdb->update($wpdb->posts, array('post_parent'=>0), array('id' => (int)$post_id, 'post_type' => 'attachment')) === false)
 						wp_die( __('Error unattaching post.') );
 					$unattached++;
 				}

 				$sendback = add_query_arg( array('unattached' => $unattached, 'ids' => join(',', $post_ids) ), $sendback );
 				break;

 			default: return;
 		}

 		$sendback = remove_query_arg( array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view'), $sendback );

 		wp_redirect($sendback);
 		exit();
 	}
 }

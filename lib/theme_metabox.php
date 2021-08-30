<?php
// page side-bar
add_action( 'add_meta_boxes', 'add_page_meta_box_function' );
function add_page_meta_box_function() {
	add_meta_box('sidebar-list', 'Select Sidebar', 'registered_sidebar_function', 'page', 'side', 'high');
}
// page sidebar callback function
function registered_sidebar_function(){
	global $post;
	$sidebarName = get_post_meta($post->ID, 'sidebar_name', true);
	wp_nonce_field('keck_sidebar_save_meta_data', 'keck_sidebar_class_nonce' );?>
	<select name="sidebar_name">
		<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
			<option value="<?php echo $sidebar['id']; ?>" <?php  if($sidebar['id']== $sidebarName){ echo "selected='selected'";} ?> >
				<?php echo ucwords( $sidebar['name'] ); ?>
			</option>
		<?php } ?>
	</select>
	<?php
}

// page sidebar save function
add_action('save_post', 'save_page_meta_info');
function save_page_meta_info(){
	global $post;
	if ( ! isset( $_POST['keck_sidebar_class_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['keck_sidebar_class_nonce'], 'keck_sidebar_save_meta_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		update_post_meta($post->ID, "sidebar_name", $_POST["sidebar_name"]);
	}
}

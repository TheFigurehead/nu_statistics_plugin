<?php
// use NU_Stat\Component\General;
// require_once(ABSPATH . 'wp-admin/includes/dashboard.php');

// wp_add_dashboard_widget( 'test_dashboard1', __( 'Shitty plugin' ), function(){
//     echo "it works";
// } );

//GeneralComponent::init();
wp_enqueue_script( 'dashboard' );

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="dashboard-widgets-wrap">
<?php
	$screen = get_current_screen(); 
    $columns = absint($screen->get_columns());
	$columns_css = '';
	if ( $columns ) {
		$columns_css = " columns-$columns";
    }
    
    $column_headers = get_column_headers($screen);

?>

<div id="dashboard-widgets" class="nu_dashboard_widgets metabox-holder<?php echo $columns_css; ?>">
    <?php foreach($column_headers as $key => $column): ?>
	    <div id="postbox-container-<?=$column?>" class="postbox-container">
	        <?php do_meta_boxes( $screen->id, $key, '' ); ?>
	    </div>
    <?php endforeach; ?>
</div>

<?php
	wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
	wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
?>
</div><!-- dashboard-widgets-wrap -->
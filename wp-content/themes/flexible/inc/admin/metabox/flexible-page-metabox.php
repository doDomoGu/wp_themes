<?php
/**
 * Fucntions for rendering metaboxes in page area
 * 
 * @package Flexible
 */

add_action( 'add_meta_boxes', 'flexible_page_metabox' );

if( !function_exists( 'flexible_page_metabox' ) ):
	function flexible_page_metabox() {
        add_meta_box(
            'flexible_page_sidebar', // $id
            __( 'Page Sidebar', 'flexible' ), // $title
            'flexible_page_sidebar_callback', // $callback
            'page', // $page
            'side', // $context
            'default'
        ); // $priority

		add_meta_box(
			'flexible_page_icon', // $id
			__( 'Page Icon', 'flexible' ), // $title
			'flexible_page_icon_callback', // $callback
			'page', // $page
			'side', // $context
			'default'
        ); // $priority
	}
endif; //flexible_page_metabox

$flexible_page_sidebar_option = array(
                            'default-sidebar'    => array(
                                                        'id'        => 'default-sidebar',
                                                        'value'     => 'default_sidebar',
                                                        'label'     => __( 'Default Layout', 'flexible' )
                                                        ),
                            'right-sidebar'     => array(
                                                        'id'        => 'rigth-sidebar',
                                                        'value'     => 'right_sidebar',
                                                        'label'     => __( 'Right Sidebar', 'flexible' )
                                                        ),
                            'left-sidebar'      => array(
                                                        'id'        => 'left-sidebar',
                                                        'value'     => 'left_sidebar',
                                                        'label'     => __( 'Left Sidebar', 'flexible' )
                                                        ),
                            'no-sidebar-full-width' => array(
                                                        'id'        => 'no-sidebar',
                                                        'value'     => 'no_sidebar',
                                                        'label'     => __( 'No Sidebar Full Width', 'flexible' )
                                                        ),
                            'no-sidebar-content-centered' => array(
                                                        'id'        => 'no-sidebar-center',
                                                        'value'     => 'no_sidebar_center',
                                                        'label'     => __( 'No Sidebar Content Centered', 'flexible' )
                                                        )
                        );
/*--------------------------------------------------------------------------------------*/
/**
 * Call back function for page sidebar
 */
if( ! function_exists( 'flexible_page_sidebar_callback' ) ):
    function flexible_page_sidebar_callback() {
        global $post, $flexible_page_sidebar_option;

        $flexible_page_sidebar = get_post_meta( $post->ID, 'flexible_page_sidebar', true );
        $flexible_page_sidebar = empty( $flexible_page_sidebar ) ? 'default_sidebar' : $flexible_page_sidebar;

        wp_nonce_field( basename( __FILE__ ), 'flexible_page_meta_nonce' );
        
        foreach ( $flexible_page_sidebar_option as $field ) {
    ?>
        <input id="<?php echo esc_attr( $field['id'] ); ?>" type="radio" name="flexible_page_sidebar" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $flexible_page_sidebar ); ?>/>
        <label for="<?php echo esc_attr( $field['id'] ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
    <?php
        }

    }
endif;
/*--------------------------------------------------------------------------------------*/
/**
 * Call back function for page icon
 */
if( !function_exists( 'flexible_page_icon_callback' ) ):

	function flexible_page_icon_callback() {
		global $post;
        $flexible_page_icon = get_post_meta( $post->ID, 'flexible_page_icon', true );

		wp_nonce_field( basename( __FILE__ ), 'flexible_page_meta_nonce' );
?>
	<div class="meta-wrapper">
        <label for="mt-page-icon"><?php _e( 'Font Awesome Icon', 'flexible' ); ?></label>
        <input type="text" id="mt-page-icon" name="flexible_page_icon" value="<?php if( $flexible_page_icon ){ echo esc_attr( $flexible_page_icon ); }?>">
        <span class="field-desc"><em><?php _e( 'Add font awesome icon for service page.', 'flexible' ); ?></em></span>
    </div>
<?php
	}
endif;
/*--------------------------------------------------------------------------------------*/
/**
 * Function for save sidebar layout of post
 */
add_action( 'save_post', 'flexible_save_page_settings' );

if( ! function_exists( 'flexible_save_page_settings' ) ):

function flexible_save_page_settings( $post_id ) {

    global $post;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'flexible_page_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'flexible_page_meta_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
    	return;
    }        
        
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ){
        	return $post_id;  
        }            
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    
    //Post sidebar
    $old = get_post_meta( $post->ID, 'flexible_page_sidebar', true ); 
    $new = sanitize_text_field( $_POST['flexible_page_sidebar'] );

    if ( $new && $new != $old ) {  
        update_post_meta ( $post_id, 'flexible_page_sidebar', $new );  
    } elseif ( '' == $new && $old ) {  
        delete_post_meta( $post_id,'flexible_page_sidebar', $old );  
    }


    $flexible_page_icon = get_post_meta( $post->ID, 'flexible_page_icon', true );
    $stz_flexible_page_icon = sanitize_text_field( $_POST[ 'flexible_page_icon' ] );

    //update data for page icon
    if ( $stz_flexible_page_icon && '' == $stz_flexible_page_icon ){
        add_post_meta( $post_id, 'flexible_page_icon', $stz_flexible_page_icon );
    }elseif ( $stz_flexible_page_icon && $stz_flexible_page_icon != $flexible_page_icon ) {  
        update_post_meta( $post_id, 'flexible_page_icon', $stz_flexible_page_icon );  
    } elseif ( '' == $stz_flexible_page_icon && $flexible_page_icon ) {  
        delete_post_meta( $post_id, 'flexible_page_icon' );  
    }

}

endif;
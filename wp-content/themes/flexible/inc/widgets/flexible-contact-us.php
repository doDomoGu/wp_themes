<?php
/**
 * Widget for contact section
 *
 * @package Flexible
 */
add_action( 'widgets_init', 'register_contact_us_widget' );

function register_contact_us_widget() {
    register_widget( 'flexible_contact_us' );
}

class Flexible_Contact_Us extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'flexible_contact_us',
            'description' => __( 'Display contact form and related information.', 'flexible' )
        );
        parent::__construct( 'flexible_contact_us', __( 'Flexible: Contact Us', 'flexible' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $flexible_page_dropdown;
        
        $fields = array(

            'section_menu_id' => array(
                'flexible_widgets_name'         => 'section_menu_id',
                'flexible_widgets_title'        => __( 'Section ID', 'flexible' ),
                'flexible_widgets_description'  => __( 'Section Id is only used in One Page Menu.', 'flexible' ),
                'flexible_widgets_field_type'   => 'text'
            ),

            'section_title' => array(
                'flexible_widgets_name'         => 'section_title',
                'flexible_widgets_title'        => __( 'Section Title', 'flexible' ),
                'flexible_widgets_field_type'   => 'text'
            ),

            'section_info' => array(
                'flexible_widgets_name'         => 'section_info',
                'flexible_widgets_title'        => __( 'Section Info', 'flexible' ),
                'flexible_widgets_row'          => 5,
                'flexible_widgets_field_type'   => 'textarea'
            ),

            'section_bg_image' => array(
                'flexible_widgets_name'         => 'section_bg_image',
                'flexible_widgets_title'        => __( 'Section Background', 'flexible' ),
                'flexible_widgets_field_type'   => 'upload'
            ),

            'section_page_id' => array(
                'flexible_widgets_name'         => 'section_page_id',
                'flexible_widgets_title'        => __( 'Select Page', 'flexible' ),
                'flexible_widgets_default'      => 0,
                'flexible_widgets_field_type'   => 'select',
                'flexible_widgets_field_options' => $flexible_page_dropdown
            ),

            'flexible_address_field' => array(
                'flexible_widgets_name'         => 'flexible_address_field',
                'flexible_widgets_title'        => __( 'Address', 'flexible' ),
                'flexible_widgets_field_type'   => 'text'
            ),

            'flexible_phone_field' => array(
                'flexible_widgets_name'         => 'flexible_phone_field',
                'flexible_widgets_title'        => __( 'Phone', 'flexible' ),
                'flexible_widgets_field_type'   => 'text'
            ),

            'flexible_email_field' => array(
                'flexible_widgets_name'         => 'flexible_email_field',
                'flexible_widgets_title'        => __( 'Email', 'flexible' ),
                'flexible_widgets_field_type'   => 'text'
            ),

            'flexible_map_field' => array(
                'flexible_widgets_name'         => 'flexible_map_field',
                'flexible_widgets_title'        => __( 'Map Section', 'flexible' ),
                'flexible_widgets_row'          => 5,
                'flexible_widgets_field_type'   => 'textarea'
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $flexible_section_menu_id  = empty( $instance['section_menu_id'] ) ? '' : $instance['section_menu_id'];
        $flexible_section_title    = empty( $instance['section_title'] ) ? '' : $instance['section_title'];
        $flexible_section_info          = empty( $instance['section_info'] ) ? '' : $instance['section_info'];
        $flexible_section_bg_image = empty( $instance['section_bg_image'] ) ? '' : $instance['section_bg_image'];
        $flexible_section_page_id  = empty( $instance['section_page_id'] ) ? null: $instance['section_page_id'];
        $flexible_contact_address  = empty( $instance['flexible_address_field'] ) ? '' : $instance['flexible_address_field'];
        $flexible_contact_phone    = empty( $instance['flexible_phone_field'] ) ? '' : $instance['flexible_phone_field'];
        $flexible_contact_email    = empty( $instance['flexible_email_field'] ) ? '' : $instance['flexible_email_field'];
        $flexible_contact_map    = empty( $instance['flexible_map_field'] ) ? '' : $instance['flexible_map_field'];

        if( !empty( $flexible_section_menu_id ) ) {
            $flexible_section_menu_id = 'id='.$flexible_section_menu_id;
        }

        if( !empty( $flexible_section_title ) || !empty( $flexible_section_info ) ) {
            $sec_title_class = 'has-title';
        } else {
            $sec_title_class = 'no-title';
        }

        echo $before_widget;
?>
        <div <?php echo $flexible_section_menu_id; ?> class="section-wrapper flexible-widget-wrapper" style="background-image: url(<?php echo $flexible_section_bg_image; ?>); background-attachment: fixed; background-size: cover; background-position: 50% -14px; background-repeat: no-repeat;">
            <div class="contact-overlay"> </div>
            <div class="mt-container">
                <div class="section-title-wrapper <?php echo esc_attr( $sec_title_class ); ?> clearfix">
                    <?php
                        if( !empty( $flexible_section_title ) ) {
                            echo $before_title . esc_html( $flexible_section_title ) . $after_title;
                        }

                        if( !empty( $flexible_section_info ) ) {
                            echo '<span class="section-info">'. esc_html( $flexible_section_info ) .'</span>';
                        }
                    ?>
                </div><!-- .section-title-wrapper -->
                <div class="left-section">
                    <?php 
                        $page_query = new WP_Query( 'page_id='.$flexible_section_page_id );
                        if( $page_query->have_posts() ) {
                            while ( $page_query->have_posts() ) {
                                $page_query->the_post();
                                the_content();
                            }
                        }
                    ?>
                </div><!--.left section -->
                <div class="right-section">
                    <div class="mt-column-wrapper clearfix">
                        <?php if( !empty( $flexible_contact_address ) ) { ?> <div class="mt-column-3 contact-info cs-address"><span class="contact-icon"> <i class="fa fa-map"> </i> </span><?php echo esc_html( $flexible_contact_address ); ?></div> <?php } ?>
                        <?php if( !empty( $flexible_contact_phone ) ) { ?> <div class="mt-column-3 contact-info cs-phone"><span class="contact-icon"> <i class="fa fa-phone"> </i> </span><?php echo esc_html( $flexible_contact_phone ); ?></div> <?php } ?>
                        <?php if( !empty( $flexible_contact_email ) ) { ?> <div class="mt-column-3 contact-info cs-email"><span class="contact-icon"> <i class="fa fa-envelope"> </i> </span><?php echo esc_html( $flexible_contact_email ); ?></div> <?php } ?>
                    </div>
                    <?php if( !empty( $flexible_contact_map ) ) { ?>
                        <div class="flexible-map-section">
                            <?php echo ( $flexible_contact_map ) ; ?>
                        </div><!-- .flexible-map-section -->
                    <?php } ?>
                </div><!--.right section -->
            </div>
        </div><!-- .section-wrapper -->
<?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    flexible_widgets_updated_field_value()      defined in flexible-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$flexible_widgets_name] = flexible_widgets_updated_field_value( $widget_field, $new_instance[$flexible_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    flexible_widgets_show_widget_field()        defined in flexible-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $flexible_widgets_field_value = !empty( $instance[$flexible_widgets_name]) ? $instance[$flexible_widgets_name] : '';
            flexible_widgets_show_widget_field( $this, $widget_field, $flexible_widgets_field_value );
        }
    }
}
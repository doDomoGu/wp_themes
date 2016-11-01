<?php
/**
 * Widget for about us section.
 *
 * @package Flexible
 */
add_action( 'widgets_init', 'register_about_page_widget' );

function register_about_page_widget() {
    register_widget( 'flexible_about_page' );
}

class Flexible_About_Page extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'flexible_about_page',
            'description' => __( 'Show your page in about section.', 'flexible' )
        );
        parent::__construct( 'flexible_about_page', __( 'Flexible: About Us Section', 'flexible' ), $widget_ops );
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

            'section_page_id' => array(
                'flexible_widgets_name' => 'section_page_id',
                'flexible_widgets_title' => __( 'Select Page', 'flexible' ),
                'flexible_widgets_default'      => 0,
                'flexible_widgets_field_type' => 'select',
                'flexible_widgets_field_options' => $flexible_page_dropdown
            )
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
        $flexible_section_menu_id = empty( $instance['section_menu_id'] ) ? '' : $instance['section_menu_id'];
        $flexible_section_title   = empty( $instance['section_title'] ) ? '' : $instance['section_title'];
        $flexible_section_page_id    = empty( $instance['section_page_id'] ) ? null: $instance['section_page_id'];
        
        if( !empty( $flexible_section_menu_id ) ) {
            $flexible_section_menu_id = 'id='.$flexible_section_menu_id;
        }

        echo $before_widget;
    ?>
        <div <?php echo $flexible_section_menu_id; ?> class="section-wrapper about-section-wrapper flexible-widget-wrapper">
            <div class="mt-container">
        <div <?php echo $flexible_section_menu_id; ?> class="">
            <div class="flexible-container">
                <?php 
                    if( $flexible_section_page_id ) {
                        $about_page_query = new WP_Query( 'page_id='.$flexible_section_page_id );
                        if( $about_page_query->have_posts() ) {
                            while( $about_page_query->have_posts() ) {
                                $about_page_query->the_post();
                                $image_id = get_post_thumbnail_id();
                                $image_path = wp_get_attachment_image_src( $image_id, 'large', true );                       
                                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>
                                <div class="section-content-wrapper">
                                    <?php 
                                        if( !empty( $flexible_section_title ) ) {
                                            echo $before_title . esc_html( $flexible_section_title ) . $after_title;
                                        } else {
                                            echo $before_title . get_the_title() . $after_title;
                                        }
                                    ?>
                                    <div class="page-content"><?php the_content();?></div>
                                </div><!-- .page-main-wrapper -->
                                <div class="page-thumb-wrapper">
                                    <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt ); ?>"></figure>
                                </div><!-- .page-thumb-wrapper -->
                <?php
                            }
                        }
                    }
                ?>
            </div><!-- .flexible-container -->
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
            $flexible_widgets_field_value = !empty( $instance[$flexible_widgets_name]) ? esc_attr($instance[$flexible_widgets_name] ) : '';
            flexible_widgets_show_widget_field( $this, $widget_field, $flexible_widgets_field_value );
        }
    }
}
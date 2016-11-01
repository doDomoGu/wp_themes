<?php
/**
 * Widget for portfolio section
 *
 * @package Flexible
 */
add_action( 'widgets_init', 'register_portfolio_section_widget' );

function register_portfolio_section_widget() {
    register_widget( 'flexible_portfolio_section' );
}

class Flexible_Portfolio_Section extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'flexible_portfolio_section',
            'description' => __( 'Display posts in portfolio section which page have portfolio template.', 'flexible' )
        );
        parent::__construct( 'flexible_portfolio_section', __( 'Flexible: Portfolio Section', 'flexible' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

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

            'section_page_count' => array(
                'flexible_widgets_name'         => 'section_page_count',
                'flexible_widgets_title'        => __( 'Number of pages to display', 'flexible' ),
                'flexible_widgets_default'          => 8,
                'flexible_widgets_field_type'   => 'number'
            ),

            'section_widget_info' => array(
                'flexible_widgets_name'         => 'section_widget_info',
                'flexible_widgets_title'        => __( 'Note: Create the pages and select Portfolio Template to display in portfolio section.', 'flexible' ),
                'flexible_widgets_field_type'   => 'widget_info'
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

        $flexible_section_menu_id       = empty( $instance['section_menu_id'] ) ? '' : $instance['section_menu_id'];
        $flexible_section_title         = empty( $instance['section_title'] ) ? '' : $instance['section_title'];        
        $flexible_section_info          = empty( $instance['section_info'] ) ? '' : $instance['section_info'];
        $flexible_section_page_count    = empty( $instance['section_page_count'] ) ? 6: $instance['section_page_count'];

        if( !empty( $flexible_section_menu_id ) ) {
            $flexible_section_menu_id = 'id='.$flexible_section_menu_id;
        }

        if( !empty( $flexible_section_title ) || !empty( $flexible_section_info ) ) {
            $sec_title_class = 'has-title';
        } else {
            $sec_title_class = 'no-title';
        }

        $page_array = array();
        $pages = get_pages();
        // get the pages associated with Services Template.
        foreach ( $pages as $page ) {
            $page_id = $page->ID;
            $template_name = get_post_meta( $page_id, '_wp_page_template', true );
            if( $template_name == 'templates/flexible-portfolio.php' ) {
                array_push( $page_array, $page_id );
            }
        }
        $portfolio_page_args = array(
                        'post_type'         => 'page',
                        'post__in'          => $page_array,
                        'posts_per_page'    => $flexible_section_page_count,
                        'orderby'           => array( 'menu_order' => 'ASC', 'date' => 'DESC' )
                        );
        $portfolio_page_query = new WP_Query( $portfolio_page_args );

        echo $before_widget;
    ?>
            <div <?php echo $flexible_section_menu_id; ?> class="section-wrapper flexible-widget-wrapper">
                <div class="mt-container">
                    <div class="section-title-wrapper <?php echo esc_attr( $sec_title_class ); ?>">
                        <?php
                            if( !empty( $flexible_section_title ) ) {
                                echo $before_title . esc_html( $flexible_section_title ) . $after_title;
                            }

                            if( !empty( $flexible_section_info ) ) {
                                echo '<span class="section-info">'. esc_html( $flexible_section_info ) .'</span>';
                            }
                        ?>
                    </div><!-- .section-title-wrapper -->
                </div><!-- .flexible-container -->

                    <?php
                        if( !empty( $page_array ) ) {
                            $page_count = 0;
                    ?>
                        <div class="portfolio-pages-wrapper clearfix">
                            <?php
                                if( $portfolio_page_query->have_posts() ) {
                                    while( $portfolio_page_query->have_posts() ) {
                                        $portfolio_page_query->the_post();
                                        $page_count++;
                                        //$page_id = get_the_ID();
                                        $image_id = get_post_thumbnail_id();
                                        $image_path = wp_get_attachment_image_src( $image_id, 'large', true );
                                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                            ?>
                                        <div class="single-portfolio-wrapper clearfix">
                                            <?php if( has_post_thumbnail() ) { ?>
                                                <div class="portfolio-thumb">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" title="<?php the_title() ;?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="portfolio-content-wrapper">
                                                <h5 class="portfolio-title"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h5>
                                                <a href="<?php the_permalink(); ?>" class="plus-link"> <i class="fa fa-plus"> </i> </a>
                                            </div><!-- .single-content-wrapper" -->
                                        </div><!-- .single-page-wrapper -->
                            <?php
                                        if( $page_count % 4 == 0 && $page_count > 1 ) {
                                            echo '<div class="clearfix"></div>';
                                        }
                                    }
                                }
                            ?>
                        </div><!-- .service-pages-wrapper -->
                    <?php
                        }
                    ?>
                
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
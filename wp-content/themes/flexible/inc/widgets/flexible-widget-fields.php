<?php
/**
 * Define custom fields for widgets
 * 
 * @package Flexible
 */
function flexible_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $flexible_widgets_field_type ) {

    	// Standard text field
        case 'text' :
        ?>
            <p>
                <label for="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>"><?php echo $flexible_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>" type="text" value="<?php echo $athm_field_value; ?>" />

                <?php if ( isset( $flexible_widgets_description ) ) { ?>
                    <br />
                    <small><em><?php echo $flexible_widgets_description; ?></em></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Standard url field
        case 'url' :
        ?>
            <p>
                <label for="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>"><?php echo $flexible_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>" type="text" value="<?php echo $athm_field_value; ?>" />

                <?php if ( isset( $flexible_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo $flexible_widgets_description; ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Textarea field
        case 'textarea' :
        ?>
            <p>
                <label for="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>"><?php echo $flexible_widgets_title; ?>:</label>
                <textarea class="widefat" rows="<?php echo $flexible_widgets_row; ?>" id="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>"><?php echo $athm_field_value; ?></textarea>
            </p>
        <?php
            break;

        // Checkbox field
        case 'checkbox' :
        ?>
            <p>
                <input id="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>"><?php echo $flexible_widgets_title; ?></label>

                <?php if ( isset( $flexible_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo $flexible_widgets_description; ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Radio fields
        case 'radio' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $flexible_widgets_default;
        	}
        ?>
            <p>
                <?php
                echo $flexible_widgets_title;
                echo '<br />';
                foreach ( $flexible_widgets_field_options as $athm_option_name => $athm_option_title ) {
                    ?>
                    <input id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>" type="radio" value="<?php echo $athm_option_name; ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
                    <label for="<?php echo $instance->get_field_id( $athm_option_name ); ?>"><?php echo $athm_option_title; ?></label>
                    <br />
                <?php } ?>

                <?php if ( isset( $flexible_widgets_description ) ) { ?>
                    <small><?php echo $flexible_widgets_description; ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Select field
        case 'select' :
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $flexible_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>"><?php echo $flexible_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>" class="widefat">
                    <?php foreach ( $flexible_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo $athm_option_name; ?>" id="<?php echo $instance->get_field_id($athm_option_name); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo $athm_option_title; ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $flexible_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo $flexible_widgets_description; ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        case 'number' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $flexible_widgets_default;
        	}
        ?>
            <p>
                <label for="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>"><?php echo $flexible_widgets_title; ?>:</label><br />
                <input name="<?php echo $instance->get_field_name( $flexible_widgets_name ); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id( $flexible_widgets_name ); ?>" value="<?php echo $athm_field_value; ?>" class="small-text" />

                <?php if ( isset( $flexible_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo $flexible_widgets_description; ?></small>
                <?php } ?>
            </p>
       	<?php
            break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id( $flexible_widgets_name );
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name( $flexible_widgets_name );

            if ( $value ) {
                $class = ' has-file';
                $value = explode( 'wp-content', $value );
                $value = content_url().$value[1];
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="' . $instance->get_field_id( $flexible_widgets_name ) . '">' . $flexible_widgets_title . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . __( 'No file chosen', 'flexible' ) . '" />' . "\n";
            if ( function_exists( 'wp_enqueue_media' ) ) {
                if ( ( $value == '') ) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . __( 'Upload', 'flexible' ) . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . __( 'Remove', 'flexible' ) . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . __( 'Upgrade your version of WordPress for full media support.', 'flexible' ) . '</i></p>';
            }

            $output .= '<div class="screenshot upload-thumb" id="' . $id . '-image">' . "\n";

            if ( $value != '' ) {
                $remove = '<a class="remove-image">'. __( 'Remove', 'flexible' ).'</a>';
                $output .= '<img src="' . $value . '" alt="Upload Image" />';
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;

        //Widget info
        case 'widget_info':
        ?>
            <div class="widget-info"><?php echo esc_html( $flexible_widgets_title ); ?></div>
        <?php    
            break;

        //Multi checkboxes
        case 'multicheckboxes':
        ?>
            <label><?php echo esc_attr( $flexible_widgets_title ); ?>:</label>

        <?php    
            foreach ( $flexible_widgets_field_options as $athm_option_name => $athm_option_title) {
                if( isset( $athm_field_value[$athm_option_name] ) ) {
                    $athm_field_value[$athm_option_name] = 1;
                }else{
                    $athm_field_value[$athm_option_name] = 0;
                }
                
            ?>
                <p>
                    <input id="<?php echo $instance->get_field_id( $athm_option_name ); ?>" name="<?php echo $instance->get_field_name( $flexible_widgets_name ).'['.$athm_option_name.']'; ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value[$athm_option_name]); ?>/>
                    <label for="<?php echo $instance->get_field_id( $athm_option_name ); ?>"><?php echo $athm_option_title; ?></label>
                </p>
            <?php
                }
                if ( isset( $flexible_widgets_description ) ) {
            ?>
                    <small><em><?php echo $flexible_widgets_description; ?></em></small>
            <?php
                }
            break;
    }
}

function flexible_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    // Allow only integers in number fields
    if ( $flexible_widgets_field_type == 'number') {
        return flexible_sanitize_number( $new_field_value );

        // Allow some tags in textareas
    } elseif ( $flexible_widgets_field_type == 'textarea' ) {
        // Check if field array specifed allowed tags
        if ( !isset( $flexible_widgets_allowed_tags ) ) {
            // If not, fallback to default tags
            $flexible_widgets_allowed_tags = '<p><strong><em><a><iframe>';
        }
        return strip_tags( $new_field_value, $flexible_widgets_allowed_tags );

        // No allowed tags for all other fields
    } elseif ( $flexible_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif( $flexible_widgets_field_type == 'multicheckboxes' ) {
        return $new_field_value;
    } else {
        return strip_tags( $new_field_value );
    }
}
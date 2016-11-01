<?php
/**
 * Define customizer custom classes
 *
 * @package Flexible
 */

if( class_exists( 'WP_Customize_Control' ) ) {

	class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'flexible' ),
                    'option_none_value' => '',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    }

    /**
     * Customize for textarea, extend the WP customizer
     */
    class Textarea_Custom_Control extends WP_Customize_Control{
    	/**
    	 * Render the control's content.    	 * 
    	 */
    	public $type = 'flexible_textarea';
      public function render_content() {
    		?>
    		<label>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
    				<?php echo esc_textarea( $this->value() ); ?>
    			</textarea>
    		</label>
    		<?php
    	}
    }

    class WP_Customize_Section_Label extends WP_Customize_Control {
        /**
         * Render the control's content.         * 
         */

        public $type = 'section_label';
        public function render_content() {
            if ( !empty( $this->label ) ) {
        ?>
            <h3 class="section-label"><?php echo esc_html( $this->label ); ?></h3>
            <span><i class="fa fa-plus"></i></span>
    <?php 
            }
        }
    }

    class Hashone_Dropdown_Multiple_Chooser extends WP_Customize_Control{
        public function render_content(){
            //var_dump($this);
            if ( empty( $this->choices ) )
                    return;
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                        <?php
                        foreach ( $this->choices as $value => $label )
                            echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
                        ?>
                    </select>
                </label>
            <?php
        }
    }


}
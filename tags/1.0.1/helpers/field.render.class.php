<?php


class ncr_render_engine {

    protected $checkboxes;
    protected $options;
    protected $settings_field = 'uncr_settings';


    /**
     * Function that is responsible for checking if an option has a value in it or not.
     *
     * Returns false if it doesn't
     *
     * @param $option_id
     *
     * @since   1.0.0
     */
        public function check_option_value($option_id) {

            $this->option_id = $option_id;
            $this->options = get_option($this->settings_field);

            if($this->options[$this->option_id]) {
                return $this->options[$this->option_id];
            } else {
                return;
            }

        }

    /**
     * Function that is responsible for generating text fields
     *
     * @param $args
     * @return string
     *
     * @since   1.0.0
     */
        public function render_text_field($args)
        {

            $output = '<fieldset>';
                $output .= '<label title="'.$args['title'].'">';
                    $output .= '<input class="regular-text" type="text" id="' . $args['id'] . '" name="'.$this->settings_field.'['.$args['id'].']'.'" value="'. sanitize_text_field( $this->check_option_value($args['id']) ).'">';
                    $output .= '<span class="description">' . $args['title'] . '</span>';
                $output .= '</label><br />';
            $output .= '</fieldset>';

            return $output;
        }

    /**
     * Function that is responsible for generating radio fields
     *
     * @param $args
     * @return string
     *
     * @since   1.0.0
     */
    public function render_radio_field($args) {

        $output = '<fieldset>';

        foreach($args['options'] as $name => $value) {

            $output .= '<label title="'.$args['title'].'">';
                $output .= '<input type="radio" name="'.$this->settings_field.'['.$args['id'].']'.'" value="'. esc_attr( $name ) .'"'. checked($this->check_option_value($args['id']), $name, false) .'>';
                $output .= '<span>'.$value.'</span>';
            $output .= '</label><br />';
        }

        $output .= '</fieldset>';

        return $output;

    }

    /**
     * Function that is responsible for generating checkbox fields
     *
     * @param $args
     * @return string
     *
     * @since   1.0.0
     */
        public function render_checkbox_field($args) {

            $output = '<fieldset>';

                $args['options'] = array_flip($args['options']);

                foreach( $args['options'] as $value => $key) {

                    $output .= '<label title="'.$args['title'].'">';
                        $output .= '<input type="checkbox" name="'.$this->settings_field.'['.$args['options'][$value].']'.'" value="'. esc_attr( $key ) .'"'. checked( $this->check_option_value($args['options'][$value]), $key, false) .'>'.$value;
                    $output .= '</label><br />';

                }

            $output .= '</fieldset>';

            return $output;

        }

    public function render_select_field($args) {


        $output = '<fieldset>';

            $output .= '<select multiple="false" name="'.$this->settings_field.'['.$args['id'].']'.'">';

                foreach($args['options'] as $value => $key) {

                    $output .= "<option value='$key'" . selected( $this->check_option_value($args['id']), $key, false ) . ">$value</option>";

                }
            $output .= '</select>';

        $output .= '</fieldset>';

        return $output;

    }
}
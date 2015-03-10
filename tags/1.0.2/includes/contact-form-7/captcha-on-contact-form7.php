<?php

/**
 * TODO
 *
 * In the future, I should separate the front-end views from the back-end
 */

/**
 * The functionality that handles the display of the reCaptcha form on the Contact Form 7 plugin
 * back-end as well as front-end.
 *
 * @package    Uber_Recaptcha
 * @subpackage Uber_Recaptcha/includes/captcha-on-login-form
 * @author     Cristian Raiber <hi@cristian.raiber.me>
 */




class ncr_captcha_on_cf7 extends ncr_base_class
{

    public function __construct()
    {

        parent::__construct();

        add_action( 'wpcf7_init', array( &$this , 'add_shortcode_recaptcha' ) );
        add_action( 'wp_enqueue_scripts' , array( &$this , 'recaptcha_enqueue_script') );
        add_action( 'admin_init', array( &$this , 'add_tag_generator_recaptcha' ), 45 );
        add_filter( 'wpcf7_validate_recaptcha', array( &$this , 'recaptcha_validation_filter' ) , 10, 2 );
        add_filter( 'wpcf7_validate_recaptcha*', array( &$this , 'recaptcha_validation_filter' ) , 10, 2 );
        add_filter( 'wpcf7_messages' , array( &$this , 'add_error_message' ) );

    }


    function add_error_message( $messages ) {
        $messages['wp_recaptcha_invalid'] = array(
            'description'	=> __( "Google reCaptcha does not validate.", 'wp-recaptcha-integration' ),
            'default'		=> __("The Captcha didn’t verify.",'wp-recaptcha-integration')
        );
        return $messages;
    }

    function add_shortcode_recaptcha() {
        wpcf7_add_shortcode(
            array( 'recaptcha','recaptcha*'),
            array(&$this,'recaptcha_shortcode_handler'), true );
    }



    function recaptcha_shortcode_handler( $tag ) {

        $tag = new WPCF7_Shortcode( $tag );
        if ( empty( $tag->name ) )
            return '';

        $atts = null;
        if ( $theme = $tag->get_option('theme','',true) )
            $atts = array( 'data-theme' => $theme );

        //$recaptcha_html = WP_reCaptcha::instance()->recaptcha_html( $atts );
        $recaptcha_html = '';
        $validation_error = wpcf7_get_validation_error( $tag->name );

        $html = sprintf(
            '<span class="wpcf7-form-control-wrap %1$s">%2$s %3$s</span>',
            $tag->name, $recaptcha_html, $validation_error );

        return $html;
    }

    function recaptcha_enqueue_script() {
        wp_enqueue_script('wpcf7-recaptcha-integration',plugins_url('/js/wpcf7.js',dirname(__FILE__)),array('contact-form-7'));
    }



    function add_tag_generator_recaptcha() {
        if ( ! function_exists( 'wpcf7_add_tag_generator' ) )
            return;
        wpcf7_add_tag_generator( 'recaptcha', __( 'reCAPTCHA', 'wp-recaptcha-integration' ),
            'wpcf7-tg-pane-recaptcha', array(&$this,'recaptcha_settings_callback') );
    }



    function recaptcha_settings_callback( $contact_form ) {
        $type = 'recaptcha';

        ?>
        <div id="wpcf7-tg-pane-<?php echo $type; ?>" class="hidden">
            <form action="">
                <table>
                    <tr><td><input type="checkbox" checked="checked" disabled="disabled" name="required" onclick="return false" />&nbsp;<?php echo esc_html( __( 'Required field?', 'contact-form-7' ) ); ?></td></tr>
                    <tr><td>
                            <?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?><br />
                            <input type="text" name="name" class="tg-name oneline" />
                            <?php echo esc_html( __( 'Error message', 'wp-recaptcha-integration' ) ); ?><br />
                        </td><td><?php
                            if ( 'grecaptcha' === WP_reCaptcha::instance()->get_option('recaptcha_flavor') ) {
                                $themes = WP_reCaptcha::instance()->captcha_instance()->get_supported_themes();
                                echo esc_html( __( 'Theme', 'contact-form-7' ) ); ?><br /><?php
                                ?><select name="recaptcha-theme-ui"><?php
                                    ?><option value=""><?php _e('Use default','wp-recaptcha-integration') ?></option><?php
                                    foreach ( $themes as $theme_name => $theme ) {
                                        ?><option value="<?php echo $theme_name; ?>"><?php echo $theme['label'] ?></option><?php
                                    }
                                    ?></select><?php
                                // cf7 does only allow literal <input>
                                ?><input type="hidden" name="theme" class="idvalue option" value="" /><?php
                                ?><script type="text/javascript">
                                    (function($){
                                        $(document).on('change','[name="recaptcha-theme-ui"]',function(){
                                            $(this).next('[name="theme"]').val( $(this).val() ).trigger('change');
                                        });
                                        $(document).on('change','[name="recaptcha-message-ui"]',function(){
                                            $(this).next('[name="message"]').val( $(this).val() ).trigger('change');
                                        });

                                    })(jQuery)
                                </script><?php
                            }
                            ?></td></tr>
                </table>
                <div class="tg-tag">
                    <?php echo esc_html( __( "Copy this code and paste it into the form left.", 'contact-form-7' ) ); ?><br />
                    <input type="text" name="<?php echo $type; ?>" class="tag wp-ui-text-highlight code" readonly="readonly" onfocus="this.select()" />
                </div>
            </form>
        </div>
    <?php
    }



    function recaptcha_validation_filter( $result, $tag ) {


        $tag = new WPCF7_Shortcode( $tag );
        $name = $tag->name;

        if ( ! WP_reCaptcha::instance()->recaptcha_check() ) {
            $message = wpcf7_get_message( 'wp_recaptcha_invalid' );
            if ( ! $message )
                $message = __("The Captcha didn’t verify.",'wp-recaptcha-integration');

            if ( method_exists($result, 'invalidate' ) ) { // since CF7 4.1
                $result->invalidate( $tag , $message );
            } else {
                $result['valid'] = false;
                $result['reason'][$name] = $message;
            }
        }
        return $result;
    }
}



new ncr_captcha_on_cf7();
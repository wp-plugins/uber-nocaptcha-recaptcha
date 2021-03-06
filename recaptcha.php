<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions.
 *
 * @link              https://github.com/cristianraiber/uber-recaptcha
 * @since             1.0.0
 * @package           Uber_Recaptcha
 *
 * @wordpress-plugin
 * Plugin Name:       Über reCaptcha
 * Plugin URI:        http://www.tamewp.com/uber-recaptcha/
 * Description:       Adds Googles' reCaptcha to WordPress forms.
 * Version:           1.0.2
 * Author:            Cristian Raiber
 * Author URI:        www.cristian.raiber.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uncr_translate
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The class responsible for orchestrating the core plugin.
 *
 * Holds the base class for our plugin; CSS / JS
 */
require_once  plugin_dir_path(__FILE__) . 'includes/plugin-main-class.php';

/**
 * The class responsible for adding the admin notices when the plugin is first activated.
 */
require_once  plugin_dir_path(__FILE__) . 'helpers/admin.notices.class.php';

/**
 * The class responsible for generating and adding the required API mark-up on the WordPress login form.
 */
require_once  plugin_dir_path(__FILE__) . 'includes/captcha-on-login.php';

/**
 * The class responsible for generating and adding the required API mark-up on the WordPress register form.
 */
require_once  plugin_dir_path(__FILE__) . 'includes/captcha-on-register-form.php';

/**
 * The class responsible for generating and adding the required API mark-up on the WordPress comment form.
 */
require_once  plugin_dir_path(__FILE__) . 'includes/captcha-on-comment-form.php';

/**
 * The class responsible for generating and adding the required API mark-up on the WordPress lost password form.
 */
require_once  plugin_dir_path(__FILE__) . 'includes/captcha-on-recover-password-form.php';



/**
 * The class responsible for generating the mark-up for the fields
 * on the plugin back-end.
 *
 *
 * Current fields supported in this version:
 *
 * 1.   text
 * 2.   checkbox
 * 3.   radio
 * 4.   select
 *
 */
require_once plugin_dir_path(__FILE__) . 'helpers/field.render.class.php';

/**
 * The class responsible for registering all the actions & generating the plugin admin panel
 */
require_once  plugin_dir_path(__FILE__) . 'admin/settings.php';


/**
 * The code that runs during plugin activation.
 * This action is documented in base-class.php, static method: uncr_plugin_install
 */
register_activation_hook( __FILE__, array( 'ncr_base_class', 'uncr_plugin_install') );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in base-class.php, static method: uncr_plugin_uninstall
 */
register_deactivation_hook(__FILE__, array( 'ncr_base_class', 'uncr_plugin_uninstall') );

/**
 * Begins execution of the plugin.
 *
 *
 * @since    1.0.0
 */
function uber_recaptcha_run() {

    new ncr_base_class();
}

uber_recaptcha_run();
<?php

/**
 * Options Page
 *
 * Renders the settings page contents.
 *
 * @since       1.0.0
 */
?>

<div class="wrap">
    <form method="post" action="">
        <?php settings_fields('uncr_settings_group');               //settings group, defined as first argument in register_setting ?>
        <?php do_settings_sections('uncr_settings_section_call');   //same as last argument used in add_settings_section ?>
        <?php submit_button(); ?>
        <?php wp_nonce_field('uncr_settings_nonce'); ?>
    </form>
</div>
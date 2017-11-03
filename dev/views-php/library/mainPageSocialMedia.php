<?php

// Social media Icons on main page
function social_media_add_menu() {
    add_options_page(__('Social Media Settings','sequencesh'), __('Social Media','sequencesh'), 'manage_options', 'social_media', 'social_media_page');
}

function social_media_page() { ?>
<div class="wrap">
    <h1><?php _e('Social Media','sequencesh') ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'section-social-media' );
        do_settings_sections( 'add-social-media' );
        submit_button();
        ?>
    </form>
</div>
<?php }

add_action( 'admin_menu', 'social_media_add_menu' );

function facebook() { ?>
    <input type="text" name="facebook" id="facebook" value="<?php echo get_option( 'facebook' ); ?>" />
<?php }
function twitter() { ?>
    <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }
function google_plus() { ?>
    <input type="text" name="google_plus" id="google_plus" value="<?php echo get_option( 'google_plus' ); ?>" />
<?php }
function linkedIn() { ?>
    <input type="text" name="linkedIn" id="linkedIn" value="<?php echo get_option( 'linkedIn' ); ?>" />
<?php }

function social_media_page_setup() {
    add_settings_section( 'section-social-media', __('Insert social media addresses', 'sequencesh') , null, 'add-social-media' );
    add_settings_field( 'address_social_media1', 'Facebook URL', 'facebook', 'add-social-media', 'section-social-media' );
    add_settings_field( 'address_social_media2', 'Twitter URL', 'twitter', 'add-social-media', 'section-social-media' );
    add_settings_field( 'address_social_media3', 'Google plus URL', 'google_plus', 'add-social-media', 'section-social-media' );
    add_settings_field( 'address_social_media4', 'LinkedIn URL', 'linkedIn', 'add-social-media', 'section-social-media' );

    register_setting('section-social-media', 'facebook');
    register_setting('section-social-media', 'twitter');
    register_setting('section-social-media', 'google_plus');
    register_setting('section-social-media', 'linkedIn');
}
add_action( 'admin_init', 'social_media_page_setup' );
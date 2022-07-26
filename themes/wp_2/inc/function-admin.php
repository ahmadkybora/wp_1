<?php
/*
@p meme

*/

// این قسمت برای افزودن به سایدبار پنل ادمین میباشد
add_action( 'admin_menu', 'register_survey' );

function register_survey(){
    add_menu_page( 'Survey', 'Survey', 'manage_options', '/survey/survey-admin.php', '', 'dashicons-admin-customizer', 30 );
}

function sunset_add_admin_page()
{
    // پارامتر چهارمی ادرس یم page است
    // و پارامتر بعدی میتواند یک تابع باشد
    add_menu_page( 'Sunset', 'Sunset', 'manage_options', 'sunset-page', 'sunset_theme_create_page', 'dashicons-admin-customizer', 31 );
    add_submenu_page('sunset-page', 'Sunset Sidebar options', 'Sidebar', 'manage_options', 'sunset_page', 'sunset_them_setting_pages');
    add_submenu_page('sunset-page', 'Sunset Theme Settings', 'Theme Options', 'manage_options', 'sunset_page_theme', 'sunset_theme_support_page');
    add_submenu_page('sunset-page', 'Sunset Css Settings', 'Custom Css', 'manage_options', 'sunset_page_css', 'sunset_them_setting_pages');   
    // add_action('admin_init', 'sunset_custom_settings');

    //Activate custom settings
    add_action( 'admin_init', 'sunset_custom_settings' );
}
add_action( 'admin_menu', 'sunset_add_admin_page' );

function sunset_custom_settings()
{
    // sidebar options
    register_setting('sunset-settings-group', 'profile_picture');
    register_setting('sunset-settings-group', 'first_name');
    register_setting('sunset-settings-group', 'last_name');
    register_setting('sunset-settings-group', 'user_description');
    register_setting('sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-settings-group', 'facebook_handler');
    register_setting('sunset-settings-group', 'gplus_handler');

    /**
     * پارامتر چهارمی در اصل یک آی دی است که باید 
     * با آی دی بالا یکی باشد
     */
    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'sunset-page');
    
    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'sunset-page', 'sunset-sidebar-options');
    add_settings_field('sidebar-menu', 'Full Name', 'sunset_sidebar_name', 'sunset-page', 'sunset-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'sunset_sidebar_description', 'sunset-page', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'sunset-page', 'sunset-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facbook', 'sunset-page', 'sunset-sidebar-options');
    add_settings_field('sidebar-gplus', 'Gplus handler', 'sunset_sidebar_gplus', 'sunset-page', 'sunset-sidebar-options');

    // theme support options
    register_setting('sunset-theme-suppport', 'post_formats', 'sunset_post_formats_callback');

    add_settings_section('sunset_theme_options', 'Theme Options', 'sunset_them_options', 'sunset_page_theme');

    add_settings_field('post_format', 'post Formats', '');
}

// post format callback Function
function sunset_post_formats_callback($input)
{
    return $input;
}
function sunset_them_options()
{
    echo 'Activate And Deactivate';
}
function sunset_sidebar_options()
{
    echo '<p>Custom Your Sidebar Information</p>';
}
function sunset_sidebar_profile()
{
    $picture = esc_attr(get_option('profile_picture'));
    echo '
        <input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" />
        <input type="hidden" id="profile-picture" name="profile_picture" value="' . $picture . '" />
    ';
}
function sunset_sidebar_name()
{
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));
    echo '
        <input type="text" name="first_name" value="' . $firstName . '" placeholder="First Name" />
        <input type="text" name="last_name" value="' . $lastName . '" placeholder="Last Name" />
    ';
}
function sunset_sidebar_description()
{
    $description = esc_attr(get_option('user_description'));
    echo '
        <input type="text" name="user_description" value="' . $description . '" placeholder="Description" />
    ';
}
function sunset_sidebar_twitter()
{
    $twitter = esc_attr(get_option('twitter_handler'));
    echo '<input type="text" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter Handler" />';
}
function sunset_sidebar_facbook()
{
    $facbook = esc_attr(get_option('facebook_handler'));
    echo '
        <input type="text" name="facebook_handler" value="' . $facbook . '" placeholder="Facebook Handler" />
    ';
}
function sunset_sidebar_gplus()
{
    $gplus = esc_attr(get_option('gplus_handler'));
    echo '<input type="text" name="gplus_handler" value="' . $gplus . '" placeholder="Gplus Handler" />';
}

function sunset_sanitze_twitter_handler( $input )
{
    $output = sanitize_text_field( $input );
    $output = str_replace('@', '', $output);
    return $output;
}

function sunset_theme_create_page()
{
    require_once(get_template_directory() . '/inc/templates/sunset-admin.php');
}

function sunset_theme_support_page()
{
    require_once(get_template_directory() . '/inc/templates/sunset-theme-support.php');
}

function sunset_them_setting_pages()
{
    echo '<p>Sunset Custom CSS</p>';
}
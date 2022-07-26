<?php

require_once get_template_directory() . "/inc/function-admin.php";
require_once get_template_directory() . "/inc/enqueue.php";

function footman_menus()
{
    /**
     * ساخت نوبار
     */
    $location = array(
        'primary' => 'Des', 
        'footer' => 'footer', 
    );

    /**
     * رجیستر کردن
     */
    register_nav_menus($location);
}
/**
 * هوک اینیشیالز
 */
add_action('init', 'footman_menus');

function footman_theme_support()
{
    /**
     * add dynamic title tag support
     */
    add_theme_support('title_tag');
    add_theme_support('custom-logo');
    add_theme_support('post_thumbnails');
}

add_action('after_stup_theme', 'footman_theme_support');

/**
 * در این صفحه 2 هوک درست شده برای لینکهای کدهای 
 * جاوااسکریپتی و css
 * 
 */
function footman_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('footman-style', get_template_directory_uri() . "/style.css", array('footman-bootstrap'), $version, 'all');
    wp_enqueue_style('footman-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css", array(), '5.2.0', 'all');
    wp_enqueue_style('footman-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css", array(), '6.1.1', 'all');
}

/**
 * بوسیله این متد استایل ها چسبیه میشود
 */
add_action('wp_enqueue_scripts', 'footman_register_styles');


function footman_register_scripts()
{
    /**
     * در صورتی که گزینه ترو را یگذارید لینک بعدی را
     * هم چک میکنید وگرنه اولی را چک میکند
     */
    wp_enqueue_script('footman-jquery', 'https://code.jquery.com/jquery-3.6.0.slim.min.js', array(), '3.6.0', true);
    wp_enqueue_script('footman-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js', array(), '2.9.2', true);
    wp_enqueue_script('footman-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js', array(), '5.2.0', true);
    wp_enqueue_script('footman-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'footman_register_scripts');
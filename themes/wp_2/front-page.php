<?php
get_header();
?>

<p>hello world</p>
<?php 
if(function_exists('the_custom_logo')) {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id);
}
/**
 * نمایش منوها
 */
    wp_nav_menu(
        array(
            'menu' => 'primary',
            'container' => '',
            'theme_location' => 'primary', 
            'items_wrap' => '<ul id="" class="navbar-nav flex-column text-sm-center text-md-left">%3$s</ul>'
        )
    )
?>
<article>
    <?php
        /**
         * اینجا نمایش پست انجام میشود
         */
        if( have_posts() ) {
            while(have_posts()){
                the_post();
                the_content();
            }
        }
    ?>
</article>


<?php
get_footer();
?>
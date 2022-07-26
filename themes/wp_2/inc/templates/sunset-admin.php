<h1>Sunset Theme Option</h1>
<?php settings_errors(); ?>

<?php 
    $picture = esc_attr( get_option( 'profile-picture' ) );
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr( get_option( 'user_descrition' ) ); 
?>

<div class="sunset-sidebar-preview">
    <div class="sunset-sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>); ">
            </div>
        </div>
        <h1 clas="sunset-username"><?php print $fullName; ?></h1>
        <h1 clas="sunset-description"><?php print $description; ?></h1>
        <div class="icon_wrapper"></div>
    </div>
</div>

<form method="post" action="options.php" class="sunset-general-form">
    <?php settings_fields( 'sunset-settings-group'); ?>
    <?php do_settings_sections('sunset-page'); ?>
    <?php submit_button(); ?>
</form>
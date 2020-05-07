
<?php
 /*
  * Plugin Name: GWC Scheduler Pro
  * Author: Natasha Johnson
  * Description: Post the Girls Who Code class schedule here! <3 <3
  */
// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('My Cool Plugin Settings', 'Girls Who Code Classes', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , 'dashicons-clock', 200);

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'instructor' );
	register_setting( 'my-cool-plugin-settings-group', 'lesson' );
	register_setting( 'my-cool-plugin-settings-group', 'guest-speaker' );
}

function my_cool_plugin_settings_page() {

    if (array_key_exists('submit_scripts_update')) {
        update_option('my_cool_plugin_name', $_POST['']);
        update_option('my_cool_plugin_lesson', $_POST['']);
        update_option('my_cool_plugin_guest_speaker', $_POST['']);
    }


    $gwc_instructor = get_option('my_cool_plugin_name', 'none');
    $gwc_lesson = get_option('my_cool_plugin_lesson', 'none');
    $gwc_guest_speaker = get_option('my_cool_plugin_guest_speaker', 'none');
?>
<div class="wrap">
<h1>Schedule a Class</h1>
<p>Post the Girls Who Code Schedule Here!</p>
<form method="post" action="options.php">
    <?php //settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php //do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Instructor*</th>
        <td><input type="text" name="instructor" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Lesson of the day*</th>
        <td>
            <select id="lesson" name="lesson">
                <option value="select">- Select -</option>
                <option value="web development">Web Development (HTML/CSS, JavaScript, WordPress)</option>
                <option value="web design">Web Design (AdobeXD, Wireframing, CSS3)</option>
                <option value="3D printing">3D Printing</option>
                <option value="robotics">Robotics</option>
            </select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Guest Speaker (optional)</th>
        <td><input type="text" name="guest-speaker" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>
    </table>
    <br>
    <input type="submit" name="submit_post_update" class="button button-primary" value="POST SCHEDULE">

</form>
</div>
<?php } ?>

<?php
function display_gwc_schedule() {
    $gwc_instructor = get_option('my_cool_plugin_name', 'none');
    $gwc_lesson = get_option('my_cool_plugin_lesson', 'none');
    $gwc_guest_speaker = get_option('my_cool_plugin_guest_speaker', 'none');

    $content = $gwc_instructor;
    $content .=  $gwc_lesson;
    $content .= $gwc_guest_speaker;

    return $content;
}
 
 add_shortcode('Schedule', 'display_gwc_schedule');
 ?>
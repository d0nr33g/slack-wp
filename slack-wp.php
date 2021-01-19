<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.arajae.com
 * @since             1.0.0
 * @package           Slack_Wp
 *
 * @wordpress-plugin
 * Plugin Name:       slackforwp
 * Plugin URI:        www.arajae.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ahmed ragaee
 * Author URI:        www.arajae.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       slack-wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SLACK_WP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-slack-wp-activator.php
 */
function activate_slack_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-slack-wp-activator.php';
	Slack_Wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-slack-wp-deactivator.php
 */
function deactivate_slack_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-slack-wp-deactivator.php';
	Slack_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_slack_wp' );
register_deactivation_hook( __FILE__, 'deactivate_slack_wp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-slack-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_slack_wp() {

	$plugin = new Slack_Wp();
	$plugin->run();

}
run_slack_wp();
function wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Slack for WordPress Caduceus', 'textdomain' ),
        'Slack For WP',
        'manage_options',
        'slack_wp_page',
        'slack_wp_page_callback',
        '',
        6
    );
}
function slack_wp_page_callback() {
    echo '<div style="margin-top: 50px;">';
    echo '<form action="'.admin_url( 'admin-post.php' ).'" method="post">';
    echo '<input type="hidden" name="action" value="slack_wp_form">';
    echo '<label>Access Token: <input type="text" name="token" value="xoxb-1645078640917-1633418109319-LT0xJSQhqWrLCYfspw5ws87k"></label>';
    echo '<input type="submit" value="List Channels" class="button action">';
    echo '</form>';

    echo '<form action="'.admin_url( 'admin-post.php' ).'" method="post" style="margin-top: 10px;">';
    echo '<input type="hidden" name="action" value="slack_wp_create_channel_form">';
    if(!empty($_GET['token'])){
        echo '<input type="hidden" name="token" value="'.$_GET['token'].'">';
    }else{
        echo '<input type="hidden" name="token" value="xoxb-1645078640917-1633418109319-LT0xJSQhqWrLCYfspw5ws87k">';
    }
    echo '<label>Add Channel: <input type="text" name="ch_name" placeholder="Channel Name"></label>';
    echo '<input type="submit" value="Create" class="button action">';
    echo '</form>';

    if(!empty($_GET['token'])){
        slack_wp_list_channels($_GET['token']);
    }
    echo '</div>';
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
function slack_wp_list_channels($token){
    $ch = curl_init('https://slack.com/api/conversations.list');
    curl_setopt($ch, CURLOPT_POSTFIELDS,  'token='.$token);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $out = curl_exec($ch);
    curl_close($ch);
    $channels = json_decode($out, true);
    echo '<h3>Channels: </h3>';
    foreach($channels['channels'] as $channel){
        echo '<pre>';
        print_r($channel['name']);
        echo '</pre>';
    }
}
add_action( 'admin_post_slack_wp_form', 'slack_wp_form_action_hook' );
function slack_wp_form_action_hook() {
    wp_redirect( add_query_arg( 'token', $_POST['token'], admin_url('admin.php?page=slack_wp_page') )  );
    exit;
}
add_action( 'admin_post_slack_wp_create_channel_form', 'slack_wp_create_channel_form_action_hook' );
function slack_wp_create_channel_form_action_hook() {
    $ch = curl_init('https://slack.com/api/conversations.create');
    curl_setopt($ch, CURLOPT_POSTFIELDS,  'token='.$_POST['token'].'&name='.$_POST['ch_name']);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $out = curl_exec($ch);
    curl_close($ch);
    wp_redirect( add_query_arg( 'token', $_POST['token'], admin_url('admin.php?page=slack_wp_page') )  );
    exit;
}
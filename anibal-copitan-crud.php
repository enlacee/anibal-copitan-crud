<?php

/**
 * WordPress plugin generator by AnibalCopitan
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.anibalcopitan.com
 * @since             1.0.0
 * @package           AnibalCopitanCrud
 *
 * @wordpress-plugin
 * Plugin Name:       Anibal Copitan Crud
 * Plugin URI:        http://www.anibalcopitan.com
 * Description:       Plugin created by Anibal Copitan
 * Version:           1.0.0
 * Author:            AnibalCopitan
 * Author URI:        http://www.anibalcopitan.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       anibal-copitan-crud
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'ANIBAL_COPITAN_CRUD_FILE' ) ) {
	define( 'ANIBAL_COPITAN_CRUD_FILE', __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-anibal-copitan-crud-activator.php
 * @param Boolean $networkwide status multisite
 * @return Void
 */
function activate_anibal_copitan_crud($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-anibal-copitan-crud-activator.php';
	AnibalCopitanCrudActivator::activate($networkwide);

	// crear tabla
	require_once plugin_dir_path( __FILE__ ) . 'admin/acc-table-crud.php';
	$table = Acc_Table_Crud::getInstance();
	$table->install();
	$table->install_data();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-anibal-copitan-crud-deactivator.php
 * @param Boolean $networkwide status multisite
 * @return Void
 */
function deactivate_anibal_copitan_crud($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-anibal-copitan-crud-deactivator.php';
	AnibalCopitanCrudDeactivator::deactivate($networkwide);

	// remove tabla
	require_once plugin_dir_path( __FILE__ ) . 'admin/acc-table-crud.php';
	$table = Acc_Table_Crud::getInstance();
	$table->uninstall();
}

register_activation_hook( __FILE__, 'activate_anibal_copitan_crud' );
register_deactivation_hook( __FILE__, 'deactivate_anibal_copitan_crud' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/libraries/class-anibal-copitan-crud-gulpfile.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-anibal-copitan-crud.php';

/**
 * Begins execution of the plugin.
*/
$plugin = AnibalCopitanCrud::getInstance();
$plugin->run();

/*
* Usefull functions prefix: an = anbNews
*/
function acc_get_file_path()
{
	return __FILE__;
}

function acc_get_dir_path()
{
	return plugin_dir_path(__FILE__);
}

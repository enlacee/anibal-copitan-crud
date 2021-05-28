<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.altimea.com
 * @since      1.0.0
 *
 * @package    AnibalCopitanCrud
 * @subpackage AnibalCopitanCrud/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    AnibalCopitanCrud
 * @subpackage AnibalCopitanCrud/includes
 * @author     Altimea <apps@altimea.com>
 */
class AnibalCopitanCrudi18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'anibal-copitan-crud',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

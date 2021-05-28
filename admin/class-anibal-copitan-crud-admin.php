<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.altimea.com
 * @since      1.0.0
 *
 * @package    AnibalCopitanCrud
 * @subpackage AnibalCopitanCrud/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AnibalCopitanCrud
 * @subpackage AnibalCopitanCrud/admin
 * @author     Altimea <apps@altimea.com>
 */
class AnibalCopitanCrudAdmin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $anibal_copitan_crud    The ID of this plugin.
	 */
	private $anibal_copitan_crud;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $anibal_copitan_crud       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $anibal_copitan_crud, $version ) {

		$this->anibal_copitan_crud = $anibal_copitan_crud;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AnibalCopitanCrudLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AnibalCopitanCrudLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->anibal_copitan_crud, plugin_dir_url( __FILE__ ) . 'css/anibal-copitan-crud-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AnibalCopitanCrudLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AnibalCopitanCrudLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->anibal_copitan_crud, plugin_dir_url( __FILE__ ) . 'js/anibal-copitan-crud-admin.js', array( 'jquery' ), $this->version, false );

	}

}

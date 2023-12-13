<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.abyxo.com
 * @since      1.0.0
 *
 * @package    sandbox
 * @subpackage sandbox/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    sandbox
 * @subpackage sandbox/public
 * @author     Dylan Prudhomme <dylan.prudhomme@abyxo.agency>
 */

class sandbox_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in sandbox_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The sandbox_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sandbox-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-cart', plugin_dir_url( __FILE__ ) . 'css/cart.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-checkout', plugin_dir_url( __FILE__ ) . 'css/checkout.css', array(), $this->version, 'all' );

	}

    /**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in sandbox_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The sandbox_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sandbox-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajaxurl', admin_url( 'admin-ajax.php' ) );

	}


}
function apply_coupon() {
    $coupon_code = sanitize_text_field($_POST['coupon_code']);

    if (WC()->cart->apply_coupon($coupon_code)) {
        $response = array(
            'success' => true,
            'message' => __('Coupon applied successfully.', 'woocommerce')
        );
    } else {
        $response = array(
            'success' => false,
            'message' => __('Invalid coupon code. Please try again.', 'woocommerce')
        );
    }

    wp_send_json($response);
}
add_action('wp_ajax_apply_coupon', 'apply_coupon');
add_action('wp_ajax_nopriv_apply_coupon', 'apply_coupon');

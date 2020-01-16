<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://serwiskibic.azurewebsites.net/
 * @since      1.0.0
 *
 * @package    Bet_Stats
 * @subpackage Bet_Stats/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Bet_Stats
 * @subpackage Bet_Stats/public
 * @author     s15921, s15827, s15515, s14244 <s15921@pjwstk.edu.pl>
 */
class Bet_Stats_Public {

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
	 * The loader that's responsible for loading template files in plugin.
	 *
	 * @since    1.4
	 * @access   private
	 * @var      Bet_Stats_Template_Loader    $template_loader    Template loader object.
	 */
	private $template_loader;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 * @param      Bet_Stats_Template_Loader    $template_loader    Template loader object.
	 */
	public function __construct( $plugin_name, $version, $template_loader ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->template_loader = $template_loader;

		$this->bet_stats_set_templ_data();

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
		 * defined in Bet_Stats_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bet_Stats_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bet-stats-public.css', array(), $this->version, 'all' );

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
		 * defined in Bet_Stats_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bet_Stats_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bet-stats-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Sets data which will be passed later to template.
	 *
	 * @since    1.4
	 */
	public function bet_stats_set_templ_data() {

		spl_autoload_register(function ($class_name) {
			$file = plugin_dir_path( __FILE__ ) . 'partials/bookmakers/' . $class_name . '.php';
			if (file_exists($file)) {
				require_once $file;
			}
		});

		//add new bookmaker class to an array and implement that class to add new bookmaker to plugin
		$bMakers = ['Fortuna', 'Sts'];
		for ($i = 0; $i < count($bMakers); $i++) {
			$bMakers[$i] = $bMakers[$i]::getMatches();
		}

		$this->template_loader = array( 'self' => $this->template_loader, 'data' => $bMakers );

	}

	/**
	 * Load statistics from bookmakers APIs and display for the public-facing side of the site.
	 *
	 * @since    1.2
	 */
	public function bet_stats_info() {

		ob_start();

		$this->template_loader['self']
			->set_template_data( $this->template_loader['data'], 'bMakers' )
			->get_template_part( 'bet-stats-public-display' );

		return ob_get_clean();

	}

	/**
	 * Register a widget for the public-facing side of the site.
	 *
	 * @since    1.3
	 * @access   public
	 */
	public function reg_widget() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bet-stats-helper-widget.php';
		register_widget( new Bet_Stats_Helper_Widget( $this->template_loader ) );

	}

}

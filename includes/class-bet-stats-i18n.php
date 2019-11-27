<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://serwiskibic.azurewebsites.net/
 * @since      1.0.0
 *
 * @package    Bet_Stats
 * @subpackage Bet_Stats/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bet_Stats
 * @subpackage Bet_Stats/includes
 * @author     s15921, s15827, s15515, s14244 <s15921@pjwstk.edu.pl>
 */
class Bet_Stats_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bet-stats',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

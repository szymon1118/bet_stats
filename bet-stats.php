<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://serwiskibic.azurewebsites.net/
 * @since             1.0
 * @package           Bet_Stats
 *
 * @wordpress-plugin
 * Plugin Name:       Betting statistics
 * Plugin URI:        https://serwiskibic.azurewebsites.net/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.1
 * Author:            s15921, s15827, s15515, s14244
 * Author URI:        https://serwiskibic.azurewebsites.net/
 * License:           MIT
 * License URI:       https://mit-license.org/
 * Text Domain:       bet-stats
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
define( 'BET_STATS_VERSION', '1.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bet-stats-activator.php
 */
function activate_bet_stats() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bet-stats-activator.php';
	Bet_Stats_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bet-stats-deactivator.php
 */
function deactivate_bet_stats() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bet-stats-deactivator.php';
	Bet_Stats_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bet_stats' );
register_deactivation_hook( __FILE__, 'deactivate_bet_stats' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bet-stats.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
 
//Temporary solution
require_once plugin_dir_path( __FILE__ ) . 'bookmakers/Bookmaker.php';
// require_once plugin_dir_path( __FILE__ ) . 'bookmakers/Fortuna.php';
// require_once plugin_dir_path( __FILE__ ) . 'bookmakers/Sts.php';

function bet_stats_info() {
	$fortuna = new Fortuna();
	$sts = new Sts();
	$matches = $fortuna->getData()[0]['competitions'][0]['matches'];
	$matchesSts = $sts->getData()['result'];
	
	//var_dump($fortuna->getData());
	$len = count($matches);
	//echo "xDDD: " . $len . "\n";
	
	//<table style="display: block; width: 700px; height: auto; margin: 0 4rem;">
	$html = '<table>';
	
	for ($i = 0; $i < $len; $i++) {
		$html .= '<tr style="margin-top: 20px;"><td>';
		
		$html .= 'Mecz: ' . $matches[$i]['name'];
		
		$html .= '</td><td>';
		
		$html .= '<a href="https://www.efortuna.pl/pl/strona_glowna/pilka-nozna/' . substr($matches[$i]['matchid'], 3) . '">Kurs Fortuna</a>: ' . $matches[$i]['odds'][0]['value'] . ' | <a href="https://www.sts.pl/pl/oferta/zaklady-bukmacherskie/zaklady-sportowe/?action=offer&sport=184&region=6521&league=74157&oppty=' . $matchesSts[$i]['id_opportunity'] . '">Kurs STS</a>: ' . $matchesSts[$i]['odds'][0]['odds_value'];
		
		$html .= '</td></tr>';
	}
	$html .= '</table>';
	
	return $html;
	?>
		<!-- <h1>Dziala :D</h1> -->
	<?php
}
add_shortcode('betstats', 'bet_stats_info');
 
function run_bet_stats() {

	$plugin = new Bet_Stats();
	$plugin->run();

}
run_bet_stats();

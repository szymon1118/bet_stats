<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://serwiskibic.azurewebsites.net/
 * @since      1.0.0
 *
 * @package    Bet_Stats
 * @subpackage Bet_Stats/public/partials
 */
?>

<?php

//$filesToRequire = glob(plugin_dir_path( __FILE__ ) . 'bookmakers/*.php');
//foreach ($filesToRequire as $f) {
//	require_once($f);
//}

spl_autoload_register(function ($class_name) {
	//if doesnt work change to require, include or include_once
    require_once plugin_dir_path( __FILE__ ) . 'bookmakers/' . $class_name . '.php';
});

//maybe there is something better than calling "getMatches()" for each class
$bMakers = [Fortuna::getMatches(), Sts::getMatches()];

?>

<table>
<?php for ($i = 0; $i < 6; $i++) { ?>
	<tr style="margin-top: 20px;">
		<td>Mecz: <?php echo $bMakers[0][$i]->getName(); ?></td>
		<td>
<?php
	foreach ($bMakers as $bMaker) {
		$match = $bMaker[$i];
?>
			<a href="<?php echo $match->getLink(); ?>">Kurs <?php echo $match->getBookmakerName(); ?></a>: <?php echo $match->getStats(); ?> | 
			
	<?php } ?>
		</td>
	</tr>
<?php } ?>
</table>
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

$bMakers = (array)$bMakers;

//get matches from any bookmaker (random choice) to get match name from them later (the first one is chosen)
$anyBMakerMatches = $bMakers[0];

?>

<table>
<?php for ($i = 0; $i < 6; $i++) { ?>
	<tr style="margin-top: 20px;">
		<td>Mecz: <?php echo $anyBMakerMatches[$i]->getName(); ?></td>
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
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

<?php for ($i = 0; $i < 6; $i++) { ?>
	<div class="bet-stats-match">
		<table>
			<caption><?php echo $anyBMakerMatches[$i]->getTeamAName() . ' - ' . $anyBMakerMatches[$i]->getTeamBName(); ?></caption>
			<?php
				$odds = $anyBMakerMatches[$i]->getOdds();
			?>
			<tr>
				<th>X</th>
				<th><?php echo $odds['teamA_win']['name']; ?></th>
				<th><?php echo $odds['draw']['name']; ?></th>
				<th><?php echo $odds['teamB_win']['name']; ?></th>
			</tr>
		<?php
		foreach ($bMakers as $bMaker) {
			$match = $bMaker[$i];
			$matchOdds = $match->getOdds();
		?>
			<tr>
				<td>
					<a href="<?php echo $match->getLink(); ?>"><?php echo $match->getBookmakerName(); ?></a> odds
				</td>
				<td><?php echo $matchOdds['teamA_win']['value']; ?></td>
				<td><?php echo $matchOdds['draw']['value']; ?></td>
				<td><?php echo $matchOdds['teamB_win']['value']; ?></td>
			</tr>
		<?php } ?>
		</table>
	</div>
<?php } ?>
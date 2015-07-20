<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<table>
			<thead>
				<th>Date</th>
				<th>Victim</th>
				<th>Final Blow</th>
			</thead>
<?php
	require_once('zkillapi.php');
	
	// Just insert your corporation ID and alliance ID here
	$zkill = new \zKillAPI\zKill(<corporation ID>, <alliance ID>);
	
	foreach($zkill->get() as $kill)
	{
		$killmail = new \zKillAPI\KillMail($kill);
		
		// Only show player kills and only show kills made by your alliance
		if(strlen($killmail->getVictimName()) && $killmail->getKillerAllianceID() == \zKillAPI\zKill::$allianceID)
		{
			echo "<tr";
			
			if($killmail->getKillerCorpID() == \zKillAPI\zKill::$corpID)
				echo " class=\"corp_kill\"";
			
			echo ">\n";
			
			echo "<td class=\"date\"><a href=\"" . $killmail->getKillMailURL() . "\">" . $killmail->getKillDate() . "</a></td>\n";
			echo "<td class=\"victim\">" . $killmail->getVictimShipImage() . $killmail->getVictimName() . " &ndash; " . $killmail->getVictimCorpName() . "</td>\n";
			echo "<td class=\"killer\">" . $killmail->getKillerName() . " &ndash; " . $killmail->getKillerCorpName() . $killmail->getKillerShipImage() . "</td>\n";
			echo "</tr>\n\n";
		}
	}
?>
		</table>
	</body>
</html>

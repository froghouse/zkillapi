namespace zKillAPI;

require('urlbuilder.class.php');

class zKillAPITakesModifier
{
	protected $verb;
	protected $modifier;
	
	public function __construct($verb, $modifier)
	{
		$this->modifier = $modifier;
		$this->verb = $verb;
	}
	
	public function __toString()
	{
		return $this->verb . '/' . $this->modifier;
	}
}

class zKillAPITakesNoModifier
{
	protected $verb;
	
	public function __construct($verb)
	{
		$this->verb = $verb;
	}
	
	public function __toString()
	{
		return $this->verb;
	}
}

class zKillAPILimitModifiers extends zKillAPITakesModifier
{
	const Limit = "limit";
	const Page = "page";
	const StartTime = "startTime";
	const EndTime = "endTime";
	const Year = "year";
	const Month = "month";
	const Week = "week";
	const BeforeKillID = "beforeKillID";
	const AfterKillID = "afterKillID";
	const PastSeconds = "pastSeconds";
	const KillID = "killID";
}

class zKillAPIFetchType extends zKillAPITakesNoModifier
{
	const Kills = "kills";
	const losses = "losses";
	const WSpace = "w-space";
	const Solo = "solo";
}

/*
class zKillAPIOrderModifiers extends zKillAPITakesNoModifier
{
	const OrderDirection = "orderDirection";
	const OrderAsc = zKillAPIOrderModifiers::OrderDirection . "/asc"; // Default
	const OrderDesc = zKillAPIOrderModifiers::OrderDirection . "/desc";
}
*/

class zKillAPIFetchModifiers extends zKillAPITakesModifier
{
	const CharacterID = "characterID";
	const CorporationID = "corporationID";
	const AllianceID = "allianceID";
	const FactionID = "factionID";
	const ShipTypeID = "shipTypeID";
	const GroupID = "groupID";
	const SolarSystemID = "solarSystemID";
	const RegionID = "regionID";
}

class zKillAPIURLBuilder extends URLBuilder
{
	public function __construct($mod)
	{
		$this->proto = "https";
		$this->url = "zkillboard.com";
		$this->path = ["api"];
		$this->path[] .= $mod;
	}
	
	public function add($mod)
	{
		$this->path[] .= $mod;
	}
}

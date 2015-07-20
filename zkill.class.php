<?php
namespace zKillAPI;

require('cache.class.php');
require('urlbuilder.class.php');

class zKill
{
	public static $corpID;
	public static $allianceID;
	
	private $cache;
	
	public function __construct($corpID, $allianceID)
	{
		self::$corpID = $corpID;
		self::$allianceID = $allianceID;
		$url = new URLBuilder("https", "zkillboard.com", array("api", "kill", "corporationID", $corpID));
		$this->cache = new Cache($url->get(), "zKill.json");
		$this->cache->update();
	}
	
	public function get()
	{
		return json_decode($this->cache->get());
	}
}

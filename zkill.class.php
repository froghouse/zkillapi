<?php
namespace zKillAPI;

require('cache.class.php');
require('zkillapiurlbuilder.class.php');

// Just makes the call to update the cache and then provides an interface to the cache
class zKill
{
	public static $corpID;
	public static $allianceID;
	
	private $cache;
	
	public function __construct($corpID, $allianceID)
	{
		self::$corpID = $corpID;
		self::$allianceID = $allianceID;
		
		$url = new zKillAPIURLBuilder(new zKillAPIFetchType(zKillAPIFetchType::Kills));
		$url->add(new zKillAPIFetchModifiers(zKillAPIFetchModifiers::CorporationID, self::$corpID));
		$this->cache = new Cache($url->get(), "zKill.json");
		$this->cache->update();
	}
	
	public function get()
	{
		return json_decode($this->cache->get());
	}
}

<?php
require('zkill.class.php');

namespace zKillAPI;

class KillMail
{
	private $kill;
	
	public function __construct($kill)
	{
		$this->kill = $kill;
	}
	
	public function getKillDate()
	{
		return $this->kill->killTime;
	}
	
	public function getKillMailURL()
	{
		$url = new URLBuilder("https", "zkillboard.com", array("kill", $this->kill->killID));
		return $url->get();
	}
	
	public function getVictimName()
	{
		return $this->kill->victim->characterName;
	}
	
	public function getVictimCorpID()
	{
		return $this->kill->victim->corporationID;
	}
	
	public function getVictimCorpName()
	{
		return $this->kill->victim->corporationName;
	}
	
	public function getVictimShipID()
	{
		return $this->kill->victim->shipTypeID;
	}
	
	public function getKillerName()
	{
		return $this->getFinalBlow()->characterName;
	}
	
	public function getKillerCorpID()
	{
		return $this->getFinalBlow()->corporationID;
	}
	
	public function getKillerCorpName()
	{
		return $this->getFinalBlow()->corporationName;
	}
	
	public function getKillerAllianceID()
	{
		return $this->getFinalBlow()->allianceID;
	}
	
	public function getKillerShipID()
	{
		return $this->getFinalBlow()->shipTypeID;
	}
	
	public function getShipImageClass($victim)
	{
		if($victim)
			return "victim_ship";
		else
			return "attacker_ship";
	}

	public function getShipImage($victim)
	{
		$shipID = 0;
		
		if($victim)
			$shipID = $this->getVictimShipID();
		else
			$shipID = $this->getKillerShipID();
		
		$url = new URLBuilder("https", "image.eveonline.com", array("Type", $shipID . "_64.png"));
		return "<img src=\"" . $url->get() . "\" class=\"" . $this->getShipImageClass($victim) . "\">";
	}
	
	private function getFinalBlow()
	{
		$final = null;
		
		foreach($this->kill->attackers as $attacker)
		{
			if($attacker->finalBlow == 1)
				$final = $attacker;
		}
		
		return $final;
	}
}

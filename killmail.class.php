<?php
namespace zKillAPI;

require('zkill.class.php');

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
	
	public function getVictimShipImage()
	{
		return $this->getShipImage(true);
	}
	
	public function getKillerShipImage()
	{
		return $this->getShipImage(false);
	}
	
	public function isPlayerKill()
	{
		if(strlen($this->getVictimName()))
			return true;
		
		return false;
	}
	
	private function getFinalBlow()
	{
		foreach($this->kill->attackers as $attacker)
		{
			if($attacker->finalBlow == 1)
				return $attacker;
		}
		
		return null;
	}
}

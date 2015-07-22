<?php

namespace zKillAPI;

// Patches URLs together and makes sure they are well formatted
class URLBuilder
{
	protected $proto;
	protected $url;
	protected $path;
	
	public function __construct($pr, $ur, $pa = [])
	{
		$this->proto = $pr;
		$this->url = $ur;
		$this->path = $pa;
	}
	
	protected function buildPath()
	{
		$ret = "";
		
		if(is_array($this->path))
		{
			foreach($this->path as $pth)
			{
				$ret .= "/" . $pth;
			}
		}
		else
		{
			$ret .= "/" . $this->path;
		}
		
		return $ret;
	}
	
	public function get()
	{
		return $this->proto . "://" . $this->url . $this->buildPath();
	}
}

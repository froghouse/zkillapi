<?php

namespace zKillAPI;

class URLBuilder
{
	private $proto;
	private $url;
	private $path;
	
	public function __construct($pr, $ur, $pa = array())
	{
		$this->proto = $pr;
		$this->url = $ur;
		$this->path = $pa;
	}
	
	private function buildPath()
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

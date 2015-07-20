<?php
require('file.class.php');

namespace zKillAPI;

class Cache
{
	private $cache;
	private $fetch;
	private $nextrun;
	private static $next;
	
	public function __construct($fetch, $cache)
	{
		$opts = array(
		  'ssl'=>array(
			'method'=>"GET",
			'header'=>"User-Agent: <your info here>\r\nAccept-Encoding: gzip"
		  )
		);
		
		self::$next = "next_run";
		
		$this->fetch = new RemoteFile($fetch, $opts);
		$this->cache = new File($cache);
		$this->nextrun = new File(self::$next);
	}
	
	private function getNextRun()
	{
		return $this->nextrun->get();
	}
	
	private function setNextRun($nr)
	{
		$this->nextrun->set($nr);
	}
	
	public function update()
	{
		if(($this->getNextRun() - time()) < 0)
		{
			$this->cache->set($this->fetch->get());
			$this->setNextRun(strtotime($this->fetch->headers()['Expires']));
		}
	}
	
	public function get()
	{
		return $this->cache->get();
	}
}

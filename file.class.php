namespace zKillAPI;

class File
{
	protected $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function get()
	{
		return file_get_contents($this->name);
	}
	
	public function set($data)
	{
		return file_put_contents($this->name, $data);
	}
}

class RemoteFile extends File
{
	private $context;
	private $headers;
	
	public function __construct($name, $ctx)
	{
		parent::__construct($name);
		$this->context = stream_context_create($ctx);
		$this->headers = null;
	}
	
	public function get()
	{
		$resp = file_get_contents($this->name, false, $this->context);
		$this->headers = $http_response_header;
		
		return $resp;
	}
	
	public function headers()
	{
		return $this->parseHeaders();
	}
	
	private function parseHeaders()
	{
		$head = array();
		foreach( $this->headers as $k=>$v )
		{
			$t = explode( ':', $v, 2 );
			if( isset( $t[1] ) )
				$head[ trim($t[0]) ] = trim( $t[1] );
			else
			{
				$head[] = $v;
				if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
					$head['reponse_code'] = intval($out[1]);
			}
		}
		return $head;
	}
}

<?php

require_once('external.php');

class Jquery extends External
{
	
	// Version spéciales avec noms spécifiques
	// Version du CDN => version sur http://code.jquery.com/jquery/
	private $_toChange = array('1.3.0' => '1.3',
														 '1.4.0' => '1.4',
														 '1.5.0' => '1.5',
														 '1.6.0' => '1.6',
														 '1.7' 	 => '1.7.0',
														 );

  public function __construct($version)
  {
    $this->version = $version;
    $this->file = '/libs/jquery/'.$this->version.'/jquery.min.js';
    $this->url_pattern = 'http://code.jquery.com/jquery-%s.min.js';
  }	

	public function get()
	{
		// On teste si on redirige une version spéciale
		if (array_key_exists($this->version, $this->_toChange))
		{
			$url = sprintf($this->url_pattern, $this->_toChange[$this->version]);
		}
		else
		{
			$url = sprintf($this->url_pattern, $this->version);
		}

		parent::download($url);
	}
	
}

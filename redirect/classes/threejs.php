<?php

require_once('external.php');

class Threejs extends External
{

	// Version spéciales avec noms spécifiques
	// Version du CDN => version sur http://code.jquery.com/jquery/
	private $_toChange = array();
	
  public function __construct($version)
  {
    $this->version = $version;
    $this->file = '/libs/three.js/'.$this->version.'/three.min.js';
    $this->url_pattern = 'http://cdnjs.cloudflare.com/ajax/libs/three.js/%s/three.min.js';
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
		
		//echo $url; die();

		parent::download($url);
	}
	
}

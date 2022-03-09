<?php

require_once('external.php');

class Webfont extends External
{
	
	// Version spéciales avec noms spécifiques
	// Version du CDN => version sur google inutile ici
	private $_toChange = array();

  public function __construct($version)
  {
    $this->version = $version;
    $this->file = '/libs/webfont/'.$this->version.'/webfont.js';
    $this->url_pattern = 'http://ajax.googleapis.com/ajax/libs/webfont/%s/webfont.js';
  }	

	public function get()
	{
		$url = sprintf($this->url_pattern, $this->version);

		parent::download($url);
	}
	
}

<?php

require_once('external.php');

class Extcore extends External
{
	
	// Version spéciales avec noms spécifiques
	// Version du CDN => version sur google inutile ici
	private $_toChange = array();

  public function __construct($version)
  {
    $this->version = $version;
    $this->file = '/libs/ext-core/'.$this->version.'/ext-core.js';
    $this->url_pattern = 'http://ajax.googleapis.com/ajax/libs/ext-core/%s/ext-core.js';
  }	

	public function get()
	{
		$url = sprintf($this->url_pattern, $this->version);

		parent::download($url);
	}
	
}

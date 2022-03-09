<?php

require_once('external.php');

class Scriptaculous extends External
{
	
	// Version spéciales avec noms spécifiques
	// Version du CDN => version sur google inutile ici
	private $_toChange = array();

  public function __construct($version)
  {
    $this->version = $version;
    $this->file = '/libs/scriptaculous/'.$this->version.'/scriptaculous.js';
    $this->url_pattern = 'http://ajax.googleapis.com/ajax/libs/scriptaculous/%s/scriptaculous.js';
  }	

	public function get()
	{
		$url = sprintf($this->url_pattern, $this->version);

		parent::download($url);
	}
	
}

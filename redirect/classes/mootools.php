<?php

require_once('external.php');

class Mootools extends External
{
	
	// Version spéciales avec noms spécifiques
	// Version du CDN => version sur google inutile ici
	private $_toChange = array();

  public function __construct($version)
  {
    $this->version = $version;
    $this->file = '/libs/mootools/'.$this->version.'/mootools-yui-compressed.js';
    $this->url_pattern = 'http://ajax.googleapis.com/ajax/libs/mootools/%s/mootools-yui-compressed.js';
  }	

	public function get()
	{
		$url = sprintf($this->url_pattern, $this->version);

		parent::download($url);
	}
	
}

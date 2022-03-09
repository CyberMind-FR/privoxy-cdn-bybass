<?php

class External
{
	public $path;

	public $file;
	
	public $version;
	
	public $url_pattern;

	public function getFilename()
	{
		return str_replace('/classes', '', dirname(__FILE__)).$this->file;
	}
	
  /**
   * Télécharge et stocke un fichier distant en se faisant passer pour un navigateur
   *
   * @access public
   * @param string
   * @return void
   */
  public function download($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

    $result = curl_exec($ch);
    $headers = curl_getinfo($ch);

    $error_number = curl_errno($ch);
    $error_message = curl_error($ch);

    curl_close($ch);

		$filename = $this->getFilename();
		
		$folder = dirname($filename);

    // Création du dossier de stockage si ce dernier est absent
    if (!is_dir($folder))
    {
			@mkdir($folder, 0755, true);
    }

		$f = fopen($filename,'wb');
		fwrite($f, $result, strlen($result));
		fclose($f);

  }
  
}

<?php

class Library_View {
	
	private $header,
		$footer,
		$debugMessages = array();
	
	
	public function __construct() {
		$this->setHeader('header.php');
		$this->setFooter('footer.php');
	}
	
	
	
	/**
	 * Ruft die View auf, welche das Gerüst der Website beinhaltet.
	 * 
	 * Wenn der Parameter <i>"noInclude"</i> mit <i>true</i> angegeben wird,
	 * so werden header.php und footer.php nicht mit geladen.
	 * 
	 * @param string $name
	 * @param boolean $noInclude
	 * @return boolean
	 */
	public function renderView($name, $global = true) {
		$paths = array(
			'header' => $this->header,
			'content' => ROOT . 'app' . DS . 'view' . DS . $name . '.php',
			'footer' => $this->footer
		);
		if ($global) {
			foreach ($paths as $key => $value) {
				if (file_exists($value)) {
					require_once $value;
				} else {
					$this->debugMessages[] = 'ERROR: Das ' . $key . '-Template ist nicht vorhanden. (Path = ' . $value . ')';
				}
			}
		} else {
			require_once $paths['content'];
		}
	}
	
	
	
	/**
	 * Liefert den HTML-Tag, welcher die angegebene Javascript-Datei einbindet.
	 * 
	 * @param string $fn
	 * @return string
	 */
	public function getJsInclude($fn) {
		$path = DS . 'public' . DS . 'js' . DS . $fn . '.js';
		
		if (file_exists(ROOT . $path)) {
			return '<script src="' . $path . '"></script>';
		} else {
			$this->debugMessage[] = 'ERROR: Datei konnte nicht geladen werden. (Path = ' . $path . ')';
			return '';
		}
	}
	
	
	
	/**
	 * Liefert den HTML-Tag, welcher die angegebene CSS-Datei einbindet.
	 * 
	 * @param string $fn
	 * @param string $media
	 * @return string
	 */
	public function getCssInclude($fn, $media = 'all') {
		$path = DS . 'public' . DS . 'css' . DS . $fn . '.css';
		
		if (file_exists(ROOT . $path)) {
			return '<link type="text/css" rel="Stylesheet" media="' . $media . '" href="' . $path . '" />';
		} else {
			$this->debugMessage[] = 'ERROR: Datei konnte nicht geladen werden. (Path = ' . $path . ')';
			return '';
		}
	}
	
	
	
	/**
	 * Setzt die Header Variable.
	 * 
	 * @param string $path
	 * @return boolean
	 */
	public function setHeader($path) {
		$path = ROOT . 'app' . DS . 'view' . DS . $path;
		if (file_exists($path)) {
			$this->header = $path;
			return true;
		} else {
			$this->debugMessage[] = 'ERROR: Datei konnte nicht geladen werden. (Path = ' . $path . ')';
			return false;
		}
	}
	
	
	
	/**
	 * Setzt die Footer Variable
	 * 
	 * @param string $path
	 * @return boolean
	 */
	public function setFooter($path) {
		$path = ROOT . 'app' . DS . 'view' . DS . $path;
		if (file_exists($path)) {
			$this->footer = $path;
			return true;
		} else {
			$this->debugMessage[] = 'ERROR: Datei konnte nicht geladen werden. (Path = ' . $path . ')';
			return false;
		}
	}
	
	
	public function getDebugLog() {
		$return = '<div id="debugLog">';
		foreach ($this->debugMessages as $mes) {
			$return .= '>> ' . $mes . '<br />';
		}
		$return .= '</div>';
		return $return;
	}
}

?>
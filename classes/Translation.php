<?php

/* Neue Übersetzungsinstanz erstellen */
$t = new Translation();

/* Aktuell ausgewählte Sprache soll der URL-Parameter 'lang' (...?lang=de) sein */
$t->setCurrentLanguage($_GET['lang']);
/* Standardsprache festlegen */
$t->setDefaultLanguage("en");

/* Ein Array für jede Sprache anlegen */
$deutsch = array(
	"langCode"=>"de",
	"pageDoesNotExist"=>"Seite nicht gefunden.",

	"dieFreieSeekarte"=>"die freie Seekarte",

	/* Menu */
	"Seekarte"=>"Seekarte",
	"Vollbild"=>"Vollbild",
	"VollbildAnzeigen"=>"Karte im Vollbild anzeigen",
	"SeaChart"=>"Seekarte (Vollbild)",
	"ÜberOpenSeaMap"=>"Über OpenSeaMap",
	"Impressum"=>"Impressum",
	"Startseite"=>"Startseite",
	"ÄhnlicheProjekte"=>"Ähnliche Projekte",
	"SomeRights"=>"Diese Seite ist unter der Lizenz Creative Commons Attribution-ShareAlike 2.0 verfügbar.",
	
	/* Urls */
	"UrlOSM"=>"http://openstreetmap.de",
	"UrlOSMWiki_Hauptseite"=>"http://wiki.openstreetmap.org/wiki/Hauptseite",
	"UrlOSMWiki_OpenSeaMap"=>"http://wiki.openstreetmap.org/wiki/DE:OpenSeaMap",

	/* Legende */
	"Hafen"=>"Hafen",
	"Seezeichen"=>"Seezeichen",
	"Leuchtfeuer"=>"Leuchtfeuer",
	"BrückenSchleusen"=>"Brücken/Schleusen",

);

$englisch = array(
	"langCode"=>"en",
	"pageDoesNotExist"=>"Page not found.",

	"dieFreieSeekarte"=>"the free Seamap",

	/* Menu */
	"Seekarte"=>"Seamap",
	"Vollbild"=>"Fullscreen",
	"VollbildAnzeigen"=>"Show Fullscreen",
	"SeaChart"=>"Sea Chart (Full Screen)",
	"ÜberOpenSeaMap"=>"About OpenSeaMap",
	"Impressum"=>"Legal",
	"Startseite"=>"Main Page",
	"ÄhnlicheProjekte"=>"Similiar Projects",
	"SomeRights"=>"This work is licensed under the Creative Commons Attribution-ShareAlike 2.0 License",

	/* Urls */
	"UrlOSM"=>"http://openstreetmap.org",
	"UrlOSMWiki_Hauptseite"=>"http://wiki.openstreetmap.org/wiki/Main_Page",
	"UrlOSMWiki_OpenSeaMap"=>"http://wiki.openstreetmap.org/wiki/OpenSeaMap",

	/* Legende */
	"Legende"=>"Legend",
	"Hafen"=>"Harbour",
	"Seezeichen"=>"Seamarks",
	"Leuchtfeuer"=>"Lights",
	"BrückenSchleusen"=>"Bridges/Schleusen",
);

/* Die Sprachen hinzufügen */

$t->addLanguage("de",$deutsch,"Deutsch");
$t->addLanguage("en",$englisch,"English");



class Translation {

	var $languages = array();
	var $defaultLanguage;
	var $currentLanguage;
	var $preferredLanguage;
	var $languageNames = array();

	function Translation() {

	}
	/*
	 * $name - Die Id mit der die Sprache angesprochen wird (z.B. im URL-Parameter)
	 * $table - Das Array mit den eigentlichen Übersetzungen
	 * $fullname (optional) - Ausgeschriebener Name der Sprache (z.B. für die Anzeige)
	 */
	function addLanguage($name,$table,$fullname = "") {
		$this->languages[$name] = $table;
		$this->languageNames[$name] = $fullname == "" ? $name : $fullname;
	}
	function setDefaultLanguage($name) {
		$this->defaultLanguage = $name;
	}
	function tr($entry,$language = "") {
		// Wenn language nicht gesetzt ist, die aktuell gesetzte Sprache benutzen
		if ($language == "")
			$language = $this->getCurrentLanguage();
		$text = $this->languages[$language][$entry];
		// Wenn kein Text gefunden wurde, als Fallback die Standardsprache probieren
		if (!isset($text) && $language != $this->defaultLanguage) {
			$text = $this->languages[$this->defaultLanguage][$entry];
		}
		return $text;
	}
	function pr($entry,$language = "") {
		echo $this->tr($entry,$language);
	}
	// Aktuelle genutzte Sprache
	function setCurrentLanguage($name) {
		$this->currentLanguage = $name;
	}
	function getCurrentLanguage() {
		// Aktuelle Sprache ist entweder die manuell gesetzte oder die als bevorzugt gesetzte
		return $this->currentLanguage != "" ? $this->currentLanguage : $this->getPreferredLanguage();
	}
	// Bevorzugte Sprache
	function setPreferredLanguage($name) {
		$this->preferredLanguage = $name;
	}
	function getPreferredLanguage() {
		if ($this->preferredLanguage == "") {
			return $this->getHttpPreferredLanguage();
		}
		return $this->preferredLanguage;
	}
	/* 
	 * Erstellt eine ungeordnete Liste der Sprachlinks
	 */
	function makeLanguageLinks($link) {
		$text = '<ul>'."\n";
		foreach ($this->languageNames as $key => $value) {
			$text .= '<li><a href="'.$link.'lang='.$key.'" '.($this->getCurrentLanguage() == $key ? "class=\"currentLanguage\"" : "").'>'.$value.'</a></li>'."\n";
		}
		$text .= '</ul>'."\n";
		return $text;
	}
	/*
	 * Parsed die vom Browser gesendeten bevorzugten Sprachen und gibt sie als Array mit Gewichtigkeit zurück
	 */
	function getHttpPreferredLanguages() {
		$list = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$preferredLanguages = array();
		$array = explode(",",$list);
		foreach ($array as $key => $value) {
			$split = explode(";",$value);
			$langcode = $split[0];
			$temp = explode("=",$split[1]);
			$quality = $temp[1] != "" ? $temp[1] : 1;

			$langcodeArray = explode("-",$langcode);
			$langcodeLanguage = $langcodeArray[0];
			$langcodeCountry = $langcodeArray[1];
			$preferredLanguages[] = array(
				"language"=>$langcodeLanguage,
				"country"=>$langcodeCountry,
				"quality"=>(float)$quality
			);

		}
		return $preferredLanguages;
	}
	/*
	 * Gibt die letzte bevorzugte Sprache mit der höchsten Gewichtigkeit zurück
	 */
	function getHttpPreferredLanguage() {
		$languages = $this->getHttpPreferredLanguages();
		$quality = 0;
		$code = "";
		foreach ($languages as $key => $value) {
			if ($value['quality'] > $quality) {
				$quality = $value['quality'];
				$code = $value['language'];
			}
		}
		return $code;
	}
}



?>

<?php
#
# Resource.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 11.05.2008, Bunyamin Demir
#
# Resource Module
#
# Release Notes:
#

require_once 'ModSecDirective.class.php';

class Resource extends ModSecDirective {
  public $sub_menu  = array();

  public $contents;
  
  public function Resource() {
    parent::DataBaseAccessorClient();
  }
  
  public function create_sub_menu($menu) {
    //$menu = 'webekci';
    $sub_menu_file = 'resource/menu.en';
    $fh   = fopen($sub_menu_file, 'r');

    while (!feof($fh)) {
      $this->contents = fgets($fh,1024);
      
      $pattern ="_MENU_(".$menu.")_(\d)(\t+)(.+)\:(.+)";

      if(preg_match("/$pattern/", $this->contents, $matches)) {
	$this->sub_menu["$matches[4]"]  = $matches[5];
      }
    }

    return $this->sub_menu;
  }


  public static function getModSecurityDirectives() {
    $directive = new Resource();
    return $directive->dbh->getModSecDirectives();
  }

  public function enum($enums) {

    $RS       = array();
    $resource = $this->load_file('filter.en');

    foreach ($enums as $param) {
      foreach ($resource as $key => $value) {
	if (preg_match("/$param/",$key)) {
	  
	  $RS[$param][] = $value;
	  
	}
      }
    }
    return $RS;
  }

  public function load_file($file) {

    if ($read_file=fopen("resource/$file" , "r")) {
      
      $i=0;
      while (!feof($read_file)) {
	$line = fgets($read_file);
	
	if (preg_match("/^\#/",$line)) {
	  next;
	}
	
	preg_replace('/\r|\n/','',$line);
	
	if (!$line) { next; }
	
	preg_match("/^(\w+)\s+(.+)$/",$line,$arr);
	$RS["$arr[1]"] = $arr[2];
      }
      
      fclose($read_file);
    }
    return $RS;
  }
  
}

?>

<?
#
# Template.class.php
# $Id: $
#
# Copyright ..........
# OWSP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 07.05.2008, Bunyamin Demir
#
# Template Module
#
# Release Notes:
#

require_once("Smarty.class.php");

class Template extends Smarty{
  
  public function create_page() {
    $this->Smarty();
    
    $this->template_dir = 'templates';
    $this->compile_dir  = 'templates_c';
    $this->config_dir   = 'configs';
    $this->cache_dir    = 'cache';
    
    //$this->caching  = true;
    $this->security = true;
    //$this->force_compile = false;
  }
}

?>

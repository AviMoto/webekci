<?php
#
# webekci_manage.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 08.05.2008, Bunyamin Demir
#
# Webekci Manage Interface
#
# Release Notes:
#

require_once("lib/DB.class.php");
require_once("lib/Template.class.php");

$tmp = new Template();

$pages = array ('wbmng'  => 'wb_manage.tpl',
		'dbmng'  => 'db_manage.tpl',
		'cnfmng' => 'conf_manage.tpl',
		'inf'    => 'inf_manage.tpl');	 

$_GET['tab'] ? $sub_menu=$_GET['tab'] : $sub_menu='wbmng';
$_GET['c']   ? $c=$_GET['c'] : $c=0;
$_GET['cmd'] ? $cmd=$_GET['cmd'] : $cmd='';

$rs = new Resource();
$sub_menus   = $rs->create_sub_menu('webekci');
$count_menus = count($sub_menus);

$rs = new Resource();

$RS=$rs->enum(array('LIST_MANAGEMENT_TYPE'));

$db     = new DBConnection();

$tmp->assign('sub_menus',$sub_menus);
$tmp->assign('select_menu',$c);
$tmp->assign('count_menus',$count_menus);

# --------------------------------------------------------------------------

switch ($sub_menu) {
 case "wbmng":
   if ($cmd  == 'dadd') {
     domain_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setDomainValidity($_GET['id'],$_GET['v']);
     domain_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'dinst') {
     domain_insert($_POST,$db);
     domain_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'dedit') {
     domain_edit($_POST,$db);
     domain_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'ddeleted') {
     domain_deleted($_GET['id'],$db);
     domain_list($tmp, $pages[$sub_menu]);
   }
   else {
     wb_manage($tmp, $pages[$sub_menu], $TABLE);
   }
   break;
   
 case "dbmng":
   db_manage($tmp, $pages[$sub_menu], $TABLE);
   break;
}

# --------------------------------------------------------------------------

function wb_manage($tmp, $page, $TABLE) {
  global $RS;

  $manage[] = array_values($RS['LIST_MANAGEMENT_TYPE']);

  $manages = array_shift($manage);

  $mchoise= null;

  if ($_POST['mchoise']) {
    $mchoise = $_POST['mchoise'];
  }

  $db      = new DBConnection();

  if ($mchoise) {
    $db->addManagements($mchoise);
  }

  $mvalues = $db->getAllManagements();
  if ($mvalues) {
    $mkeys   = array_keys($mvalues);
  }

  foreach ($manages as $key => $value) {
    if ($key) {
      if ($mkeys) {
	if(in_array($key,$mkeys)) {
	  $checked[] = $key;
	}
      }

      $mvalues[$key] ? $m=$mvalues[$key] : $m='0000-00-00 00:00:00';
      
      $checkbox[$key] = "<b>$value</b> (<i>$m</i>)";
    }
  }

  $file="webekci_conf";

  if (is_dir("$file")) {

    //chown($file, 'apache');
    //chgrp($file, 'apache');
    deleteDirectory("$file"); 
    mkdir("$file");

    //    if(is_array($mvalues)) {
      $mkeys   = array_keys($mvalues);
      foreach ($mkeys as $m) {
	if ($m == 1) {
	  mkdir("$file/virtualhosts");

	  $domains_a = &Domain::getAllDomains();
	  $domains   = array();

	  foreach ($domains_a as $domain) {
	    $vhost_file_name = $domain->getServerName();

	    $vhost_info = null;

	    $vhost_file = fopen("$file/virtualhosts/$vhost_file_name", "w+");
	  
	    
	    if ($domain->getServerIP() && $domain->getServerPort() && $domain->getServerName()) {
	      $vhost_info .= '<VirtualHost '.$domain->getServerIP().':'.
		 $domain->getServerPort().'>'."\n";

	      $vhost_info .= 'ServerName '.$domain->getServerName()."\n";

	      if ($domain->getAlias()) {
		$vhost_info .= 'ServerAlias '.$domain->getAlias()."\n";
	      }

	      if ($domain->getServerAdmin()) {
		$vhost_info .= 'ServerAdmin '.$domain->getServerIP()."\n";
	      }
	      
	      $vhost_info .= $domain->getOther()."\n";
	      
	      if ($domain->getModSecConf()) {
		$vhost_info .= 'Include ../modsecurityconfs/'.$domain->getModSecConfName().".conf\n";
	      }

	      $vhost_info .= '</VirtualHost>'."\n";

	      fwrite($vhost_file, $vhost_info);
	    }
	    
	    fclose($vhost_file);
	  }
	}
	if ($m == 2) {
	  mkdir("$file/modsecurityconfs");
	}
	if ($m == 3) {
	  mkdir("$file/rules");
	}
	if ($m == 4) {
	  mkdir("$file/whitelists");
	}
	
      }
    }
  //    }
    else {
      print "no dir (webekci_conf)";
    }
    

  $tmp->assign('wb_list'    ,$checkbox);
  $tmp->assign('selected_wb',$checked);
  $tmp->assign('tab_page'   ,$page);
}

# --------------------------------------------------------------------------

function deleteDirectory($dir) {
  if (!file_exists($dir)) return true;
  if (!is_dir($dir) || is_link($dir)) return unlink($dir);
  foreach (scandir($dir) as $item) {
    if ($item == '.' || $item == '..') continue;
    if (!deleteDirectory($dir . "/" . $item)) {
      chmod($dir . "/" . $item, 0777);
      if (!deleteDirectory($dir . "/" . $item)) return false;
    };
  }
  return rmdir($dir);
}

# --------------------------------------------------------------------------

function db_manage($tmp, $page, $TABLE) {

  $select_table= null;

  if ($_POST['tables']) {
    $select_table = $_POST['tables'];
  }

  $db     = new DBConnection();
  $tables = $db->DbTableList($select_table);

  foreach ($TABLE as $key => $value) {
    $count_table = 0;
    
    if(in_array($key,$tables)) {
      $count_table = $db->CountTableRows('*',$key); 
      $checked[] = $key;
    }

    $checkbox[$key] = "$key ($count_table)";
  }
 
  $tmp->assign('db_list'    ,$checkbox);
  $tmp->assign('selected_db',$checked);
  $tmp->assign('tab_page'   ,$page);
}

# --------------------------------------------------------------------------

$tmp->display('webekci_manage.tpl');

?>
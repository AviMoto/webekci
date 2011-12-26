<?php
#
# logs.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 11.05.2008, Bunyamin Demir
#
# Logs Interface
#
# Release Notes:
#

$pages = array ( 'glog' => 'guardian_log.tpl',
		 'elog' => 'error_log.tpl',
		 'alog' => 'audit_log.tpl',
		 'lmng' => 'log_management.tpl');

require_once("lib/Template.class.php");

$tmp = new Template();

$_GET['tab'] ? $sub_menu=$_GET['tab'] : $sub_menu='audit';
$_GET['c']   ? $c=$_GET['c'] : $c=0;
$_GET['cmd'] ? $cmd=$_GET['cmd'] : $cmd='';

$rs = new Resource();
$sub_menus   = $rs->create_sub_menu('logs');
$count_menus = count($sub_menus);

//print $sub_menus[$_GET['page']];

$tmp->assign('sub_menus',$sub_menus);
$tmp->assign('select_menu',$c);
$tmp->assign('count_menus',$count_menus);
$tmp->assign('tab_page',$pages[$_GET['tab']]);

print $firstname = $_POST['firstname'];
print $lastname  = $_POST['lastname'];
print $email     = $_POST['email'];
print $sex       = $_POST['sex'];

$tmp->display('logs.tpl');
	  
?>
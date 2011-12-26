<?php
#
# index.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 08.05.2008, Bunyamin Demir
#
# Index page
#
# Release Notes:
##

#set_include_path("../../usr/share/pear/"); 


$path ='/php/bin/php';
#set_include_path(get_include_path() . PATH_SEPARATOR . $path);
#phpinfo();
require_once("lib/DB.class.php");
require_once("lib/Report.class.php");
require_once("lib/Template.class.php");
require_once("lib/Resource.class.php");

$tmp = new Template();
$db  = new DBConnection();
#$tmp->debugging = true;

$vhost       = $db->CountTableRows('DomainID'   ,'domain WHERE Deleted=0');
$modsec_conf = $db->CountTableRows('ConfID'     ,'modsec_conf WHERE Deleted=0');
$rules       = $db->CountTableRows('RecordID'   ,'rules WHERE Deleted=0');
$rule_files  = $db->CountTableRows('RuleFileID' ,'rule_files WHERE Deleted=0');
$rule_dfiles = $db->CountTableRows('DataFileID' ,'rule_data_files WHERE Deleted=0');
$rule_data   = $db->CountTableRows('RuleDataID' ,'rule_data WHERE Deleted=0');
$blocked_ip  = $db->CountTableRows('*'          ,'ip_block_list');

$dalert      = $db->countAllAuditLogs(' AND AL.AuditLogDate=CURDATE()');
$walert      = $db->countAllAuditLogs(' AND WEEK(AL.AuditLogDate,1)=WEEK(CURDATE(),1)');
$malert      = $db->countAllAuditLogs(' AND MONTH(AL.AuditLogDate)=MONTH(CURDATE())');

$tmp->assign('vhost'      ,$vhost);
$tmp->assign('modsec_conf',$modsec_conf);
$tmp->assign('rules'      ,$rules);
$tmp->assign('rule_files' ,$rule_files);
$tmp->assign('rule_dfiles',$rule_dfiles);
$tmp->assign('rule_data'  ,$rule_data);
$tmp->assign('dalert'     ,$dalert);
$tmp->assign('walert'     ,$walert);
$tmp->assign('malert'     ,$malert);
$tmp->assign('blocked_ip' ,$blocked_ip);

$tmp->display('index.tpl');
?>

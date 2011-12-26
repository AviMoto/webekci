<?php
#
# configurations.php
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
require_once("lib/Domain.class.php");
require_once("lib/Resource.class.php");
require_once("lib/ModSecConfiguration.class.php");

$tmp = new Template();

$pages = array ( 'dmns'  => 'domains.tpl',
		 'mscnf' => 'modsec_conf.tpl',
		 'dadd'  => 'domains_add.tpl',
		 'cadd'  => 'modsec_conf_add.tpl');
	 

$_GET['tab'] ? $sub_menu=$_GET['tab'] : $sub_menu='mscnf';
$_GET['c']   ? $c=$_GET['c'] : $c=0;
$_GET['cmd'] ? $cmd=$_GET['cmd'] : $cmd='';

$rs = new Resource();
$sub_menus   = $rs->create_sub_menu('conf');
$count_menus = count($sub_menus);

$tmp->assign('sub_menus',$sub_menus);
$tmp->assign('select_menu',$c);
$tmp->assign('count_menus',$count_menus);

$db  = new DBConnection();

# --------------------------------------------------------------------------

switch ($sub_menu) {
 case "dmns":
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
     domain_list($tmp, $pages[$sub_menu]);
   }
   break;
   
 case "mscnf":
   if ($cmd  == 'cadd') {
     modsec_conf_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setModSecConfValidity($_GET['id'],$_GET['v']);
     modsec_conf_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'cinst') {
     modsec_conf_insert($_POST,$db);
     modsec_conf_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'cedit') {
     modsec_conf_edit($_POST,$db);
     modsec_conf_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'cdeleted') {
     modsec_conf_deleted($_GET['id'],$db);
     modsec_conf_list($tmp, $pages[$sub_menu]);
   }
   else {
     modsec_conf_list($tmp, $pages[$sub_menu]);
   }
   break;
 case "inf":
   //  third tab
   break;
}

# --------------------------------------------------------------------------

function domain_list($tmp, $page) {
  $domains_a = &Domain::getAllDomains();
  $domains   = array();

  foreach ($domains_a as $domain) {
    $domains[] = array('id'       => $domain->getId(),
		       'dname'    => $domain->getName(),
		       'sname'    => $domain->getServerName(),
		       'sip'      => $domain->getServerIP(),
		       'sport'    => $domain->getServerPort(),
		       'sadmin'   => $domain->getServerAdmin(),
		       'salias'   => $domain->getAlias(),
		       'isactive' => $domain->isActive());
  }
  
  $tmp->assign( 'data', $domains);
  $tmp->assign('tab_page',$page);
}

# --------------------------------------------------------------------------

function domain_add($tmp, $page, $domainid='') {
  if ('' != $domainid ) {
    $domain = Domain::getDomainById($domainid);
  }
  else {
    $domain= new Domain();
  }

  $msec_conf_a  = &ModSecConfiguration::getAllModSecConfigurations();
  $msec_confs   = array();

  $msec_id[]   = 0;
  $msec_name[] = 'None';

  foreach ($msec_conf_a as $conf) {
    $msec_id[]   = $conf->getId();
    $msec_name[] = $conf->getName();
  }

  $tmp->assign(array('did'          => $domain->getId(),
		     'dname'        => $domain->getName(),
		     'sname'        => $domain->getServerName(),
		     'sip'          => $domain->getServerIP(),
		     'sport'        => $domain->getServerPort(),
		     'sadmin'       => $domain->getServerAdmin(),
		     'salias'       => $domain->getAlias(),
		     'other'        => $domain->getOther(),
		     'msec_id'      => $msec_id,
		     'msec_name'    => $msec_name,
		     'mod_sec_conf' => $domain->getModSecConf(),
		     'validity'     => $domain->isActive())
	       );
  
  $tmp->assign('tab_page',$page);
}

# --------------------------------------------------------------------------

function domain_insert($post,$db) {

  $new_domain = new Domain();
  $new_domain->setName($post['dname']);
  $new_domain->setServerName($post['sname']);
  $new_domain->setServerIP($post['sip']);
  $new_domain->setServerPort($post['sport']); 
  $new_domain->setServerAdmin($post['sadmin']);
  $new_domain->setAlias($post['salias']); 
  $new_domain->setOther($post['other']);
  $new_domain->setModSecConf($post['mod_sec_conf']);
  $new_domain->setActive($post['validity']);
  $new_domain->setFilled(true);
  
  $db->addDomain($new_domain);
}

# --------------------------------------------------------------------------

function domain_edit($post,$db) {
  // print $post['mod_sec_conf'];
  $domain = Domain::getDomainById($post['id']);
  $domain->setName($post['dname']);
  $domain->setServerName($post['sname']);
  $domain->setServerIP($post['sip']);
  $domain->setServerPort($post['sport']); 
  $domain->setServerAdmin($post['sadmin']);
  $domain->setAlias($post['salias']); 
  $domain->setOther($post['other']); 
  $domain->setModSecConf($post['mod_sec_conf']); 
  $domain->setActive($post['validity']);
  $domain->setFilled(true);
  
  $db->editDomain($domain);
}

# --------------------------------------------------------------------------

function domain_deleted($domainid,$db) {

  $db->deleteDomain($domainid);
}

# --------------------------------------------------------------------------

function modsec_conf_list($tmp, $page) {
  $msec_conf_a  = &ModSecConfiguration::getAllModSecConfigurations();
  $msec_confs   = array();

  foreach ($msec_conf_a as $conf) {
    $msec_confs[] = array('id'           => $conf->getId(),
			  'cname'        => $conf->getName(),
			  'cdescription' => substr($conf->getDescription(),0,70),
			  'isactive'     => $conf->isActive());
  }
  
  $tmp->assign( 'data', $msec_confs);
  $tmp->assign('tab_page',$page);
}

# --------------------------------------------------------------------------

function modsec_conf_add($tmp, $page, $msec_conf_id='') {
  if ('' != $msec_conf_id ) {
    $conf = ModSecConfiguration::getModSecConfById($msec_conf_id);
    //print_r($conf);
  }
  else {
    $conf= new ModSecConfiguration();
  }

  $directive = Resource::getModSecurityDirectives();
#print_r($argument_sperator = explode(",",$directive->getSecAuditLogType()));

  $tmp->assign(array('cid'                        => $conf->getId(),
		     'cname'                      => $conf->getName(),
		     'cdescription'               => $conf->getDescription(),
		     'validity'                   => $conf->isActive(),
		     'SecArgumentSperator'        => explode(",",$directive->getSecArgumentSperator()),
		     'arg_sperator'               => $conf->getSecArgumentSperator(),
		     'SecAuditEngine'             => explode(",",$directive->getSecAuditEngine()),
		     'audit_engine'               => $conf->getSecAuditEngine(),
		     //'SecAuditLogParts'           => explode(",",$directive->getSecAuditLogParts()),
		     //'audit_log_parts'            => explode(",",$conf->getSecAuditLogParts()),
		     'audit_log'                  => $conf->getSecAuditLog(),
		     //'audit_log2'                 => $conf->getSecAuditLog2(),
		     'alog_rstatus'               => ($conf->getSecAuditLogRelevantStatus()),
		     'alog_storegadir'            => $conf->getSecAuditLogStorageDir(),
		     //'SecAuditLogType'            => explode(",",$directive->getSecAuditLogType()),
		     //'audit_log_type'             => $conf->getSecAuditLogType(),
		     //'SecCacheTransformations'    => explode(",",$directive->getSecCacheTransformations()),
		     //'cache_transformations'      => $conf->getSecCacheTransformations(),
		     'chroot_dir'                 => $conf->getSecChrootDir(),
		     //'comp_signature'             => $conf->getSecChrootDir(),
		     'SecContentInjection'        => explode(",",$directive->getSecContentInjection()),
		     'content_injection'          => $conf->getSecContentInjection(),
		     'SecCookieFormat'            => explode(",",$directive->getSecCookieFormat()),
		     'cookie_format'              => $conf->getSecCookieFormat(),
		     'data_dir'                   => $conf->getSecDataDir(),
		     //'debug_log'                  => $conf->getSecDebugLog(),
		     //'SecDebugLogLevel'           => explode(",",$directive->getSecDebugLogLevel()),
		     //'debug_log_level'            => $conf->getSecDebugLogLevel(),
		     'guardian_log'               => $conf->getSecGuardianLog(),
		     'SecPdfProtect'              => explode(",",$directive->getSecPdfProtect()),
		     'pdf_protect'                => $conf->getSecPdfProtect(),
		     'SecPdfProtectMethod'        => explode(",",$directive->getSecPdfProtectMethod()),
		     'pdf_protect_method'         => $conf->getSecPdfProtectMethod(),
		     'SecPdfProtectTimeout'       => explode(",",$directive->getSecPdfProtectTimeout()),
		     'pdf_protect_timeout'        => $conf->getSecPdfProtectTimeout(),
		     //'SecRequestBodyAccess'       => explode(",",$directive->getSecRequestBodyAccess()),
		     //'req_body_access'            => $conf->getSecRequestBodyAccess(),
		     'req_body_limit'             => $conf->getSecRequestBodyLimit(),
		     'req_body_no_files_limit'    => $conf->getSecRequestBodyNoFilesLimit(),
		     'req_body_in_memo_limit'     => $conf->getSecRequestBodyInMemoryLimit(),
		     'resp_body_limit'            => $conf->getSecResponseBodyLimit(),
		     'SecResponseBodyLimitAction' => explode(",",$directive->getSecResponseBodyLimitAction()),
		     'resp_body_limit_action'     => $conf->getSecResponseBodyLimitAction(),
		     'SecResponseBodyMimeType'    => explode(",",$directive->getSecResponseBodyMimeType()),
		     'resp_body_mime_type'        => explode(",",$conf->getSecResponseBodyMimeType()),
		     //'SecResponseBodyAccess'      => explode(",",$directive->getSecResponseBodyAccess()),
		     //'resp_body_access'           => $conf->getSecResponseBodyAccess(),
		     'SecRuleInheritance'         => explode(",",$directive->getSecRuleInheritance()),
		     'rule_inheritance'           => $conf->getSecRuleInheritance(),
		     'SecRuleEngine'              => explode(",",$directive->getSecRuleEngine()),
		     'rule_engine'                => $conf->getSecRuleEngine(),
		     'tmp_dir'                    => $conf->getSecTmpDir(),
		     //'upload_dir'                 => $conf->getSecTmpDir(),
		     //'SecUploadKeepFiles'         => explode(",",$directive->getSecUploadKeepFiles()),
		     //'upload_keep_files'          => $conf->getSecUploadKeepFiles(),
		     'web_app_id'                 => $conf->getSecWebAppId(),
		     )
	       );


  $tmp->assign('tab_page',$page);
}

# --------------------------------------------------------------------------

function modsec_conf_insert($post,$db) {

  $conf = new ModSecConfiguration();
  $conf->setName($post['cname']);
  $conf->setDescription($post['cdescription']);
  $conf->setActive($post['validity']);

  $conf->setSecArgumentSperator($post['SecArgumentSperator']);
  $conf->setSecAuditEngine($post['SecAuditEngine']);
  //$conf->setSecAuditLogParts($post['SecAuditLogParts']);
  $conf->setSecAuditLog($post['audit_log']);
  //$conf->setSecAuditLog2($post['audit_log2']);
  $conf->setSecAuditLogRelevantStatus($post['alog_rstatus']);
  $conf->setSecAuditLogStorageDir($post['alog_storegadir']);
  //$conf->setSecAuditLogType($post['SecAuditLogType']);
  //$conf->setSecCacheTransformations($post['SecCacheTransformations']);
  $conf->setSecChrootDir($post['chroot_dir']);
  //$conf->setSecComponentSignature($post['comp_signature']);
  $conf->setSecContentInjection($post['SecContentInjection']);
  $conf->setSecCookieFormat($post['SecCookieFormat']);
  $conf->setSecDataDir($post['data_dir']);
  //$conf->setSecDebugLog($post['debug_log']);
  //$conf->setSecDebugLogLevel($post['SecDebugLogLevel']);
  $conf->setSecGuardianLog($post['guardian_log']);
  $conf->setSecPdfProtect($post['SecPdfProtect']);
  $conf->setSecPdfProtectMethod($post['SecPdfProtectMethod']);
  $conf->setSecPdfProtectTimeout($post['SecPdfProtectTimeout']);
  //$conf->setSecRequestBodyAccess($post['SecRequestBodyAccess']);
  $conf->setSecRequestBodyLimit($post['req_body_limit']);
  $conf->setSecRequestBodyNoFilesLimit($post['req_body_no_files_limit']);
  $conf->setSecRequestBodyInMemoryLimit($post['req_body_in_memo_limit']);
  $conf->setSecResponseBodyLimit($post['resp_body_limit']);
  $conf->setSecResponseBodyLimitAction($post['SecResponseBodyLimitAction']);
  $conf->setSecResponseBodyMimeType(implode(',',$post['SecResponseBodyMimeType']));
  //$conf->setSecResponseBodyAccess($post['SecResponseBodyAccess']);
  $conf->setSecRuleInheritance($post['SecRuleInheritance']);
  $conf->setSecRuleEngine($post['SecRuleEngine']);
  $conf->setSecTmpDir($post['tmp_dir']);
  //$conf->setSecUploadDir($post['upload_dir']);
  //$conf->setSecUploadKeepFiles($post['SecUploadKeepFiles']);
  $conf->setSecWebAppId($post['web_app_id']);
  $conf->setFilled(true);
  
  $db->addModSecConfiguration($conf);
}

# --------------------------------------------------------------------------

function modsec_conf_deleted($msec_conf_id,$db) {

  $db->deleteModSecConfiguration($msec_conf_id);
}

# --------------------------------------------------------------------------

function modsec_conf_edit($post,$db) {

  $conf = ModSecConfiguration::getModSecConfById($post['id']);
  $conf->setName($post['cname']);
  $conf->setDescription($post['cdescription']);
  $conf->setActive($post['validity']);
  $conf->setSecArgumentSperator($post['SecArgumentSperator']);
  $conf->setSecAuditEngine($post['SecAuditEngine']);
  //$conf->setSecAuditLogParts($post['SecAuditLogParts']);
  $conf->setSecAuditLog($post['audit_log']);
  //$conf->setSecAuditLog2($post['audit_log2']);
  $conf->setSecAuditLogRelevantStatus($post['alog_rstatus']);
  $conf->setSecAuditLogStorageDir($post['alog_storegadir']);
  //$conf->setSecAuditLogType($post['SecAuditLogType']);
  //$conf->setSecCacheTransformations($post['SecCacheTransformations']);
  $conf->setSecChrootDir($post['chroot_dir']);
  //$conf->setSecComponentSignature($post['comp_signature']);
  $conf->setSecContentInjection($post['SecContentInjection']);
  $conf->setSecCookieFormat($post['SecCookieFormat']);
  $conf->setSecDataDir($post['data_dir']);
  //$conf->setSecDebugLog($post['debug_log']);
  //$conf->setSecDebugLogLevel($post['SecDebugLogLevel']);
  $conf->setSecGuardianLog($post['guardian_log']);
  $conf->setSecPdfProtect($post['SecPdfProtect']);
  $conf->setSecPdfProtectMethod($post['SecPdfProtectMethod']);
  $conf->setSecPdfProtectTimeout($post['SecPdfProtectTimeout']);
  //$conf->setSecRequestBodyAccess($post['SecRequestBodyAccess']);
  $conf->setSecRequestBodyLimit($post['req_body_limit']);
  $conf->setSecRequestBodyNoFilesLimit($post['req_body_no_files_limit']);
  $conf->setSecRequestBodyInMemoryLimit($post['req_body_in_memo_limit']);
  $conf->setSecResponseBodyLimit($post['resp_body_limit']);
  $conf->setSecResponseBodyLimitAction($post['SecResponseBodyLimitAction']);
  $conf->setSecResponseBodyMimeType(implode(',',$post['SecResponseBodyMimeType']));
  //$conf->setSecResponseBodyAccess($post['SecResponseBodyAccess']);
  $conf->setSecRuleInheritance($post['SecRuleInheritance']);
  $conf->setSecRuleEngine($post['SecRuleEngine']);
  $conf->setSecTmpDir($post['tmp_dir']);
  //$conf->setSecUploadDir($post['upload_dir']);
  //$conf->setSecUploadKeepFiles($post['SecUploadKeepFiles']);
  $conf->setSecWebAppId($post['web_app_id']);
  $conf->setFilled(true);
  
  $db->editModSecConfiguration($conf);
}
# --------------------------------------------------------------------------


$tmp->display('configurations.tpl');

?>
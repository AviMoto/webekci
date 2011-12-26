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
require_once("lib/Rule.class.php");
require_once("lib/Domain.class.php");
require_once("lib/Resource.class.php");
require_once("lib/Navigation.class.php");
require_once("lib/ModSecConfiguration.class.php");

$tmp = new Template();

$pages = array ( 'rfile'    => 'rule_files.tpl',
		 'rf_add'   => 'rule_files_add.tpl',
		 'rule'     => 'rule.tpl',
		 'rule_add' => 'rule_add.tpl',
		 'rdfile'   => 'rule_data_files.tpl',
		 'rdf_add'  => 'rule_data_files_add.tpl',
		 'rdata'    => 'rule_data.tpl',
		 'rd_add'   => 'rule_data_add.tpl',
		 'wlist'    => 'white_list.tpl',
		 'wl_add'   => 'white_list_add.tpl');

$_GET['tab'] ? $sub_menu=$_GET['tab'] : $sub_menu='rfile';
$_GET['c']   ? $c=$_GET['c']          : $c=0;
$_GET['cmd'] ? $cmd=$_GET['cmd']      : $cmd='';

$rs = new Resource();
$sub_menus   = $rs->create_sub_menu('rule');
$count_menus = count($sub_menus);

$tmp->assign('sub_menus'  ,$sub_menus);
$tmp->assign('select_menu',$c);
$tmp->assign('count_menus',$count_menus);

$rs = new Resource();

$RS=$rs->enum(array('LIST_WHITE_LIST_TYPE'));

$db  = new DBConnection();

# --------------------------------------------------------------------------

switch ($sub_menu) {
 case "rfile":
   if ($cmd  == 'rf_add') {
     rule_file_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setRuleFileValidity($_GET['id'],$_GET['v']);
     rule_file_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rf_inst') {
     rule_file_insert($_POST,$db);
     rule_file_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rf_edit') {
     rule_file_edit($_POST,$db);
     rule_file_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rf_deleted') {
     rule_file_deleted($_GET['id'],$db);
     rule_file_list($tmp, $pages[$sub_menu]);
   }
   else {
     rule_file_list($tmp, $pages[$sub_menu]);
   }
   break;
   
 case "rule":
   if ($cmd  == 'rule_add') {
     rule_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setRuleValidity($_GET['id'],$_GET['v']);
     rule_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rule_inst') {
     rule_insert($_POST,$db);
     rule_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rule_edit') {
     rule_edit($_POST,$db);
     rule_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rule_deleted') {
     rule_deleted($_GET['id'],$db);
     rule_list($tmp, $pages[$sub_menu]);
   }
   else {
     rule_list($tmp, $pages[$sub_menu]);
   }
   break;

 case "rdfile":
   if ($cmd  == 'rdf_add') {
     rule_data_file_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setDataFileValidity($_GET['id'],$_GET['v']);
     rule_data_file_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rdf_inst') {
     rule_data_file_insert($_POST,$db);
     rule_data_file_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rdf_edit') {
     rule_data_file_edit($_POST,$db);
     rule_data_file_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rdf_deleted') {
     rule_data_file_deleted($_GET['id'],$db);
     rule_data_file_list($tmp, $pages[$sub_menu]);
   }
   else {
     rule_data_file_list($tmp, $pages[$sub_menu]);
   }
   break;

 case "rdata":
   if ($cmd  == 'rd_add') {
     rule_data_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setDataValidity($_GET['id'],$_GET['v']);
     rule_data_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rd_inst') {
     rule_data_insert($_POST,$db);
     rule_data_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rd_edit') {
     rule_data_edit($_POST,$db);
     rule_data_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'rd_deleted') {
     rule_data_deleted($_GET['id'],$db);
     rule_data_list($tmp, $pages[$sub_menu]);
   }
   else {
     rule_data_list($tmp, $pages[$sub_menu]);
   }
   break;

 case "wlist":
   if ($cmd  == 'wl_add') {
     white_list_add($tmp, $pages[$cmd],$_GET['id']);
   }
   elseif ($cmd  == 'validity') {
     $db->setWhiteListValidity($_GET['id'],$_GET['v']);
     white_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'wl_inst') {
     white_list_insert($_POST,$db);
     white_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'wl_edit') {
     white_list_edit($_POST,$db);
     white_list($tmp, $pages[$sub_menu]);
   }
   elseif ($cmd  == 'wl_deleted') {
     white_list_deleted($_GET['id'],$db);
     white_list($tmp, $pages[$sub_menu]);
   }
   else {
     white_list($tmp, $pages[$sub_menu]);
   }
   break;
}

# --------------------------------------------------------------------------

function rule_file_list($tmp, $page) {
  $rfiles_a = &Rule::getAllRuleFiles();
  $rule_files   = array();

  foreach ($rfiles_a as $rule_file) {
    $rule_files[] = array('rf_id'              => $rule_file->getRuleFileID(),
			  'rf_name'            => $rule_file->getRuleFileName(),
			  'rf_rule_count'      => $rule_file->getRuleFileRuleCount(),
			  'rf_data_file_count' => $rule_file->getRuleFileRuleDataFileCount(),
			  'rf_isactive'        => $rule_file->getRuleFileActive());
  }
  
  $tmp->assign( 'data'   , $rule_files);
  $tmp->assign('tab_page', $page);
}

# --------------------------------------------------------------------------

function rule_list($tmp, $page) {

  $rule_file_filter   = $_POST['rule_file_filter'];

  if ($rule_file_filter) { $where .= " AND R.RuleFileID=$rule_file_filter"; }

  $total_row = &Rule::countRulesRecord($where);

  $navigation = new Navigation($_POST['start'],$_POST['rows'],
			       $_POST['begin'],$_POST['first'],
			       $total_row);

  $start = $navigation->getNavigationStart();
  $rows  = $navigation->getNavigationRows();
  $begin = $navigation->getNavigationBegin();
  $first = $navigation->getNavigationFirst();

  $wlimit .= $navigation->getNavigationWhere();

  $rule_a  = &Rule::getAllRules($where,$wlimit);
  $rules   = array();

  foreach ($rule_a as $rule) {
    $rules[] = array('rule_rid'       => $rule->getRuleRecordID(),
		     'rule_id'        => $rule->getRuleID(),
		     'rule_msg'       => $rule->getRuleInformation(),
		     'rule'           => $rule->getRuleShort(),
		     'rule_default'   => $rule->getRuleDefaultValue(),
		     'rule_file'      => substr($rule->getRuleFileName(),0,25),
		     'rule_data_file' => $rule->getDataFileName(),
		     'rule_isactive'  => $rule->getRuleActive());
  }
  
  $rfiles_a   = &Rule::getAllRuleFiles();
  $rule_files = array();

  foreach ($rfiles_a as $rule_file) {
    $rule_files[] = array('rf_id'         => $rule_file->getRuleFileID(),
			  'rf_name'       => substr($rule_file->getRuleFileName(),0,25),
			  'rf_rule_count' => $rule_file->getRuleFileRuleCount());
  }

  $tmp->assign('rows'       , $rows);
  $tmp->assign('ceil'       , ceil($total_row/$rows));
  $tmp->assign('total_row'  , $total_row);
  $tmp->assign('begin'      , $begin);
  $tmp->assign('start'      , $start);

  $tmp->assign('rule_filter', $rule_files);
  $tmp->assign('rfile_id'   , $_POST['rule_file_filter']);
  $tmp->assign('data'       , $rules);
  $tmp->assign('tab_page'   , $page);
  $tmp->assign('tab'        , 'rule');
}

# --------------------------------------------------------------------------

function rule_data_list($tmp, $page) {

  $rule_dfile_filter   = $_POST['rule_dfile_filter'];

  if ($rule_dfile_filter) { $where .= " AND RD.DataFileID=$rule_dfile_filter"; }

  $total_row = &Rule::countRuleDatasRecord($where);

  $navigation = new Navigation($_POST['start'],$_POST['rows'],
			       $_POST['begin'],$_POST['first'],
			       $total_row);

  $start = $navigation->getNavigationStart();
  $rows  = $navigation->getNavigationRows();
  $begin = $navigation->getNavigationBegin();
  $first = $navigation->getNavigationFirst();

  $wlimit .= $navigation->getNavigationWhere();

  $rule_da  = &Rule::getAllRuleDatas($where,$wlimit);
  $rules    = array();

  foreach ($rule_da as $rule_data) {
    $rule_datas[] = array('rd_id'        => $rule_data->getRuleDataID(),
			  'rdf_id'       => $rule_data->getDataFileID(),
			  'rdf_name'     => $rule_data->getDataFileName(),
			  'rd_name'      => $rule_data->getRuleData(),
			  'rd_isactive'  => $rule_data->getRuleDataActive());
  }
  
  $rdfiles_a   = &Rule::getAllRuleDataFiles();
  $rule_dfiles = array();

  foreach ($rdfiles_a as $rule_dfile) {
    $rule_dfiles[] = array('rdf_id'         => $rule_dfile->getDataFileID(),
			   'rdf_name'       => substr($rule_dfile->getDataFileName(),0,25),
			   'rdf_rule_count' => $rule_dfile->getRuleDataCount());
  }

  $tmp->assign('rows'       , $rows);
  $tmp->assign('ceil'       , ceil($total_row/$rows));
  $tmp->assign('total_row'  , $total_row);
  $tmp->assign('begin'      , $begin);
  $tmp->assign('start'      , $start);

  $tmp->assign('rule_dfilter', $rule_dfiles);
  $tmp->assign('rdfile_id'   , $_POST['rule_dfile_filter']);
  $tmp->assign('data'        , $rule_datas);
  $tmp->assign('tab_page'    , $page);
  $tmp->assign('tab'         , 'rdata');
}

# --------------------------------------------------------------------------

function white_list($tmp, $page) {
  global $RS;

  $wlist_filter   = $_POST['wlist_filter'];

  if ($wlist_filter) { $where .= " AND WL.WhiteListType=$wlist_filter"; }

  $total_row = &Rule::countWhiteListRecord($where);

  $navigation = new Navigation($_POST['start'],$_POST['rows'],
			       $_POST['begin'],$_POST['first'],
			       $total_row);

  $start = $navigation->getNavigationStart();
  $rows  = $navigation->getNavigationRows();
  $begin = $navigation->getNavigationBegin();
  $first = $navigation->getNavigationFirst();

  $wlimit .= $navigation->getNavigationWhere();

  $wlists  = &Rule::getAllWhiteLists($where,$wlimit);
  $rules    = array();

  foreach ($wlists as $white_list) {
    $white_lists[] = array('wl_id'       => $white_list->getWhiteListRecordID(),
			   'wl_type'     => $RS['LIST_WHITE_LIST_TYPE'][$white_list->getWhiteListType()],
			   'wl_data'     => $white_list->getWhiteListData(),
			   'wl_isactive' => $white_list->getWhiteListActive());
  }
  
  $filters['wlist_filter']    = array_values($RS['LIST_WHITE_LIST_TYPE']);

  $tmp->assign('rows'        , $rows);
  $tmp->assign('ceil'        , ceil($total_row/$rows));
  $tmp->assign('total_row'   , $total_row);
  $tmp->assign('begin'       , $begin);
  $tmp->assign('start'       , $start);

  $tmp->assign('filters'     , $filters);
  $tmp->assign('wl_type_id'  , $_POST['wlist_filter']);
  $tmp->assign('data'        , $white_lists);
  $tmp->assign('tab_page'    , $page);
  $tmp->assign('tab'         , 'wlist');
}

# --------------------------------------------------------------------------

function white_list_add($tmp, $page, $white_list_id='') {
  global $RS;

  if ('' != $white_list_id ) {
    $white_list = Rule::getWhiteListById($white_list_id);
  }
  else {
    $white_list = new Rule();
  }

  $tmp->assign(array('wl_id'       => $white_list->getWhiteListRecordID(),
		     'wl_type'     => $white_list->getWhiteListType()-1,
		     'wl_data'     => $white_list->getWhiteListData(),
		     'wl_isactive' => $white_list->getWhiteListActive()
		     ));

  $filters['wlist_filter'] = array_values($RS['LIST_WHITE_LIST_TYPE']);

  $f = array_shift($filters['wlist_filter']);

  $tmp->assign('filters'   , $filters);
  $tmp->assign('tab_page'  , $page);
}

# --------------------------------------------------------------------------

function rule_data_file_list($tmp, $page) {
  $rdfiles_a         = &Rule::getAllRuleDataFiles();
  $rule_data_files   = array();

  foreach ($rdfiles_a as $rule_dfile) {
    $rule_data_files[] = array('rdf_id'             => $rule_dfile->getDataFileID(),
			       'rdf_name'           => $rule_dfile->getDataFileName(),
			       'rdf_data_count'     => $rule_dfile->getRuleDataCount(),
			       'rf_name'            => $rule_dfile->getRuleFileName(),
			       'rdf_isactive'       => $rule_dfile->getDataFileActive());
  }
  
  $tmp->assign('data'    , $rule_data_files);
  $tmp->assign('tab_page', $page);
}

# --------------------------------------------------------------------------

function rule_file_add($tmp, $page, $rule_file_id='') {
  if ('' != $rule_file_id ) {
    $rule_file = Rule::getRuleFilesById($rule_file_id);
  }
  else {
    $rule_file= new Rule();
  }

  $tmp->assign(array('rf_id'        => $rule_file->getRuleFileID(),
		     'rf_name'      => $rule_file->getRuleFileName(),
		     'validity'     => $rule_file->getRuleFileActive())
	       );
  
  $tmp->assign('tab_page',$page);
}

# --------------------------------------------------------------------------

function rule_add($tmp, $page, $rule_record_id='') {
  if ('' != $rule_record_id ) {
    $rule = Rule::getRulesById($rule_record_id);
  }
  else {
    $rule= new Rule();
  }

  $rfiles_a   = &Rule::getAllRuleFiles();
  $rule_files = array();

  foreach ($rfiles_a as $rule_file) {
    $rule_files[] = array('rf_id'         => $rule_file->getRuleFileID(),
			  'rf_name'       => substr($rule_file->getRuleFileName(),0,25),
			  'rf_rule_count' => $rule_file->getRuleFileRuleCount());
  }

  $tmp->assign(array('rule_rid'      => $rule->getRuleRecordID(),
		     'rule_id'       => $rule->getRuleID(),
		     'rule_pid'      => $rule->getRuleParrentRuleID(),
		     'rfile_id'      => $rule->getRuleFileID(),
		     'rule_msg'      => $rule->getRuleInformation(),
		     'rule'          => $rule->getRule(),
		     'validity'      => $rule->getRuleFileActive())
	       );

  $tmp->assign('rule_filter' , $rule_files);
  $tmp->assign('tab_page'    , $page);
}

# --------------------------------------------------------------------------

function rule_data_add($tmp, $page, $rule_data_id='') {
  if ('' != $rule_data_id ) {
    $rule_data = Rule::getRuleDatasById($rule_data_id);
  }
  else {
    $rule_data = new Rule();
  }

  $rdfiles_a   = &Rule::getAllRuleDataFiles();
  $rule_dfiles = array();

  foreach ($rdfiles_a as $rule_dfile) {
    $rule_dfiles[] = array('rdf_id'         => $rule_dfile->getDataFileID(),
			   'rdf_name'       => substr($rule_dfile->getDataFileName(),0,25),
			   'rdf_rule_count' => $rule_dfile->getRuleDataCount());
  }

  $tmp->assign(array('rd_id'     => $rule_data->getRuleDataID(),
		     'rdf_id'    => $rule_data->getDataFileID(),
		     'rd_name'   => $rule_data->getRuleData(),
		     'validity'  => $rule_data->getRuleDataActive())
	       );

  $tmp->assign('rule_dfilter' , $rule_dfiles);
  $tmp->assign('tab_page'     , $page);
}

# --------------------------------------------------------------------------

function rule_data_file_add($tmp, $page, $data_file_id='') {
  if ('' != $data_file_id ) {
    $data_file = Rule::getDataFilesById($data_file_id);
  }
  else {
    $data_file= new Rule();
  }

  $rfiles_a   = &Rule::getAllRuleFiles();
  $rule_files = array();

  foreach ($rfiles_a as $rule_file) {
    $rule_files[] = array('rf_id'         => $rule_file->getRuleFileID(),
			  'rf_name'       => substr($rule_file->getRuleFileName(),0,25),
			  'rf_rule_count' => $rule_file->getRuleFileRuleCount());
  }

  $tmp->assign(array('rdf_id'     => $data_file->getDataFileID(),
		     'rdf_name'   => $data_file->getDataFileName(),
		     'rfile_id'   => $data_file->getRuleFileID(),
		     'validity'   => $data_file->getDataFileActive())
	       );

  $tmp->assign('rule_filter' , $rule_files);  
  $tmp->assign('tab_page',$page);
}

# --------------------------------------------------------------------------

function rule_file_insert($post,$db) {

  $new_rule_file = new Rule();
  $new_rule_file->setRuleFileName($post['rf_name']);
  $new_rule_file->setRuleFileActive($post['validity']);
  $new_rule_file->setFilled(true);
  
  $db->addRuleFiles($new_rule_file);
}

# --------------------------------------------------------------------------

function rule_data_file_insert($post,$db) {

  $new_rule_data_file = new Rule();
  $new_rule_data_file->setDataFileName($post['rdf_name']);
  $new_rule_data_file->setRuleFileID($post['rf_filter']);
  $new_rule_data_file->setDataFileActive($post['validity']);
  $new_rule_data_file->setFilled(true);
  
  $db->addRuleDataFiles($new_rule_data_file);
}

# --------------------------------------------------------------------------

function rule_insert($post,$db) {

  $new_rule = new Rule();
  $new_rule->setRuleID($post['rule_id']);
  $new_rule->setRuleParrentRuleID($post['rule_pid']);
  $new_rule->setRuleFileID($post['rf_filter']);
  $new_rule->setRuleInformation($post['rule_msg']);
  $new_rule->setRule($post['rule']);
  $new_rule->setRuleFileActive($post['validity']);
  $new_rule->setFilled(true);
  
  $db->addRule($new_rule);
}

# --------------------------------------------------------------------------

function rule_data_insert($post,$db) {

  $new_rule_data = new Rule();
  $new_rule_data->setDataFileID($post['rdf_filter']);
  $new_rule_data->setRuleData($post['rd_name']);
  $new_rule_data->setRuleDataActive($post['validity']);
  $new_rule_data->setFilled(true);
  
  $db->addRuleDatas($new_rule_data);
}

# --------------------------------------------------------------------------

function white_list_insert($post,$db) {

  $new_white_list = new Rule();
  $new_white_list->setWhiteListType(($post['wl_filter']+1));
  $new_white_list->setWhiteListData($post['wl_data']);
  $new_white_list->setWhiteListActive($post['validity']);
  $new_white_list->setFilled(true);
  
  $db->addWhiteLists($new_white_list);
}

# --------------------------------------------------------------------------

function rule_file_edit($post,$db) {
  $rule_file = Rule::getRuleFilesById($post['rf_id']);
  $rule_file->setRuleFileName($post['rf_name']);
  $rule_file->setRuleFileActive($post['validity']);
  $rule_file->setFilled(true);
  
  $db->editRuleFiles($rule_file);
}

# --------------------------------------------------------------------------

function rule_data_file_edit($post,$db) {
  $rule_dfile = Rule::getDataFilesById($post['rdf_id']);
  $rule_dfile->setDataFileName($post['rdf_name']);
  $rule_dfile->setRuleFileID($post['rf_filter']);
  $rule_dfile->setDataFileActive($post['validity']);
  $rule_dfile->setFilled(true);
  
  $db->editRuleDataFiles($rule_dfile);
}

# --------------------------------------------------------------------------

function rule_edit($post,$db) {
  $rule    = Rule::getRulesById($post['rule_rid']);
  $rule->setRuleID($post['rule_id']);
  $rule->setRuleParrentRuleID($post['rule_pid']);
  $rule->setRuleFileID($post['rf_filter']);
  $rule->setRuleInformation($post['rule_msg']);
  $rule->setRule($post['rule']);
  $rule->setRuleFileActive($post['validity']);
  $rule->setFilled(true);

  $db->editRule($rule);
}

# --------------------------------------------------------------------------

function rule_data_edit($post,$db) {
  $rule_data = Rule::getRuleDatasById($post['rd_id']);
  $rule_data->setDataFileID($post['rdf_filter']);
  $rule_data->setRuleData($post['rd_name']);
  $rule_data->setRuleDataActive($post['validity']);
  $rule_data->setFilled(true);

  $db->editRuleDatas($rule_data);
}

# --------------------------------------------------------------------------

function white_list_edit($post,$db) {
  $white_list = Rule::getWhiteListById($post['wl_id']);
  $white_list->setWhiteListType(($post['wl_filter']+1));
  $white_list->setWhiteListData($post['wl_data']);
  $white_list->setWhiteListActive($post['validity']);
  $white_list->setFilled(true);

  $db->editWhiteLists($white_list);
}

# --------------------------------------------------------------------------

function rule_file_deleted($rule_file_id,$db) {

  $db->deleteRuleFiles($rule_file_id);
}

# --------------------------------------------------------------------------

function rule_data_deleted($rule_dfile_id,$db) {

  $db->deleteRuleDatas($rule_dfile_id);
}

# --------------------------------------------------------------------------

function rule_data_file_deleted($rule_dfile_id,$db) {

  $db->deleteRuleDataFiles($rule_dfile_id);
}

# --------------------------------------------------------------------------

function rule_deleted($rule_record_id,$db) {

  $db->deleteRule($rule_record_id);
}

# --------------------------------------------------------------------------

function white_list_deleted($white_list_id,$db) {

  $db->deleteWhiteLists($white_list_id);
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
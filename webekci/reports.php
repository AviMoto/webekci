<?php
#
# reports.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 22.06.2008, Bunyamin Demir
#
# Webekci Report Interface
#
# Release Notes:
#

require_once("lib/DB.class.php");
require_once("lib/Template.class.php");
require_once("lib/Report.class.php");
require_once("lib/Navigation.class.php");
require_once("lib/Resource.class.php");
require_once("lib/Filter.class.php");

$tmp = new Template();

$pages = array ( 'audit'     => 'audit_records.tpl',
		 'show_det'  => 'audit_log_detail.tpl',
		 'sip'       => 'source_ip_report.tpl',
		 'show_ip'   => 'source_ip_detail.tpl',
		 'severity'  => 'severity_dist_report.tpl',
		 'category'  => 'category_dist_report.tpl',
		 'rule'      => 'rule_report.tpl',
		 'show_rule' => 'rule_detail.tpl');
	 

$_GET['tab'] ? $sub_menu=$_GET['tab'] : $sub_menu='audit';
$_GET['c']   ? $c=$_GET['c'] : $c=0;
$_GET['cmd'] ? $cmd=$_GET['cmd'] : $cmd='';

$rs = new Resource();
$sub_menus   = $rs->create_sub_menu('report');
$count_menus = count($sub_menus);

$tmp->assign('sub_menus',$sub_menus);
$tmp->assign('select_menu',$c);
$tmp->assign('count_menus',$count_menus);

$db  = new DBConnection();

$RS=$rs->enum(array('LIST_SEVERITY','LIST_CATEGORY',
		    'LIST_HTTP_METHOD','LIST_STATUS',
		    'LIST_PHASE','LIST_HTTP_CODE',
		    'LIST_HTTP_PROTOCOL','LIST_IP'));

# --------------------------------------------------------------------------

switch ($sub_menu) {
 case 'audit':
   if ($cmd  == 'show_det') {
     audit_record_details($tmp, $pages[$cmd], $_GET['id']);
   }
   elseif ($cmd  == 'ip_block') {
     $db->setIpBlock($_GET['ip'],$_GET['v']);
     audit_record_details($tmp, $pages['show_det'], $_GET['id']);
   }
   else {
     audit_record_list($tmp, $pages[$sub_menu]);
   }
   break;

   case 'sip':
   if ($cmd  == 'show_ip') {
     source_ip_detail($tmp, $pages[$cmd], $_GET['ip']);
   }
   elseif ($cmd  == 'ip_block') {
     $db->setIpBlock($_GET['ip'],$_GET['v']);
     source_ip_report($tmp, $pages[$sub_menu]);
   }
   else {
     source_ip_report($tmp, $pages[$sub_menu]);
   }
   break;

   case 'severity':
   if ($cmd  == 'sev_det') {
     source_ip_detail($tmp, $pages[$cmd], $_GET['ip']);
   }
   else {
     severity_dist_report($tmp, $pages[$sub_menu]);
   }
   break;

   case 'category':
   if ($cmd  == 'cat_det') {
     source_ip_detail($tmp, $pages[$cmd], $_GET['ip']);
   }
   else {
     category_dist_report($tmp, $pages[$sub_menu]);
   }
   break;

   case 'rule':
   if ($cmd  == 'show_rule') {
     rule_id_detail($tmp, $pages[$cmd], $_GET['rule_id']);
   }
   else {
     rule_report($tmp, $pages[$sub_menu]);
   }
   break;
}

# --------------------------------------------------------------------------

function audit_record_list($tmp, $page) {
    
  list($filter,$fwhere) = Filter::getFilter($_POST,$_GET);

  $filters    = Filter::getFilters();

  foreach ($fwhere as $w) {
    $where .= $w;
  }

  $total_row  = &Report::countAllAuditLogs($where);

  $navigation = new Navigation($_POST['start'],$_POST['rows'],
			       $_POST['begin'],$_POST['first'],
			       $total_row);

  $start = $navigation->getNavigationStart();
  $rows  = $navigation->getNavigationRows();
  $begin = $navigation->getNavigationBegin();
  $first = $navigation->getNavigationFirst();

  $where .= ' ORDER BY AL.AuditLogID DESC';
  $where .= $navigation->getNavigationWhere();

  $audits_a   = &Report::getAllAuditLogs($where);
  $audit_logs = array();

  foreach ($audits_a as $alog) {
    $audit_logs[] = array('alog_id'     => $alog->getAuditLogId(),
			  'source_ip'   => $alog->getSourceIP(),
			  'source_port' => $alog->getSourcePort(),
			  'date'        => $alog->getAuditLogDate(),
			  'time'        => $alog->getAuditLogTime(),
			  'msg'         => $alog->getMsg(),
			  'host'        => $alog->getHost());
  }

  $tmp->assign('rows'       , $rows);
  $tmp->assign('ceil'       , ceil($total_row/$rows));
  $tmp->assign('total_row'  , $total_row);
  $tmp->assign('begin'      , $begin);
  $tmp->assign('start'      , $start);

  $tmp->assign('filters'    , $filters);
  $tmp->assign('filter'     , $filter);

  $tmp->assign('data'       , $audit_logs);
  $tmp->assign('tab_page'   , $page);
  $tmp->assign('tab'        , 'audit');

  $tmp->display('reports.tpl');
}

# --------------------------------------------------------------------------

function audit_record_details($tmp, $page, $id) {
  global $RS;

  $alog   = Report::getAuditLogById($id);

  $tmp->assign(array('alog_id'          => $alog->getAuditLogId(),
		     'source_ip'        => $alog->getSourceIP(),
		     'sip_is_blocked'   => Report::sourceIPIsBlocked($alog->getSourceIP()),
		     'source_port'      => $alog->getSourcePort(),
		     'destination_ip'   => $alog->getDestinationIP(),
		     'destination_port' => $alog->getDestinationPort(),
		     'unique_id'        => $alog->getAuditLogUniqueId(),
		     'http_method'      => $RS['LIST_HTTP_METHOD'][$alog->getHttpMethod()+1],
		     'uri'              => $alog->getUri(),
		     'http_version'     => $RS['LIST_HTTP_PROTOCOL'][$alog->getHttpProtocol()+1],
		     'host'             => $alog->getHost(),
		     'date'             => $alog->getAuditLogDate(),
		     'time'             => $alog->getAuditLogTime(),
		     'general_msg'      => $alog->getGeneralMsg(),
		     'technical_msg'    => $alog->getTechnicalMsg(),
		     'rule_id'          => $alog->getRuleID(),
		     'msg'              => $alog->getMsg(),
		     'severity'         => $RS['LIST_SEVERITY'][$alog->getSeverity()+1]));
  
  $tmp->display("$page");
}

# --------------------------------------------------------------------------

function source_ip_report($tmp, $page) {
  global $RS;

  list($filter,$fwhere) = Filter::getFilter($_POST,$_GET);

  $filters     = Filter::getFilters();

  foreach ($fwhere as $w) {
    $where .= $w;
  }

  foreach ($filter as $k => $v) {
    $graph_filter .="$k=$v;";
  }

  $total_row  = &Report::countSourceIpRecords($where);

  $navigation = new Navigation($_POST['start'],$_POST['rows'],
			       $_POST['begin'],$_POST['first'],
			       $total_row);

  $start = $navigation->getNavigationStart();
  $rows  = $navigation->getNavigationRows();
  $begin = $navigation->getNavigationBegin();
  $first = $navigation->getNavigationFirst();

  $wlimit .= $navigation->getNavigationWhere();

  $audits_a   = &Report::getSourceIpRecords($where,$wlimit);
  $audit_logs = array();

  $total_rows = 0;

  foreach ($audits_a as $alog) {
    $audit_logs[] = array('source_ip'       => $alog->getSourceIP(),
			  'source_ip_count' => $alog->getSourceIpCount(),
			  'is_blocked'      => $alog->getSourceIpIsBlocked());
    $total_rows++;
  }

  $tmp->assign('rows'         , $rows);
  $tmp->assign('ceil'         , ceil($total_row/$rows));
  $tmp->assign('total_row'    , $total_row);
  $tmp->assign('begin'        , $begin);
  $tmp->assign('start'        , $start);

  $tmp->assign('filters'      , $filters);
  $tmp->assign('filter'       , $filter);
  $tmp->assign('graph_filter' , $graph_filter);
  

  $tmp->assign('data'         , $audit_logs);
  $tmp->assign('tab_page'     , $page);
  $tmp->assign('tab'          , 'sip');

$tmp->display('reports.tpl');
}

# --------------------------------------------------------------------------

function source_ip_detail($tmp, $page, $ip) {
  global $RS;

  $tmp->assign('source_ip' , $ip);
  
  $tmp->display("$page");
}

# --------------------------------------------------------------------------

function severity_dist_report($tmp, $page) {
  global $RS;

  list($filter,$fwhere) = Filter::getFilter($_POST,$_GET);

  $filters    = Filter::getFilters();

  foreach ($fwhere as $w) {
    $where .= $w;
  }

  foreach ($filter as $k => $v) {
    $graph_filter .="$k=$v;";
  }

  $severities = &Report::getSeverityDistribution($where);

  $total_rec  = 0;

  foreach (array_keys($RS['LIST_SEVERITY']) as $s) {

    if (intval($s)) {
      $audit_logs[] = array('severity'       => $RS['LIST_SEVERITY'][intval($s)],
			    'severity_count' => intval($severities[$s]));

      $total_rec   += intval($severities[$s]);
    }
  }

  $tmp->assign('filters'      , $filters);
  $tmp->assign('filter'       , $filter);
  $tmp->assign('graph_filter' , $graph_filter);

  $tmp->assign('data'         , $audit_logs);
  $tmp->assign('total_rec'    , $total_rec);;
  $tmp->assign('tab_page'     , $page);
  $tmp->assign('tab'          , 'severity');

  $tmp->display('reports.tpl');
}

# --------------------------------------------------------------------------

function category_dist_report($tmp, $page) {
  global $RS;

  list($filter,$fwhere) = Filter::getFilter($_POST,$_GET);

  $filters    = Filter::getFilters();

  foreach ($fwhere as $w) {
    $where .= $w;
  }

  foreach ($filter as $k => $v) {
    $graph_filter .="$k=$v;";
  }

  $categories = &Report::getCategoryDistribution($where);

  $total_rec  = 0;

  foreach (array_keys($RS['LIST_CATEGORY']) as $s) {

    if (intval($s)) {
      $audit_logs[] = array('category'       => $RS['LIST_CATEGORY'][intval($s)],
			    'category_count' => intval($categories[$s]));

      $total_rec   += intval($categories[$s]);
    }
  }


  $tmp->assign('filters'      , $filters);
  $tmp->assign('filter'       , $filter);
  $tmp->assign('graph_filter' , $graph_filter);

  $tmp->assign('data'         , $audit_logs);
  $tmp->assign('total_rec'    , $total_rec);
  $tmp->assign('tab_page'     , $page);
  $tmp->assign('tab'          , 'category');

  $tmp->display('reports.tpl');
}

# --------------------------------------------------------------------------

function rule_report($tmp, $page) {
  global $RS;

  list($filter,$fwhere) = Filter::getFilter($_POST,$_GET);

  $filters    = Filter::getFilters();

  foreach ($fwhere as $w) {
    $where .= $w;
  }

  $total_row  = &Report::countRuleRecords($where);

  $navigation = new Navigation($_POST['start'],$_POST['rows'],
			       $_POST['begin'],$_POST['first'],
			       $total_row);

  $start = $navigation->getNavigationStart();
  $rows  = $navigation->getNavigationRows();
  $begin = $navigation->getNavigationBegin();
  $first = $navigation->getNavigationFirst();

  $wlimit .= $navigation->getNavigationWhere();

  $audits_a   = &Report::getRuleRecords($where,$wlimit);
  $audit_logs = array();

  $total_rows = 0;

  foreach ($audits_a as $alog) {
    $audit_logs[] = array('rule_id'        => $alog->getRuleID(),
			  'rule_id_count'  => $alog->getRuleIDCount());
    $total_rows++;
  }

  $tmp->assign('rows'       , $rows);
  $tmp->assign('ceil'       , ceil($total_row/$rows));
  $tmp->assign('total_row'  , $total_row);
  $tmp->assign('begin'      , $begin);
  $tmp->assign('start'      , $start);

  $tmp->assign('filters'    , $filters);
  $tmp->assign('filter'     , $filter);

  $tmp->assign('data'       , $audit_logs);
  $tmp->assign('tab_page'   , $page);
  $tmp->assign('tab'        , 'rule');

$tmp->display('reports.tpl');
}

# --------------------------------------------------------------------------

function rule_id_detail($tmp, $page, $id) {
  global $RS;

  $rule   = Report::getRuleById($id);

  $tmp->assign('rule' , $rule);
  
  $tmp->display("$page");
}

# --------------------------------------------------------------------------

?>
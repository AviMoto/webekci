<?php
#
# Report.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 01.07.2008, Bunyamin Demir
#
# Report class for webekci
#
# Release Notes:
#


require_once 'DataBaseAccessorClient.class.php';
require_once 'Resource.class.php';

class Filter extends DataBaseAccessorClient
{
  private $filter_name  = 0;

  public function Filter($filter_name=0) {
    parent::DataBaseAccessorClient();
    $this->filter_name = $filter_name;
  }
    
  public static function getFilter($post,$get) {
    $filter = new Filter();

    $filters = array();
    $wheres  = array();

    if ($post['severity']) {
      $filters['severity'] = $post['severity'];
    }
    elseif ($get['severity']) {
      $filters['severity'] = $get['severity'];
    }
    else {
      $filters['severity'] = 0;
    }

    if ($post['category']) {
      $filters['category'] = $post['category'];
    }
    elseif ($get['category']) {
      $filters['category'] = $get['category'];
    }
    else {
      $filters['category'] = 0;
    }

    if ($post['http_method']) {
      $filters['http_method'] = $post['http_method'];
    }
    elseif ($get['http_method']) {
      $filters['http_method'] = $get['http_method'];
    }
    else {
      $filters['http_method'] = 0;
    }

    if ($post['status']) {
      $filters['status'] = $post['status'];
    }
    elseif ($get['status']) {
      $filters['status'] = $get['status'];
    }
    else {
      $filters['status'] = 0;
    }

    if ($post['http_code']) {
      $filters['http_code'] = $post['http_code'];
    }
    elseif ($get['http_code']) {
      $filters['http_code'] = $get['http_code'];
    }
    else {
      $filters['http_code'] = 0;
    }

    if ($post['http_pro']) {
      $filters['http_pro'] = $post['http_pro'];
    }
    elseif ($get['http_pro']) {
      $filters['http_pro'] = $get['http_pro'];
    }
    else {
      $filters['http_pro'] = 0;
    }

    if ($post['search']) {
      $filters['search'] = $post['search'];
    }
    elseif ($get['search']) {
      $filters['search'] = $get['search'];
    }
    else {
      $filters['search'] = '';
    }

    if ($post['ip_block']) {
      $filters['ip_block'] = $post['ip_block'];
    }
    elseif ($get['ip_block']) {
      $filters['ip_block'] = $get['ip_block'];
    }
    else {
      $filters['ip_block'] = 0;
    }

    if ($post['sdate']) {
      $filters['sdate'] = $post['sdate'];
    }
    elseif ($get['sdate']) {
      $filters['sdate'] = $get['sdate'];
    }
    else {
      $filters['sdate'] = date("Y-m-d", strtotime("0 day"));
    }

    if ($post['edate']) {
      $filters['edate'] = $post['edate'];
    }
    elseif ($get['edate']) {
      $filters['edate'] = $get['edate'];
    }
    else {
      $filters['edate'] = date("Y-m-d");
    }

    if ($filters['severity'])      { $where['severity']    = " AND A.Severity=".($filters['severity']-1); }
    if ($filters['category'])      { $where['category']    = " AND A.Category=".($filters['category']-1);}
    if ($filters['http_method'])   { $where['http_method'] = " AND AL.HttpMethod=".($filters['http_method']-1); }
    if ($filters['http_pro'])      { $where['http_pro']    = " AND AL.HttpProtocol=".($filters['http_pro']-1); }
    if ($filters['status'])        { $where['status']      = " AND A.Status=".($filters['status']-1); }
    if ($filters['phase'])         { $where['phase']       = " AND A.Phase=".($filters['phase']-1); }
    if ($filters['http_code'])     { $where['http_code']   = " AND AL.HttpStatusCode=".($filters['http_code']-1); }
    if ($filters['sdate'])         { $where['sdate']       = " AND AL.AuditLogDate >= '".$filters['sdate']."'"; }
    if ($filters['edate'])         { $where['edate']       = " AND AL.AuditLogDate <= '".$filters['edate']."'"; }
    if ($filters['ip_block'] == 1) { $where['ip_block']    = " AND IBL.IP IS NULL"; }
    if ($filters['ip_block'] == 2) { $where['ip_block']    = " AND IBL.IP IS NOT NULL"; }

    if ($filters['search']) {
      $where['search'] .= " AND (0"; 
      $where['search'] .= " OR AL.Uri LIKE '%".$filters[search]."%'"; 
      $where['search'] .= " OR AL.QueryString LIKE '%".$filters[search]."%'"; 
      $where['search'] .= " OR AL.SourceIP LIKE '%".$filters[search]."%'"; 
      $where['search'] .= " OR AL.Referer LIKE '%".$filters[search]."%'";  
      $where['search'] .= " OR AL.WebAppId LIKE '%".$filters[search]."%'";  
      $where['search'] .= " OR AL.Host LIKE '%".$filters[search]."%'"; 
      $where['search'] .= " OR A.Msg LIKE '%".$filters[search]."%'"; 
      $where['search'] .= " OR A.RuleID LIKE '%".$filters[search]."%')"; 
    }

    return array(&$filters,&$where);
  }
    
  public function getFilters() {
    $rs = new Resource();

    $RS=$rs->enum(array('LIST_SEVERITY','LIST_CATEGORY',
			'LIST_HTTP_METHOD','LIST_STATUS',
			'LIST_PHASE','LIST_HTTP_CODE',
			'LIST_HTTP_PROTOCOL','LIST_IP'));

    $filters['severity']    = array_values($RS['LIST_SEVERITY']);
    $filters['category']    = array_values($RS['LIST_CATEGORY']);
    $filters['http_method'] = array_values($RS['LIST_HTTP_METHOD']);
    $filters['status']      = array_values($RS['LIST_STATUS']);
    $filters['phase']       = array_values($RS['LIST_PHASE']);
    $filters['http_code']   = array_values($RS['LIST_HTTP_CODE']);
    $filters['http_pro']    = array_values($RS['LIST_HTTP_PROTOCOL']);
    $filters['ip_block']    = array_values($RS['LIST_IP']);

    return $filters;

  }

}
?>

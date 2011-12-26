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

class Report extends DataBaseAccessorClient
{
  private $alog_id  = 0;


  public function Report($alog_id=0) {
    parent::DataBaseAccessorClient();
    $this->alog_id = $alog_id;
  }
    
  public static function getAuditLogById($alog_id) {
    $audit_log = new Report();
    return $audit_log->dbh->getAuditLogById($alog_id);
  }
    
  public function getAllAuditLogs($where) {
    $audit_log = new Report();
    return $audit_log->dbh->getAllAuditLogs($where);
  }

  public function countAllAuditLogs($where) {
    $count = new Report();
    return $count->dbh->countAllAuditLogs($where);
  }

  public function sourceIPIsBlocked($ip) {
    $sip_is_blocked = new Report();
    return $sip_is_blocked->dbh->sourceIPIsBlocked($ip);
  }

  public function getSourceIpRecords($where,$wlimit) {
    $sip_report = new Report();
    return $sip_report->dbh->getSourceIpRecords($where,$wlimit);
  }

  public function countSourceIpRecords($where) {
    $count = new Report();
    return $count->dbh->countSourceIpRecords($where);
  }

  public function countRuleRecords($where) {
    $rule_count = new Report();
    return $rule_count->dbh->countRuleRecords($where);
  }

  public function getRuleRecords($where,$wlimit) {
    $rule_report = new Report();
    return $rule_report->dbh->getRuleRecords($where,$wlimit);
  }

  public static function getSeverityDistribution($where) {
    $severities = new Report();
    return $severities->dbh->getSeverityDistribution($where);
  }
  
  public static function getCategoryDistribution($where) {
    $categories = new Report();
    return $categories->dbh->getCategoryDistribution($where);
  }

  public static function getMonthlyRequest() {
    $month_request = new Report();
    return $month_request->dbh->getMonthlyRequest();
  }

  public static function getSourceIPDetail($source_ip) {
    $source_ip_detail = new Report();
    return $source_ip_detail->dbh->getSourceIPDetail($source_ip);
  }

  public static function getRuleById($rule_id) {
    $rule_info = new Report();
    return $rule_info->dbh->getRuleById($rule_id);
  }

  public function setAuditLogId($alog_id) {
    $this->auditLogId=$alog_id;
  }
  
  public function setAuditLogUniqueId($alog_unique_id) {
    $this->auditLogUniqueId=$alog_unique_id;
  }
  
  public function setAuditLogDate($alog_date) {
    $this->auditDate=$alog_date;
  }
  
  public function setAuditLogTime($alog_time) {
    $this->auditTime=$alog_time;
  }

  public function setSourceIP($alog_source_ip) {
    $this->sourceIP=$alog_source_ip;
  }
  
  public function setSourcePort($alog_source_port) {
    $this->sourcePort=$alog_source_port;
  }
  
  public function setDestinationIP($alog_destionation_ip) {
    $this->destinationIP=$alog_destionation_ip;
  }
  
  public function setDestinationPort($alog_destination_port) {
    $this->destinationPort=$alog_destination_port;
  }

  public function setReferer($alog_referer) {
    $this->referer=$alog_referer;
  }

  public function setUserAgent($alog_user_agent) {
    $this->userAgent=$alog_user_agent;
  }

  public function setHttpMethod($alog_http_method) {
    $this->httpMethod=$alog_http_method;
  }

  public function setUri($alog_uri) {
    $this->uri=$alog_uri;
  }

  public function setQueryString($alog_query_string) {
    $this->queryString=$alog_query_string;
  }

  public function setHttpProtocol($alog_http_protocol) {
    $this->httpProtocol=$alog_http_protocol;
  }

  public function setHost($alog_host) {
    $this->host=$alog_host;
  }

  public function setHttpStatusCode($alog_http_status_code) {
    $this->httpStatusCode=$alog_http_status_code;
  }

  public function setRequestContentType($alog_req_content_type) {
    $this->requestContentType=$alog_req_content_type;
  }

  public function setResponseContentType($alog_resp_content_type) {
    $this->responseContentType=$alog_resp_content_type;
  }

  public function setWebAppId($alog_webappid) {
    $this->webAppId=$alog_webappid;
  }

  public function setBlocked($alog_blocked) {
    $this->blocked=$alog_blocked;
  }

  public function setDuration($alog_duration) {
    $this->duration=$alog_duration;
  }

  public function setGeneralMsg($alog_general_msg) {
    $this->general_msg=$alog_general_msg;
  }

  public function setTechnicalMsg($alog_technical_msg) {
    $this->technical_msg=$alog_technical_msg;
  }

  public function setRuleID($alog_rule_id) {
    $this->rule_id=$alog_rule_id;
  }
   
  public function setRev($alog_rev) {
    $this->rev=$alog_rev;
  }

  public function setMsg($alog_msg) {
    $this->msg=$alog_msg;
  }

  public function setSeverity($alog_severity) {
    $this->severity=$alog_severity;
  }

  public function setCategory($alog_category) {
    $this->category=$alog_category;
  }

  public function setStatus($alog_status) {
    $this->status=$alog_status;
  }

  public function setResolution($alog_resolution) {
    $this->resolution=$alog_resolution;
  }

  public function setSourceIpCount($alog_sip_count) {
    $this->sip_count=$alog_sip_count;
  }

  public function setSourceIpIsBlocked($alog_sip_is_blocked) {
    $this->sip_is_blocked=$alog_sip_is_blocked;
  }

  public function setRuleIDCount($alog_ruleid_count) {
    $this->ruleid_count=$alog_ruleid_count;
  }

  public function getAuditLogId() {
   return $this->auditLogId;
  }
  
  public function getAuditLogUniqueId() {
   return $this->auditLogUniqueId;
  }
  
  public function getAuditLogDate() {
    return $this->auditDate;
  }
  
  public function getAuditLogTime() {
    return $this->auditTime;
  }

  public function getSourceIP() {
    return $this->sourceIP;
  }
  
  public function getSourcePort() {
    return $this->sourcePort;
  }
  
  public function getDestinationIP() {
   return $this->destinationIP;
  }
  
  public function getDestinationPort() {
    return $this->destinationPort;
  }

  public function getReferer() {
    return $this->referer;
  }

  public function getUserAgent() {
    $this->userAgent;
  }

  public function getHttpMethod() {
    return $this->httpMethod;
  }

  public function getUri() {
    return $this->uri;
  }

  public function getQueryString() {
    return $this->queryString;
  }

  public function getHttpProtocol() {
    return $this->httpProtocol;
  }

  public function getHost() {
    return $this->host;
  }

  public function getHttpStatusCode() {
    return $this->httpStatusCode;
  }

  public function getRequestContentType() {
    return $this->requestContentType;
  }

  public function getResponseContentType() {
    return $this->responseContentType;
  }

  public function getWebAppId() {
    return $this->webAppId;
  }

  public function getBlocked() {
    return $this->blocked;
  }

  public function getDuration() {
    return $this->duration;
  }

  public function getGeneralMsg() {
    return $this->general_msg;
  }

  public function getTechnicalMsg() {
    return $this->technical_msg;
  }

  public function getRuleID() {
    return $this->rule_id;
  }
   
  public function getRev() {
    return $this->rev;
  }

  public function getMsg() {
    return $this->msg;
  }

  public function getSeverity() {
    return $this->severity;
  }

  public function getCategory() {
    return $this->category;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getResolution() {
    return $this->resolution;
  }

  public function getSourceIpCount() {
    return $this->sip_count;
  }

  public function getSourceIpIsBlocked() {
    return $this->sip_is_blocked;
  }

  public function getRuleIDCount() {
    return $this->ruleid_count;
  }
}
?>

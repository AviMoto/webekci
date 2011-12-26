<?php
#
# ModSecConfiguration.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 11.05.2008, Bunyamin Demir
#
# ModSecurity Configuration library
#
# Release Notes:
#


require_once 'ModSecDirective.class.php';

class ModSecConfiguration extends ModSecDirective
{
  private $id                     = 0;
  private $name                   = 'FirstConfFile';
  private $description            = 'Descrption for configuration file';
  private $active                 = 1;
  private $audit_engine           = 1;
  private $rule_engine            = 3;
  private $audit_log_rstatus      = '^(?:5|4\d[^4])';
  private $audit_log_parts        = 'A,B,C';
  private $audit_log_type         = 'Concurrent';
  private $content_injection      = 2;
  private $reqbody_access         = 1;
  private $respbody_acess         = 1;
  private $audit_log              = 'logs/auditlog';
  private $audit_log_sdir         = 'logs/auditlogsdir';
  private $data_dir               = 'logs/data';
  private $guardian_log           = 'logs/guardian.log';
  private $pdf_protect            = 2;
  private $reqbody_limit          = 134217728;
  private $reqbody_nofiles_limit  = 0;
  private $reqbody_inmemory_limit = 131072;
  private $respbody_limit         = 524288;
  private $upload_keep_files      = 2;
  private $respbody_mime_type     = '0,1';
  private $tmp_dir                = '/tmp';
  private $server_signature       = 'Webekci-Server/2.0';

  public function ModSecConfiguration($id=0) {
    parent::DataBaseAccessorClient();
    $this->id = $id;
  }
    
  public static function getModSecConfById($id) {
    $msec_conf = new ModSecConfiguration();
    return $msec_conf->dbh->getModSecConfById($id);
  }
    
  public function getAllModSecConfigurations() {
    $msec_conf = new ModSecConfiguration();
    return $msec_conf->dbh->getAllModSecConfigurations();
  }
  
  public function setId($id) {
    $this->id=$id;
  }
  
  public function setName($name) {
    $this->name=$name;
  }

  public function setDescription($description) {
    $this->description=$description;
  }

  public function setActive($active) {
    $this->active=$active;
  }

  public function setUpdated($updated) {
    $this->updated=$updated;
  }

  public function setDeleted($deleted) {
    $this->deleted=$deleted;
  }

  public function setSecArgumentSperator($arg_sperator) {
    $this->arg_sperator=$arg_sperator;
  }
    
  public function setSecAuditEngine($audit_engine) {
    $this->audit_engine=$audit_engine;
  }

  public function setSecAuditLogParts($audit_log_parts) {
    $this->audit_log_parts=$audit_log_parts;
  }

  public function setSecAuditLogType($audit_log_type) {
    $this->audit_log_type=$audit_log_type;
  }

  public function setSecCacheTransformations($cache_transform) {
    $this->cache_transform=$cache_transform;
  }

  public function setSecContentInjection($content_injection) {
    $this->content_injection=$content_injection;
  }

  public function setSecCookieFormat($cookie_format) {
    $this->cookie_format=$cookie_format;
  }

  public function setSecDebugLogLevel($debug_log_level) {
    $this->debug_log_level=$debug_log_level;
  }

  public function setSecRequestBodyAccess($reqbody_access) {
    $this->reqbody_access=$reqbody_access;
  }

  public function setSecResponseBodyLimitAction($respbody_limt_act) {
    $this->respbody_limt_act=$respbody_limt_act;
  }

  public function setSecResponseBodyMimeType($respbody_mime_type) {
    $this->respbody_mime_type=$respbody_mime_type;
  }

  public function setSecResponseBodyAccess($respbody_acess) {
    $this->respbody_acess=$respbody_acess;
  }

  public function setSecUploadKeepFiles($upload_keep_files) {
    $this->upload_keep_files=$upload_keep_files;
  }

  public function setSecRuleInheritance($rule_inheritance) {
    $this->rule_inheritance=$rule_inheritance;
  }

  public function setSecRuleEngine($rule_engine) {
    $this->rule_engine=$rule_engine;
  }

  public function setSecPdfProtect($pdf_protect) {
    $this->pdf_protect=$pdf_protect;
  }

  public function setSecPdfProtectMethod($pdf_protect_method) {
    $this->pdf_protect_method=$pdf_protect_method;
  }

  public function setSecPdfProtectTimeOut($pdf_protect_timeout) {
    $this->pdf_protect_timeout=$pdf_protect_timeout;
  }

  public function setSecAuditLog($audit_log) {
    $this->audit_log=$audit_log;
  }

  public function setSecAuditLog2($audit_log2) {
    $this->audit_log2=$audit_log2;
  }

  public function setSecAuditLogRelevantStatus($audit_log_rstatus) {
    $this->audit_log_rstatus=$audit_log_rstatus;
  }

  public function setSecAuditLogStorageDir($audit_log_sdir) {
    $this->audit_log_sdir=$audit_log_sdir;
  }

  public function setSecChrootDir($chroot_dir) {
    $this->chroot_dir=$chroot_dir;
  }

  public function setSecComponentSignature($comp_signature) {
    $this->comp_signature=$comp_signature;
  }

  public function setSecDataDir($data_dir) {
    $this->data_dir=$data_dir;
  }

  public function setSecDebugLog($debug_log) {
    $this->debug_log=$debug_log;
  }

  public function setSecGeoLookupDb($geo_look_up_db) {
    $this->geo_look_up_db=$geo_look_up_db;
  }

  public function setSecGuardianLog($guardian_log) {
    $this->guardian_log=$guardian_log;
  }

  public function setSecRequestBodyLimit($reqbody_limit) {
    $this->reqbody_limit=$reqbody_limit;
  }

  public function setSecRequestBodyNoFilesLimit($reqbody_nofiles_limit) {
    $this->reqbody_nofiles_limit=$reqbody_nofiles_limit;
  }

  public function setSecRequestBodyInMemoryLimit($reqbody_inmemory_limit) {
    $this->reqbody_inmemory_limit=$reqbody_inmemory_limit;
  }

  public function setSecResponseBodyLimit($respbody_limit) {
    $this->respbody_limit=$respbody_limit;
  }

  public function setSecRuleRemoveById($rule_remove_byid) {
    $this->rule_remove_byid=$rule_remove_byid;
  }

  public function setSecRuleRemoveByMsg($rule_remove_bymsg) {
    $this->rule_remove_bymsg=$rule_remove_bymsg;
  }

  public function setSecRuleScript($rule_script) {
    $this->rule_script=$rule_script;
  }

  public function setSecServerSignature($server_signature) {
    $this->server_signature=$server_signature;
  }

  public function setSecTmpDir($tmp_dir) {
    $this->tmp_dir=$tmp_dir;
  }

  public function setSecUploadDir($upload_dir) {
    $this->upload_dir=$upload_dir;
  }

  public function setSecWebAppId($web_app_id) {
    $this->web_app_id=$web_app_id;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getDescription() {
    return $this->description;
  }
  
  public function isActive() {
    return $this->active;
  }

  public function isUpdated() {
    return $this->updated;
  }

  public function isDeleted() {
    return $this->deleted;
  }

  public function getSecArgumentSperator() {
    return $this->arg_sperator;
  }
  
  public function getSecAuditEngine() {
    return $this->audit_engine;
  }
  
  public function getSecAuditLogParts() {
    return $this->audit_log_parts;
  }

  public function getSecAuditLogType() {
    return $this->audit_log_type;
  }

  public function getSecCacheTransformations() {
    return $this->cache_transform;
  }

  public function getSecContentInjection() {
    return $this->content_injection;
  }

  public function getSecCookieFormat() {
    return $this->cookie_format;
  }

  public function getSecDebugLogLevel() {
    return $this->debug_log_level;
  }

  public function getSecRequestBodyAccess() {
    return $this->reqbody_access;
  }

  public function getSecResponseBodyLimitAction() {
    return $this->respbody_limt_act;
  }

  public function getSecResponseBodyMimeType() {
    return $this->respbody_mime_type;
  }

  public function getSecResponseBodyAccess() {
    return $this->respbody_acess;
  }

  public function getSecUploadKeepFiles() {
    return $this->upload_keep_files;
  }

  public function getSecRuleInheritance() {
    return $this->rule_inheritance;
  }

  public function getSecRuleEngine() {
    return $this->rule_engine;
  }

  public function getSecPdfProtect() {
    return $this->pdf_protect;
  }

  public function getSecPdfProtectMethod() {
    return $this->pdf_protect_method;
  }

  public function getSecPdfProtectTimeOut() {
    return $this->pdf_protect_timeout;
  }

  public function getSecAuditLog() {
    return $this->audit_log;
  }

  public function getSecAuditLog2() {
    return $this->audit_log2;
  }

  public function getSecAuditLogRelevantStatus() {
    return $this->audit_log_rstatus;
  }

  public function getSecAuditLogStorageDir() {
    return $this->audit_log_sdir;
  }

  public function getSecChrootDir() {
    return $this->chroot_dir;
  }

  public function getSecComponentSignature() {
    return $this->comp_signature;
  }

  public function getSecDataDir() {
    return $this->data_dir;
  }

  public function getSecDebugLog() {
    return $this->debug_log;
  }

  public function getSecGeoLookupDb() {
    return $this->geo_look_up_db;
  }

  public function getSecGuardianLog() {
    return $this->guardian_log;
  }

  public function getSecRequestBodyLimit() {
    return $this->reqbody_limit;
  }

  public function getSecRequestBodyNoFilesLimit() {
    return $this->reqbody_nofiles_limit;
  }

  public function getSecRequestBodyInMemoryLimit() {
    return $this->reqbody_inmemory_limit;
  }

  public function getSecResponseBodyLimit() {
    return $this->respbody_limit;
  }

  public function getSecRuleRemoveById() {
    return $this->rule_remove_byid;
  }

  public function getSecRuleRemoveByMsg() {
    return $this->rule_remove_bymsg;
  }

  public function getSecRuleScript() {
    return $this->rule_script;
  }

  public function getSecServerSignature() {
    return $this->server_signature;
  }

  public function getSecTmpDir() {
    return $this->tmp_dir;
  }

  public function getSecUploadDir() {
    return $this->upload_dir;
  }

  public function getSecWebAppId() {
    return $this->web_app_id;
  }
}
?>

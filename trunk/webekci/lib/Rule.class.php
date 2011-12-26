<?php
#
# Domain.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 11.05.2008, Christophe Vandeplas
#
# Domain class for virtual host
#
# Release Notes:
# [2008.05.25] Site rename Domain (BD)


require_once 'DataBaseAccessorClient.class.php';

class Rule extends DataBaseAccessorClient
{
  private $rule_id            = 'w1';
  private $rule_parrent_rid   = '';
  private $rule_default_value = 1;
  private $rule_file_id       = 0;
  private $rule_infomation    = '';
  private $data_file_name     = '';
  private $rule_file_name     = 'WebekciRuleFile';
  private $active             = 1;
  
  private $rules              = Array();
  private $certificate        = null;
  

  public function Rule($id=0) {
    parent::DataBaseAccessorClient();
    $this->id = $id;
  }
    
  public static function getDomainById($id) {
    $domain = new Domain();
    return $domain->dbh->getDomainById($id);
  }

  public static function getRulesById($rule_id) {
    $rule = new Rule();
    return $rule->dbh->getRulesById($rule_id);
  }

  public static function getRuleFilesById($rule_file_id) {
    $rule = new Rule();
    return $rule->dbh->getRuleFilesById($rule_file_id);
  }

  public static function getDataFilesById($data_file_id) {
    $rule = new Rule();
    return $rule->dbh->getDataFilesById($data_file_id);
  }

  public static function getRuleDatasById($rule_data_id) {
    $rule = new Rule();
    return $rule->dbh->getRuleDatasById($rule_data_id);
  }

  public function getAllRules($where,$wlimit) {
    $rule = new Rule();
    return $rule->dbh->getAllRules($where,$wlimit);
  }

  public function countRulesRecord($where) {
    $count = new Rule();
    return $count->dbh->countRulesRecord($where);
  }

  public function countRuleDatasRecord($where) {
    $count = new Rule();
    return $count->dbh->countRuleDatasRecord($where);
  }

  public function countWhiteListRecord($where) {
    $count_wlist = new Rule();
    return $count_wlist->dbh->countWhiteListRecord($where);
  }

  public function getAllRuleFiles() {
    $rule_file = new Rule();
    return $rule_file->dbh->getAllRuleFiles();
  }

  public function getAllRuleDataFiles() {
    $rule_data_file = new Rule();
    return $rule_data_file->dbh->getAllRuleDataFiles();
  }

  public function getAllRuleDatas($where,$wlimit) {
    $rule_data = new Rule();
    return $rule_data->dbh->getAllRuleDatas($where,$wlimit);
  }

  public function getAllWhiteLists($where,$wlimit) {
    $white_list = new Rule();
    return $white_list->dbh->getAllWhiteLists($where,$wlimit);
  }

  public static function getWhiteListById($white_list_id) {
    $white_list = new Rule();
    return $white_list->dbh->getWhiteListById($white_list_id);
  }

  public function getAllActiveDomains() {
    $domain = new Domain();
    return $domain->dbh->getAllActiveDomains();
  }
  
  public function countPolicies() {
    return $this->dbh->countPoliciesByDomainId( $this->id );
  }
  
  public function getPoliciesNames() {
    return $this->dbh->getPoliciesNamesByDomainId( $this->id );
  }
  
  public function getPolicies() {
    return $this->dbh->getPoliciesByDomainId( $this->id );
  }
  
  public function setId($id) {
    $this->id=$id;
  }

  public function setRuleRecordID($rule_record_id) {
    $this->rule_record_id=$rule_record_id;
  }
  
  public function setRuleID($rule_id) {
    $this->rule_id=$rule_id;
  }

  public function setRuleParrentRuleID($rule_parrent_rid) {
    $this->rule_parrent_rid=$rule_parrent_rid;
  }

  public function setRuleInformation($rule_infomation) {
    $this->rule_infomation=$rule_infomation;
  }
  
  public function setRule($rule) {
    $this->rule=$rule;
  }

  public function setRuleShort($rule_short) {
    $this->rule_short=$rule_short;
  }
  
  public function setRuleDefaultValue($rule_default_value) {
    $this->rule_default_value=$rule_default_value;
  }

  public function setRuleActive($rule_active) {
    $this->rule_active=$rule_active;
  }

  public function setDataFileName($data_file_name) {
    $this->data_file_name=$data_file_name;
  }

  public function setRuleFileID($rule_file_id) {
    $this->rule_file_id=$rule_file_id;
  }

  public function setRuleFileName($rule_file_name) {
    $this->rule_file_name=$rule_file_name;
  }

  public function setRuleFileActive($rule_file_active) {
    $this->rule_file_active=$rule_file_active;
  }

  public function setRuleFileRuleCount($rule_file_rule_count) {
    $this->rule_file_rule_count=$rule_file_rule_count;
  }

  public function setRuleFileRuleDataFileCount($rule_file_rule_data_count) {
    $this->rule_file_rule_data_count=$rule_file_rule_data_count;
  }

  public function setDataFileID($rule_data_file_id) {
    $this->rule_data_file_id=$rule_data_file_id;
  }

  public function setRuleDataCount($rule_data_count) {
    $this->rule_data_count=$rule_data_count;
  }

  public function setDataFileActive($rule_data_file_active) {
    $this->rule_data_file_active=$rule_data_file_active;
  }

  public function setRuleDataID($rule_data_id) {
    $this->rule_data_id=$rule_data_id;
  }

  public function setRuleData($rule_data) {
    $this->rule_data=$rule_data;
  }

  public function setRuleDataActive($rule_data_active) {
    $this->rule_data_active=$rule_data_active;
  }

  public function setWhiteListRecordID($white_list_rid) {
    $this->white_list_rid=$white_list_rid;
  }

  public function setWhiteListType($white_list_type) {
    $this->white_list_type=$white_list_type;
  }

  public function setWhiteListData($white_list_data) {
    $this->white_list_data=$white_list_data;
  }

  public function setWhiteListActive($white_list_active) {
    $this->white_list_active=$white_list_active;
  }

  public function setName($name) {
    $this->name=$name;
  }
  
  public function setExternalName($name) {
    $this->externalName=$name;
  }
  
  public function setExternalIP($ip) {
    $this->externalIP=$ip;
  }
  
  public function setExternalPort($port) {
    $this->externalPort=$port;
  }
  
  public function setInternalName($name) {
    $this->internalName=$name;
  }
  
  public function setInternalPort($port) {
    $this->internalPort=$port;
  }

  public function setOther($other) {
    $this->other=$other;
  }

  public function setModSecConf($mod_sec_conf) {
    $this->mod_sec_conf=$mod_sec_conf;
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
    
  public function getId() {
    return $this->id;
  }

  public function getRuleRecordID() {
    return $this->rule_record_id;
  }
  
  public function getRuleID() {
    return $this->rule_id;
  }

  public function getRuleParrentRuleID() {
    return $this->rule_parrent_rid;
  }

  public function getRuleInformation() {
    return $this->rule_infomation;
  }
  
  public function getRule() {
    return $this->rule;
  }

  public function getRuleShort() {
    return $this->rule_short;
  }
  
  public function getRuleDefaultValue() {
    return $this->rule_default_value;
  }

  public function getRuleActive() {
    return $this->rule_active;
  }

  public function getDataFileName() {
    return $this->data_file_name;
  }

  public function getRuleFileID() {
    return $this->rule_file_id;
  }

  public function getRuleFileName() {
    return $this->rule_file_name;
  }

  public function getRuleFileActive() {
    return $this->rule_file_active;
  }

  public function getRuleFileRuleCount() {
    return $this->rule_file_rule_count;
  }

  public function getRuleFileRuleDataFileCount() {
    return $this->rule_file_rule_data_count;
  }

  public function getDataFileID() {
    return $this->rule_data_file_id;
  }

  public function getRuleDataCount() {
    return $this->rule_data_count;
  }

  public function getDataFileActive() {
    return $this->rule_data_file_active;
  }

  public function getRuleDataID() {
    return $this->rule_data_id;
  }

  public function getRuleData() {
    return $this->rule_data;
  }

  public function getRuleDataActive() {
    return $this->rule_data_active;
  }

  public function getWhiteListRecordID() {
    return $this->white_list_rid;
  }

  public function getWhiteListType() {
    return $this->white_list_type;
  }

  public function getWhiteListData() {
    return $this->white_list_data;
  }

  public function getWhiteListActive() {
    return $this->white_list_active;
  }

  public function getName() {
    return $this->name;
  }

  public function getExternalName() {
    return $this->externalName;
  }
  
  public function getExternalIP() {
    return $this->externalIP;
  }
  
  public function getExternalPort() {
    return $this->externalPort;
  }

  public function getInternalName() {
    return $this->internalName;
  }
  
  public function getInternalPort() {
    return $this->internalPort;
  }

  public function getOther() {
    return $this->other;
  }
  
  public function getModSecConf() {
    return $this->mod_sec_conf;
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
}
?>

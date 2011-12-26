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
# [2009.08.30] ServerAdmin,Alias added (BD)


require_once 'DataBaseAccessorClient.class.php';

class Domain extends DataBaseAccessorClient
{
  private $id                 = 0;
  private $name               = 'New Domain';
  private $serverName         = 'www.owasp-webekci.org';
  private $serverIP           = '192.158.2.1';
  private $serverPort         = 80;
  private $serverAdmin        = 'bunyamin@owasp.org';
  private $alias              = '';
  private $other              = '#for other directive';
  private $active             = 1;
  
  private $rules              = Array();
  private $certificate        = null;
  

  public function Domain($id=0) {
    parent::DataBaseAccessorClient();
    $this->id = $id;
  }
    
  public static function getDomainById($id) {
    $domain = new Domain();
    return $domain->dbh->getDomainById($id);
  }
    
  public function getAllDomains() {
    $domain = new Domain();
    return $domain->dbh->getAllDomains();
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
  
  public function setName($name) {
    $this->name=$name;
  }
  
  public function setServerName($name) {
    $this->serverName=$name;
  }
  
  public function setServerIP($ip) {
    $this->serverIP=$ip;
  }
  
  public function setServerPort($port) {
    $this->serverPort=$port;
  }
  
  public function setServerAdmin($name) {
    $this->serverAdmin=$name;
  }
  
  public function setAlias($alias) {
    $this->alias=$alias;
  }

  public function setOther($other) {
    $this->other=$other;
  }

  public function setModSecConf($mod_sec_conf) {
    $this->mod_sec_conf=$mod_sec_conf;
  }

  public function setModSecConfName($mod_sec_conf_name) {
    $this->mod_sec_conf_name=$mod_sec_conf_name;
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

  public function getName() {
    return $this->name;
  }

  public function getServerName() {
    return $this->serverName;
  }
  
  public function getServerIP() {
    return $this->serverIP;
  }
  
  public function getServerPort() {
    return $this->serverPort;
  }

  public function getServerAdmin() {
    return $this->serverAdmin;
  }
  
  public function getAlias() {
    return $this->alias;
  }

  public function getOther() {
    return $this->other;
  }
  
  public function getModSecConf() {
    return $this->mod_sec_conf;
  }

  public function getModSecConfName() {
    return $this->mod_sec_conf_name;
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

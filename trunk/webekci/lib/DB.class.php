<?php
#
# DB.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 06.05.2008, Bunyamin Demir
#
# Database Module
#
# Release Notes:
# [2008-05-28] audit_log and alers table added (BD)
# [2009-08-07] ip_block_list added (BD)

set_include_path("pear:smarty/libs/:.");

require_once 'MDB2.php';
require_once 'Domain.class.php';
require_once 'ModSecConfiguration.class.php';
require_once 'Report.class.php';
require_once 'AbstractBaseComponent.class.php';
require_once 'Resource.class.php';


$T_USERS           = "users";
$T_MANAGEMENT      = "management";

$T_DOMAIN          = "domain";
$T_MODSEC_CONF     = "modsec_conf";
$T_MODSEC_OPTION   = "modsec_option";
$T_CONF_OPTION     = "conf_option";
$T_POLICY          = "policy";

$T_AUDIT_LOG       = "audit_log";
$T_ALERTS          = "alerts"; 

$T_RULES           = "rules";
$T_RULE_FILES      = "rule_files";
$T_RULE_DATA_FILES = "rule_data_files";
$T_RULE_DATA       = "rule_data";

$T_IP_BLOCK_LIST   = "ip_block_list";
$T_WHITE_LIST      = "white_list";

$AUTOINC           = 'auto_increment';

# ------------------------------------------------------------------------

$TABLE = array
  (
   $T_MANAGEMENT       => "CREATE TABLE management (
                        ManagementID int NOT NULL,
                        Updated timestamp(14),
                        PRIMARY KEY  (ManagementID))",

   $T_USERS            => "CREATE TABLE users (
                        UserID int(10) NOT NULL $AUTOINC,
                        Username varchar(32) NOT NULL,
                        Password varchar(32) NOT NULL,
                        Name varchar(40) NOT NULL,
                        Lastname varchar(50) NOT NULL,
                        Email varchar(64) NOT NULL,
                        Phone varchar(32) default NULL,
                        CellPhone varchar(32) default NULL,
                        Fax varchar(32) default NULL,
                        Validity tinyint NOT NULL DEFAULT 0,
                        Updated timestamp(14),
                        Created timestamp,
                        Deleted tinyint NOT NULL DEFAULT 0,
                        UNIQUE       (Username),
                        PRIMARY KEY  (UserID))",

   $T_DOMAIN           => "CREATE TABLE domain (
                        DomainID int(10) NOT NULL $AUTOINC,
                        DomainName varchar(255) NOT NULL,
                        ServerName varchar(255) NOT NULL,
                        ServerIP char(16) NOT NULL,
                        ServerPort int(5) NOT NULL,
                        ServerAdmin varchar(255),
                        Alias varchar(255),
                        Other blob,
                        ConfID int(5) default NULL,
                        Validity tinyint NOT NULL DEFAULT 0,
                        Updated timestamp(14),
                        Deleted tinyint NOT NULL DEFAULT 0,
                        PRIMARY KEY  (DomainID))",

   $T_MODSEC_CONF      => "CREATE TABLE modsec_conf (
                        ConfID int(10) NOT NULL $AUTOINC,
                        ConfName varchar(255) NOT NULL,
                        Description text,    
                        Validity tinyint NOT NULL DEFAULT 0,
                        Updated timestamp(14),
                        Deleted tinyint NOT NULL DEFAULT 0,
                        PRIMARY KEY  (ConfID))",  


   $T_MODSEC_OPTION    => "CREATE TABLE modsec_option (
                        OptionID int(10) NOT NULL $AUTOINC,
                        OptionName varchar(255) NOT NULL,
                        OptionValue text,
                        DefaultValue text,  
                        Updated timestamp(14),
                        Deleted tinyint NOT NULL DEFAULT 0,
                        PRIMARY KEY  (OptionID))",

   $T_CONF_OPTION      => "CREATE TABLE conf_option (
                        ConfID int(10) NOT NULL,
                        OptionID int(10) NOT NULL,
                        OptionValue varchar(255) NOT NULL,   
                        Updated timestamp(14),
                        Deleted tinyint NOT NULL DEFAULT 0,
                        PRIMARY KEY  (ConfID,OptionID))", 

   $T_POLICY           => "CREATE TABLE policy (
                        PolicyID int(10) NOT NULL $AUTOINC,
                        PolicyName varchar(255) NOT NULL,
                        Description text,                    
                        Validity tinyint NOT NULL DEFAULT 0,
                        Updated timestamp(14),
                        Deleted tinyint NOT NULL DEFAULT 0,
                        PRIMARY KEY  (PolicyID))",  

   $T_AUDIT_LOG        => "CREATE TABLE  audit_log (
                        AuditLogID bigint(20) unsigned NOT NULL auto_increment,
                        AuditLogUniqueID char(32) NOT NULL, 
                        AuditLogDate date NOT NULL,
                        AuditLogTime time NOT NULL,
                        SourceIP char(15) NOT NULL,
                        SourcePort int unsigned default NULL,
                        DestinationIP char(15) NOT NULL,
                        DestinationPort int unsigned default NULL,
                        Referer varchar(255) default NULL,
                        UserAgent varchar(255) default NULL,
                        HttpMethod tinyint NOT NULL DEFAULT 0,
                        Uri text,
                        QueryString text,
                        HttpProtocol tinyint NOT NULL DEFAULT 0,
                        Host varchar(255) DEFAULT NULL,
                        HttpStatusCode tinyint NOT NULL DEFAULT 0,
                        RequestContentType varchar(255) DEFAULT NULL,
                        ResponseContentType varchar(255) DEFAULT NULL,
                        WebAppId varchar(255) DEFAULT NULL,
                        Blocked tinyint NOT NULL DEFAULT 0,
                        Duration int NOT NULL,
                        INDEX        (AuditLogUniqueID),
                        PRIMARY KEY  (AuditLogID))",  

   $T_ALERTS           => "CREATE TABLE  alerts (
                        AuditLogUniqueID char(32) NOT NULL,
                        GeneralMsg varchar(255) DEFAULT NULL,
                        TechnicalMsg text,
                        RuleID int(10) DEFAULT NULL,
                        Rev varchar(128) DEFAULT NULL,
                        Msg text,
                        Severity tinyint DEFAULT 0,
                        Category tinyint DEFAULT 0,
                        Status tinyint DEFAULT 0,
                        Resolution tinyint DEFAULT 0,
                        INDEX     (AuditLogUniqueID))",  

   $T_RULES            => "CREATE TABLE  rules (
                        RecordID INT unsigned NOT NULL auto_increment,
		        RuleID varchar(16),
                        ParrentRuleID varchar(16),
                        RuleFileID INT NOT NULL,
                        Information blob,
                        Rule blob,
                        DefaultValue tinyint DEFAULT 1,
                        Deleted tinyint DEFAULT 0,
		        INDEX     (RuleID,RuleFileID),
                        PRIMARY KEY  (RecordID))",   

   $T_RULE_FILES       => "CREATE TABLE  rule_files (
                        RuleFileID INT unsigned NOT NULL auto_increment,
		        RuleFileName Varchar(255),
                        Deleted tinyint DEFAULT 0,
		        PRIMARY KEY  (RuleFileID))",

   $T_RULE_DATA_FILES  => "CREATE TABLE  rule_data_files (
                        DataFileID INT unsigned NOT NULL auto_increment,
                        RuleFileID INT NOT NULL,
		        DataFileName Varchar(255),
                        Deleted tinyint DEFAULT 0,
		        INDEX     (RuleFileID),
		        PRIMARY KEY  (DataFileID))",

   $T_RULE_DATA        => "CREATE TABLE  rule_data (
                        RuleDataID INT unsigned NOT NULL auto_increment,
                        DataFileID INT NOT NULL,
		        RuleData blob,
                        Deleted tinyint DEFAULT 0,
		        INDEX     (DataFileID),
		        PRIMARY KEY  (RuleDataID))",

   $T_IP_BLOCK_LIST    => "CREATE TABLE  ip_block_list (
                        IP char(15) NOT NULL,
                        Created timestamp(14),
                        PRIMARY KEY  (IP))",

   $T_WHITE_LIST       => "CREATE TABLE  white_list (
                        RecordID INT unsigned NOT NULL auto_increment,
                        WhiteListType tinyint DEFAULT 0,
		        WhiteListData Varchar(255),
                        Deleted tinyint DEFAULT 0,
		        INDEX     (WhiteListType),
		        PRIMARY KEY  (RecordID))",

   );


class DBConnection extends AbstractBaseComponent {
  
  private $db_type = 'mysqli';
  private $db_user = 'msaluser';
  private $db_pass = 'msalpass';
  private $db_host = '127.0.0.1';
  private $db_name = 'msaldb';

  public $databases  = array();
  public $tables     = array();
  public $select_tbl = array();

  var $dbh;

  function DBConnection() {

    $this->AbstractBaseComponent();

    // Prepared dsn for connection
    $dsn = $this->db_type.'://'.$this->db_user.':'.
       $this->db_pass.'@'.$this->db_host.'/'.$this->db_name;
   
    $options = array('debug'       => 2,
		     'portability' => MDB2_PORTABILITY_ALL);
    
    // !!! $this->dbh using for all db connection.
    $this->dbh =& MDB2::factory($dsn,$options);
    
    if (MDB2::isError($this->dbh)) {
      echo ($this->dbh->getMessage().' - '.$this->dbh->getUserinfo());
    }
  }
  
  function &getSingleton() {
    static $instance;
    
    if (!isset($instance)) {
      $instance = new DBConnection();
    }
    return $instance;
  }
  
  public function CreateDbTable($table) {
    global $TABLE;
    
    //Create table
    $this->dbh->query($TABLE["$table"]);
  }
  
  public function DropDbTable($table) {
    
    //Drop table
    $this->dbh->query("DROP TABLE $table");
  }

  public function CountTableRows($field,$table) {
    
    //if(isset($field)) $filed='*';
    
    //Count rows for a table
    $count_str = 'SELECT '.$field.' FROM '.$table;
    $sth       = $this->dbh->query($count_str); 
    
     return 1;
    //return  $sth->numRows();
  }

  public function DbTableList($select) {
    
    if($select) {$this->select_tbl = array_values($select);}
    
    $db_tables = $this->dbh->query("SHOW TABLES");
    
    while ($d=$db_tables->fetchRow()) {
      $this->databases[] = $d[0];
    }
    
    if ($this->databases) {
      foreach ($this->databases as $table_name) {
	array_push($this->tables,$table_name);
      }
    }
    
    if (count($this->select_tbl)) {
      $count_result = count($result = array_diff($this->select_tbl,
						 $this->tables));
      $count_merge  = count($merge  = array_diff($this->tables,
						 $this->select_tbl));
      
      // ... Create table if checked
      if ($count_result) {
	foreach ($result as $col) {
	  $this->CreateDbTable($col);
	  $this->tables[] = $col;
	  $this->tables   = array_values($this->tables);
	}
      }
      
      // ... Drop table if unchecked
      if ($count_merge) {
	foreach ($merge as  $key => $col) {
	  $this->DropDbTable($col);
	  unset($this->tables[$key]);
	  $this->tables = array_values($this->tables);
	}
      }
    }    
    return $this->tables;
  }

  public function getAllDomains($where='') {
    
    $count_str = "SELECT D.*,C.ConfName from domain D
                  LEFT JOIN modsec_conf C ON (C.ConfID=D.ConfID)
                  $where";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $domains_a= Array();
    
    foreach ($array as $el) {
      $domain = new Domain();
      $domain->setID($el[0]);
      $domain->setName($el[1]);
      $domain->setServerName($el[2]);
      $domain->setServerIP($el[3]);
      $domain->setServerPort($el[4]); 
      $domain->setServerAdmin($el[5]);
      $domain->setAlias($el[6]); 
      $domain->setOther(stripslashes($el[7]));
      $domain->setModSecConf($el[8]); 
      $domain->setActive($el[9]);
      $domain->setModSecConfName($el[12]); 
      $domain->setFilled(true);
      $domains_a[]= $domain;
    }
    return $domains_a;
  }

  public function getDomainById($id) {
    $domains_a = $this->getAllDomains("WHERE D.DomainID=$id");
    return $domains_a[0];
  }

  public function setDomainValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE domain SET Validity=?
                               WHERE DomainID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function addDomain($domain) {

    $datatypes = array('text','text','text','integer','text',
		       'text','text','integer',
		       'integer','text','integer');

    $sth = $this->dbh->prepare('INSERT INTO domain VALUES (
                                NULL,
                                :DomainName,
                                :ServerName, :ServerIP, :ServerPort,
                                :ServerAdmin, :Alias, :Other, :ConfID,
                                :Validity, :Updated, :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'DomainName'  =>$sth->escape($domain->getName()),
		  'ServerName'  =>$domain->getServerName(),
		  'ServerIP'    =>$domain->getServerIP(),
		  'ServerPort'  =>$domain->getServerPort(), 
		  'ServerAdmin' =>$domain->getServerAdmin(),
		  'Alias'       =>$domain->getAlias(),
		  'Other'       =>$sth->escape($domain->getOther()),
		  'ConfID'      =>$domain->getModSecConf(),
		  'Validity'    =>$domain->isActive(),
		  'Updated'     =>'NOW()', 
		  'Deleted'     =>0                       
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function editDomain($domain) {

    $datatypes = array('text','text','text','integer','text',
		       'text','text','integer','integer','integer');

    $sth = $this->dbh->prepare('UPDATE domain SET
                               DomainName=?, ServerName=?,
                               ServerIP=?, ServerPort=?,
                               ServerAdmin=?, Alias=?,
                               Other=?, ConfID=?, Validity=?,
                               Updated=NOW()
                               WHERE DomainID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($domain->getName(),
		  $domain->getServerName(),
		  $domain->getServerIP(),
		  $domain->getServerPort(), 
		  $domain->getServerAdmin(),
		  $domain->getAlias(),
		  $domain->getOther(),
		  $domain->getModSecConf(),
		  $domain->isActive(),
		  $domain->getId()                    
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function deleteDomain($domainid) {
    
    $sth = $this->dbh->prepare('DELETE FROM domain WHERE DomainID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = & $sth->execute($domainid);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getAllModSecConfigurations($where='') {
    
    $str = "SELECT C.ConfID,C.ConfName,C.Description,C.Validity
            FROM modsec_conf C $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $msec_conf_a= Array();
    
    foreach ($array as $el) {
      $msec_conf = new ModSecConfiguration();
      $msec_conf->setID($el[0]);
      $msec_conf->setName($el[1]);
      $msec_conf->setDescription($el[2]); 
      $msec_conf->setActive($el[3]);
      $msec_conf->setFilled(true);
      $msec_conf_a[]= $msec_conf;
    }
    return $msec_conf_a;
  }

  public function getModSecConfById($id) {

    $msec_conf_a = $this->getAllModSecConfigurations("WHERE C.ConfID=$id");

    $str = "SELECT CO.OptionID,O.OptionName, CO.OptionValue,O.DefaultValue
            FROM conf_option CO
            INNER JOIN modsec_option O ON (O.OptionID=CO.OptionID)
            WHERE CO.ConfID=$id";

    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
   
    foreach ($array as $option) {
      $method ="set$option[1]";

      //$method = new ReflectionMethod('ModSecConfiguration', $option[1]);
      //$method->invoke($option[0])
      if (in_array($method, get_class_methods($msec_conf_a[0]))) {
	$msec_conf_a[0]->$method($option[2]);
      }
    }

    return $msec_conf_a[0];
  }

  public function setModSecConfValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE modsec_conf SET Validity=?
                               WHERE ConfID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }


  public function addModSecConfiguration($msec_conf) {

    $datatypes = array('text','text','integer','text','integer');

    $sth = $this->dbh->prepare('INSERT INTO modsec_conf VALUES (
                                NULL,
                                :ConfName, :Description,
                                :Validity, :Updated, :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'ConfName'    =>$msec_conf->getName(),
		  'Description' =>$msec_conf->getDescription(),
		  'Validity'    =>$msec_conf->isActive(),
		  'Updated'     =>'NOW()', 
		  'Deleted'     =>0                       
		  );
    
    $affected       = & $sth->execute($data);
    $last_insert_id = $this->dbh->LastInsertID('modsec_conf','ConfID');


    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();

    $result = $this->dbh->query("SELECT OptionID,OptionName
                                FROM modsec_option");
    $directive_arr = $result->fetchAll();

    $data_type_conf = array('text','integer','integer');

    $sth_upd_conf = $this->dbh->prepare('REPLACE INTO conf_option SET OptionValue=?,
                                        OptionID=?, ConfID=?', 
					$data_type_conf, MDB2_PREPARE_MANIP);
    foreach ($directive_arr as $option) {

      $method = "get$option[1]";
      
      $data = array($msec_conf->$method(),
		    $option[0],
		    $last_insert_id                    
		    );
      $affected = &$sth_upd_conf->execute($data);
    }
  }

  public function deleteModSecConfiguration($confid) {
    
    $sth = $this->dbh->prepare('DELETE FROM modsec_conf WHERE ConfID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = &$sth->execute($confid);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();

    $sth_detail = $this->dbh->prepare('DELETE FROM  conf_option
                                       WHERE ConfID = ?', 
				      'integer', MDB2_PREPARE_MANIP);
    
    $affected_detail = &$sth_detail->execute($confid);
    
    if (PEAR::isError($affected_detail)) {
      echo ($affected_detail->getMessage().' - '.$affected_detail->getUserinfo());
      exit();
    }
    $sth_detail->free();


  }

  public function editModSecConfiguration($modsec_conf) {

    $datatypes = array('text','text','integer','integer');

    $sth = $this->dbh->prepare('UPDATE modsec_conf SET
                               ConfName=?, Description=?,
                               Validity=?, Updated=NOW()
                               WHERE ConfID=?', 
			       $datatypes, MDB2_PREPARE_MANIP);

    $data = array($modsec_conf->getName(),
		  $modsec_conf->getDescription(),
		  $modsec_conf->isActive(),
		  $modsec_conf->getId()                    
		  );
    
    $affected = &$sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();

    $result = $this->dbh->query("SELECT OptionID,OptionName
                                FROM modsec_option");
    $directive_arr = $result->fetchAll(); 

    $data_type_conf = array('text','integer','integer');

    $sth_upd_conf = $this->dbh->prepare('REPLACE INTO conf_option SET OptionValue=?,
                                        OptionID=?, ConfID=?', 
					$data_type_conf, MDB2_PREPARE_MANIP);
    foreach ($directive_arr as $option) {

      $method = "get$option[1]";
      
      $data = array($modsec_conf->$method(),
		    $option[0],
		    $modsec_conf->getId()                    
		    );
      $affected = &$sth_upd_conf->execute($data);
    }
  }

  public function getModSecDirectives() {

    $str = "SELECT OptionID,OptionName,OptionValue,DefaultValue
            FROM modsec_option";

    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();

    $directives = Array();

    $msec_directive = new Resource();

    foreach ($array as $option) {

      $method = "set$option[1]";

      if (in_array($method, get_class_methods($msec_directive))) {
	$msec_directive->$method($option[2]);
      }
    }

    return $msec_directive;
  }

  public function getAllAuditLogs($where='') {

    $str = "SELECT AL.AuditLogID,AL.AuditLogUniqueID,AL.AuditLogDate,
            AL.AuditLogTime,AL.SourceIP,AL.SourcePort,AL.DestinationIP,
            AL.DestinationPort,AL.Referer,AL.UserAgent,AL.HttpMethod,
            AL.Uri,AL.QueryString,AL.HttpProtocol,AL.Host,AL.HttpStatusCode,
            AL.RequestContentType,AL.ResponseContentType,AL.WebAppId,
            AL.Blocked,AL.Duration,A.GeneralMsg,A.TechnicalMsg,A.RuleID,
            A.Rev,A.Msg,A.Severity,A.category,A.Status,A.Resolution
            FROM audit_log AL
            INNER JOIN alerts A ON (A.AuditLogUniqueID=AL.AuditLogUniqueID)
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $alog_a= Array();
    
    foreach ($array as $alog) {
      $audit_log = new Report();
      $audit_log->setAuditLogId($alog[0]);
      $audit_log->setAuditLogUniqueId($alog[1]);
      $audit_log->setAuditLogDate($alog[2]); 
      $audit_log->setAuditLogTime($alog[3]); 
      $audit_log->setSourceIP($alog[4]); 
      $audit_log->setSourcePort($alog[5]); 
      $audit_log->setDestinationIP($alog[6]); 
      $audit_log->setDestinationPort($alog[7]); 
      $audit_log->setReferer($alog[8]); 
      $audit_log->setUserAgent($alog[9]); 
      $audit_log->setHttpMethod($alog[10]); 
      $audit_log->setUri($alog[11]); 
      $audit_log->setQueryString($alog[12]); 
      $audit_log->setHttpProtocol($alog[13]); 
      $audit_log->setHost($alog[14]); 
      $audit_log->setHttpStatusCode($alog[15]); 
      $audit_log->setRequestContentType($alog[16]); 
      $audit_log->setResponseContentType($alog[17]); 
      $audit_log->setwebAppId($alog[18]); 
      $audit_log->setBlocked($alog[19]); 
      $audit_log->setDuration($alog[20]); 
      $audit_log->setGeneralMsg($alog[21]); 
      $audit_log->setTechnicalMsg($alog[22]); 
      $audit_log->setRuleID($alog[23]); 
      $audit_log->setRev($alog[24]); 
      $audit_log->setMsg($alog[25]); 
      $audit_log->setSeverity($alog[26]); 
      $audit_log->setCategory($alog[27]); 
      $audit_log->setStatus($alog[28]); 
      $audit_log->setResolution($alog[29]); 
      $audit_log->setFilled(true);
      $alog_a[]= $audit_log;
    }
    return $alog_a;
  }


  public function countAllAuditLogs($where='') {

    $str = "SELECT COUNT(AL.AuditLogID) FROM audit_log AL
            INNER JOIN alerts A ON (A.AuditLogUniqueID=AL.AuditLogUniqueID)
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $count = $result->fetchRow(); 
    $result->free();
    
    return $count[0];
  }

  public function getAuditLogById($alog_id='') {
    $alog = $this->getAllAuditLogs(" AND AL.AuditLogID=$alog_id");    
    return $alog[0];
  }

  public function getSeverityDistribution($where) {

    $str = "SELECT A.Severity+1,Count(A.AuditLogUniqueID)
            FROM alerts A
            INNER JOIN audit_log AL ON (AL.AuditLogUniqueID=A.AuditLogUniqueID)
            WHERE 1 $where
            GROUP BY A.Severity";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $severities = $result->fetchAll(); 
    $result->free();

    $severity = Array();

    foreach ($severities as $s) {

      $severity["$s[0]"] = $s[1];
    }

    return $severity;
  }

  public function getCategoryDistribution($where) {

    $str = "SELECT A.Category+1,Count(A.AuditLogUniqueID)
            FROM alerts A
            INNER JOIN audit_log AL ON (AL.AuditLogUniqueID=A.AuditLogUniqueID)
            WHERE 1 $where
            GROUP BY A.Category";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $categories = $result->fetchAll(); 
    $result->free();

    $category = Array();

    foreach ($categories as $s) {

      $category["$s[0]"] = $s[1];
    }

    return $category;
  }

  public function getMonthlyRequest() {

    $str = "SELECT AL.AuditLogDate,Count(AL.AuditLogID)
            FROM audit_log AL
            WHERE AL.AuditLogDate <= CURDATE() AND
            AL.AuditLogDate >= DATE_ADD(CURDATE(), INTERVAL -1 MONTH)
            GROUP BY AL.AuditLogDate
            ORDER BY AL.AuditLogDate ASC";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $requests = $result->fetchAll(); 
    $result->free();

    $request = Array();
    $month   = Array();

    for ($i=30;$i>=0;$i--) {
      $month[] = date("Y-m-d", strtotime("-$i day"));
    }

    foreach ($month as $m) {
      foreach ($requests as $s) {
	if(!$request["$m"]) {
	  ($m == $s[0]) ? $request["$m"] = $s[1] : $request["$m"] = 0;
	}
      }
    }

    return $request;
  }

  public function getSourceIpRecords($where='',$wlimit='') {

    $str = "SELECT AL.SourceIP,COUNT(AL.AuditLogID) AS SCount,
            IF(IBL.IP,0,1) FROM audit_log AL
            INNER JOIN alerts A ON (A.AuditLogUniqueID=AL.AuditLogUniqueID)
            LEFT JOIN ip_block_list IBL
            ON (CONVERT(IBL.IP USING utf8)=CONVERT(AL.SourceIP USING utf8))
            WHERE 1 $where
            GROUP BY AL.SourceIP
            ORDER BY SCount DESC $wlimit";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $alog_sip= Array();
    
    foreach ($array as $alog) {
      $audit_log = new Report();
      $audit_log->setSourceIP($alog[0]); 
      $audit_log->setSourceIpCount($alog[1]); 
      $audit_log->setSourceIpIsBlocked($alog[2]); 
      $audit_log->setFilled(true);
      $alog_sip[]= $audit_log;
    }
    return $alog_sip;
  }

  public function countSourceIpRecords($where='') {

    $str = "SELECT COUNT(DISTINCT(AL.SourceIP)) FROM audit_log AL
            INNER JOIN alerts A ON (A.AuditLogUniqueID=AL.AuditLogUniqueID)
            LEFT JOIN ip_block_list IBL ON (IBL.IP LIKE '%AL.SourceIP%')
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $count = $result->fetchRow(); 
    $result->free();
    
    return $count[0];
  }

  public function getSourceIPDetail($source_ip='') {

    $str = "SELECT AL.AuditLogDate,Count(AL.AuditLogID)
            FROM audit_log AL
            WHERE AL.AuditLogDate <= CURDATE() AND
            AL.AuditLogDate >= DATE_ADD(CURDATE(), INTERVAL -1 WEEK)
            AND AL.SourceIP='$source_ip'
            GROUP BY AL.AuditLogDate
            ORDER BY AL.AuditLogDate ASC";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }

    $requests = $result->fetchAll(); 
    $result->free();

    $request = Array();
    $week    = Array();

    for ($i=7;$i>=1;$i--) {
      $week[] = date("Y-m-d", strtotime("-$i day"));
    }

    foreach ($week as $w) {
      foreach ($requests as $s) {
	if(!$request["$w"]) {
	  ($w == $s[0]) ? $request["$w"] = $s[1] : $request["$w"] = 0;
	}
      }
    }

    return $request;
  }

  public function countRuleRecords($where='') {

    $str = "SELECT COUNT(DISTINCT(A.RuleID))
            FROM audit_log AL
            INNER JOIN alerts A ON (A.AuditLogUniqueID=AL.AuditLogUniqueID)
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $count = $result->fetchRow(); 
    $result->free();
    
    return $count[0];
  }

  public function getRuleRecords($where='',$wlimit='') {

    $str = "SELECT A.RuleID,COUNT(A.AuditLogUniqueID) AS AuditCount
            FROM audit_log AL
            INNER JOIN alerts A ON (A.AuditLogUniqueID=AL.AuditLogUniqueID)
            WHERE 1 $where
            GROUP BY A.RuleID
            ORDER BY AuditCount DESC $wlimit";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $alog_ruleid= Array();
    
    foreach ($array as $alog) {
      $audit_log = new Report();
      $audit_log->setRuleID($alog[0]); 
      $audit_log->setRuleIDCount($alog[1]); 
      $audit_log->setFilled(true);
      $alog_ruleid[]= $audit_log;
    }
    return $alog_ruleid;
  }

  public function getRuleById($rule_id='') {

    $str = "SELECT Rule FROM rules WHERE RuleID=$rule_id";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $rule = $result->fetchRow(); 
    $result->free();
    
    return $rule[0];
  }

  public function setIpBlock($ip,$validity) {

    if ($validity) {
      $datatypes = array('text','text');

      $sth = $this->dbh->prepare('REPLACE INTO ip_block_list VALUES (
                                  :IP,
                                  :Created)', 
				 $datatypes, MDB2_PREPARE_MANIP);

      $data = array('IP'        =>$ip,
		    'Created'   =>'NOW()');
      
      $affected = & $sth->execute($data);

      if (PEAR::isError($affected)) {
	echo ($affected->getMessage().' - '.$affected->getUserinfo());
	exit();
      }
      $sth->free();
    }
    else {
      $sth = $this->dbh->prepare('DELETE FROM ip_block_list WHERE IP = ?', 
				 'text', MDB2_PREPARE_MANIP);
    
      $affected = & $sth->execute($ip);
    
      if (PEAR::isError($affected)) {
	echo ($affected->getMessage().' - '.$affected->getUserinfo());
	exit();
      }
      $sth->free();
    }
  }

  public function sourceIPIsBlocked($ip) {

    $str = "SELECT IP FROM ip_block_list WHERE IP='$ip'";

    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }

    $is_blocked = $result->fetchRow(); 
    $result->free();
    
    return $is_blocked[0];
  }

  public function getAllRuleFiles($where='') {
    
    $count_str = "SELECT RF.RuleFileID,COUNT(R.RecordID),COUNT(DISTINCT(RDF.DataFileID)),
                  RF.RuleFileName,RF.Deleted from rule_files RF
                  LEFT JOIN rules R ON (RF.RuleFileID=R.RuleFileID AND R.Deleted=0)
                  LEFT JOIN rule_data_files RDF ON (RDF.DataFileID=RF.RuleFileID AND RDF.Deleted=0)
                  $where GROUP BY RF.RuleFileID";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $rule_files_a = Array();
    
    foreach ($array as $rf) {
      $rule_file = new Rule();
      $rule_file->setRuleFileID($rf[0]);
      $rule_file->setRuleFileRuleCount($rf[1]);
      $rule_file->setRuleFileRuleDataFileCount($rf[2]);
      $rule_file->setRuleFileName($rf[3]);
      $rule_file->setRuleFileActive($rf[4]);
      $rule_files_a[]= $rule_file;
    }
    return $rule_files_a;
  }

  public function getRuleFilesById($id) {
    $rule_files_a = $this->getAllRuleFiles("WHERE RF.RuleFileID=$id");
    return $rule_files_a[0];
  }

  public function setRuleFileValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE rule_files SET Deleted=?
                               WHERE RuleFileID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function addRuleFiles($rule_file) {

    $datatypes = array('text','integer');

    $sth = $this->dbh->prepare('INSERT INTO rule_files VALUES (
                                NULL,
                                :RuleFileName,
                                :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'RuleFileName' =>$rule_file->getRuleFileName(),
		  'Deleted'      =>$rule_file->getRuleFileActive(),
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function editRuleFiles($rule_file) {

    $datatypes = array('text','integer','integer');

    $sth = $this->dbh->prepare('UPDATE rule_files SET
                               RuleFileName=?, Deleted=?
                               WHERE RuleFileID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($rule_file->getRuleFileName(),
		  $rule_file->getRuleFileActive(),
		  $rule_file->getRuleFileID()                    
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function deleteRuleFiles($rule_file_id) {
    
    $sth = $this->dbh->prepare('DELETE FROM rule_files WHERE RuleFileID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = & $sth->execute($rule_file_id);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getAllRules($where='',$wlimit='') {

    $count_str = "SELECT R.RecordID,R.RuleID,R.ParrentRuleID,R.Information,
                  R.Rule,R.DefaultValue,R.Deleted,
                  RF.RuleFileName,RDF.DataFileName,R.RuleFileID from rules R
                  LEFT JOIN rule_files RF ON (RF.RuleFileID=R.RuleFileID)
                  LEFT JOIN rule_data_files RDF ON (RDF.DataFileID=RF.RuleFileID)
                  WHERE 1 $where ORDER BY R.RecordID DESC $wlimit";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $rules_a = Array();
    
    foreach ($array as $r) {
      $rule = new Rule();
      $rule->setRuleRecordID($r[0]);
      $rule->setRuleID($r[1]);
      $rule->setRuleParrentRuleID($r[2]);
      $rule->setRuleInformation($r[3]);
      $rule->setRule($r[4]);
      $rule->setRuleShort(substr($r[4],0,55));
      $rule->setRuleDefaultValue($r[5]);
      $rule->setRuleFileName($r[7]);
      $rule->setRuleFileID($r[9]);
      $rule->setDataFileName($r[8]);
      $rule->setRuleActive($r[6]);
      $rules_a[]= $rule;
    }
    return $rules_a;
  }


  public function countRulesRecord($where='') {

    $str = "SELECT COUNT(R.RecordID) FROM rules R
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $count = $result->fetchRow(); 
    $result->free();
    
    return $count[0];
  }

  public function setRuleValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE rules SET Deleted=?
                               WHERE RecordID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function addRule($rule) {

    $datatypes = array('text','text','integer','text',
		       'text','integer','integer');

    $sth = $this->dbh->prepare('INSERT INTO rules VALUES (
                                NULL,
                                :RuleID,
                                :ParrentRuleID,
                                :RuleFileID,
                                :Information,
                                :Rule,
                                :DefaultValue,
                                :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'RuleID'        => $rule->getRuleID(),
		  'ParrentRuleID' => $rule->getRuleParrentRuleID(),
		  'RuleFileID'    => $rule->getRuleFileID(),
		  'Information'   => $rule->getRuleInformation(),
		  'Rule'          => $rule->getRule(),
		  'DefaultValue'  => $rule->getRuleDefaultValue(),
		  'Deleted'       => $rule->getRuleActive(),
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getRulesById($id) {
    $rule_a = $this->getAllRules("AND R.RecordID=$id");
    return $rule_a[0];
  }

  public function deleteRule($rule_rid) {
    
    $sth = $this->dbh->prepare('DELETE FROM rules WHERE RecordID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = & $sth->execute($rule_rid);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function editRule($rule) {

    $datatypes = array('text','text','integer','text','text',
		       'integer','integer','integer');

    $sth = $this->dbh->prepare('UPDATE rules SET
                               RuleID=?, ParrentRuleID=?,
                               RuleFileID=?, Information=?,
                               Rule=?, DefaultValue=?, Deleted=?
                               WHERE RecordID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($rule->getRuleID(),
		  $rule->getRuleParrentRuleID(),
		  $rule->getRuleFileID(),
		  $rule->getRuleInformation(),
		  $rule->getRule(),
		  $rule->getRuleDefaultValue(),
		  $rule->getRuleActive(),
		  $rule->getRuleRecordID()
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getAllRuleDataFiles($where='') {
    
    $count_str = "SELECT RDF.DataFileID,COUNT(RD.RuleDataID),
                  RDF.DataFileName,RF.RuleFileName,RDF.Deleted from rule_data_files RDF
                  LEFT JOIN rule_files RF ON (RF.RuleFileID=RDF.RuleFileID AND RF.Deleted=0)
                  LEFT JOIN rule_data RD ON (RD.DataFileID=RDF.DataFileID AND RD.Deleted=0)
                  WHERE 1 $where GROUP BY RDF.DataFileID";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $rule_dfiles_a = Array();
    
    foreach ($array as $rd) {
      $rule_dfile = new Rule();
      $rule_dfile->setDataFileID($rd[0]);
      $rule_dfile->setRuleDataCount($rd[1]);
      $rule_dfile->setDataFileName($rd[2]);
      $rule_dfile->setRuleFileName($rd[3]);
      $rule_dfile->setDataFileActive($rd[4]);
      $rule_dfiles_a[]= $rule_dfile;
    }
    return $rule_dfiles_a;
  }

  public function setDataFileValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE rule_data_files SET Deleted=?
                               WHERE DataFileID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getDataFilesById($id) {
    $rule_dfiles_a = $this->getAllRuleDataFiles("AND RDF.DataFileID=$id");
    return $rule_dfiles_a[0];
  }

  public function addRuleDataFiles($rule_dfile) {

    $datatypes = array('integer','text','integer');

    $sth = $this->dbh->prepare('INSERT INTO rule_data_files VALUES (
                                NULL,
                                :RuleFileID,
                                :DataFileName,
                                :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'RuleFileID'   =>$rule_dfile->getRuleFileID(),
		  'DataFileName' =>$rule_dfile->getDataFileName(),
		  'Deleted'      =>$rule_dfile->getDataFileActive(),
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function editRuleDataFiles($rule_dfile) {

    $datatypes = array('integer','text','integer','integer');

    $sth = $this->dbh->prepare('UPDATE rule_data_files SET
                               RuleFileID=?, DataFileName=?,
                               Deleted=?
                               WHERE DataFileID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($rule_dfile->getRuleFileID(),
		  $rule_dfile->getDataFileName(),
		  $rule_dfile->getDataFileActive(),                
		  $rule_dfile->getDataFileID()
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function deleteRuleDataFiles($rule_dfile_id) {
    
    $sth = $this->dbh->prepare('DELETE FROM rule_data_files WHERE DataFileID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = & $sth->execute($rule_dfile_id);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function countRuleDatasRecord($where='') {

    $str = "SELECT COUNT(RD.RuleDataID) FROM rule_data RD
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $count = $result->fetchRow(); 
    $result->free();
    
    return $count[0];
  }

  public function getAllRuleDatas($where='',$wlimit='') {

    $count_str = "SELECT RD.RuleDataID,RD.DataFileID,RDF.DataFileName,
                  RD.RuleData,RD.Deleted
                  FROM rule_data RD
                  LEFT JOIN rule_data_files RDF ON (RDF.DataFileID=RD.DataFileID)
                  WHERE 1 $where ORDER BY RD.RuleDataID DESC $wlimit";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $rules_da = Array();
    
    foreach ($array as $rd) {
      $rule_data = new Rule();
      $rule_data->setRuleDataID($rd[0]);
      $rule_data->setDataFileID($rd[1]);
      $rule_data->setDataFileName($rd[2]);
      $rule_data->setRuleData($rd[3]);
      $rule_data->setRuleDataActive($rd[4]);
      $rules_da[]= $rule_data;
    }
    return $rules_da;
  }

  public function setDataValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE rule_data SET Deleted=?
                               WHERE RuleDataID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getRuleDatasById($id) {
    $rule_da = $this->getAllRuleDatas(" AND RD.RuleDataID=$id");
    return $rule_da[0];
  }

  public function addRuleDatas($rule_data) {

    $datatypes = array('integer','text','integer');

    $sth = $this->dbh->prepare('INSERT INTO rule_data VALUES (
                                NULL,
                                :DataFileID,
                                :RuleData,
                                :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'DataFileID' =>$rule_data->getDataFileID(),
		  'RuleData'   =>$rule_data->getRuleData(),
		  'Deleted'    =>$rule_data->getRuleDataActive(),
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function editRuleDatas($rule_data) {

    $datatypes = array('integer','text','integer','integer');

    $sth = $this->dbh->prepare('UPDATE rule_data SET
                               DataFileID=?, RuleData=?, Deleted=?
                               WHERE RuleDataID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($rule_data->getDataFileID(),
		  $rule_data->getRuleData(),
		  $rule_data->getRuleDataActive(),
		  $rule_data->getRuleDataID()                  
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function deleteRuleDatas($rule_dfile_id) {
    
    $sth = $this->dbh->prepare('DELETE FROM rule_data WHERE RuleDataID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = & $sth->execute($rule_dfile_id);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function countWhiteListRecord($where='') {

    $str = "SELECT COUNT(WL.RecordID) FROM white_list WL
            WHERE 1 $where";
    $result    = $this->dbh->query($str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $count = $result->fetchRow(); 
    $result->free();
    
    return $count[0];
  }

  public function getAllWhiteLists($where='',$wlimit='') {

    $count_str = "SELECT WL.RecordID,WL.WhiteListType,
                  WL.WhiteListData,WL.Deleted
                  FROM white_list WL
                  WHERE 1 $where ORDER BY WL.RecordID DESC $wlimit";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();
    $white_lists = Array();
    
    foreach ($array as $wl) {
      $white_list = new Rule();
      $white_list->setWhiteListRecordID($wl[0]);
      $white_list->setWhiteListType($wl[1]);
      $white_list->setWhiteListData($wl[2]);
      $white_list->setWhiteListActive($wl[3]);
      $white_lists[]= $white_list;
    }
    return $white_lists;
  }

  public function getwhiteListById($id) {
    $white_list = $this->getAllWhiteLists(" AND WL.RecordID=$id");
    return $white_list[0];
  }

  public function addWhiteLists($white_list) {

    $datatypes = array('integer','text','integer');

    $sth = $this->dbh->prepare('INSERT INTO white_list VALUES (
                                NULL,
                                :WhiteListType,
                                :WhiteListData,
                                :Deleted)', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array(
		  'WhiteListType' =>$white_list->getWhiteListType(),
		  'WhiteListData' =>$white_list->getWhiteListData(),
		  'Deleted'       =>$white_list->getWhiteListActive(),
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function deleteWhiteLists($white_list_id) {
    
    $sth = $this->dbh->prepare('DELETE FROM white_list WHERE RecordID = ?', 
			       'integer', MDB2_PREPARE_MANIP);
    
    $affected = & $sth->execute($white_list_id);
    
    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function editWhiteLists($white_list) {

    $datatypes = array('integer','text','integer','integer');

    $sth = $this->dbh->prepare('UPDATE white_list SET
                               WhiteListType=?, WhiteListData=?,
                               Deleted=? WHERE RecordID=?', 
			       $datatypes, MDB2_PREPARE_MANIP);
    
    $data = array($white_list->getWhiteListType(),
		  $white_list->getWhiteListData(),
		  $white_list->getWhiteListActive(),
		  $white_list->getWhiteListRecordID()               
		  );
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }


  public function setWhiteListValidity($id,$validity) {

    $datatypes = array('integer','integer');

    $sth = $this->dbh->prepare('UPDATE white_list SET Deleted=?
                               WHERE RecordID=?', 
                                $datatypes, MDB2_PREPARE_MANIP);

    $data = array($validity,$id);
    
    $affected = & $sth->execute($data);

    if (PEAR::isError($affected)) {
      echo ($affected->getMessage().' - '.$affected->getUserinfo());
      exit();
    }
    $sth->free();
  }

  public function getAllManagements() {
    
    $count_str = "SELECT * from management";
    $result    = $this->dbh->query($count_str); 
    if (PEAR::isError($result)) {
      echo ($result->getMessage().' - '.$result->getUserinfo());
      exit();
    }
    $array = $result->fetchAll(); 
    $result->free();

    foreach ($array as $el) {
      $manages[$el[0]]= $el[1];
    }
    return $manages;
  }

  public function addManagements($manages) {

    if ($manages) {      
      $this->dbh->query("TRUNCATE management");

      $sth_replace_manage = $this->dbh->prepare('REPLACE INTO management VALUES
                                              (?,NOW())', 
						'integer', MDB2_PREPARE_MANIP);
      foreach ($manages as $manage) {
	$data = array($manage);
	$affected = &$sth_replace_manage->execute($data);
	
	if (PEAR::isError($affected)) {
	  echo ($affected->getMessage().' - '.$affected->getUserinfo());
	  exit();
	}
      }
      $sth_replace_manage->free();
    }
  }

}

?>

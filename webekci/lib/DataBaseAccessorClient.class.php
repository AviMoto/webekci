<?php
#
# DataBaseAccessorClient.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 11.05.2008, Christophe Vandeplas
#
# Database Accessor Client class
#
# Release Notes:
#

require_once 'AbstractBaseComponent.class.php';
require_once 'DB.class.php';

class DataBaseAccessorClient extends AbstractBaseComponent
{

    public $dbh;

    public function DataBaseAccessorClient()
    {
        $this->AbstractBaseComponent();
        $this->dbh=&DBConnection::getSingleton();
    }

    private $filled     = false;
    
    public function isFilled() {
        return $filled;
    }
    public function setFilled( $filled ) {
        $this->filled = $filled;
    }
}
?>

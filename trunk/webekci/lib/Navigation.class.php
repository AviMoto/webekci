<?php
#
# Navigation.class.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 13.04.2009, Bunyamin Demir
#
# Report class for webekci
#
# Release Notes:
#


require_once 'Report.class.php';

class Navigation extends Report
{
  private $start  = 1;
  private $rows   = 50;
  private $begin  = 1;
  private $first  = 0;
  private $where  = '';
  private $last   = '';


  public function Navigation($start=0,$rows=0,$begin=0,$first=0,$total_row) {
    parent::Report();

    if ($begin) {
      $this->first = $rows * ($begin-1);
      $this->begin = $begin;

      if (isset($start)) {
	$this->start = $begin;
      }
    }

    if ($rows) {
      $this->rows = $rows;
    }

    if ($this->first > $total_row) { $this->first = 0; }
    $this->last = $this->first + $this->rows - 1;
    if ($this->last >= $total_row) { $this->last = $total_row - 1; }

    if ($total_row > $rows) {
      $last_row = ($this->last - $this->first + 1);
      $this->where = " LIMIT $this->first ,$last_row";
    }
  }

  public function getNavigationStart() {
    return $this->start;
  }

  public function getNavigationRows() {
    return $this->rows;
  }

  public function getNavigationBegin() {
    return $this->begin;
  }

  public function getNavigationFirst() {
    return $this->first;
  }

  public function getNavigationWhere() {
    return $this->where;
  }
}
?>

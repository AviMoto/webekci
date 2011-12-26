<?php
#
# index.php
# $Id: $
#
# Copyright ..........
# OWASP Foundation bla bla bla...
# All rights reserved.
#
# Version: 1.0
# Created: 07.04.2009, Bunyamin Demir
#
# Index page
#
# Release Notes:
#

require_once("lib/DB.class.php");
require_once("lib/Template.class.php");
require_once("lib/Report.class.php");
require_once("lib/Resource.class.php");
require_once("lib/Filter.class.php");
require_once("lib/php-ofc-library/open-flash-chart.php"); 


if ($_GET['graph_filter']) {
  $plist = explode(";", $_GET['graph_filter']);

  for ($i=0; $i<=count($plist); $i++) {
    list($k,$v) = explode("=", $plist[$i]);
    $param[$k] = $v;
  }
}

list($filter,$fwhere) = Filter::getFilter($param,'');

foreach ($fwhere as $w) {
  $where .= $w;
}

$requests = &Report::getSourceIpRecords($where,'LIMIT 25');

$request = Array();
$month   = Array();
$max_rec = 0;

  foreach ($requests as $s) {
    if ($max_rec < intval($s->getSourceIpCount())) { 
      $max_rec = intval($s->getSourceIpCount());
    }

    $month[]   = $s->getSourceIP();
    $request[] = intval($s->getSourceIpCount());
  }

$chart = new open_flash_chart();
$title = new title('Source IP Distribution');
$title->set_style( "{font-size: 20px; color: #A2ACBA; text-align: center;}" );
$chart->set_title( $title );
$chart->set_bg_colour('#FFFFFF');

$area = new area();
$area->set_colour( '#5B56B6' );
$area->set_values( $request );
$chart->add_element( $area );

$x_labels = new x_axis_labels();
$x_labels->set_vertical();
$x_labels->set_colour( '#A2ACBA' );
$x_labels->set_labels( $month );

$x = new x_axis();
$x->set_colour( '#A2ACBA' );
$x->set_grid_colour( '#D7E4A3' );
$x->set_offset( false );
$x->set_steps(4);
$x->set_labels( $x_labels );

$chart->set_x_axis( $x );

$x_legend = new x_legend( date("D M d Y") );
$x_legend->set_style( '{font-size: 20px; color: #778877}' );
$chart->set_x_legend( $x_legend );

//
// remove this when the Y Axis is smarter
//
$y = new y_axis();
$y->set_range( 0, $max_rec, ceil($max_rec/10) );
$chart->add_y_axis( $y );

echo $chart->toPrettyString();

?>
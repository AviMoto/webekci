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

$rs = new Resource();

$RS=$rs->enum(array('LIST_CATEGORY'));

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

$categories = &Report::getCategoryDistribution($where);
$category   = Array();

foreach (array_keys($RS['LIST_CATEGORY']) as $s) {
  if ($categories[$s] && $s) {
    $category[] = new pie_value(intval($categories[$s])
				, $RS['LIST_CATEGORY'][intval($s)]." ($categories[$s])");
  }
}

#$title = new title('Category Distribution');

$pie = new pie();
$pie->set_alpha(0.7);
$pie->set_start_angle(35);
$pie->add_animation(new pie_fade());
$pie->set_tooltip('#val# of #total#<br>#percent# of 100%');
$pie->set_colours(array('#FF6633',
			'#EB0000',
			'#2E00B8',
			'#2EB800',
			'#7AFFFF',
			'#7500EB',
			'#FF0080',
			'#85FF0A',
			) );

$pie->set_values($category);

$chart = new open_flash_chart();
#$chart->set_title($title);
$chart->add_element($pie);
$chart->set_bg_colour('#FFFFFF');

$chart->x_axis = null;

echo $chart->toPrettyString();
?>
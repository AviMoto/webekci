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

require_once("../lib/DB.class.php");
require_once("../lib/Template.class.php");
require_once("../lib/Report.class.php");
require_once("../lib/Resource.class.php");
require_once("../lib/php-ofc-library/open-flash-chart.php"); 

$rs = new Resource();

$RS=$rs->enum(array('LIST_SEVERITY'));

$filters['severity'] = array_values($RS['LIST_SEVERITY']);

$title = new title('Category Distribution');

$pie = new pie();
$pie->set_alpha(0.7);
$pie->set_start_angle(35);
$pie->add_animation(new pie_fade());
$pie->set_tooltip('#val# of #total#<br>#percent# of 100%');
$pie->set_colours(array('#E60039',
			'#00E6AC',
			'#1C9E05',
			'#FF368D',
			'#7547FF') );
$pie->set_values(array(new pie_value(50,"Critical (123)"),
		       new pie_value(10 ,"Alert (33)"),
		       new pie_value(13,"Error (463)"),
		       new pie_value(17 ,"Warning (46)"),
		       new pie_value(10, "Notice (89)")));

$chart = new open_flash_chart();
$chart->set_title($title);
$chart->add_element($pie);
$chart->set_bg_colour('#FFFFFF');

$chart->x_axis = null;

echo $chart->toPrettyString();
?>
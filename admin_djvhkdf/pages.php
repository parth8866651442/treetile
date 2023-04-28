<?php

/*
$variable['type'] having Three parameter

1.text => for simple text input box
2.longtext => for textarea box
3.editor => for text editor plugin

*/

$totalsection = array();

// section start here 

$section = array();
$section['key'] = 'packing';
$section['name'] = 'Packing Details';

$variable = array();
$variable['name'] = 'packing-details';
$variable['full_text'] = 'Packing Details';
$variable['type'] = 'editor';
$section['variable'][] = $variable;


$totalsection[] = $section;

//section end here

/* section start here 

$section = array();
$section['key'] = 'export';
$section['name'] = 'Export Details';

$variable = array();
$variable['name'] = 'export-details';
$variable['full_text'] = 'Export Details';
$variable['type'] = 'editor';
$section['variable'][] = $variable;


$totalsection[] = $section;

//section end here
*/

?>



<?php
/**
 *
 *
 * @license     GPL
 *
 * @package     MythWeb
 * @subpackage
 *
 **/

// Set the desired page title
    $page_title = 'MythWeb - Error';

// Custom headers
    $headers[] = '<link rel="stylesheet" type="text/css" href="skins/errors.css">';

// Print the page header
    require 'modules/_shared/tmpl/'.tmpl.'/header.php';
?>

<div id="message">

<h2>No Modules</h2>

<p>No modules were found.</p>

</div>

<?php

// Print the page footer
    require 'modules/_shared/tmpl/'.tmpl.'/footer.php';

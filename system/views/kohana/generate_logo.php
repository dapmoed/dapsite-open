<?php

// Get the latest logo contents
$data = base64_encode(file_get_contents('http://kohanaframework.org/media/img/kohana.png'));

// Create the logo file
file_put_contents('logo.php', "<?php
/**
 * Kohana Logo, base64_encoded PNG
 * 
 * @copyright  (c) 2008-2010 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
return array('mime' => 'image/png', 'data' => '{$data}'); ?>");
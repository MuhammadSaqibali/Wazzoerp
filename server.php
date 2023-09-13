 <?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @version  7.0
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This will check if the file exists in the "public" directory.
// If not, it will route the request to the Laravel routing engine.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';

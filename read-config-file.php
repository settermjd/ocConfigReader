<?php

require_once(__DIR__ . "/config.php");

foreach ($CONFIG['apps_paths'] as $path) {
    if ($path['writable'] == true) {
       print $path['path'];
    }
}

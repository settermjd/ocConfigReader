<?php
$CONFIG = array (
    'datadirectory' => '/var/www/owncloud/data',
    'updatechecker' => 'false',
    'upgrade.disable-web' => true,
    'apps_paths' =>
        array (
            0 =>
                array (
                    'path' => '/var/www/owncloud/apps',
                    'url' => '/apps',
                    'writable' => false,
                ),
            1 =>
                array (
                    'path' => '/var/www/owncloud/custom',
                    'url' => '/custom',
                    'writable' => true,
                ),
        ),
    'dbtype' => 'mysql',
    'dbhost' => 'db:3306',
    'dbname' => 'owncloud',
    'dbuser' => 'owncloud',
    'dbpassword' => 'owncloud',
    'dbtableprefix' => 'oc_',
    'trusted_domains' =>
        array (
            0 => 'localhost',
        ),
    'passwordsalt' => '86FIfkF8vjG0MeT56WJtIu5AknRIlg',
    'secret' => 'Zqf6Cg/4JpHPyBkigydEvNXZTaXXwuNU54lRhnMO93AuRQYp',
    'overwrite.cli.url' => 'http://localhost/',
    'version' => '10.1.0.1',
    'logtimezone' => 'UTC',
    'installed' => true,
    'instanceid' => 'oc7grbp2p4td',
    'redis' => array('host' => 'redis', 'port' => 6379),
    'filelocking.enabled' => 'true',
    'memcache.local' => '\\OC\\Memcache\\APCu',
    'maintenance' => false,
    'loglevel' => '2',
    'default_language' => 'en',
    'htaccess.RewriteBase' => '/',
    'memcache.distributed' => '\\OC\\Memcache\\Redis',
    'memcache.locking' => '\\OC\\Memcache\\Redis',
);

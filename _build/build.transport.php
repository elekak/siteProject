<?php
require_once 'build.class.php';
$resolvers = array(
    'providers',
    'addons',
    'rename_htaccess',
    'remove_changelog',
    'cache_options',
    'template',
    //'tvs',
    'resources',
    'settings',
    //'set_start_year',
    'fix_translit',
    'content_type'
    //'manager_customisation'
);

$addons = array(
    array('name' => '', 'packages' => array(
            'FormIt' => '4.1.0-pl',
            'CKEditor' => '1.4.0-pl',
            'Console' => '2.2.1-beta',
            'ClientConfig' => '2.0.0-pl',
            'MIGX' => '2.12.0-pl',
            'translit' => '1.0.0-beta',
            'VersionX' => '2.1.3-pl',
            'pThumb' => '2.3.3-pl',
            'SEO Pro' => '1.3.0-pl',
            'mixedImage' => '2.0.0-beta'
        )),
    array('name' => 'modstore.pro', 'packages' => array(
            'Ace' => '1.6.5-pl',
            'pdoTools' => '2.11.2-pl',
            'AjaxForm' => '1.1.9-pl',
            'tagElementPlugin' => '1.2.4-pl1',
            'DateAgo' => '1.0.4-pl'
        )),
);

$builder = new siteBuilder('project', '1.0.4', 'rc', $resolvers, $addons);
$builder->build();

<?php

/** @var $modx modX */
if (!$modx = $object->xpdo AND !$object->xpdo instanceof modX) {
    return true;
}

/** @var $options */
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'allow_multiple_emails'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'authentication',
            'xtype'     => 'combo-boolean',
            'value'     => '0',
            'key'       => 'allow_multiple_emails',
        ), '', true, true);
        $tmp->save();
        
        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'friendly_alias_realtime'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'combo-boolean',
            'value'     => '1',
            'key'       => 'friendly_alias_realtime',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'container_suffix'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'textfield',
            'value'     => '',
            'key'       => 'container_suffix',
        ), '', true, true);
        $tmp->save();

        if (in_array('translit', $options['install_addons'])) {
            if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'friendly_alias_translit'))) {
                $tmp = $modx->newObject('modSystemSetting');
            }
            $tmp->fromArray(array(
                'namespace' => 'core',
                'area'      => 'furls',
                'xtype'     => 'textfield',
                'value'     => 'russian',
                'key'       => 'friendly_alias_translit',
            ), '', true, true);
            $tmp->save();
        }

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'friendly_alias_restrict_chars_pattern'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'textfield',
            'value'     => file_get_contents($modx->getOption('core_path') . 'components/' . strtolower($options['site_category'])  . '/docs/friendly_alias_restrict_chars_pattern.txt'),
            'key'       => 'friendly_alias_restrict_chars_pattern',
        ), '', true, true);
        $tmp->save();
        
        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'friendly_urls'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'combo-boolean',
            'value'     => '1',
            'key'       => 'friendly_urls',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'friendly_urls_strict'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'combo-boolean',
            'value'     => '1',
            'key'       => 'friendly_urls_strict',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'global_duplicate_uri_check'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'combo-boolean',
            'value'     => '1',
            'key'       => 'global_duplicate_uri_check',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'use_alias_path'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'furls',
            'xtype'     => 'combo-boolean',
            'value'     => '1',
            'key'       => 'use_alias_path',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'publish_default'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'site',
            'xtype'     => 'combo-boolean',
            'value'     => '1',
            'key'       => 'publish_default',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'resource_tree_node_name'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'manager',
            'xtype'     => 'textfield',
            'value'     => 'menutitle',
            'key'       => 'resource_tree_node_name',
        ), '', true, true);
        $tmp->save();
        
        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'resource_tree_node_tooltip'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'manager',
            'xtype'     => 'textfield',
            'value'     => 'alias',
            'key'       => 'resource_tree_node_tooltip',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'error_page'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'site',
            'xtype'     => 'textfield',
            'value'     => 4,
            'key'       => 'error_page',
        ), '', true, true);
        $tmp->save();
        
        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'site_unavailable_page'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'site',
            'xtype'     => 'textfield',
            'value'     => 5,
            'key'       => 'site_unavailable_page',
        ), '', true, true);
        $tmp->save();
        
        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'unauthorized_page'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'site',
            'xtype'     => 'textfield',
            'value'     => 3,
            'key'       => 'unauthorized_page',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'locale'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'language',
            'xtype'     => 'textfield',
            'value'     => 'ru_RU.utf8',
            'key'       => 'locale',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'cache_prefix'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'caching',
            'xtype'     => 'textfield',
            'value'     => '',
            'key'       => 'cache_prefix',
        ), '', true, true);
        $tmp->save();


        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'ace.tab_size'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'general',
            'xtype'     => 'textfield',
            'value'     => '2',
            'key'       => 'ace.tab_size',
        ), '', true, true);
        $tmp->save();

        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'ace.theme'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'core',
            'area'      => 'general',
            'xtype'     => 'textfield',
            'value'     => 'monokai',
            'key'       => 'ace.theme',
        ), '', true, true);
        $tmp->save();

        
        if (in_array('pdoTools', $options['install_addons'])) {
            if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'pdotools_fenom_parser'))) {
                $tmp = $modx->newObject('modSystemSetting');
            }
            $tmp->fromArray(array(
                'namespace' => 'pdotools',
                'area'      => 'pdotools_main',
                'xtype'     => 'combo-boolean',
                'value'     => '1',
                'key'       => 'pdotools_fenom_parser',
            ), '', true, true);
            $tmp->save();
        }


        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'seopro.fields'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'seopro',
            'area'      => 'general',
            'xtype'     => 'textfield',
            'value'     => 'longtitle:70,description:320,introtext:320,alias:2023,menutitle:2023',
            'key'       => 'seopro.fields',
        ), '', true, true);
        $tmp->save();


        break;

    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

return true;

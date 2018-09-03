<?php

/** @var $modx modX */
if (!$modx = $object->xpdo AND !$object->xpdo instanceof modX) {
    return true;
}

/** @var $options */
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        $site_start = $modx->getObject('modResource', $modx->getOption('site_start'));
        if ($site_start) {
            $site_start->set('hidemenu', true);
            $site_start->save();
        }

        if (isset($options['site_template_name']) && !empty($options['site_template_name'])) {
            $template = $modx->getObject('modTemplate', array('templatename' => $options['site_template_name']));
        }
        if ($template) {
            $templateId = $template->get('id');
        } else {
            $templateId = $modx->getOption('default_template');
        }

        /* Служебные */
        $alias = 'Служебные';
        $parent = 0;
        $templateId = 0;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 1,
            'pagetitle'    => 'Служебные',
            'menutitle'    => '',
            'isfolder'     => 1,
            'alias'        => $alias,
            'uri'          => $alias,
            'uri_override' => 0,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 1,
            'parent'       => $parent,
            'template'     => $templateId
        ));
        $resource->save();

        /* 403 */
        $alias = 'error403';
        $parent = 2;
        $templateId = 2;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 0,
            'pagetitle'    => '403',
            'longtitle'    => '',
            'isfolder'     => 1,
            'alias'        => $alias,
            'uri'          => $alias,
            'uri_override' => 0,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,
            'content'      => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "
                    Доступ к этой странице запрещен
            ")
        ));
        $resource->save();

        /* 404 */
        $alias = 'error404';
        $parent = 2;
        $templateId = 2;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 1,
            'pagetitle'    => '404',
            'longtitle'    => '',
            'isfolder'     => 1,
            'alias'        => $alias,
            'uri'          => $alias,
            'uri_override' => 0,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,
            'content'      => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "
                Страница не существует или вы не правильно ввели адрес
            ")
        ));
        $resource->save();
        $res404 = $resource->get('id');

        /* 503 */
        $alias = 'error503';
        $parent = 2;
        $templateId = 2;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 2,
            'pagetitle'    => '503',
            'longtitle'    => '',
            'isfolder'     => 1,
            'alias'        => $alias,
            'uri'          => $alias,
            'uri_override' => 0,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,
            'content'      => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "
                        Доступ к этой странице запрещен
            ")
        ));
        $resource->save();

        /* robots.txt */
        $alias = 'robots';
        $parent = 2;
        $templateId = 0;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 3,
            'pagetitle'    => $alias,
            'alias'        => $alias,
            'uri'          => $alias . '.txt',
            'uri_override' => 1,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,

            'searchable'   => 0,
            'content_type' => 3,
            'contentType'  => 'text/plain',

            'content' => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "
                            User-agent: *
                            Disallow: /manager/
                            Disallow: /assets/components/
                            Allow: /assets/uploads/
                            Disallow: /core/
                            Disallow: /connectors/
                            Disallow: /index.php
                            Disallow: /search
                            Disallow: /profile/
                            Disallow: *? Host: [[++site_url]]
                            Sitemap: [[++site_url]]sitemap.xml
                        ")
        ));
        $resource->save();

        /* sitemap.xml */
        $alias = 'sitemap';
        $parent = 2;
        $templateId = 0;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 4,
            'pagetitle'    => $alias,
            'alias'        => $alias,
            'uri'          => $alias . '.xml',
            'uri_override' => 1,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,

            'searchable'   => 0,
            'content_type' => 2,
            'contentType'  => 'text/xml',

            'content' => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "
                    {'pdoSitemap' | snippet : [ 'showHidden' => 1, 'resources' => '-{$res404}' ]}
                ")
        ));
        $resource->save();

        /* HTML карта сайта */
        $alias = 'sitemap';
        $parent = 2;
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 5,
            'pagetitle'    => 'Карта сайта',
            'isfolder'     => 1,
            'alias'        => $alias,
            'uri'          => $alias,
            'uri_override' => 0,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,
            'content'      => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "
                {'pdoMenu' | snippet : [
                    'startId' => 0,
                    'ignoreHidden' => 1,
                    'resources' => '-".$res404.",-' ~ \$_modx->resource.id,
                    'level' => 2,
                    'outerClass' => '',
                    'firstClass' => '',
                    'lastClass' => '',
                    'hereClass' => '',
                    'where' => '{\"searchable\":1}'
                ]}
            ")
        ));
        $resource->save();

        /* Согласие на обработку персональных данных */
        $alias = 'soglasie-na-obrabotku-personalnyix-dannyix';
        $parent = 2;
        $templateId = 2;
        $cont = '<p>Заполняя форму на сайте  Вы даете добровольное согласие Администрации ресурса на обработку своих персональных данных. 
                Под персональными данными понимается любая информация, относящаяся к Вам, как к зарегистрированному на сайте <strong>{$_modx->config.site_url}</strong> пользователю 
                (а именно: учетная запись на сайте, фамилия, имя, отчество, город проживания, контактный номер телефона, адрес электронной почты, учетная запись в Skype);</p>
                <p>Ваше согласие распространяется на осуществление Администрацией сайта <strong>{$_modx->config.site_url}</strong> любых действий в отношении ваших персональных данных, 
                которые могут понадобиться для сбора, систематизации, хранения, уточнения (обновление, изменение), обработки (например, отправки писем или совершения звонков),
                 распространения (в том числе возможная передача Генеральному партнеру, в случае Вашей регистрации в специальных мероприятиях, проводимых совместно с ним), 
                 блокирования и т.п. с учетом действующего законодательства;</p> 
                <p>Согласие на обработку персональных данных дается без ограничения срока, но может быть отозвано Вами (достаточно написать об этом 
                Администрации сайта по адресу {$_modx->config.key_email}). Заполнняя форму на сайте <strong>{$_modx->config.site_url}</strong> вы подтверждаете, 
                что с правами и обязанностями в соответствии с Федеральным законом «О персональных данных», в т.ч. порядком отзыва согласия на обработку персональных данных ознакомлены.</p>';
        if (!$resource = $modx->getObject('modResource', array('alias' => $alias))) {
            $resource = $modx->newObject('modResource');
        }
        $resource->fromArray(array(
            'class_key'    => 'modDocument',
            'menuindex'    => 6,
            'pagetitle'    => 'Согласие на обработку персональных данных',
            'isfolder'     => 1,
            'alias'        => $alias,
            'uri'          => $alias,
            'uri_override' => 0,
            'published'    => 1,
            'publishedon'  => time(),
            'hidemenu'     => 1,
            'richtext'     => 0,
            'parent'       => $parent,
            'template'     => $templateId,
            'content'      => preg_replace(array('/^\n/', '/[ ]{2,}|[\t]/'), '', "{$cont}")
        ));
        $resource->save();


        $chunks = array(
            'head',
            'js'
        );
        foreach ($chunks as $chunk_name) {
            if ($chunk = $modx->getObject('modChunk', array('name' => $chunk_name))) {
                $snippet = $chunk->snippet;
                //$snippet = str_replace('SITE_FOLDER_NAME', strtolower($options['site_template_name']), $snippet);
                $snippet = str_replace('PROJECT_URL', $modx->getOption('assets_url') . 'components/' . strtolower($options['site_category']), $snippet);
                $chunk->set('snippet', $snippet);
                $chunk->save();
            }
        }
        break;
        /*
        if ($plugin = $modx->getObject('modPlugin', array('name' => 'addManagerCss'))) {
            $plugincode = $plugin->plugincode;
            $plugincode = str_replace('SITE_FOLDER_NAME', strtolower($options['site_template_name']), $plugincode);
            $plugin->set('plugincode', $plugincode);
            $plugin->save();
        }
        break;
        */
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

return true;

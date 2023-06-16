<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Localization\Loc;
use intec\Core;

/**
 * @var $arUrlTemplates
 */

Loc::loadMessages(__FILE__);

if (!CModule::IncludeModule('intec.core'))
    return;

Core::$app->web->css->addFile(Core::getAlias('@resources/intec.universelite/css/icons.css'));

$arMenu = [
    'parent_menu' => 'global_intec',
    'text' => Loc::getMessage('intec.universelite.menu'),
    'icon' => "intec-universelite-menu-icon",
    'page_icon' => 'intec-universelite-menu-icon',
    'url' => '/bitrix/admin/intec_universelite.php',
    'items_id' => 'intec_universelite',
    'items' => []
];

return $arMenu;
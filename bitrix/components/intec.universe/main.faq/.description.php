<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    'NAME' => Loc::getMessage('C_MAIN_FAQ_NAME'),
    'DESCRIPTION' => Loc::getMessage('C_MAIN_FAQ_DESCRIPTION'),
    'CACHE_PATH' => 'Y',
    'SORT' => 1,
    'PATH' => [
        'ID' => 'Universe'
    ]
];
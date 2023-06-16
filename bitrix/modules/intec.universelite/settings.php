<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

return [
    'settingsDisplay' => [
        'type' => 'list',
        'name' => Loc::getMessage('intec.universelite.settings.settingsDisplay'),
        'default' => 'admin',
        'values' => [
            'none' => Loc::getMessage('intec.universelite.settings.settingsDisplay.none'),
            'admin' => Loc::getMessage('intec.universelite.settings.settingsDisplay.admin'),
            'all' => Loc::getMessage('intec.universelite.settings.settingsDisplay.all')
        ]
    ],
    'yandexMetrikaUse' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaUse'),
        'default' => 0
    ],
    'yandexMetrikaId' => [
        'type' => 'string',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaId'),
        'default' => ''
    ],
    'yandexMetrikaClickMap' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaClickMap'),
        'default' => 1
    ],
    'yandexMetrikaEcommerce' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaEcommerce'),
        'default' => 1
    ],
    'yandexMetrikaTrackHash' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaTrackHash'),
        'default' => 1
    ],
    'yandexMetrikaTrackLinks' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaTrackLinks'),
        'default' => 1
    ],
    'yandexMetrikaWebvisor' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.yandexMetrikaWebvisor'),
        'default' => 0
    ],
    'googleTagUse' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.googleTagUse'),
        'default' => 0
    ],
    'googleTagId' => [
        'type' => 'string',
        'name' => Loc::getMessage('intec.universelite.settings.googleTagId'),
        'default' => ''
    ],
    'optimizationUse' => [
        'type' => 'boolean',
        'name' => Loc::getMessage('intec.universelite.settings.optimizationUse'),
        'default' => 1
    ]
];
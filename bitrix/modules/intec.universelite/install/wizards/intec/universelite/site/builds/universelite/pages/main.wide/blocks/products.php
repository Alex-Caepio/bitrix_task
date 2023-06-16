<?php

return [
    'type' => 'variable',
    'variants' => [
        'slider.1' => [
            'name' => 'Слайдер 1',
            'properties' => [
                'background' => [
                    'color' => '#f8f9fb'
                ],
                'padding' => [
                    'top' => ['value' => 50, 'measure' => 'px'],
                    'bottom' => ['value' => 50, 'measure' => 'px']
                ]
            ],
            'component' => [
                'code' => 'intec.universe:main.widget',
                'template' => 'products.1',
                'properties' => [
                    'SETTINGS_USE' => 'Y',
                    'LAZYLOAD_USE' => 'N',
                    'IBLOCK_TYPE' => '#CATALOGS_PRODUCTS_IBLOCK_TYPE#',
                    'IBLOCK_ID' => '#CATALOGS_PRODUCTS_IBLOCK_ID#',
                    'MODE' => 'all',
                    'DELAY_USE' => 'Y',
                    'FORM_ID' => '#FORMS_PRODUCT_ID#',
                    'FORM_PROPERTY_PRODUCT' => '#FORMS_PRODUCT_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_ID' => '#FORMS_REQUEST_ID#',
                    'FORM_REQUEST_PROPERTY_PRODUCT' => '#FORMS_REQUEST_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_TEMPLATE' => '.default',
                    'BASKET_URL' => '#SITE_DIR#personal/basket/',
                    'QUICK_VIEW_USE' => 'Y',
                    'QUICK_VIEW_DETAIL' => 'N',
                    'QUICK_VIEW_TEMPLATE' => 2,
                    'QUICK_VIEW_PROPERTY_CODE' => [
                        'PROPERTY_TYPE',
                        'PROPERTY_QUANTITY_OF_STRIPS',
                        'PROPERTY_POWER',
                        'PROPERTY_PROCREATOR',
                        'PROPERTY_SCOPE',
                        'PROPERTY_DISPLAY',
                        'PROPERTY_WEIGTH',
                        'PROPERTY_ENERGY_CONSUMPTION',
                        'PROPERTY_SETTINGS',
                        'PROPERTY_COMPOSITION',
                        'PROPERTY_LENGTH',
                        'PROPERTY_SEASON',
                        'PROPERTY_PATTERN'
                    ],
                    'QUICK_VIEW_PROPERTY_MARKS_HIT' => 'HIT',
                    'QUICK_VIEW_PROPERTY_MARKS_NEW' => 'NEW',
                    'QUICK_VIEW_PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'QUICK_VIEW_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_OFFERS_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_DELAY_USE' => 'Y',
                    'QUICK_VIEW_MARKS_SHOW' => 'Y',
                    'QUICK_VIEW_MARKS_ORIENTATION' => 'horizontal',
                    'QUICK_VIEW_GALLERY_PREVIEW' => 'Y',
                    'QUICK_VIEW_QUANTITY_SHOW' => 'Y',
                    'QUICK_VIEW_QUANTITY_MODE' => 'number',
                    'QUICK_VIEW_ACTION' => 'buy',
                    'QUICK_VIEW_COUNTER_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_MODE' => 'preview',
                    'QUICK_VIEW_PROPERTIES_SHOW' => 'Y',
                    'QUICK_VIEW_DETAIL_SHOW' => 'Y',
                    'PROPERTY_ORDER_USE' => 'ORDER_USE',
                    'PROPERTY_MARKS_HIT' => 'HIT',
                    'PROPERTY_MARKS_NEW' => 'NEW',
                    'PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'PROPERTY_PICTURES' => 'PICTURES',
                    'PROPERTY_CATEGORY' => 'CATEGORY',
                    'COMPARE_PATH' => '#SITE_DIR#catalog/compare.php',
                    'COMPARE_NAME' => 'compare',
                    'COLUMNS' => 4,
                    'BLOCKS_HEADER_SHOW' => 'Y',
                    'BLOCKS_HEADER_TEXT' => 'Популярные товары',
                    'BLOCKS_DESCRIPTION_SHOW' => 'N',
                    'TABS_ALIGN' => 'left',
                    'MARKS_SHOW' => 'Y',
                    'MARKS_ORIENTATION' => 'horizontal',
                    'NAME_ALIGN' => 'left',
                    'SECTION_SHOW' => 'Y',
                    'SECTION_ALIGN' => 'left',
                    'PRICE_ALIGN' => 'start',
                    'IMAGE_SLIDER_SHOW' => 'Y',
                    'ACTION' => 'buy',
                    'VOTE_SHOW' => 'Y',
                    'VOTE_ALIGN' => 'left',
                    'VOTE_MODE' => 'rating',
                    'QUANTITY_SHOW' => 'Y',
                    'QUANTITY_MODE' => 'number',
                    'QUANTITY_ALIGN' => 'left',
                    'USE_COMPARE' => 'Y',
                    'SLIDER_USE' => 'Y',
                    'SLIDER_NAVIGATION' => 'Y',
                    'SLIDER_DOTS' => 'Y',
                    'SECTION_URL' => '',
                    'DETAIL_URL' => '',
                    'CONSENT_URL' => '#SITE_DIR#company/consent/',
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => 3600000,
                    'PRICE_CODE' => [
                        'BASE'
                    ],
                    'CONVERT_CURRENCY' => 'N',
                    'USE_PRICE_COUNT' => 'N',
                    'PRICE_VAT_INCLUDE' => 'N',
                    'STORES_FIELDS' => 'ADDRESS',
                    'BLOCKS_HEADER_ALIGN' => 'center',
                    'OFFERS_VARIABLE_SELECT' => 'offer'
                ]
            ]
        ],
        'tiles.1' => [
            'name' => 'Плитки 1',
            'properties' => [
                'background' => [
                    'color' => '#f8f9fb'
                ],
                'padding' => [
                    'top' => ['value' => 50, 'measure' => 'px'],
                    'bottom' => ['value' => 50, 'measure' => 'px']
                ]
            ],
            'component' => [
                'code' => 'intec.universe:main.widget',
                'template' => 'products.1',
                'properties' => [
                    'SETTINGS_USE' => 'Y',
                    'LAZYLOAD_USE' => 'N',
                    'IBLOCK_TYPE' => '#CATALOGS_PRODUCTS_IBLOCK_TYPE#',
                    'IBLOCK_ID' => '#CATALOGS_PRODUCTS_IBLOCK_ID#',
                    'MODE' => 'all',
                    'DELAY_USE' => 'Y',
                    'FORM_ID' => '#FORMS_PRODUCT_ID#',
                    'FORM_PROPERTY_PRODUCT' => '#FORMS_PRODUCT_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_ID' => '#FORMS_REQUEST_ID#',
                    'FORM_REQUEST_PROPERTY_PRODUCT' => '#FORMS_REQUEST_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_TEMPLATE' => '.default',
                    'BASKET_URL' => '#SITE_DIR#personal/basket/',
                    'QUICK_VIEW_USE' => 'Y',
                    'QUICK_VIEW_DETAIL' => 'N',
                    'QUICK_VIEW_TEMPLATE' => 2,
                    'QUICK_VIEW_PROPERTY_CODE' => [
                        'PROPERTY_TYPE',
                        'PROPERTY_QUANTITY_OF_STRIPS',
                        'PROPERTY_POWER',
                        'PROPERTY_PROCREATOR',
                        'PROPERTY_SCOPE',
                        'PROPERTY_DISPLAY',
                        'PROPERTY_WEIGTH',
                        'PROPERTY_ENERGY_CONSUMPTION',
                        'PROPERTY_SETTINGS',
                        'PROPERTY_COMPOSITION',
                        'PROPERTY_LENGTH',
                        'PROPERTY_SEASON',
                        'PROPERTY_PATTERN'
                    ],
                    'QUICK_VIEW_PROPERTY_MARKS_HIT' => 'HIT',
                    'QUICK_VIEW_PROPERTY_MARKS_NEW' => 'NEW',
                    'QUICK_VIEW_PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'QUICK_VIEW_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_OFFERS_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_DELAY_USE' => 'Y',
                    'QUICK_VIEW_MARKS_SHOW' => 'Y',
                    'QUICK_VIEW_MARKS_ORIENTATION' => 'horizontal',
                    'QUICK_VIEW_GALLERY_PREVIEW' => 'Y',
                    'QUICK_VIEW_QUANTITY_SHOW' => 'Y',
                    'QUICK_VIEW_QUANTITY_MODE' => 'number',
                    'QUICK_VIEW_ACTION' => 'buy',
                    'QUICK_VIEW_COUNTER_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_MODE' => 'preview',
                    'QUICK_VIEW_PROPERTIES_SHOW' => 'Y',
                    'QUICK_VIEW_DETAIL_SHOW' => 'Y',
                    'PROPERTY_ORDER_USE' => 'ORDER_USE',
                    'PROPERTY_MARKS_HIT' => 'HIT',
                    'PROPERTY_MARKS_NEW' => 'NEW',
                    'PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'PROPERTY_PICTURES' => 'PICTURES',
                    'PROPERTY_CATEGORY' => 'CATEGORY',
                    'COMPARE_PATH' => '#SITE_DIR#catalog/compare.php',
                    'COMPARE_NAME' => 'compare',
                    'COLUMNS' => 4,
                    'BLOCKS_HEADER_SHOW' => 'Y',
                    'BLOCKS_HEADER_TEXT' => 'Популярные товары',
                    'BLOCKS_DESCRIPTION_SHOW' => 'N',
                    'TABS_ALIGN' => 'left',
                    'MARKS_SHOW' => 'Y',
                    'MARKS_ORIENTATION' => 'horizontal',
                    'NAME_ALIGN' => 'left',
                    'SECTION_SHOW' => 'Y',
                    'SECTION_ALIGN' => 'left',
                    'PRICE_ALIGN' => 'start',
                    'IMAGE_SLIDER_SHOW' => 'Y',
                    'ACTION' => 'buy',
                    'VOTE_SHOW' => 'Y',
                    'VOTE_ALIGN' => 'left',
                    'VOTE_MODE' => 'rating',
                    'QUANTITY_SHOW' => 'Y',
                    'QUANTITY_MODE' => 'number',
                    'QUANTITY_ALIGN' => 'left',
                    'USE_COMPARE' => 'Y',
                    'SLIDER_USE' => 'N',
                    'SLIDER_NAVIGATION' => 'Y',
                    'SLIDER_DOTS' => 'Y',
                    'SECTION_URL' => '',
                    'DETAIL_URL' => '',
                    'CONSENT_URL' => '#SITE_DIR#company/consent/',
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => 3600000,
                    'PRICE_CODE' => [
                        'BASE'
                    ],
                    'CONVERT_CURRENCY' => 'N',
                    'USE_PRICE_COUNT' => 'N',
                    'PRICE_VAT_INCLUDE' => 'N',
                    'STORES_FIELDS' => 'ADDRESS',
                    'BLOCKS_HEADER_ALIGN' => 'center',
                    'OFFERS_VARIABLE_SELECT' => 'offer'
                ]
            ]
        ],
        'tiles.2' => [
            'name' => 'Плитки 2',
            'properties' => [
                'background' => [
                    'color' => '#f8f9fb'
                ],
                'padding' => [
                    'top' => ['value' => 50, 'measure' => 'px'],
                    'bottom' => ['value' => 50, 'measure' => 'px']
                ]
            ],
            'component' => [
                'code' => 'intec.universe:main.widget',
                'template' => 'products.2',
                'properties' => [
                    'SETTINGS_USE' => 'Y',
                    'LAZYLOAD_USE' => 'N',
                    'IBLOCK_TYPE' => '#CATALOGS_PRODUCTS_IBLOCK_TYPE#',
                    'IBLOCK_ID' => '#CATALOGS_PRODUCTS_IBLOCK_ID#',
                    'MODE' => 'all',
                    'ACTION' => 'buy',
                    'PRICE_CODE' => [
                        'BASE'
                    ],
                    'DISCOUNT_SHOW' => 'Y',
                    'SLIDER_USE' => 'N',
                    'TITLE_SHOW' => 'N',
                    'DESCRIPTION_SHOW' => 'N',
                    'COLUMNS' => 4,
                    'SECTION_URL' => '',
                    'DETAIL_URL' => '',
                    'BASKET_URL' => '#SITE_DIR#personal/basket/',
                    'CONSENT_URL' => '#SITE_DIR#company/consent/',
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => 3600000,
                    'FORM_ID' => '#FORMS_PRODUCT_ID#',
                    'FORM_PROPERTY_PRODUCT' => '#FORMS_PRODUCT_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_ID' => '#FORMS_REQUEST_ID#',
                    'FORM_REQUEST_PROPERTY_PRODUCT' => '#FORMS_REQUEST_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_TEMPLATE' => '.default',
                    'DELAY_USE' => 'Y',
                    'OFFERS_LIMIT' => '0',
                    'QUICK_VIEW_USE' => 'Y',
                    'QUICK_VIEW_DETAIL' => 'N',
                    'QUICK_VIEW_TEMPLATE' => 2,
                    'QUICK_VIEW_PROPERTY_CODE' => [
                        'PROPERTY_TYPE',
                        'PROPERTY_QUANTITY_OF_STRIPS',
                        'PROPERTY_POWER',
                        'PROPERTY_PROCREATOR',
                        'PROPERTY_SCOPE',
                        'PROPERTY_DISPLAY',
                        'PROPERTY_WEIGTH',
                        'PROPERTY_ENERGY_CONSUMPTION',
                        'PROPERTY_SETTINGS',
                        'PROPERTY_COMPOSITION',
                        'PROPERTY_LENGTH',
                        'PROPERTY_SEASON',
                        'PROPERTY_PATTERN'
                    ],
                    'QUICK_VIEW_PROPERTY_MARKS_HIT' => 'HIT',
                    'QUICK_VIEW_PROPERTY_MARKS_NEW' => 'NEW',
                    'QUICK_VIEW_PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'QUICK_VIEW_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_OFFERS_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_DELAY_USE' => 'Y',
                    'QUICK_VIEW_MARKS_SHOW' => 'Y',
                    'QUICK_VIEW_MARKS_ORIENTATION' => 'horizontal',
                    'QUICK_VIEW_GALLERY_PREVIEW' => 'Y',
                    'QUICK_VIEW_QUANTITY_SHOW' => 'Y',
                    'QUICK_VIEW_QUANTITY_MODE' => 'number',
                    'QUICK_VIEW_ACTION' => 'buy',
                    'QUICK_VIEW_COUNTER_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_MODE' => 'preview',
                    'QUICK_VIEW_PROPERTIES_SHOW' => 'Y',
                    'QUICK_VIEW_DETAIL_SHOW' => 'Y',
                    'PROPERTY_CATEGORY' => 'CATEGORY',
                    'PROPERTY_ORDER_USE' => 'ORDER_USE',
                    'PROPERTY_MARKS_HIT' => 'HIT',
                    'PROPERTY_MARKS_NEW' => 'NEW',
                    'PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'PROPERTY_PICTURES' => 'PICTURES',
                    'OFFERS_PROPERTY_PICTURES' => 'PICTURES',
                    'COMPARE_PATH' => '#SITE_DIR#catalog/compare.php',
                    'COMPARE_NAME' => 'compare',
                    'SHOW_PRICE_COUNT' => '1',
                    'TABS_ALIGN' => 'left',
                    'BLOCKS_HEADER_SHOW' => 'Y',
                    'BLOCKS_HEADER_TEXT' => 'Популярные товары',
                    'BORDERS' => 'N',
                    'BORDERS_STYLE' => 'squared',
                    'MARKS_SHOW' => 'Y',
                    'NAME_POSITION' => 'middle',
                    'NAME_ALIGN' => 'left',
                    'PRICE_ALIGN' => 'start',
                    'IMAGE_SLIDER_SHOW' => 'Y',
                    'COUNTER_SHOW' => 'Y',
                    'OFFERS_USE' => 'Y',
                    'OFFERS_ALIGN' => 'left',
                    'OFFERS_VIEW' => 'default',
                    'VOTE_SHOW' => 'Y',
                    'VOTE_ALIGN' => 'left',
                    'VOTE_MODE' => 'rating',
                    'QUANTITY_SHOW' => 'Y',
                    'QUANTITY_MODE' => 'number',
                    'QUANTITY_ALIGN' => 'left',
                    'USE_COMPARE' => 'Y',
                    'CONVERT_CURRENCY' => 'N',
                    'USE_PRICE_COUNT' => 'N',
                    'PRICE_VAT_INCLUDE' => 'N',
                    'STORES_FIELDS' => 'ADDRESS',
                    'BLOCKS_HEADER_ALIGN' => 'center',
                    'OFFERS_VARIABLE_SELECT' => 'offer'
                ]
            ]
        ],
        'tiles.3' => [
            'name' => 'Плитки 3',
            'properties' => [
                'background' => [
                    'color' => '#f8f9fb'
                ],
                'padding' => [
                    'top' => ['value' => 50, 'measure' => 'px'],
                    'bottom' => ['value' => 50, 'measure' => 'px']
                ]
            ],
            'component' => [
                'code' => 'intec.universe:main.widget',
                'template' => 'products.4',
                'properties' => [
                    'SETTINGS_USE' => 'Y',
                    'LAZYLOAD_USE' => 'N',
                    'IBLOCK_TYPE' => '#CATALOGS_PRODUCTS_IBLOCK_TYPE#',
                    'IBLOCK_ID' => '#CATALOGS_PRODUCTS_IBLOCK_ID#',
                    'MODE' => 'all',
                    'ACTION' => 'buy',
                    'PRICE_CODE' => [
                        'BASE'
                    ],
                    'DISCOUNT_SHOW' => 'Y',
                    'SLIDER_USE' => 'N',
                    'TITLE_SHOW' => 'N',
                    'DESCRIPTION_SHOW' => 'N',
                    'COLUMNS' => 4,
                    'SECTION_URL' => '',
                    'DETAIL_URL' => '',
                    'BASKET_URL' => '#SITE_DIR#personal/basket/',
                    'CONSENT_URL' => '#SITE_DIR#company/consent/',
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => 3600000,
                    'FORM_ID' => '#FORMS_PRODUCT_ID#',
                    'FORM_PROPERTY_PRODUCT' => '#FORMS_PRODUCT_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_ID' => '#FORMS_REQUEST_ID#',
                    'FORM_REQUEST_PROPERTY_PRODUCT' => '#FORMS_REQUEST_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_TEMPLATE' => '.default',
                    'ORDER_FAST_USE' => 'N',
                    'DELAY_USE' => 'Y',
                    'OFFERS_LIMIT' => '0',
                    'QUICK_VIEW_USE' => 'Y',
                    'QUICK_VIEW_DETAIL' => 'N',
                    'QUICK_VIEW_TEMPLATE' => 2,
                    'QUICK_VIEW_LAZYLOAD_USE' => 'N',
                    'QUICK_VIEW_PROPERTY_CODE' => [
                        'PROPERTY_TYPE',
                        'PROPERTY_QUANTITY_OF_STRIPS',
                        'PROPERTY_POWER',
                        'PROPERTY_PROCREATOR',
                        'PROPERTY_SCOPE',
                        'PROPERTY_DISPLAY',
                        'PROPERTY_WEIGTH',
                        'PROPERTY_ENERGY_CONSUMPTION',
                        'PROPERTY_SETTINGS',
                        'PROPERTY_COMPOSITION',
                        'PROPERTY_LENGTH',
                        'PROPERTY_SEASON',
                        'PROPERTY_PATTERN'
                    ],
                    'QUICK_VIEW_PROPERTY_MARKS_HIT' => 'HIT',
                    'QUICK_VIEW_PROPERTY_MARKS_NEW' => 'NEW',
                    'QUICK_VIEW_PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'QUICK_VIEW_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_OFFERS_PROPERTY_PICTURES' => 'PICTURES',
                    'QUICK_VIEW_DELAY_USE' => 'Y',
                    'QUICK_VIEW_MARKS_SHOW' => 'Y',
                    'QUICK_VIEW_MARKS_ORIENTATION' => 'horizontal',
                    'QUICK_VIEW_GALLERY_PREVIEW' => 'Y',
                    'QUICK_VIEW_QUANTITY_SHOW' => 'Y',
                    'QUICK_VIEW_QUANTITY_MODE' => 'number',
                    'QUICK_VIEW_ACTION' => 'buy',
                    'QUICK_VIEW_COUNTER_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_SHOW' => 'Y',
                    'QUICK_VIEW_DESCRIPTION_MODE' => 'preview',
                    'QUICK_VIEW_PROPERTIES_SHOW' => 'Y',
                    'QUICK_VIEW_DETAIL_SHOW' => 'Y',
                    'PROPERTY_CATEGORY' => 'CATEGORY',
                    'PROPERTY_ORDER_USE' => 'ORDER_USE',
                    'PROPERTY_MARKS_HIT' => 'HIT',
                    'PROPERTY_MARKS_NEW' => 'NEW',
                    'PROPERTY_MARKS_RECOMMEND' => 'RECOMMEND',
                    'PROPERTY_PICTURES' => 'PICTURES',
                    'PROPERTY_STORES_SHOW' => 'STORES_SHOW',
                    'PROPERTY_ARTICLE' => 'ARTICLE',
                    'OFFERS_PROPERTY_PICTURES' => 'PICTURES',
                    'OFFERS_PROPERTY_STORES_SHOW' => 'STORES_SHOW',
                    'OFFERS_PROPERTY_ARTICLE' => 'ARTICLE',
                    'COMPARE_PATH' => '#SITE_DIR#catalog/compare.php',
                    'COMPARE_NAME' => 'compare',
                    'SHOW_PRICE_COUNT' => '1',
                    'TABS_ALIGN' => 'left',
                    'BLOCKS_HEADER_SHOW' => 'Y',
                    'BLOCKS_HEADER_TEXT' => 'Популярные товары',
                    'BORDERS' => 'N',
                    'BORDERS_STYLE' => 'squared',
                    'ARTICLE_SHOW' => 'Y',
                    'MARKS_SHOW' => 'Y',
                    'NAME_POSITION' => 'middle',
                    'NAME_ALIGN' => 'left',
                    'PRICE_ALIGN' => 'start',
                    'IMAGE_SLIDER_SHOW' => 'Y',
                    'IMAGE_SLIDER_NAV_SHOW' => 'N',
                    'IMAGE_SLIDER_OVERLAY_USE' => 'Y',
                    'COUNTER_SHOW' => 'Y',
                    'OFFERS_USE' => 'Y',
                    'OFFERS_ALIGN' => 'left',
                    'OFFERS_VIEW' => 'default',
                    'VOTE_SHOW' => 'Y',
                    'VOTE_ALIGN' => 'left',
                    'VOTE_MODE' => 'rating',
                    'QUANTITY_SHOW' => 'Y',
                    'QUANTITY_MODE' => 'number',
                    'QUANTITY_ALIGN' => 'left',
                    'USE_COMPARE' => 'Y',
                    'CONVERT_CURRENCY' => 'N',
                    'USE_PRICE_COUNT' => 'N',
                    'PRICE_VAT_INCLUDE' => 'N',
                    'STORES_FIELDS' => 'ADDRESS',
                    'BLOCKS_HEADER_ALIGN' => 'center',
                    'OFFERS_VARIABLE_SELECT' => 'offer'
                ]
            ]
        ],
        'tiles.3.big' => [
            'name' => 'Плитки 3 с большим элементом',
            'properties' => [
                'background' => [
                    'color' => '#f8f9fb'
                ],
                'padding' => [
                    'top' => ['value' => 50, 'measure' => 'px'],
                    'bottom' => ['value' => 50, 'measure' => 'px']
                ]
            ],
            'component' => [
                'code' => 'intec.universe:main.widget',
                'template' => 'products.4',
                'properties' => [
                    "SETTINGS_USE" => "Y",
                    "LAZYLOAD_USE" => "N",
                    "IBLOCK_TYPE" => "#CATALOGS_PRODUCTS_IBLOCK_TYPE#",
                    "IBLOCK_ID" => "#CATALOGS_PRODUCTS_IBLOCK_ID#",
                    "MODE" => "all",
                    "ACTION" => "buy",
                    "PRICE_CODE" => Array(
                        "BASE"
                    ),
                    "DISCOUNT_SHOW" => "Y",
                    "SLIDER_USE" => "N",
                    "TITLE_SHOW" => "N",
                    "DESCRIPTION_SHOW" => "N",
                    "COLUMNS" => 4,
                    "LINES" => 2,
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "BASKET_URL" => "#SITE_DIR#personal/basket/",
                    "CONSENT_URL" => "#SITE_DIR#company/consent/",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => 3600000,
                    "FORM_ID" => "#FORMS_PRODUCT_ID#",
                    "FORM_PROPERTY_PRODUCT" => "#FORMS_PRODUCT_FIELDS_PRODUCT_ID#",
                    'FORM_REQUEST_ID' => '#FORMS_REQUEST_ID#',
                    'FORM_REQUEST_PROPERTY_PRODUCT' => '#FORMS_REQUEST_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_TEMPLATE' => '.default',
                    "ORDER_FAST_USE" => "N",
                    "DELAY_USE" => "Y",
                    "OFFERS_LIMIT" => "0",
                    "BANNER_SHOW" => "Y",
                    "PROPERTY_BANNER_SHOW" => "MAIN_BANNER_SHOW",
                    "PROPERTY_BANNER_PICTURE" => "MAIN_BANNER_PICTURE",
                    "PROPERTY_BANNER_THEME" => "MAIN_BANNER_THEME",
                    "QUICK_VIEW_USE" => "Y",
                    "QUICK_VIEW_DETAIL" => "N",
                    "QUICK_VIEW_TEMPLATE" => 2,
                    "QUICK_VIEW_LAZYLOAD_USE" => "N",
                    "QUICK_VIEW_PROPERTY_CODE" => Array(
                        "PROPERTY_TYPE",
                        "PROPERTY_QUANTITY_OF_STRIPS",
                        "PROPERTY_POWER",
                        "PROPERTY_PROCREATOR",
                        "PROPERTY_SCOPE",
                        "PROPERTY_DISPLAY",
                        "PROPERTY_WEIGTH",
                        "PROPERTY_ENERGY_CONSUMPTION",
                        "PROPERTY_SETTINGS",
                        "PROPERTY_COMPOSITION",
                        "PROPERTY_LENGTH",
                        "PROPERTY_SEASON",
                        "PROPERTY_PATTERN"
                    ),
                    "QUICK_VIEW_PROPERTY_MARKS_HIT" => "HIT",
                    "QUICK_VIEW_PROPERTY_MARKS_NEW" => "NEW",
                    "QUICK_VIEW_PROPERTY_MARKS_RECOMMEND" => "RECOMMEND",
                    "QUICK_VIEW_PROPERTY_PICTURES" => "PICTURES",
                    "QUICK_VIEW_OFFERS_PROPERTY_PICTURES" => "PICTURES",
                    "QUICK_VIEW_DELAY_USE" => "Y",
                    "QUICK_VIEW_MARKS_SHOW" => "Y",
                    "QUICK_VIEW_MARKS_ORIENTATION" => "horizontal",
                    "QUICK_VIEW_GALLERY_PREVIEW" => "Y",
                    "QUICK_VIEW_QUANTITY_SHOW" => "Y",
                    "QUICK_VIEW_QUANTITY_MODE" => "logic",
                    "QUICK_VIEW_ACTION" => "buy",
                    "QUICK_VIEW_COUNTER_SHOW" => "Y",
                    "QUICK_VIEW_DESCRIPTION_SHOW" => "Y",
                    "QUICK_VIEW_DESCRIPTION_MODE" => "preview",
                    "QUICK_VIEW_PROPERTIES_SHOW" => "Y",
                    "QUICK_VIEW_DETAIL_SHOW" => "Y",
                    "PROPERTY_CATEGORY" => "CATEGORY",
                    "PROPERTY_ORDER_USE" => "ORDER_USE",
                    "PROPERTY_MARKS_HIT" => "HIT",
                    "PROPERTY_MARKS_NEW" => "NEW",
                    "PROPERTY_MARKS_RECOMMEND" => "RECOMMEND",
                    "PROPERTY_PICTURES" => "PICTURES",
                    "PROPERTY_STORES_SHOW" => "STORES_SHOW",
                    "PROPERTY_ARTICLE" => "ARTICLE",
                    "OFFERS_PROPERTY_PICTURES" => "PICTURES",
                    "OFFERS_PROPERTY_STORES_SHOW" => "STORES_SHOW",
                    "OFFERS_PROPERTY_ARTICLE" => "ARTICLE",
                    "COMPARE_PATH" => "#SITE_DIR#catalog/compare.php",
                    "COMPARE_NAME" => "compare",
                    "SHOW_PRICE_COUNT" => "1",
                    "TABS_ALIGN" => "left",
                    'BLOCKS_HEADER_SHOW' => 'Y',
                    'BLOCKS_HEADER_TEXT' => 'Популярные товары',
                    "BORDERS" => "Y",
                    "BORDERS_STYLE" => "squared",
                    "ARTICLE_SHOW" => "Y",
                    "MARKS_SHOW" => "Y",
                    "NAME_POSITION" => "middle",
                    "NAME_ALIGN" => "left",
                    "PRICE_ALIGN" => "start",
                    "IMAGE_SLIDER_SHOW" => "Y",
                    "IMAGE_SLIDER_NAV_SHOW" => "N",
                    "IMAGE_SLIDER_OVERLAY_USE" => "Y",
                    "COUNTER_SHOW" => "Y",
                    "OFFERS_USE" => "Y",
                    "OFFERS_ALIGN" => "left",
                    "OFFERS_VIEW" => "default",
                    "VOTE_SHOW" => "Y",
                    "VOTE_ALIGN" => "left",
                    "VOTE_MODE" => "rating",
                    "QUANTITY_SHOW" => "Y",
                    "QUANTITY_MODE" => "logic",
                    "QUANTITY_ALIGN" => "left",
                    "USE_COMPARE" => "Y","CONVERT_CURRENCY" => "N",
                    "USE_PRICE_COUNT" => "N",
                    "PRICE_VAT_INCLUDE" => "N",
                    'STORES_FIELDS' => 'ADDRESS',
                    'BLOCKS_HEADER_ALIGN' => 'center',
                    'OFFERS_VARIABLE_SELECT' => 'offer'
                ]
            ]
        ],
        'list.1' => [
            'name' => 'Список 1',
            'properties' => [
                'margin' => [
                    'top' => ['value' => 50, 'measure' => 'px'],
                    'bottom' => ['value' => 50, 'measure' => 'px']
                ]
            ],
            'component' => [
                'code' => 'intec.universe:main.widget',
                'template' => 'products.5',
                'properties' => [
                    "SETTINGS_USE" => "Y",
                    "LAZYLOAD_USE" => "N",
                    "IBLOCK_TYPE" => "#CATALOGS_PRODUCTS_IBLOCK_TYPE#",
                    "IBLOCK_ID" => "#CATALOGS_PRODUCTS_IBLOCK_ID#",
                    "MODE" => "all",
                    "DELAY_USE" => "Y",
                    "DELAY_SHOW_INACTIVE" => "Y",
                    "COMPARE_SHOW_INACTIVE" => "Y",
                    "MEASURE_SHOW" => "Y",
                    "OFFERS_LIMIT" => "0",
                    "BASKET_URL" => "#SITE_DIR#personal/basket/",
                    "REGIONALITY_USE" => "N",
                    "QUICK_VIEW_USE" => "Y",
                    "QUICK_VIEW_DETAIL" => "N",
                    "QUICK_VIEW_TEMPLATE" => 2,
                    "QUICK_VIEW_LAZYLOAD_USE" => "N",
                    "QUICK_VIEW_PROPERTY_CODE" => Array(
                        "PROPERTY_TYPE",
                        "PROPERTY_QUANTITY_OF_STRIPS",
                        "PROPERTY_POWER",
                        "PROPERTY_PROCREATOR",
                        "PROPERTY_SCOPE",
                        "PROPERTY_DISPLAY",
                        "PROPERTY_WEIGTH",
                        "PROPERTY_ENERGY_CONSUMPTION",
                        "PROPERTY_SETTINGS",
                        "PROPERTY_COMPOSITION",
                        "PROPERTY_LENGTH",
                        "PROPERTY_SEASON",
                        "PROPERTY_PATTERN"
                    ),
                    "QUICK_VIEW_PROPERTY_MARKS_HIT" => "HIT",
                    "QUICK_VIEW_PROPERTY_MARKS_NEW" => "NEW",
                    "QUICK_VIEW_PROPERTY_MARKS_RECOMMEND" => "RECOMMEND",
                    "QUICK_VIEW_PROPERTY_PICTURES" => "PICTURES",
                    "QUICK_VIEW_OFFERS_PROPERTY_PICTURES" => "PICTURES",
                    "QUICK_VIEW_DELAY_USE" => "Y",
                    "QUICK_VIEW_MARKS_SHOW" => "Y",
                    "QUICK_VIEW_MARKS_ORIENTATION" => "horizontal",
                    "QUICK_VIEW_GALLERY_PREVIEW" => "Y",
                    "QUICK_VIEW_QUANTITY_SHOW" => "Y",
                    "QUICK_VIEW_QUANTITY_MODE" => "logic",
                    "QUICK_VIEW_ACTION" => "buy",
                    "QUICK_VIEW_COUNTER_SHOW" => "Y",
                    "QUICK_VIEW_DESCRIPTION_SHOW" => "Y",
                    "QUICK_VIEW_DESCRIPTION_MODE" => "preview",
                    "QUICK_VIEW_PROPERTIES_SHOW" => "Y",
                    "QUICK_VIEW_DETAIL_SHOW" => "Y",
                    "FORM_ID" => "#FORMS_PRODUCT_ID#",
                    "FORM_PROPERTY_PRODUCT" => "#FORMS_PRODUCT_FIELDS_PRODUCT_ID#",
                    "FORM_TEMPLATE" => ".default",
                    'FORM_REQUEST_ID' => '#FORMS_REQUEST_ID#',
                    'FORM_REQUEST_PROPERTY_PRODUCT' => '#FORMS_REQUEST_FIELDS_PRODUCT_ID#',
                    'FORM_REQUEST_TEMPLATE' => '.default',
                    "PROPERTY_ORDER_USE" => "ORDER_USE",
                    "PROPERTY_CATEGORY" => "CATEGORY",
                    "COMPARE_PATH" => "#SITE_DIR#catalog/compare.php",
                    "COMPARE_NAME" => "compare",
                    "SHOW_PRICE_COUNT" => "1",
                    'BLOCKS_HEADER_SHOW' => 'Y',
                    'BLOCKS_HEADER_TEXT' => 'Популярные товары',
                    "BLOCKS_DESCRIPTION_SHOW" => "N",
                    "TABS_ALIGN" => "left",
                    "VIEW" => "tabs",
                    "ACTION" => "buy",
                    "BUTTON_TOGGLE_ACTION" => "buy",
                    "PROPERTIES_SHOW" => "Y",
                    "PROPERTIES_AMOUNT" => 3,
                    "RECALCULATION_PRICES_USE" => "N",
                    "COUNTER_SHOW" => "Y",
                    "OFFERS_USE" => "Y",
                    "VOTE_SHOW" => "Y",
                    "VOTE_MODE" => "rating",
                    "QUANTITY_SHOW" => "Y",
                    "QUANTITY_MODE" => "logic",
                    "USE_COMPARE" => "Y",
                    "PURCHASE_BASKET_BUTTON_TEXT" => "В корзину",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "CONSENT_URL" => "#SITE_DIR#company/consent/",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => 3600000,
                    "PRICE_CODE" => Array(
                        "BASE"
                    ),
                    "CONVERT_CURRENCY" => "N",
                    "USE_PRICE_COUNT" => "N",
                    "PRICE_VAT_INCLUDE" => "N",
                    'STORES_FIELDS' => 'ADDRESS',
                    'BLOCKS_HEADER_ALIGN' => 'center',
                    'OFFERS_VARIABLE_SELECT' => 'offer'
                ]
            ]
        ]
    ]
];

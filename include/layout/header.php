<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\Html;

/**
 * @global CMain $APPLICATION
 */

?>
<?= Html::beginTag('div', [
    'style' => [
        'background-color' => '#f8f9fb'
    ]
]) ?>
    <?php $APPLICATION->IncludeComponent(
        "intec.universe:main.header",
        "template.1",
        array(
            'SETTINGS_USE' => 'Y',
            'REGIONALITY_USE' => 'N',
            'CONTACTS_REGIONALITY_USE' => 'Y',
            'CONTACTS_REGIONALITY_STRICT' => 'N',
            'CONTACTS_IBLOCK_TYPE' => 'content',
            'CONTACTS_IBLOCK_ID' => '41',
            'CONTACTS_PROPERTY_PHONE' => 'PHONE',
            'CONTACTS_PROPERTY_CITY' => 'CITY',
            'CONTACTS_PROPERTY_ADDRESS' => 'ADDRESS',
            'CONTACTS_PROPERTY_SCHEDULE' => 'WORK_TIME',
            'CONTACTS_PROPERTY_EMAIL' => 'EMAIL',
            'CONTACTS_PROPERTY_REGION' => 'REGIONS',
            'SEARCH_NUM_CATEGORIES' => 1,
            'SEARCH_TOP_COUNT' => 5,
            'SEARCH_ORDER' => 'date',
            'SEARCH_USE_LANGUAGE_GUESS' => 'Y',
            'SEARCH_CHECK_DATES' => 'N',
            'SEARCH_SHOW_OTHERS' => 'N',
            'SEARCH_TIPS_USE' => 'Y',
            'SEARCH_MODE' => 'site',
            'COMPARE_IBLOCK_TYPE' => 'catalogs',
            'COMPARE_IBLOCK_ID' => '13',
            'COMPARE_CODE' => 'compare',
            'MENU_MAIN_ROOT' => 'top',
            'MENU_MAIN_CHILD' => 'left',
            'MENU_MAIN_LEVEL' => 4,
            'MENU_MAIN_IBLOCK_TYPE' => 'catalogs',
            'MENU_MAIN_IBLOCK_ID' => '13',
            'MENU_INFO_ROOT' => 'info',
            'MENU_INFO_CHILD' => 'left',
            'MENU_INFO_LEVEL' => 1,
            'LOGOTYPE' => '/include/logotype.php',
            'PHONES' => [
                '+7 (000) 000 00 00'
            ],
            'ADDRESS' => 'г. Челябинск',
            'EMAIL' => 'shop@example.com',
            'TAGLINE' => 'Готовый интернет-магазин на 1С-Битрикс',
            'MENU_MAIN_PROPERTY_IMAGE' => 'UF_IMAGE_MENU',
            'MENU_MAIN_PROPERTY_IMAGE_ELEMENTS' => 'SVG_FILE',
            'FORMS_CALL_ID' => '1',
            'FORMS_CALL_TEMPLATE' => '.default',
            'MENU_POPUP_FORMS_FEEDBACK_ID' => '2',
            'MENU_POPUP_FORMS_FEEDBACK_TEMPLATE' => '.default',
            'SOCIAL_VK' => 'https://vk.com',
            'SOCIAL_INSTAGRAM' => 'https://instagram.com',
            'SOCIAL_FACEBOOK' => 'https://facebook.com',
            'SOCIAL_TWITTER' => 'https://twitter.com',
            'BANNER' => 'template.1',
            'BANNER_DISPLAY' => 'main',
            'BANNER_IBLOCK_TYPE' => 'content',
            'BANNER_IBLOCK_ID' => '1',
            'BANNER_ELEMENTS_COUNT' => '',
            'BANNER_SECTIONS_MODE' => 'code',
            'BANNER_LAZYLOAD_USE' => 'N',
            'BANNER_BLOCKS_USE' => 'Y',
            'BANNER_BLOCKS_IBLOCK_TYPE' => 'content',
            'BANNER_BLOCKS_IBLOCK_ID' => '2',
            'BANNER_BLOCKS_MODE' => 'N',
            'BANNER_BLOCKS_ELEMENTS_COUNT' => 4,
            'BANNER_BLOCKS_POSITION' => 'right',
            'BANNER_BLOCKS_EFFECT_FADE' => 'Y',
            'BANNER_BLOCKS_EFFECT_SCALE' => 'Y',
            'BANNER_BLOCKS_INDENT' => 'N',
            'BANNER_HEIGHT' => 500,
            'BANNER_WIDE' => 'N',
            'BANNER_ROUNDED' => 'N',
            'BANNER_HEADER_SHOW' => 'Y',
            'BANNER_HEADER_VIEW' => 4,
            'BANNER_DESCRIPTION_SHOW' => 'Y',
            'BANNER_DESCRIPTION_VIEW' => 1,
            'BANNER_HEADER_OVER_SHOW' => 'Y',
            'BANNER_HEADER_OVER_VIEW' => 1,
            'BANNER_BUTTON_VIEW' => 1,
            'BANNER_ORDER_SHOW' => 'N',
            'BANNER_ORDER_FORM_ID' => "9",
            'BANNER_ORDER_FORM_TEMPLATE' => '.default',
            'BANNER_ORDER_FORM_TITLE' => 'Узнать стоимость',
            'BANNER_ORDER_FORM_CONSENT' => '/company/consent/',
            'BANNER_ORDER_BUTTON' => 'Узнать стоимость',
            'BANNER_PICTURE_SHOW' => 'Y',
            'BANNER_VIDEO_SHOW' => 'Y',
            'BANNER_ADDITIONAL_SHOW' => 'Y',
            'BANNER_ADDITIONAL_VIEW' => 3,
            'BANNER_SLIDER_NAV_SHOW' => 'Y',
            'BANNER_SLIDER_NAV_VIEW' => 1,
            'BANNER_SLIDER_DOTS_SHOW' => 'Y',
            'BANNER_SLIDER_DOTS_VIEW' => 1,
            'BANNER_SLIDER_DOTS' => 'Y',
            'BANNER_SLIDER_LOOP' => 'N',
            'BANNER_SLIDER_SPEED' => 500,
            'BANNER_SLIDER_AUTO_USE' => 'N',
            'BANNER_SORT_BY' => 'SORT',
            'BANNER_ORDER_BY' => 'ASC',
            'BANNER_PROPERTY_HEADER' => 'TITLE',
            'BANNER_PROPERTY_DESCRIPTION' => 'DESCRIPTION',
            'BANNER_PROPERTY_HEADER_OVER' => 'HEADER_OVER',
            'BANNER_PROPERTY_LINK' => 'LINK',
            'BANNER_PROPERTY_LINK_BLANK' => 'LINK_BLANK',
            'BANNER_PROPERTY_BUTTON_SHOW' => 'BUTTON_SHOW',
            'BANNER_PROPERTY_BUTTON_TEXT' => 'BUTTON_TEXT',
            'BANNER_PROPERTY_TEXT_POSITION' => 'TEXT_POSITION',
            'BANNER_PROPERTY_TEXT_ALIGN' => 'TEXT_ALIGN',
            'BANNER_PROPERTY_TEXT_HALF' => 'TEXT_HALF',
            'BANNER_PROPERTY_PICTURE' => 'PICTURE',
            'BANNER_PROPERTY_PICTURE_ALIGN_VERTICAL' => 'PICTURE_ALIGN_VERTICAL',
            'BANNER_PROPERTY_ADDITIONAL' => 'ADDITIONAL',
            'BANNER_PROPERTY_SCHEME' => 'TEXT_DARK',
            'BANNER_PROPERTY_FADE' => 'BACKGROUND_FADE',
            'BANNER_PROPERTY_VIDEO' => 'BACKGROUND_VIDEO',
            'BANNER_PROPERTY_VIDEO_FILE_MP4' => 'BACKGROUND_VIDEO_FILE_MP4',
            'BANNER_PROPERTY_VIDEO_FILE_WEBM' => 'BACKGROUND_VIDEO_FILE_WEBM',
            'BANNER_PROPERTY_VIDEO_FILE_OGV' => 'BACKGROUND_VIDEO_FILE_OGV',
            'BANNER_BLOCKS_PROPERTY_LINK' => 'LINK',
            'BANNER_BLOCKS_PROPERTY_LINK_BLANK' => 'LINK_BLANK',
            'BANNER_PRODUCT_IBLOCK_TYPE' => 'catalogs',
            'BANNER_PRODUCT_IBLOCK_ID' => '13',
            'BANNER_PRODUCT_DELAY_USE' => 'Y',
            'BANNER_PRODUCT_FORM_ID' => '6',
            'BANNER_PRODUCT_FORM_PROPERTY_PRODUCT' => '21',
            'BANNER_PRODUCT_FORM_TEMPLATE' => '.default',
            'BANNER_PRODUCT_USE' => 'Y',
            'BANNER_PROPERTY_PRODUCT' => 'PRODUCT',
            'BANNER_PRODUCT_PROPERTY_ORDER_USE' => 'ORDER_USE',
            'BANNER_PRODUCT_PROPERTY_MARKS_HIT' => 'RECOMMEND',
            'BANNER_PRODUCT_PROPERTY_MARKS_NEW' => 'NEW',
            'BANNER_PRODUCT_PROPERTY_MARKS_RECOMMEND' => 'HIT',
            'BANNER_PRODUCT_MARKS_TEMPLATE' => 'template.1',
            'BANNER_PRODUCT_ACTION' => 'buy',
            'BANNER_PRODUCT_QUANTITY_SHOW' => 'Y',
            'BANNER_PRODUCT_QUANTITY_MODE' => 'number',
            'BANNER_PRODUCT_MARKS_SHOW' => 'Y',
            'BANNER_PRODUCT_PRICE_DIFFERENCE' => 'Y',
            'BANNER_PRODUCT_PRICE_CODE' => array(
                'BASE'
            ),
            'BANNER_PRODUCT_TIMER_SHOW' => 'Y',
            'BANNER_PRODUCT_SECTION_URL' => '',
            'BANNER_PRODUCT_DETAIL_URL' => '',
            'BANNER_PRODUCT_SECTION_ID_VARIABLE' => 'SECTION_ID',
            'BANNER_PRODUCT_CHECK_SECTION_ID_VARIABLE' => 'N',
            'BANNER_PRODUCT_SHOW_PRICE_COUNT' => '1',
            'BANNER_PRODUCT_BASKET_URL' => '/personal/basket.php',
            'BANNER_PRODUCT_ACTION_VARIABLE' => 'action',
            'BANNER_PRODUCT_DISPLAY_COMPARE' => 'Y',
            'BANNER_PRODUCT_CONVERT_CURRENCY' => 'N',
            'BANNER_PRODUCT_COMPARE_PATH' => '',
            'BANNER_PRODUCT_COMPARE_NAME' => 'compare',
            'BANNER_PRODUCT_TIMER_TIME_ZERO_HIDE' => 'Y',
            'BANNER_PRODUCT_TIMER_MODE' => 'discount',
            'BANNER_PRODUCT_TIMER_ELEMENT_ID_INTRODUCE' => 'N',
            'BANNER_PRODUCT_TIMER_TIMER_SECONDS_SHOW' => 'N',
            'BANNER_PRODUCT_TIMER_TIMER_QUANTITY_SHOW' => 'Y',
            'BANNER_PRODUCT_TIMER_TIMER_QUANTITY_ENTER_VALUE' => 'N',
            'BANNER_PRODUCT_TIMER_TIMER_PRODUCT_UNITS_USE' => '',
            'BANNER_PRODUCT_TIMER_TIMER_QUANTITY_HEADER_SHOW' => 'Y',
            'BANNER_PRODUCT_TIMER_TIMER_QUANTITY_HEADER' => 'Остаток',
            'BANNER_PRODUCT_TIMER_TIMER_HEADER_SHOW' => '',
            'BANNER_PRODUCT_TIMER_SETTINGS_USE' => '',
            'BANNER_PRODUCT_TIMER_LAZYLOAD_USE' => 'N',
            'BANNER_PRODUCT_TIMER_TIMER_QUANTITY_OVER' => 'Y',
            'BANNER_PRODUCT_TIMER_UNITS_USE' => 'N',
            'BANNER_PRODUCT_TIMER_TIMER_HEADER' => 'До конца акции',
            'LOGOTYPE_SHOW' => 'Y',
            'PHONES_SHOW' => 'Y',
            'PHONES_SHOW_MOBILE' => 'Y',
            'PHONES_ADVANCED_MODE' => 'Y',
            'CONTACTS_ADDRESS_SHOW' => 'Y',
            'CONTACTS_SCHEDULE_SHOW' => 'Y',
            'CONTACTS_EMAIL_SHOW' => 'Y',
            'TRANSPARENCY' => 'Y',
            'LOGOTYPE_SHOW_FIXED' => 'Y',
            'LOGOTYPE_SHOW_MOBILE' => 'Y',
            'ADDRESS_SHOW' => 'Y',
            'ADDRESS_SHOW_MOBILE' => 'Y',
            'EMAIL_SHOW' => 'Y',
            'EMAIL_SHOW_MOBILE' => 'Y',
            'AUTHORIZATION_SHOW' => 'Y',
            'AUTHORIZATION_SHOW_FIXED' => 'Y',
            'AUTHORIZATION_SHOW_MOBILE' => 'Y',
            'TAGLINE_SHOW' => 'Y',
            'SEARCH_SHOW' => 'Y',
            'SEARCH_SHOW_FIXED' => 'Y',
            'SEARCH_SHOW_MOBILE' => 'Y',
            'BASKET_SHOW' => 'Y',
            'BASKET_SHOW_FIXED' => 'Y',
            'BASKET_SHOW_MOBILE' => 'Y',
            'BASKET_POPUP' => 'Y',
            'DELAY_SHOW' => 'Y',
            'DELAY_SHOW_FIXED' => 'Y',
            'DELAY_SHOW_MOBILE' => 'Y',
            'COMPARE_SHOW' => 'Y',
            'COMPARE_SHOW_FIXED' => 'Y',
            'COMPARE_SHOW_MOBILE' => 'Y',
            'MENU_MAIN_SHOW' => 'Y',
            'MENU_MAIN_SHOW_FIXED' => 'Y',
            'MENU_MAIN_SHOW_MOBILE' => 'Y',
            'MENU_MAIN_DELIMITERS' => 'Y',
            'MENU_MAIN_SECTION_VIEW' => 'images',
            'MENU_MAIN_SUBMENU_VIEW' => 'simple.1',
            'MENU_MAIN_SECTION_COLUMNS_COUNT' => 3,
            'MENU_MAIN_SECTION_ITEMS_COUNT' => 3,
            'MENU_MAIN_CATALOG_LINKS' => [
                '/catalog/'
            ],
            'FORMS_CALL_SHOW' => 'Y',
            'FORMS_CALL_TITLE' => 'Заказать звонок',
            'MENU_POPUP_TEMPLATE' => 1,
            'MENU_POPUP_MODE' => 'simple',
            'MENU_POPUP_THEME' => 'light',
            'MENU_POPUP_BACKGROUND' => 'none',
            'MENU_POPUP_CONTACTS_SHOW' => 'Y',
            'MENU_POPUP_FORMS_FEEDBACK_SHOW' => 'Y',
            'MENU_POPUP_FORMS_FEEDBACK_TITLE' => 'Задать вопрос',
            'MENU_POPUP_SOCIAL_SHOW' => 'Y',
            'MENU_POPUP_BASKET_SHOW' => 'Y',
            'MENU_POPUP_DELAY_SHOW' => 'Y',
            'MENU_POPUP_COMPARE_SHOW' => 'Y',
            'MENU_POPUP_AUTHORIZATION_SHOW' => 'Y',
            'DESKTOP' => 'template.1',
            'PHONES_POSITION' => 'bottom',
            'MENU_MAIN_POSITION' => 'bottom',
            'MENU_MAIN_TRANSPARENT' => 'N',
            'MENU_INFO_SHOW' => 'Y',
            'SOCIAL_SHOW' => 'Y',
            'SOCIAL_SHOW_MOBILE' => 'Y',
            'SOCIAL_POSITION' => 'left',
            'MOBILE' => 'template.1',
            'MOBILE_FIXED' => 'N',
            'MOBILE_FILLED' => 'N',
            'FIXED' => 'template.1',
            'FIXED_MENU_POPUP_SHOW' => 'Y',
            'CATALOG_URL' => '/catalog/',
            'LOGIN_URL' => '/personal/profile/',
            'PROFILE_URL' => '/personal/profile/',
            'PASSWORD_URL' => '/personal/profile/?forgot_password=yes',
            'REGISTER_URL' => '/personal/profile/?register=yes',
            'SEARCH_URL' => '/search/',
            'BASKET_URL' => '/personal/basket/',
            'COMPARE_URL' => '/catalog/compare.php',
            'CONSENT_URL' => '/company/consent/',
            'ORDER_URL' => '/personal/basket/?page=order',
            'COMPOSITE_FRAME_MODE' => 'A',
            'COMPOSITE_FRAME_TYPE' => 'AUTO',
            'SEARCH_CATEGORY_0' => [
                'no'
            ],
            'SEARCH_PRICE_CODE' => [
                'BASE'
            ],
            'SEARCH_PRICE_VAT_INCLUDE' => 'Y',
            'SEARCH_CURRENCY_CONVERT' => 'Y',
            'SEARCH_CURRENCY_ID' => 'RUB'
        ),
        false
    ) ?>
<?= Html::endTag('div') ?>

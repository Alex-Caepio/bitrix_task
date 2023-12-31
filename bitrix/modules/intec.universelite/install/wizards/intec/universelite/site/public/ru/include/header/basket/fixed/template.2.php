<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

/**
 * @global CMain $APPLICATION
 */

?>
<?php $APPLICATION->IncludeComponent(
    'intec.universe:sale.basket.small',
    'template.2',
    array(
        "SETTINGS_USE" => "Y",
        "PANEL_SHOW" => "Y",
        "COMPARE_SHOW" => "Y",
        "COMPARE_CODE" => "compare",
        "COMPARE_IBLOCK_TYPE" => "#CATALOGS_PRODUCTS_IBLOCK_TYPE#",
        "COMPARE_IBLOCK_ID" => "#CATALOGS_PRODUCTS_IBLOCK_ID#",
        "AUTO" => "Y",
        "FORM_ID" => "#FORMS_CALL_ID#",
        "FORM_TITLE" => "Заказать звонок",
        "BASKET_SHOW" => "Y",
        "FORM_SHOW" => "Y",
        "PERSONAL_SHOW" => "Y",
        "SBERBANK_ICON_SHOW" => "Y",
        "QIWI_ICON_SHOW" => "Y",
        "YANDEX_MONEY_ICON_SHOW" => "Y",
        "VISA_ICON_SHOW" => "Y",
        "MASTERCARD_ICON_SHOW" => "Y",
        "DELAYED_SHOW" => "Y",
        "CATALOG_URL" => "#SITE_DIR#catalog/",
        "BASKET_URL" => "#SITE_DIR#personal/basket/",
        "ORDER_URL" => "#ORDER_PAGE_URL#",
        "COMPARE_URL" => "#SITE_DIR#catalog/compare.php",
        "PERSONAL_URL" => "#SITE_DIR#personal/profile/",
        "CONSENT_URL" => "#SITE_DIR#company/consent/"
    ),
    false,
    array()
); ?>
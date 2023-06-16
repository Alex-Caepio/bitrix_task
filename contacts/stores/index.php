<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Контакты");

?>
<?php $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"stores.1",
	array(
		"IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "41",
        "NEWS_COUNT" => "20",
        "SETTINGS_USE" => "Y",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "MAP_VENDOR" => "yandex",
        "SHOW_MAP" => "Y",
        "PHONE_SHOW" => "Y",
        "SCHEDULE_SHOW" => "Y",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/contacts/stores/",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "USE_SEARCH" => "",
        "USE_RSS" => "",
        "USE_RATING" => "",
        "USE_CATEGORIES" => "",
        "USE_REVIEW" => "",
        "USE_FILTER" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "LIST_ACTIVE_DATE_FORMAT" => "",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "",
        "DETAIL_ACTIVE_DATE_FORMAT" => "",
        "DETAIL_FIELD_CODE" => array(
            0 => "ID",
            1 => "CODE",
            2 => "XML_ID",
            3 => "NAME",
            4 => "TAGS",
            5 => "SORT",
            6 => "PREVIEW_TEXT",
            7 => "PREVIEW_PICTURE",
            8 => "DETAIL_TEXT",
            9 => "DETAIL_PICTURE",
            10 => "DATE_ACTIVE_FROM",
            11 => "ACTIVE_FROM",
            12 => "DATE_ACTIVE_TO",
            13 => "ACTIVE_TO",
            14 => "SHOW_COUNTER",
            15 => "SHOW_COUNTER_START",
            16 => "IBLOCK_TYPE_ID",
            17 => "IBLOCK_ID",
            18 => "IBLOCK_CODE",
            19 => "IBLOCK_NAME",
            20 => "IBLOCK_EXTERNAL_ID",
            21 => "DATE_CREATE",
            22 => "CREATED_BY",
            23 => "CREATED_USER_NAME",
            24 => "TIMESTAMP_X",
            25 => "MODIFIED_BY",
            26 => "USER_NAME",
            27 => "",
        ),
        "DETAIL_DISPLAY_TOP_PAGER" => "",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "",
        "DETAIL_PAGER_TITLE" => "",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_SHOW_ALL" => "",
        "SET_LAST_MODIFIED" => "N",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_ELEMENT_CHAIN" => "Y",
        "USE_PERMISSIONS" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "NUM_NEWS" => "",
        "NUM_DAYS" => "",
        "YANDEX" => "",
        "MAX_VOTE" => "",
        "VOTE_NAMES" => "",
        "CATEGORY_IBLOCK" => "",
        "CATEGORY_CODE" => "",
        "CATEGORY_ITEMS_COUNT" => "",
        "MESSAGES_PER_PAGE" => "",
        "USE_CAPTCHA" => "",
        "REVIEW_AJAX_POST" => "",
        "PATH_TO_SMILE" => "",
        "FORUM_ID" => "",
        "URL_TEMPLATES_READ" => "",
        "SHOW_LINK_TO_FORUM" => "",
        "FILTER_NAME" => "",
        "FILTER_FIELD_CODE" => "",
        "FILTER_PROPERTY_CODE" => "",
        "LIST_PROPERTY_CODE" => array(
            0 => "MAP",
            1 => "ADDRESS",
            2 => "PHONE",
            3 => "EMAIL",
            4 => "WORK_TIME",
            5 => "PHONE_HELP",
            6 => "",
        ),
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DETAIL_PROPERTY_CODE" => array(
            0 => "MAP",
            1 => "CITY",
            2 => "ADDRESS",
            3 => "PHONE",
            4 => "EMAIL",
            5 => "WORK_TIME",
            6 => "PHONE_HELP",
            7 => "",
        ),
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y",
        "FILE_404" => "/404.php",
        "MAP" => "MAP",
        "API_KEY_MAP" => "",
        "ADDRESS" => "ADDRESS",
        "PHONE" => "PHONE",
        "EMAIL" => "EMAIL",
        "SCHEDULE" => "WORK_TIME",
        "PROPERTY_MAP" => "MAP",
        "PROPERTY_ADDRESS" => "ADDRESS",
        "PROPERTY_PHONE" => "PHONE",
        "PROPERTY_EMAIL" => "EMAIL",
        "PROPERTY_SCHEDULE" => "WORK_TIME",
        "LAZYLOAD_USE" => "Y",
        "SOCIAL_SERVICES_VK" => "",
        "SOCIAL_SERVICES_FACEBOOK" => "",
        "SOCIAL_SERVICES_INSTAGRAM" => "",
        "SOCIAL_SERVICES_TWITTER" => "",
        "SOCIAL_SERVICES_SKYPE" => "",
        "SOCIAL_SERVICES_YOUTUBE" => "",
        "SOCIAL_SERVICES_OK" => "",
        "FORM_ID" => "",
        "MAP_SHOW" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "LIST_CONTACTS_TEMPLATE" => "default.1",
        "LIST_CONTACTS_LAZYLOAD_USE" => "N",
        "LIST_CONTACTS_SHOW_MAP" => "N",
        "LIST_CONTACTS_MAP_VENDOR" => "google",
        "LIST_CONTACTS_SETTINGS_USE" => "N",
        "LIST_CONTACTS_PROPERTY_MAP" => "",
        "LIST_CONTACTS_API_KEY_MAP" => "",
        "LIST_CONTACTS_PROPERTY_ADDRESS" => "",
        "LIST_CONTACTS_PROPERTY_PHONE" => "",
        "LIST_CONTACTS_PROPERTY_EMAIL" => "",
        "LIST_CONTACTS_PROPERTY_SCHEDULE" => "",
        "LIST_CONTACTS_DESCRIPTION_SHOW" => "N",
        "LIST_STORES_TEMPLATE" => "default.1",
        "LIST_STORES_MAP_ID" => "",
        "LIST_STORES_SETTINGS_USE" => "N",
        "LIST_STORES_LAZYLOAD_USE" => "N",
        "DETAIL_CONTACT_TEMPLATE" => "default.2",
        "DETAIL_CONTACT_DESCRIPTION_SHOW" => "Y",
        "DETAIL_CONTACT_PICTURE_SHOW" => "Y",
        "DETAIL_CONTACT_ADDRESS_SHOW" => "Y",
        "DETAIL_CONTACT_PHONE_SHOW" => "Y",
        "DETAIL_CONTACT_PROPERTY_PHONE" => "PHONE",
        "DETAIL_CONTACT_EMAIL_SHOW" => "Y",
        "DETAIL_CONTACT_SCHEDULE_SHOW" => "Y",
        "DETAIL_CONTACT_PROPERTY_SCHEDULE" => "WORK_TIME",
        "DETAIL_CONTACT_SOCIAL_SERVICES_SHOW" => "Y",
        "DETAIL_CONTACT_FORM_SHOW" => "Y",
        "DETAIL_STORE_TEMPLATE" => "default.2",
        "DETAIL_STORE_PICTURE_SHOW" => "Y",
        "DETAIL_STORE_ADDRESS_SHOW" => "Y",
        "DETAIL_STORE_PHONE_SHOW" => "Y",
        "DETAIL_STORE_EMAIL_SHOW" => "Y",
        "DETAIL_STORE_SCHEDULE_SHOW" => "Y",
        "DETAIL_STORE_DESCRIPTION_SHOW" => "Y",
        "DETAIL_STORE_SOCIAL_SERVICES_SHOW" => "Y",
        "DETAIL_STORE_FORM_SHOW" => "Y",
        "DETAIL_CONTACT_PICTURE_SOURCE" => "preview",
        "DETAIL_CONTACT_PROPERTY_ADDRESS" => "ADDRESS",
        "DETAIL_CONTACT_PROPERTY_EMAIL" => "EMAIL",
        "DETAIL_CONTACT_API_KEY_MAP" => "",
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_ID#/",
        )
    ),
	false
) ?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php") ?>

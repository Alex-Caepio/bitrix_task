<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global $APPLICATION
 */

$APPLICATION->SetTitle("Блог");

?><?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"",
	Array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "j M Y",
		"DETAIL_ADDITIONAL_NEWS_COLUMNS" => "2",
		"DETAIL_ADDITIONAL_NEWS_DATE_SHOW" => "Y",
		"DETAIL_ADDITIONAL_NEWS_HEADER_SHOW" => "Y",
		"DETAIL_ADDITIONAL_NEWS_HEADER_TEXT" => "Читайте также",
		"DETAIL_ADDITIONAL_NEWS_LINK_BLANK" => "Y",
		"DETAIL_ADDITIONAL_NEWS_LINK_USE" => "Y",
		"DETAIL_ADDITIONAL_NEWS_SHOW" => "Y",
		"DETAIL_ADDITIONAL_NEWS_SLIDER_AUTO_USE" => "N",
		"DETAIL_ADDITIONAL_NEWS_SLIDER_LOOP" => "N",
		"DETAIL_BUTTON_BACK_SHOW" => "Y",
		"DETAIL_BUTTON_SOCIAL_SHOW" => "N",
		"DETAIL_DATE_SHOW" => "Y",
		"DETAIL_DATE_TYPE" => "DATE_ACTIVE_FROM",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array("",""),
		"DETAIL_IMAGE_SHOW" => "Y",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PREVIEW_SHOW" => "Y",
		"DETAIL_PRINT_SHOW" => "Y",
		"DETAIL_PROPERTY_ADDITIONAL_NEWS" => "ASSOCIATED",
		"DETAIL_PROPERTY_CODE" => array("TAGS","ASSOCIATED",""),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_TAGS_POSITION" => "top",
		"DETAIL_TAGS_SHOW" => "Y",
		"DETAIL_TEMPLATE" => "default.1",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILE_404" => "/404.php",
		"FILTER" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "34",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "j M Y",
		"LIST_COLUMNS" => "3",
		"LIST_DATE_SHOW" => "Y",
		"LIST_DATE_TYPE" => "DATE_ACTIVE_FROM",
		"LIST_FIELD_CODE" => array("",""),
		"LIST_LINK_BLANK" => "N",
		"LIST_PREVIEW_SHOW" => "Y",
		"LIST_PREVIEW_TRUNCATE_COUNT" => "30",
		"LIST_PREVIEW_TRUNCATE_USE" => "Y",
		"LIST_PROPERTY_CODE" => array("TAGS","ASSOCIATED",""),
		"LIST_TAGS_MODE" => "active",
		"LIST_TAGS_SHOW" => "Y",
		"LIST_TEMPLATE" => "tile.1",
		"LIST_VIEW" => "big",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PANEL_SHOW" => "Y",
		"PANEL_VARIABLE" => "year",
		"PANEL_VIEW" => "1",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_TAGS" => "TAGS",
		"SEF_FOLDER" => "/blog/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("detail"=>"#ELEMENT_ID#/","news"=>"","section"=>"#SECTION_CODE#/"),
		"SETTINGS_PROFILE" => "blog",
		"SETTINGS_USE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "Y",
		"SUBSCRIBE_AJAX_OPTION_ADDITIONAL" => "",
		"SUBSCRIBE_ALLOW_ANONYMOUS" => "Y",
		"SUBSCRIBE_HEADER_POSITION" => "center",
		"SUBSCRIBE_HEADER_SHOW" => "Y",
		"SUBSCRIBE_HEADER_TEXT" => "Подписывайтесь на новости и акции:",
		"SUBSCRIBE_PAGES" => "all",
		"SUBSCRIBE_RUBRICS" => array(),
		"SUBSCRIBE_RUBRICS_HIDDEN_USE" => "N",
		"SUBSCRIBE_SHOW_AUTH_LINKS" => "N",
		"SUBSCRIBE_SHOW_HIDDEN" => "N",
		"SUBSCRIBE_USE" => "N",
		"SUBSCRIBE_USER_CONSENT" => "N",
		"SUBSCRIBE_USER_CONSENT_ID" => "",
		"SUBSCRIBE_USER_CONSENT_IS_CHECKED" => "Y",
		"SUBSCRIBE_USER_CONSENT_IS_LOADED" => "N",
		"TAGS_COUNT" => "Y",
		"TAGS_HEADER_SHOW" => "Y",
		"TAGS_HEADER_TEXT" => "Популярное сейчас",
		"TAGS_SECTION_SUBSECTIONS" => "Y",
		"TAGS_TEMPLATE" => "template.2",
		"TAGS_USE" => "Y",
		"TAGS_USED" => "Y",
		"TAGS_VARIABLE" => "tags",
		"TOP_COUNT" => "5",
		"TOP_DATE_SHOW" => "Y",
		"TOP_DATE_TYPE" => "DATE_ACTIVE_FROM",
		"TOP_HEADER_SHOW" => "Y",
		"TOP_HEADER_TEXT" => "Самые читаемые",
		"TOP_LINK_BLANK" => "Y",
		"TOP_LINK_USE" => "Y",
		"TOP_ORDER_BY" => "DESC",
		"TOP_PAGES" => "all",
		"TOP_SORT_BY" => "ACTIVE_FROM",
		"TOP_TAGS_MODE" => "active",
		"TOP_TAGS_SHOW" => "Y",
		"TOP_USE" => "Y",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N"
	)
);?><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php") ?>
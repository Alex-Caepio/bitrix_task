<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\collections\Arrays;
use intec\core\helpers\Html;
use intec\core\io\Path;

/**
 * @var Arrays $blocks
 * @var array $block
 * @var array $data
 * @var string $page
 * @var Path $path
 * @global CMain $APPLICATION
 */

?>
<?= Html::beginTag('div') ?>
<?php $APPLICATION->IncludeComponent('intec.universe:main.widget', 'contacts.1', array (
  'IBLOCK_ID' => '41',
  'IBLOCK_TYPE' => 'content',
  'ADDRESS_SHOW' => 'Y',
  'PROPERTY_CODE' => 
  array (
    0 => 'ADDRESS',
    1 => 'CITY',
    2 => 'PHONE',
    3 => 'MAP',
  ),
  'CACHE_TIME' => 3600000,
  'CACHE_TYPE' => 'A',
  'CONSENT_URL' => '/company/consent/',
  'FEEDBACK_BUTTON_TEXT' => 'Написать',
  'FEEDBACK_IMAGE' => '#TEMPLATE_PATH#/images/face.png',
  'FEEDBACK_IMAGE_SHOW' => 'Y',
  'FEEDBACK_SHOW' => 'Y',
  'FEEDBACK_TEXT' => 'Связаться с руководителем',
  'FEEDBACK_TEXT_SHOW' => 'Y',
  'FORM_ID' => '2',
  'FORM_TEMPLATE' => '.default',
  'MAIN' => '320',
  'MAP_VENDOR' => 'yandex',
  'NEWS_COUNT' => '20',
  'PHONE_SHOW' => 'Y',
  'PROPERTY_ADDRESS' => 'ADDRESS',
  'PROPERTY_CITY' => 'CITY',
  'PROPERTY_MAP' => 'MAP',
  'PROPERTY_PHONE' => 'PHONE',
  'SETTINGS_USE' => 'Y',
  'SHOW_FORM' => 'Y',
  'STAFF_DEFAULT' => '#TEMPLATE_PATH#images/face.png',
  'STAFF_IBLOCK_ID' => '29',
  'STAFF_IBLOCK_TYPE' => 'content',
  'STAFF_PERSON' => '',
  'STAFF_SHOW' => 'Y',
  'WEB_FORM_CONSENT_URL' => '/company/consent/',
  'WEB_FORM_ID' => '2',
  'WEB_FORM_NAME' => 'Задать вопрос',
  'WEB_FORM_TEMPLATE' => '.default',
), false) ?>
<?= Html::endTag('div') ?>

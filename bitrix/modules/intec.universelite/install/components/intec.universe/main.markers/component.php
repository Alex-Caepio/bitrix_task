<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use intec\core\helpers\ArrayHelper;

/**
 * @var array $arResult
 * @var array $arParams
 */

$markerHit = ArrayHelper::getValue($arParams, 'HIT');
$markerNew = ArrayHelper::getValue($arParams, 'NEW');
$markerRecommend = ArrayHelper::getValue($arParams, 'RECOMMEND');
$markerShare = ArrayHelper::getValue($arParams, 'SHARE');

$arResult = [
    'HIT' => $markerHit === true || $markerHit === 'Y',
    'NEW' => $markerNew === true || $markerNew === 'Y',
    'RECOMMEND' => $markerRecommend === true || $markerRecommend === 'Y',
    'SHARE' => $markerShare === true || $markerShare === 'Y',
];

$this->includeComponentTemplate();
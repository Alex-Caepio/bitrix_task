<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arCurrentValues
 */

$arFormsTemp = array();

$arForms = array();
$dbForms = CStartShopForm::GetList();
while ($arForm = $dbForms->Fetch()) {
    $arForms[$arForm['ID']] = '[' . $arForm['ID'] . '] ' . (!empty($arForm['LANG'][LANGUAGE_ID]['NAME']) ? $arForm['LANG'][LANGUAGE_ID]['NAME'] : $arForm['CODE']);
    $arFormsTemp[$arForm['ID']] = $arForm['LANG'][LANGUAGE_ID]['NAME'];
}

$rsTemplates = CComponentUtil::GetTemplatesList('intec:startshop.forms.result.new');

if (!empty($arCurrentValues['ID'])) {
    $sFormName = $arFormsTemp[$arCurrentValues['ID']];
}
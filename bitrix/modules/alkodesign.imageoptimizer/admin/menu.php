<?php
IncludeModuleLangFile(__FILE__);
$rights = $APPLICATION->GetGroupRight("support");
if($rights > "D")
{
  $aMenu = [];
  $aMenu[] = array(
      "parent_menu" => "global_menu_alkodesign",
      "sort" => 50,
      "text" => GetMessage("ALKO_OPTIMIZER_NAME"),
      "title" => GetMessage("ALKO_OPTIMIZER_TITLE"),
      "url" => "alkodesign_optimizer.php?lang=".LANGUAGE_ID,
      "more_url" => array("alkodesign_optimizer.php"),
      'icon' => 'adm-submenu-item-link-icon iblock_menu_icon_types',
       'page_icon' => 'adm-submenu-item-link-icon iblock_menu_icon_types',
  );
  return $aMenu;
}
<?php

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Alkodesign\Optimizer\Check;
use Alkodesign\Optimizer\Optimizer;
if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}
$curModuleName = "alkodesign.imageoptimizer";
Bitrix\Main\Loader::includeModule($curModuleName);
Bitrix\Main\Loader::includeModule('iblock');
$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();
Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

$aTabs = array(
    array(
        "DIV" => "edit-total",
        "TAB" => Loc::getMessage("ALKO_TOTAL"),
        "ICON" => "main_settings",
        "TITLE" => Loc::getMessage("ALKO_TOTAL_SETTINGS")
    ),
    array(
        "DIV" => "edit-local",
        "TAB" => Loc::getMessage("ALKO_LOCAL"),
        "ICON" => "main_settings",
        "TITLE" => Loc::getMessage("ALKO_LOCAL_SETTINGS")
    ),
    array(
        "DIV" => "edit-remote",
        "TAB" => Loc::getMessage("ALKO_REMOTE"),
        "ICON" => "main_settings",
        "TITLE" => Loc::getMessage("ALKO_REMOTE_SETTINGS")
    ),
);

$arrIBlocks = array();
$arIBlocks = array();
$arIBlocks[0] = GetMessage('ALKO_IBLOCKS_EMPTY');
$arrPropList = array();
$res = CIBlock::GetList(array(), array('ACTIVE' => 'Y'), true);
while ($arFields = $res->Fetch()) {
	$arrIBlocks[] = $arFields;
	$arIBlocks[$arFields['ID']] = '['.$arFields['ID'].'] '.$arFields['NAME'];
}

$arIBlocksOpt_sect = explode(',', COption::GetOptionString($curModuleName, 'iblocks_sect', ''));

$tabControl = new CAdminTabControl("tabControl", $aTabs);

if ($request->isPost() && check_bitrix_sessid()) {

    if($request->getPost('test_module')) {
        $text = array();
        $error = false;
        if(!Check::isJPEGOptim()) {
            $text[] = Loc::getMessage('ALKO_IMAGECOMPRESS_ERROR_CHECK_NOFOUND',array('#MODULE#'=>'jpegoptim'));
        }
        if(!Check::isPNGOptim()) {
            $text[] = Loc::getMessage('ALKO_IMAGECOMPRESS_ERROR_CHECK_NOFOUND',array('#MODULE#'=>'optipng'));
        }
        if(!$text) {
            $text = Loc::getMessage("ALKO_COMPRESS_OPTIONS_TESTED");
        } else {
            $error = true;
            $text = implode (
                PHP_EOL,
                array_merge(
                    array(Loc::getMessage("ALKO_COMPRESS_OPTIONS_NO_TESTED")),
                    $text
                )
            );
        }
        CAdminMessage::showMessage(array(
            "MESSAGE" => $text,
            "TYPE" => (!$error?'OK':'ERROR'),
        ));
    } else {
        $compressService = $request->getPost('compress_service');
        if($compressService 
                && in_array($compressService, array(Optimizer::USE_LOCAL_SERVICE, Optimizer::USE_REMOTE_SERVICE))) {
            Option::set($curModuleName, 'compress_service', $compressService);
        }
      
        if($pthJpeg = $request->getPost('path_to_jpegoptim')) {
            $pthJpeg = rtrim($pthJpeg,'/');
            Option::set($curModuleName,'path_to_jpegoptim',$pthJpeg);
        }

        if($pthPng = $request->getPost('path_to_optipng')) {
            $pthPng = rtrim($pthPng,'/');
            Option::set($curModuleName,'path_to_optipng',$pthPng);
        }
		
        if($iblocks_sect = $request->getPost('iblocks_sect')) {
           $iblocks_sect = implode(',',$iblocks_sect);
            Option::set($curModuleName,'iblocks_sect',$iblocks_sect);
        }
		if($iblocks_elemnt = $request->getPost('iblocks_elemnt')) {
           $iblocks_elemnt = implode(',',$iblocks_elemnt);
            Option::set($curModuleName,'iblocks_elemnt',$iblocks_elemnt);
        }
        $enableElement = $request->getPost('enable_element');
        Option::set($curModuleName,'enable_element',($enableElement?'Y':'N'));

        $enableSection = $request->getPost('enable_section');
        Option::set($curModuleName,'enable_section',($enableSection?'Y':'N'));

        $enableResize = $request->getPost('enable_resize');
        Option::set($curModuleName,'enable_resize',($enableResize?'Y':'N'));

        $enableSave = $request->getPost('enable_save');
        Option::set($curModuleName,'enable_save',($enableSave?'Y':'N'));

        Option::set($curModuleName,'jpegoptim_compress',$request->getPost('jpegoptim_compress'));
        Option::set($curModuleName,'optipng_compress',$request->getPost('optipng_compress'));

        $jpegCompress = $request->getPost('jpeg_progressive');
        Option::set($curModuleName,'jpeg_progressive',($jpegCompress?'Y':'N'));
        
        $remoteServiceAddr = $request->getPost('remote_service_addr');
        Option::set($curModuleName,'remote_service_addr',$remoteServiceAddr);
        
        $remoteServiceKey = $request->getPost('remote_service_key');
        Option::set($curModuleName,'remote_service_key', $remoteServiceKey);

        CAdminMessage::showMessage(array(
            "MESSAGE" => Loc::getMessage("ALKO_COMPRESS_REFERENCES_OPTIONS_SAVED"),
            "TYPE" => "OK",
        ));
    }
}
$tabControl->Begin();
?>
<script>
function check_section(){
	if(document.getElementById("enable_section").checked)
	{
		document.getElementById('ib_sect').style.display = 'table-row';
	}
	else
	{
		document.getElementById('ib_sect').style.display = 'none';
	}

};
function check_element(){
	if(document.getElementById("enable_element").checked)
	{
		document.getElementById('ib_element').style.display = 'table-row';
	}
	else
	{
		document.getElementById('ib_element').style.display = 'none';
	}
};
</script>
<form method="post" action="<?=sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID)?>">
    <?php
    echo bitrix_sessid_post();
    $tabControl->beginNextTab();
    ?>
    <tr>
        <td width="40%">
            <label for="compress_service">
                <?=Loc::getMessage("ALKO_COMPRESS_SERVICE") ?>:
            </label>
        </td>
        <td width="60%">
            <select name="compress_service" id="compress_service_select">
                <?
                $compressService = Option::get($curModuleName, "compress_service", Optimizer::USE_LOCAL_SERVICE);
                ?>
                <option value="<?=Optimizer::USE_LOCAL_SERVICE?>" <?=(Optimizer::USE_LOCAL_SERVICE == $compressService ? 'selected' : '')?>>
                        <?=Loc::getMessage("ALKO_COMPRESS_SERVICE_LOCAL");?>
                </option>
                <option value="<?=Optimizer::USE_REMOTE_SERVICE?>" <?=(Optimizer::USE_REMOTE_SERVICE == $compressService ? 'selected' : '')?>>
                                <?=Loc::getMessage("ALKO_COMPRESS_SERVICE_REMOTE");?>
                </option>
            </select>
        </td>
    </tr>
    

    <tr>
        <td width="40%">
            <label for="enable_element">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_ENABLE_ELEMENT") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="checkbox"
                   name="enable_element"
				   id='enable_element'
                   value="Y"
				   onchange="check_element(this)"
                   <?
                   if(Option::get($curModuleName, "enable_element")=='Y') {
                       echo 'checked';
                   }
                   ?>
            />
        </td>
    </tr>
	    <tr id='ib_element' <?if(Option::get($curModuleName, "enable_element")!=='Y') {
                       echo 'style="display:none;"';
                   }?>>
        <td width="40%">
            <label for="enable_element_iblock">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_ENABLE_ELEMENT_IBLOCK") ?>:
            </label>
        </td>
        <td width="60%">
		<select size="5" multiple="" name="iblocks_elemnt[]">
		      <?
			  $arIBlocksOpt_elem = explode(',', Option::get($curModuleName, 'iblocks_elemnt', ''));
                foreach($arIBlocks as $key=>$val){ ?>
                    <option value="<?=$key?>" <?=(in_array($key,$arIBlocksOpt_elem)?'selected':'')?>><?=$val?></option>
                <? } ?>
		</select>
        </td>
    </tr>
	    <tr>
        <td width="40%">
            <label for="enable_section">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_ENABLE_SECTION") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="checkbox"
                   name="enable_section"
                   value="Y"
				   id='enable_section'
				   onchange="check_section(this)"
                   <?
                   if(Option::get($curModuleName, "enable_section")=='Y') {
                       echo 'checked';
                   }
                   ?>
            />
        </td>
    </tr>
    <tr id='ib_sect' <?if(Option::get($curModuleName, "enable_section")!=='Y') {
                       echo 'style="display:none;"';
                   }?>>
        <td width="40%">
            <label for="enable_section_iblock">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_ENABLE_SECTION_IBLOCK") ?>:
            </label>
        </td>
        <td width="60%">
		<select size="5" multiple="" name="iblocks_sect[]">
		      <?
			  $arIBlocksOpt_sect = explode(',', Option::get($curModuleName, 'iblocks_sect', ''));
                foreach($arIBlocks as $key=>$val){ ?>
                    <option value="<?=$key?>" <?=(in_array($key,$arIBlocksOpt_sect)?'selected':'')?>><?=$val?></option>
                <? } ?>
		</select>
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="enable_resize">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_ENABLE_RESIZE") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="checkbox"
                   name="enable_resize"
                   value="Y"
                <?
                if(Option::get($curModuleName, "enable_resize")=='Y') {
                    echo 'checked';
                }
                ?>
            />
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="enable_save">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_ENABLE_SAVE") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="checkbox"
                   name="enable_save"
                   value="Y"
                <?
                if(Option::get($curModuleName, "enable_save")=='Y') {
                    echo 'checked';
                }
                ?>
            />
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="jpegoptim_compress">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_JPEG_COMPRESS") ?>:
            </label>
        </td>
        <td width="60%">
            <select name="jpegoptim_compress">
                <?
                $jpgCompress = Option::get($curModuleName, "jpegoptim_compress", '80');
                for($i=0;$i<=100;$i+=5){ ?>
                    <option value="<?=$i?>" <?=($i==$jpgCompress?'selected':'')?>><?=$i?></option>
                <? } ?>
            </select>
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="enable_element">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_JPEG_PROGRESSIVE") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="checkbox"
                   name="jpeg_progressive"
                   value="Y"
                <?
                if(Option::get($curModuleName, "jpeg_progressive")=='Y') {
                    echo 'checked';
                }
                ?>
            />
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="optipng_compress">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_PNG_COMPRESS") ?>:
            </label>
        </td>
        <td width="60%">
            <select name="optipng_compress">
                <?
                $pngCompress = Option::get($curModuleName, "optipng_compress", '3');
                for($i=1;$i<=7;$i++){ ?>
                    <option value="<?=$i?>" <?=($i==$pngCompress?'selected':'')?>><?=$i?></option>
                <? } ?>
            </select>
        </td>
    </tr>
    <?php
    $tabControl->beginNextTab();
    ?>
    <tr>
        <td width="40%">
            <label for="path_to_jpegoptim">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_PATH_JPEGOPTI") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="text"
                   size="50"
                   name="path_to_jpegoptim"
                   value="<?=Option::get($curModuleName, "path_to_jpegoptim", '/usr/bin');?>"
            />
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="path_to_optipng">
                <?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_PATH_PNGOPTI") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="text"
                   size="50"
                   name="path_to_optipng"
                   value="<?=Option::get($curModuleName, "path_to_optipng", '/usr/bin');?>"
            />
        </td>
    </tr>
  <?php
    $tabControl->beginNextTab();
    ?>
    <tr>
        <td width="40%">
            <label for="remote_service_addr">
                <?=Loc::getMessage("ALKO_REMOTE_SERVICE_ADDR") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="text"
					disabled
					readonly
                   size="50"
                   name="remote_service_addr"
                   value="<?=Option::get($curModuleName, "remote_service_addr", \Alkodesign\Optimizer\CompressRemote::DEFAULT_SERVICE_ADDR);?>"
            />
        </td>
    </tr>
    <tr>
        <td width="40%">
            <label for="remote_service_key">
                <?=Loc::getMessage("ALKO_REMOTE_SERVICE_KEY") ?>:
            </label>
        </td>
        <td width="60%">
            <input type="text"
                   size="50"
                   name="remote_service_key"
                   value="<?=Option::get($curModuleName, "remote_service_key", '');?>"
            />
        </td>
    </tr>
    <?php
    $tabControl->buttons();
    ?>
    <input type="submit"
           name="save"
           value="<?=Loc::getMessage("MAIN_SAVE") ?>"
           title="<?=Loc::getMessage("MAIN_OPT_SAVE_TITLE") ?>"
           class="adm-btn-save"
    />
    <input type="submit"
           name="test_module"
           value="<?=Loc::getMessage("ALKO_COMPRESS_REFERENCES_TEST_BTN") ?>"
    />
    <? $tabControl->end(); ?>
</form>

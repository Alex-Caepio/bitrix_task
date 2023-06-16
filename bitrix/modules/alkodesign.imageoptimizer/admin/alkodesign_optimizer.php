<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php"); 
\Bitrix\Main\Loader::includeModule('alkodesign.imageoptimizer');
IncludeModuleLangFile(__FILE__);
global $DB;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
$APPLICATION->SetTitle(GetMessage("ALKO_OPTIMIZE_TITLE"));
$cssPath = '/bitrix/css/alkodesign.imageoptimizer';
$jsPath = '/bitrix/js/alkodesign.imageoptimizer';
$APPLICATION->SetAdditionalCSS("{$cssPath}/skin/ui.dynatree.css");
$APPLICATION->SetAdditionalCSS("{$cssPath}/jquery-ui.min.css");
$APPLICATION->AddHeadScript("{$jsPath}/jquery-3.3.1.js");
$APPLICATION->AddHeadScript("{$jsPath}/jquery-ui.min.js");
$APPLICATION->AddHeadScript("{$jsPath}/jquery.cookie.js");
$APPLICATION->AddHeadScript("{$jsPath}/jquery.dynatree.js");
$arr = array('PREVIEW_PICTURE_ID' => 89);
$dirlist = \Alkodesign\Optimizer\File::getDirList();
?>
<div class="adm-info-message-wrap adm-info-message-red" id="optimize-info-message">
	<div class="adm-info-message">
		<div class="adm-info-message-title"><?=GetMessage("ALKO_OPTIMIZE_ALERT");?></div>
        <?=GetMessage("ALKO_WAIT_OPTIMISATION_END");?>
		<div class="adm-info-message-icon"></div>
	</div>
</div>
<div id="dir-list-tree"></div>
<button type="button" class="adm-btn-save" id="start-optimisation-button"><?=GetMessage("ALKO_OPTIMIZE_START");?></button>
<div class="progress-bar">
  <div id="optimisation-progress"></div>
  <div id="optimisation-progress-text"></div>
</div>
<script type="text/javascript">
window.addEventListener('load', function(){
  
  var dynatree = initDynatree();
  
  $('#start-optimisation-button').click(function(e){
    e.preventDefault();
    if(startOptimize(dynatree))
    {
      $(this).hide();
    }
  });
  
  function initDynatree()
  {
    return $("#dir-list-tree").dynatree({
      selectMode: 3,
      children: <?=json_encode($dirlist)?>,
      checkbox: true
    }).dynatree("getTree");
  }
  
  function startOptimize(dynatree)
  {
    var dirList = getDirList(dynatree);
    if(dirList.length === 0)
    {
      alert('<?=GetMessage("ALKO_OPTIMIZE_GETDIR");?>');
      return false;
    }
    setProgress(0, 0, '<?=GetMessage("ALKO_OPTIMIZE_STARTLIST");?>');
    showInfoMessage();
    BX.ajax({   
                url: '/bitrix/tools/alkodesign/optimizer_controller.php',
                data: {dirList : dirList, action: "getFileList", lang : <?=json_encode(LANGUAGE_ID);?>},
                method: 'POST',
                dataType: 'json',
                async: true,
                onsuccess: function(data){
                  optimizateFiles(data)
                },
                onfailure: function(){
                  
                }
            });
    return true;
  }
  
  function showInfoMessage()
  {
    $('#optimize-info-message').show();
  }
  
  function hideInfoMessage()
  {
    $('#optimize-info-message').hide();
  }
  
  /**
  * отпимизация файлов files
   * @param {Array} files
   * @returns {undefined}   
   * */
  function optimizateFiles(files)
  {
    var cursor = 0;
    
    /**
     * получение следующего файла из files
     * @type Arguments
     */
    function getNextFile()
    {
      var file = files[cursor];
      cursor++;
      return file;
    }
    
    /**
     * оптимизация файла расположенного в file
     * @param {string} file
     * @returns {undefined}
     */
    function optimizateFile(file)
    {
      if(isEndOptimizate())
      {
        eventEndOptimizate();
        return;
      }
      BX.ajax({   
                url: '/bitrix/tools/alkodesign/optimizer_controller.php',
                data: {file : file, action: "optimizateFile", lang : <?=json_encode(LANGUAGE_ID);?>, },
                method: 'POST',
                dataType: 'json',
                async: true,
                onsuccess: function(data){
                  setProgress(cursor, files.length, '<?=GetMessage("ALKO_OPTIMIZE_PROGRESSFROM");?> ' + cursor  + ' <?=GetMessage("ALKO_OPTIMIZE_FROM");?> ' + files.length);
                  optimizateFile(getNextFile());
                },
                onfailure: function(){
                  
                }
            });
    }
    
    /**
    * Завершена ли оптимизация
     * @returns {Boolean}     
     */
    function isEndOptimizate()
    {
      return cursor > files.length;
    }
    
    /**
    * завершение оптимизации
    * @returns {undefined}     */
    function eventEndOptimizate()
    {
      setProgress(files.length, files.length, '<?=GetMessage("ALKO_OPTIMIZE_COMPLETE");?>');
      $('#start-optimisation-button').show();
      hideInfoMessage();
    }
    
    optimizateFile(getNextFile());
  }
  
  /**
  * установка значения прогессбара
   * @param {number} current
   * @param {number} total
   * @param {string} text
   * @returns {undefined}   */
  function setProgress(current, total, text)
  {
    $("#optimisation-progress").progressbar({
      value: current,
      max: total
    });
    if(text === undefined)
    {
      text = current + ' / ' + total;
    }
    $("#optimisation-progress-text").text(text);
  }
  
  /**
  * получение списка родительских директорий, в которых надо оптимизировать все файлы (включая поддиректории)
   * @param {type} dynatree
   * @returns {Array}   */
  function getDirList(dynatree)
  {
    var dirList = [];
    dynatree.getSelectedNodes(true).forEach(
            function(item, i, arr) 
            {
              dirList.push(item.data.value);
            });
    return dirList;
  }
  
});
</script>
<style>
  #optimisation-progress{
    width:100%;
    height:30px;
  }
  #optimisation-progress-text{
    margin-top: -30px;
    width:100%;
    height:30px;
    line-height:30px;
    text-align: center;
  }
  .progress-bar{
    margin: 10px 0;
  }
  #optimize-info-message{
    display:none;
  }
</style>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php")?>
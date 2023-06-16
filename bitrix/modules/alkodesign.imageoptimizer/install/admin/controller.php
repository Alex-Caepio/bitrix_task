<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); 
\Bitrix\Main\Loader::includeModule('alkodesign.imageoptimizer');
IncludeModuleLangFile(__FILE__);
global $DB;
set_time_limit(0);
$action = $_REQUEST['action'];
switch($action)
{
  case 'getFileList':
    echo Alkodesign\Optimizer\Actions::getFileList($_REQUEST['dirList']);
    return;
  case 'optimizateFile':
    echo Alkodesign\Optimizer\Actions::optimizateFile($_REQUEST['file']);
    return;
}
<? include(__DIR__.'/.begin.php') ?>
<?

use intec\core\base\Collection;

/**
 * @var Collection $data
 * @var array $languages
 * @var string $solution
 * @var CWizardBase $wizard
 * @var Closure($code, $type, $file, $fields = []) $import
 * @var CWizardStep $this
 */

$code = $solution.'_articles_'.WIZARD_SITE_ID;
$type = 'content';
$iBlock = $import($code, $type, 'content.articles');

if (!empty($iBlock)) {
    $macros = $data->get('macros');
    $macros['CONTENT_ARTICLES_IBLOCK_TYPE'] = $type;
    $macros['CONTENT_ARTICLES_IBLOCK_ID'] = $iBlock['ID'];
    $macros['CONTENT_ARTICLES_IBLOCK_CODE'] = $iBlock['CODE'];
    $data->set('macros', $macros);
}

?>
<? include(__DIR__.'/.end.php') ?>
<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\bitrix\Component;
use intec\core\helpers\Html;

/**
 * @var array $arResult
 */

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arVisual = $arResult['VISUAL'];

?>
<?= Html::beginTag('div', [
    'id' => $sTemplateId,
    'class' => [
        'widget',
        'c-form',
        'c-form-template-2'
    ],
    'data-lazyload-use' => $arVisual['LAZYLOAD']['USE'] && $arVisual['BACKGROUND']['USE'] ? 'true' : 'false',
    'data-original' => $arVisual['LAZYLOAD']['USE'] && $arVisual['BACKGROUND']['USE'] ? $arVisual['BACKGROUND']['PATH'] : null,
    'data-theme' => $arVisual['THEME'],
    'data-background' => $arVisual['BACKGROUND']['USE'] ? 'true' : null,
    'data-button-position' => $arVisual['BUTTON']['POSITION'],
    'style' => [
        'background-image' => $arVisual['BACKGROUND']['USE'] ? (!$arVisual['LAZYLOAD']['USE'] ? 'url(\''.$arVisual['BACKGROUND']['PATH'].'\')' : null) : null
    ]
]) ?>
    <div class="widget-wrapper intec-content">
        <div class="widget-wrapper-2 intec-content-wrapper">
            <div class="<?= Html::cssClassFromArray([
                'widget-wrapper-3',
                'intec-grid' => [
                    '',
                    'wrap',
                    'a-v-center',
                    'a-h-center'
                ]
            ], false) ?>">
                <div class="<?= Html::cssClassFromArray([
                    'widget-form-text' => true,
                    'intec-grid-item' => [
                        '' => $arVisual['BUTTON']['POSITION'] == 'right',
                        '1000-1' => $arVisual['BUTTON']['POSITION'] == 'right',
                        '1' => $arVisual['BUTTON']['POSITION'] == 'center'
                    ]
                ], true) ?>">
                    <div class="widget-form-header">
                        <?= $arVisual['BODY']['TEXT'] ?>
                    </div>
                    <?php if ($arVisual['BODY']['DESCRIPTION']['SHOW']) { ?>
                        <div class="widget-form-description">
                            <?= $arVisual['BODY']['DESCRIPTION']['TEXT'] ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($arVisual['BUTTON']['SHOW']) { ?>
                    <div class="widget-form-action intec-grid-item-auto">
                        <div class="widget-form-button-wrap">
                            <?= Html::tag('div', $arVisual['BUTTON']['TEXT'], [
                                'class' => [
                                    'widget-form-button',
                                    'intec-cl-background',
                                    'intec-cl-background-light-hover'
                                ],
                                'data-role' => 'form.button'
                            ]) ?>
                            <?php if ($arVisual['BUTTON']['UNDER']['SHOW']) { ?>
                                <div class="widget-form-button-under">
                                    <?= $arVisual['BUTTON']['UNDER']['TEXT'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if ($arVisual['BUTTON']['SHOW'])
        include(__DIR__.'/parts/script.php');
    ?>
<?= Html::endTag('div') ?>
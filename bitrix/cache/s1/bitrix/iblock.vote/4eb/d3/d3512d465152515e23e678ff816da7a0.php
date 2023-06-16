<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001684515416';
$dateexpire = '001720515416';
$ser_content = 'a:2:{s:7:"CONTENT";s:3582:"<div id="i-29-bitrix-iblock-vote-template-1-NLJNn1hMEOEL" class="ns-bitrix c-iblock-vote c-iblock-vote-template-1" data-id="97">    <!--\'start_frame_cache_OQ9Qzh\'-->        <div class="iblock-vote-rating" data-role="container">
                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="1" data-role="container.vote" data-active="false" data-value="0"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="2" data-role="container.vote" data-active="false" data-value="1"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="3" data-role="container.vote" data-active="false" data-value="2"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="4" data-role="container.vote" data-active="false" data-value="3"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="5" data-role="container.vote" data-active="false" data-value="4"></i>                                </div>
        <script type="text/javascript">
    template.load(function (data) {
        var $ = this.getLibrary(\'$\');
        var root = data.nodes;
        var id = root.data(\'id\');
        var voted = false;
        var container = $(\'[data-role="container"]\', root);
        var votes = $(\'[data-role="container.vote"]\', container);

        root.update = function (rating) {
            votes.each(function () {
                var vote = $(this);
                var active = vote.data(\'active\');

                if (!active) {
                    if (vote.index() < rating)
                        vote.attr(\'data-focus\', true);
                    else
                        vote.attr(\'data-focus\', false);
                }
            })
        };

        votes.each(function () {
            var vote = $(this);
            var rating = vote.index() + 1;
            var active = vote.data(\'active\');
            var value = vote.data(\'value\');
            var arParams = {\'SESSION_PARAMS\': \'6cab8939a1cdae2d84b97a35cb15e5b3\', \'PAGE_PARAMS\': {\'ELEMENT_ID\': 97}, \'sessid\': \'df9ccfb4fb59de9d28a88be6723d60d4\', \'AJAX_CALL\': \'Y\'};

            if (!voted) {
                vote.on(\'click\', function () {
                    arParams[\'vote\'] = \'Y\';
                    arParams[\'vote_id\'] = id;
                    arParams[\'rating\'] = value;

                    $.post(
                        \'/bitrix/components/bitrix/iblock.vote/component.php\',
                        arParams,
                        function (data) {
                            root.html(data);
                        }
                    );
                });

                if (!active) {
                    vote.on(\'mouseover\', function () {
                        root.update(rating);
                    });

                    vote.on(\'mouseout\', function () {
                        root.update(0);
                    });
                }
            }
        });

        root.update(0);

    }, {
        \'name\': \'[Component] bitrix:iblock.vote (template.1) [Fix]\',
        \'nodes\': \'#i-29-bitrix-iblock-vote-template-1-NLJNn1hMEOEL\',
        \'loader\': {
            \'name\': \'lazy\',
            \'options\': {
                \'await\': [
                    \'composite\'
                ]
            }
        }
    });
</script>    <!--\'end_frame_cache_OQ9Qzh\'--></div>";s:4:"VARS";a:2:{s:8:"arResult";a:1:{s:4:"AJAX";a:2:{s:11:"SESSION_KEY";s:32:"6cab8939a1cdae2d84b97a35cb15e5b3";s:14:"SESSION_PARAMS";a:17:{s:11:"PAGE_PARAMS";a:1:{i:0;s:10:"ELEMENT_ID";}s:9:"IBLOCK_ID";i:13;s:8:"MAX_VOTE";i:5;s:10:"VOTE_NAMES";a:5:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";}s:10:"CACHE_TYPE";s:1:"A";s:10:"CACHE_TIME";s:8:"36000000";s:17:"DISPLAY_AS_RATING";s:6:"rating";s:9:"READ_ONLY";N;s:12:"ELEMENT_CODE";s:23:"ryukzak_dublin_backpack";s:11:"SHOW_RATING";s:1:"N";s:14:"SET_STATUS_404";s:1:"N";s:11:"MESSAGE_404";N;s:14:"COMPONENT_NAME";s:18:"bitrix:iblock.vote";s:13:"TEMPLATE_NAME";s:10:"template.1";s:11:"PARENT_NAME";s:22:"bitrix:catalog.section";s:20:"PARENT_TEMPLATE_NAME";s:14:"catalog.tile.4";s:20:"PARENT_TEMPLATE_PAGE";N;}}}s:18:"templateCachedData";a:3:{s:13:"additionalCSS";s:84:"/bitrix/templates/universelite_s1/components/bitrix/iblock.vote/template.1/style.css";s:6:"frames";a:1:{i:0;a:6:{s:2:"id";s:6:"OQ9Qzh";s:11:"containerId";N;s:10:"staticPart";s:978:"        <div class="iblock-vote-rating" data-role="container">
                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="1" data-role="container.vote" data-active="false" data-value="0"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="2" data-role="container.vote" data-active="false" data-value="1"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="3" data-role="container.vote" data-active="false" data-value="2"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="4" data-role="container.vote" data-active="false" data-value="3"></i>                            <i class="iblock-vote-rating-item intec-ui-icon intec-ui-icon-star-1" title="5" data-role="container.vote" data-active="false" data-value="4"></i>                                </div>
    ";s:17:"useBrowserStorage";b:0;s:10:"autoUpdate";b:1;s:12:"useAnimation";b:0;}}s:9:"frameMode";b:1;}}}';
return true;
?>
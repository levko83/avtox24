<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<? if ($arResult['NODE_INFO']) { ?>
	<div class="node-info">
		<h4><?=GetMessage('LM_AUTO_SEARCH_NODE_INFO_TITLE')?></h4>
		
		<div class="inline-block">
            <a target="_blank" href="<?=$arResult['NODE_INFO']['Image']?>" rel="fancybox">
                <img src="<?=$arResult['NODE_INFO']['Image']?>" alt="<?=htmlspecialchars($arResult['NODE_INFO']['Name'])?>" title="<?=htmlspecialchars($arResult['NODE_INFO']['Name'])?>" />
            </a>
		</div>
        
        <div class="inline-block">		
    		<span><?=htmlspecialchars($arResult['NODE_INFO']['Name'])?></span>
        </div>
        
        <div class="inline-block">
    		<a target="_blank" title="<?=GetMessage('LM_AUTO_SEARCH_NODE_INFO_BASED_ON')?> <?=htmlspecialchars($arResult['NODE_INFO']['article']['Article'])?>" href="<?=$arResult['NODE_INFO']['ORIGINAL_CATALOG_URL']?>"><?=GetMessage('LM_AUTO_SEARCH_NODE_INFO_CATALOG_LINK')?></a>
        </div>
        
	</div>
<? } ?>

<div class="lm-auto-search-parts-place">
<?
global $APPLICATION;


$GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'] = $arParams['HIDE_FIELDS'];

$GLOBALS['LM_AUTO_SEARCH_RESULTS_CUSTOM_FIELDS'] = $arResult['CUSTOM_FIELDS'];
$GLOBALS['LM_AUTO_SEARCH_RESULTS_SHOW_CUSTOM_FIELDS'] = $arParams['SHOW_CUSTOM_FIELDS'];

$GLOBALS['templateFolder'] = $templateFolder;
$GLOBALS['showSupplier'] = $arResult['SHOW_SUPPLIER'];
$GLOBALS['ANTI_BOTS'] = $arParams['ANTI_BOTS'];
$GLOBALS['AUTH_URL'] = $arParams['AUTH_URL'];

/*
 * ���� �������� �������� ��� - ������� �� ���� ���������
 */
if (count($arResult['PARTS']['analog_type_N']) == 0) {
    echo '<div class="lm-auto-main-art-sought-404">' . GetMessage('LM_AUTO_SEARCH_NO_SOUGHT_ARTICLE') . '</div>';
}


/*
 * ����������� ������ ���� �� ������
 */
$n = 0;
foreach ($arResult['PARTS'] as $group_name => $parts) {
    $group = explode('_', $group_name);
    $group_id = end($group);
    $n += count($parts);
    if ($arParams['MERGE_GROUPS']) {
        echo '<h2>', GetMessage('LM_AUTO_SEARCH_RESULTS'), '</h2>';
    } else {
    	echo '<h2 data-group-id="', strval($group_id), '">', LinemediaAutoPart::getAnalogGroupTitle($group_id), '</h2>';
    }
    printPartsTable($parts, $group_id);
}


if ($n == 0 && $arParams['USE_REQUEST_FORM'] == 'Y' && CModule::IncludeModule('form')) { ?>
    <?
        $APPLICATION->IncludeComponent(
            "linemedia.auto:part.404.request",
            ".default",
            array(
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "N",
                "SEF_MODE" => "N",
                "SEF_FOLDER" => "/",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "SUCCESS_URL" => "",
                "WHAT_FIND" => $arResult['QUERY'],
                "WHAT_BRAND" => $_REQUEST['brand_title'],
                "VARIABLE_ALIASES" => array(
                    "WEB_FORM_ID" => "WEB_FORM_ID",
                    "RESULT_ID" => "RESULT_ID",
                )
            ),
            false
        );
    ?>
<?}?>
<?
function printPartsTable($parts, $group_id) {
    global $templateFolder, $APPLICATION;
?>
<table class="lm-auto-search-parts tablesorter silver-table" data-analog-type="<?= $group_id ?>">
    <thead>
        <tr>
            <? if (!in_array('brand', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-brand"><?=GetMessage('LM_AUTO_SEARCH_ITEM_BRAND')?></th>
            <? } ?>

            <? if (!in_array('article', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-article"><?=GetMessage('LM_AUTO_SEARCH_ITEM_ARTICLE')?></th>
            <? } ?>

            <? if (!in_array('title', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-title"><?=GetMessage('LM_AUTO_SEARCH_ITEM_TITLE')?></th>
            <? } ?>

            <? if (!$GLOBALS['ANTI_BOTS'] && !in_array('info', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-info {sorter:false}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_INFO')?></th>
            <? } ?>
            <? if (!in_array('quantity', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-quantity {sorter:'digit'}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_QUANTITY')?></th>
            <? } ?>
            <? if (!in_array('weight', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-weight {sorter:'digit'}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_WEIGHT')?></th>
            <? } ?>
            <? if (!in_array('supplier', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS']) || $GLOBALS['showSupplier']) { ?>
                <th class="lm-auto-search-parts-supplier"><?=GetMessage('LM_AUTO_SEARCH_ITEM_SUPPLIER')?></th>
            <? } ?>
            <? if (!in_array('modified', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-modified"><?=GetMessage('LM_AUTO_SEARCH_ITEM_MODIFIED')?></th>
            <? } ?>
			<?// ������� ���������������� �����?>
			<?foreach($GLOBALS['LM_AUTO_SEARCH_RESULTS_CUSTOM_FIELDS'] as $key => $field) {?><??>
				<? if (in_array($field["code"], $GLOBALS['LM_AUTO_SEARCH_RESULTS_SHOW_CUSTOM_FIELDS'])) { ?>
					<th class="lm-auto-search-parts-custom-field"><?=$field["name"]?></th>
            <? } ?>
			<? } ?>
            <? if (!in_array('delivery_time', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-delivery-time {sorter:'custom_digit_delivery'}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_DELIVERY_TIME')?></th>
            <? } ?>
            <? if (!in_array('stats', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-basket {sorter:false}">&nbsp;<?=GetMessage('LM_AUTO_SEARCH_ITEM_STAT')?></th>
            <? } ?>
            <? if (!in_array('price', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-price {sorter:'custom_digit'}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_PRICE')?></th>
            <? } ?>
            <? if (!in_array('count', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-count {sorter:false}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_COUNT')?></th>
            <? } ?>
            <? if (!in_array('basket', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-basket {sorter:false}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_BASKET')?></th>
            <? } ?>
            <? // ������� ������
            if(LinemediaAutoReturnGoods::isStatusEnabled() && !in_array('return', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <th class="lm-auto-search-parts-return {sorter:false}"><?=GetMessage('LM_AUTO_SEARCH_ITEM_RETURN')?></th>
            <? } ?>
            <? if (CUser::GetID()) { ?>
                <? if (!in_array('notepad', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                    <th class="lm-auto-search-parts-notepad {sorter:false}"></th>
                <? } ?>
            <? } ?>
            <? if (LinemediaAutoDebug::visible()) { ?>
                <th class="lm-auto-search-parts-debug"><?=GetMessage('LM_AUTO_SEARCH_ITEM_DEBUG')?></th>
            <? } ?>
        </tr>
    </thead>
    <tbody>
    <? foreach ($parts as $part) { ?>
        <? $hash = md5(json_encode($part)); ?>
        <tr class="hproduct" style="<?= $part['supplier']['PROPS']['css']['VALUE'] ?>">
            <? if (!in_array('brand', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="brand" title="<?= $part['brand']['title'] ?>"><span><?= $part['brand']['title'] ?></span>
                </td>
            <? } ?>

            <? if (!in_array('article', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="sku">
                    <a href="<?= $part['part_search_url'] ?>"><?= ($part['original_article']) ? $part['original_article'] : $part['article'] ?></a>
                </td>
            <? } ?>

            <? if (!in_array('title', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="fn"><?= $part['title'] ?></td>
            <? } ?>

            <? if (!$GLOBALS['ANTI_BOTS'] && !in_array('info', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="info">
                    <? if ($part['info']) { ?>
                        <?  // ��������� ����������.
                        if(LinemediaAutoCrossesApiDriver::isEnabled()) {
                            $APPLICATION->IncludeComponent(
                                "linemedia.auto:search.detail.info.cross",
                                "ajax",
                                array(
                                    'AJAX_CALL'     => 'Y',
                                    'BRAND'         => $part['brand_title'],
                                    'ARTICLE'       => $part['article'],
                                    'ARTICLE_ID'    => $part['article_id']
                                ),
                                false
                            );
                        } else {
                            $APPLICATION->IncludeComponent(
                                "linemedia.auto:search.detail.info",
                                "ajax",
                                array(
                                    'AJAX'          => 'Y',
                                    'BRAND'         => $part['brand_title'],
                                    'ARTICLE'       => $part['article'],
                                    'ARTICLE_ID'    => $part['article_id']
                                ),
                                false
                            );
                        }
                        ?>
                    <? } ?>
                </td>
            <? } ?>
            <? if (!in_array('quantity', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="instock"><?= $part['quantity'] ? $part['quantity'] : '-' ?></td>
            <? } ?>
            <? if (!in_array('weight', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="weight"><?= $part['weight'] ? $part['weight'] : '-' ?></td>
            <? } ?>
            <? if (!in_array('supplier', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS']) || $GLOBALS['showSupplier']) { ?>
                <td class="supplier">
                    <?= $part['supplier']['PROPS']['visual_title']['VALUE'] ?>
                </td>
            <? } ?>
            <? if (!in_array('modified', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <? if (intval($part['modified']) > 0) { ?>
                    <td><time title="<?= date("d.m.y H:i:s", strtotime($part['modified'])) ?>" datetime="<?= date('c', strtotime($part['modified'])) ?>"><?= date("d.m", strtotime($part['modified'])) ?></time></td>
                <? } else { ?>
                    <td>-</td>
                <? } ?>
            <? } ?>
			<?// ������� ���������������� �����?>
			<?foreach($GLOBALS['LM_AUTO_SEARCH_RESULTS_CUSTOM_FIELDS'] as $key => $field) {?><??>
				<? if (in_array($field["code"], $GLOBALS['LM_AUTO_SEARCH_RESULTS_SHOW_CUSTOM_FIELDS'])) { ?>
					<td class="custom-field-<?=$field["code"]?>"><?=$part[$field["code"]]?></td>
            <? } ?>
			<? } ?>
            <? if (!in_array('delivery_time', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="delivery_time" title="<?= ceil($part['delivery']) ?>" data-delivery_time="<?= (int) str_replace(' ', '', $part['delivery'])?>">
                    <?= ($part['delivery_time']) ? ($part['delivery_time']) : ('-') ?>
                </td>
            <? } ?>
            <? if (!in_array('stats', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td><? $GLOBALS['APPLICATION']->IncludeComponent('linemedia.auto:supplier.reliability.statistic', '.default',
                        array(
                                'SUPPLIER_ID'=>$part['supplier_id'],
                                'WIDTH'=>'400px',
                                'HEIGHT'=>'200px'
                            ),
                        $component);
                    ?>
                </td>
            <?}?>
            <? if (!in_array('price', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="price" title="<?= ceil($part['price_src']) ?>" data-price="<?= (int) str_replace(' ', '', $part['price'])?>">
                    <?= ($part['price']) ? $part['price'] : ('-') ?>
                </td>
            <? } ?>
            <? if (!in_array('count', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) {
                $part['multiplication_factor'] = (int) $part['multiplication_factor'];
                if($part['multiplication_factor'] > $part['quantity']) {
                    $part['multiplication_factor'] = 1;
                }
                ?>
                <td class="count">
                    <input
                        class="int maxvalue"
                        type="text"
                        size="2"
                        value="<?= $part['multiplication_factor'] > 0 ? $part['multiplication_factor'] : 1 ?>"
                        rel="quantity"
                        data-max="<?= $part['quantity'] ?>"
                        data-part-hash="<?= $hash ?>"
                        <? if($part['multiplication_factor'] > 1) { ?>
                            data-step="<?=$part['multiplication_factor']?>"
                            data-toggle="tooltip"
                            title="<?=GetMessage('LM_AUTO_SEARCH_MULTIPLICATION_FACTOR', array('N'=>$part['multiplication_factor']))?>"
                        <? } ?>
                    />
                    <?/*if (isset($part['multiplication_factor']) && intval($part['multiplication_factor']) > 1) {?>
                        <a href="javascript:void(0);" title="<?=GetMessage('LM_AUTO_SEARCH_MULTIPLICATION_FACTOR', array('N'=>$part['multiplication_factor']))?>">
                            <div class="lm-auto-icon-info">
                            </div>
                        </a>
                    <?}*/?>

                </td>
            <? } ?>

            <? if (!in_array('basket', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="basket">
                    <noindex>
                        <a class="btn btn-mini" href="javascript:void(0)" onclick="javascript: add2cart('<?= $hash ?>', '<?= $part['buy_url'] ?>', <?= $part['quantity'] ?>);" rel="nofollow">
                            <img src="<?= $templateFolder ?>/images/cart.png" alt="<?= GetMessage('LM_AUTO_SEARCH_ITEM_BUY') ?>" title="<?= GetMessage('LM_AUTO_SEARCH_ITEM_BUY') ?>" />&nbsp;<span><?= GetMessage('LM_AUTO_SEARCH_ITEM_BUY') ?></span>
                        </a>
                    </noindex>
                </td>
            <? } ?>

            <? // ������� ������
            if(LinemediaAutoReturnGoods::isStatusEnabled() && !in_array('return', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                <td class="return" style="text-align:center; vertical-align: middle;">
                    <? if($part['supplier']['PROPS']['returns_banned']['VALUE'] != 'Y') { ?>
                        <img src="<?=$templateFolder?>/images/return_yes.png" title="<?=GetMessage('LM_AUTO_SEARCH_RETURN_YES')?>" />
                    <? } else { ?>
                        <img src="<?=$templateFolder?>/images/return_no.png" title="<?=GetMessage('LM_AUTO_SEARCH_RETURN_NO')?>" />
                    <? } ?>
                </td>
            <? } ?>


            <? if (CUser::IsAuthorized()) { ?>
                <? if (!in_array('notepad', $GLOBALS['LM_AUTO_SEARCH_RESULTS_HIDE_FIELDS'])) { ?>
                    <td class="notepad">
                        <img class="add-to-notepad" onclick="javascript: AddToNotepad(this,event);" src="<?=$templateFolder?>/images/add_to_notepad.png" title="<?= GetMessage('LM_AUTO_SEARCH_ITEM_ADD_NOTEPAD') ?>" alt="<?= GetMessage('LM_AUTO_SEARCH_ITEM_ADD_NOTEPAD') ?>"/>
                        <input type="hidden" class="notepad_part_id" name="notepad_part_id" value="<?= $part['id'] ?>" />
                        <input type="hidden" class="part_api_value" name="part_api_value" value="<?=$part['supplier']['PROPS']['api']['VALUE']?>" />
                        <input type="hidden" id="part_url_extra" name="part_url_extra" value='<?=json_encode($_REQUEST['extra'])?>' />
                    </td>
                <? } ?>
            <? } ?>
            <? if (LinemediaAutoDebug::visible()) { ?>
                <td><pre><? unset($part['supplier'], $part['brand']); echo print_r($part, true) ?></pre></td>
            <? } ?>
        </tr>
    <? } ?>
    </tbody>
</table>
<? } ?>
<?
/*
* ����: 18.10.13 12:31
* ���: �������� ����
* ������: 5410
* ���������: ������� ���������� �� �������� �� ������ ������ �� api
*/
if (CUSER::IsAdmin() && $arParams['SHOW_ANALOGS_STATISTICS'] == 'Y') {
	$tecdocAnalogs = array();
	$lmAnalogs = array();
	if(is_array($arResult['tecdocAndLinemediaAnalogs'])) {
		foreach ($arResult['tecdocAndLinemediaAnalogs'] as $key => $array) {
            if(is_array($array['analogs']['parts'])) {
                foreach ($array['analogs']['parts'] as $part) {
                    $analogSource = strtolower($part['source']);

                    if (strtolower($part['brand_title']) == strtolower($arParams['BRAND_TITLE']) &&
                        strtolower(LinemediaAutoPartsHelper::clearArticle($part['article'])) == strtolower($arParams['QUERY'])
                    ) {
                        continue;
                    }

                    if (substr_count($analogSource, 'tecdoc')) {
                        $tecdocAnalogs[$part['article'] . '-' . $part['brand_title']] = array(
                            'article'     => $part['article'],
                            'brand_title' => $part['brand_title']
                        );
                    } elseif (substr_count($analogSource, 'linemedia')) {
                        $lmAnalogs[$part['article'] . '-' . $part['brand_title']] = array(
                            'article'     => $part['article'],
                            'brand_title' => $part['brand_title']
                        );
                    }
                }
            }
		}
	}
	
	echo '<span>' . GetMessage('LM_AUTO_SEARCH_RESULTS_CROSSES_FIND') . ': </span>';
	printAnalogsTable($tecdocAnalogs, GetMessage('LM_AUTO_SEARCH_RESULTS_CROSSES_MAIN'), 'crosses-tecdoc');
	printAnalogsTable($lmAnalogs, GetMessage('LM_AUTO_SEARCH_RESULTS_CROSSES_ADD'), 'crosses-lm');
}?>
</div>

<?function printAnalogsTable($analogs, $analogType = '', $tableId = '') {?>
	<p id="select-<?=$tableId?>" style="color: blue"><?=count($analogs)?> <?=GetMessage('LM_AUTO_SEARCH_IN')?> <?=$analogType?></p>
	<?if ( count($analogs) == 0) return;?>
	<table class="lm-auto-search-parts tablesorter silver-table" id="table-<?=$tableId?>" style="display: none">
		<thead>
		<tr>
            <th class="lm-auto-search-crosses-article"><?=GetMessage('LM_AUTO_SEARCH_ITEM_ARTICLE')?></th>
            <th class="lm-auto-search-crosses-brand"><?=GetMessage('LM_AUTO_SEARCH_ITEM_BRAND')?></th>
		</tr>
		</thead>
		<tbody>
		<? foreach ($analogs as $analog) { ?>
			<tr class="analogs">
				<td class="crosses-article"><?= $analog['article'] ? $analog['article'] : '-' ?></td>
				<td class="crosses-brand"><?= $analog['brand_title'] ? $analog['brand_title'] : '-' ?></td>
			</tr>
		<? } ?>
		</tbody>
	</table>
<? } ?>

<script>
	var langs = ['LM_AUTO_SEARCH_QUANTITY_SIZE_CONFIRM', '<?=GetMessage('LM_AUTO_SEARCH_QUANTITY_SIZE_CONFIRM')?>'];
	var sessid = '<?=bitrix_sessid()?>';
	var path_notepad = '<?=$arParams['PATH_NOTEPAD']?>';
	var lang_go_to_notepad = '<?=GetMessage('LM_AUTO_SEARCH_GO_TO_NOTEPAD')?>';
	var lang_go_to_notepad_body = '<?=GetMessage('LM_AUTO_SEARCH_GO_TO_NOTEPAD_BODY')?>';
	var popup_title = '<?=GetMessage('LM_AUTO_SEARCH_ITEM_NOTEPAD')?>';

	$(document).ready(function(){

		$.tablesorter.addParser({
			// set a unique id
			id: 'custom_digit',
			is: function (s) {
				// return false so this parser is not auto detected
				return false;
			},
			format: function (s, table, cell, cellIndex) {
				// get data attributes from $(cell).attr('data-something');
				// check specific column using cellIndex
				return $(cell).attr('data-price');
			},
			// set type, either numeric or text
			type: 'numeric'
		});
		
		$.tablesorter.addParser({
			// set a unique id
			id: 'custom_digit_delivery',
			is: function (s) {
				// return false so this parser is not auto detected
				return false;
			},
			format: function (s, table, cell, cellIndex) {
				// get data attributes from $(cell).attr('data-something');
				// check specific column using cellIndex
				return $(cell).attr('data-delivery_time');
			},
			// set type, either numeric or text
			type: 'numeric'
		});


		$(".lm-auto-search-parts").tablesorter({
			textExtraction: function(node) {
				if ($('span[title]', node).length > 0) {
					return $('span[title]', node).eq(0).attr('title');
				} else {
					var txt = $(node).text();
					return txt === '-' ? '-0.000001' : txt;
				}
			}
		});
	});
</script>

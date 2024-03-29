<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="cart-items" id="id-cart-list">
    <div class="inline-filter cart-filter">
        <label><?=GetMessage("SALE_PRD_IN_BASKET")?></label>&nbsp;
            <b><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></b>&nbsp;
            <a href="#" onclick="ShowBasketItems(2);"><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=count($arResult["ITEMS"]["DelDelCanBuy"])?>)</a>&nbsp;
            <?if(false):?>
            <a href="#" onclick="ShowBasketItems(3);"><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=count($arResult["ITEMS"]["nAnCanBuy"])?>)</a>
            <?endif;?>
    </div>

    <? if (count($arResult["ITEMS"]["AnDelCanBuy"]) > 0) { ?>
    <table class="cart-items silver-table" cellspacing="0">
    <thead>
        <tr>
          <th class="lm-auto-main-cart-item-check">&nbsp;</th>
            <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-name"><?= GetMessage("SALE_NAME")?></th>
            <?endif;?>
            <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-price"><?= GetMessage("SALE_PRICE")?></th>
            <?endif;?>
            <?if (in_array("VAT", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-price"><?= GetMessage("SALE_VAT")?></th>
            <?endif;?>
            <?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></th>
            <?endif;?>
            <?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></th>
            <?endif;?>
            <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></th>
            <?endif;?>
            <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
                <th class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></th>
            <?endif;?>
            <th class="cart-item-actions">
                <?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
                    <?= GetMessage("SALE_ACTION")?>
                <?endif;?>
            </th>
        </tr>
    </thead>
    <tbody>
    <? $i = 0; ?>
    <? $need_vin = false;
    foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems) {

        $is_remote_supplier = false;

        if (CModule::IncludeModule('iblock')) {
            $iblock_id = COption::GetOptionInt('linemedia.auto', 'LM_AUTO_IBLOCK_SUPPLIERS', 0);

            if ($iblock_id > 0) {

                foreach ($arBasketItems["PROPS"] as $prop) {
                    if ($prop['CODE'] == 'supplier_id') {
                        $supplier_id = $prop['VALUE'];
                        break;
                    }
                }
                
                if(isset($supplier_id)) {
                    $rs = CIBlockElement::GetList(array(), array('PROPERTY_supplier_id' => $supplier_id, 'IBLOCK_ID' => $iblock_id), 0, 0, array('ID', 'IBLOCK_ID', 'PROPERTY_api'));
                    if ($rs && $rs->SelectedRowsCount() > 0) {
                        $supplier_data = $rs->Fetch();

                        if(!empty($supplier_data['PROPERTY_API_VALUE'])) {
                            $is_remote_supplier = true;
                        }
                    }
                }
            }
        }?>
        <tr>
            <td><input class="lm-auto-main-basket-delete" type="checkbox" name="deletes[]" value="<?= $arBasketItems['ID'] ?>" /></td>
            <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-name">
                <b><?=$arBasketItems["NAME"] ?></b>
                <?if (in_array("PROPS", $arParams["COLUMNS_LIST"])) {
                    foreach ($arBasketItems["PROPS"] as $val) {
                        if(in_array($val['CODE'], (array) $arParams['HIDE_PROPERTIES']) || $val['CODE'] == 'max_available_quantity' || $val['CODE'] == 'retail_chain') {
                            continue;
                        }
                        if($val['CODE'] == 'need_vin') {
                            $need_vin = true;
                            ?>
                            <br /><?=$val["NAME"]?>
                            <input type="hidden" name="need_vin" value="<?=$val["VALUE"]?>" />
                            <?
                        } else {
                            echo "<br />".$val["NAME"].": ".$val["VALUE"];
                        }
                    }
                }
                $mf = 1;
                foreach ($arBasketItems["PROPS"] as $prop) {
                    if ($prop['CODE'] == 'multiplication_factor') {
                        $mf = max(1, intval($prop['VALUE']));
                    }
                    if ($prop['CODE'] == 'max_available_quantity') {
                         $max_available_quantity = $is_remote_supplier ? $arBasketItems["QUANTITY"] : $prop['VALUE'];
                    }
                    if($mf > $max_available_quantity) {
                        $mf = 1;
                    }
                }
                ?>
                <div style="display: none" class="max_available_quantity"><?= $max_available_quantity ?></div>
                </td>
            <?endif;?>
            <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
            <?endif;?>
            <?if (in_array("VAT", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-price"><?=$arBasketItems["VAT_RATE_FORMATED"]?></td>
            <?endif;?>
            <?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
            <?endif;?>
            <?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-discount"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
            <?endif;?>
            <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
            <?endif;?>
            <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-quantity">
                    <input maxlength="18"
                           data-step="<?=$mf?>"
                           type="text"
                           name="QUANTITY_<?=$arBasketItems["ID"] ?>"
                           value="<?=$arBasketItems["QUANTITY"]?>"
                           size="3"
                           <? if($mf > 1) { ?>
                               data-toggle="tooltip"
                               title="<?=GetMessage('LM_AUTO_SEARCH_MULTIPLICATION_FACTOR', array('N'=>$mf))?>"
                            <? } ?>
                        >
                </td>
            <?endif;?>
            <td class="cart-item-actions">
                <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
                    <a class="cart-delete-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"><?=GetMessage("SALE_DELETE")?></a>
                <?endif;?>
                <?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
                    <a class="cart-shelve-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"><?=GetMessage("SALE_OTLOG")?></a>
                <?endif;?>
            </td>
        </tr>
        <?
        $i++;
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td>&nbsp;</td>
            <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-name">
                    <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
                        <p><?echo GetMessage("SALE_ALL_WEIGHT")?>:</p>
                    <?endif;?>
                    <?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
                    {
                        ?><p><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
                        if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
                            echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:</p><?
                    }?>
                    <?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
                        <p><?= GetMessage('SALE_VAT_EXCLUDED')?></p>
                        <p><?= GetMessage('SALE_VAT_INCLUDED')?></p>
                    <?endif;?>
                    <p class="text-right"><b><?= GetMessage("SALE_ITOGO")?>:</b></p>
                </td>
            <?endif;?>
            <? if (in_array('PRICE', $arParams['COLUMNS_LIST'])) { ?>
                <td class="cart-item-price">
                    <? if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])) { ?>
                        <p><?= $arResult["allWeight_FORMATED"] ?></p>
                    <? } ?>
                    <? if (doubleval($arResult["DISCOUNT_PRICE"]) > 0) { ?>
                        <p><?= $arResult["DISCOUNT_PRICE_FORMATED"] ?></p>
                    <? } ?>
                    <? if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y') { ?>
                        <p><?= $arResult["allNOVATSum_FORMATED"] ?></p>
                        <p><?= $arResult["allVATSum_FORMATED"] ?></p>
                    <? } ?>

                    <p><b><?=$arResult["allSum_FORMATED"]?></b></p>
                </td>
            <? } ?>
            <?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-type">&nbsp;</td>
            <?endif;?> 
            <?if (in_array("VAT", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-type">&nbsp;</td>
            <?endif;?>
            <?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-discount">&nbsp;</td>
            <?endif;?>
            <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-weight">&nbsp;</td>
            <?endif;?>
            <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-quantity">&nbsp;</td>
            <?endif;?>
            <?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
                <td class="cart-item-actions">&nbsp;</td>
            <?endif;?>
        </tr>
    </tfoot>
    </table>

    <div class="cart-ordering">
        <? if ($arParams["HIDE_COUPON"] != "Y") { ?>
            <div class="cart-code">
                <input <? if (empty($arResult["COUPON"])):?>onclick="if (this.value=='<?=GetMessage("SALE_COUPON_VAL")?>')this.value=''" onblur="if (this.value=='')this.value='<?=GetMessage("SALE_COUPON_VAL")?>'"<?endif;?> value="<?if(!empty($arResult["COUPON"])):?><?=$arResult["COUPON"]?><?else:?><?=GetMessage("SALE_COUPON_VAL")?><?endif;?>" name="COUPON">
            </div>
        <? } ?>
        <div class="cart-buttons">
            <input type="submit" value="<?= GetMessage("SALE_DELETE_CHECKED") ?>" name="BasketRemoveLM" class="btn"/>
            <input type="submit" value="<?= GetMessage("SALE_UPDATE") ?>" name="BasketRefreshLM" class="btn"/>
            <input type="submit" value="<?= GetMessage("SALE_ORDER") ?>" name="BasketOrderLM"  id="basketOrderButton2" class="btn btn-info"/>
        </div>
    </div>
        <? if($need_vin) { ?>
            <input type="hidden" name="auto_garage_use_auto" value="" />
        <? } ?>
    <? } else { // if (count($arResult["ITEMS"]["AnDelCanBuy"]) > 0) ?>
        <?= ShowNote(GetMessage("SALE_NO_ACTIVE_PRD")); ?>
    <? } ?>
</div>
<?




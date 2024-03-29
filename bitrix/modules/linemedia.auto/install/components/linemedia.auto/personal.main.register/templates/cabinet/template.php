<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
<div class="bx-auth-reg">

<? if ($USER->IsAuthorized()):?>

<p><?= GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>


<? if($arResult["BACKURL"] <> ''): ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<? endif; ?>

<table>
	<thead>
		<tr>
			<td colspan="2"><b><?= GetMessage("AUTH_REGISTER") ?></b></td>
		</tr>
	</thead>
	<tbody>
<? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
    <?  // ���� � ����c��� ������ ������������ e-mail.
        if ($arParams['USE_EMAIL_AS_LOGIN'] && $FIELD == 'LOGIN') {
            continue;
        } 
    ?>
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
		<tr>
			<td><?echo GetMessage("main_profile_time_zones_auto")?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></td>
			<td>
				<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
					<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
					<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
					<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
			<td>
				<select name="REGISTER[TIME_ZONE]"<?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
		<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
					<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
		<?endforeach?>
				</select>
			</td>
		</tr>
	<?else:?>
		<tr>
			<td><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></td>
			<td><?
	switch ($FIELD)
	{
		case "PASSWORD":
			?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
<?
			break;
		case "CONFIRM_PASSWORD":
			?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
			break;

		case "PERSONAL_GENDER":
			?><select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
			break;

		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
			break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
			break;

		case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
			break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
			?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	}?></td>
		</tr>
	<?endif?>
<?endforeach?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strLen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?></td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>

<? if (!empty($arParams['PERSON_SALE_PROFILE_FIELDS'])) { ?>
    
    <table>
        <thead>
            <tr>
                <td colspan="2"><b><?= GetMessage('LM_AUTO_MAIN_SALE_PROFILE_FIELDS') ?></b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <? foreach ($arResult['PERSON_TYPES'] as $arPerson) { ?>
                        <label>
                            <input type="radio" class="lm-auto-person-select" name="PERSON_TYPE_ID" value="<?= $arPerson['ID'] ?>" <?= ($arPerson['SELECTED'] == 'Y') ? ('checked') : ('') ?> />
                            <?= $arPerson['NAME'] ?>
                        </label>
                        <br/>
                    <? } ?>
                </td>
            </tr>
            <? foreach ($arResult['PERSON_TYPES'] as $arPerson) { ?>
                
                <? foreach ($arResult['SALE_ORDER_PROPS'][$arPerson['ID']] as $arSaleProperty) { ?>
                    <? if (!in_array($arSaleProperty['ID'], $arParams['PERSON_SALE_PROFILE_FIELDS'])) continue; ?>
                    
                    <tr class="lm-auto-person-select-container" rel="<?= $arPerson['ID'] ?>" <?= ($arPerson['SELECTED'] != 'Y') ? ('style="display: none;"') : ('') ?>>
                        <td>
                            <?= $arSaleProperty['NAME'] ?>
                            <span class="starrequired">*</span>
                        </td>
                        <td>
                            <? if ($arSaleProperty['TYPE'] == 'SELECT') { ?>
                                <select name="SALE_PROPS[<?= $arSaleProperty['ID'] ?>]">
                                    <? foreach ($arSaleProperty['VALUES'] as $id => $val) { ?>
                                        <option value="<?= $id ?>" <? if ($id == $_REQUEST['SALE_PROPS'][$arSaleProperty['ID']]) echo 'selected="selected"'; ?>><?= $val ?></option>
                                    <? } ?>
                                </select>
                            <? } elseif ($arSaleProperty['TYPE'] == 'MULTISELECT') { ?>
                                <select name="SALE_PROPS[<?= $arSaleProperty['ID'] ?>]" multiple="multiple" size="4">
                                    <? foreach ($arSaleProperty['VALUES'] as $id => $val) { ?>
                                        <option value="<?= $id ?>" <? if ($id == $_REQUEST['SALE_PROPS'][$arSaleProperty['ID']]) echo 'selected="selected"'; ?>><?= $val ?></option>
                                    <? } ?>
                                </select>
                            <? } elseif ($arSaleProperty['TYPE'] == 'CHECKBOX') { ?>
                                <input type="checkbox" value="Y" "<?= ($_REQUEST['SALE_PROPS'][$arSaleProperty['ID']] == 'Y') ? ('checked') : ('') ?>" name="SALE_PROPS[<?= $arSaleProperty['ID'] ?>]" />
                            <? } else { ?>
                                <input type="text" value="<?= $_REQUEST['SALE_PROPS'][$arSaleProperty['ID']]?>" maxlength="255" name="SALE_PROPS[<?= $arSaleProperty['ID'] ?>]" />
                            <? } ?>
                        </td>
                    </tr>
                <? } ?>
                
            <? } ?>
        </tbody>
    </table>
<? } ?>

<? if ($arParams['GET_SUBSCRIBE']) { ?>
    <div class="check_holder">
        <label>
            <input type="checkbox" name="SUBSCRIBE" value="Y" <?= ($_REQUEST['SUBSCRIBE'] == 'Y') ? ('checked') : ('') ?> />
            <?= GetMessage('LM_AUTO_MAIN_GET_SUBSCRIBE') ?>
        </label>
    </div>
<? } ?>

<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y") {
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}
/* !CAPTCHA */
endif;
?>
	</tbody>
</table>
</div>
<div style="display:none !important;">
<?=$arResult['HTML']?>
</div>
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('linemedia.auto')) {
	ShowError(GetMessage('LM_AUTO_MODULE_NOT_INSTALL'));
	return;
}

if (!CModule::IncludeModule('iblock')) {
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALL"));
    return;
}


$arParams['IBLOCK_ID'] = (int) $arParams['IBLOCK_ID'];
if (empty($arParams['IBLOCK_ID'])) {
    $arParams['IBLOCK_ID'] = COption::GetOptionInt('linemedia.auto', 'LM_AUTO_IBLOCK_SEARCH_SEO');
}

$arParams['ARTICLE']   = LinemediaAutoPartsHelper::ClearArticle(trim(strval($arParams['ARTICLE'])));
$arParams['ARTICLE'] = str_replace(',', '', $arParams['ARTICLE']);
$arParams['BRAND_ID']  = intval($arParams['BRAND_ID']);


/*
 * ���� ��� �������� - ������ ������ �� ����
 */
if (!$arParams['ARTICLE']) {
    return;
}

$arResult = array();

if ($this->StartResultCache()) {

    $filter = array(
        'IBLOCK_ID'         	=> $arParams['IBLOCK_ID'],
        'PROPERTY_article'  	=> $arParams['ARTICLE'],
        'PROPERTY_brand_title'	=> $arParams['BRAND_TITLE']?:strip_tags(strval($_REQUEST['brand_title'])),
        'ACTIVE'				=> 'Y'
    );

    if ($arParams['BRAND_ID'] > 0) {
        $filter['PROPERTY_brand_id'] = $arParams['BRAND_ID'];
    }

    if (!$filter['PROPERTY_brand_title']) {
        $filter['PROPERTY_brand_title'] = false;
    }

    $res = CIblockElement::GetList(array(), $filter, false, false, array('ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE'));

    if($res->SelectedRowsCount() < 1 && $filter['PROPERTY_brand_title']) {
        $filter['PROPERTY_brand_title'] = false;
        $res = CIblockElement::GetList(array(), $filter, false, false, array('ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE'));
    }

    if ($article = $res->Fetch()) {
		$article['DETAIL_PICTURE_FULL'] = CFile::GetPath($article['DETAIL_PICTURE']);
        $article['DETAIL_PICTURE'] = CFile::ResizeImageGet($article['DETAIL_PICTURE'], array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arResult['ARTICLE'] = $article;
        
        $this->IncludeComponentTemplate();
    }
}

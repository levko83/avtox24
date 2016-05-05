<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        'ADD_SECTIONS_CHAIN' => array(
                "PARENT" => "BASE",
                "NAME" => GetMessage('LM_AUTO_MAIN_TECDOC_CATALOG_ADD_CHAIN'),
                "TYPE" => "CHECKBOX",
                "ADDITIONAL_VALUES" => "N",
                "MULTIPLE" => "N",
                "DEFAULT"=>'Y'
        ),
        'HIDE_UNAVAILABLE' => array(
                "PARENT" => "BASE",
                "NAME" => GetMessage('LM_AUTO_MAIN_HIDE_UNAVAILABLE'),
                "TYPE" => "CHECKBOX",
                "ADDITIONAL_VALUES" => "N",
                "MULTIPLE" => "N",
                "DEFAULT"=>'N',
        ),
        
        
        
        "SEF_FOLDER" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage('LM_AUTO_MAIN_TECDOC_CATALOG_PATH_ROOT'),
            "TYPE" => "STRING",
            "ADDITIONAL_VALUES" => "N",
            "MULTIPLE" => "N",
            "DEFAULT" => '/auto/original/'
        ),
        "SEF_MODE" => array(
        	"DEFAULT"=>'Y',
        ),
        'DISABLE_STATS' => array(
                "PARENT" => "BASE",
                "NAME" => GetMessage('LM_AUTO_MAIN_DISABLE_STATS'),
                "TYPE" => "CHECKBOX",
                "ADDITIONAL_VALUES" => "N",
                "MULTIPLE" => "N",
                "DEFAULT"=>'N',
        ),
        'INCLUDE_JQUERY' => array(
                "PARENT" => "BASE",
                "NAME" => GetMessage('LM_AUTO_MAIN_INCLUDE_JQUERY'),
                "TYPE" => "CHECKBOX",
                "ADDITIONAL_VALUES" => "N",
                "MULTIPLE" => "N",
                "DEFAULT"=>'Y',
        ),
    ),
);
?>

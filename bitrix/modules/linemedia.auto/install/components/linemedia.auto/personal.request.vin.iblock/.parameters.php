<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arYesNo = Array(
	"Y" => GetMessage("LM_AUTO_VIN_DESC_YES"),
	"N" => GetMessage("LM_AUTO_VIN_DESC_NO"),
);

if (CModule::IncludeModule("linemedia.autotecdoc")) {
	$sets_ids = LinemediaAutoTecdocApiModifications::getSetsIds();
	$sets_ids = array_combine($sets_ids, $sets_ids);
}

$sets_ids['default'] = GetMessage('LM_AUTO_GARAGE_PERSONAL_REQUEST_VIN_DEFAULT');

$arComponentParameters = array(
	"PARAMETERS" => array(

		"VARIABLE_ALIASES" => Array(
			"ID" => Array("NAME" => GetMessage("LM_AUTO_VIN_TICKET_ID_DESC"))
		),

		"SEF_MODE" => Array(
			"list" => Array(
				"NAME" => GetMessage("LM_AUTO_VIN_TICKET_LIST_DESC"),
				"DEFAULT" => "",
				"VARIABLES" => array()
			),
			"edit" => Array(
				"NAME" => GetMessage("LM_AUTO_VIN_TICKET_EDIT_DESC"),
				"DEFAULT" => "#ID#/",
				"VARIABLES" => array("ID")
			),
		),
		"TICKETS_PER_PAGE" => Array(
			"NAME" => GetMessage("LM_AUTO_VIN_LIST_TICKETS_PER_PAGE"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"PARENT" => "ADDITIONAL_SETTINGS",
			"DEFAULT" => "10"
		),
		"TICKET_SORT_ORDER" => Array(
			"NAME" => GetMessage("LM_AUTO_VIN_TICKET_SORT_ORDER"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"PARENT" => "ADDITIONAL_SETTINGS",
			"VALUES" =>Array(
				"asc"=>GetMessage("LM_AUTO_VIN_SORT_ASC"),
				"desc"=>GetMessage("LM_AUTO_VIN_SORT_DESC")
			),
                        "DEFAULT" => "desc"
		),
		"SET_PAGE_TITLE" => Array(
			"NAME"=>GetMessage("LM_AUTO_VIN_SET_PAGE_TITLE"), 
			"TYPE"=>"LIST", 
			"MULTIPLE"=>"N", 
			"DEFAULT"=>"Y", 
			"PARENT" => "ADDITIONAL_SETTINGS",
			"VALUES"=>$arYesNo, 
			"ADDITIONAL_VALUES"=>"N"
		),
        'MODIFICATIONS_SET' => array(
                "PARENT" => "BASE",
                "NAME" => GetMessage('LM_AUTO_MAIN_MODIFICATIONS_SET'),
                "TYPE" => "LIST",
                "ADDITIONAL_VALUES" => "N",
                "MULTIPLE" => "N",
                "DEFAULT"=>'default',
                'VALUES' => $sets_ids,
        ),
	)
);
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("�����");
?>
<?$APPLICATION->IncludeComponent("linemedia.auto:search.results.seo", ".default", array(
	"ARTICLE" => $_REQUEST["q"],
	"BRAND_ID" => $_REQUEST["brand_id"],
	"SET_TITLE" => "Y"
	),
	false
);?><?$APPLICATION->IncludeComponent("linemedia.auto:search.results", ".default", array(
	"QUERY" => $_REQUEST["q"],
	"PART_ID" => $_REQUEST["part_id"],
	"BRAND_ID" => $_REQUEST["brand_id"],
	"BRAND_TITLE" => $_REQUEST["brand_title"],
	"EXTRA" => $_REQUEST["extra"],
	"BASKET_URL" => "#DEMO_FOLDER#cart/",
	"TITLE" => "����� �������� #QUERY#",
	"SET_TITLE" => "Y"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"linemedia.auto:search.last.queries",
	"",
	Array(
	)
);?><? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>

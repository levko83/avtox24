<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=<?=LANG_CHARSET?>">
<meta name=ProgId content=Excel.Sheet>
<title langs="ru">Счет-фактура</title>
<style>
<!--table
    {mso-displayed-decimal-separator:"\.";
    mso-displayed-thousand-separator:" ";}
@page
    {margin:.2in .39in .28in .59in;
    mso-header-margin:.2in;
    mso-footer-margin:.28in;
    mso-page-orientation:landscape;}
tr
    {mso-height-source:auto;}
col
    {mso-width-source:auto;}
br
    {mso-data-placement:same-cell;}
.style0
    {mso-number-format:General;
    text-align:general;
    vertical-align:bottom;
    white-space:nowrap;
    mso-rotate:0;
    mso-background-source:auto;
    mso-pattern:auto;
    color:windowtext;
    font-size:10.0pt;
    font-weight:400;
    font-style:normal;
    text-decoration:none;
    font-family:"Arial Cyr";
    mso-generic-font-family:auto;
    mso-font-charset:204;
    border:none;
    mso-protection:locked visible;
    mso-style-name:Обычный;
    mso-style-id:0;}
.style22
    {mso-number-format:General;
    text-align:general;
    white-space:nowrap;
    mso-rotate:0;
    mso-background-source:auto;
    mso-pattern:auto;
    color:windowtext;
    font-size:10.0pt;
    font-weight:400;
    font-style:normal;
    text-decoration:none;
    font-family:"Arial Cyr";
    mso-generic-font-family:auto;
    mso-font-charset:204;
    border:none;
    mso-protection:locked visible;
    mso-style-name:Обычный_Sf_131;}
.style27
    {mso-number-format:0%;
    mso-style-name:Процентный;
    mso-style-id:5;}
td
    {mso-style-parent:style0;
    padding-top:1px;
    padding-right:1px;
    padding-left:1px;
    mso-ignore:padding;
    color:windowtext;
    font-size:8pt !important;
    font-weight:400;
    font-style:normal;
    text-decoration:none;
    font-family:"Arial Cyr";
    mso-generic-font-family:auto;
    mso-font-charset:204;
    mso-number-format:General;
    text-align:general;
    vertical-align:bottom;
    border:none;
    mso-background-source:auto;
    mso-pattern:auto;
    mso-protection:locked visible;
/*     white-space:nowrap; */
    mso-rotate:0;}
.xl32
    {mso-style-parent:style22;}
.xl33
    {mso-style-parent:style22;
    font-size:8.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;}
.xl34
    {mso-style-parent:style22;
    font-size:2.0pt;
    font-family:"Arial Cyr", sans-serif;
    border-top:none;
    border-right:none;
    border-bottom:2.0pt double windowtext;
    border-left:none;}
.xl35
    {mso-style-parent:style22;
    text-align:right;
    border-top:none;
    border-right:none;
    border-bottom:2.0pt double windowtext;
    border-left:none;}
.xl36
    {mso-style-parent:style22;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;}
.xl37
    {mso-style-parent:style22;
    vertical-align:middle;
    white-space:normal;}
.xl38
    {mso-style-parent:style22;
    font-size:8.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:middle;
    border:.5pt solid windowtext;}
.xl39
    {mso-style-parent:style22;
    vertical-align:middle;}
.xl40
    {mso-style-parent:style22;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:top;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl41
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:top;
    border:.5pt solid windowtext;}
.xl42
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:Standard;
    vertical-align:top;
    border:.5pt solid windowtext;}
.xl43
    {mso-style-parent:style22;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:middle;
    border:.5pt solid windowtext;}
.xl44
    {mso-style-parent:style27;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:0%;
    vertical-align:top;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl45
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:Standard;
    vertical-align:top;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl46
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:Standard;
    text-align:center;
    vertical-align:top;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl47
    {mso-style-parent:style22;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    vertical-align:top;}
.xl48
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    vertical-align:top;}
.xl49
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    vertical-align:top;}
.xl50
    {mso-style-parent:style22;
    vertical-align:top;}
.xl51
    {mso-style-parent:style0;
    vertical-align:top;}
.xl52
    {mso-style-parent:style22;
    text-align:right;
    vertical-align:top;}
.xl53
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:Standard;
    text-align:center;
    vertical-align:top;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl54
    {mso-style-parent:style22;
    font-size:8.0pt;
    font-weight:700;
    font-family:"Arial CYR", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:middle;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl55
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:middle;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl56
    {mso-style-parent:style22;
    font-size:6.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:middle;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl57
    {mso-style-parent:style22;
    font-size:7.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;
    vertical-align:middle;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl58
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    border-top:none;
    border-right:none;
    border-bottom:.5pt solid windowtext;
    border-left:.5pt solid windowtext;}
.xl59
    {mso-style-parent:style22;
    border-top:none;
    border-right:none;
    border-bottom:.5pt solid windowtext;
    border-left:none;}
.xl60
    {mso-style-parent:style22;
    mso-number-format:Standard;
    font-size:9.0pt;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl61
    {mso-style-parent:style22;
    font-size:9.0pt;
    border-top:none;
    border-right:.5pt solid windowtext;
    border-bottom:.5pt solid windowtext;
    border-left:.5pt solid windowtext;}
.xl62
    {mso-style-parent:style22;
    mso-number-format:Standard;
    font-size:9.0pt;
    border-top:.5pt solid windowtext;
    border-right:.5pt solid windowtext;
    border-bottom:.5pt solid windowtext;
    border-left:none;
    white-space:normal;}
.xl63
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:Standard;
    border-top:.5pt solid windowtext;
    border-right:.5pt solid windowtext;
    border-bottom:.5pt solid windowtext;
    border-left:none;
    white-space:normal;}
.xl64
    {mso-style-parent:style22;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    vertical-align:top;}
.xl65
    {mso-style-parent:style22;
    font-size:14.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:center;}
.xl66
    {mso-style-parent:style22;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:left;
    vertical-align:top;
    border:.5pt solid windowtext;
    white-space:normal;}
.xl67
    {mso-style-parent:style22;
    font-size:14.0pt;
    font-weight:700;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    text-align:left;}
.xl68
    {mso-style-parent:style0;
    text-align:left;
    vertical-align:top;
    white-space:normal;}
.xl69
    {mso-style-parent:style0;
    text-align:left;
    vertical-align:top;}
.xl70
    {mso-style-parent:style0;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    mso-number-format:"\@";
    vertical-align:top;}
.xl71
    {mso-style-parent:style0;
    font-size:9.0pt;
    font-family:"Arial Cyr", sans-serif;
    mso-font-charset:204;
    vertical-align:top;}
.xl72
    {mso-style-parent:style0;
    mso-number-format:"\@";
    text-align:left;
    vertical-align:top;}
.xl73
    {mso-style-parent:style22;
    mso-number-format:"\@";
    text-align:left;
    vertical-align:top;}
-->
</style>
<title>Счет-фактура</title>
</head>

<body link=blue vlink=purple class=xl32>

<table x:str border=0 cellpadding=0 cellspacing=0 width=987 style='border-collapse:
 collapse;table-layout:fixed;width:740pt'>
 <col class=xl32 width=311 style='mso-width-source:userset;mso-width-alt:11373;
 width:233pt'>
 <col class=xl32 width=40 style='mso-width-source:userset;mso-width-alt:1462;
 width:30pt'>
 <col class=xl32 width=39 style='mso-width-source:userset;mso-width-alt:1426;
 width:29pt'>
 <col class=xl32 width=71 style='mso-width-source:userset;mso-width-alt:2596;
 width:53pt'>
 <col class=xl32 width=80 style='mso-width-source:userset;mso-width-alt:2925;
 width:60pt'>
 <col class=xl32 width=31 style='mso-width-source:userset;mso-width-alt:1133;
 width:23pt'>
 <col class=xl32 width=43 style='mso-width-source:userset;mso-width-alt:1572;
 width:32pt'>
 <col class=xl32 width=78 style='mso-width-source:userset;mso-width-alt:2852;
 width:59pt'>
 <col class=xl32 width=83 style='mso-width-source:userset;mso-width-alt:3035;
 width:62pt'>
 <col class=xl32 width=97 style='mso-width-source:userset;mso-width-alt:3547;
 width:73pt'>
 <col class=xl32 width=114 style='mso-width-source:userset;mso-width-alt:4169;
 width:86pt'>
 <tr height=24 style='mso-height-source:userset;height:18.6pt'>
  <td nowrap height=24 class=xl67 colspan=11 style='height:18.6pt;mso-ignore:
  colspan;'>СЧЕТ-ФАКТУРА №
    <input size="25" style="border:0px solid #000000;font-size:16px;font-style:bold;" type="text" value="_____ от __.__.____ г.">
  </td>
 </tr>
 <tr height=12 style='mso-height-source:userset;height:9.6pt'>
  <td colspan=11 height=12 class=xl34 style='height:9.6pt'>&nbsp;</td>
 </tr>
 <tr class=xl50 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl47 style='height:14.25pt'>Продавец</td>
  <td class=xl64 colspan=10 style='mso-ignore:colspan'><?=$arParams["COMPANY_NAME"]?></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>Адрес</td>
  <td class=xl50 colspan=10 style='mso-ignore:colspan'><? echo $arParams["COUNTRY"].", ".$arParams["INDEX"].", г. ".$arParams["CITY"].", ".$arParams["ADDRESS"];?></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>Телефон</td>
  <td colspan=10 class=xl50 style='mso-ignore:colspan'><?=$arParams["PHONE"]?></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>ИНН/КПП продавца</td>
  <td colspan=10 class=xl73><?=$arParams["INN"]?> / <?=$arParams["KPP"]?></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>Грузоотправитель и его адрес</td>
  <td colspan=10 class=xl50><?=$arParams["COMPANY_NAME"]?>, <?=$arParams["COUNTRY"]?>, <?=$arParams["INDEX"]?>, г. <?=$arParams["CITY"]?>, <?=$arParams["ADDRESS"]?></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>Грузополучатель и его адрес</td>
  <td class=xl64 colspan=10 style='mso-ignore:colspan'>
    <?if(empty($arParams))
    {   ?>
        <?//изменить F_NAME, F_INDEX,... на реальные мнемонические коды свойств?>
        <?echo $arOrderProps["F_NAME"];?>,
        <?echo $arOrderProps["F_INDEX"];?>
        <?
        $arVal = CSaleLocation::GetByID($arOrderProps["F_LOCATION"], "ru");
        echo htmlspecialchars($arVal["COUNTRY_NAME"]." - ".$arVal["CITY_NAME"]);
        ?>
        <?if (strlen($arOrderProps["F_CITY"])>0) echo ", г. ".$arOrderProps["F_CITY"];?>
        <?if (strlen($arOrderProps["F_ADDRESS"])>0) echo ", ".$arOrderProps["F_ADDRESS"];?>
        <?
    }
    else
    {
        ?>
        <?=$arParams["BUYER_COMPANY_NAME"]?>, <?=$arParams["BUYER_COUNTRY"]?>, <?=$arParams["BUYER_INDEX"]?>, г. <?=$arParams["BUYER_CITY"]?>, <?=$arParams["BUYER_ADDRESS"]?>
        <?
    }
    ?>
</td>
 </tr>
 <tr class=xl50 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl50 style='height:14.25pt'>К платежно-расчетному документу</td>
  <td colspan=10 class=xl64 style='mso-ignore:colspan'>
    <input size="50" style="border:0px solid #000000;" type="text" value="Платежное поручение №      от          г.">
  </td>
 </tr>
 <tr height=7 style='mso-height-source:userset;height:5.25pt'>
  <td height=7 class=xl34 style='height:5.25pt' colspan=11></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl47 style='height:13.5pt'>Покупатель</td>
  <td class=xl64 colspan=10>
    <?if(empty($arParams))
    {
        //изменить F_NAME на реальный мнемонический код свойства заказа "название компании"
        echo $arOrderProps["F_NAME"];
    }
    else
    {
        echo $arParams["BUYER_COMPANY_NAME"];
    }?>
  </td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>Адрес</td>
  <td colspan=10 class=xl50 style='mso-ignore:colspan'>
    <?if(empty($arParams))
    {

        //изменить F_INDEX, F_LOCATION,... на реальные мнемонические коды свойств
        echo $arOrderProps["F_INDEX"];
        $arVal = CSaleLocation::GetByID($arOrderProps["F_LOCATION"], "ru");
        echo htmlspecialchars($arVal["COUNTRY_NAME"]." - ".$arVal["CITY_NAME"]);
        if (strlen($arOrderProps["F_CITY"])>0) echo ", г. ".$arOrderProps["F_CITY"];
        if (strlen($arOrderProps["F_ADDRESS"])>0) echo ", ".$arOrderProps["F_ADDRESS"];

    }
    else
    {
        echo $arParams["BUYER_COUNTRY"].", ".$arParams["BUYER_INDEX"].", г. ".$arParams["BUYER_CITY"].", ".$arParams["BUYER_ADDRESS"];
    }?>

  </td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>Телефон</td>
  <td colspan=10 class=xl72>
    <?if(empty($arParams))
    {
        //изменить F_PHONE на реальный мнемонический код свойства заказа "контактный телефон компании"
        echo $arOrderProps["F_PHONE"];
    }
    else
    {
        echo $arParams["BUYER_PHONE"];
    }?>
  </td>
  <td class=xl50></td>
 </tr>
 <tr class=xl50 height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl50 style='height:13.5pt'>ИНН/КПП покупателя</td>
  <td colspan=10 class=xl68>
    <?if(empty($arParams))
    {
        //изменить F_INN на реальный мнемонический код свойства заказа "INN компании"
        echo $arOrderProps["F_INN"];
    }
    else
    {
        echo $arParams["BUYER_INN"]." / ".$arParams["BUYER_KPP"];
    }?>

  </td>
 </tr>
 <tr class=xl50 height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl50 colspan=5 style='height:14.25pt;mso-ignore:colspan'>Дополнение
  (условия оплаты по договору (контракту), способ отправления и т.п.)</td>
  <td colspan=6 class=xl50 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=15 style='mso-height-source:userset;height:11.25pt'>
  <td height=15 colspan=11 class=xl32 style='height:11.25pt;mso-ignore:colspan'></td>
 </tr>
 <tr class=xl37 height=44 style='mso-height-source:userset;height:33.6pt'>
  <td height=44 class=xl54 width=311 style='height:33.6pt;width:233pt'>Наименование
  товара (описание выполненных работ, оказанных услуг)</td>
  <td class=xl55 width=40 style='border-left:none;width:30pt'>Ед. изм.</td>
  <td class=xl55 width=39 style='border-left:none;width:29pt'>Кол-во</td>
  <td class=xl55 width=71 style='border-left:none;width:53pt'>Цена за ед.изм.</td>
  <td class=xl56 width=80 style='border-left:none;width:60pt'>Стоимость товаров
  (работ, услуг) всег без налога</td>
  <td class=xl57 width=31 style='border-left:none;width:23pt'>Акциз</td>
  <td class=xl54 width=43 style='border-left:none;width:32pt'>Налоговая ставка</td>
  <td class=xl55 width=78 style='border-left:none;width:59pt'>Сумма налога</td>
  <td class=xl56 width=83 style='border-left:none;width:62pt'>Стоимость товаров
  (работ, услуг) всего с учетом налога</td>
  <td class=xl54 width=97 style='border-left:none;width:73pt'>Страна
  происхождения</td>
  <td class=xl54 width=114 style='border-left:none;width:86pt'>Номер грузовой
  таможенной декларации</td>
 </tr>
 <tr class=xl39 height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl38 style='height:12.75pt;border-top:none' x:num>1</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>2</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>3</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>4</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>5</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>6</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>7</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>8</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>9</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>10</td>
  <td class=xl38 style='border-top:none;border-left:none' x:num>11</td>
 </tr>
<?
//налоги
$arTaxList = array();
$db_tax_list = CSaleOrderTax::GetList(array("APPLY_ORDER"=>"ASC"), Array("ORDER_ID"=>$ORDER_ID));
$iNds = -1;
$i = 0;
while ($ar_tax_list = $db_tax_list->Fetch())
{
    $arTaxList[$i] = $ar_tax_list;
    // определяем, какой из налогов - НДС
    // НДС должен иметь код NDS, либо необходимо перенести этот шаблон
    // в каталог пользовательских шаблонов и исправить
    if ($arTaxList[$i]["CODE"] == "NDS")
        $iNds = $i;
    $i++;
}

//состав заказа
$total_price = 0.00;
$total_sum = 0.00;
$total_nds = 0.00;
$n = 0;
$bVat = false;

for ($mi = 0; $mi < count($arBasketIDs); $mi++):
    $nds_val = 0;
    $taxRate = 0;

    $arBasket = CSaleBasket::GetByID($arBasketIDs[$mi]);

    if ($arQuantities[$mi] > DoubleVal($arBasket["QUANTITY"]))
    {
        $arQuantities[$mi] = DoubleVal($arBasket["QUANTITY"]);
    }

        //СВОЙСТВА ТОВАРА
        $aItemProps = Array();
        $oBasketProp = CSaleBasket::GetPropsList(Array('SORT' => 'ASC'), Array('BASKET_ID' => $arBasket['ID']), false, false, Array('NAME', 'VALUE', 'CODE', 'SORT'));
        while($aBaksetPropItem = $oBasketProp->Fetch()){
            $aItemProps[$aBaksetPropItem['CODE']] = $aBaksetPropItem;
        }
        unset($aBaksetPropItem, $oBasketProp);

        /*
         * Создание событий для модуля (для всех шаблонов печати)
         */
        $events = GetModuleEvents("linemedia.auto", "OnBeforeAdminBasketExtractPrint");
        while ($arEvent = $events->Fetch()) {
            try {
                ExecuteModuleEventEx($arEvent, array(&$arBasket['ID'], &$arBasket['PRICE'], &$aItemProps));
            } catch (Exception $e) {
                throw $e;
            }
        }

    $b_AMOUNT = roundEx(DoubleVal($arBasket["PRICE"])-DoubleVal($arBasket["DISCOUNT_PRICE"]), SALE_VALUE_PRECISION);

    //определяем начальную цену
    $item_price = $b_AMOUNT;
/*
    if(DoubleVal($arBasket["VAT_RATE"]) > 0)
    {
        $nds_val = $b_AMOUNT*$arBasket["VAT_RATE"]*$arQuantities[$mi];
        $item_price = $b_AMOUNT*(1 - $arBasket["VAT_RATE"]);
        $taxRate = $arBasket["VAT_RATE"]*100;
        $bVat = true;
    }
    elseif(!$bVat)
    {

        $basket_tax = CSaleOrderTax::CountTaxes($b_AMOUNT * $arQuantities[$mi], $arTaxList, $arOrder["CURRENCY"]);
        for ($i = 0; $i < count($arTaxList); $i++)
            if ($arTaxList[$i]["IS_IN_PRICE"] == "Y")
                $item_price -= $arTaxList[$i]["TAX_VAL"];

        $nds_val = ($iNds > -1? $arTaxList[$iNds]["TAX_VAL"] : 0);
        $taxRate = ($iNds > -1? $arTaxList[$iNds]["VALUE"] : 0);
    }
    $item_price = RoundEx($item_price, 2);

*/
    $item_total_summ = roundex($arBasket['PRICE'] * $arBasket['QUANTITY'], SALE_VALUE_PRECISION);
    $nds_val = 0;
    $taxRate = 0;
    if (DoubleVal($arBasket["VAT_RATE"]) > 0) {
        $nds_val = ($b_AMOUNT - DoubleVal($b_AMOUNT/(1+$arBasket["VAT_RATE"])));
        $item_price = $b_AMOUNT - $nds_val;
        $taxRate = $arBasket["VAT_RATE"]*100;
        $bVat = true;
    } elseif (!$bVat) {
        $basket_tax = CSaleOrderTax::CountTaxes($b_AMOUNT/*$arQuantities[$mi]*/, $arTaxList, $arOrder["CURRENCY"]);
        for ($i = 0; $i < count($arTaxList); $i++) {
            if ($arTaxList[$i]["IS_IN_PRICE"] == "Y") {
                $item_price -= $arTaxList[$i]["TAX_VAL"];
            }
        }
        $nds_val = DoubleVal($iNds > -1? $arTaxList[ $iNds ]["TAX_VAL"] : 0);
        $taxRate = ($iNds > -1? $arTaxList[$iNds]["VALUE"] : 0);
    }

    $item_price = RoundEx($item_price, SALE_VALUE_PRECISION);
    $nds_val = RoundEx($nds_val * $arQuantities[$mi], SALE_VALUE_PRECISION);
//      out($item_price, $nds_val);

    $sName= $arBasket["NAME"];
        if(isset($aItemProps['brand_title']['VALUE'])){
            $sName .= ' ' . $aItemProps['brand_title']['VALUE'];
        }
        if(isset($aItemProps['art']['VALUE'])){
            $sName .= ': ' . $aItemProps['art']['VALUE'];
        }
    ?>
 <tr class=xl39>
  <td class=xl66 width=311 style='border-top:none; width:233pt'><?echo htmlspecialcharsEx($sName) ?></td>
  <td class=xl40 width=40 style='border-top:none;border-left:none;width:30pt'>шт.</td>
  <td class=xl41 style='border-top:none;border-left:none'><?echo $arQuantities[$mi] ?></td>
  <td align="right" class=xl42 style='border-top:none;border-left:none'><?echo SaleFormatCurrency($item_price, $arOrder["CURRENCY"], true);?></td>
  <td class=xl42 align=right style='border-top:none;border-left:none' x:num><?echo SaleFormatCurrency($item_price * $arQuantities[$mi], $arOrder["CURRENCY"], true);  $total_price += ($item_price*$arQuantities[$mi]);?></td>
  <td class=xl43 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl44 align=right width=43 style='border-top:none;border-left:none;
  width:32pt'><?echo $taxRate." %"?></td>
  <td class=xl45 align=right width=78 style='border-top:none;border-left:none;
  width:59pt' x:num><?echo SaleFormatCurrency($nds_val, $arOrder["CURRENCY"], true); $total_nds += $nds_val;?></td>
  <td class=xl45 align=right width=83 style='border-top:none;border-left:none;
  width:62pt' x:num><?echo SaleFormatCurrency($item_total_summ, $arOrder["CURRENCY"], true);
    $total_sum += $item_total_summ?></td>
  <td class=xl46 width=97 style='border-top:none;border-left:none;width:73pt'><input size="10" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value=""></td>
  <td class=xl53 width=114 style='border-top:none;border-left:none;width:86pt'>---</td>
 </tr>
<?
    $n++;
endfor;
?>
<?
if (DoubleVal($arOrder["PRICE_DELIVERY"])>0):
    $basket_tax = CSaleOrderTax::CountTaxes(DoubleVal($arOrder["PRICE_DELIVERY"]), $arTaxList, $arOrder["CURRENCY"]);
    //определяем начальную цену
    $item_price = DoubleVal($arOrder["PRICE_DELIVERY"]);
    for ($i = 0; $i < count($arTaxList); $i++)
        if ($arTaxList[$i]["IS_IN_PRICE"] == "Y")
            $item_price -= $arTaxList[$i]["TAX_VAL"];
    $nds_val = ($iNds > -1? $arTaxList[$iNds]["TAX_VAL"] : 0.00);
    ?>
 <tr class=xl39>
  <td class=xl66 width=311 style='border-top:none;
  width:233pt'>Доставка</td>
  <td class=xl40 width=40 style='border-top:none;border-left:none;width:30pt'></td>
  <td class=xl41 style='border-top:none;border-left:none'>1</td>
  <td align="right" class=xl42 style='border-top:none;border-left:none'><?echo SaleFormatCurrency($item_price, $arOrder["CURRENCY"], true);?></td>
  <td class=xl42 align=right style='border-top:none;border-left:none' x:num><?echo SaleFormatCurrency($item_price, $arOrder["CURRENCY"], true);  $total_price += $item_price;?></td>
  <td class=xl43 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl44 align=right width=43 style='border-top:none;border-left:none;
  width:32pt'><?echo ($iNds > -1? DoubleVal($arTaxList[$iNds]["VALUE"]) : "0")." %"?></td>
  <td class=xl45 align=right width=78 style='border-top:none;border-left:none;
  width:59pt' x:num><?echo SaleFormatCurrency($nds_val, $arOrder["CURRENCY"], true); $total_nds += $nds_val;?></td>
  <td class=xl45 align=right width=83 style='border-top:none;border-left:none;
  width:62pt' x:num><?echo SaleFormatCurrency($nds_val+$item_price, $arOrder["CURRENCY"], true); $total_sum += $nds_val+$item_price?></td>
  <td class=xl46 width=97 style='border-top:none;border-left:none;width:73pt'>
    <input size="10" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="">
    </td>
  <td class=xl53 width=114 style='border-top:none;border-left:none;width:86pt'>---</td>
 </tr>
<?endif?>
 <tr>
  <td class=xl58>Всего к оплате:</td>
  <td class=xl59>&nbsp;</td>
  <td class=xl59>&nbsp;</td>
  <td class=xl59>&nbsp;</td>
  <td class=xl60 align=right width=80 style='border-top:none;width:60pt' x:num><?echo SaleFormatCurrency($total_price, $arOrder["CURRENCY"], true)?></td>
  <td class=xl61 style='border-left:none'>&nbsp;</td>
  <td class=xl61 style='border-left:none'>&nbsp;</td>
  <td class=xl62 align=right width=78 style='border-top:none;width:59pt' x:num><?echo SaleFormatCurrency($total_nds, $arOrder["CURRENCY"], true)?></td>
  <td class=xl63 align=right width=83 style='border-top:none;width:62pt' x:num><?echo SaleFormatCurrency($total_sum, $arOrder["CURRENCY"], true)?></td>
  <td class=xl63 width=97 style='border-top:none;width:73pt'>&nbsp;</td>
  <td class=xl63 width=114 style='border-top:none;width:86pt'>&nbsp;</td>
 </tr>

 <tr height=26 style='mso-height-source:userset;height:19.5pt'>
  <td height=26 class=xl36 style='height:19.5pt'></td>
  <td colspan=5 class=xl32 style='mso-ignore:colspan'></td>
  <td class=xl36></td>
  <td class=xl32></td>
  <td class=xl36></td>
  <td colspan=2 class=xl32 style='mso-ignore:colspan'></td>
 </tr>
 <tr valign="top">
  <td colspan=4 class=xl36>Руководитель организации _______________ <input size="16" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="/ <?echo ((strlen($arParams["DIRECTOR"]) > 0) ? $arParams["DIRECTOR"] : "_______________")?> /"></td>
  <td class=xl36 colspan=2 style='mso-ignore:colspan'></td>
  <td colspan=6 class=xl32 style='mso-ignore:colspan'>Главный бухгалтер _______________ <input size="16" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="/ <?echo ((strlen($arParams["BUHG"]) > 0) ? $arParams["BUHG"] : "_______________")?> /"></td>
 </tr>
 <tr height=0 style='display:none'>
  <td height=0 colspan=11 class=xl32 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 colspan=11 class=xl32 style='height:12.75pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 colspan=11 class=xl32 style='height:12.75pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=22 style='mso-height-source:userset;height:16.5pt'>
  <td height=22 colspan=5 class=xl32 style='height:16.5pt;mso-ignore:colspan'>Индивидуальный предприниматель _____________ / <input size="16" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="_______________"> /</td>
  <td height=22 colspan=1 class=xl32 style='height:16.5pt;mso-ignore:colspan'></td>
  <td colspan=5 class=xl36>Выдал _____________ / <input size="16" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="_______________"> /</td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 colspan=5 class=xl33 style='height:15.0pt;mso-ignore:colspan'>(реквизиты свидетельства о государственной регистрации
индивидуального предпринимателя)</td>
  <td height=20 colspan=1 class=xl32 style='height:15.0pt;mso-ignore:colspan'></td>
  <td class=xl33 colspan=5 style='mso-ignore:colspan'>(подпись ответственного
  лица от поставщика)</td>
 </tr>
 <tr height=9 style='mso-height-source:userset;height:6.75pt'>
  <td height=9 colspan=11 class=xl32 style='height:6.75pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:13.15pt'>
  <td height=17 class=xl33 colspan=4 style='height:13.15pt;mso-ignore:colspan'>1.
  Первый экземпляр (оригинал) - покупателю, второй экземпляр (копия) -
  продавцу.</td>
  <td colspan=7 class=xl32 style='mso-ignore:colspan'></td>
 </tr>
</table>

</body>

</html>
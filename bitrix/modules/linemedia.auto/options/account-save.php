<?php

$STATUS_APPROVED_DM = (string) ($_POST['STATUS_APPROVED_DM']);
COption::SetOptionString($sModuleId, 'STATUS_APPROVED_DM', $STATUS_APPROVED_DM);

$STATUS_SUPPLIER_REJECTION = (string) ($_POST['STATUS_SUPPLIER_REJECTION']);
COption::SetOptionString($sModuleId, 'STATUS_SUPPLIER_REJECTION', $STATUS_SUPPLIER_REJECTION);

$STATUS_SHIPMENT_REJECTION = (string) ($_POST['STATUS_SHIPMENT_REJECTION']);
COption::SetOptionString($sModuleId, 'STATUS_SHIPMENT_REJECTION', $STATUS_SHIPMENT_REJECTION);

$STATUS_COMMODITY_RETURN = (string) ($_POST['STATUS_COMMODITY_RETURN']);
COption::SetOptionString($sModuleId, 'STATUS_COMMODITY_RETURN', $STATUS_COMMODITY_RETURN);

$STATUS_DEAL_CLOSED_BY_COMMODITY = (string) ($_POST['STATUS_DEAL_CLOSED_BY_COMMODITY']);
COption::SetOptionString($sModuleId, 'STATUS_DEAL_CLOSED_BY_COMMODITY', $STATUS_DEAL_CLOSED_BY_COMMODITY);

$LM_AUTO_MAIN_STATUS_TRANSACTION_SWITCH = (string) ($_POST['LM_AUTO_MAIN_STATUS_TRANSACTION_SWITCH']);
COption::SetOptionString($sModuleId, 'LM_AUTO_MAIN_STATUS_TRANSACTION_SWITCH', $LM_AUTO_MAIN_STATUS_TRANSACTION_SWITCH);

$LM_AUTO_MAIN_PAY_FROM_ACCOUNT_DURING_RESERVE = (string) ($_POST['LM_AUTO_MAIN_PAY_FROM_ACCOUNT_DURING_RESERVE']);
COption::SetOptionString($sModuleId, 'LM_AUTO_MAIN_PAY_FROM_ACCOUNT_DURING_RESERVE', $LM_AUTO_MAIN_PAY_FROM_ACCOUNT_DURING_RESERVE);

$TRANSACTION_STATUSES = serialize(
    array(
        $STATUS_APPROVED_DM => LinemediaAutoTransaction::ACTION_RESERVE,
        $STATUS_SUPPLIER_REJECTION => LinemediaAutoTransaction::ACTION_SUPPLIER,
        $STATUS_SHIPMENT_REJECTION => LinemediaAutoTransaction::ACTION_SHIPMENT,
        $STATUS_COMMODITY_RETURN => LinemediaAutoTransaction::ACTION_GOODS_RETURN,
        $STATUS_DEAL_CLOSED_BY_COMMODITY => LinemediaAutoTransaction::ACTION_DEAL_CLOSED
    )
);


COption::SetOptionString($sModuleId, 'TRANSACTION_STATUSES', $TRANSACTION_STATUSES);

/* ���� ������������, ��� ������� ���������� �� ����������� */
$LM_AUTO_NO_TRANSACTION_PERSON = serialize((array) ($_POST['LM_AUTO_NO_TRANSACTION_PERSON']));
COption::SetOptionString($sModuleId, 'LM_AUTO_NO_TRANSACTION_PERSON', $LM_AUTO_NO_TRANSACTION_PERSON);

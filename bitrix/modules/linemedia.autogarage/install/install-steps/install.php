<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/*
 * ����������� � ������ ������ ���������� ����� �����������.
 */
$this->install_settings = (array) $_SESSION['linemedia_auto_garage_module_install_settings'];

// ��������� ���� ������.
if (!$this->InstallDB()) {
    ShowError(GetMessage('LM_AUTO_GARAGE_ERROR_INSTALL_DB'));
    exit();
}

// ��������� �������.
if (!$this->InstallEvents()) {
    ShowError(GetMessage('LM_AUTO_GARAGE_ERROR_INSTALL_EVENTS'));
    exit();
}

// ��������� ������.
if (!$this->InstallFiles()) {
    ShowError(GetMessage('LM_AUTO_GARAGE_ERROR_INSTALL_FILES'));
    exit();
}

// ��������� �������� ��������.
if (!$this->InstallMessageTemplates()) {
    ShowError(GetMessage('LM_AUTO_GARAGE_ERROR_INSTALL_MESSAGE_TEMPLATES'));
    exit();
}

// ���������� ������ ����� ������ ���� ������ ��� ����������.
if (!$this->InstallAgents()) {
    ShowError(GetMessage('LM_AUTO_GARAGE_ERROR_INSTALL_AGENTS'));
    exit();
}

// ���������� �������� ������.
if (!$this->InstallSaleProps()) {
    ShowError(GetMessage('LM_AUTO_GARAGE_ERROR_INSTALL_SALE_PROPS'));
    exit();
}


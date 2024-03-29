<?php

/**
 * Linemedia Autoportal
 * Suppliers parser module
 * Remote Etsp Supplier
 *
 * @author  Linemedia
 * @since   22/01/2012
 *
 * @link    http://auto.linemedia.ru/
 */

IncludeModuleLangFile(__FILE__);

/**
 * ��������� ��������� ����������
 * 'http://ws.etsp.ru/
 * Class EtspRemoteSupplier
 */
class EtspNewRemoteSupplier extends LinemediaAutoRemoteSuppliersSupplier
{
	const WSDL_ADDRESS_SEARCH  = 'http://ws.etsp.ru/Search.svc?wsdl';
	const WSDL_ADDRESS_LOGON   = 'http://ws.etsp.ru/Security.svc?wsdl';
	const WSDL_ADDRESS_REMAINS = 'http://ws.etsp.ru/PartsRemains.svc?wsdl';

	const WSDL_TIMEOUT = 5;

	public static $title = 'Etspnew';

	public $url = 'http://www.etsp.ru/'; // public - ��� ������ � ����������

	protected $soap;


	/**
	 * �������� ������
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * �������������.
	 * @throws Exception
	 */
	public function init()
	{
		/*
		 * Get default and set new timeout for soap request
		 */
		$defaultTimeout = ini_get('default_socket_timeout');
		ini_set("default_socket_timeout", self::WSDL_TIMEOUT);
		
		if (!class_exists('SoapClient')) {
			throw new Exception('SOAP module is not installed');
		}
		/*
		 * Create new soap client
		 */
		try {
			$this->soap = new SoapClient(self::WSDL_ADDRESS_SEARCH, array('trace' => true, 'soap_version' => SOAP_1_1));
		} catch(SoapFault $e) {
			throw new Exception('WSDL error: ' . $e->GetMessage());
		}

		/*
		 * Set default timeout for soap request
		 */
		ini_set("default_socket_timeout", $defaultTimeout);
	}

	/**
	 * �����������
	 * @return bool
	 * @throws Exception
	 */
	public function login()	{

		try {
			$soap = new SoapClient(self::WSDL_ADDRESS_LOGON, array('trace' => true, 'soap_version' => SOAP_1_1));
		} catch(SoapFault $e) {
			throw new Exception('WSDL error: ' . $e->GetMessage());
		}
		/*
		 * ��������� ��� ����������� ������
		 */
		$session = $this->loadSession();

		try {
			/*
			 * ���� ������ ���������, �� ��������� �� �� ����������
			 */
			if($session) {
				$param = array (
					'HashSession' => $session
				);
				$response = $soap->__soapCall('IsAuthentificate', array($param));

				if ((string) $response->IsAuthentificateResult) {
					return true;
				}
			}


			/*
			 * ���� ������ ��� ��� ��� �����������, �� �������� ����������� � ��������� ������
			 */

			$params = array(
				'Login' => (string) $this->profile_options['LOGIN'],
				'Password' => (string) $this->profile_options['PASSWORD']
			);
			$response = $soap->__soapCall('Logon', array($params));

			if($response->LogonResult && strpos($response->LogonResult, 'error') == false) {
				$this->saveSession((string)$response->LogonResult);
				return true;
			}

		} catch (Exception $e) {
			$error = trim($e->GetMessage());
			if(strpos($error, 'AccessProvider') !== false) {
				throw new Exception($error, LM_AUTO_DEBUG_USER_ERROR);
			}
			throw $e;
		}

		/*
		 * ���� ��� ��� � �� ������� �������������� - ������ ������
		 */
		throw new Exception('Auth error or incorrect login/password', LM_AUTO_DEBUG_USER_ERROR);
	}

	/**
	 * �����
	 */
	public function search()
	{

		/*
		 * ���������� ��� ������, ����� ���������� �����������.
		 */
		global $APPLICATION;

		require_once($_SERVER["DOCUMENT_ROOT"].  '/bitrix/modules/main/lib/loader.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/application.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/httpapplication.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/diag/exceptionhandler.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/config/configuration.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/text/string.php');

		$application = \Bitrix\Main\HttpApplication::getInstance();
		$application->initializeBasicKernel();

		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/cache.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/cache_files.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/data/cache.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/lib/data/cacheenginefiles.php');

		/*
		 * �������� ��� ������
		 */
		$groups = $this->getGroups();

		/*
		 * ��������� �������� �� ��������� ����������� �����
		 */
		$this->createCatalogs($groups);

		$this->createParts();


		/*
		 * ������������� ��� ������
		 */
		if (count($this->catalogs) == 1 || $this->brand_title != '') {
			$this->response_type = 'parts';
		} elseif (count($this->parts) == 0 && $this->brand_title != '' || count($this->catalogs) == 0) {
			$this->response_type = '404';
		} else {
			$this->response_type = 'catalogs';
		}
	}

	/**
	 * ���������� ��������
	 * @throws Exception
	 */
	protected function getGroups()
	{
		/*
		 * ������ ���������
		 */
		$param = array(
			'Text' => $this->query,
			'HashSession' => $this->loadSession()
		);

		/*
		 * ������ ������ �������� ������
		 */
		try {
			$response = $this->soapCall('SearchBasic', $param);
		} catch (Exception $e) {
			throw $e;
		}

		/*
		 * �� ��������������� XML-������ �������� ������
		 */
		$response = simplexml_load_string($response->SearchBasicResult);

		//����� ��� ����� ������� ������ - x ���������� � ������� ���!
		if($response->error_message)
			throw new Exception($response->error_message, LM_AUTO_DEBUG_USER_ERROR);

		/*
		 * �������� ������ ����������� �����, ����� � ���������� ��������� ������������� ������������� ������
		 */
		$groups = array();

		/*
		 * ��������� �� ����������� ������� � ...
		 */
		foreach ($response->part as $group) {

			/*
			 * ����������� � ������, �.�. � ��� �������� ������
			 */
			$group = (array) $group;

			/*
			 * ���������� ������ ��������
			 */
			if (empty($group['is_sklad']) && empty($group['is_shops']) && empty($group['is_shipment'])  && empty($group['is_outside'])) {
				continue;
			}

			/*
			 * ��������� ��������
			 */
			$groups[] = array(
				'article'       => $group['code'],
				'brand_title'   => $group['group'],
				'title'         => $group['name'],
				'extra' => array(
					'code' => $group['code'],
					'note' => $group['note'] ?: '',
					'unique_number'=> $group['unique_number'] ?: '',
					'omega_number' => $group['omega_number'] ?: '',
					'skuba_number' => $group['skuba_number'] ?: '',
					'code_image_part' => $group['code_image_part'] ?: '',
					'is_part_attendant' => $group['is_part_attendant'] ?: '',
					'is_sklad' => $group['is_sklad'] ?: '',
					'is_shops' => $group['is_shops'] ?: '',
					'is_shipment' => $group['is_shipment'] ?: '',
					'is_outside' => $group['is_outside'] ?: '',
					//'code_image_part'=> $group['code_image_part']
				),
			);

			unset($group);
		}

		return $groups;
	}

	/**
	 * ������� ������ �� ���������� � �������� $data
	 * @param $data
	 * @return bool
	 * @throws Exception
	 */
	protected function createCatalogs($groups)
	{
		$searchArticle = LinemediaAutoPartsHelper::clearArticle($this->query);

		$cache = new CPHPCache();
		$cache_time = 60*60*24*365*100;
		$cache_id = $searchArticle . self::$title;

		if ($cache->InitCache($cache_time, $cache_id, '/lm_auto/remote_suppliers/'.self::$title.'/')) {
			$cached = $cache->GetVars();			
			$this->catalogs = $cached['data'];

			return;
		}


		foreach($groups as $groupKey => $group) {

			$groupsParts = $this->getGroupParts($group);

			foreach($groupsParts as $groupParts) {

				foreach($groupParts as $groupPart) {
					/*
					 * �������� ������ ��������� ����� ����� ��������
					 */
					if(strpos($groupPart['article'], $searchArticle) === 0) {
						$group['brand_title'] = $groupPart['brand_title'];
						$group['article'] = $groupPart['article'];
						$this->catalogs[$group['brand_title']] = $group;
					}
				}
			}
		}

		$cache->StartDataCache();
		$cached_data['data'] = $this->catalogs;
		$cache->EndDataCache($cached_data);

	}

	/**
	 * ������� ������ �� ���������� � �������� $data
	 * @param $data
	 * @return bool
	 * @throws Exception
	 */
	protected function createParts()
	{
		if(count($this->catalogs) == 1) {
			$catalog = array_shift(array_slice($this->catalogs, 0, 1));
			$this->parts = $this->getGroupParts($catalog);
			return;
		}

		$searchBrand = strtoupper($this->brand_title);

		if(!empty($searchBrand)) {
			foreach($this->catalogs as $catalog) {
				if($searchBrand && $searchBrand == $catalog['brand_title']) {
					$this->parts = $this->getGroupParts($catalog);
					return;
				}
			}
		}
	}

	protected function getGroupParts($group)
	{
		$soap = new SoapClient(self::WSDL_ADDRESS_REMAINS, array('trace' => true, 'soap_version' => SOAP_1_1));
		/*
		 * ��������� ������
		 */
		$session = $this->loadSession();

		/*
		 * ������ ��������� �������
		 */
		$params = array(
			'Code' => (string) $group['extra']['code'],
			//������� ������ �������� ��������� ����
			'ShowRetailRemains' => 1,
			//������� ������ ������� ��� �����
			'ShowOutsideRemains' => 1,
			'ShowPriceByQuantity' => 0,
			'HashSession' => (string) $session,
		);

		/*
		 * ������ ������ �� ��������� �������� ��� ������� ��������
		 */
		try {
			$response = $soap->__soapCall('GetPartsRemainsByCode2', array($params));
		} catch (Exception $e) {
			throw $e;
		}

		/*
		 * �� ��������������� XML-������ �������� ������
		 */
		$response_parts =  (array) simplexml_load_string($response->GetPartsRemainsByCode2Result);

		//����� ��� ����� ������� ������ - x ���������� � ������� ���!
		if($response_parts['error_message'])
			throw new Exception($response_parts['error_message'], LM_AUTO_DEBUG_USER_ERROR);

		/*
		 * �������� ������� �� �������
		 */
		$response_parts_sklad = $response_parts['sklad_remains'];

		/*
		 * ���� ������ 1 ������
		 */
		if (is_object($response_parts_sklad)) {
			$response_part = (array) $response_parts_sklad;
			$response_parts_sklad = array();
			$response_parts_sklad[0] = $response_part;
		}

		/*
		 * ��������� ������ � ��������
		 */
		$partsSklad = $this->getPartsFromResponse($response_parts_sklad, $group);

		/*
		 * �������� ������� ������� ��� �����
		 */
		$response_parts_outside = $response_parts['outside_remains'];

		/*
		 * ���� ������ 1 ������
		 */
		if (is_object($response_parts_outside)) {
			$response_part = (array) $response_parts_outside;
			$response_parts_outside = array();
			$response_parts_outside[10000] = $response_part;
		}

		/*
		 * ��������� ������ � ��������
		 */
		$partsOutside = $this->getPartsFromResponse($response_parts_outside, $group);

		return array_merge_recursive($partsSklad, $partsOutside);
	}

	/**
	 * ��������� �������� �� ���������� ������
	 * 
*@param $response_parts
	 * @param array $group
	 * @return bool
	 */
	protected function getPartsFromResponse($response_parts, $group = array())
	{
		$parts = array();

		$response_parts = (array) $response_parts;
		$response_parts = array_shift($response_parts);
		$response_parts = (array) $response_parts;
		$response_parts = (array) $response_parts['item'];


		/*
		 * ���� 1 ������ ��� ���� ������
		 */
		if (!empty($response_parts['id_goods_unit']) && !empty($response_parts['goods_code'])) {
			$response_parts = array(0 => $response_parts);
		}
		foreach ($response_parts as $part) {

			$part = (array) $part;

			$article = LinemediaAutoPartsHelper::clearArticle(strval($part['manufacturer_number']));

			// ��� ���������: ������������ ��� ���.
			if ($article == $this->query) {
				$analog_type = 'N';
			} else {
				$analog_type = '0';
			}

			/*
			 * �������� �-��
			 */
			$quantity = str_replace('>', '', $part['quantity']);
			$quantity = str_replace('<', '', $quantity);

			$parts['analog_type_' . $analog_type][] = array(
				'id'                => 'etspnew',
				'article'           => LinemediaAutoPartsHelper::clearArticle(strval($part['manufacturer_number'])),
				'brand_title'       => strtoupper(strval($part['manufacturer_name'])),
				'title'             => !is_object($part['goods_comment']) && !empty($part['goods_comment']) ? strval($group['title']) . ', ' . strval($part['goods_comment']) : strval($group['title']) . ',
				' . strval($group['extra']['note']),
				'price'             => intval($part['price']),
				'quantity'          => (int)$quantity,
				'delivery_time'     => $part['delivery_time'] * 24, // � �����
				'date_update'       => '',
				'weight' 			=> (float)$part['weight'],
				'data-source'       => self::$title,
				'extra'             => array(
					'id_goods_unit' => strval($part['id_goods_unit']),
					//'goods_comment' => strval($part['goods_comment']),
					'storage_id'	 => strval($part['storage_id']),
					'storage_name' => strval($part['storage_name']),
					'storage_position' => strval($part['storage_position']),
					'remains_status_id' => strval($part['remains_status_id']),
					'remains_status_name' => strval($part['remains_status_name']),
					'weight' => (float)str_replace(',', '.', $part['weight']),
					//'ordered' => strval($part['ordered']),
					//'quantity_cart' => strval($part['quantity_cart']),
					'code' => $group['extra']['code'],
					'title' => strval($group['title']),
					'hash' => md5 ($part['quantity'].$part['delivery_time'].$part['manufacturer_name'].$part['manufacturer_number'].$part['weight'])
				),
			);
		}

		return $parts;
	}

	/**
	 * �������� ���������� � ������ (�������� ��� ���������� � �������)
	 * @param $data
	 * @return array
	 * @throws Exception
	 */
	public function getPartData($data)
	{
		/*
		 * ����������������
		 */
		$this->init();

		/*
		 * ������������
		 */
		$this->login();


		$parts = $this->getGroupParts($data);

		foreach ($parts as $group => $parts) {
			foreach ($parts as $part) {
				if ($part['extra']['hash'] == $data['extra']['hash']) {
					return $part;
				}
			}
		}
		return array();
	}

	/**
	 * soapCall
	 * @param $func
	 * @param $args
	 * @return mixed
	 * @throws Exception
	 */
	protected function soapCall($func, $args)
	{
		try {
			$response = $this->soap->__soapCall($func, array($args));
		} catch (Exception $e) {

			throw $e;
		}

		return $response;
	}

	/**
	 * ���������� � ��������� cookie.
	 * @param $session
	 */
	protected function saveSession($session)
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/tmp/';

		if (!file_exists($path)) {
			mkdir($path);
		}

		file_put_contents($path . 'lm_auto_remote_suppl_etspnew_session.txt', (string) $session);
	}

	/**
	 * �������� ���������� cookie.
	 * @return string
	 */
	protected function loadSession()
	{
		$file = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/tmp/lm_auto_remote_suppl_etspnew_session.txt';
		$hash = '';

		if (file_exists($file)) {
			$hash =  file_get_contents($file);
		}

		return $hash;

	}


	/**
	 * ��������� �������.
	 * @return array
	 */
	public function getConfigVars()
	{
		return array(
			'LOGIN' => array(
				'title' => GetMessage('LOGIN'),
				'type'  => 'string',
			),
			'PASSWORD' => array(
				'title' => GetMessage('PASSWORD'),
				'type' => 'password',
			),
		);
	}

}


<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * Contributor(s): JoForce.com
 ************************************************************************************/

class Products_SubProductQuantityUpdate_View extends Head_View_Controller {

	public function checkPermission(Head_Request $request) {
		$moduleName = $request->getModule();
		$moduleModel = Head_Module_Model::getInstance($moduleName);

		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		if (!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
			throw new AppException(vtranslate($moduleName, $moduleName) . ' ' . vtranslate('LBL_NOT_ACCESSIBLE'));
		}
	}

	public function preProcess(Head_Request $request, $display = true) {

	}

	public function process(Head_Request $request) {
		$moduleName = $request->getModule();
		$recordId = $request->get('record');
		$relId = $request->get('relid');
		$currentQty = $request->get('currentQty');

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('RECORD_ID', $recordId);
		$viewer->assign('REL_ID', $relId);
		$viewer->assign('CURRENT_QTY', $currentQty);
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->view('QuantityUpdate.tpl', $moduleName);
	}

	public function postProcess(Head_Request $request) {
		
	}

}

?>
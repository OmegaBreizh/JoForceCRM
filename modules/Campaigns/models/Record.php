<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * Contributor(s): JoForce.com
 *************************************************************************************/

class Campaigns_Record_Model extends Head_Record_Model {

	/**
	 * Function to get selected ids list of related module for send email
	 * @param <String> $relatedModuleName
	 * @param <array> $excludedIds
	 * @return <array> List of selected ids
	 */
	public function getSelectedIdsList($relatedModuleName, $excludedIds = false) {
		$db = PearDatabase::getInstance();

		switch($relatedModuleName) {
			case "Leads"		: $tableName = "jo_campaignleadrel";		$fieldName = "leadid";		break;
			case "Accounts"		: $tableName = "jo_campaignaccountrel";		$fieldName = "accountid";	break;
			case 'Contacts'		: $tableName = "jo_campaigncontrel";		$fieldName = "contactid";	break;
		}

		$query = "SELECT $fieldName FROM $tableName
					INNER JOIN jo_crmentity ON $tableName.$fieldName = jo_crmentity.crmid AND jo_crmentity.deleted = ?
					WHERE campaignid = ?";
		if ($excludedIds) {
			$query .= " AND $fieldName NOT IN (". implode(',', $excludedIds) .")";
		}

		$result = $db->pquery($query, array(0, $this->getId()));
		$numOfRows = $db->num_rows($result);

		$selectedIdsList = array();
		for ($i=0; $i<$numOfRows; $i++) {
			$selectedIdsList[] = $db->query_result($result, $i, $fieldName);
		}
		return $selectedIdsList;
	}
}


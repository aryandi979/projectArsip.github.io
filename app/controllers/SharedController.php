<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * document_Kodeklasifikasiid_option_list Model Action
     * @return array
     */
	function document_Kodeklasifikasiid_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT kodeklasifikasiid AS value,kodeklasifikasiid AS label FROM retensi ORDER BY kodeklasifikasiid ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_user_role_id_option_list Model Action
     * @return array
     */
	function user_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_Username_value_exist Model Action
     * @return array
     */
	function user_Username_value_exist($val){
		$db = $this->GetModel();
		$db->where("Username", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_Email_value_exist Model Action
     * @return array
     */
	function user_Email_value_exist($val){
		$db = $this->GetModel();
		$db->where("Email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * getcount_arsipsebelumnya Model Action
     * @return Value
     */
	function getcount_arsipsebelumnya(){
		$db = $this->GetModel();
		$sqltext = "SELECT concat(sebelum) AS num FROM rekapan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_arsipupdate Model Action
     * @return Value
     */
	function getcount_arsipupdate(){
		$db = $this->GetModel();
		$sqltext = "SELECT concat(hariterakhir) AS num FROM rekapan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalarsip Model Action
     * @return Value
     */
	function getcount_totalarsip(){
		$db = $this->GetModel();
		$sqltext = "SELECT concat(Total) AS num FROM rekapan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}

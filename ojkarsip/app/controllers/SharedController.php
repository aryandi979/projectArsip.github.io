<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
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

}

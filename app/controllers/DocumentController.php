<?php 
/**
 * Document Page Controller
 * @category  Controller
 */
class DocumentController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "document";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_document", 
			"Nama_Berkas", 
			"Tahun", 
			"Kodeklasifikasiid", 
			"Aktif", 
			"Inaktif", 
			"Lokasi", 
			"Tanggal");
		$pagination = $this->get_pagination(200000); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				document.id_document LIKE ? OR 
				document.Nama_Berkas LIKE ? OR 
				document.Tahun LIKE ? OR 
				document.Kodeklasifikasiid LIKE ? OR 
				document.Aktif LIKE ? OR 
				document.Inaktif LIKE ? OR 
				document.Ruangan LIKE ? OR 
				document.Rak LIKE ? OR 
				document.Dus LIKE ? OR 
				document.Lokasi LIKE ? OR 
				document.File LIKE ? OR 
				document.Keterangan LIKE ? OR 
				document.Tanggal LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "document/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("document.id_document", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['Tanggal'] = format_date($record['Tanggal'],'Y-m-d H:i:s');
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Document";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("document/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id_document", 
			"Nama_Berkas", 
			"Tahun", 
			"Kodeklasifikasiid", 
			"Aktif", 
			"Inaktif", 
			"Lokasi", 
			"File", 
			"Ruangan", 
			"Rak", 
			"Dus", 
			"Keterangan", 
			"Tanggal");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("document.id_document", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['Tanggal'] = format_date($record['Tanggal'],'Y-m-d H:i:s');
			$page_title = $this->view->page_title = "View  Document";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("document/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("Nama_Berkas","Tahun","Kodeklasifikasiid","Ruangan","Rak","Dus","Lokasi","File");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'Nama_Berkas' => 'required',
				'Tahun' => 'required|numeric',
				'Kodeklasifikasiid' => 'required',
				'File' => 'required',
			);
			$this->sanitize_array = array(
				'Nama_Berkas' => 'sanitize_string',
				'Tahun' => 'sanitize_string',
				'Kodeklasifikasiid' => 'sanitize_string',
				'Ruangan' => 'sanitize_string',
				'Rak' => 'sanitize_string',
				'Dus' => 'sanitize_string',
				'Lokasi' => 'sanitize_string',
				'File' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
//query the database and return a single field value
$db->where("Kodeklasifikasiid", $modeldata['Kodeklasifikasiid']);
$Aktif = $db->getValue("retensi", "Aktif");
$db->where("Kodeklasifikasiid", $modeldata['Kodeklasifikasiid']);
$Inaktif = $db->getValue("retensi", "Inaktif");
$db->where("Kodeklasifikasiid", $modeldata['Kodeklasifikasiid']);
$Keterangan = $db->getValue("retensi", "Keterangan");
$table_data = array(
    "Aktif" => $Aktif,
    "Inaktif" => $Inaktif,
    "Keterangan" => $Keterangan
);
$db->where("id_document", $rec_id);
$bool = $db->update("document", $table_data);
		# End of after add statement
					$this->set_flash_msg("Arsip added successfully", "success");
					return	$this->redirect("document");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Document";
		$this->render_view("document/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_document","Nama_Berkas","Tahun","Kodeklasifikasiid","Ruangan","Rak","Dus","Lokasi","File");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'Nama_Berkas' => 'required',
				'Tahun' => 'required|numeric',
				'Kodeklasifikasiid' => 'required',
				'File' => 'required',
			);
			$this->sanitize_array = array(
				'Nama_Berkas' => 'sanitize_string',
				'Tahun' => 'sanitize_string',
				'Kodeklasifikasiid' => 'sanitize_string',
				'Ruangan' => 'sanitize_string',
				'Rak' => 'sanitize_string',
				'Dus' => 'sanitize_string',
				'Lokasi' => 'sanitize_string',
				'File' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				//get files link to be deleted before updating records
				$file_fields = array('File'); //list of file fields
				$db->where("document.id_document", $rec_id);;
				$fields_file_paths = $db->getOne($tablename, $file_fields);
				$db->where("document.id_document", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					if(!empty($fields_file_paths)){
						foreach($file_fields as $field){
							$files = explode(',', $fields_file_paths[$field]); // for list of files separated by comma
							foreach($files as $file){
								//delete files which are not among the submited post data
								if(stripos($modeldata[$field], $file) === false ){
									$file_dir_path = str_ireplace( SITE_ADDR , "" , $file ) ;
									@unlink($file_dir_path);
								}
							}
						}
					}
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("document");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("document");
					}
				}
			}
		}
		$db->where("document.id_document", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Document";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("document/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_document","Nama_Berkas","Tahun","Kodeklasifikasiid","Ruangan","Rak","Dus","Lokasi","File");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'Nama_Berkas' => 'required',
				'Tahun' => 'required|numeric',
				'Kodeklasifikasiid' => 'required',
				'File' => 'required',
			);
			$this->sanitize_array = array(
				'Nama_Berkas' => 'sanitize_string',
				'Tahun' => 'sanitize_string',
				'Kodeklasifikasiid' => 'sanitize_string',
				'Ruangan' => 'sanitize_string',
				'Rak' => 'sanitize_string',
				'Dus' => 'sanitize_string',
				'Lokasi' => 'sanitize_string',
				'File' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("document.id_document", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		//list of file fields
		$file_fields = array('File'); 
		foreach( $arr_id as $rec_id ){
			$db->where("document.id_document", $arr_rec_id, "in");;
		}
		//get files link to be deleted before deleting records
		$files = $db->get($tablename, null , $file_fields); 
		$db->where("document.id_document", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			//delete files after record has been deleted
			foreach($file_fields as $field){
				$this->delete_record_files($files, $field);
			}
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("document");
	}
}

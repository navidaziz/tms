<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Departments extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/department_model");
		$this->lang->load("departments", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`departments`.`status` IN (0, 1) ";
		$data = $this->department_model->get_department_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_department($department_id){
        
        $department_id = (int) $department_id;
		$data = $this->department_model->get_department($department_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`departments`.`status` IN (2) ";
		$data = $this->department_model->get_department_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($department_id){
        
        $department_id = (int) $department_id;
		$this->department_model->changeStatus($department_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor department from trash
      * @param $department_id integer
      */
     public function restore($department_id){
        
        $department_id = (int) $department_id;
		$this->department_model->changeStatus($department_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft department from trash
      * @param $department_id integer
      */
     public function draft($department_id){
        
        $department_id = (int) $department_id;
		$this->department_model->changeStatus($department_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish department from trash
      * @param $department_id integer
      */
     public function publish($department_id){
        
        $department_id = (int) $department_id;
		$this->department_model->changeStatus($department_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Department
      * @param $department_id integer
      */
     public function delete($department_id, $page_id = NULL){
        
        $department_id = (int) $department_id;
        //$this->department_model->changeStatus($department_id, "3");
        $this->department_model->delete(array( 'department_id' => $department_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$department_id = $this->department_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($department_id){
		$department_id = $this->department_model->update_data($department_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        

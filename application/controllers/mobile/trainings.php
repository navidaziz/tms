<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Trainings extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/training_model");
		$this->lang->load("trainings", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`trainings`.`status` IN (0, 1) ";
		$data = $this->training_model->get_training_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_training($training_id){
        
        $training_id = (int) $training_id;
		$data = $this->training_model->get_training($training_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`trainings`.`status` IN (2) ";
		$data = $this->training_model->get_training_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($training_id){
        
        $training_id = (int) $training_id;
		$this->training_model->changeStatus($training_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor training from trash
      * @param $training_id integer
      */
     public function restore($training_id){
        
        $training_id = (int) $training_id;
		$this->training_model->changeStatus($training_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft training from trash
      * @param $training_id integer
      */
     public function draft($training_id){
        
        $training_id = (int) $training_id;
		$this->training_model->changeStatus($training_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish training from trash
      * @param $training_id integer
      */
     public function publish($training_id){
        
        $training_id = (int) $training_id;
		$this->training_model->changeStatus($training_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Training
      * @param $training_id integer
      */
     public function delete($training_id, $page_id = NULL){
        
        $training_id = (int) $training_id;
        //$this->training_model->changeStatus($training_id, "3");
        $this->training_model->delete(array( 'training_id' => $training_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$training_id = $this->training_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($training_id){
		$training_id = $this->training_model->update_data($training_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        

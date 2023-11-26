<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Training_batches extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/training_batche_model");
		$this->lang->load("training_batches", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`training_batches`.`status` IN (0, 1) ";
		$data = $this->training_batche_model->get_training_batche_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_training_batche($batch_id){
        
        $batch_id = (int) $batch_id;
		$data = $this->training_batche_model->get_training_batche($batch_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`training_batches`.`status` IN (2) ";
		$data = $this->training_batche_model->get_training_batche_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($batch_id){
        
        $batch_id = (int) $batch_id;
		$this->training_batche_model->changeStatus($batch_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor training_batche from trash
      * @param $batch_id integer
      */
     public function restore($batch_id){
        
        $batch_id = (int) $batch_id;
		$this->training_batche_model->changeStatus($batch_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft training_batche from trash
      * @param $batch_id integer
      */
     public function draft($batch_id){
        
        $batch_id = (int) $batch_id;
		$this->training_batche_model->changeStatus($batch_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish training_batche from trash
      * @param $batch_id integer
      */
     public function publish($batch_id){
        
        $batch_id = (int) $batch_id;
		$this->training_batche_model->changeStatus($batch_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Training_batche
      * @param $batch_id integer
      */
     public function delete($batch_id, $page_id = NULL){
        
        $batch_id = (int) $batch_id;
        //$this->training_batche_model->changeStatus($batch_id, "3");
        $this->training_batche_model->delete(array( 'batch_id' => $batch_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$batch_id = $this->training_batche_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($batch_id){
		$batch_id = $this->training_batche_model->update_data($batch_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Training_batches extends Admin_Controller{
    
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
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`training_batches`.`status` IN (0, 1) ";
		$data = $this->training_batche_model->get_training_batche_list($where);
		 $this->data["training_batches"] = $data->training_batches;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Training Batches');
		$this->data["view"] = ADMIN_DIR."training_batches/training_batches";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_training_batche($batch_id){
        
        $batch_id = (int) $batch_id;
        
        $this->data["training_batches"] = $this->training_batche_model->get_training_batche($batch_id);
        $this->data["title"] = $this->lang->line('Training Batche Details');
		$this->data["view"] = ADMIN_DIR."training_batches/view_training_batche";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`training_batches`.`status` IN (2) ";
		$data = $this->training_batche_model->get_training_batche_list($where);
		 $this->data["training_batches"] = $data->training_batches;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Training Batches');
		$this->data["view"] = ADMIN_DIR."training_batches/trashed_training_batches";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($batch_id, $page_id = NULL){
        
        $batch_id = (int) $batch_id;
        
        
        $this->training_batche_model->changeStatus($batch_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."training_batches/view/".$page_id);
    }
    
    /**
      * function to restor training_batche from trash
      * @param $batch_id integer
      */
     public function restore($batch_id, $page_id = NULL){
        
        $batch_id = (int) $batch_id;
        
        
        $this->training_batche_model->changeStatus($batch_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."training_batches/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft training_batche from trash
      * @param $batch_id integer
      */
     public function draft($batch_id, $page_id = NULL){
        
        $batch_id = (int) $batch_id;
        
        
        $this->training_batche_model->changeStatus($batch_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."training_batches/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish training_batche from trash
      * @param $batch_id integer
      */
     public function publish($batch_id, $page_id = NULL){
        
        $batch_id = (int) $batch_id;
        
        
        $this->training_batche_model->changeStatus($batch_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."training_batches/view/".$page_id);
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
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."training_batches/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Training_batche
      */
     public function add(){
		
    $this->data["trainings"] = $this->training_batche_model->getList("trainings", "training_id", "title", $where ="`trainings`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New Training Batche');$this->data["view"] = ADMIN_DIR."training_batches/add_training_batche";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->training_batche_model->validate_form_data() === TRUE){
		  
		  $batch_id = $this->training_batche_model->save_data();
          if($batch_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."training_batches/edit/$batch_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."training_batches/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Training_batche
      */
     public function edit($batch_id){
		 $batch_id = (int) $batch_id;
        $this->data["training_batche"] = $this->training_batche_model->get($batch_id);
		  
    $this->data["trainings"] = $this->training_batche_model->getList("trainings", "training_id", "title", $where ="`trainings`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit Training Batche');$this->data["view"] = ADMIN_DIR."training_batches/edit_training_batche";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($batch_id){
		 
		 $batch_id = (int) $batch_id;
       
	   if($this->training_batche_model->validate_form_data() === TRUE){
		  
		  $batch_id = $this->training_batche_model->update_data($batch_id);
          if($batch_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."training_batches/edit/$batch_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."training_batches/edit/$batch_id");
            }
        }else{
			$this->edit($batch_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["training_batches"] = $this->training_batche_model->getBy($where, false, "batch_id" );
				$j_array[]=array("id" => "", "value" => "training_batche");
				foreach($data["training_batches"] as $training_batche ){
					$j_array[]=array("id" => $training_batche->batch_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        

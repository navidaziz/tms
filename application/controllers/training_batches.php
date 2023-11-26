<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Training_batches extends Public_Controller{
    
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
        $this->view();
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`status` IN (1) ";
		$data = $this->training_batche_model->get_training_batche_list($where,TRUE, TRUE);
		 $this->data["training_batches"] = $data->training_batches;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Training Batches";
         $this->data["view"] = PUBLIC_DIR."training_batches/training_batches";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_training_batche($batch_id){
        
        $batch_id = (int) $batch_id;
        
        $this->data["training_batches"] = $this->training_batche_model->get_training_batche($batch_id);
        $this->data["title"] = "Training Batches Details";
        $this->data["view"] = PUBLIC_DIR."training_batches/view_training_batche";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        

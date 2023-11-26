<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Trainings extends Public_Controller{
    
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
		$data = $this->training_model->get_training_list($where,TRUE, TRUE);
		 $this->data["trainings"] = $data->trainings;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Trainings";
         $this->data["view"] = PUBLIC_DIR."trainings/trainings";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_training($training_id){
        
        $training_id = (int) $training_id;
        
        $this->data["trainings"] = $this->training_model->get_training($training_id);
        $this->data["title"] = "Trainings Details";
        $this->data["view"] = PUBLIC_DIR."trainings/view_training";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        

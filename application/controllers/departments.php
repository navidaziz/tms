<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Departments extends Public_Controller{
    
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
		$data = $this->department_model->get_department_list($where,TRUE, TRUE);
		 $this->data["departments"] = $data->departments;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Departments";
         $this->data["view"] = PUBLIC_DIR."departments/departments";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_department($department_id){
        
        $department_id = (int) $department_id;
        
        $this->data["departments"] = $this->department_model->get_department($department_id);
        $this->data["title"] = "Departments Details";
        $this->data["view"] = PUBLIC_DIR."departments/view_department";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        

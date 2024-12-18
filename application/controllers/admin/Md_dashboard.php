<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Md_dashboard extends Admin_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('project_helper');
   }





   public function index()
   {
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/index', $this->data);
   }

   public function facilities_rating(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/facilities_rating', $this->data);
   }

   public function facilitators_rating(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/facilitators_rating', $this->data);
   }

   public function trainees_gender_wise(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/trainees_gender_wise', $this->data);
   }
   public function facilitators_gender_wise(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/facilitators_gender_wise', $this->data);
   }
   public function district_wise_trainees(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/district_wise_trainees', $this->data);
   }
   public function pre_post_tests(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/pre_post_tests', $this->data);
   }
   public function training_locality_level(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/training_locality_level', $this->data);
   }
    

   public function designation_wise_trainees(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/designation_wise_trainees', $this->data);
   }

   public function cader_wise_trainees(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/cader_wise_trainees', $this->data);
   }

   public function training_type(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/training_type', $this->data);
   }
   public function training_categories(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/training_categories', $this->data);
   }

   public function sub_categories(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/sub_categories', $this->data);
   }

   public function training_for(){
      $this->data['title'] = 'HCIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/training_for', $this->data);
   }

   

   

   

   
   
   

   

   

   

   
}

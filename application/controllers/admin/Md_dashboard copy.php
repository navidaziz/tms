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

   public function fy_wise_budget_utilization()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/fy_wise_budget_utilization', $this->data);
   }


   public function district_expenses()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/district_expenses', $this->data);
   }

   public function region_expenses()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/region_expenses', $this->data);
   }

   public function district_schemes()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/district_schemes', $this->data);
   }

   public function region_schemes()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/region_schemes', $this->data);
   }

   public function completed_scheme_avg()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/completed_scheme_avg', $this->data);
   }

   public function category_totals()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/category_totals', $this->data);
   }

   public function scheme_category_total()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/scheme_category_total', $this->data);
   }

   public function scheme_category_heat_map()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/scheme_category_heat_map', $this->data);
   }


   public function district_scheme_heat_map()
   {
      
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/district_scheme_heat_map', $this->data);
   }
   









   public function components_targets()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/components_targets', $this->data);
   }

   public function sub_components_targets()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/sub_components_targets', $this->data);
   }


   public function categories_targets()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/categories_targets', $this->data);
   }

   public function components_expenses()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/components_expenses', $this->data);
   }

   public function sub_components_expenses()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/sub_components_expenses', $this->data);
   }

   public function categories_expenses()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/categories_expenses', $this->data);
   }

   public function budget_utilization()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/budget_utilization', $this->data);
   }

   public function budget_utilization_summary()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/budget_utilization_summary', $this->data);
   }

   public function expense_purpose()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/expense_purpose', $this->data);
   }
   public function beneficiaries()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/beneficiaries', $this->data);
   }

   public function districts_summary()
   {
      $this->data['title'] = 'KPIAIP Dashboard';
      $this->data['description'] = 'Monitoring and evaluation dashboard';
      $this->load->view('admin/md_dashboard/districts_summary', $this->data);
   }
}

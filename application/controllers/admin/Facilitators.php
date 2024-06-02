<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Facilitators extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

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
    public function index()
    {
        $this->data["title"] = 'Facilitators List';
        $this->data["description"] = 'List of Facilitators or Resource Persons';
        $this->data["view"] = ADMIN_DIR . "facilitators/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function add_facilitator_form()
    {
        $this->data['nomination_type'] = $nomination__type =  $this->input->post('nomination_type');
        if ($nomination__type == 'resource_person') {
            $title = 'Add Facilitator';
        }
        if ($nomination__type == 'trainee') {
            $title = 'Add Trainee';
        }
        $this->data['title'] = $title;
        $this->load->view(ADMIN_DIR . "facilitators/add_facilitator_form", $this->data);
    }
    public function is_unique_except($cnic, $user_id)
    {

        $query = $this->db->where('cnic', $cnic)
            ->where('user_id !=', $user_id)
            ->get('users');

        return $query->num_rows() === 0;
    }
    public function add_facilitator()
    {


        $this->load->library('form_validation');

        if ($this->input->post('user_id')) {
            $user_id = (int) $this->input->post('user_id');
            $this->form_validation->set_rules('cnic', 'CNIC', 'required|exact_length[15]|callback_is_unique_except[' . $user_id . ']');
        } else {
            $this->form_validation->set_rules('cnic', 'CNIC', 'required|exact_length[15]|is_unique[users.cnic]', array(
                'required' => 'The %s field is required.',
                'exact_length' => 'The %s must be exactly 15 characters long.',
                'is_unique' => 'The %s is already registered. Check CNIC first.'
            ));
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('biometric_id', 'Biometric id', 'required|numeric');
        //$this->form_validation->set_rules('nomination', 'Nomination', 'required');
        $this->form_validation->set_rules('user_mobile_number', 'User Mobile Number', 'required|numeric');

        if ($this->form_validation->run() == false) {
            // Validation failed
            $data['error'] = validation_errors();
        } else {
            $user_id = 0;
            if ($this->input->post('user_id')) {
                $input = array(
                    'cnic' => $this->input->post('cnic'),
                    'name' => $this->input->post('name'),
                    'gender' => $this->input->post('gender'),
                    'user_title' => $this->input->post('name'),
                    'father_name' => $this->input->post('father_name'),
                    'qualification' => $this->input->post('qualification'),
                    'department' => $this->input->post('department'),
                    'designation' => $this->input->post('designation'),
                    'district' => $this->input->post('district'),
                    'address' => $this->input->post('address'),
                    'user_mobile_number' => $this->input->post('user_mobile_number'),
                    'user_name' => $this->input->post('cnic'),
                    'biometric_id' => $this->input->post('biometric_id'),
                    'user_password' => '123456'
                );
                if ($this->input->post('nomination_type') == 'resource_person') {
                    $input['role_id'] = 3;
                }
                if ($this->input->post('nomination_type') == 'trainee') {
                    $input['role_id'] = 4;
                }
                // Assuming you have a table named 'users', adjust it if needed
                $where['user_id'] = $user_id = (int) $this->input->post('user_id');
                $this->db->where($where);
                $this->db->update('users', $input);
                $data['update'] = 1;
            } else {


                $input = array(
                    //'user_id' => $this->input->post('user_id'),
                    'cnic' => $this->input->post('cnic'),
                    'name' => $this->input->post('name'),
                    'gender' => $this->input->post('gender'),
                    'user_title' => $this->input->post('name'),
                    'father_name' => $this->input->post('father_name'),
                    'qualification' => $this->input->post('qualification'),
                    'department' => $this->input->post('department'),
                    'designation' => $this->input->post('designation'),
                    'district' => $this->input->post('district'),
                    'address' => $this->input->post('address'),
                    'user_mobile_number' => $this->input->post('user_mobile_number'),
                    'user_name' => $this->input->post('cnic'),
                    'user_password' => '123456'
                );

                if ($this->input->post('nomination_type') == 'resource_person') {
                    $input['role_id'] = 3;
                }
                if ($this->input->post('nomination_type') == 'trainee') {
                    $input['role_id'] = 4;
                }
                // Assuming you have a table named 'users', adjust it if needed
                $this->db->insert('users', $input);
                $data['user_id'] = $user_id = $this->db->insert_id();
            }
        }
        echo json_encode($data);
    }

    public function edit_facilitator_profile()
    {
        $this->data['user_id'] = $user_id =  (int) $this->input->post('user_id');
        $this->data['title'] = 'Update Profile';
        $this->load->view(ADMIN_DIR . "facilitators/edit_facilitator_profile", $this->data);
    }

    public function profile_update()
    {

        $this->load->library('form_validation');
        $user_id = (int) $this->input->post('user_id');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required|exact_length[15]|callback_is_unique_except[' . $user_id . ']');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('user_mobile_number', 'User Mobile Number', 'required|numeric');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
       // $this->form_validation->set_rules('user_name', 'Account User Name', 'required');
        $this->form_validation->set_rules('biometric_id', 'Biometric Id', 'required');
        $this->form_validation->set_rules('user_password', 'Account Password', 'required');


        if ($this->form_validation->run() == false) {
            // Validation failed
            $data['error'] = validation_errors();
        } else {

            $input = array(
                'cnic' => $this->input->post('cnic'),
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'user_title' => $this->input->post('name'),
                'father_name' => $this->input->post('father_name'),
                'qualification' => $this->input->post('qualification'),
                'department' => $this->input->post('department'),
                'designation' => $this->input->post('designation'),
                'district' => $this->input->post('district'),
                'address' => $this->input->post('address'),
                'user_mobile_number' => $this->input->post('user_mobile_number'),
                'biometric_id' => $this->input->post('biometric_id'),
                'user_password' => $this->input->post('user_password'),
            );
            $where['user_id'] = $user_id;
            $this->db->where($where);
            $this->db->update('users', $input);
            $data['update'] = 1;
        }

        echo json_encode($data);
    }
}

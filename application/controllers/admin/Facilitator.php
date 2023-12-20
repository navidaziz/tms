<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Facilitator extends Admin_Controller
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
        $this->data["title"] = 'Facilitator Dashboard';
        $this->data["view"] = ADMIN_DIR . "facilitator/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //---------------------------------------------------------------

    public function training_batch_session($training_batch_session_id)
    {

        $this->data['training_batch_session_id'] = (int) $training_batch_session_id;
        $this->data["title"] = 'Training Batch Session Detail';
        $this->data["view"] = ADMIN_DIR . "facilitator/training_batch_session";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    // Custom callback function to check the file type
    public function file_check($str)
    {

        // Check if a file has been uploaded
        if (empty($_FILES['document']['name'])) {
            $this->form_validation->set_message('file_check', 'File or Document is required.');
            return FALSE;
        }

        $allowed_types = array('gif', 'jpg', 'png', 'pdf', 'doc', 'docx', 'ppt');

        $file_ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);

        if (!in_array($file_ext, $allowed_types)) {
            $this->form_validation->set_message('file_check', 'The file type is not allowed');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function upload_session_file()
    {
        $user_id = (int) $this->session->userdata('userId');
        $training_batch_session_id = (int) $this->input->post('training_batch_session_id');
        if ($this->input->post('study_meterial') == 'file') {
            $validation_config = array(
                array(
                    "field"  =>  "document_detail",
                    "label"  =>  "Document Detail",
                    "rules"  =>  "required"
                ),
                array(
                    "field"  =>  "document",
                    "label"  =>  "Document",
                    "rules"  =>  "callback_file_check"
                )
            );
        } else {

            $validation_config = array(
                array(
                    "field"  =>  "url_link_detail",
                    "label"  =>  "Video Link Detail",
                    "rules"  =>  "required"
                ),
                array(
                    "field"  =>  "url_link",
                    "label"  =>  "Youtube Video Link (URL)",
                    "rules"  =>  "required"
                )
            );
        }


        //set and run the validation
        $this->form_validation->set_rules($validation_config);
        if ($this->form_validation->run() === TRUE) {
            if ($this->input->post('study_meterial') == 'file') {
                $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/courses_attachments/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);  //create directory if not exist
                }
                $config = array(
                    "upload_path" => $upload_dir,
                    "allowed_types" => "jpg|jpeg|bmp|png|gif|pdf|doc|docx|ppt",
                    "max_size" => 10000,
                    "max_width" => 0,
                    "max_height" => 0,
                    "remove_spaces" => true,
                    "encrypt_name" => true
                );


                $this->load->library("upload", $config);

                if (!$this->upload->do_upload('document')) {
                    $this->session->set_flashdata("msg_error", $this->upload->display_errors());
                    redirect(ADMIN_DIR . "facilitator/training_batch_session/" . $training_batch_session_id);
                    exit();
                } else {

                    $file_data = $this->upload->data();
                }




                $query = "SELECT * FROM training_batch_sessions 
                      WHERE training_batch_session_id = $training_batch_session_id";
                $training_batch_session = $this->db->query($query)->row();
                $inputs = array();
                $inputs["course_category"]  =  $training_batch_session->course_category;
                $inputs["course_type"]  =  $training_batch_session->course_type;
                $inputs["course"]  =  $training_batch_session->course_title;
                $inputs["file_detail"]  =  $this->input->post('document_detail');
                $inputs["folder"]  =  'courses_attachments';
                $inputs["file_name"]  =  $file_data['file_name'];
                $inputs["file_ext"]  = pathinfo($file_data['file_name'], PATHINFO_EXTENSION);
                $inputs["created_by"]  = $user_id;

                $this->db->insert('attachments', $inputs);
                $attachment_id  = $this->db->insert_id();

                $inputs = array();
                $inputs['attachment_id'] = $attachment_id;
                $inputs['training_batch_session_id'] = $training_batch_session_id;
                $this->db->insert('training_batch_session_attachments', $inputs);
                $this->session->set_flashdata("msg_success", 'File upload successfully.');
            } else {
                $inputs = array();
                $inputs['attachment_id'] = NULL;
                $inputs['url_link_detail'] = $this->input->post('url_link_detail');
                $inputs['url_link'] = $this->input->post('url_link');
                $inputs['attachment_id'] = NULL;
                $inputs['training_batch_session_id'] = $training_batch_session_id;
                $this->db->insert('training_batch_session_attachments', $inputs);
                $this->session->set_flashdata("msg_success", 'Video link add successfully');
            }


            redirect(ADMIN_DIR . "facilitator/training_batch_session/" . $training_batch_session_id);
        }

        $this->data['training_batch_session_id'] = (int) $this->input->post('training_batch_session_id');
        $this->data["title"] = 'Training Batch Session Detail';
        $this->data["view"] = ADMIN_DIR . "facilitator/training_batch_session";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function remove_session_attachment($training_batch_session_id, $training_batch_session_attachment_id)
    {
        $training_batch_session_id = (int) $training_batch_session_id;
        $training_batch_session_attachment_id = (int) $training_batch_session_attachment_id;
        $this->db->where('training_batch_session_attachment_id', $training_batch_session_attachment_id);
        $this->db->delete('training_batch_session_attachments');
        $this->session->set_flashdata("msg_success", 'Attachment Remove Successfully.');
        redirect(ADMIN_DIR . "facilitator/training_batch_session/" . $training_batch_session_id,);
    }



    // public function remove_session_attachment($training_batch_session_attachment_id)
    // {
    //     $training_batch_session_attachment_id = (int) $training_batch_session_attachment_id;
    //     $query = "SELECT a.*,tbsa.training_batch_session_attachment_id FROM training_batch_session_attachments as tbsa
    //                         INNER JOIN attachments as a ON(a.attachment_id = tbsa.attachment_id)
    //                         WHERE tbsa.training_batch_session_attachment_id = $training_batch_session_attachment_id";
    //     $session_attachment = $this->db->query($query)->row();

    //     $file_path = FCPATH . 'uploads/' . $session_attachment->folder . '/' . $session_attachment->file_name;

    //     if (file_exists($file_path)) {
    //         unlink($file_path);
    //         echo "File deleted successfully.";
    //     } else {
    //         echo "File not found or already deleted.";
    //     }
    // }

    /**
     * get a list of all items that are not trashed
     */
    public function view()
    {

        $where = "`trainings`.`status` IN (0, 1) ";
        $data = $this->training_model->get_training_list($where);
        $this->data["trainings"] = $data->trainings;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trainings');
        $this->data["view"] = ADMIN_DIR . "trainings/trainings";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_training($training_id)
    {

        $training_id = (int) $training_id;
        $trainings = $this->training_model->get_training($training_id);
        $this->data["training"] = $trainings[0];
        $this->data["title"] = $this->lang->line('Training Details');
        $this->data["view"] = ADMIN_DIR . "trainings/view_training";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`trainings`.`status` IN (2) ";
        $data = $this->training_model->get_training_list($where);
        $this->data["trainings"] = $data->trainings;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Trainings');
        $this->data["view"] = ADMIN_DIR . "trainings/trashed_trainings";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($training_id, $page_id = NULL)
    {

        $training_id = (int) $training_id;


        $this->training_model->changeStatus($training_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR . "trainings/view/" . $page_id);
    }

    /**
     * function to restor training from trash
     * @param $training_id integer
     */
    public function restore($training_id, $page_id = NULL)
    {

        $training_id = (int) $training_id;


        $this->training_model->changeStatus($training_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "trainings/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft training from trash
     * @param $training_id integer
     */
    public function draft($training_id, $page_id = NULL)
    {

        $training_id = (int) $training_id;


        $this->training_model->changeStatus($training_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR . "trainings/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish training from trash
     * @param $training_id integer
     */
    public function publish($training_id, $page_id = NULL)
    {

        $training_id = (int) $training_id;


        $this->training_model->changeStatus($training_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR . "trainings/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Training
     * @param $training_id integer
     */
    public function delete($training_id, $page_id = NULL)
    {

        $training_id = (int) $training_id;
        //$this->training_model->changeStatus($training_id, "3");

        $this->training_model->delete(array('training_id' => $training_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "trainings/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Training
     */
    public function add()
    {

        $this->data["title"] = $this->lang->line('Add New Training');
        $this->data["view"] = ADMIN_DIR . "trainings/add_training";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->training_model->validate_form_data() === TRUE) {

            $training_id = $this->training_model->save_data();
            if ($training_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "trainings/edit/$training_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "trainings/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Training
     */
    public function edit($training_id)
    {
        $training_id = (int) $training_id;
        $this->data["training"] = $this->training_model->get($training_id);

        $this->data["title"] = $this->lang->line('Edit Training');
        $this->data["view"] = ADMIN_DIR . "trainings/edit_training";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($training_id)
    {

        $training_id = (int) $training_id;

        if ($this->training_model->validate_form_data() === TRUE) {

            $training_id = $this->training_model->update_data($training_id);
            if ($training_id) {

                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "trainings/edit/$training_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "trainings/edit/$training_id");
            }
        } else {
            $this->edit($training_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["trainings"] = $this->training_model->getBy($where, false, "training_id");
        $j_array[] = array("id" => "", "value" => "training");
        foreach ($data["trainings"] as $training) {
            $j_array[] = array("id" => $training->training_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------
    public function add_nomination_form()
    {
        $this->data['training_id'] = (int) $this->input->post('training_id');
        $this->data['nomination_type'] = $nomination__type =  $this->input->post('nomination_type');
        if ($nomination__type == 'resource_person') {
            $title = 'Add Facilitator';
        }
        if ($nomination__type == 'trainee') {
            $title = 'Add Trainee';
        }
        $this->data['title'] = $title;
        $this->load->view(ADMIN_DIR . "trainings/add_nomination_form", $this->data);
    }

    // public function check_cnic()
    // {

    //     $cnic = $this->input->post("cnic");
    //     $where['cnic'] = $cnic;
    //     $this->db->where($where);
    //     $this->db->from('users');
    //     $query = $this->db->get();
    //     $data = array();
    //     if ($query->num_rows() > 0) {
    //         $result = $query->row();
    //         $data['user_id'] = $result->user_id;
    //         $data['cnic'] = $result->cnic;
    //         $data['name'] = $result->name;
    //         $data['father_name'] = $result->father_name;
    //         $data['qualification'] = $result->qualification;
    //         $data['department'] = $result->department;
    //         $data['designation'] = $result->designation;
    //         $data['district'] = $result->district;
    //         $data['address'] = $result->address;
    //         // Process the result as needed
    //     } else {
    //         $data['user_id'] = "";
    //         $data['cnic'] = "";
    //         $data['name'] = "";
    //         $data['father_name'] = "";
    //         $data['qualification'] = "";
    //         $data['department'] = "";
    //         $data['designation'] = "";
    //         $data['district'] = "";
    //         $data['address'] = "";
    //     }
    //     echo json_encode($data);
    // }

    public function check_cnic()
    {
        // Validate the CNIC input (example validation rules, adjust as needed)
        $this->form_validation->set_rules('cnic', 'CNIC', 'required|exact_length[15]');

        if ($this->form_validation->run() == FALSE) {
            // Return validation errors if any
            $data['error'] = validation_errors();
        } else {
            $cnic = $this->input->post("cnic");

            // Use query binding to prevent SQL injection
            $query = $this->db->where('cnic', $cnic)->get('users');

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $data = array(
                    'user_id' => $result->user_id,
                    'cnic' => $result->cnic,
                    'name' => $result->name,
                    'father_name' => $result->father_name,
                    'qualification' => $result->qualification,
                    'department' => $result->department,
                    'designation' => $result->designation,
                    'district' => $result->district,
                    'address' => $result->address,
                    'user_mobile_number' => $result->user_mobile_number,
                    'gender' => $result->gender,

                );
            } else {
                // Default values
                $data = array(
                    'user_id' => "",
                    'cnic' => "",
                    'name' => "",
                    'father_name' => "",
                    'qualification' => "",
                    'department' => "",
                    'designation' => "",
                    'district' => "",
                    'address' => "",
                    'user_mobile_number' => ''
                );
            }
        }

        echo json_encode($data);
    }
    // Custom validation rule for is_unique_except
    public function is_unique_except($cnic, $user_id)
    {

        $query = $this->db->where('cnic', $cnic)
            ->where('user_id !=', $user_id)
            ->get('users');

        return $query->num_rows() === 0;
    }

    public function add_nomination()
    {


        $this->load->library('form_validation');

        // Validation rules
        //$this->form_validation->set_rules('user_id', 'User ID', 'required|integer');
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
        $this->form_validation->set_rules('nomination', 'Nomination', 'required');
        $this->form_validation->set_rules('user_mobile_number', 'User Mobile Number', 'required|numeric');

        if ($this->form_validation->run() == false) {
            // Validation failed
            $data['error'] = validation_errors();
        } else {
            $user_id = 0;
            $training_id = $this->input->post('training_id');
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
            if ($this->input->post('nomination') == 'Yes') {
                $nomination_type = $this->input->post('nomination_type');
                $this->nomination($user_id, $training_id, $nomination_type);
            } else {
                $this->db->where('user_id', $user_id);
                $this->db->where('training_id', $training_id);
                $this->db->delete('training_nominations');
            }
        }
        echo json_encode($data);
    }

    public function nomination($user_id, $training_id, $nomination_type)
    {
        // Check if the user_id already exists for the given training_id
        if ($this->is_user_already_nominated($user_id, $training_id)) {
            return array('error' => 'User has already been nominated for this training.');
        }

        // User is not nominated, proceed with inserting data
        $data = array(
            'user_id' => $user_id,
            'training_id' => $training_id,
            // Add other fields as needed
        );
        if ($nomination_type == 'resource_person') {
            $data['nomination_type'] = 'Facilitator';
        }
        if ($nomination_type == 'trainee') {
            $data['nomination_type'] = 'Trainee';
        }

        // Assuming you have a table named 'training_nomination', adjust it if needed
        $this->db->insert('training_nominations', $data);

        // Optionally, you can return the success status
        return array('user_id' => $user_id, 'training_id' => $training_id);
    }

    // Check if the user is already nominated for the given training
    private function is_user_already_nominated($user_id, $training_id)
    {
        $query = $this->db->where('user_id', $user_id)
            ->where('training_id', $training_id)
            ->get('training_nominations');

        return $query->num_rows() > 0;
    }

    public function get_batch_add_form()
    {
        $this->data['training_id'] = $training_id = (int) $this->input->post('training_id');
        $query = "SELECT * FROM trainings WHERE training_id = $training_id";
        $this->data['training'] = $this->db->query($query)->row();
        $this->data['title'] = 'Create New Batch For Training';
        $this->load->view(ADMIN_DIR . "trainings/add_batch_form", $this->data);
    }

    public function add_training_batch()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('batch_title', 'Training Batch Title', 'required');
        $this->form_validation->set_rules('batch_start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('batch_end_date', 'End Date', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('batch_detail', 'Detail', 'required');

        if ($this->form_validation->run() == false) {
            $data['error'] = validation_errors();
        } else {



            $input = array(
                //'user_id' => $this->input->post('user_id'),
                'batch_title' => $this->input->post('batch_title'),
                'batch_start_date' => $this->input->post('batch_start_date'),
                'batch_end_date' => $this->input->post('batch_end_date'),
                'location' => $this->input->post('location'),
                'batch_detail' => $this->input->post('batch_detail'),
                'training_id' => $this->input->post('training_id')
            );

            $this->db->insert('training_batches', $input);
            $data['success'] = 'New Batch Created Successfully';
            //$data['user_id'] = $batch_id = $this->db->insert_id();
        }

        echo json_encode($data);
    }
    public function get_batch_edit_form()
    {
        $this->data['training_id'] = $training_id = (int) $this->input->post('training_id');
        $query = "SELECT * FROM trainings WHERE training_id = $training_id";
        $this->data['training'] = $this->db->query($query)->row();
        $batch_id = (int) $this->input->post('batch_id');
        $query = "SELECT * FROM training_batches 
        WHERE batch_id = $batch_id 
        AND training_id = $training_id";
        $this->data['batch'] = $this->db->query($query)->row();

        $this->data['title'] = 'Update Batch Information';
        $this->load->view(ADMIN_DIR . "trainings/edit_batch_form", $this->data);
    }
    public function update_training_batch()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('batch_title', 'Training Batch Title', 'required');
        $this->form_validation->set_rules('batch_start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('batch_end_date', 'End Date', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('batch_detail', 'Detail', 'required');

        if ($this->form_validation->run() == false) {
            $data['error'] = validation_errors();
        } else {
            $input = array(
                //'user_id' => $this->input->post('user_id'),
                'batch_title' => $this->input->post('batch_title'),
                'batch_start_date' => $this->input->post('batch_start_date'),
                'batch_end_date' => $this->input->post('batch_end_date'),
                'location' => $this->input->post('location'),
                'batch_detail' => $this->input->post('batch_detail'),
                'training_id' => $this->input->post('training_id')
            );

            $where['batch_id'] = (int) $this->input->post('batch_id');
            $this->db->where($where);
            $this->db->update('training_batches', $input);
            $data['success'] = 'Update Successfully';
        }

        echo json_encode($data);
    }

    public function training_batch($training_id, $batch_id)
    {
        $training_id = (int) $training_id;
        $this->data["training"] = $training = $this->training_model->get($training_id);

        $batch_id = (int) $batch_id;
        $query = "SELECT * FROM training_batches 
        WHERE training_id = $training_id 
        AND batch_id = $batch_id";
        $this->data['batch'] = $batch = $this->db->query($query)->row();


        $this->data["title"] = $batch->batch_title;
        $this->data["sub_title"] = $training->title;
        $this->data["view"] = ADMIN_DIR . "trainings/training_batch_detail";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function get_session_add_form()
    {
        $this->data['training_id'] =  (int) $this->input->post('training_id');
        $this->data['batch_id'] = (int) $this->input->post('batch_id');
        $this->data['batch_day'] =  $this->input->post('batch_day');
        $this->data['title'] = 'Add Session Detail';
        $this->load->view(ADMIN_DIR . "trainings/session_add_form", $this->data);
    }

    public function get_session_edit_form()
    {
        $this->data['training_id'] = $training_id =   (int) $this->input->post('training_id');
        $this->data['batch_id'] = $batch_id =  (int) $this->input->post('batch_id');
        $this->data['training_batch_session_id'] = $training_batch_session_id =  (int) $this->input->post('training_batch_session_id');

        $where = array();
        $where['training_id'] = $training_id;
        $where['batch_id'] = $batch_id;
        $where['training_batch_session_id'] = $training_batch_session_id;
        // Build the query
        $this->db->select('*');
        $this->db->from('training_batch_sessions');
        $this->db->where($where);
        $this->data['training_batch_session'] = $this->db->get()->row();

        $this->data['title'] = 'Edit Session Detail';
        $this->load->view(ADMIN_DIR . "trainings/session_edit_form", $this->data);
    }

    public function get_nomination_list()
    {
        $this->data['training_id'] = $training_id =  (int) $this->input->post('training_id');
        $this->data['batch_id'] = $batch_id = (int) $this->input->post('batch_id');
        $this->data['nomination_type'] = $nomination_type =  $this->input->post('nomination_type');
        $this->data['title'] = "Add $nomination_type's ";
        $this->load->view(ADMIN_DIR . "trainings/nomination_list", $this->data);
    }


    public function add_batch_session()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('session_date', 'Session Date', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');
        $this->form_validation->set_rules('activity_type', 'Location', 'required');
        if ($this->input->post('activity_type') == 'Activity') {
            $this->form_validation->set_rules('course_category', 'Course Category', 'required');
            $this->form_validation->set_rules('course_type', 'Course Type', 'required');
            $this->form_validation->set_rules('course_title', 'Course Title', 'required');
            $this->form_validation->set_rules('facilitator_id', 'Facilitator', 'required');
        }
        if ($this->input->post('activity_type') == 'Break') {
            $this->form_validation->set_rules('break_detail', 'Break Detail', 'required');
        }
        if ($this->form_validation->run() == false) {
            $data['error'] = validation_errors();
        } else {
            $input = array(
                //'user_id' => $this->input->post('user_id'),
                'training_id' => $this->input->post('training_id'),
                'batch_id' => $this->input->post('batch_id'),
                'session_date' => $this->input->post('session_date'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
                'activity_type' => $this->input->post('activity_type')
            );
            if ($this->input->post('activity_type') == 'Activity') {

                $input['course_category'] = $this->input->post('course_category');
                $input['course_type'] = $this->input->post('course_type');
                $input['course_title'] = $this->input->post('course_title');
                $input['facilitator_id'] = $this->input->post('facilitator_id');
            }
            if ($this->input->post('activity_type') == 'Break') {
                $input['break_detail'] = $this->input->post('break_detail');
            }

            $this->db->insert('training_batch_sessions', $input);
            $data['success'] = 'Update Successfully';
        }

        echo json_encode($data);
    }
    public function update_batch_session()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');
        $this->form_validation->set_rules('activity_type', 'Location', 'required');
        if ($this->input->post('activity_type') == 'Activity') {
            $this->form_validation->set_rules('course_category', 'Course Category', 'required');
            $this->form_validation->set_rules('course_type', 'Course Type', 'required');
            $this->form_validation->set_rules('course_title', 'Course Title', 'required');
            $this->form_validation->set_rules('facilitator_id', 'Facilitator', 'required');
        }
        if ($this->input->post('activity_type') == 'Break') {
            $this->form_validation->set_rules('break_detail', 'Break Detail', 'required');
        }
        if ($this->form_validation->run() == false) {
            $data['error'] = validation_errors();
        } else {
            $input = array(
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
                'activity_type' => $this->input->post('activity_type')
            );
            if ($this->input->post('activity_type') == 'Activity') {

                $input['course_category'] = $this->input->post('course_category');
                $input['course_type'] = $this->input->post('course_type');
                $input['course_title'] = $this->input->post('course_title');
                $input['facilitator_id'] = $this->input->post('facilitator_id');
            } else {
                $input['course_category'] = NULL;
                $input['course_type'] = NULL;
                $input['course_title'] = NULL;
                $input['facilitator_id'] = NULL;
            }
            if ($this->input->post('activity_type') == 'Break') {
                $input['break_detail'] = $this->input->post('break_detail');
            } else {
                $input['break_detail'] = NULL;
            }

            $training_id =  (int) $this->input->post('training_id');
            $batch_id = (int) $this->input->post('batch_id');
            $training_batch_session_id = (int) $this->input->post('training_batch_session_id');
            $where['training_id'] = $training_id;
            $where['batch_id'] = $batch_id;
            $where['training_batch_session_id'] = $training_batch_session_id;
            $this->db->where($where);
            $this->db->update('training_batch_sessions', $input);
            $data['success'] = 'Update Successfully';
        }

        echo json_encode($data);
    }

    public function add_nomination_to_batch()
    {
        $training_id =  (int) $this->input->post('training_id');
        $batch_id = (int) $this->input->post('batch_id');
        $nominations = $this->input->post('nominations');
        $where['training_id'] = $training_id;
        $input['batch_id'] = $batch_id;
        foreach ($nominations as $nomination_id => $nomination) {
            $where['id'] = $nomination_id;
            $this->db->where($where);
            $this->db->update('training_nominations', $input);
        }
        $this->session->set_flashdata("msg_success", 'Record add successfully.');
        redirect(ADMIN_DIR . "trainings/training_batch/" . $training_id . "/" . $batch_id);
    }
    public function remove_nonimation_from_batch($training_id, $batch_id, $nonimation_id)
    {
        $training_id = (int)  $training_id;
        $batch_id = (int) $batch_id;
        $nonimation_id = (int) $nonimation_id;
        $where['training_id'] = $training_id;
        $where['batch_id'] = $batch_id;
        $where['id'] = $nonimation_id;
        $input['batch_id'] = 0;
        $this->db->where($where);
        $this->db->update('training_nominations', $input);
        $this->session->set_flashdata("msg_success", 'Record add successfully.');
        redirect(ADMIN_DIR . "trainings/training_batch/" . $training_id . "/" . $batch_id);
    }

    public function remove_batch($training_id, $batch_id)
    {
        $training_id = (int)  $training_id;
        $batch_id = (int) $batch_id;
        $where['training_id'] = $training_id;
        $where['batch_id'] = $batch_id;
        $input['status'] = 2;
        $this->db->where($where);
        if ($this->db->update('training_batches', $input)) {
            $where = array();
            $input = array();
            $where['training_id'] = $training_id;
            $where['batch_id'] = $batch_id;
            $input['batch_id'] = 0;
            $this->db->where($where);
            $this->db->update('training_nominations', $input);
        }

        $query = "UPDATE `training_batch_sessions` SET `facilitator_id`= NULL 
                  WHERE `training_id`= " . $this->db->escape($training_id) . " 
                  AND  `batch_id`= $batch_id";
        $this->db->query($query);

        $this->session->set_flashdata("msg_success", 'Move to trashed successfully.');
        redirect(ADMIN_DIR . "trainings/view_training/" . $training_id . "?tab=training");
    }

    public function batch_restore($training_id, $batch_id)
    {
        $training_id = (int)  $training_id;
        $batch_id = (int) $batch_id;
        $where['training_id'] = $training_id;
        $where['batch_id'] = $batch_id;
        $input['status'] = 1;
        $this->db->where($where);
        $this->db->update('training_batches', $input);
        $this->session->set_flashdata("msg_success", 'Restore successfully.');
        redirect(ADMIN_DIR . "trainings/view_training/" . $training_id . "?tab=training");
    }

    public function remove_nomination($training_id, $id)
    {
        $id = (int) $id;
        $training_id = (int) $training_id;

        $query = "SELECT user_id FROM training_nominations 
        WHERE id= " . $this->db->escape($id) . "
        AND training_id = " . $this->db->escape($training_id);
        $user_id = $this->db->query($query)->row()->user_id;
        $query = "UPDATE `training_batch_sessions` SET `facilitator_id`= NULL 
                  WHERE `training_id`= " . $this->db->escape($training_id) . " 
                  AND  `facilitator_id`= $user_id";
        $this->db->query($query);


        $where['training_id'] = (int) $training_id;
        $where['id'] = $id;
        $this->db->where($where);
        $this->db->delete('training_nominations');
        $this->session->set_flashdata("msg_success", 'Nomination Removed.');
        redirect(ADMIN_DIR . "trainings/view_training/" . $training_id . "?tab=nomination");
    }

    public function edit_nomination_profile()
    {
        $this->data['training_id'] = (int) $this->input->post('training_id');
        $this->data['user_id'] = $user_id =  (int) $this->input->post('user_id');
        $this->data['title'] = 'Update Profile';
        $this->load->view(ADMIN_DIR . "trainings/edit_nomination_profile", $this->data);
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
                'user_name' => $this->input->post('cnic'),
            );
            $where['user_id'] = $user_id;
            $this->db->where($where);
            $this->db->update('users', $input);
            $data['dfsdf'] = $input;
            $data['update'] = 1;
        }

        echo json_encode($data);
    }

    public function remove_session($training_id, $batch_id, $training_batch_session_id)
    {
        $where['training_id'] = (int) $training_id;
        $where['batch_id'] = (int) $batch_id;
        $where['training_batch_session_id'] = (int) $training_batch_session_id;
        $this->db->where($where);
        $this->db->delete('training_batch_sessions');
        $this->session->set_flashdata("msg_success", 'Session Removed.');
        redirect(ADMIN_DIR . "trainings/training_batch/" . $training_id . "/" . $batch_id);
    }
}

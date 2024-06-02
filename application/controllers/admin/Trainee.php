<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trainee extends Admin_Controller
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
        $this->data["title"] = 'Trainee Dashboard';
        $this->data["view"] = ADMIN_DIR . "trainee/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //---------------------------------------------------------------

    public function training_detail($training_id, $batch_id)
    {

        $this->data['training_id'] = (int) $training_id;
        $this->data['batch_id'] = (int) $batch_id;
        $this->data["title"] = 'Training Sessions Detail';
        $this->data["view"] = ADMIN_DIR . "trainee/training_detail";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function test_dashboard($training_id, $batch_id)
    {
        $this->data['training_id'] = (int) $training_id;
        $this->data['batch_id'] = (int) $batch_id;
        $this->data["title"] = 'Training Batch Session Detail';
        $this->data["view"] = ADMIN_DIR . "trainee/test_dashboard";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    private function start_pretest($training_id, $batch_id)
    {
        $this->data['training_id'] = $training_id =  (int) $training_id;
        $this->data['batch_id'] = (int) $batch_id;
        $query = "SELECT * FROM mcqs 
        INNER JOIN training_mcqs ON(training_mcqs.mcq_id = mcqs.mcq_id)
        WHERE training_mcqs.training_id = $training_id";
        $training_mcqs = $this->db->query($query)->result();
        $trainee_id = $this->session->userdata('userId');
        foreach ($training_mcqs as $training_mcq) {

            $query = "SELECT COUNT(*) as total FROM training_tests
                    WHERE training_id = " . $training_id . "
                    AND batch_id = " . $batch_id . "
                    AND mcq_id = " . $training_mcq->mcq_id . "
                    AND trainee_id = " . $trainee_id . "";
            $duplicate_entry = $this->db->query($query)->row();
            if ($duplicate_entry->total == 0) {
                $inputs = array(
                    'question' => $training_mcq->question,
                    'course' => $training_mcq->course,
                    'a' => $training_mcq->a,
                    'b' => $training_mcq->b,
                    'c' => $training_mcq->c,
                    'd' => $training_mcq->d,
                    'answer' => $training_mcq->answer
                );
                $inputs['training_id'] = $training_id;
                $inputs['batch_id'] = $batch_id;
                $inputs['mcq_id'] = $training_mcq->mcq_id;
                $inputs['trainee_id'] = $trainee_id;
                $this->db->insert('training_tests', $inputs);
            }
            // redirect(ADMIN_DIR . "trainee/pre_test/" . $training_id . "/" . $batch_id);

        }
        return true;
    }

    public function pre_test($training_id, $batch_id)
    {
        $this->data['training_id'] = $training_id = (int) $training_id;
        $this->data['batch_id'] = $batch_id = (int) $batch_id;
        $trainee_id = $this->session->userdata('userId');

        $query = "SELECT COUNT(*) as total FROM training_tests
        WHERE training_id = " . $training_id . "
        AND batch_id = " . $batch_id . "
        AND trainee_id = " . $trainee_id . "";
        $duplicate_entry = $this->db->query($query)->row();
        if ($duplicate_entry->total == 0) {
            // redirect(ADMIN_DIR . "trainee/start_pretest/" . $training_id . "/" . $batch_id);
            // exit();
            $this->start_pretest($training_id, $batch_id);
        }

        $this->data['test_type'] = "pre_test";


        $this->data["title"] = 'Session Pre Test';

        $this->data["view"] = ADMIN_DIR . "trainee/test";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function post_test($training_id, $batch_id)
    {
        $this->data['training_id'] = $training_id = (int) $training_id;
        $this->data['batch_id'] = $batch_id = (int) $batch_id;
        $trainee_id = $this->session->userdata('userId');

        $query = "SELECT COUNT(*) as total FROM training_tests
        WHERE training_id = " . $training_id . "
        AND batch_id = " . $batch_id . "
        AND trainee_id = " . $trainee_id . "";
        $duplicate_entry = $this->db->query($query)->row();
        if ($duplicate_entry->total == 0) {
            redirect(ADMIN_DIR . "trainee/start_pretest/" . $training_id . "/" . $batch_id);
            exit();
        }

        $this->data['test_type'] = "post_test";


        $this->data["title"] = 'Session Post Test';

        $this->data["view"] = ADMIN_DIR . "trainee/test";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function question_answer()
    {

        $training_id = (int) $this->input->post('training_id');
        $batch_id = (int) $this->input->post('batch_id');
        $mcq_id = (int) $this->input->post('mcq_id');
        $trainee_id = $this->session->userdata('userId');

        $currentDateTime = new DateTime();
        //check the selected answer is correct or not 
        $query = "SELECT answer FROM training_tests
                    WHERE training_id = " . $training_id . "
                    AND batch_id = " . $batch_id . "
                    AND mcq_id = " . $mcq_id . "
                    AND trainee_id = " . $trainee_id . "";
        $mcq_answer = $this->db->query($query)->row()->answer;
        $answer = $this->input->post('answer');
        $input = array();
        if ($this->input->post('test_type') == 'pre_test') {
            $input['pre_test_date'] = $currentDateTime->format('Y-m-d H:i:s');
            $input['pre_test_answer'] = $answer;
            if ($mcq_answer === $answer) {
                $input['pre_test_result'] = 1;
            } else {
                $input['pre_test_result'] = 0;
            }
        }
        if ($this->input->post('test_type') == 'post_test') {
            $input['post_test_date'] = $currentDateTime->format('Y-m-d H:i:s');
            $input['post_test_answer'] = $answer;
            if ($mcq_answer === $answer) {
                $input['post_test_result'] = 1;
            } else {
                $input['post_test_result'] = 0;
            }
        }



        $this->db->where('training_id', $training_id);
        $this->db->where('batch_id', $batch_id);
        $this->db->where('mcq_id', $mcq_id);
        $this->db->where('trainee_id', $trainee_id);
        $this->db->update('training_tests', $input);
        if ($this->input->post('test_type') == 'pre_test') {
            redirect(ADMIN_DIR . "trainee/pre_test/" . $training_id . "/" . $batch_id);
        }
        if ($this->input->post('test_type') == 'post_test') {
            redirect(ADMIN_DIR . "trainee/post_test/" . $training_id . "/" . $batch_id);
        }
    }

    public function feedback($training_id, $batch_id)
    {
        $this->data['training_id'] = $training_id = (int) $training_id;
        $this->data['batch_id'] = $batch_id = (int) $batch_id;
        $trainee_id = $this->session->userdata('userId');

        $query = "SELECT COUNT(*) as total FROM training_tests
        WHERE training_id = " . $training_id . "
        AND batch_id = " . $batch_id . "
        AND trainee_id = " . $trainee_id . "";
        $duplicate_entry = $this->db->query($query)->row();
        if ($duplicate_entry->total == 0) {
            redirect(ADMIN_DIR . "trainee/start_pretest/" . $training_id . "/" . $batch_id);
            exit();
        }

        $this->data['test_type'] = "post_test";


        $this->data["title"] = 'Trainee Feed back';

        $this->data["view"] = ADMIN_DIR . "trainee/feedback";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function submit_feedback()
    {
        $facilitators = $this->input->post('facilitators');
        //delete records
        foreach ($facilitators as $facilitator_id => $inputs) {
            $this->db->where('facilitator_id', $facilitator_id);
            $this->db->where('training_id', $inputs['training_id']);
            $this->db->where('batch_id', $inputs['batch_id']);
            $this->db->where('created_by', $this->session->userdata('userId'));
            $this->db->delete('facilitator_evaluations');
        }
        //add new records
        foreach ($facilitators as $facilitator_id => $inputs) {
            $inputs['facilitator_id'] = $facilitator_id;
            $inputs['created_by'] = $this->session->userdata('userId');
            $this->db->insert('facilitator_evaluations', $inputs);
        }
        redirect(ADMIN_DIR . "trainee/training_detail/" . $inputs['training_id'] . "/" . $inputs['batch_id']);
    }
}

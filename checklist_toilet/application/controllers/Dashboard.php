<?php

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_checklist');
        $this->load->model('m_toilet');
        $this->load->model('m_user');
        $this->load->library('pagination');
        $this->load->library('upload');
    }
    public function index()
    {

        if ($this->session->userdata('role') == 'admin') {
            $toilet = $this->m_toilet->total_rows();
            $checklist = $this->m_checklist->total_rows();
            $user = $this->m_user->total_rows();
            $data = array(
                'toilet' => $toilet,
                'checklist' => $checklist,
                'user' => $user
            );
        } else {
            $checklist = $this->m_checklist->total_rows_user();
            $data = array(
                'checklist' => $checklist
            );
        }

  

        $this->load->view('partials/v_sidebar');
        $this->load->view('v_dashboard', $data);
        $this->load->view('partials/v_footer');
    }
}

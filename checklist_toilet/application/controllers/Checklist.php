<?php

class Checklist extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_checklist');
        $this->load->model('m_user');
        $this->load->model('m_toilet');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_checklist->total_rows();
        if ($this->session->userdata('role') == 'admin') {
            $checklist = $this->m_checklist->get_limit_data();
        }else{
            $checklist = $this->m_checklist->get_limit_data_user();
        }
      
        $user = $this->m_user->get_limit_data();
        $toilet = $this->m_toilet->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'checklist_data' => $checklist,
            'users_data' => $user,
            'toilet_data' => $toilet,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_checklist', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
      
        $data = array(
            'tanggal' => date("Y-m-d H:i:s"),
            'toilet_id' => $this->input->post('toilet_id'),
            'kloset' => $this->input->post('kloset'),
            'wastafel' => $this->input->post('wastafel'),
            'lantai' => $this->input->post('lantai'),
            'dinding' => $this->input->post('dinding'),
            'kaca' => $this->input->post('kaca'),
            'bau' => $this->input->post('bau'),
            'sabun' => $this->input->post('sabun'),
        );
        if ($this->session->userdata('role') == 'admin') {
            $data['users_id'] = $this->input->post('users_id');
        }else{
            $data['users_id'] = $this->session->userdata('id');
        }
        $this->m_checklist->insert($data);
        redirect(site_url('checklist'));
    }

    public function update()
    {
        $data = array(
            'toilet_id' => $this->input->post('toilet_id'),
            'kloset' => $this->input->post('kloset'),
            'wastafel' => $this->input->post('wastafel'),
            'lantai' => $this->input->post('lantai'),
            'dinding' => $this->input->post('dinding'),
            'kaca' => $this->input->post('kaca'),
            'bau' => $this->input->post('bau'),
            'sabun' => $this->input->post('sabun'),
        );

        if ($this->session->userdata('role') == 'admin') {
            $data['users_id'] = $this->input->post('users_id');
        }else{
            $data['users_id'] = $this->session->userdata('id');
        }

        $this->m_checklist->update($this->input->post('id'), $data);
        redirect(site_url('checklist'));
    }

    public function delete()
    {
        $this->m_checklist->delete($this->input->post('id'));
        redirect(site_url('checklist'));
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA SEMUA TOILET', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Lokasi Toilet', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Kloset', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Wastafel', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Lantai', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Dinding', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Kaca', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Bau', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Sabun', 1, 0, 'C');
        $pdf->Cell(40, 6, 'User', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT checklist.*, toilet.lokasi as toilet_lokasi, users.nama as user_nama FROM checklist join users on users.id = checklist.users_id join toilet on toilet.id = checklist.toilet_id")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(40, 6, $data->tanggal, 1, 0);
            $pdf->Cell(50, 6, $data->toilet_lokasi, 1, 0);
            $pdf->Cell(20, 6, $data->kloset == 1 ? "Bersih" : ($data->kloset == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->wastafel == 1 ? "Bersih" : ($data->wastafel == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->lantai == 1 ? "Bersih" : ($data->lantai == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->dinding == 1 ? "Bersih" : ($data->dinding == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->kaca == 1 ? "Bersih" : ($data->kaca == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->bau == 1 ? "Ya" : "Tidak", 1, 0);
            $pdf->Cell(20, 6, $data->sabun == 1 ? "Ada" : ($data->sabun == 2 ? "Habis" : "Hilang"), 1, 0);
            $pdf->Cell(40, 6, $data->user_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }


    public function cetak_pdf_belum_diperiksa()
    {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA TOILET BELUM DIPERIKSA', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(100, 6, 'Lokasi', 1, 0, 'C');
        $pdf->Cell(140, 6, 'Keterangan', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Status', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT toilet.* from toilet left join checklist on toilet.id = checklist.toilet_id where checklist.id is null")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(100, 6, $data->lokasi, 1, 0);
            $pdf->Cell(140, 6, $data->keterangan, 1, 0);
            $pdf->Cell(30, 6, 'Belum diperiksa', 1, 1);
            $no++;
        }

        $pdf->Output();
    }

    public function cetak_pdf_rusak()
    {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA TOILET RUSAK', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Lokasi Toilet', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Kloset', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Wastafel', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Lantai', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Dinding', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Kaca', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Bau', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Sabun', 1, 0, 'C');
        $pdf->Cell(40, 6, 'User', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT checklist.*, toilet.lokasi as toilet_lokasi, users.nama as user_nama FROM checklist join users on users.id = checklist.users_id join toilet on toilet.id = checklist.toilet_id where checklist.kloset = 3 or checklist.wastafel = 3 or checklist.lantai = 3 or checklist.dinding = 3 or checklist.kaca = 3")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(40, 6, $data->tanggal, 1, 0);
            $pdf->Cell(50, 6, $data->toilet_lokasi, 1, 0);
            $pdf->Cell(20, 6, $data->kloset == 1 ? "Bersih" : ($data->kloset == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->wastafel == 1 ? "Bersih" : ($data->wastafel == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->lantai == 1 ? "Bersih" : ($data->lantai == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->dinding == 1 ? "Bersih" : ($data->dinding == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->kaca == 1 ? "Bersih" : ($data->kaca == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->bau == 1 ? "Ya" : "Tidak", 1, 0);
            $pdf->Cell(20, 6, $data->sabun == 1 ? "Ada" : ($data->sabun == 2 ? "Habis" : "Hilang"), 1, 0);
            $pdf->Cell(40, 6, $data->user_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }

    public function cetak_pdf_kotor()
    {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA TOILET KOTOR', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Lokasi Toilet', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Kloset', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Wastafel', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Lantai', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Dinding', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Kaca', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Bau', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Sabun', 1, 0, 'C');
        $pdf->Cell(40, 6, 'User', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT checklist.*, toilet.lokasi as toilet_lokasi, users.nama as user_nama FROM checklist join users on users.id = checklist.users_id join toilet on toilet.id = checklist.toilet_id where checklist.kloset = 2 or checklist.wastafel = 2 or checklist.lantai = 2 or checklist.dinding = 2 or checklist.kaca = 2")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(40, 6, $data->tanggal, 1, 0);
            $pdf->Cell(50, 6, $data->toilet_lokasi, 1, 0);
            $pdf->Cell(20, 6, $data->kloset == 1 ? "Bersih" : ($data->kloset == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->wastafel == 1 ? "Bersih" : ($data->wastafel == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->lantai == 1 ? "Bersih" : ($data->lantai == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->dinding == 1 ? "Bersih" : ($data->dinding == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->kaca == 1 ? "Bersih" : ($data->kaca == 2 ? "Kotor" : "Rusak"), 1, 0);
            $pdf->Cell(20, 6, $data->bau == 1 ? "Ya" : "Tidak", 1, 0);
            $pdf->Cell(20, 6, $data->sabun == 1 ? "Ada" : ($data->sabun == 2 ? "Habis" : "Hilang"), 1, 0);
            $pdf->Cell(40, 6, $data->user_nama, 1, 1);
            $no++;
        }

        $pdf->Output();
    }

}

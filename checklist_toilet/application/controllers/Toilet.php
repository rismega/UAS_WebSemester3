<?php

class Toilet extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->model('m_toilet');
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('cetak_pdf');
    }

    public function index()
    {
        $this->load->view('partials/v_sidebar');
        $config['total_rows'] = $this->m_toilet->total_rows();
        $toilet = $this->m_toilet->get_limit_data();
        $this->pagination->initialize($config);
        $data = array(
            'toilet_data' => $toilet,
            'total_rows' => $config['total_rows'],
        );

        $this->load->view('v_toilet', $data);
        $this->load->view('partials/v_footer');
    }

    public function save()
    {
        $data = array(
            'lokasi' => $this->input->post('lokasi'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->m_toilet->insert($data);
        redirect(site_url('toilet'));
    }

    public function update()
    {
        $data = array(
            'lokasi' => $this->input->post('lokasi'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->m_toilet->update($this->input->post('id'), $data);
        redirect(site_url('toilet'));
    }

    public function delete()
    {
        $this->m_toilet->delete($this->input->post('id'));
        redirect(site_url('toilet'));
    }

    public function cetak_pdf()
    {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DATA TOILET', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(100, 6, 'Lokasi', 1, 0, 'C');
        $pdf->Cell(170, 6, 'Keterangan', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $barang = $this->db->query("SELECT * FROM toilet")->result();
        $no = 1;
        foreach ($barang as $data) {
            $pdf->Cell(8, 6, $no, 1, 0);
            $pdf->Cell(100, 6, $data->lokasi, 1, 0);
            $pdf->Cell(170, 6, $data->keterangan, 1, 1);
            $no++;
        }

        $pdf->Output();
    }
}

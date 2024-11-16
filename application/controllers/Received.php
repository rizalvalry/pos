<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Received extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['supplier_m', 'customer_m', 'sale_m', 'item_m', 'received_m']);
        check_not_login();
    }

    public function index()
    {
        // $data['customer'] = $this->customer_m->get()->result();
        // $data['item'] = $this->item_m->get()->result();
        // $data['cart'] = $this->sale_m->get_cart();
        // $data['invoice'] = $this->sale_m->delivery_no();

        $data['received'] = $this->received_m->get_all()->result();
        $this->template->load('template', 'transaction/received/received_grid', $data);
    }
    public function add()
    {
        
        $data['customer'] = $this->customer_m->get()->result();
        $data['received_no'] = $this->received_m->received_no();
        $this->template->load('template', 'transaction/received/received_form', $data);
    }
    
    public function save_input()
    {
        $post = $this->input->post();
        $this->received_m->save($post);
        $this->session->set_flashdata('pesan', 'Data Received berhasil di tambah.');
        redirect('received');
    }

    public function edit($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['received_m'] = $this->received_m->get_all($id)->result();
        // dd($this->db->last_query());
        // dd($data['received_m']);
        
        $this->template->load('template', 'transaction/received/received_form_edit', $data);
    }

    public function save_update()
    {
        $post = $this->input->post();
        $this->received_m->save_update($post);
        $this->session->set_flashdata('pesan', 'Data Received berhasil di tambah.');
        redirect('received');
    }

    public function add_detail($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['received_m'] = $this->received_m->get_all($id)->result();
        $data['received_detail'] = $this->received_m->get_all_detail($id)->result();
        // dd($this->db->last_query());
        // dd($data['received_detail']);
        
        $this->template->load('template', 'transaction/received/received_form_add_detail', $data);
    }

    public function add_received_detail($id)
    {
        $data['received_m'] = $this->received_m->get_all($id)->result();
        $received_m = $this->received_m->get_all($id)->result();
        // dd($received_m);
        
        $data['sale'] = $this->sale_m->get_sale_customer($received_m[0]->customer_id)->result();
        
        // $data['received_detail'] = $this->received_m->get_all_detail($id)->result();
        // dd($this->db->last_query());
        
        $this->template->load('template', 'transaction/received/received_form_add_received_detail', $data);
    }

    public function save_add_detail()
    {
        $post = $this->input->post();
        $id = $this->input->post('id');
        // dd($id);
        $this->received_m->save_detail($post);
        $this->session->set_flashdata('pesan', 'Data Received berhasil di tambah.');
        redirect('received/add_detail/'.$id);
    }

    public function delete_header($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('t_tandaterima');
       

        $this->session->set_flashdata('pesan', 'Data berhasil di hapus!');
        redirect('received');
    }
    public function delete_detail($id, $idterima, $sale_id)
    {
        $this->received_m->delete_detail($id, $sale_id);
        $error = $this->db->error();
        
            $this->session->set_flashdata('pesan', 'Data Berhasil berhasil di hapus!');
       
            redirect('received/add_detail/'.$idterima);
    }

    public function delete_detail2($id, $idterima, $sale_id)
    {
        $this->received_m->delete_detail($id, $sale_id);
        $error = $this->db->error();
        
            $this->session->set_flashdata('pesan', 'Data Berhasil berhasil di hapus!');
       
            redirect('received/detail/'.$idterima);
    }

    public function cetak($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['received_m'] = $this->received_m->get_all($id)->result();
        $data['received_detail'] = $this->received_m->get_all_detail($id)->result();

        $this->load->view('transaction/received/print_received', $data);
    }

    public function detail($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['received_m'] = $this->received_m->get_all($id)->result();
        $data['received_detail'] = $this->received_m->get_all_detail($id)->result();
        $data['count'] = $this->received_m->get_all_detail($id)->num_rows();
        $this->template->load('template', 'transaction/received/received_form_detail', $data);
    }

    public function upload_file($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['received_m'] = $this->received_m->get_all($id)->result();
        $data['received_detail'] = $this->received_m->get_all_detail($id)->result();
        $data['count'] = $this->received_m->get_all_detail($id)->num_rows();
        $this->template->load('template', 'transaction/received/received_form_detail_upload', $data);
    }

    public function save_update_upload()
    {
        $post = $this->input->post();
        if (!empty($_FILES['file_upload']['name'])) {
            $config['upload_path']   = './uploads/files/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size']      = 2 * 1024;
            $config['file_name']     = 'Files-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_upload')) {
                $post['file_upload'] =  $this->upload->data('file_name');

                $this->received_m->save_update_upload($post);
                $this->session->set_flashdata('pesan', 'Data Upload berhasil ditambah.');
                redirect('received');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $post['file_upload'] = "";
                $this->session->set_flashdata('pesan', 'Files yang anda upload tidak sesuai, mohon ulangi.');
                redirect('received');
            }
        } else {

            $this->received_m->save_update_upload($post);
            $this->session->set_flashdata('pesan', 'Data Received berhasil di tambah.');
        }
        redirect('received');
    }
}

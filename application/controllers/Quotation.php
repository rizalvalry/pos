<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['supplier_m', 'customer_m', 'sale_m', 'item_m', 'quotation_m', 'unit_m']);
        check_not_login();
    }

    public function index()
    {
        // $data['customer'] = $this->customer_m->get()->result();
        // $data['item'] = $this->item_m->get()->result();
        // $data['cart'] = $this->sale_m->get_cart();
        // $data['invoice'] = $this->sale_m->delivery_no();

        $data['quotation'] = $this->quotation_m->get_all()->result();
        $this->template->load('template', 'transaction/quotation/quotation_grid', $data);
    }
    public function add()
    {
        
        $data['customer'] = $this->customer_m->get()->result();
        $data['quotation_no'] = $this->quotation_m->quotation_no();
        $this->template->load('template', 'transaction/quotation/quotation_form', $data);
    }
    
    public function save_input()
    {
        $post = $this->input->post();
        $this->quotation_m->save($post);
        $this->session->set_flashdata('pesan', 'Data quotation berhasil di tambah.');
        redirect('quotation');
    }

    public function edit($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        // dd($this->db->last_query());
        // dd($data['quotation_m']);
        
        $this->template->load('template', 'transaction/quotation/quotation_form_edit', $data);
    }

    public function save_update()
    {
        $post = $this->input->post();
        $this->quotation_m->save_update($post);
        $this->session->set_flashdata('pesan', 'Data quotation berhasil di tambah.');
        redirect('quotation');
    }

    public function add_detail($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        $data['quotation_detail'] = $this->quotation_m->get_all_detail($id)->result();
        // dd($this->db->last_query());
        // dd($data['quotation_detail']);
        
        $this->template->load('template', 'transaction/quotation/quotation_form_add_detail', $data);
    }

    public function add_quotation_detail($id)
    {
        $data['unit'] = $this->unit_m->get()->result();
        $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        $quotation_m = $this->quotation_m->get_all($id)->result();
        // dd($quotation_m);
        
        $data['sale'] = $this->sale_m->get_sale_customer($quotation_m[0]->customer_id)->result();
        
        // $data['quotation_detail'] = $this->quotation_m->get_all_detail($id)->result();
        // dd($this->db->last_query());
        
        $this->template->load('template', 'transaction/quotation/quotation_form_add_quotation_detail', $data);
    }
    public function update_quotation_detail($id)
    {
        $data['unit'] = $this->unit_m->get()->result();
        // $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        // $quotation_m = $this->quotation_m->get_all($id)->result();
        // dd($quotation_m);
        
        $data['quotation_m'] = $this->quotation_m->get_all_detail_quo($id)->result();
        // dd($data['quotation_m']);
        // $data['quotation_detail'] = $this->quotation_m->get_all_detail($id)->result();
        // dd($this->db->last_query());
        
        $this->template->load('template', 'transaction/quotation/quotation_form_edit_quotation_detail', $data);
    }

    public function save_add_detail()
    {
        $post = $this->input->post();
        $id = $this->input->post('id_quotation');
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/quotation/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2 * 1024;
            $config['file_name']     = 'Quotation-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $post['gambar'] =  $this->upload->data('file_name');

                $this->quotation_m->save_detail($post);
                $this->session->set_flashdata('pesan', 'Data Detail berhasil ditambah.');
                redirect('quotation/add_detail/'.$id);
            } else {
                $error = array('error' => $this->upload->display_errors());
                // $post['gambar'] = "";
                $this->session->set_flashdata('pesan', 'Gambar yang anda upload tidak sesuai, mohon ulangi.');
                redirect('quotation/add_detail/'.$id);
            }
        } else {
            // $post['gambar'] = "default.png";
            // dd($id);
            $this->quotation_m->save_detail($post);
            $this->session->set_flashdata('pesan', 'Data quotation berhasil di tambah.');
            redirect('quotation/add_detail/'.$id);
        }
    }

    public function save_update_detail()
    {
        $post = $this->input->post();
        $id = $this->input->post('id');
        $id_quotation = $this->input->post('id_quotation');
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/quotation/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2 * 1024;
            $config['file_name']     = 'Quotation-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $post['gambar'] =  $this->upload->data('file_name');

                $this->quotation_m->save_update_detail($post);
                $this->session->set_flashdata('pesan', 'Data Detail berhasil ditambah.');
                redirect('quotation/add_detail/'.$id_quotation);
            } else {
                $error = array('error' => $this->upload->display_errors());
                $post['gambar'] = "";
                $this->session->set_flashdata('pesan', 'Gambar yang anda upload tidak sesuai, mohon ulangi.');
                redirect('quotation/add_detail/'.$id_quotation);
            }
        } else {
            $post['gambar'] = "default.png";
            // dd($id_quotation);
            $this->quotation_m->save_update_detail2($post);
            $this->session->set_flashdata('pesan', 'Data quotation berhasil di tambah.');
            redirect('quotation/add_detail/'.$id_quotation);
        }
    }

    public function delete_header($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('t_quotation');
       

        $this->session->set_flashdata('pesan', 'Data berhasil di hapus!');
        redirect('quotation');
    }

    public function delete_detail($id, $idquotation,$gambar)
    {
        $this->quotation_m->delete_detail($id);
        if($gambar != '') {
            unlink(base_url("uploads/quotation/".$gambar));
        }
        $error = $this->db->error();
        
            $this->session->set_flashdata('pesan', 'Data Berhasil berhasil di hapus!');
       
            redirect('quotation/add_detail/'.$idquotation);
    }

    public function delete_detail2($id, $idquotation, $gambar)
    {
        $link = base_url("uploads/quotation/".$gambar);
        // dd($link);
        $this->quotation_m->delete_detail($id);
        
            unlink($link);
        
        $error = $this->db->error();
        
            $this->session->set_flashdata('pesan', 'Data Berhasil berhasil di hapus!');
       
        redirect('quotation/detail/'.$idquotation);
    }

    public function cetak($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        $data['quotation_detail'] = $this->quotation_m->get_all_detail($id)->result();
        
        $this->load->view('transaction/quotation/print_quotation', $data);
    }

    public function cetakimage($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        $data['quotation_detail'] = $this->quotation_m->get_all_detail($id)->result();
        
        $this->load->view('transaction/quotation/print_quotation_image', $data);
    }

    public function detail($id)
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['quotation_m'] = $this->quotation_m->get_all($id)->result();
        $data['quotation_detail'] = $this->quotation_m->get_all_detail($id)->result();
        $data['count'] = $this->quotation_m->get_all_detail($id)->num_rows();
        $this->template->load('template', 'transaction/quotation/quotation_form_detail', $data);
    }
}

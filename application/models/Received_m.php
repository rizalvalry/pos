<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Received_m extends CI_Model
{
    
    public function received_no()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $sql = "SELECT MAX(MID(received_no,5,3)) AS received_no FROM t_tandaterima WHERE MID(date,1,4) = '".$tahun."' AND MID(date,6,2) = '".$bulan."'";
        // dd($sql);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->received_no) + 1;
            $no = sprintf("%'.03d", $n);
        } else {
            $no = "001";
        }
        
        // dd($no);
        $bulan           = date('n');
        $tahun           = date('Y');
        $romawi          = getRomawi($bulan);
        // $invoice = "DO" . date('ymd') . $no;
        $rec_no = "REC/" .$no."/PT.OSUNG/".$romawi."/".$tahun;
        // echo $rec_no;
        return $rec_no;
    }




    public function save($post)
    {
        // dd($post);
        $data = [
            'received_no' => $post['received_no'],
            'date' => $post['date'],
            'pengirim' => $post['pengirim'],
            'date_kirim' => $post['date_kirim'],
            'customer_id' => $post['customer_id']
        ];

        $this->db->insert('t_tandaterima', $data);
    }

    public function save_update($post)
    {
        // dd($post);
        $data = [
            'received_no' => $post['received_no'],
            'date' => $post['date'],
            'pengirim' => $post['pengirim'],
            'date_kirim' => $post['date_kirim'],
            'customer_id' => $post['customer_id']
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('t_tandaterima', $data);
    }

    public function save_update_upload($post)
    {
        // dd($post);
        $data = [
            'file_upload' => $post['file_upload'],
            'date_received' => $post['date_received']
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('t_tandaterima', $data);
    }

    public function save_detail($post)
    {
        // dd($post);
        $data = [
            'sale_id' => $post['sale_id'],
            'id_terima' => $post['id'],
        ];

        $this->db->insert('t_terimadetail', $data);

        $datas = [
            'status' => 1,
        ];
        $this->db->where('sale_id', $post['sale_id']);
        $this->db->update('t_sale', $datas);
    }

    public function update_sale($post, $sale_id)
    {
        $grand_total= str_replace(",", "", $post['grand_total']);
        $data = [
            'delivery_no' => $this->delivery_no(),
            'customer_id' => $post['customer_id'] != null ? $post['customer_id'] : null,
            'no_po' => $post['no_po'],
            'invoice_no' => $post['invoice_no'],
            'no_pr' => $post['no_pr'],
            'no_kendaraan' => $post['no_kendaraan'],
            'total_price' => $post['sub_total'],
            'discount' => $post['discount'],
            'sts_tax' => $post['sts_tax'],
            'grand_tax' => $post['grand_tax'],
            'final_price' => $grand_total,
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->where('sale_id', $sale_id);
        $this->db->update('t_sale', $data);

        // return $this->db->insert_id();
    }
    public function delete_detail($id, $sale_id)
    {
        $this->db->where('id', $id);
        $this->db->delete('t_terimadetail');

        //update sale
        $datas = [
            'status' => 0,
        ];
        $this->db->where('sale_id', $sale_id);
        $this->db->update('t_sale', $datas);

    }

    public function get_all($id = null)
    {
        $this->db->select('t_tandaterima.*, customer.name as customer_name, customer.address as address, customer.pic as customer_pic');
        $this->db->from('t_tandaterima');
        $this->db->join('customer', 't_tandaterima.customer_id=customer.customer_id', 'left');
        if ($id != null) {
            $this->db->where('t_tandaterima.id', $id);
        }
        $this->db->order_by('t_tandaterima.id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_detail($id)
    {
        $this->db->select(' t_terimadetail.*, t_sale.invoice_no, t_sale.delivery_no, t_sale.no_pr, t_sale.no_po');
        $this->db->from(' t_terimadetail');
        $this->db->join('t_sale', ' t_terimadetail.sale_id=t_sale.sale_id', 'left');
        $this->db->where(' t_terimadetail.id_terima', $id);
        
        $this->db->order_by(' t_terimadetail.id', 'desc');
        $query = $this->db->get();
        return $query;
    }


    public function get_sale_detail($sale_id = null)
    {
        $this->db->select('*, customer.name as customer_name, p_item.name as item_name, p_unit.name as name_unit');
        $this->db->from('t_sale_detail');
        $this->db->join('p_item', 't_sale_detail.item_id=p_item.item_id');
        $this->db->join('p_unit', 'p_item.unit_id=p_unit.unit_id');
        $this->db->join('t_sale', 't_sale_detail.sale_id=t_sale.sale_id');
        $this->db->join('customer', 't_sale.customer_id=customer.customer_id', 'left');
        if ($sale_id != null) {
            $this->db->where('t_sale_detail.sale_id', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function sale_detail()
    {
        $this->db->select('*, SUM(qty) as qty');
        $this->db->from('t_sale_detail');
        $this->db->join('p_item', 't_sale_detail.item_id=p_item.item_id');
        $this->db->group_by('t_sale_detail.item_id');
        $this->db->order_by('t_sale_detail.qty', 'desc');
        $query = $this->db->get();
        return $query;
    }
}

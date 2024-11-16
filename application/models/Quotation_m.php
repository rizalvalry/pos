<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation_m extends CI_Model
{
    
    public function quotation_no()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $sql = "SELECT MAX(MID(quotation_no,5,3)) AS quotation_no FROM t_quotation WHERE MID(date,1,4) = '".$tahun."' AND MID(date,6,2) = '".$bulan."'";
        // dd($sql);
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->quotation_no) + 1;
            $no = sprintf("%'.03d", $n);
        } else {
            $no = "001";
        }
        
        // dd($no);
        $bulan           = date('n');
        $tahun           = date('Y');
        $romawi          = getRomawi($bulan);
        // $invoice = "DO" . date('ymd') . $no;
        $quo_no = "QUO/" .$no."/PT.OSUNG/".$romawi."/".$tahun;
        // echo $quo_no;
        return $quo_no;
    }




    public function save($post)
    {
        // dd($post);
        $data = [
            'quotation_no' => $post['quotation_no'],
            'date' => $post['date'],
            'expired_date' => $post['expired_date'],
            'customer_id' => $post['customer_id']
        ];

        $this->db->insert('t_quotation', $data);
    }

    public function save_update($post)
    {
        // dd($post);
        $data = [
            'quotation_no' => $post['quotation_no'],
            'date' => $post['date'],
            'expired_date' => $post['expired_date'],
            'customer_id' => $post['customer_id']
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('t_quotation', $data);
    }

    public function save_detail($post)
    {
        // dd($post);
        $data = [
            'id_quotation' => $post['id_quotation'],
            'item' => $post['item'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'ukuran' => $post['ukuran'],
            'amount' => $post['amount'],
            'gambar' => $post['gambar'],
            'note' => $post['note'],
        ];
        $datas = [
            'id_quotation' => $post['id_quotation'],
            'item' => $post['item'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'ukuran' => $post['ukuran'],
            'amount' => $post['amount'],
            'note' => $post['note'],
        ];
    if($post['gambar']){
        $this->db->insert('t_quotationdetail', $data);
    }
    else{
        $this->db->insert('t_quotationdetail', $datas);
    }

    }
    public function save_update_detail($post)
    {
        // dd($post);
        $data = [
            'id_quotation' => $post['id_quotation'],
            'item' => $post['item'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'ukuran' => $post['ukuran'],
            'amount' => $post['amount'],
            'gambar' => $post['gambar'],
            'note' => $post['note'],
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('t_quotationdetail', $data);

    }

    public function save_update_detail2($post)
    {
        // dd($post);
        $data = [
            'id_quotation' => $post['id_quotation'],
            'item' => $post['item'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'ukuran' => $post['ukuran'],
            'amount' => $post['amount'],
            'note' => $post['note'],
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('t_quotationdetail', $data);

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
    public function delete_detail($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('t_quotationdetail');

    }

    public function get_all($id = null)
    {
        $this->db->select('t_quotation.*, customer.name as customer_name, customer.address as address, customer.pic as customer_pic, customer.divisi as divisi');
        $this->db->from('t_quotation');
        $this->db->join('customer', 't_quotation.customer_id=customer.customer_id', 'left');
        if ($id != null) {
            $this->db->where('t_quotation.id', $id);
        }
        $this->db->order_by('t_quotation.id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_detail_quo($id)
    {
        $this->db->select('t_quotationdetail.*');
        $this->db->from('t_quotationdetail');
        $this->db->where(' t_quotationdetail.id', $id);
        
        $this->db->order_by('t_quotationdetail.id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_detail($id)
    {
        $this->db->select('t_quotationdetail.*');
        $this->db->from('t_quotationdetail');
        $this->db->where(' t_quotationdetail.id_quotation', $id);
        
        $this->db->order_by('t_quotationdetail.id', 'desc');
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

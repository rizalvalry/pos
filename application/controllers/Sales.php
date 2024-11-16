<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['supplier_m', 'customer_m', 'sale_m', 'item_m']);
        check_not_login();
    }

    public function index()
    {
        $data['customer'] = $this->customer_m->get()->result();
        $data['item'] = $this->item_m->get()->result();
        $data['cart'] = $this->sale_m->get_cart();
        $data['do_no'] = $this->sale_m->delivery_no();
        $data['invoice_no'] = $this->sale_m->no_invoice();
        
        $this->template->load('template', 'transaction/sales/sales_form', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, true);

        if (isset($_POST['add_cart'])) {

            $item_id = $this->input->post('item_id');
            $cek_cart = $this->sale_m->get_cart(['t_cart.item_id' => $item_id]);
            if ($cek_cart->num_rows() > 0) {
                $this->sale_m->update_cart_qty($post);
            } else {
                $this->sale_m->add_cart($post);
            }

            #Update Stock Item
            $qty = $this->input->post('qty');

            $get_item = $this->item_m->get($item_id)->row_array();
            $stok = intval($get_item['stock'] - $qty);

            $data = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('item_id', $item_id);
            $this->db->update('p_item', $data);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if (isset($_POST['process_payment'])) {
            $sale_id = $this->sale_m->add_sale($post);
            $cart = $this->sale_m->get_cart()->result();
            $row = [];


            foreach ($cart as $c) {
                array_push($row, [
                    'sale_id' => $sale_id,
                    'item_id' => $c->item_id,
                    'price' => $c->cart_price,
                    'qty' => $c->qty,
                    'discount_item' => $c->discount_item,
                    'total' => $c->total
                ]);
            }

            $this->sale_m->add_sale_detail($row);
            $this->sale_m->del_cart(['user_id' => $this->session->userdata('userid')]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "sale_id" => $sale_id);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function edit()
    {
        $id = $this->input->post('cart_id');
        $data = $this->sale_m->get($id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
        //var_dump($data);
    }

    public function update()
    {
        $post = $this->input->post();
        $get_item = $this->item_m->get($post['cart_item'])->row_array();
        $old_qty = $post['old_qty'];

        if($old_qty > $post['item_qty']){
            $stock_qty = $old_qty - $post['item_qty'];
            $stok = intval($get_item['stock'] + $stock_qty);

            $data = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('item_id', $post['cart_item']);
            $this->db->update('p_item', $data);
        }elseif ($old_qty < $post['item_qty']) {
            $stock_qty = $post['item_qty'] - $old_qty;
            $stok = intval($get_item['stock'] - $stock_qty);

            $data = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('item_id', $post['cart_item']);
            $this->db->update('p_item', $data);
        }

        $this->sale_m->update_cart($post);
        $this->session->set_flashdata('pesan', 'Cart berhasil diupdate.');
        redirect('sales');
    }

    public function cart_data()
    {
        $cart = $this->sale_m->get_cart();
        $data['cart'] = $cart;
        $this->load->view('transaction/sales/cart_data', $data);
    }

    public function cart_del()
    {
        $cart_id = $this->input->post('cart_id');

        #mengembalikan stok
        $data = $this->sale_m->get($cart_id)->row_array();
        $get_item = $this->item_m->get($data['item_id'])->row_array();
        $stok = intval($get_item['stock'] + $data['qty']);

        $stoks = [
            'stock' => $stok,
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('item_id', $data['item_id']);
        $this->db->update('p_item', $stoks);
        
        #delete cart
        $this->sale_m->del_cart(['cart_id' => $cart_id]);

        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect('sales');
    }

    public function cart_delivery()
    {
        $cart_id = $this->input->post('cart_id');
        $sale_id = $this->input->post('sale_id');
// dd($sale_id);
        #mengembalikan stok
        $data = $this->sale_m->get($cart_id)->row_array();
        $get_item = $this->item_m->get($data['item_id'])->row_array();
        $stok = intval($get_item['stock'] + $data['qty']);

        $stoks = [
            'stock' => $stok,
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('item_id', $data['item_id']);
        $this->db->update('p_item', $stoks);
        
        #delete cart
        $this->sale_m->del_cart(['cart_id' => $cart_id]);

        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect('delivery_order/edit/', $sale_id);
    }

    public function reset()
    {
        if (isset($_POST['cancel_payment'])) {
            $userid = $this->session->userdata('userid');
            $this->sale_m->del_cart(['user_id' => $userid]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function cetak($id)
    {
        $data['sale'] = $this->sale_m->get_sale($id)->row();
        $data['sale_detail'] = $this->sale_m->get_sale_detail($id)->result();
        $this->load->view('transaction/sales/print_do', $data);
    }

    public function invoice($id)
    {
        $data['sale'] = $this->sale_m->get_sale($id)->row();
        $data['sale_detail'] = $this->sale_m->get_sale_detail($id)->result();
        $this->load->view('transaction/sales/print_invoice', $data);
    }

    public function get_data()
    {
        $tabel = '';

        $data = $this->sale_m->get_sale()->result();

        foreach ($data as $row) {
            $tabel .= '<tr>';
            $tabel .= '<td>'.$row->sale_id.'</td>';
            $tabel .= '<td>'.$row->invoice_no.'</td>';
            $tabel .= '<td>'.$row->delivery_no.'</td>';
            $tabel .= '<td>'.$row->no_po.'</td>';
            $tabel .= '<td style="text-align:center;">';
            $tabel .= '<button class="btn btn-xs btn-info" id="select" data-id="'.$row->sale_id.'" data-invoice_no="'.$row->invoice_no.'" data-delivery_no="'.$row->delivery_no.'" data-no_po="'.$row->no_po.'"><i class="fa fa-check"></i> Select</button>';
            $tabel .= '</td>';
            $tabel .= '</tr>';
        }

        header('Content-Type: application/json');
        echo json_encode($tabel);
    }
}

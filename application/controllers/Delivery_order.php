<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['supplier_m', 'customer_m', 'sale_m', 'item_m']);
        check_not_login();
    }

    public function index()
    {
        // $data['customer'] = $this->customer_m->get()->result();
        // $data['item'] = $this->item_m->get()->result();
        // $data['cart'] = $this->sale_m->get_cart();
        // $data['invoice'] = $this->sale_m->delivery_no();

        $data['sale'] = $this->sale_m->get_sale()->result();
        $this->template->load('template', 'transaction/sales/sales_grid', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, true);
        $sale_id = $this->input->post('sale_id');
       
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
        // dd($sale_id);
        if (isset($_POST['process_payment'])) {
            if($sale_id){
               $this->sale_m->update_sale($post, $sale_id);
                
            }
            
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

    public function edit($id)
    {
        // $data = $this->sale_m->get_sale($id)->row_array();
        $data['sale'] = $this->sale_m->get_sale($id)->row_array();
        $data['customer'] = $this->customer_m->get()->result();
        // $data['item'] = $this->item_m->get()->result();
        $data['delivery'] = $this->sale_m->get_delivery($id)->result();
        // var_dump($data['delivery']);
        
        $data['cart'] = $this->sale_m->get_cart();
        // $data['do_no'] = $this->sale_m->delivery_no();
        // $data['no_invoice'] = $this->sale_m->no_invoice();
        
        // var_dump($data->customer_id);
        // header('Content-Type: application/json');
        // echo json_encode($data);
        
        $this->template->load('template', 'transaction/sales/sales_form_edit', $data);
    }

    public function edit_del()
    {
        $id = $this->input->post('id');
        $data = $this->sale_m->getdelivery($id)->row_array();
        // var_dump($this->db->last_query());
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

    public function delivery_data($id)
    {
        $cart = $this->sale_m->get_delivery($id);
        $data['cart'] = $cart;
        $this->load->view('transaction/sales/delivery_data', $data);
    }
    public function cart_data()
    {
        $cart = $this->sale_m->get_cart();
        $data['cart'] = $cart;
        $this->load->view('transaction/sales/cart_data', $data);
    }
    public function cart_del()
    {
        $cart_id = $this->input->post('id');
        $sale_id = $this->input->post('sale_id');
// var_dump($cart_id);
        #mengembalikan stok
        $data = $this->sale_m->getdelivery($cart_id)->row_array();
        $get_item = $this->item_m->get($data['item_id'])->row_array();
        $stok = intval($get_item['stock'] + $data['qty']);

        $stoks = [
            'stock' => $stok,
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('item_id', $data['item_id']);
        $this->db->update('p_item', $stoks);
        
        #delete cart
        $this->sale_m->del_delivery(['id' => $cart_id]);

        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect('delivery_order/edit/'.$sale_id);
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
        $this->load->view('transaction/sales/print_struk', $data);
    }

    public function detail($id)
    {
        // $data = $this->sale_m->get_sale($id)->row_array();
        $data['sale'] = $this->sale_m->get_sale($id)->row_array();
        $data['customer'] = $this->customer_m->get()->result();
        $data['delivery'] = $this->sale_m->get_delivery($id)->result();
        $data['count'] = $this->sale_m->get_delivery($id)->num_rows();
        $data['cart'] = $this->sale_m->get_cart();
        
        $this->template->load('template', 'transaction/sales/sales_form_detail', $data);
    }

    public function delivery_delete()
    {
        $cart_id = $this->input->post('id');
        $sale_id = $this->input->post('sale_id');
// var_dump($cart_id);
        #mengembalikan stok
        $data = $this->sale_m->getdelivery($cart_id)->row_array();
        $get_item = $this->item_m->get($data['item_id'])->row_array();
        $stok = intval($get_item['stock'] + $data['qty']);

        $stoks = [
            'stock' => $stok,
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('item_id', $data['item_id']);
        $this->db->update('p_item', $stoks);
        
        #delete cart
        $this->sale_m->del_delivery(['id' => $cart_id]);

        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect('delivery_order/detail/'.$sale_id);
    }

    public function delete_header($id)
    {
        $this->db->where('sale_id',$id);
        $this->db->delete('t_sale');
       

        $this->session->set_flashdata('pesan', 'Data berhasil di hapus!');
        redirect('delivery_order');
    }
    public function update_header()
    {
        $saleid = $this->input->post('sale_id');
        $date = $this->input->post('date');
        // $user = $this->input->post('user');
        $customer = $this->input->post('customer');
        $no_po = $this->input->post('no_po');
        $no_kendaraan = $this->input->post('no_kendaraan');
        $no_pr = $this->input->post('no_pr');
        $do_no = $this->input->post('do_no');
        $invoice_no = $this->input->post('invoice_no');
        $data = [
            // 'sale_id' => $saleid,
            'date' => $date,
            // 'user' => $user,
            'customer_id' => $customer,
            'no_po' => $no_po,
            'no_kendaraan' => $no_kendaraan,
            'no_pr' => $no_pr,
            'delivery_no' => $do_no,
            'invoice_no' => $invoice_no,
        ];
        
        // dd($data);
        $this->db->where('sale_id', $saleid);
        $this->db->update('t_sale', $data);
        // dd($this->db->last_query());
        $this->session->set_flashdata('pesan', 'Data berhasil diupdate.');
        redirect('delivery_order');
    }
}

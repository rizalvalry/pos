<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{

    function print_laporan($s,$e)
    {
        $this->db->select('t_sale.*, customer.name as customer');
        $this->db->from('t_sale');
        $this->db->join('customer', 't_sale.customer_id=customer.customer_id','left');
        
        $this->db->where('t_sale.date BETWEEN "'. $s. '" and "'. $e.'"');
        $this->db->group_by('t_sale.delivery_no');
        $query = $this->db->get();
        return $query;

        // return $this->db->query("SELECT a.*, b.name as customer FROM t_sale a LEFT JOIN customer b ON a.customer_id=b.customer_id  WHERE a.date between '".$s."' and '".$e."' GROUP BY  a.invoice ORDER BY a.sale_id asc");
    }

    
}

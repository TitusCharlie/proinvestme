<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Payments_model (Payments Model)
 * User model class to get to handle user related data 
 * @author : Axis96
 * @version : 1.1
 * @since : 07 December 2019
 */
class Coinbase_model extends CI_Model
{

    function addCoinbase($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_coinbase', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getCoinbasePayment($payId, $status)
    {
        $this->db->select('*');
        $this->db->from('tbl_coinbase');
        $this->db->where('txn_id =', $payId);
        $this->db->where('status =', $status);
        $query = $this->db->get();
        
        return $query->row(); 
    }

    function editCoinbaseInfo($info, $id)
    {
        $this->db->where('txn_id', $id);
        $this->db->update('tbl_coinbase', $info);
        
        return TRUE;
    }
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Referrals_model (Referrals Model)
 * User model class to get to handle user related data 
 * @author : Axis96
 * @version : 3.2
 * @since : 25 February 2020
 */

class Referrals_model extends CI_Model
{
    function referralsListingCount($userId, $searchText = '')
    {
        $this->db->select();
        $this->db->from('tbl_referrals as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.referredId', 'left');
        $this->db->where('BaseTbl.referrerId', $userId);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function referrals($userId, $searchText = '', $page, $segment)
    {
        $this->db->select();
        $this->db->from('tbl_referrals as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.referredId', 'left');
        $this->db->where('BaseTbl.referrerId', $userId);

        if(!empty($searchText)) {
            $this->db->group_start();
            $terms = explode(' ', $searchText);
            if(count($terms)>1){
                $this->db->or_like('User.firstName', $this->db->escape_like_str($terms[0]));
                $this->db->or_like('User.lastName', $this->db->escape_like_str($terms[1]));
                $this->db->or_like('User.firstName', $this->db->escape_like_str($terms[1]));
                $this->db->or_like('User.lastName', $this->db->escape_like_str($terms[0]));
            }else{
                $this->db->or_like('User.email', $this->db->escape_like_str($terms[0]));
                $this->db->or_like('User.firstName', $this->db->escape_like_str($terms[0]));
                $this->db->or_like('User.lastName', $this->db->escape_like_str($terms[0]));
                $this->db->or_like('User.mobile', $this->db->escape_like_str($terms[0]));
            }
            $this->db->group_end();
        }

        $this->db->order_by('BaseTbl.referredId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        return $query->result();        
    }

    function total_referrals_per_period($userId, $start, $end)
    {
        $this->db->select();
        $this->db->from('tbl_referrals');
        $this->db->where('referrerId', $userId);
        $this->db->where('createdDtm >=', $start);
        $this->db->where('createdDtm <=', $end);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    function getReferralId($refcode)
    {
        $this->db->select('BaseTbl.*, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.refCode', $refcode);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getReferrerID($userID)
    {
        $this->db->select('*');
        $this->db->from('tbl_referrals as BaseTbl');
        $this->db->where('BaseTbl.referredId', $userID);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row()->referrerId;
          } else {
            return null;
          }
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addReferral($referralInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_referrals', $referralInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}
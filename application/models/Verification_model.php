<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Axis96
 * @version : 1.1
 * @since : 07 December 2019
 */
class Verification_model extends CI_Model
{
    /**
     * Application status
     * 0 - Not vetted/New
     * 1 - Approved
     * 2 - Sent back for resubmission
     * 3 - Resubmitted
     * 4 - Rejected  
     */

    function verification_list($searchText = '', $status, $page, $segment)
    {
        $this->db->select('BaseTbl.*, User.firstName as userFirstName, User.lastName as userLastName, User.email as userEmail, Assigned.firstName as assignedToFirstName, Assigned.lastName as assignedToLastName, Assigned.email as assignedToEmail, Assigned.ppic as assignedToppic');
        $this->db->from('tbl_verification as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.userId', 'left');
        $this->db->join('tbl_users as Assigned', 'Assigned.userId = BaseTbl.assignedTo', 'left');
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->or_like('firstName', $this->db->escape_like_str($searchText));
            $this->db->or_like('lastName', $this->db->escape_like_str($searchText));
            $this->db->or_like('email', $this->db->escape_like_str($searchText));
            $this->db->group_end();
        }
        if($status != NULL){
            $newsubmission = $_SESSION['newsubmission'] == 'true' ? '0' : '';
            $resubmitted = $_SESSION['resubmitted'] == 'true' ? '3' : '';
            $pendingresubmission = $_SESSION['pendingresubmission'] == 'true' ? '2' : '';
            $approved = $_SESSION['approved'] == 'true' ? '1' : '';
            $rejected = $_SESSION['rejected'] == 'true' ? '4' : '';

            $this->db->where('overall_status', $newsubmission);
            $this->db->or_where('overall_status', $resubmitted);
            $this->db->or_where('overall_status', $pendingresubmission);
            $this->db->or_where('overall_status', $approved);
            $this->db->or_where('overall_status', $rejected);
        }
        $this->db->order_by('updatedDtm', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function verification_list_count($searchText = '', $status, $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_verification  as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.userId','left');
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->or_like('firstName', $this->db->escape_like_str($searchText));
            $this->db->or_like('lastName', $this->db->escape_like_str($searchText));
            $this->db->or_like('email', $this->db->escape_like_str($searchText));
            $this->db->group_end();
        }
        if($status != NULL){
            $newsubmission = $_SESSION['newsubmission'] == 'true' ? '0' : '';
            $resubmitted = $_SESSION['resubmitted'] == 'true' ? '3' : '';
            $pendingresubmission = $_SESSION['pendingresubmission'] == 'true' ? '2' : '';
            $approved = $_SESSION['approved'] == 'true' ? '1' : '';
            $rejected = $_SESSION['rejected'] == 'true' ? '4' : '';

            $this->db->where('overall_status', $newsubmission);
            $this->db->or_where('overall_status', $resubmitted);
            $this->db->or_where('overall_status', $pendingresubmission);
            $this->db->or_where('overall_status', $approved);
            $this->db->or_where('overall_status', $rejected);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function getVerificationInfo($userId){
        $this->db->select();
        $this->db->where('userId', $userId);
        $this->db->from('tbl_verification');

        $query = $this->db->get();

        $rows = $query->num_rows();

        if($rows > 0){
            return $query->row();
        } else {
            return false;
        }
    }

    function getVerificationInfoById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_verification as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.userId','left');
        $this->db->where('BaseTbl.id', $id);

        $query = $this->db->get();

        $rows = $query->num_rows();

        if($rows > 0){
            return $query->row();
        } else {
            return false;
        }
    }

    function addKycInfo($array)
    {
        $this->db->insert('tbl_verification', $array);
        
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }

    function updateInfo($data, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_verification', $data);
        
        return TRUE;
    }

    function isVerified($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_verification');
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }

    function pendingkyc(){
        $this->db->select('*');
        $this->db->from('tbl_verification as BaseTbl');
        $this->db->where('BaseTbl.overall_status', 0);
        $this->db->or_where('BaseTbl.overall_status', 3);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
}
<?php

error_reporting(0);

/**
 * ProInvest Installer Library
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is available through the world-wide-web at this URL:
 * https://choosealicense.com/licenses/gpl-3.0/
 *
 * @category        Installer
 * @package         codeigniter/libraries
 * @version         1.0
 * @author          axis96
 * @copyright       Copyright (c) 2020 Axis96
 * @license         https://choosealicense.com/licenses/gpl-3.0/
 *
 *
 */

class Installer {

	// Function to validate the post data
	function validate_post($data)
	{
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['hostname']) && !empty($data['username']) && !empty($data['database']);
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}

	// Function to write the config file
	function write_config($data) 
	{

		// Config path
		$template_path 	= APPPATH.'config/database_default.php';
		$output_path 	= APPPATH.'config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
		$new  = str_replace("%USERNAME%",$data['username'],$new);
		$new  = str_replace("%PASSWORD%",$data['password'],$new);
		$new  = str_replace("%DATABASE%",$data['database'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
				//Change output path back to 0644
				@chmod($output_path,0644);
			} else {
				return false;
			}
		} else {
			return false;
		}
    }

    function check_database_conn($hostname, $username, $password, $database)
    {
        $conn = new mysqli($hostname, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            return false;
        }
        return true;
    }
    
    // Function to the database and tables and fill them with the default data
	function create_database($data)
	{
        $connected = $this->check_database_conn($data['hostname'],$data['username'],$data['password'], '');

        if($connected == true){
			$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');
            // Create the prepared statement
		    $mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);
        } else {
            return false;
        }

		// Close the connection
		$mysqli->close();

		return true;
	}

	function cd_check($data)
	{
		$cd = $data['purchasecode'];
		$d = $this->isLocalhost() == 1 ? 'localhost' : $_SERVER['HTTP_HOST'];
		// Build the request
		$ch = curl_init();

		/* Array Parameter Data */
		$data = ['code'=>$cd, 'domain'=>$d];
		
		curl_setopt_array($ch, array(
			CURLOPT_URL => "https://axis96.co/purchaseverifier",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 20,
			CURLOPT_POSTFIELDS => $data,
			
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer {$personalToken}",
				"User-Agent: {$userAgent}"
			)
		));

		// Send the request with warnings supressed
		$response = @curl_exec($ch);

		return json_decode($response);
	}

	function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
        $connected = $this->check_database_conn($data['hostname'],$data['username'],$data['password'], $data['database']);

        if($connected == true){
			$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'], $data['database']);

            // Open the default SQL file
			$query = file_get_contents(FCPATH.'database/database.sql');
            
            // Execute a multi query
		    $mysqli->multi_query($query);
        } else {
            return false;
        }

		// Close the connection
		$mysqli->close();

		return true;
	}
}
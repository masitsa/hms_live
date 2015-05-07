<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_search extends MX_Controller 
{	
	function __construct()
	{
		parent:: __construct();
	}
	
	public function search_database_view()
	{
		$data = $this->load->view('search_database_view'); 
	}
	
	public function search_database()
	{
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		
		$query = $this->db->query($this->input->post('query'));
		$delimiter = ",";
		$newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query);
		$path = realpath(APPPATH . '../assets');
		$name = 'output.csv';
		force_download($name, $data); 
		/*if ( ! write_file($path.'\\output.csv', $data))
		{
			 echo 'Unable to write the file';
		}
		else
		{
			 echo 'File written!';
		}*/
	}
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Joy extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	public function comment()
	{
		
		
		if($this->input->post(NULL, TRUE)){
			
			//Get Posted items and put it in a review array
			$subdomain = $this->input->post('subdomain', TRUE);
			$case = $this->input->post('case', TRUE);
			$agent = $this->input->post('agent', TRUE);
			$ranking = $this->input->post('ranking', TRUE);
			$user_id = $this->input->post('user_id', TRUE);
			$comment = $this->input->post('comment', TRUE);
			$status = $this->input->post('status', TRUE);
			
			$review = array('subdomain' => $subdomain, 'case' => $case, 'agent' => $agent, 'user_id' => $user_id, 'ranking' => $ranking);
			
			if($status == 'Insert'){
				//No Results were found - insert new ranking.
				//Set Created Date
				$review['updated'] = date("Y-m-d H:i:s");
			
				//Insert new review
				$this->db->insert('reviews', $review); 
				$review_id = $this->db->insert_id();
			
			}else{
				//Status is original case #
				//Review exists - Update Review
			
				$this->db->where('id', $status);
				$review['updated'] = date("Y-m-d H:i:s");
				$this->db->update('reviews', $review);
				$review_id = $status;
				
			}
			
			if($comment){
			
				$comments = array('reviewsid' => $review_id, 'comment' => $comment, 'created' => date("Y-m-d H:i:s"));
				$this->db->insert('comments', $comments);
			}
		
		}
		
		$this->load->view('header2');
		$this->load->view('thankyou');
		$this->load->view('footer');
	}
	
	public function metric()
	{
		//Get input Segments
		$subdomain = $this->uri->segment(3, 0);
		$case = $this->uri->segment(4, 0);
		$agent = $this->uri->segment(5, 0);
		$ranking = $this->uri->segment(6, 0);
		$user_id = $this->uri->segment(7, 0); //JoyMetric User ID
		
		$review = array('subdomain' => $subdomain, 'case' => $case, 'agent' => $agent, 'user_id' => $user_id);
		
		//Check to see if review already exits
		
		$this->db->select('id')->from('reviews')->where($review);
		$review_results = $this->db->get();
		
		$review['ranking'] = $ranking;
		
		if ($review_results->num_rows() > 0)
		{
			//if results were found, set review status to update
			$row = $review_results->row();
			$id = $row->id;
			
			$review['status'] = $id;
		}else{
			//No results were found so Set Status to insert
			$review['status'] = 'Insert';
		}
			$this->load->view('header2');
			$this->load->view('comments', $review);
			$this->load->view('footer');
		
	}
		
}


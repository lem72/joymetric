<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
			$this->load->helper('url');
           		 if (!$this->ion_auth->logged_in()){
				redirect('/', 'refresh');
			}
       }
	 
	public function index()
		{
				$user = $this->ion_auth->user()->row();
				$user_id = $user->id;
			
				$get_reviews_array = array('reviews.user_id' => $user_id);
				$this->db->select('reviews.*, agents.name, COUNT(reviews.ranking) AS count')->from('reviews')->join('agents', 'reviews.agent = agents.agent_id', 'left')->where($get_reviews_array)->group_by(array('agents.name', 'reviews.ranking'))->order_by('agents.name', 'asc');
				
				if(isset($_GET['from'])){
					if($_GET['from'] != ""){
						$this->db->where('reviews.updated  >=', $_GET['from']);
					}	
				}	
				if(isset($_GET['to'])){
					if($_GET['to'] != ""){
						$this->db->where('reviews.updated  <=', $_GET['to']);
					}	
				}
				

				$data['reviews'] = $this->db->get();
				$data['user_id'] = $user_id;
			
			$this->load->view('header');
			$this->load->view('admin', $data);
			$this->load->view('footer');
		}
		
		
		
		public function comments()
		{
				$user = $this->ion_auth->user()->row();
				$user_id = $user->id;
			
				$get_comments_array = array('reviews.user_id' => $user_id);
				$this->db->select('reviews.agent, agents.name, comments.comment, comments.created, reviews.case, reviews.ranking')->from('reviews')->join('agents', 'reviews.agent = agents.agent_id')->join('comments', 'reviews.id = comments.reviewsid')->where($get_comments_array)->order_by('comments.created', 'desc')->limit(100);
				
				if(isset($_GET['from'])){
					if($_GET['from'] != ""){
						$this->db->where('comments.created  >=', $_GET['from']);
					}	
				}	
				if(isset($_GET['to'])){
					if($_GET['to'] != ""){
						$this->db->where('comments.created  <=', $_GET['to']);
					}	
				}
				

				$data['comments'] = $this->db->get();
				$data['user_id'] = $user_id;
			
			$this->load->view('header');
			$this->load->view('admin/comments', $data);
			$this->load->view('footer');
		}
		
		
		public function agent()
		{
				$user = $this->ion_auth->user()->row();
				$user_id = $user->id;
				$data['user_id'] = $user_id;
				
				
			
			$this->load->view('header');
			$this->load->view('agents', $data);
			$this->load->view('footer');
		}
	
}
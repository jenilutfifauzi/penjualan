<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    // load session library
    $this->load->library('session');
    $this->load->helper('url');

  }

  public function index()
  {

    $data['title'] = 'Dashboard';
    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('template/dashboard', $data);
    $this->load->view('template/footer');
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Penjualan extends RestController {

    public function index_get()
    {
        
        $data = $this->db->get('penjualan')->result_array();

        $this->response($data, RestController::HTTP_OK );
    }
}
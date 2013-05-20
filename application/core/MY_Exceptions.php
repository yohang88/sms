<?php

class MY_Exceptions extends CI_Exceptions {

    public function show_404()
    {
        $CI =& get_instance();
        $CI->load->view('common/header');
        $CI->load->view('common/error_404');
        echo $CI->output->get_output();
        exit;
    }
}
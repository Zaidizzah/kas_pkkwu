<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function load_template($content_view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('struktur_webs/header', $data);
    $CI->load->view($content_view, $data);
    $CI->load->view('struktur_webs/footer', $data);
}
?>  
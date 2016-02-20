<?php 
require '../vendor/autoload.php';

$data = array();

$html = App\Template::render('pdf/pdf', $data);

App\Pdf::render('tarea', $html);
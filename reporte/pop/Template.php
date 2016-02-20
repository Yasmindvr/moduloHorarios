<?php namespace App;

	class Template
	{
		public function render($file,array $data = array())
		{
			ob_start();
			extract($data);
			include '../templates/'. $file .'.php';
			return $html = ob_get_clean(); 

		}
	}
<?php namespace App;

	use DOMPDF;

	class Pdf
	{
		protected static $configured = false;

		public function configure()
		{
			if (static::$configured) return;

			define('DOMPDF_ENABLE_AUTOLOAD', false);
			require_once '../vendor/dompdf/dompdf/dompdf_config.inc.php';

			static::$configured = true;
		}

		public function render($file, $html)
		{		
			static::configure();

			$dompdf = new DOMPDF();

			$dompdf -> set_paper('a4', 'landscape'); 

			$dompdf -> load_html($html);
			$dompdf -> render();
			$dompdf -> stream("$file.pdf");
		}
	}
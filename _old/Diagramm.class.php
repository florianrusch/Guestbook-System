<?php
require_once DOCROOT . '/lib/pChart.class.php';
require_once DOCROOT . '/lib/pChart.class.php';
require_once DOCROOT . '/lib/pImage.class.php';


class Diagramm {
	private $web;

	public function __construct() {
		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial', '', 14);
	}
}

?>
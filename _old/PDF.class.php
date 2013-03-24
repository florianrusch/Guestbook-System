<?php
require_once '/lib/FPDF.class.php';


class PDF {
	private $pdf;

	public function __construct() {
		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial', '', 14);
	}
}

?>

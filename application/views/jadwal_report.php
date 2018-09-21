<?php 
// Construct The PDF
	/**
	 * This is the class constructor.
	 * It allows to set up the page format, the orientation and the measure unit used in all the methods (except for the font sizes).
	 *
	 * IMPORTANT: Please note that this method sets the mb_internal_encoding to ASCII, so if you are using the mbstring module functions with TCPDF you need to correctly set/unset the mb_internal_encoding when needed.
	 *
	 * @param $orientation (string) page orientation. Possible values are (case insensitive):<ul><li>P or Portrait (default)</li><li>L or Landscape</li><li>'' (empty string) for automatic orientation</li></ul>
	 * @param $unit (string) User measure unit. Possible values are:<ul><li>pt: point</li><li>mm: millimeter (default)</li><li>cm: centimeter</li><li>in: inch</li></ul><br />A point equals 1/72 of inch, that is to say about 0.35 mm (an inch being 2.54 cm). This is a very common unit in typography; font sizes are expressed in that unit.
	 * @param $format (mixed) The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
	 * @param $unicode (boolean) TRUE means that the input text is unicode (default = true)
	 * @param $encoding (string) Charset encoding (used only when converting back html entities); default is UTF-8.
	 * @param $diskcache (boolean) DEPRECATED FEATURE
	 * @param $pdfa (boolean) If TRUE set the document to PDF/A mode.
	 * @public
	 * @see getPageSizeFromFormat(), setPageFormat()
	 */
	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
// Generate PDF Identity
	/**
	 * Defines the title of the document.
	 * @param $title (string) The title.
	 */
	$pdf->SetTitle('Judul Jadwal Report');
	/**
	 * Defines the subject of the document.
	 * @param $subject (string) The subject.
	 */
	$pdf->SetSubject('Subject Jadwal Report');
	/**
	 * Defines the author of the document.
	 * @param $author (string) The name of the author.
	 */
	$pdf->SetAuthor('Author Jadwal Report');
	/**
	 * Associates keywords with the document, generally in the form 'keyword1 keyword2 ...'.
	 * @param $keywords (string) The list of keywords.
	 */
	$pdf->SetKeywords('TCPDF, PDF, jadwal, report');
	/**
	 * Defines the creator of the document. This is typically the name of the application that generates the PDF.
	 * @param $creator (string) The name of the creator.
	 */
	$pdf->SetCreator('Sistem Informasi Penjadwalan Perkuliahan');

$pdf->SetHeaderMargin(0);
$pdf->SetTopMargin(100);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');

// Generate Header
	/**
	 * Set header data.
	 * @param $ln (string) header image logo
	 * @param $lw (string) header image logo width in mm
	 * @param $ht (string) string to print as title on document header
	 * @param $hs (string) string to print on document header
	 * @param $tc (array) RGB array color for text.
	 * @param $lc (array) RGB array color for line.
	 * @public
	 */
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING, array(100,0,0), array(0,100,0));

	/**
	 * Set header margin.
	 * (minimum distance between header and top page margin)
	 * @param $hm (int) distance in user units
	 * @public
	 */
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->AddPage();

$pdf->Write(10, 'Some sample texttes');
$pdf->Output('My-File-Name.pdf', 'I');
 ?>
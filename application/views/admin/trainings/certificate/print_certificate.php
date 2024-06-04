<?php
//require("pdflib.php");
$this->load->library('pdflib');

// function certificate_print_text($pdf, $x, $y, $align, $font = 'freeserif', $style, $size = 10, $text, $width = 0)
// {
//     $pdf->setFont($font, $style, $size);
//     $pdf->SetXY($x, $y);
//     $pdf->writeHTMLCell($width, 0, '', '', $text, 0, 0, 0, true, $align);
// }

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Certificate");
$pdf->SetProtection(array('modify'));
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage();

$x = 10;
$y = 40;

$sealx = 150;
$sealy = 220;
$seal = realpath("./seal.png");

$sigx = 30;
$sigy = 230;
$sig = realpath("./signature.png");

$custx = 30;
$custy = 230;

$wmarkx = 26;
$wmarky = 58;
$wmarkw = 158;
$wmarkh = 170;
$wmark = realpath("./watermark.png");

$brdrx = 0;
$brdry = 0;
$brdrw = 210;
$brdrh = 297;
$codey = 250;


$fontsans = 'helvetica';
$fontserif = 'times';

// border
$pdf->SetLineStyle(array('width' => 1.5, 'color' => array(0, 0, 0)));
$pdf->Rect(10, 10, 190, 277);
// create middle line border
$pdf->SetLineStyle(array('width' => 0.2, 'color' => array(64, 64, 64)));
$pdf->Rect(13, 13, 184, 271);
// create inner line border
$pdf->SetLineStyle(array('width' => 1.0, 'color' => array(128, 128, 128)));
$pdf->Rect(16, 16, 178, 265);


// Set alpha to semi-transparency
if (file_exists($wmark)) {
    $pdf->SetAlpha(0.2);
    $pdf->Image($wmark, $wmarkx, $wmarky, $wmarkw, $wmarkh);
}

$logox = 160;
$logoy = 17;
$logo = realpath("./watermark.png");

$pdf->SetAlpha(1);
if (file_exists($logo)) {
    $pdf->Image($logo, $logox, $logoy, '22', '');
}



$KPlogox = 27;
$KPlogoy = 17;
$KPlogo = realpath("./KPlogo.png");

$pdf->SetAlpha(1);
if (file_exists($KPlogo)) {
    $pdf->Image($KPlogo, $KPlogox, $KPlogoy, '22', '');
}


$KPlogox = 93;
$KPlogoy = 240;
$KPlogo = realpath("./hcip_logo.png");

$pdf->SetAlpha(1);
if (file_exists($KPlogo)) {
    $pdf->Image($KPlogo, $KPlogox, $KPlogoy, '22', '');
}



$pdf->SetAlpha(1);
if (file_exists($seal)) {
    //  $pdf->Image($seal, $sealx, $sealy, '', '');
}
if (file_exists($sig)) {
    //$pdf->Image($sig, $sigx, $sigy, '', '');
}

// Add text
certificate_print_text($pdf, $x, $y - 6, 'C', $fontserif, 'B', 13, "HEALTH DEPARTMENT");
certificate_print_text($pdf, $x, $y - 12, 'C', $fontserif, 'B', 13, "GOVERNMENT OF KHYBER PAKHTUNKHWA");

$pdf->SetTextColor(0, 0, 120);
certificate_print_text($pdf, $x, $y, 'C', $fontsans, '', 15, "PROVINCIAL HEALTH SERVICES ACADEMY");
$pdf->SetTextColor(0, 0, 0);
certificate_print_text($pdf, $x, $y + 30, 'C', $fontserif, '', 15, "CERTIFICATE OF ACHIEVEMENT");
certificate_print_text($pdf, $x, $y + 40, 'C', $fontserif, '', 14, "AWARDED TO");
certificate_print_text($pdf, $x, $y + 51, 'C', $fontsans, '', 30, "Yaseen Muhammad");
certificate_print_text($pdf, $x, $y + 67, 'C', $fontserif, '', 14, "ON COMPLETION OF");

certificate_print_text($pdf, $x, $y + 82, 'C', $fontsans, '', 13, "FOUR MONTHS MANDATORY PROMOTIONAL TRAINING FOR IN-SERVICE MID & SENIOR LEVEL HEALTH MANAGERS");
//certificate_print_text($pdf, $x, $y + 72, 'C', $fontsans, '', 20, "the Butt of Many Jokes");
certificate_print_text($pdf, $x, $y + 100, 'C', $fontsans, '', 14,  "13th June 1992");
//certificate_print_text($pdf, $x, $y + 102, 'C', $fontserif, '', 10, "With a grade of 12%");
certificate_print_text($pdf, $x, $y + 112, 'C', $fontserif, '', 10, "AT");
certificate_print_text($pdf, $x, $y + 122, 'C', $fontserif, '', 14, "PROVINCIAL HEALTH SERVICES ACADEMY PESHAWAR, PAKISTAN");

certificate_print_text($pdf, $x, $y + 145, 'C', $fontsans, 'B', 14,  "Certificate ID");

certificate_print_text($pdf, $x + 125, $y + 180, 'C', $fontsans, '', 14,  "Director General PHSA Peshawar");
certificate_print_text($pdf, $x + 15, $y + 180, 'L', $fontsans, '', 14,  "Project Director");
certificate_print_text($pdf, $x + 22, $y + 186, 'L', $fontsans, '', 14,  "KP-HCIP");


certificate_print_text($pdf, $x, $y + 222, 'C', $fontsans, '', 14,  "Supported By");
certificate_print_text($pdf, $x, $y + 230, 'C', $fontsans, '', 13,  "KHYBER PAKHTUNKHWA HUMAN CAPITAL INVESTMENT PROJECT (HEALTH)");


header("Content-Type: application/pdf");
echo $pdf->Output('', 'S');

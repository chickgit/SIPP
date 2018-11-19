<?php 
// print_r(json_encode($list_jp));
// exit();
// Create The PDF
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
// Set PDF Identity
(isset($jadwal_judul)) ? : $jadwal_judul = 'Jadwal Report';
$pdf->SetTitle($jadwal_judul);
$pdf->SetSubject('Jadwal Report');
$pdf->SetAuthor('SIPP');
$pdf->SetKeywords('TCPDF, PDF, jadwal, report');
$pdf->SetCreator('Sistem Informasi Penjadwalan Perkuliahan');
// Set Margin
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
// Set Options
$pdf->SetAutoPageBreak(true);
$pdf->SetDisplayMode('real', 'default');
// Remove Default Header/Footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// Set a Page
$pdf->AddPage();

// Generate Content

// Tanggal dibuatnya jadwal
$pdf->SetFont('times', '', 6); // Set Font
// $tgl_jadwal = 'DD Month YYYY';
$pdf->MultiCell(0, '', $jadwal_tanggalDiBuat, 0, 'R', 0, 0, '', '', true);
$pdf->Ln(5); // Performs a line break.

// Judul Jadwal
$pdf->SetFont('times', '', 15); // Set Font
// $judul_jadwal = 'Judul Jadwal Judul Jadwal Judul Jadwal Judul Jadwal Judul Jadwal Judul Jadwal Judul Jadwal Judul Jadwal Judul Jadwal ';
$pdf->Write(0, $jadwal_judul, '', 0, 'C', 1);
$pdf->Ln(2); // Performs a line break.

// Tabel Jadwal
$pdf->SetFont('times', '', 8); // Set Font
$isi_tabel = "";
foreach ($jadwal_tabel as $row) {
$isi_tabel .= '<tr>';
    $isi_tabel .= '<td class="hari" style="">'.$row->nama_hari.'</td>';
    $isi_tabel .= '<td class="matkul" style="text-align:left;">'.$row->nama_mk.'</td>';
    $isi_tabel .= '<td class="sks" style="">'.$row->sks_mk.'</td>';
    $isi_tabel .= '<td class="smstr" style="">'.$row->semester_mk.'</td>';
    $isi_tabel .= '<td class="waktu" style="">';
    if ((isset($row->waktu_aw)) && (isset($row->waktu_ak))) {
        # code...
        $isi_tabel .= date('H:i', strtotime($row->waktu_aw)).' - '.date('H:i', strtotime($row->waktu_ak)); 
    }
    $isi_tabel .= '</td>';
    $isi_tabel .= '<td class="dosen" style="text-align:left;">'.$row->nama.'</td>';
    $isi_tabel .= '<td class="ruang" style="">'.$row->nama_ruangan.'</td>';
    $isi_tabel .= '<td class="peserta" style="">'.$row->prodi.' | '.$row->peminatan.'</td>';
$isi_tabel .= '</tr>';
}
$tabel_jadwal = <<<EOD
<style>
table {
    border-collapse: collapse;
    table-layout: auto;
    width: 100%;
    text-align: center;
}
table .hari{
	width: 7%;
}
table .matkul{
	width: 35%;
}
table .sks{
	width: 5%;
}
table .smstr{
	width: 6%;
}
table .waktu{
	width: 10%;
}
table .dosen{
	width: 25%;
}
table .ruang{
	width: 7%;
}
table .peserta{
	width: 10%;
}
</style>
<table border="0.1">
    <thead>
        <tr>
            <th class="hari"> Hari </th>
            <th class="matkul"> Mata Kuliah </th>
            <th class="sks"> SKS </th>
            <th class="smstr" style="white-space:nowrap"> Smstr </th>
            <th class="waktu"> Waktu </th>
            <th class="dosen"> Dosen </th>
            <th class="ruang"> Ruang </th>
            <th class="peserta"> Peserta </th>
        </tr>
    </thead>
    <tbody>{$isi_tabel}</tbody>
</table>
EOD;
$pdf->writeHTML($tabel_jadwal, false, false, false, false, '');
// Performs a line break.
// $pdf->Ln(2);

// Catatan Kaki
$pdf->SetFont('times', '', 6); // Set Font
$pdf->writeHTML(!(empty($jadwal_catatanKaki)) ? 'Catatan:<br>'.$jadwal_catatanKaki : '' ,true);
// Performs a line break.
$pdf->Ln(2);
// Persetujuan
$pdf->SetFont('times', 'B', 8); // Set Font
if (isset($jadwal_persetujuan['mengetahui']['nama']) || isset($jadwal_persetujuan['mengetahui']['sebagai'])) {
    $pdf->writeHTMLCell(95, '', '', '', '<p>Mengetahui<br><br><br><br><u>'.$jadwal_persetujuan['mengetahui']['nama'].'</u><br>'.$jadwal_persetujuan['mengetahui']['sebagai'].'</p>', 0, 0, 0, true, 'C', true);
}
if (isset($jadwal_persetujuan['menyetujui']['nama']) || isset($jadwal_persetujuan['menyetujui']['sebagai'])) {
    $pdf->writeHTMLCell(95, '', '', '', '<p>Menyetujui<br><br><br><br><u>'.$jadwal_persetujuan['menyetujui']['nama'].'</u><br>'.$jadwal_persetujuan['menyetujui']['sebagai'].'</p>', 0, 0, 0, true, 'C', true);
}

$pdf->Output('My-File-Name.pdf', 'I');
 ?>
<?php  

ob_start();
include '../../assets/libs/fpdf/fpdf.php';
include '../../koneksi/koneksi.php';
include '../../assets/libs/fpdf/mc_table/mc_table.php';

// Kelas untuk menangani rotasi teks
class PDF_Rotate extends PDF_MC_Table
{
    var $angle = 0;

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        // Teks yang berotasi
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }
}

// Instansiasi kelas PDF_Rotate yang sudah memiliki fungsi rotasi
$pdf = new PDF_Rotate();
$pdf->AliasNbPages();
$pdf->AddPage();

// Menambahkan logo (jika ada)
$pdf->Image('logo-sekolah.jpeg', 10, 6, 30);

// Menambahkan judul laporan
$pdf->SetFont('TIMES', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Pendaftaran Siswa', 0, 1, 'C');

// Menambahkan alamat atau informasi kontak
$pdf->SetFont('TIMES', 'I', 12);
$pdf->Cell(0, 10, 'Jl. Mayor Kusmanto, Pedawang, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59324', 0, 1, 'C');
$pdf->Cell(0, 10, 'Telp: (0291) 000000, Email: info@domain.com', 0, 1, 'C');

// Menambahkan garis pemisah
$pdf->Ln(5);
$pdf->SetLineWidth(0.5);
$pdf->Line(10, 40, 200, 40); // Garis horizontal

$pdf->Ln(10); // Spasi sebelum tabel

// Mengatur warna untuk header tabel
$pdf->SetFillColor(230, 230, 230);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(50, 50, 100);

// Mengatur font untuk judul tabel
$pdf->SetFont('TIMES', 'B', 12);
$pdf->Cell(40, 10, '', 0, 0, 'L');
$pdf->Cell(100, 10, 'List Pendaftar', 1, 1, 'C', true);
$pdf->Ln();

// Mengatur font untuk header tabel
$pdf->SetFont('TIMES', 'B', 12);
$pdf->Cell(10, 10, 'No.', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Nama', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Usia', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Gender', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Kelas', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Tanggal Daftar', 1, 1, 'C', true);

// Query ke database
$query = "SELECT * FROM pendaftaran a, akun b, detail_pendaftaran c WHERE a.Id = c.id_user AND b.id_user = a.Id";
$exec = mysqli_query($conn, $query);

$no = 0;

// Mengatur lebar kolom tabel
$pdf->SetWidths(array(10, 40, 50, 20, 20, 20, 30));

// Mengatur font untuk isi tabel
$pdf->SetFont('TIMES', '', 10);

// Looping data dari database
while ($rows = mysqli_fetch_array($exec)) {
    $pdf->Row(array(
        ++$no,
        $rows['nama'],
        $rows['email'],
        $rows['usia'],
        $rows['jenis_kelamin'],
        $rows['kelas'],
        $rows['tanggal_daftar']
    ));
}

// Menambahkan garis pemisah sebelum footer
$pdf->Ln(10);
$pdf->SetLineWidth(0.5);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Garis horizontal

// Footer untuk informasi tambahan atau tanda tangan
$pdf->Ln(10);
$pdf->SetFont('TIMES', 'I', 10);
$pdf->Cell(0, 10, 'Dicetak pada: ' . date('d-m-Y'), 0, 1, 'L');

// Hapus atau komentari kode ini untuk menghilangkan watermark
// $pdf->SetTextColor(230, 230, 230);
// $pdf->SetFont('TIMES', 'B', 50);
// $pdf->RotatedText(35, 190, 'CONFIDENTIAL', 45);

// $pdf->SetTextColor(0, 0, 0); // Reset warna teks

// Output PDF ke browser
$pdf->Output();

?>

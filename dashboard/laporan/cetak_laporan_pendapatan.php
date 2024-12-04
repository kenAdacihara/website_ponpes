<?php  

  ob_start();
  include '../../assets/libs/fpdf/fpdf.php';
  include '../../koneksi/koneksi.php';
  include '../../assets/libs/fpdf/mc_table/mc_table_pendapatan.php';

  // Instansiasi kelas yang diwariskan
  $pdf = new PDF_MC_Table();
  $pdf->AliasNbPages();
  $pdf->AddPage();

  // Informasi tambahan (opsional)
  $pdf->SetFont('TIMES','I',12);
  $pdf->Cell(0,10,'Jl. Mayor Kusmanto, Pedawang, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59324',0,1,'C'); // Ganti dengan alamat atau informasi lain

  $pdf->Ln(10); // Spasi sebelum tabel

  
  // Mengatur font untuk judul tabel
  $pdf->Cell(40,10,'',0,0,'L');
  $pdf->SetFont('TIMES','B',12);
  $pdf->Cell(100,10,'List Pendapatan',1,1,'C');
  $pdf->Ln();
  $pdf->SetFont('TIMES','',10);
  $pdf->Cell(10,10,'No.',1,0,'C');
  $pdf->Cell(40,10,'Nama',1,0,'C');
  $pdf->Cell(50,10,'Email',1,0,'C');
  $pdf->Cell(40,10,'Tanggal Pembayaran',1,0,'C');
  $pdf->Cell(20,10,'Cicilan Ke-',1,0,'C');
  $pdf->Cell(30,10,'Earn',1,1,'C');

  // Query ke database
  $query	=	"SELECT a.nama,b.email, d.nominal as nom, d.tanggal_pembayaran, d.cicilan_ke, c.metode_pembayaran_pendaftaran as metode_pembayaran
        FROM pendaftaran a, akun b, detail_pendaftaran c, cicilan_pendaftaran d 
        WHERE a.Id = c.id_user 
        AND b.id_user = a.Id
        AND c.Id = d.id_detail_pendaftaran";
  $exec 	=	mysqli_query($conn, $query);

  $no = 0;

  // Mengatur lebar kolom tabel
  $pdf->SetWidths(array(10,40,50,40,20,30));

  $count 	=	0;
  $tmp_id = "";
  $count = 0;

  // Looping data dari database
  while ($rows = mysqli_fetch_array($exec)) {
    $mp 	=	$rows['metode_pembayaran'];
  
    if ($mp == "C") {
      $cicilan = $rows['cicilan_ke'];
      if ($cicilan == 2) {
        $cicilan = "LUNAS";
      }
    }else{
      $cicilan = "LUNAS";
    }

    $pdf->Row(array(++$no,$rows['nama'],$rows['email'],$rows['tanggal_pembayaran'],$cicilan,'Rp. '.thousandSparator($rows['nom'])));
    $count+=$rows['nom'];
  }

  // Total semua pendapatan
  $pdf->Ln(0);
  $pdf->Cell(160,10,'Total',1,0,'C');
  $pdf->Cell(30,10,'Rp. '.thousandSparator($count),1,1,'L');

  // Footer untuk informasi tambahan atau tanda tangan
  $pdf->Ln(10);
  $pdf->SetFont('TIMES','I',10);
  $pdf->Cell(0,10,'Dicetak pada: '.date('d-m-Y'),0,1,'L');

  // Output PDF ke browser
  $pdf->Output();

  function thousandSparator($number){
    $example = $number;
    $subtotal =  number_format($number, 2, ',', '.');
    return $subtotal;
  }

?>
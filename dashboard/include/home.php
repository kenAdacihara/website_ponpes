<?php
    // Fungsi helper untuk cek status dokumen
    function isDocumentUploaded($document) {
        return !empty($document) && $document != NULL && $document != '';
    }
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, <?php $role == "Admin" ?  print($nama_admin) : print($nama); ?></h1>
        <p class="text-gray-600 mt-2">Pantau progres pendaftaran Anda di sini</p>
    </div>
    <div class="d-none d-sm-inline-block">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo date('d F Y'); ?></span>
    </div>
</div>

<!-- Content Row dengan cards -->
<div class="row">
    <!-- Status Pendaftaran Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status Pendaftaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                // Cek semua dokumen wajib
                                $complete = isDocumentUploaded($upload_akte) && 
                                          isDocumentUploaded($upload_kartu_keluarga) && 
                                          isDocumentUploaded($foto_anak);
                                
                                if($complete) {
                                    echo '<span class="badge badge-success">Lengkap</span>';
                                } else {
                                    echo '<span class="badge badge-warning">Belum Lengkap</span>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Pembayaran Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status Pembayaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                if(isDocumentUploaded($upload_pembayaran_pendaftaran)) {
                                    echo '<span class="badge badge-success">Sudah Bayar</span>';
                                } else {
                                    echo '<span class="badge badge-danger">Belum Bayar</span>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nilai Quiz Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nilai Quiz</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo isset($hasil_quiz) ? $hasil_quiz : '-'; ?></div>
                            </div>
                            <?php if(isset($hasil_quiz)): ?>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $hasil_quiz; ?>%" aria-valuenow="<?php echo $hasil_quiz; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Status Card dengan perhitungan yang diperbaiki -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kelengkapan Dokumen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $uploaded_docs = 0;
                                $total_docs = 5;
                                
                                if(isDocumentUploaded($upload_akte)) $uploaded_docs++;
                                if(isDocumentUploaded($upload_kartu_keluarga)) $uploaded_docs++;
                                if(isDocumentUploaded($foto_anak)) $uploaded_docs++;
                                if(isDocumentUploaded($foto_keluarga)) $uploaded_docs++;
                                if(isDocumentUploaded($upload_ijazah)) $uploaded_docs++;
                                
                                echo $uploaded_docs . '/' . $total_docs;
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checklist Pendaftaran yang Diperbaiki -->
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Checklist Pendaftaran</h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Mengisi Formulir Pendaftaran
                        <span class="badge badge-<?php echo !empty($nama) ? 'success' : 'warning'; ?> badge-pill">
                            <i class="fas fa-<?php echo !empty($nama) ? 'check' : 'times'; ?>"></i>
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Upload Akte Kelahiran
                        <span class="badge badge-<?php echo isDocumentUploaded($upload_akte) ? 'success' : 'warning'; ?> badge-pill">
                            <i class="fas fa-<?php echo isDocumentUploaded($upload_akte) ? 'check' : 'times'; ?>"></i>
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Upload Kartu Keluarga
                        <span class="badge badge-<?php echo isDocumentUploaded($upload_kartu_keluarga) ? 'success' : 'warning'; ?> badge-pill">
                            <i class="fas fa-<?php echo isDocumentUploaded($upload_kartu_keluarga) ? 'check' : 'times'; ?>"></i>
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Upload Foto
                        <span class="badge badge-<?php echo isDocumentUploaded($foto_anak) ? 'success' : 'warning'; ?> badge-pill">
                            <i class="fas fa-<?php echo isDocumentUploaded($foto_anak) ? 'check' : 'times'; ?>"></i>
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Upload Ijazah
                        <span class="badge badge-<?php echo isDocumentUploaded($upload_ijazah) ? 'success' : 'warning'; ?> badge-pill">
                            <i class="fas fa-<?php echo isDocumentUploaded($upload_ijazah) ? 'check' : 'times'; ?>"></i>
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Mengerjakan Quiz
                        <span class="badge badge-<?php echo isset($hasil_quiz) && $hasil_quiz > 0 ? 'success' : 'warning'; ?> badge-pill">
                            <i class="fas fa-<?php echo isset($hasil_quiz) && $hasil_quiz > 0 ? 'check' : 'times'; ?>"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Card -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Penting</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Petunjuk Pendaftaran</h4>
                    <p>Silakan lengkapi semua persyaratan pendaftaran dengan mengikuti langkah-langkah berikut:</p>
                    <hr>
                    <p class="mb-0">
                        1. Lengkapi profil personal<br>
                        2. Upload dokumen yang diperlukan<br>
                        3. Kerjakan quiz<br>
                        4. Lakukan pembayaran pendaftaran
                    </p>
                </div>
                <div class="text-center">
                    <a href="index.php?page=10" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-right"></i> Mulai Lengkapi Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
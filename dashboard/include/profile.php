<!-- Profile Header -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="text-center mb-4">
                <div class="display-4 text-primary mb-2">Profile Santri</div>
                <p class="lead text-muted">Detail informasi pendaftaran Anda</p>
            </div>

            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <!-- Header with Avatar -->
                <div class="card-header bg-gradient-primary py-4">
                    <div class="text-center">
                        <div class="img-profile mb-3">
                            <div class="rounded-circle bg-white text-primary d-inline-flex justify-content-center align-items-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-user-circle fa-4x"></i>
                            </div>
                        </div>
                        <h2 class="text-white mb-0"><?php echo $nama; ?></h2>
                        <p class="text-white-50 mb-0"><?php echo $email; ?></p>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Quick Info Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendidikan Terakhir</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pendidikan_terakhir; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-success h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Di Kudus Ikut</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $di_kudus_ikut; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-home fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-info h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kontak</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $telp; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-phone fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab">
                                <i class="fas fa-user mr-2"></i>Data Pribadi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="family-tab" data-toggle="tab" href="#family" role="tab">
                                <i class="fas fa-users mr-2"></i>Data Keluarga
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="profileTabContent">
                        <!-- Personal Data Tab -->
                        <div class="tab-pane fade show active" id="personal" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="30%" class="bg-light"><i class="fas fa-id-card mr-2"></i>Nama Lengkap</th>
                                            <td><?php echo $nama; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-user-tag mr-2"></i>Nama Panggilan</th>
                                            <td><?php echo $nama_panggilan; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-birthday-cake mr-2"></i>Tempat, Tanggal Lahir</th>
                                            <td><?php echo $tempat_lahir . ", " . date('d F Y', strtotime($tanggal_lahir)); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-venus-mars mr-2"></i>Jenis Kelamin</th>
                                            <td><?php echo $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light"><i class="fas fa-child mr-2"></i>Anak Ke-</th>
                                            <td><?php echo $anak_ke . " dari " . $jumlah_saudara . " bersaudara"; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Family Data Tab -->
                        <div class="tab-pane fade" id="family" role="tabpanel">
                            <!-- Father's Data -->
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="fas fa-male text-primary mr-2"></i>Data Ayah
                            </h5>
                            <div class="table-responsive mb-4">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="30%" class="bg-light">Nama Lengkap</th>
                                            <td><?php echo $nama_ayah; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Tempat, Tanggal Lahir</th>
                                            <td><?php echo $tempat_lahir_ayah . ", " . date('d F Y', strtotime($tanggal_lahir_ayah)); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Pendidikan</th>
                                            <td><?php echo $pendidikan_terakhir_ayah; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Pekerjaan</th>
                                            <td><?php echo $pekerjaan_ayah; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Agama</th>
                                            <td><?php echo $agama_ayah; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mother's Data -->
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="fas fa-female text-primary mr-2"></i>Data Ibu
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th width="30%" class="bg-light">Nama Lengkap</th>
                                            <td><?php echo $nama_ibu; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Tempat, Tanggal Lahir</th>
                                            <td><?php echo $tempat_lahir_ibu . ", " . date('d F Y', strtotime($tanggal_lahir_ibu)); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Pendidikan</th>
                                            <td><?php echo $pendidikan_terakhir_ibu; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Pekerjaan</th>
                                            <td><?php echo $pekerjaan_ibu; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Agama</th>
                                            <td><?php echo $agama_ibu; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
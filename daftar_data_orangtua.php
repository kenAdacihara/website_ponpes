<?php  
    session_start();

    $redirect = "<script> window.location='daftar_syarat.php'; </script>";

    if(isset($_POST['submit'])){
        foreach ($_POST as $key => $val) {
            ${$key} = $val;
            $_SESSION[''.$key.''] = $val;
        }

        if (!empty($_SESSION)) {
            echo $redirect;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="uploads/identitas/favicon-sekolah.png">
    <title>Penerimaan Santri Baru</title>
    
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style3.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h4 class="title">Data Orang Tua</h4>
                        <p class="category">Isi Form pendaftaran dengan benar</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="daftar_data_orangtua.php">
                            <fieldset class="the-fieldset">
                                <legend class="the-legend">Data Ayah</legend>
                                <div class="form-group">
                                    <label for="father_name">Nama Ayah</label>
                                    <input type="text" class="form-control" name="father_name" id="father_name" required 
                                        value="<?php isset($_SESSION['father_name']) ? print($_SESSION['father_name']) : ""; ?>" autofocus>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="birth_place_father">Tempat Lahir Ayah</label>
                                        <input type="text" class="form-control" name="birth_place_father" id="birth_place_father" required 
                                            value="<?php isset($_SESSION['birth_place_father']) ? print($_SESSION['birth_place_father']) : ""; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="birth_date_father">Tanggal Lahir Ayah</label>
                                        <input type="date" class="form-control" name="birth_date_father" id="birth_date_father" required 
                                            value="<?php isset($_SESSION['birth_date_father']) ? print($_SESSION['birth_date_father']) : print("1980-01-01"); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="father_last_education">Pendidikan Terakhir Ayah</label>
                                    <input type="text" class="form-control" name="father_last_education" id="father_last_education" required
                                        value="<?php isset($_SESSION['father_last_education']) ? print($_SESSION['father_last_education']) : ""; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="father_job">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" name="father_job" id="father_job" required 
                                        value="<?php isset($_SESSION['father_job']) ? print($_SESSION['father_job']) : ""; ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="father_religion">Agama Ayah</label>
                                    <input type="text" class="form-control" name="father_religion" id="father_religion" required 
                                        value="<?php isset($_SESSION['father_religion']) ? print($_SESSION['father_religion']) : ""; ?>">
                                </div>
                            </fieldset>

                            <fieldset class="the-fieldset mt-4">
                                <legend class="the-legend">Data Ibu</legend>
                                <div class="form-group">
                                    <label for="mother_name">Nama Ibu</label>
                                    <input type="text" class="form-control" name="mother_name" id="mother_name" required 
                                        value="<?php isset($_SESSION['mother_name']) ? print($_SESSION['mother_name']) : ""; ?>" autofocus>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="birth_place_mother">Tempat Lahir Ibu</label>
                                        <input type="text" class="form-control" name="birth_place_mother" id="birth_place_mother" required
                                            value="<?php isset($_SESSION['birth_place_mother']) ? print($_SESSION['birth_place_mother']) : ""; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="birth_date_mother">Tanggal Lahir Ibu</label>
                                        <input type="date" class="form-control" name="birth_date_mother" id="birth_date_mother" required
                                            value="<?php isset($_SESSION['birth_date_mother']) ? print($_SESSION['birth_date_mother']) : print("1980-01-01"); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mother_last_education">Pendidikan Terakhir Ibu</label>
                                    <input type="text" class="form-control" name="mother_last_education" id="mother_last_education" required
                                        value="<?php isset($_SESSION['mother_last_education']) ? print($_SESSION['mother_last_education']) : ""; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mother_job">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" name="mother_job" id="mother_job" required
                                        value="<?php isset($_SESSION['mother_job']) ? print($_SESSION['mother_job']) : ""; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mother_religion">Agama Ibu</label>
                                    <input type="text" class="form-control" name="mother_religion" id="mother_religion" required
                                        value="<?php isset($_SESSION['mother_religion']) ? print($_SESSION['mother_religion']) : ""; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telp/HP</label>
                                    <input type="text" class="form-control" name="telp" id="telp" required
                                        value="<?php isset($_SESSION['telp']) ? print($_SESSION['telp']) : ""; ?>">
                                </div>
                            </fieldset>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="daftar_siswa_baru.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" name="submit" class="btn btn-primary">Lanjut <i class="fa fa-arrow-right"></i></button>
                            </div>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
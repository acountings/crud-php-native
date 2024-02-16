<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = 'kirim Email';

include 'layout/header.php';
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

 //Server settings
 $mail->SMTPDebug = 2;                      //Enable verbose debug output
 $mail->isSMTP();                                            //Send using SMTP
 $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
 $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
 $mail->Username   = 'diasvino2@gmail.com';                     //SMTP username
 $mail->Password   = 'mxiq syli fkxe quao';                               //SMTP password
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
 $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

 if (isset($_POST['Kirim'])) {
    $mail->setFrom('diasvino2@gmail.com', 'ahmad dun');
    $mail->addAddress($_POST['Email_Penerima']);
    $mail->addReplyTo('diasvino2@gmail.com', 'ahmad dun');
    
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['pesan'];

    if(!$mail->send()) {
        echo"<script>alert('Email Berhasil Di kirim');
        document.location.href = 'index.php';</script>";
    } else {
        echo"<script>alert('Email gagal Di kirim');
        document.location.href = 'index.php';</script>";
    }
 }


// check apakah tombol KIRIM ditekan
// 
//     if (create_barang($_POST) > 0) {
//         echo "<script>
//                 alert('Data Barang Berhasil Ditambahkan');
//                 document.location.href = 'index.php';
//               </script>";
//     } else {
//         echo "<script>
//                 alert('Data Barang Gagal Ditambahkan');
//                 document.location.href = 'index.php';
//               </script>";
//     }
// }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><ia class="fas fa-plus"></ia> Kirim Email</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Kirim Email</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="Email Penerima" class="form-label">Email Penerima</label>
                    <input type="email" class="form-control" id="Email Penerima" name="Email_Penerima" placeholder="Email Penerima..." required>
                </div>

                <div class="mb-3">
                    <label for="Subject " class="form-label">Subject</label>
                    <input type="text" class="form-control" id="Subject " name="Subject " placeholder="Subject..." required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Pesan</label>
                    <textarea name= "pesan" id="pesan" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" name="Kirim" class="btn btn-primary" style="float: right;">Kirim</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>

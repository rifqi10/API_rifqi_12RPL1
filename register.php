<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['noktp']) && isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nohp']) && isset($_POST['alamat'])) {

    // menerima parameter POST ( nama, email, password )
    $noktp = $_POST['noktp'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    // Cek jika user ada dengan email yang sama
    if ($db->isUserExisted($email)) {
        // user telah ada
        $response["error"] = TRUE;
        $response["error_msg"] = "User telah ada dengan email " . $email;
        echo json_encode($response);
    } else {
        // buat user baru
        $user = $db->simpanUser($nama, $email, $password);
        if ($user) {
            // simpan user berhasil
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["noktp"] = $user["noktp"];
            $response["user"]["nama"] = $user["nama"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["nohp"] = $user["nohp"];
            $response["user"]["alamat"] = $user["alamat"];
            echo json_encode($response);
        } else {
            // gagal menyimpan user
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (nama, email, atau password) ada yang kurang";
    echo json_encode($response);
}
?>

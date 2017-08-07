<?php
    $curl = curl_init();

    // AKUN FASILKOMTI
    // Pegawai:  NIP/NIK: 99999, Password: x0e7yc (admin)
    // Dosen : NIP/NIK: 88888, Password: yjnuzg
    // pegawai : 33333, Password: e5lfwj 

    // AKUN BIRO 
    // akun 1 : NIP/NIK: 66666, Password: eolcwt
    // akun 2 : NIP/NIK: 44444, Password: nuvep5 


    // employment type

    // "employee_type" => [
    //         0 => "Dosen Tetap",
    //         1 => "Tenaga Kependidikan",
    //         2 => "Dosen Tetap Non PNS",
    //         3 => "Dosen Luar Biasa",
    //         4 => "Dosen Tidak Tetap PNS",
    //         5 => "Pegawai Honorer"
    //     ],

    // yang pegawai itu yang type nya = 1 dan 5 aja,

//     pegawai

     curl_setopt_array($curl, array(
         CURLOPT_RETURNTRANSFER => TRUE,
         CURLOPT_URL => 'http://api.usu.ac.id/1.0/users/auth',
         CURLOPT_POST => 1,
         CURLOPT_POSTFIELDS => array("nip" => "99999", "password" => "test",
         CURLOPT_HEADER => TRUE
     )));

    // dosen

    // curl_setopt_array($curl, array(
    //     CURLOPT_RETURNTRANSFER => TRUE,
    //     CURLOPT_URL => 'http://api.usu.ac.id/1.0/users/auth',
    //     CURLOPT_POST => 1,
    //     CURLOPT_POSTFIELDS => array("nip" => "66666", "password" => "eolcwt",
    //     CURLOPT_HEADER => TRUE
    // )));

    // curl_setopt_array($curl, array(
    //     CURLOPT_RETURNTRANSFER => TRUE,
    //     CURLOPT_URL => 'https://akun.usu.ac.id/auth/login/apps',
    //     CURLOPT_POST => 1,
    //     CURLOPT_POSTFIELDS => array("identity" => "141402072994031003", "password" => "test", "random_char" => "TVWBJBSuwyewbwgcuw23657438zs",
    //     CURLOPT_HEADER => TRUE
    // )));

    // var_dump($curl);
     $resp = curl_exec($curl);
    
     curl_close($curl);
    
    $t = json_decode($resp, TRUE);
    var_dump($t);
    // echo "";
?>
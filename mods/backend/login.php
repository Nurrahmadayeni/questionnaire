<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "SELECT * from user where username='$username' and password=md5('$password')";
	
	$data = $mysqli->query($query);
		$user = $data->fetch_assoc();
			$jlh = $data->num_rows;

	if($jlh>0){
		$_SESSION['id_user'] = $user['id_user']; 
		$_SESSION['username_q'] = $username;
		$_SESSION['level'] =  $user['level'];
		$_SESSION['status'] = $user['status'];

		// $data = base64_encode("dashboard_tampilan_home_pengguna");
		// // echo $data;
		// header("Location: ?d=$data");

		// // echo"<script>
		// // 		document.location.href='?d=home';
		// // 	</script>";				
		echo "Sukses";
	}else{
		// echo"
		// 	<script>
		// 		alert('username dan password salah');
		// 		document.location.href='?type=login';
		// 	</script>
		// ";
		echo "Username atau password anda salah, silahkan periksa lagi";

	}
?>
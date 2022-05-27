<?php 
	
	session_start();
	require '../koneksi.php';


	$username = $_POST['username'];
	$password = $_POST['password'];


	$sql = 'SELECT * FROM akun
		WHERE username=? AND password=MD5(?)';
	$row = $koneksi -> prepare($sql);
	$row -> execute(array($username,$password));

	$jumRow = $row -> rowCount();

	if($jumRow > 0){
	$hasil = $row -> fetch();
    $_SESSION['akun'] = $hasil;
        
        $tgl = echo date('Y-m-d H:i:s');
		$sql = "INSERT INTO log_activity(nm_session,waktu) VALUES('$hasil','$tgl')";
      	$row = $koneksi -> prepare($sql);
      	$row -> execute(array($hasil,$tgl));
      	
      	echo 'berhasil';
      
 	} else{
 		echo 'salah';
 	}



 ?>
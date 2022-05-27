<?php
//echo'sukses' -> Koneksi Database;
	$u_mysql='root';
	$p_mysql='lina172503!@#';
	$koneksi= new PDO('mysql:host=localhost;dbname=tokbuk',$u_mysql,$p_mysql);
//echo 'sukses';
	$koneksii = new mysqli("localhost","root","lina172503!@#","tokbuk");

	$host="localhost";
	$user="root";
	$password="lina172503!@#";
	$db="tokbuk";

	$kon = mysqli_connect($host,$user,$password,$db);

	
?>
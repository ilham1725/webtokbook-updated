<?php 



// fungsi enkripsi

function encrypt($v){

	$metode = "AES-256-CBC"; // metode enkripsi
	$hash = "sdasdjaqweqwrrwtgfdakASDIQWJAK/asdad"; // generate hash
	$IV = "1234561234561234"; // untuk mengacak string

	$hasil_enkripsi = openssl_encrypt($v, $metode, $hash, 0, $IV); //proses enkripsi menggunakan openssl

	return $hasil_enkripsi;
}

function decrypt($v){

	$metode = "AES-256-CBC"; // metode enkripsi
	$hash = "sdasdjaqweqwrrwtgfdakASDIQWJAK/asdad"; // generate hash
	$IV = "1234561234561234"; // untuk mengacak string

	$hasil_dekripsi = openssl_decrypt($v, $metode, $hash, 0, $IV); // proses dekripsi menggunakan openssl

	return $hasil_dekripsi;
}

 // function get API

 function get_CURL($url){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result, true);
  }



 ?>
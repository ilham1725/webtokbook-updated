<?php

$ekspedisi = $_POST['ekspedisi'];
$distrik = $_POST['distrik'];
$total_berat = $_POST['berat'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=151&destination=".$distrik."&weight=".$total_berat."&courier=".$ekspedisi,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 4c6fefe128624176787643eda92a9d24"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  $array_response = json_decode($response,TRUE);
  $paket = $array_response['rajaongkir']['results']['0']['costs'];
    echo "<option>--Pilih Paket--</option>";
  foreach ($paket as $key => $datapaket) {
    
    echo "<option
            paket='".$datapaket['service']."'
            ongkir='".$datapaket['cost']['0']['value']."'
            etd='".$datapaket['cost']['0']['etd']."'>";
    echo $datapaket['service']." ";
    echo number_format($datapaket['cost']['0']['value'])." ";
    echo $datapaket['cost']['0']['etd']." Hari";
    echo "</option>";
  }

  // echo "<pre>";
  // echo print_r($paket);
  // echo "</pre>";

}

?>
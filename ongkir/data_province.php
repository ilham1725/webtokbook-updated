<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 4c6fefe128624176787643eda92a9d24"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {;

  $array_response = json_decode($response,TRUE);
  $provinsi = $array_response['rajaongkir']['results'];

    echo "<option> -- Provinsi -- </option>";
  foreach ($provinsi as $key => $dataprov) {
    echo "<option id_provinsi='".$dataprov['province_id']."'>";
    echo $dataprov['province'];
    echo "</option>";
  }

  // echo "<pre>";
  // echo print_r($provinsi);
  // echo "</pre>";

}

?>
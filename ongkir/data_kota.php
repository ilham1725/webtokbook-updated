<?php


$id_prov = $_POST['id_provinsi'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_prov,
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
} else {

  $array_response = json_decode($response,TRUE);
  $kota = $array_response['rajaongkir']['results'];

  echo "<option> -- Kota / Kabupaten -- </option>";
  foreach ($kota as $key => $datakota) {
    echo "<option id_distrik='".$datakota['city_id']."'
                  nama_provinsi='".$datakota['province']."'
                  nama_distrik='".$datakota['city_name']."'
                  tipe_distrik='".$datakota['type']."'
                  kode_pos='".$datakota['postal_code']."'
            >";
    echo $datakota['type']." ";
    echo $datakota['city_name'];
    echo "</option>";
  }


  // echo "<pre>";
  // echo print_r($kota);
  // echo "</pre>";

}
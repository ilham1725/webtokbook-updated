<?php
include 'header.php';
include 'function.php';


if(empty($_SESSION['login']) OR !isset($_SESSION['login'])){

	echo	'<script>alert("Silahkan Login Terlebih Dahulu");window.location="login.php"</script>';
}
if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
  echo  '<script>alert("Silahkan Berbelanja Terlebih Dahulu");window.location="index.php"</script>';
}
?>




<div class="col mt-5">
	<section class="konten">
		<div class="container">
      <h2 class="text-center font-weight-bold m-4">Checkout</h2>
      <hr>
      <table class="table table-bordered">
       <thead>
        <tr>
         <th>No</th>
         <th>Judul</th>
         <th>Harga</th>
         <th>Jumlah</th>
         <th>Subharga</th>
       </tr>
     </thead>
     <tbody>
      <?php $no = 1;?>
      <?php $total_akhir = 0 ;?>
      <?php foreach ($_SESSION['keranjang'] as $id_buku => $jumlah) {
       $sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
       $row = $koneksi -> prepare($sql);
       $row -> execute();
       $hasil = $row -> fetchAll();
       foreach ($hasil as $pecah) {

         $subharga = $pecah['harga']*$jumlah;


         ?>
         <tr>
           <td><?php echo $no;?></td>
           <td><?php echo $pecah['judul'];?></td>
           <td>Rp.<?php echo number_format($pecah['harga']);?></td>
           <td><?php echo $jumlah;?></td>
           <td>Rp.<?php echo number_format($subharga);?></td>
         </tr>
         <?php $no++; 
         $total_akhir += $subharga;		}}?>
       </tbody>
       <tfoot>	
         <th colspan="4">	Total</th>
         <td>Rp.	<?php echo number_format($total_akhir); ?></td>
       </tfoot>

     </table>


     <form method="post">

      <div class="row">	

        <?php if (isset($_SESSION['akun'])) { ?>

          <div class="col-md-6">
           <h5 class="text-black">Nama </h5>
           <div class="form.group">
            <input type="text" name="nama" class="form-control" readonly value="<?php echo $_SESSION['akun']['nama']; ?>">
          </div>
        </div>
        <div class="col-md-6">
         <h5 class="text-black">No. telp </h5>
         <div class="form.group">
          <input type="text" name="telepon" class="form-control" readonly value="<?php echo $_SESSION['akun']['telepon']; ?>">
        </div>
      </div>
    <?php } else if(isset($_SESSION['newAkun'])) { ?>


      <div class="col-md-8">
        <h5 class="text-black">Nama </h5>
        <div class="form.group">
          <input type="text" name="nama" class="form-control" readonly value="<?php echo $_SESSION['newAkun']['nama']; ?>">
        </div>
      </div>
      <div class="col-md-8">
        <h5 class="text-black">No. telp </h5>
        <div class="form.group">
          <input type="text" name="telepon" class="form-control" readonly value="<?php echo $_SESSION['newAkun']['telepon']; ?>">
        </div>
      </div>

    <?php } ?>
  </div>
  <hr>
  <h2>Ongkir</h2>
  <div class="row">
    <div class="col-md-3 form-group">
      <label for="inputState">provinsi</label>
      <select class="form-control" name="provinsi">
              
      </select>
    </div>
    <div class="col-md-3 form-group">
      <label for="inputState">Kota</label>
      <select class="form-control" name="kota">
      </select>
    </div>
    <div class="col-md-3 form-group">
      <label for="inputState">Ekspedisi</label>
      <select class="form-control" name="ekspedisi"> 
      </select>
    </div>
    <div class="col-md-3 form-group">
      <label for="inputState">Paket</label>
      <select class="form-control" name="paket"> 
      </select>
    </div>
    <input type="hidden" name="berat" value="1200">
  </div>  




  <div class="row mt-2">	

    <div class="col">
     <h5 class="text-black">Alamat Lengkap </h5>
     <div class="form.group">
      <textarea class="form-control" name="alamat"></textarea>
    </div>
  </div>
</div>
<button class="btn btn-primary mt-2" name="checkout" >Checkout</button>
</form>

</div>

</section>


</div>

<?php
if (isset($_POST['checkout'])) {

  if(empty($_POST['id_ongkir']) || empty($_POST['alamat'])){

    echo '<script>alert("You Must Fill The Form");window.location="checkout.php";</script>';
  }

  else{
    if (isset($_SESSION['akun'])){

      $id_akun = $_SESSION['akun']['id_akun'];
      
    } else {

      $id_akun = $_SESSION['newAkun']['id_akun']; 

    }




    $id_ongkir = $_POST['id_ongkir'];
    $tanggal_transaksi = date("y-m-d");
    $alamat = $_POST['alamat'];

    $_SESSION['alamat'] = $alamat;

    $ambil = $koneksii->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
    $arrayongkir = $ambil->fetch_assoc();
    $tarif = $arrayongkir['biaya_ongkir'];

    $biaya = $total_akhir + $tarif;

    $koneksii->query("INSERT INTO transaksi(id_akun,id_ongkir,tanggal_transaksi,biaya,alamat,status) VALUES('$id_akun','$id_ongkir','$tanggal_transaksi','$biaya','$alamat','proses') ");

    $id_pembelian = $koneksii->insert_id;


    foreach ($_SESSION['keranjang'] as $id_buku => $jumlah) {

     $ambil = $koneksii->query("SELECT * FROM buku WHERE id_buku = '$id_buku'");
     $hasil = $ambil -> fetch_assoc();


     $koneksii->query("INSERT INTO pembelian(id_transaksi,id_akun,id_buku,jumlah,tanggal_pembelian) VALUES('$id_pembelian','$id_akun','$id_buku','$jumlah','$tanggal_transaksi')");

        // UPDATE STOK

     $koneksii -> query("UPDATE buku SET jumlah = jumlah - $jumlah WHERE id_buku = '$id_buku'");
   }
   $_SESSION['id_transaksi'] = $id_pembelian;

   echo  "<script>location='nota.php?id=$id_pembelian';</script>";
 }
}
?>
<!-- ini footer -->
<footer class="container-fluid mt-4 mb-4" style="margin-top: 10%; margin-bottom: 5%;"
>
<div class="row">

  <div class="col-md-12"> <h9 style="color: black;"><center>Copyrights © 2021 Ilham Gadang Murakabi. All Rights Reserved </h9></div>  

  </div>
</div>
</footer>

<script src="js/marvel/JQuery3.3.1.js"></script>

<script>
  
  $(document).ready(function() {
    $.ajax({
      type:'post',
      url:'ongkir/data_province.php',
      success:function(hasil_provinsi)
      {
        
       $("select[name=provinsi]").html(hasil_provinsi);
      }
    });
    
    $("select[name=provinsi]").on("change",function(){

      var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
      $.ajax({
        type:'post',
        url:'ongkir/data_kota.php',
        data:'id_provinsi='+id_provinsi_terpilih,
        success:function(hasil_kota)
        {
          $("select[name=kota]").html(hasil_kota);
        }
      });
    });
    $.ajax({
      type:'post',
      url:'ongkir/data_ekspedisi.php',
      success:function(hasil_ekspedisi)
      {
        $("select[name=ekspedisi]").html(hasil_ekspedisi);
      }
    });

    $("select[name=ekspedisi]").on("change",function(){

      var ekspedisi = $("select[name=ekspedisi]").val();

      var distrik = $("option:selected","select[name=kota]").attr("id_distrik");

      var berat = $("input[name=berat]").val();

      $.ajax({

        type:'post',
        url:'ongkir/data_paket.php',
        data:'ekspedisi='+ekspedisi+'&distrik='+distrik+'&berat='+berat,
        success:function(hasil_paket){

          $("select[name=paket]").html(hasil_paket);


        }

      });
    });
  });
</script>

</body>
</html>
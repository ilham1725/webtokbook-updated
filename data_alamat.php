<?php 	
require 'header.php';

?>



<body>
	<div class="container justify-content-center">
		<form method="post">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<h2 class="text-center mt-3" style="color: #2a0f4d;">Form Alamat</h2>
					<h2 class="text-center mt-3 mb-3" style="border-bottom: 2px solid #2a0f4d"></h2>
				</div>
			</div>
			<!-- <div class="row justify-content-center">
				<div class="col-md-10">
					<label>Alamat</label>
					<textarea class="form-control" name="alamat" placeholder="e.g. jl.nusantara selatan 3 no.91"></textarea>
				</div>					
			</div>
			<div class="row mt-3 justify-content-center">
				<div class="col-md-4">
					<label>RT</label>
					<input type="number" min="00" class="form-control" name="rt" placeholder="e.g. 007">
				</div>
				<div class="col-md-1">
					<label></label>
					<center><h1>/</h1></center>
				</div>
				<div class="col-md-4">
					<label>RW</label>
					<input type="number" min="00" class="form-control" name="RW" placeholder="e.g. 022">
				</div>
			</div> -->
			<div class="row mt-3 justify-content-center">
				<div class="col-md-5 form-group">
			      <label>provinsi</label>
			      <select class="form-control" name="provinsi">    
			      </select>
			    </div>
			    <div class="col-md-5 form-group">
			      <label>Kota</label>
			      <select class="form-control" name="kota">
			      </select>
			    </div>
			</div>
			<div class="row mt-3" style="margin-left:7%;">
				<div class="col-md-4">
					<input class="btn btn-primary" type="submit" id="kirim" name="kirim" value="Kirim">
				</div>
				
			</div>
		</form>

		<div class="row">
			<div class="col-md-12">
				<p id="tampil"> </p>
			</div>
			
		</div>
	</div>



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

		    $("input[name=kirim]").on("click",function(){
		    	var id_distrik = $("option:selected", "select[name=kota]").attr("id_distrik");
		    	var nama_provinsi = $("option:selected", "select[name=kota]").attr("nama_provinsi");
		    	var nama_distrik = $("option:selected", "select[name=kota]").attr("nama_distrik");
		    	var tipe_distrik = $("option:selected", "select[name=kota]").attr("tipe_distrik");
		    	var kode_pos = $("option:selected", "select[name=kota]").attr("kode_pos");
		    	$.ajax({
		    		type:'post',
		    		url:'proses/alamat_proses.php',
		    		data:'id_distrik='+id_distrik+'&nama_provinsi='+nama_provinsi+'&nama_distrik='+nama_distrik+'&tipe_distrik='+tipe_distrik+'&kode_pos='+kode_pos,
		    		success:function(hasil_kirim)
		    		{
		    		
		    			$("#tampil").html(hasil_kirim);
		    		}
		    	});
		    });	
		   }); 
	</script>
</body>
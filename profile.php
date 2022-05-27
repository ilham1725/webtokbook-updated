<?php
	include 'header.php';	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>

	<!-- Session akun -->
<?php if (isset($_SESSION['akun'])) { ?>
	<div class="container mt-3">
		<h2 class="text-center" style="border-bottom: 2px solid #2a0f4d">Informasi Profile</h2>
		<form method="post" enctype="multipart/form-data" action="update_profile.php">
			<div class="row justify-content-center mt-3">
				<div class="col-lg-6">
					 	<?php if(!isset($_SESSION['akun']['foto_akun']) && !isset($_SESSION['newAkun']['foto_akun']) || empty($_SESSION['akun']['foto_akun'])) { ?>

						      	<div class="container container-akun mr-auto" style="margin-left: 150px">
								   <img src="assets/img/foto_akun/img_avatar.png" alt="Avatar" class="image img-akun" style="width:70%">
								</div>
							
							
				      		
				      <?php } else if (isset($_SESSION['akun'])){ ?>
				      	
							 	<div class="container container-akun">
								  <img src="assets/img/foto_akun/<?php echo $_SESSION['akun']['foto_akun'];?>" alt="Avatar" class="image img-akun" style="width:100%">
								  <div class="middle">
								  	
								    	<a href="delete_foto.php" class="btni btn-danger mt-2"> Delete </a>
								    
								  </div>
								</div>
				      <?php } ?>
				      <h5>Foto</h5>
					<input class="form-control" type="file" name="foto" ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h2 class="text-center mt-3 mb-3" style="border-bottom: 2px solid #2a0f4d"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h5>Nama</h5>
					<input class="form-control" type="text" name="nama" value="<?php echo $_SESSION['akun']['nama'] ?>">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h5>Telepon</h5>
					<input class="form-control" type="text" name="telepon" value="<?php echo $_SESSION['akun']['telepon'] ?>">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h5>Username</h5>
					<input class="form-control" type="text" name="username" value="<?php echo $_SESSION['akun']['username'] ?>">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<button class="btn btn-primary mt-2"> Edit Profile </button>
				</div>
			</div>
		</form>

			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h2 class="text-center mt-3 mb-3" style="border-bottom: 2px solid #2a0f4d"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<a href="data_alamat.php" class="fa fa-plus-square-o fa-lg ml-2" aria-hidden="true" style="text-decoration:none;
								 color: #2a0f4d;">
					</a> 
					<br>
					<br>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>

	</div>
<?php } else {?>

<!-- Session NewAkun -->

		<div class="container mt-3">
		<h2 class="text-center" style="border-bottom: 2px solid #2a0f4d">Informasi Profile</h2>
		<form method="post" enctype="multipart/form-data" action="update_profile.php">
			<div class="row justify-content-center mt-3">
				<div class="col-lg-6">
					<?php if(!isset($_SESSION['akun']['foto_akun']) && !isset($_SESSION['newAkun']['foto_akun'])) { ?>

						      	<div class="container container-akun">
								   <img src="assets/img/foto_akun/img_avatar.png" alt="Avatar" class="image img-akun" style="width:70%">
								</div>
							
							
				      		
				      <?php }else if (isset($_SESSION['newAkun'])){ ?>
				      	
							 	<div class="container container-akun">
								  <img src="assets/img/foto_akun/<?php echo $_SESSION['newAkun']['foto_akun'];?>" alt="Avatar" class="image img-akun" style="width:100%">
								  <div class="middle">
								  	
								    	<a href="delete_foto.php" class="btni btn-danger mt-2"> Delete </a>
								    
								  </div>
								</div>
				      <?php } ?>

					<h5>Foto</h5>
					<input class="form-control" type="file" name="foto" ?>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h2 class="text-center mt-3 mb-3" style="border-bottom: 2px solid #2a0f4d"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h5>Nama</h5>
					<input class="form-control" type="text" name="nama" value="<?php echo $_SESSION['newAkun']['nama'] ?>">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h5>Telepon</h5>
					<input class="form-control" type="text" name="telepon" value="<?php echo $_SESSION['newAkun']['telepon'] ?>">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<h5>Username</h5>
					<input class="form-control" type="text" name="username" value="<?php echo $_SESSION['newAkun']['username'] ?>">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<button class="btn btn-primary mt-2"> Edit Profile </button>
				</div>
			</div>
		</form>
	</div>
<?php } ?> 
</body>
</html>
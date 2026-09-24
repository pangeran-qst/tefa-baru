<!doctype html>
<html lang="en">
  <head>
  	<title>Login Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="../assets/images/favicon.png" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="admin/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center" style="margin-top: -60px;">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">

		      	<center><a href="<?php echo e('/'); ?>"><img src="assets/images/favicon.png" alt="" style=" width: 35%;"></a></center>
		      	<h3 class="text-center mb-4">Log In</h3>

                
				<form action="<?php echo e(route('login.proses')); ?>" method="POST">

                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input  type="email" name="email" class="form-control rounded-left" placeholder="Username" required>
                        </div>
                    <div class="form-group d-flex">
                        <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                    </div>
                    <br>
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group d-md-flex">
                                
                    </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

p
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/login.blade.php ENDPATH**/ ?>
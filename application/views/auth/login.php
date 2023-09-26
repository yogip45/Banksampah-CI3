<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" href="<?= base_url()?>assets/logo/logo.png" type="image/png">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login Cikrak</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/my-login.css')?>">
	<style>
            .centered-header {
                text-align: center;
            }
            .aksi-column {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .aksi-column button {
                margin: 0 5px; /* Sesuaikan jarak antara tombol jika diperlukan */
            }
            .loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #eeeeee;
                z-index: 9999;
                transition: opacity 0.75s, visibility 0.75s;
            }

            .loader::after{
                content: "";
                width: 75px;
                height: 75px;
                border: 8px solid #dddddd;
                border-top-color: #286090;
                border-radius: 50%;
                animation: loading 0.75s ease infinite;

            }

            .loader--hidden {
                opacity: 0;
                visibility: hidden;
            }
            @keyframes loading {
                from { transform: rotate(0turn);}
                to { transform: rotate(1turn);}
            }
        </style>
</head>
<div class="loader"></div>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?php echo base_url()?>assets/logo/logo.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
								<?php if ($this->session->flashdata('message')): ?>
                  <div class="alert alert-danger"><?php echo $this->session->flashdata('message'); ?></div>
                <?php endif; ?>
								<?php if ($this->session->flashdata('recaptcha_error')): ?>
                  <div class="alert alert-danger"><?php echo $this->session->flashdata('recaptcha_error'); ?></div>
                <?php endif; ?>
								<?php if ($this->session->flashdata('sukses')): ?>
                  <div class="alert alert-success"><?php echo $this->session->flashdata('sukses'); ?></div>
                <?php endif; ?>
							<h4 class="card-title">Login</h4>
							<form method="POST" action="<?=base_url('/index.php/auth') ?>" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="username">Username / Email</label>
									<input id="username" type="text" class="form-control" name="email" value="" required autofocus>
									<?= form_error('email','<small class=" text-danger">', '</small>') ?>
									<div class="invalid-feedback">
											Username harus diisi
									</div>
								</div>
								<div class="form-group">
									<label for="password">Password
									</label>
									<input id="password" type="password" class="form-control" name="password" value="" required data-eye>
									<?= form_error('password','<small class=" text-danger">', '</small>') ?>
								    <div class="invalid-feedback">
								    	Password harus diisi
							    	</div>
								</div>
								<?php if ($this->session->userdata('login_attempts') >= 3): ?>
										<div class="form-group col-lg-12">
												<div class="row">
														<div>
																<label for="captcha">Captcha</label>
																<!-- reCaptcha widget -->
																<?php echo $widget;?>
																<?php echo $script;?>
														</div>
												</div>
										</div>
								<?php endif; ?>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<!-- <div class="mt-4 text-center">
									Don't have an account? <a href="register.html">Create One</a>
								</div> -->
							</form>
						</div>
					</div>
					<!-- <div class="footer">
						Copyright &copy; 2017 &mdash; Your Company 
					</div> -->
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="<?php echo base_url()?>assets/js/my-login.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- LOADING SCREEN -->
	<script>
			const loader = document.querySelector(".loader");
			window.addEventListener("load",() => {
					loader.classList.add("loader--hidden");
					loader.addEventListener("transitioned", ()=>{
							document.body.removeChild(document.querySelector(".loader"));
					});
			})
	</script>
	<!-- LOADING SCREEN -->
	<!-- HIDE ALERT -->
	<script>
		window.setTimeout(function () {
		$(".alert")
			.fadeTo(500, 0)
			.slideUp(500, function () {
				$(this).remove();
			});
	}, 3000);
	</script>
	<!-- HIDE ALERT -->
</body>
</html>

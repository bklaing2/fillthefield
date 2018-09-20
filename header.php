<?php
	@session_start();
?>

<!doctype html>
<html>
	<head>
		<title>Fill the Field</title>

		<link rel="icon" href="logo_small.png">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--<link rel="stylesheet" href="css/main.css">-->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	</head>

	<body style="background-color: #000; background-image: url('Background Image.jpg'); background-size: 100vw 100vh;">
		<header>
			<nav class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar" style="background-color: #500000;">
				<div class="collapse navbar-collapse" id="navbarText">
					<a class="navbar-brand d-none d-md-block" href="http://fillthefield.com">
						<img src="logo.png" width="50" height="50" style="background-size: cover;" alt="">
					</a>
					<ul class="navbar-nav mr-auto float-left">
						<li>
							<a class="navbar-brand d-none d-sm-block" href="http://fillthefield.com"><em>Fill the Field</em></a>
						</li>
						<li class="nav-item d-none d-sm-block">
							<span class="navbar-text">|</span>
						</li>
						<li class="nav-item <?php if($page == 0.0) {echo 'active'; } ?>">
							<a class="nav-link" href="http://fillthefield.com">Home</a>
						</li>
						<li class="nav-item <?php if($page == 1) {echo 'active'; } ?>">
							<a class="nav-link" href="tickets">Tickets</a>
						</li>
						<li class="nav-item <?php if($page == 2.0) {echo 'active'; } ?>">
							<a class="nav-link" href="messages"><span class="d-none d-inline">Messages&nbsp;<span class="badge badge-light"><?php include_once 'includes/messages/inc.messages.unread.php'; ?></span></span></a>
						</li>	
					</ul>
					<ul class="navbar-nav float-right">
						<li class="nav-item">
							<?php
								if (isset($_SESSION['id']))
									echo '<a class="nav-link" href="includes/login/inc.login.logout.php">Logout</a>';
								else
									echo '<a class="nav-link" href="login">Login</a></li>
									<li class="d-none d-sm-block"><a class="nav-link" href="sign-up">Sign&nbsp;Up</a></li>';
							?>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="container-fluid text-light">
			<?php //include_once 'ad-1.php'; ?>
			<div class="row justify-content-center">
				<?php //include_once 'ad-2.php'; ?>
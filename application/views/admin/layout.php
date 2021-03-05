<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>ViewMyLicense Dashboard</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables/dataTables.bootstrap.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/datepicker/datepicker3.css">

		<!-- Theme style -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/_all-skins.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/vml.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <!-- jQuery 2.2.3 -->
		<script src="<?= base_url() ?>assets/js/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
        <script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="<?= base_url() ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/js/datatables/dataTables.bootstrap.min.js"></script>

		<!-- bootstrap datepicker -->
		<script src="<?= base_url() ?>assets/js/datepicker/bootstrap-datepicker.js"></script>

		<!-- FastClick -->
		<!-- <script src="../../plugins/fastclick/fastclick.js"></script> -->
		<!-- AdminLTE App -->
		<script src="<?= base_url() ?>assets/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="<?= base_url() ?>assets/js/demo.js"></script>

		<script src="<?= base_url() ?>assets/js/vml.js"></script>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="../../index2.html" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>VML</b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>ViewMyLicense</b></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="hidden-xs"><?php echo $_SESSION['email']?></span>
								</a>
								<ul class="dropdown-menu">
								<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-right">
										<a href="/login" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="treeview <?php echo $root_menu == 'customers' ? 'active' : '' ?>">
							<a href="/admin/employers_import">
                                <i class="fa fa-institution"></i> <span>Customers</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
							</a>
							<ul class="treeview-menu">
								<li class="<?php echo $sub_menu == 'customer_add' ? 'active' : '' ?>"><a href="/admin/customer_add"><i class="fa fa-circle-o"></i> Add </a></li>
								<li class="<?php echo $sub_menu == 'customer_list' ? 'active' : '' ?>"><a href="/admin/customer_list"><i class="fa fa-circle-o"></i> List </a></li>
							</ul>
                        </li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
                <?php 
                $this->view($view);
                ?>
				<div class="overlay-wrapper">
					<div class="overlay">
						<i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
	</body>
</html>
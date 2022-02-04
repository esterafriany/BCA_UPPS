
<!doctype html>
<html lang="en">

  <?php
  if(isset($_SESSION['timestamp']) AND time() - $_SESSION['timestamp'] > 1800)
  {
  session_unset();
   ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'User_Authentication/Logout';
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
  }
  else
  {
   $_SESSION['timestamp'] = time(); //set new timestamp
  }
  $namadepan = ($this->session->userdata['logged_in']['namadepan']);
  $ID = ($this->session->userdata['logged_in']['UserID']);
  $RoleID = ($this->session->userdata['logged_in']['RoleID']);
  $UserID = ($this->session->userdata['logged_in']['UserID']);
  ?>
<head>
  <title>UUPS</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.min.css">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png">

</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- SIDEBAR -->
	<div class="sidebar">

		<?php
			if($RoleID==1 OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
			{
		?>
    <script src="<?php echo base_url(); ?>assets/js/jquery/jquery.min.js"></script>
		<div class="brand">
        <a href="<?php echo base_url();?>MasterAdmin/views/home"><img src="<?php echo base_url(); ?>assets/img/bca.png" class="img-responsive logo"></a>
      </div>
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
					<?php
					if(strcmp($_SERVER["REQUEST_URI"],'/UPPS/MasterAdmin/views/home')==0 OR strcmp($_SERVER["REQUEST_URI"],'/UPPS/user_authentication/user_login_process')==0)
					{
						?>
						<li><a href="<?php echo base_url(); ?>MasterAdmin/views/home" class="active"><i class="fa fa-home"></i> <span>Home</span></a></li>
						<li>
						<?php
					}
					else
					{
						?>
						<li><a href="<?php echo base_url(); ?>MasterAdmin/views/home" class=""><i class="fa fa-home"></i> <span>Home</span></a></li>
						<li>
						<?php
					}
					if(strcmp(substr($_SERVER["REQUEST_URI"],0,28),'/UPPS/MasterAdmin/go_manages')==0)
					{
						?>
						 <a href="#subPages" data-toggle="collapse" class="collapsed active">
						<?php
					}
					else
					{
						?>
						 <a href="#subPages" data-toggle="collapse" class="collapsed">
						<?php
					}
					?>
				<i class="fa fa-database"></i> <span>Master Data</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
			  </a>
              <div id="subPages" class="collapse ">
                <ul class="nav">
                  <li><a href="<?php echo base_url(); ?>MasterAdmin/go_manages?tipe=Program" class=""><i class="lnr lnr-file-empty"></i>Program</a></li>
                  <li><a href="<?php echo base_url(); ?>MasterAdmin/go_manages?tipe=Room" class=""><i class="lnr lnr-file-empty"></i>Room</a></li>
                  <li><a href="<?php echo base_url(); ?>MasterAdmin/go_manages?tipe=Hotels" class=""><i class="lnr lnr-file-empty"></i>Hotel</a></li>
				  <li><a href="<?php echo base_url(); ?>MasterAdmin/go_manages?tipe=ShuttlePoint" class=""><i class="lnr lnr-file-empty"></i>Shuttle Point</a></li>
                </ul>
              </div>
            </li>
						
			<li>
			<?php 
			if(strcmp(substr($_SERVER["REQUEST_URI"],11,20),'go_adds?tipe=NewForm')==0 OR strcmp(substr($_SERVER["REQUEST_URI"],11,13),'add_Pemesanan')==0)
					{
						?>
						<a href="<?php echo base_url('Koor/go_adds?tipe=NewForm'); ?>" class="active"><i class="fa fa-file"></i> <span>New Form</span></a>
						<?php
					}
					else
					{
						?>
						<a href="<?php echo base_url('Koor/go_adds?tipe=NewForm'); ?>"><i class="fa fa-file"></i> <span>New Form</span></a>
						<?php
					}
			?>
			
			</li>
			<li>
			<?php
			if(strcmp(substr($_SERVER["REQUEST_URI"],6,23),"MasterAdmin/view_Recaps")==0 OR strcmp(substr($_SERVER["REQUEST_URI"],6,16),"Koor/view_Recaps")==0)
			{
				?>
				<a href="#subPages2" data-toggle="collapse" class="collapsed active">
				<?php
			}
			else
			{
				?>
				<a href="#subPages2" data-toggle="collapse" class="collapsed">
				<?php
			}
			?>
				<i class="fa fa-files-o"></i> <span>Rekap Proses</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
			  </a>
              <div id="subPages2" class="collapse ">
                <ul class="nav">
				  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=All" class="notification-item"><i class="fa fa-list"></i></span>All</a></li>
                  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Classes" class="notification-item"><i class="lnr lnr-apartment"></i></span>Kelas</a></li>
				  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Consumption" class="notification-item"><i class="fa fa-cutlery"></i>Konsumsi</a></li>
				  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Hotels" class="notification-item"><i class="fa fa-building-o"></i>Hotel</a></li>
				  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=ShuttleBus" class="notification-item"><i class="fa fa-bus"></i>Shuttle Bus</a></li>
				  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=AirportShuttle" class="notification-item"><i class="fa fa-plane"></i>Bus Bandara</a></li>
                </ul>
              </div>
            </li>
			<li>
			<?php 
					if(strcmp($_SERVER["REQUEST_URI"],"/UPPS/History")==0)
					{
						?>
						<a href="<?php echo base_url(); ?>History" class="active"><i class="fa fa-history"></i> <span>History</span></a></li>
						<?php						
					}
					else
					{
						?>
						<a href="<?php echo base_url(); ?>History"><i class="fa fa-history"></i> <span>History</span></a></li>
						<?php
					}
					?>
			

          </ul>
        </nav>
      </div>
		<?php
			}
			else if($RoleID==2)
			{
			?>
				<script src="<?php echo base_url(); ?>assets/js/jquery/jquery.min.js"></script>
				<div class="brand">
				
				<a href="<?php echo base_url();?>Koor/views/home"><img src="<?php echo base_url(); ?>assets/img/bca.png" class="img-responsive logo"></a>
			  </div>
			  <div class="sidebar-scroll">
				<nav>
				  <ul class="nav">
					<li>
					<?php
				if(strcmp($_SERVER["REQUEST_URI"],'/UPPS/Koor/views/home')==0 OR strcmp($_SERVER["REQUEST_URI"],'/UPPS/user_authentication/user_login_process')==0)
					{
						?>
						<a href="<?php echo base_url(); ?>Koor/views/home" class="active"><i class="fa fa-home"></i> <span>Home</span></a>
						<?php
					}
					else
					{
						?>
						<a href="<?php echo base_url(); ?>Koor/views/home" class=""><i class="fa fa-home"></i> <span>Home</span></a>
						<?php
					}
				?>
					
					</li>
					<li>
					<?php 
				if(strcmp($_SERVER["REQUEST_URI"],'/UPPS/Koor/go_adds?tipe=NewForm')==0)
					{
						?>
						<a href="<?php echo base_url('Koor/go_adds?tipe=NewForm'); ?>" class="active"><i class="fa fa-file"></i> <span>New Form</span></a>
						<?php
					}
					else
					{
						// echo($_SERVER["REQUEST_URI"]);
						?>
						<a href="<?php echo base_url('Koor/go_adds?tipe=NewForm'); ?>"><i class="fa fa-file"></i> <span>New Form</span></a>
						<?php
					}
				?>
					
					</li>
					<li>
						<?php 
				if(strcmp(substr($_SERVER["REQUEST_URI"],0,22),'/UPPS/Koor/view_Recaps')==0)
					{
						?>
						<a href="#subPages2" data-toggle="collapse" class="collapsed active">
						<?php
					}
					else
					{
						// echo($_SERVER["REQUEST_URI"]);
						?>
						<a href="#subPages2" data-toggle="collapse" class="collapsed">
						<?php
					}
				?>
					  
						<i class="fa fa-files-o"></i> <span>Rekap Proses</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
					  </a>
					  <div id="subPages2" class="collapse ">
						<ul class="nav">
						  <li><a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=All" class="notification-item"><i class="fa fa-list"></i></span>All</a></li>
						  <li><a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=Classes" class="notification-item"><i class="lnr lnr-apartment"></i></span>Kelas</a></li>
						  <li><a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=Consumption" class="notification-item"><i class="fa fa-cutlery"></i></i>Konsumsi</a></li>
						  <li><a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=Hotels" class="notification-item"><i class="fa fa-building-o"></i></i>Hotel</a></li>
						  <li><a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=ShuttleBus" class="notification-item"><i class="fa fa-bus"></i>Shuttle Bus</a></li>
						  <li><a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=AirportShuttle" class="notification-item"><i class="fa fa-plane"></i>Bus Bandara</a></li>
						</ul>
					  </div>
					</li>
          <li>
					<?php 
				if(strcmp($_SERVER["REQUEST_URI"],'/UPPS/History')==0)
					{
						?>
						<a href="<?php echo base_url(); ?>History" class="active"><i class="fa fa-history"></i> <span>History</span></a>
						<?php
					}
					else
					{
						// echo($_SERVER["REQUEST_URI"]);
						?>
						<a href="<?php echo base_url(); ?>History"><i class="fa fa-history"></i> <span>History</span></a>
						<?php
					}
				?>
					
					</li>

				  </ul>
				</nav>
			  </div>
			<?php
			}
			else if($RoleID==3)
			{
				?>
				<script src="<?php echo base_url(); ?>assets/js/jquery/jquery.min.js"></script>
				<div class="brand">
				
				<a href="<?php echo base_url();?>MasterAdmin/views/home"><img src="<?php echo base_url(); ?>assets/img/bca.png" class="img-responsive logo"></a>
			  </div>
			  <div class="sidebar-scroll">
				<nav>
				  <ul class="nav">
					<?php 
					if(strcmp($_SERVER["REQUEST_URI"],'/UPPS/MasterAdmin/views/home')==0 OR strcmp($_SERVER["REQUEST_URI"],'/UPPS/user_authentication/user_login_process')==0)
					{
						?>
						<li><a href="<?php echo base_url(); ?>MasterAdmin/views/home" class="active"><i class="fa fa-home"></i> <span>Home</span></a></li>
						<li>
						<?php
					}
					else
					{
						?>
						<li><a href="<?php echo base_url(); ?>MasterAdmin/views/home" class=""><i class="fa fa-home"></i> <span>Home</span></a></li>
						<li>
						<?php
					}
				?>
					
					<li>
					<?php
			if(strcmp(substr($_SERVER["REQUEST_URI"],6,23),"MasterAdmin/view_Recaps")==0 OR strcmp(substr($_SERVER["REQUEST_URI"],6,16),"Koor/view_Recaps")==0)
			{
				?>
					  <a href="#subPages2" data-toggle="collapse" class="collapsed active">
				<?php
			}
			else
			{
				?>
					  <a href="#subPages2" data-toggle="collapse" class="collapsed">
				<?php
			}
			?>
						<i class="fa fa-files-o"></i> <span>Rekap Proses</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
					  </a>
					  <div id="subPages2" class="collapse ">
						<ul class="nav">
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=All" class="notification-item"><i class="fa fa-list"></i></span>All</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Classes" class="notification-item"><i class="lnr lnr-apartment"></i></span>Kelas</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Consumption" class="notification-item"><i class="fa fa-cutlery"></i></i>Konsumsi</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Hotels" class="notification-item"><i class="fa fa-building-o"></i></i>Hotel</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=ShuttleBus" class="notification-item"><i class="fa fa-bus"></i></i>Shuttle Bus</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=AirportShuttle" class="notification-item"><i class="fa fa-plane"></i>Bus Bandara</a></li>

						</ul>
					  </div>
					</li>
					<li>
					<?php 
						if(strcmp($_SERVER["REQUEST_URI"],"/UPPS/History")==0)
					{
						?>
						<a href="<?php echo base_url(); ?>History" class="active"><i class="fa fa-history"></i> <span>History</span></a>
						<?php						
					}
					else
					{
						?>
						<a href="<?php echo base_url(); ?>History"><i class="fa fa-history"></i> <span>History</span></a>
						<?php
					}
					?>
					
					</li>

				  </ul>
				</nav>
			  </div>
				<?php
			}
			else if($RoleID==4)
			{?>
				<div class="brand">
				<a href="<?php echo base_url();?>MasterAdmin/views/home"><img src="<?php echo base_url(); ?>assets/img/bca.png" class="img-responsive logo"></a>
			  </div>
			  <div class="sidebar-scroll">
				<nav>
				  <ul class="nav">
					<?php
					if(strcmp($_SERVER["REQUEST_URI"],'/UPPS/MasterAdmin/views/home')==0 OR strcmp($_SERVER["REQUEST_URI"],'/UPPS/user_authentication/user_login_process')==0)
					{
						?>
						<li>
					<a href="<?php echo base_url(); ?>MasterAdmin/views/home" class="active"><i class="lnr lnr-home"></i> <span>Home</span></a>
					</li>
						<?php
					}
					else
					{
						?>
						<li>
					<a href="<?php echo base_url(); ?>MasterAdmin/views/home" class=""><i class="lnr lnr-home"></i> <span>Home</span></a>
					</li>
						<?php
					}
					?>
					
					<li>
					<?php
			if(strcmp(substr($_SERVER["REQUEST_URI"],6,23),"MasterAdmin/view_Recaps")==0 OR strcmp(substr($_SERVER["REQUEST_URI"],6,16),"Koor/view_Recaps")==0)
			{
				?>
					  <a href="#subPages2" data-toggle="collapse" class="collapsed active">
				<?php
			}
			else
			{
				?>
					  <a href="#subPages2" data-toggle="collapse" class="collapsed">
				<?php
			}
			?>
						<i class="fa fa-files-o"></i> <span>Rekap Proses</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
					  </a>
					  <div id="subPages2" class="collapse ">
						<ul class="nav">
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=All" class="notification-item"><i class="fa fa-list"></i></span>All</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Classes" class="notification-item"><i class="lnr lnr-apartment"></i></span>Kelas</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Consumption" class="notification-item"><i class="fa fa-cutlery"></i></i>Konsumsi</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Hotels" class="notification-item"><i class="fa fa-building-o"></i>Hotel</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=ShuttleBus" class="notification-item"><i class="fa fa-bus"></i>Shuttle Bus</a></li>
						  <li><a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=AirportShuttle" class="notification-item"><i class="fa fa-plane"></i>Bus Bandara</a></li>
						</ul>
					  </div>
					</li>
					<li>
					<?php 
						if(strcmp($_SERVER["REQUEST_URI"],"/UPPS/History")==0)
					{
						?>
						<a href="<?php echo base_url(); ?>History" class="active"><i class="fa fa-history"></i> <span>History</span></a>
						<?php						
					}
					else
					{
						?>
						<a href="<?php echo base_url(); ?>History"><i class="fa fa-history"></i> <span>History</span></a>
						<?php
					}
					?>
					</li>

				  </ul>
				</nav>
			  </div>
			<?php } ?>
    </div>
    <!-- END SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
      <!-- NAVBAR -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
          </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
              <span class="sr-only">Toggle Navigation</span>
              <i class="fa fa-bars icon-nav"></i>
            </button>
          </div>
          <div id="navbar-menu" class="navbar-collapse collapse">
            <!--<form class="navbar-form navbar-left hidden-xs">
              <div class="input-group">
                <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
              </div>
            </form>-->
            <ul class="nav navbar-nav navbar-right">
				<li>
				
					<?php if($RoleID==2) { ?>
					
					<?php if(isset($_SESSION["jlh_notifikasi"]) && $_SESSION["jlh_notifikasi"] != NULL)
					{
					  ?>
						<a href="<?php echo base_url(); ?>MasterAdmin/notification?UserID=<?php echo $UserID; ?>"><i class="lnr lnr-inbox"></i>Notification
							<span class="label label-danger">
								<?php echo $_SESSION["jlh_notifikasi"];  ?>
							</span>
						</a>
					  <?php
					}
					else {
					  ?>
					  <a href="#"><i class="fa fa-bell-o"></i>Notification</a>
					  <?php
					}
					?>
					<?php } ?>
				</li>
              <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><span><?=$namadepan?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                <ul class="dropdown-menu">
				<?php
					if($RoleID==1 OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
					{
					?>
						<li><a href="<?php echo base_url(); ?>MasterAdmin/go_manages?tipe=User"><i class="fa fa-users"></i> <span>Manage Users</span></a></li>
						<li><a href="<?php echo base_url(); ?>MasterAdmin/go_changePass?ID=<?=$ID?>"><i class="fa fa-wrench"></i> <span>Change Password</span></a></li>
						<li class="divider"></li>
					<?php
					}
          else { ?>
						<li><a href="<?php echo base_url(); ?>Koor/go_changePass?ID=<?=$ID?>"><i class="fa fa-wrench"></i> <span>Change Password</span></a></li>
						<li class="divider"></li>
					<?php
					}
					?>
					<li><a href="<?php echo base_url(); ?>User_Authentication/Logout"><i class="fa fa-power-off"></i> <span>Log out</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- END NAVBAR -->
	  <?php

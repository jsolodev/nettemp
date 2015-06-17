<?php 
include("modules/login/login.php");
ob_start();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$dbfile='dbf/nettemp.db';
if ( '' == file_get_contents( $dbfile ) )
{ ?>
<html>
<h1><font color="blue">nettemp.pl</font></h2>
<h2><font color="red">Database not found <?php echo $dbfile; ?></font></h2>
<h3>Go to shell and reset/create nettemp database:<h3>
/var/www/nettemp/modules/tools/db_reset <br />
</html>
<?php }
else {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>nettemp</title>

    <!-- Bootstrap -->
    <link href="jscss/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jscss/custom.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="jscss/jquery/jquery.js"></script>

    <!-- bootstrap-toogle -->
    <link href="jscss/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <script type="text/javascript" src="jscss/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

 



 </head>
<body>

 <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
		<a href="http://nettemp.pl" target="_blank"><img src="media/png/nettemp.pl.png" height="50"></a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
	              </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li <?php echo $id == 'status' ? ' class="active"' : ''; ?>><a href="status">Status</a></li>
              <li <?php echo $id == 'view' ? ' class="active"' : ''; ?>><a href="view">Charts </a></li>
              <?php if(isset($_SESSION["user"])) {?>
	      <li<?php echo $id == 'devices' ? ' class="active"' : ''; ?>><a href="devices">Devices</span></a></li>
	      <li <?php echo $id == 'notification' ? ' class="active"' : ''; ?>><a href="notification">Notification</span></a></li>
	      <li <?php echo $id == 'security' ? ' class="active"' : ''; ?>><a href="security">Security</span></a></li>
	      <li <?php echo $id == 'settings' ? ' class="active"' : ''; ?>><a href="settings">Settings</span></a></li>
	      <li <?php echo $id == 'tools' ? ' class="active"' : ''; ?>><a href="tools">Tools</span></a></li>
		<?php } ?>
		<li <?php echo $id == 'info' ? ' class="active"' : ''; ?>><a href="info">Info</a></li>


            </ul>

    <?php if(!isset($_SESSION["user"])) {?>
	    <form action="" method="post" class="navbar-form navbar-right" >
            <div class="form-group">
              <input type="text" name="username" placeholder="User" class="form-control input-sm">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control input-sm">
            </div>
	    <input type="hidden" name="form_login" value="log">
            <button type="submit" class="btn-xs btn-primary">Sign in</button>
          </form>        
    <?php } ?>
    <?php if(isset($_SESSION["user"])) {?>
	<form action="" method="post" class="navbar-form navbar-right" >
	    <a href="logout"><button type="button" class="btn-xs btn-success">Log Out</button></a>
	</form>        
    <?php } ?>
    	</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
        </nav>
 

<div class="container">


<?php  
switch ($id)
{ 
default: case '$id': include('modules/status/html/status.php'); break;
case 'view': include('modules/view/html/view.php'); break;
case 'devices': include('modules/devices/html/devices.php'); break;
case 'notification': include('modules/notification/html/notification.php'); break;
case 'security': include('modules/security/html/security.php'); break;
case 'settings': include('modules/settings/settings.php'); break;
case 'tools': include('modules/tools/html/tools.php'); break;
case 'info': include('modules/info/info.php'); break;
case 'denied': include('modules/login/denied.php'); break;
case 'logout': include('modules/login/logout.php'); break;
case 'diag': include('modules/tools/html/tools_file_check.php'); break;
case 'upload': include('modules/tools/backup/html/upload.php'); break;
case 'receiver': include('modules/sensors/html/receiver.php'); break;
case 'espupload': include('modules/sensors/wireless/espupload/espupload.php'); break;

}
?>





</div>




<footer class="footer">
      <div class="container text-center">
        <p class="text-muted"><table><tr>Donate for developing <?php include('modules/info/paypal.php'); ?> build <?php passthru("/usr/bin/git branch |grep [*]|awk '{print $2}' && awk '/Changelog/{y=1;next}y' readme.md |head -2 |grep -v '^$'"); ?>| System time <?php $today=date("H:i:s"); echo $today;?></tr></table></p>
      </div>
    </footer>

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
    <script src="jscss/bootstrap/js/bootstrap.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->


  </body>
</html>



<?php } 
?>

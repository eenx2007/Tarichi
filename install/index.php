<?php

error_reporting(E_NONE);

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod /application/config/database.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = "http://".$_SERVER['HTTP_HOST'];
			$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
			header( 'Location: ' . $redir ) ;
		}

	}
	else {
		$message = $core->show_message('error','The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../blueprint/mystyle.css"/>
        <link rel="stylesheet" type="text/css" href="../blueprint/buttons_icon.css"/>
        <link rel="stylesheet" type="text/css" href="../blueprint/screen.css"/>
		<title>Tarichi 2.0 Installation</title>

		
	</head>
	<body>
	<div class="container">
    	<div id="header" class="span-24">
        	<div id="logo" class="span-3">
            	<img src="../blueprint/images/logo.png" width="100" height="50" />
            </div>
            <div id="menu_atas" class="span-20">
            	<ul>
                	<li><a href="#">Tarichi 2.0 Installation</a></li>
                </ul>
            </div>
        </div>
        <div id="breadcrumb" class="span-19">
			<span class="the_bread_item"><a href="#">Please Fill Form Belom</a></span><?php if(isset($message)) {echo '<span class="the_bread_item">' . $message . '</span>';}?>
        </div>
        <div id="content">
        <?php if(is_writable($db_config_path)):?>
    
             
    
              <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="formbox span-6">
                <div class="formboxtitle">
                  Database Setting
                </div>
                
                <div class="formboxitem">
                    <label for="hostname">Hostname</label><br /><input type="text" id="hostname" value="localhost" class="input_text" name="hostname" />
                </div>
                <div class="formboxitem">
                  <label for="username">Username</label><br /><input type="text" id="username" class="input_text" name="username" />
                </div>
                <div class="formboxitem">
                  <label for="password">Password</label><br /><input type="password" id="password" class="input_text" name="password" />
                </div>
                <div class="formboxitem">
                  <label for="database">Database Name</label><br /><input type="text" id="database" class="input_text" name="database" />
                </div>
               
           	</div>
            <div class="formbox span-6">
            	<div class="formboxtitle">
                	Site Configuration
                </div>
                <div class="formboxitem">
                	<label>Admin Username</label><br />
                    <input type="text" name="admin_username" id="admin_username" />
                </div>
                <div class="formboxitem">
                	<label>Password</label><br />
                    <input type="password" name="admin_password" id="admin_password" />
                </div>
                <div class="formboxitem">
                	<label>Site Name</label><br />
                    <input type="text" name="site_name" id="site_name" />
                </div>
                 <div class="formboxitem">
                  <label>Are you ready ? </label><br />
                  <input type="submit" value="Install" id="submit" class="btnmerah" />
                </div>
            </div>
              </form>
    
          <?php else: ?>
          <div class="span-24">
          <p class="error">Please make the /system/application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 system/application/config/database.php</code></p>
          </div>
          <?php endif; ?>
       </div>
	</div>
	</body>
</html>


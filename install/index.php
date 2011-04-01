<? session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../assets/blueprint/mystyle.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/blueprint/buttons_icon.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/blueprint/screen.css"/>
    <title>Tarichi 2.0 Installation</title>
<?php
	//error_reporting(E_NONE);
	$db_config_path = '../application/config/database.php';
	$the_page_message='';
	$the_page_type='';
	if(isset($_GET['page_type']))
	{
		$the_page_type=$_GET['page_type'];
		if($the_page_type=='step1')
		{
			$the_page_message='Step 1 : Set your database configuration';
			if($_POST)
			{
				
				require_once('includes/core_class.php');
				require_once('includes/database_class.php');
				$core = new Core();
				$database = new Database();
				if($core->validate_post($_POST)==true)
				{
					$success=true;
					if($database->create_database($_POST) == false) {
						$the_page_message = 'Step 1 : <font color="red">The database could not be created, please verify your settings.';
						$success=false;
					} else if ($database->create_tables($_POST) == false) {
						$the_page_message = 'Step 1 : The database tables could not be created, please verify your settings.';
						$success=false;
					} else if ($core->write_config($_POST) == false) {
						$the_page_message = 'Step 1 : The database configuration file could not be written, please chmod /application/config/database.php file to 777.';
						$success=false;
					}
					if($success==true)
					{
						$host  = $_SERVER['HTTP_HOST'];
						$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
						$_SESSION['hostname']=$_POST['hostname'];
						$_SESSION['username']=$_POST['username'];
						$_SESSION['password']=$_POST['password'];
						$_SESSION['database']=$_POST['database'];
						echo '<meta http-equiv="refresh" content="0;url=index.php?page_type=step2" />';	
					}
				}
				else
				{
					$the_page_message='Step 1 : <font color="red">Please check your settings, make sure to fill all the form!!</font>';					
				}
			}
				
		}
		elseif($the_page_type=='step2')
		{
			$the_page_message='Step 2 : Set Site Configuration';	
			if($_POST)
			{
				require_once('includes/core_class.php');
				require_once('includes/database_class.php');
				$core = new Core();
				$database = new Database();
				if($core->validate_config($_POST)==true)
				{
					$success=true;
					if($database->set_config($_POST) == false)
					{
						$the_page_message = 'Step 2 : <font color="red">Fail to set your default configuration.';
					}
					else
					{
						echo '<meta http-equiv="refresh" content="0;url=index.php?page_type=step3" />';	
					}
				}
				else
				{	
					$the_page_message='Step 2 : <font color="red">Make sure to fill all the form!!</font>';
				}
			}
		}
	}
	else
	{
		$the_page_message="Welcome to Tarichi 2.0 Installation";
		$the_page_type='welcome';
	}
?>

</head>
<script type="text/javascript" src="../assets/jquery/jquery-1.5.min.js"></script>
<script type="text/javascript" src="../assets/jquery/jquery.hoverIntent.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#right_content').height($('html').height());	
	$('#left_content ul li ul').show();
	
});
</script>
<style>
	body{
		line-height:2em;	
	}
	
	.button {
		 border-top: 1px solid #96d1f8;
		 background: #65a9d7;
		 background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
		 background: -moz-linear-gradient(top, #3e779d, #65a9d7);
		 padding: 7px 14px;
		 -webkit-border-radius: 8px;
		 -moz-border-radius: 8px;
		 border-radius: 8px;
		 -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
		 -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
		 box-shadow: rgba(0,0,0,1) 0 1px 0;
		 text-shadow: rgba(0,0,0,.4) 0 1px 0;
		 color: white;
		 font-size: 13px;
		 font-family: Georgia, Serif;
		 text-decoration: none;
		 vertical-align: middle;
		 }
	  .button:hover {
		 border-top-color: #28597a;
		 background: #28597a;
		 color: #ccc;
		 }
	  .button:active {
		 border-top-color: #1b435e;
		 background: #1b435e;
		 }
	   .small{
		   padding-left:30px;
		   display:none;
		   color:#FFF;
		   margin-left:40px;
		   margin-top:-10px;
		   position:absolute;
		   	 padding: 7px 14px;
		 -webkit-border-radius: 8px;
		 -moz-border-radius: 8px;
		 border-radius: 8px;
		  background: #65a9d7;
	   }
</style>
<body>
	<div class="container">
		<div id="header" class="span-24">
			<div id="logo" style="width:250px;float:left;">
				<img src="../assets/blueprint/images/logo.png" width="100" height="50" />
			</div>
			<div id="breadcrumb">
				<span class="the_bread_item"><a href="#"><?php echo $the_page_message;?></a> <font size="3">&raquo;</font> </span><?php if(isset($message)) {echo '<span class="the_bread_item">' . $message . '</span>';}?>
			</div>

		</div>
		<div id="content" class="span-24">
			<div id="left_content">
				<ul>
					<li><a href="#">Tarichi 2.0 Installation</a>
                    	<div><span></span></div>
                    	<ul>
                        	<li <?php if($the_page_type=="welcome") echo 'class="selected"';?>><a href="#">Welcome</a></li>
                            <li <?php if($the_page_type=="step1") echo 'class="selected"';?>><a href="#">1. Setting Database</a></li>
                            <li <?php if($the_page_type=="step2") echo 'class="selected"';?>><a href="#">2. Set Site Configuration</a></li>
                           
                            <li <?php if($the_page_type=="step3") echo 'class="selected"';?>><a href="#">Finish</a></li>
                        </ul>
                    </li>
				</ul>
			</div>

			<div id="right_content">
      			<?php if($the_page_type=="welcome")
				{ ?>
                
                	<div class="formbox penuh">
                    	<div class="formboxtitle">
                        	Welcome To Tarichi 2.0 Installation
                        </div>
                        <div class="formboxitem">
                        	In order to Install Tarichi you need to check few things below : 
                            <ul>
                            	<li>PHP 5.x installed on server</li>
                                <li>You have account to MySQL Database that can create, edit, remove</li>
                                <li>You set application/config/database.php file writable. <a href="javascript:void(0);" title="In Linux server please refer to linux command to change the file permission to 777">?</a></li>
                            </ul>
                        </div>
                        <div class="formboxitem" style="padding:20px;">
                        	<a href="index.php?page_type=step1" class="button">Start Now!</a>
                        </div>
                    </div>
                <? } elseif($the_page_type=="step1")
				{  ?>
                <script type="text/javascript">
					$(document).ready(function(){
						$('input').focus(function(){
							var bapak=$(this).parent();
							$('.small',bapak).fadeIn();
						});
						
						$('input').blur(function(){
							var bapak=$(this).parent();
							$('.small',bapak).fadeOut();
						});
					});
				</script>
                <form id="install_form" method="post" action="index.php?page_type=step1">
					<div class="formbosx">
                        
                        <div class="formboxitem">
                            <label for="hostname">Hostname</label><br /><input type="text" id="hostname" value="localhost" class="input_text" name="hostname" /> <span class="small">Hostname of MySQL database</span>
                        </div>
                        <div class="formboxitem">
                            <label for="username">Username</label><br /><input type="text" id="username" class="input_text" name="username" /> <span class="small">Username for MySQL database</span>
                            
                        </div>
                        <div class="formboxitem">
                            <label for="password">Password</label><br /><input type="password" id="password" class="input_text" name="password" /> <span class="small">Password for MySQL database</span>
                        </div>
                        <div class="formboxitem">
                            <label for="database">Database Name</label><br /><input type="text" id="database" class="input_text" name="database" /> <span class="small">Name of Database to import the SQL, if not exist Tarichi will try to create it based on your MySQL user privileges</span>
                        </div>
   						<div class="formboxitem">
                        	<a href="index.php" class="btnmerah">&laquo; Prev</a> <input type="submit" value="Next &raquo;" class="btnmerah" /> 
                        </div>
					</div>
                    
                 </form>
                <? } elseif($the_page_type=='step2')
				{  ?>
                <script type="text/javascript">
					$(document).ready(function(){
						$('input').focus(function(){
							var bapak=$(this).parent();
							$('.small',bapak).fadeIn();
						});
						
						$('input').blur(function(){
							var bapak=$(this).parent();
							$('.small',bapak).fadeOut();
						});
					});
				</script>
                <form id="install_form" method="post" action="index.php?page_type=step2">
                	<div>
                    	<div class="formboxitem">
                        	<label for="username">Username</label><br />
                            <input type="text" id="username" name="username" /> <span class="small">Your default username for backpanel</span>
                        </div>
                        <div class="formboxitem">
                        	<label for="password">Password</label><br />
                            <input type="text" name="password" /><span class="small">Your default password for backpanel</span>
                        </div>
                        <div class="formboxitem">
                        	<label for="site_name">Site Name</label><br />
                            <input type="text" name="site_name" /><span class="small">Your Site Name</span>
                        </div>
                        <div class="formboxitem">
                        	<label for="site_slogan">Site Slogan</label><br />
                            <input type="text" name="site_slogan" /><span class="small">Your Site Slogan</span>
                        </div>
                        <div class="formboxitem">
                        	<label for="default_email">Default Email</label><br />
                            <input type="text" name="site_main_email" /><span class="small">Your Main Email</span>
                        </div>
                        <div class="formboxitem">
                        	<input type="submit" value="Finsih &raquo;" class="btnmerah" />
                        </div>
                    </div>
                </form>
                <? } elseif($the_page_type=='step3')
				{ ?>
                	<div class="formbox separo" style="text-align:center;">
                    
                    	<div class="formboxtitle">
                        	Congratulations
                        </div>
                        <div class="formboxitem">
                            <p>You just finished your new site Configuration.</p>
                        </div>
                        <div class="formboxitem">
                            <a href="../index.php/the_master" class="btnmerah">Access Backpanel</a>
                        </div>
                        <div class="formboxitem">
                        	<a href="../index.php" class="btnmerah">View Site</a>
                        </div>
                        <div class="formboxitem">
                       
                        <p>
                        	Your Username : <?php echo $_SESSION['admin_username'];?><br />
                            Your Password : <?php echo $_SESSION['admin_password'];?><br />
                            <?php session_destroy(); ?>
                        </p></div>
                    </div>
                    <div class="formbox separo">
                    	<div class="formboxtitle">
                        	What to do ?
                        </div>
                        <div class="formboxitem">
                        	Delete your installation folder /install/ and all contents for security reasons.
                        </div>
                        <div class="formboxitem">
                        	Change file permission for /application/config/database.php to read only for security reasons.
                        </div>
                    </div>
                <? } ?>
			</div> 
            <hr class="space" />
		</div>
       
	</div> 
    <div id="footer">
        
    </div>
</body>
</html>


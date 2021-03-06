<?php
	session_start();
	if ((!isset($_SESSION["uid"]))||($_SESSION['messman']==0))
	{
		header("location:../dashboard");
	}
	else
	{
		$loggedin=1;
		$id=$_SESSION["uid"];
		$data=mysqli_connect("localhost","root","","mess") or die();
		$db=mysqli_query($data,"SELECT `fname`,`lname` FROM login WHERE `colid`='$id'");
		$db=mysqli_fetch_assoc($db);
		$fname=$db["fname"];
		$lname=$db["lname"];
		$user=$fname.' '.$lname;
	}
	$_SESSION['rurl']=1;
  ?>
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mess Food Management</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="../images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="../images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../material.min.css">
    <link rel="stylesheet" href="../styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Home</span>          
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <i class="material-icons" style="font-size:60px;color:white;" role="presentation"><?php if($loggedin && $_SESSION['messman']==1){echo"account_box";}else{echo"account_circle";}?></i><br>
          <div class="demo-avatar-dropdown">
            <span>
			<?php
				echo "<i class='material-icons' style='font-size:16px;'>verified_user</i>&nbsp;";
				echo $user;?></span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
			<ul type="submit" class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
			<?php
				if($loggedin)
				{
					echo "<a style='text-decoration: none;' href='../your-info/'><li type='submit' class='mdl-menu__item'><i class='material-icons'>info_outline</i>&ensp;Account</li></a>
					<a style='text-decoration: none;' href='../login/logout.php'><li type='submit' class='mdl-menu__item'><i class='material-icons'>delete</i>&ensp;Logout</li></a>";
				}
				else
				{
					echo "<a style='text-decoration: none;' href='../login/'><li type='submit' class='mdl-menu__item'><i class='material-icons'>move_to_inbox</i>&ensp;Login</li></a>";
				}
				
			?>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="../dashboard/"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
		  <a class='mdl-navigation__link' href='../edit-menu/'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>mode_edit</i>Edit Menu</a>
		  <a class='mdl-navigation__link' href='../stats/'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>timeline</i>Stats</a>
		  <a class='mdl-navigation__link' href='../approve-menu/'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>check_circle</i>Approve Menu</a>
			<a class="mdl-navigation__link" href="../suggestion/"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">playlist_add</i>Suggestion</a>
			<a class='mdl-navigation__link' href='../graph/'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>gesture</i>Review Graph</a>
		  <div class="mdl-layout-spacer"></div>
		  <a class="mdl-navigation__link" href="../contact-us/"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Contact Us</a>


        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="mdl-layout__content">
			<div class="content-grid mdl-grid">
				<div class="mdl-card mdl-cell mdl-shadow--2dp" style='width:inherit;'>
					<div class="mdl-data-table__cell mdl-shadow--2dp" style="text-align:center;"><h4>Breakfast</h4></div>
					<table class="mdl-data-table mdl-js-data-table" style=" border: none;width:100%;'">
						<!--<thead>
							<th class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style=" width: 100%;text-align:center;"><h4>Breakfast</h4></th>
						</thead>-->
						<tbody style='width:inherit;'>
							<?php
								$data=mysqli_connect("localhost","root","","mess") or die();
								$db=mysqli_query($data,"SELECT `foodid`,`foodname` FROM food WHERE foodtype=1 AND `deleted`=0");
								if(mysqli_num_rows($db)==0)
								{
									echo "<tr style='width:inherit;'>								
											<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'>No item available</td>											
										  </tr>";
								}
								else
								{
									foreach ($db as $d)
									{					
										$food=$d['foodname'];
										$fid=$d['foodid'];
										echo "<tr>								
												<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'><b>$food</b></td>												
												<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'><a href='delete.php?fid=$fid' class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' style='display:inline-block;'>Remove</a></td>
											  </tr>";
									}
								}
							?>
						</tbody>
					</table>
					<div class="mdl-layout-spacer"></div>
					<form method="post" action="add.php">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
							<label class="mdl-button mdl-js-button mdl-button--icon" for="search1">
								<i class="material-icons">add_circle_outline</i>
							</label>
							<div class="mdl-textfield__expandable-holder">
								<input class="mdl-textfield__input" type="text" name="bf" id="search1" required="required">
								<label class="mdl-textfield__label" for="search">Enter your query...</label>							
							</div>						
						</div>
						<div class='mdl-button' style="padding:0;">
							<button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' type="submit" name="addbf">Add</button>
						</div>						
					</form>
				</div>
				<div class="mdl-card mdl-cell mdl-shadow--2dp" style='width:inherit;'>
					<div class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style="text-align:center;"><h4>Lunch</h4></div>
					<table class="mdl-data-table mdl-js-data-table" style=" border: none;width:100%;">
						<!--<thead>
							<th class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style=" width: 100%;text-align:center;"><h4>Lunch</h4></th>
							<th class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style=" width: 100%;text-align:center;"></th>
						</thead>-->
						<tbody>
							<?php
								$data=mysqli_connect("localhost","root","","mess") or die();
								$db=mysqli_query($data,"SELECT `foodid`,`foodname` FROM food WHERE foodtype=2");
								if(mysqli_num_rows($db)==0)
								{
									echo "<tr style='width:100%;'>								
											<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'>No item available</td>
										  </tr>";
								}
								else
								{
									foreach ($db as $d)
									{
										$food=$d['foodname'];
										$fid=$d['foodid'];
										echo "<tr>								
												<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'><b>$food</b></td>												
												<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'><a href='delete.php?fid=$fid' class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' style='display:inline-block;'>Remove</a></td>
											  </tr>";
									}
								}
							?>							
						</tbody>
					</table>
					<div class="mdl-layout-spacer"></div>
					<form method="post" action="add.php">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
							<label class="mdl-button mdl-js-button mdl-button--icon" for="search2">
								<i class="material-icons">add_circle_outline</i>
							</label>
							<div class="mdl-textfield__expandable-holder">
								<input class="mdl-textfield__input" type="text" name="lunch" id="search2" required="required">
								<label class="mdl-textfield__label" for="search">Enter your query...</label>							
							</div>						
						</div>
						<div class='mdl-button' style="padding:0;">
							<button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' type="submit" name="addlunch">Add</button>
						</div>						
					</form>
				</div>
				<div class="mdl-card mdl-cell mdl-shadow--2dp" style='width:inherit;'>
					<div class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style="text-align:center;"><h4>Dinner</h4></div>
					<table class="mdl-data-table mdl-js-data-table" style=" border: none;width:100%;">
						<!--<thead>
							<th class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style=" width: 100%;text-align:center;"><h4>Lunch</h4></th>
							<th class="mdl-data-table__cell--non-numeric mdl-shadow--2dp" style=" width: 100%;text-align:center;"></th>
						</thead>-->
						<tbody>
							<?php
								$data=mysqli_connect("localhost","root","","mess") or die();
								$db=mysqli_query($data,"SELECT `foodid`,`foodname` FROM food WHERE foodtype=3");
								if(mysqli_num_rows($db)==0)
								{
									echo "<tr style='width:100%;'>								
											<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'>No item available</td>
										  </tr>";
								}
								else
								{
									foreach ($db as $d)
									{
										$food=$d['foodname'];
										$fid=$d['foodid'];
										echo "<tr>								
												<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'><b>$food</b></td>												
												<td class='mdl-data-table__cell--non-numeric' style='vertical-align:baseline;'><a href='delete.php?fid=$fid' class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' style='display:inline-block;'>Remove</a></td>
											  </tr>";
									}
								}
							?>
						</tbody>
					</table>
					<div class="mdl-layout-spacer"></div>
					<form method="post" action="add.php">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
							<label class="mdl-button mdl-js-button mdl-button--icon" for="search3">
								<i class="material-icons">add_circle_outline</i>
							</label>
							<div class="mdl-textfield__expandable-holder">
								<input class="mdl-textfield__input" type="text" name="dinner" id="search3" required="required">
								<label class="mdl-textfield__label" for="search">Enter your query...</label>							
							</div>						
						</div>
						<div class='mdl-button' style="padding:0;">
							<button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' type="submit" name="adddinner">Add</button>
						</div>						
					</form>
				</div>
			</div>
		  </div>
		</div>
      </main>
    </div>
    <script src="../material.min.js"></script>
  </body>
</html>

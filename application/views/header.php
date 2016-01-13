<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />

    <title>JoyMetric - Customer Satisfaction Feedback</title>
    <!-- Bootstrap -->
<link href="http://www.joymetric.com/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
     <script>
		$(function() {
			$( "#from" ).datepicker({
				dateFormat: "yy-mm-dd",
				gotoCurrent: true,
				defaultDate: "0",
				changeMonth: true,
				numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				gotoCurrent: true,
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
		});
	</script>
  </head>
  <body>
  
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">JoyMetric</a> 
          <? if ($this->ion_auth->logged_in()){ ?>
          	<ul class="nav pull-right">
  				<li class="divider-vertical"></li>
                <li class="dropdown">
    				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
     					 Account
     				 <b class="caret"></b>
    				</a>
    				<ul class="dropdown-menu">
     				 <li><a tabindex="-1" href="/admin">Admin</a></li>
                     <li><a tabindex="-1" href="/auth/logout">Logout</a></li>
    				</ul>
  				</li>
                <li class="divider-vertical"></li>
			</ul>
          <? }else{ ?>
          <form class="navbar-form pull-right" action="/auth/login" method="post">
 			 <input type="text" class="span1" placeholder="Login" name="identity">
             <input type="password" class="span1" placeholder="Pass" name="password">
    			<input type="checkbox" name="remember" value="1">
  			<button type="submit" class="btn">Submit</button>
		  </form>
          <? }; ?>
        </div>
        
      </div>
    </div>
    <div class="container">
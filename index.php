<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php	$version = "2.0";
	$date = date("Y");
	$author = "Edvin Dunaway";
	$email = "edvin[at]eddinn.net";
	$webpage = "eddinn.net";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<title>Basic Webtools</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="styleie.css" media="screen" />
<![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	</head>
<body>
<div class="wrap" id="wrap">
<div id="header">
<p><a href="?action=home">Basic Webtools</a></p>
</div>
	<div id="sidebarLeft">
		<br />
		<ul>
		<li><a href="?action=dig">Dig</a></li>
    <li><a href="?action=icedns">IceDNS</a></li>
		<li><a href="?action=nmap">nMap</a></li>
		<li><a href="?action=ping">Ping</a></li>
		<li><a href="?action=trace">Traceroute</a></li>
		<li><a href="?action=whois">Whois</a><br /><br /></li>
		<li><a href="?action=home">Home</a></li>
		</ul>
		<div id="credit">
			<p>
			&copy; <?php echo"$date"; ?><br />
			<a href="mailto:edvin[at]eddinn.net"><?php echo"$author"; ?></a><br />
			</p>
			<p>
			<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Strict" style="border:0;width:88px;height:31px" height="31" width="88" /></a>
			</p>
			<p>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" /></a>
			</p>

		</div>
	</div> 
	<div id="mainBody">
		<?php if (isset($_REQUEST['action'])) {
			switch ($_REQUEST['action']) {
				case 'dig':
					include("include/dig.php");
					break;
				case 'home':
					include("include/body.php");
					break;
        case 'icedns':
          include("include/icedns.php");
          break;
				case 'nmap':
					include("include/nmap.php");
					break;
        case 'ping':
          include("include/ping.php");
          break;
        case 'trace':
          include("include/trace.php");
          break;
				case 'whois':
					include("include/whois.php");
					break;
				default:
					include("include/body.php");
					break;
				}
			} else {
				include("include/body.php"); 
			}
		?>
	</div>
</div>
</body>
</html>

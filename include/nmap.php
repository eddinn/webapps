<script type="text/javascript">
        function hideProgress() {
                document.getElementById('activity').style.display = 'none';
        }
        function hideNotes() {
                document.getElementById('notes').style.display = 'none';
        }
</script>
<div id="container">
	<div id="notes">
                <h4>nMap scan</h4>
                <p>Enter a TLD name, hostname or an valid IP address to scan.<br />For example;<br /><strong>&nbsp;&nbsp;example.com<br />&nbsp;&nbsp;myhostname.example.com<br />&nbsp;&nbsp;66.249.93.104</strong></p>
                <p>Select scan options from the selectbox on the left.<br /><strong>Note:</strong> You can combine both the Basic and Additional options sets.</p>
        </div>
<?php
	$version = "3";
	echo"<strong>Basic nMap - version $version</strong><br />"; ?>
	<form action="?action=nmap" method="post">
		<p id="actions">
		<input type="text" name="host" value="<?php print(((isset($_POST['host']) ? $_POST['host'] : ""))); ?>" size="30" />&nbsp; Host/IP<br />
		<select name="basic">
			<option value="">Basic options</option>
			<option value="-P0">-P0: No Ping</option>
			<option value="-PN">-PN: Treat as up</option>
			<option value="-sP">-sP: Ping</option>
			<option value="-sL">-sL: List</option>
		</select>
		<select name="adv">
			<option value="">Additional options</option>
			<option value="-sU">-sU: UDP</option>
			<option value="-sN">-sN: TCP Null</option>
			<option value="-sT">-sT: TCP Connect</option>
		</select><br /><br />
		<input type="submit" name="submit" value="Submit" />
		</p>
	</form>
</div>
<div id="specialContainer">
<?php
if (isset($_REQUEST["submit"]) == "submit") {
	echo '<script type="text/javascript">hideNotes();</script>';
        function hardFlush() {
                flush();
                ob_flush();
        }
        $drasl = "                                                    ".
                 "                                                    ".
                 "                                                    ".
                 "                                                    ".
                 "                                                    \n";
	$nmapExec = escapeshellcmd($nmapexec = "/usr/bin/nmap");
	$hostOpt = escapeshellarg($_POST["host"]);
	$basicOpt = escapeshellarg($_POST["basic"]);
	$advOpt = escapeshellarg($_POST["adv"]);
	$searchBasArray = array("'-P0'" => 0, "'-sP'" => 1, "'-sL'" => 2, "" => 3, "'-PN'" => 4);
	$searchAdvArray = array("'-sU'" => 0, "'-sN'" => 1, "'-sT'" => 2, "" => 3);
	if (!array_key_exists($basicOpt,$searchBasArray)) {
		exit("ERROR: You are not allowed to use ($basicOpt)!"); }
	if (!array_key_exists($advOpt,$searchAdvArray)) {
		exit("ERROR: You are not allowed to use ($advOpt)!"); }
	echo "<p><strong>nMap results for $hostOpt </strong></p><pre>";
	echo '<div id="activity"><img src="img/prog.gif" /></div>';
        hardFlush();
        $handler = popen("$nmapExec $basicOpt $advOpt $hostOpt", "r");
        hardFlush();
        while(!feof($handler)) {
               	$line = fread($handler, 4096);
		if (preg_match("/127.0.0.1/i", $line)) {
               		pclose($handler);
		        echo '<script type="text/javascript">hideProgress();</script>';
			echo "Nothing to do for $hostOpt";
		        echo '</pre><br /><form action="?action=nmap" method="post"><input type="submit" name="Reset" value="Reset" /></form>';
               		exit();
        	} else {
               		print("".str_replace("\n", $drasl, $line));
       	       		hardFlush();
       		}
	}
       	pclose($handler);
	echo '<script type="text/javascript">hideProgress();</script>';
	echo '</pre><br /><form action="?action=nmap" method="post"><input type="submit" name="Reset" value="Reset" /></form>';
} ?>
</div>

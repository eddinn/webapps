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
                <h4>Ping</h4>
                <p>Enter an IP address or hostname/TLD to ping.<br />For example;<br />&nbsp;&nbsp;<strong>66.249.93.104<br />&nbsp;&nbsp;example.com</strong></p>
		<p><strong>Note:</strong> the default count is <strong>5</strong></p>
        </div>
        <form action="?action=ping" method="post">
                <p id="actions">
                <?php
                        $version = "0.8";
                        echo"<strong>Ping - version $version</strong><br />";
                ?>
                <input type="text" name="ping" value="<?php print(((isset($_POST["ping"]) ? $_POST["ping"] : ""))); ?>" size="30" />&nbsp; Domain/IP<br /><br />
                <input type="submit" name="submit" value="Submit" />
                </p>
        </form>
</div>
<div id="specialContainer">
<?php
if (isset($_REQUEST ['submit'])) {
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
	$pingExec = escapeshellcmd("/bin/ping");
	$pingOpt = escapeshellcmd("-c 5");
	$pingInput = escapeshellarg($_POST["ping"]);
	echo "<p><strong>Ping results for $pingInput</strong></p><pre>";
	echo '<div id="activity"><img src="img/prog.gif" /></div>';
	hardFlush();
	$handler = popen("$pingExec $pingOpt $pingInput", "r");
	hardFlush();
	while(!feof($handler)) {
                $line = fread($handler, 4096);
                print("".str_replace("\n", $drasl, $line));
                hardFlush();
	}
	pclose($handler);
	echo '<script type="text/javascript">hideProgress();</script>';
	echo '</pre><br /><br /><form action="?action=ping" method="post"><input type="submit" name="Reset" value="Reset" /></form><br /><br />';
}
?>
</div>

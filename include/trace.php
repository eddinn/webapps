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
                <h4>Traceroute</h4>
                <p>Enter an valid IP address or hostname/TLD to trace.<br />For example;<br />&nbsp;&nbsp;<strong>66.249.93.104<br />&nbsp;&nbsp;example.com
</strong></p>
        </div>
        <form action="?action=trace" method="post">
                <p id="actions">
                <?php
                        $version = "0.8";
                        echo"<strong>Traceroute - version $version</strong><br />";
                ?>
                <input type="text" name="trace" value="<?php print(((isset($_POST["trace"]) ? $_POST["trace"] : ""))); ?>" size="30" />&nbsp; Domain/IP<br /><br />
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
	$traceExec = escapeshellcmd("/bin/traceroute");
	$traceOpt = escapeshellarg($_POST["trace"]);
	echo "<br /><p><strong>Route for $traceOpt</strong></p><pre>";
	echo '<div id="activity"><img src="img/prog.gif" /></div>';
	hardFlush();
	$handler = popen("$traceExec $traceOpt", "r");
	hardFlush();
	while(!feof($handler)) {
                $line = fread($handler, 4096);
                print("".str_replace("\n", $drasl, $line));
                hardFlush();
	}
	pclose($handler);
	echo '<script type="text/javascript">hideProgress();</script>';
	echo '</pre><br /><br /><form action="?action=trace" method="post"><input type="submit" name="Reset" value="Reset" /></form><br /><br />';
}
?>
</div>

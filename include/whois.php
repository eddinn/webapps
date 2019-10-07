<script type="text/javascript">
        function hideNotes() {
                document.getElementById('notes').style.display = 'none';
        }
</script>
<div id="container">
        <div id="notes">
                <h4>WHOIS information</h4>
                <p>Enter a TLD name, an valid IP address or a valid IP network.<br />For example;<br />&nbsp;&nbsp;<strong>example.com<br />&nbsp;&nbsp;66.249.93.104
<br />&nbsp;&nbsp;66.249.0.0</strong></p>
        </div>
        <form action="?action=whois" method="post">
                <p id="actions">
                <?php
                        $version = "1.2";
                        echo"<strong>Whois - version $version</strong><br />";
                ?>
                <input type="text" name="whois" value="<?php print(((isset($_POST["whois"]) ? $_POST["whois"] : ""))); ?>" size="30" />&nbsp; Domain/IP<br /><br />
                <input type="submit" name="submit" value="Submit" />
                </p>
        </form>
</div>
<?php
if (isset($_REQUEST ['submit'])) {
	echo '<script type="text/javascript">hideNotes();</script>';
	$whoisExec = escapeshellcmd("/usr/bin/whois");
	$whoisOpt = escapeshellarg($_POST["whois"]);
	echo "<p><strong>Whois record for $whoisOpt</strong></p><pre>";
	system("$whoisExec $whoisOpt");
	echo '</pre><br /><br /><form action="?action=whois" method="post"><input type="submit" name="Reset" value="Reset" /></form><br /><br />';
}
?>

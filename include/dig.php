<script type="text/javascript">
        function getValue() { 
                document.getElementById("digForm").optNsForm.value = document.getElementById("digForm").nsType.value;
        }
        function hideNotes() {
                document.getElementById('notes').style.display = 'none';
        }
</script>
<div id="container">
        <div id="notes">
                <h4>DNS lookup</h4>
                <p>Enter a TLD name, hostname or an valid IP address for a reverse lookup.<br />For example;<br /><strong>&nbsp;&nbsp;example.com<br />&nbsp;&nbsp;myhostname.example.com<br />&nbsp;&nbsp;66.249.93.104</strong></p>
                <p>Select a lookup option from the selectbox on the left.<br /><strong>Note:</strong> the <strong>-x</strong> option is only for reverse IP lookups</p>
        </div>
        <form id="digForm" action="?action=dig" method="post">
                <p id="actions">
                <?php
                        $version = "1.8";
                        echo"<strong>DNS lookup - version $version</strong><br />";
                ?>
                <input type="text" name="lookup" value="<?php print(((isset($_POST["lookup"]) ? $_POST["lookup"] : ""))); ?>" size="30" />&nbsp; Host/IP<br />
                <select name="digType">
                        <option value="a">Dig options</option>
                        <option value="any">ANY</option>
                        <option value="axfr">AXFR</option>
                        <option value="hinfo">HINFO</option>
                        <option value="mx">MX</option>
                        <option value="ns">NS</option>
                        <option value="ptr">PTR</option>
                        <option value="soa">SOA</option>
                        <option value="txt">TXT</option>
                        <option value="-x">-x ARPA</option>
                </select>
                <select name="nsType" onchange="javascript:getValue()">
                        <option value="">NS options</option>
			<!-- <option value="@localhost">Default</option> -->
                        <option value="@google-public-dns-a.google.com">google dns</option>
                        <option value="@ns1.skima.is">ns1.skima.is</option>
			<option value="@resolver1.opendns.com">opendns</option>
                        <option value="@">Custom NS</option>
                </select><br />
		<input type="text" name="optNsForm" value="<?php print(((isset($_POST["optNsForm"]) ? $_POST["optNsForm"] : ""))); ?>" size="30" />&nbsp; NS
                <br /><br />
                <input type="submit" name="submit" value="Submit" />
                </p>
        </form>
</div>
<?php
        if (isset($_REQUEST ['submit'])) {
		echo '<script type="text/javascript">hideNotes();</script>';
		$digExec = escapeshellcmd("/usr/bin/dig");
		$lookupOpt = escapeshellarg($_POST["lookup"]);
		$digTypeOpt = escapeshellarg($_POST["digType"]);
		$optNameserver = escapeshellarg($_POST["optNsForm"]);
                /* $searchNsArray = array("'@localhost'" => 0, "'@ns1.skyrr.is'" => 1, "'@ns1.skima.is'" => 2, "'@'" => 3, "" => 4);
                if (!array_key_exists($optNameserver,$searchNsArray)) {
			echo "<br /><br /><br /><br /><br /><br /><br />";
                        exit("ERROR: You are not allowed to use ($optNameserver)!"); } */
		$searchTypeArray = array("'any'" => 0, "'axfr'" => 1, "'hinfo'" => 2, "'mx'" => 3, "'ns'" => 4, "'ptr'" => 5, "'soa'" => 6, "'txt'" => 7, "'-x'" => 8, "'a'" => 9);
		if (!array_key_exists($digTypeOpt,$searchTypeArray)) {
			echo "<br /><br /><br /><br /><br /><br /><br />";
			exit("ERROR: You are not allowed to use ($digTypeOpt)!"); }
		echo "<p><strong>DNS records for $lookupOpt </strong></p><pre>";
		system("$digExec $optNameserver $digTypeOpt $lookupOpt");
		echo '</pre><br /><br /><form action="?action=dig" method="post"><input type="submit" name="Reset" value="Reset" /><br /><br /></form>';
	}
 ?>

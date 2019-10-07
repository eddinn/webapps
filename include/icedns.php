<script type="text/javascript">
        function hideNotes() {
                document.getElementById('notes').style.display = 'none';
        }
</script>
<div id="container">
        <div id="notes">
                <h4>IceDNS lookup</h4>
                <p>Enter an valid IP address for a reverse lookup.<br />For example;<br /><strong>&nbsp;&nbsp;66.249.93.104</strong></p>
                <p>IceDNS determines if the given IP address is Icelandic or not</p>
        </div>
        <form action="?action=icedns" method="post">
                <p id="actions">
                <?php
                        $version = "2";
                        echo"<strong>IceDNS lookup - version $version</strong><br />";
                ?>
		<input type="text" name="ip" value="<?php print(((isset($_POST['ip']) ? $_POST['ip'] : ""))); ?>" size="30" />&nbsp; IP Address<br />
                <br />
                <input type="submit" name="submit" value="Submit" />
                </p>
        </form>
</div>
<?php
        if (isset($_REQUEST ['submit'])) {
		echo '<script type="text/javascript">hideNotes();</script>';
		if( $_POST['ip'] != '' ) {
                        $arr_ip = array_reverse( explode( '.', $_POST['ip'] ) );
                                if( gethostbyname( implode( '.', $arr_ip ) . '.iceland.rix.is' ) == '127.1.0.1' ) {
			                echo "<p><strong>IceDNS results for $ip </strong></p><pre>";
                                        echo $_POST['ip'] . ' is an .is IP address!';
                                } else {
                                        echo "<p><strong>IceDNS resaults for $ip </strong></p><pre>";
                                        echo $_POST['ip'] . ' is not an .is IP address!'; }
		}
	echo '</pre><br /><br /><form action="?action=icedns" method="post"><input type="submit" name="Reset" value="Reset" /><br /><br /></form>';
} ?>

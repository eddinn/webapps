<div style="overflow: hidden; width: 600px;">
<pre>
<?PHP
/* $drasl = "                                                    ".

                "                                                    ".

                "                                                    ".

                "                                                    ".

                "                                                    \n"; */
function hardFlush() {
/*	$drasl = "                                                    ".

                "                                                    ".

                "                                                    ".

                "                                                    ".

                "                                                    \n"; */
    flush();
    ob_flush();
}
$handler = popen("traceroute google.com", "r");
hardFlush();
while(!feof($handler)) {
                $line = fread($handler, 4096);
/*                print("".str_replace("\n", $drasl, $line));*/
		print($line);
                hardFlush();
}
/* for ($i = 0 ; $i < 10 ; $i++) {
                print("Jööööö".$drasl);
                hardFlush();
                sleep(1);
} */
fclose($handler);
?>
</pre>
</div>

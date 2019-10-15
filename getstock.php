<?php
if(isset($_POST["surl"])){
	// Configuration
	$apiemail = "Your API Email";
	$apitoken = "Your API Token";

	// Input parameters
	$surl = $_POST["surl"];

	// Get from API
	$apiurl = "https://api.sharedvn.net/?email=".$apiemail."&token=".$apitoken."&url=".urlencode($surl);
	$res = @file_get_contents($apiurl);
	$json = json_decode($res);

	// Get result
	if($json->status=="Error"){
		echo $json->message;
	}
	else
	{
		$sid = $json->id;
		$surl = $json->url;
		$site = $json->site;

		// Show image (if u wanna use id or site provider just use above)
		echo '<p><a href="'.$surl.'" download="'.$site.'-'.$sid.'.png"><img src="data:image/png;base64,' . $surl . '" /></a></p>';
	}
}
?>
<label>Stock url</label>
<form method="post" action="">
<input type="text" name="surl">
<input type="submit" value="Get it">
</form>

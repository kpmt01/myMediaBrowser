<?php

	function fileSearch($dir = ".\\",$json = ''){
		$dir = $dir."\\";
		$json2 = "";

		if (is_dir($dir)) {
		    if ($dit = opendir($dir)) {
		        while (($dosya = readdir($dit)) !== false) {
		            if(filetype($dir. $dosya) === "dir" and $dosya !== "." and $dosya !== ".."){
		            	echo $dir. $dosya."<br>";
		            	$json2 .= fileSearch($dir. $dosya,$json);
		            }else if($dosya !== "." and $dosya !== ".."){
		            	echo $dir.$dosya." <span style='color:red;'>".mime_content_type($dir. $dosya)."</span> <br>";
		            	$json .='{"'.$dir.$dosya.'","'.mime_content_type($dir. $dosya).'"}<br>';
		            }
		        }
		            $json = $json . $json2;
		        closedir($dit);
		    }
		}
		return $json;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Mustafa Türkmen</title>
	</head>
	<body>
	<?php
		$json = fileSearch();
		echo "<span style='color:gray;'>".$json."</span>";
	?>
	</body>
</html>

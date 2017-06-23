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


	function dirToArray($dir='C:\wamp\www\deneme') {
	   $result = array();
	   $cdir = scandir($dir);
	   foreach ($cdir as $key => $value)
	   {
	      if (!in_array($value,array(".","..")))
	      {
	         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
	         {
	            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
	         }
	         else
	         {
	            $result[] = array(
					"yol"=>$dir. DIRECTORY_SEPARATOR .$value,
					"mime"=>mime_content_type($dir. DIRECTORY_SEPARATOR . $value)
				);
	         }
	      }
	   }
	   return $result;
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
			//$json = fileSearch();
			//echo "<span style='color:gray;'>".$json."</span>";
		?>
	<hr>
		<pre>
			<?php
				$json = dirToArray();
				echo "<div style='color:gray;'>",print_r($json),"</div><hr>";
			?>
		</pre>
	</body>
</html>

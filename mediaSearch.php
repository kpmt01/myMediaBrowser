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

	function isThereArray2Array(){

	}

	function dirToArray($dir='.') {
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
	function arraySearch($saman, $igne){
		$haystack = array();
		$value = arraySearchMoto($saman, $igne);
		$value = rtrim($value,"-_-*/-");
		$haystack = explode("-_-*/-",$value);
		return $haystack;
	}
	function arraySearchMoto($saman, $igne){
	   	$result = "";
		foreach ($saman as $key => $value):
			if(is_array($value) and count($value)>0):
				$result .= arraySearchMoto($value,$igne);
			else:
				if($value === $igne):
					$result .= $before."-_-*/-";
				endif;
				$before = $value;
				echo $key.$value."<br>";
			endif;
		endforeach;
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

				$son = arraySearch($json,"video/mp4");
				echo "<div style='color:green;'>",print_r($son),"</div><hr>";
			?>
		</pre>
		<video width="320" height="240" controls>
			<source src="<?php echo $son[0]; ?>" type="video/mp4">
			Your browser does not support the video tag.
		</video>
	</body>
</html>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<title>WIKI WWI Project</title>
</head>
<body>
<?php

include '/dbconnectors/conn_mysql.php';

$url = "https://en.wikipedia.org/wiki/World_War_I";
$ch = curl_init();
$timeout = 3;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);

# Create a DOM parser object
$dom = new DOMDocument();

# Parse the HTML 

@$dom->loadHTML($html);

	$sentenceArray=array();
	$sentenceArray =explode(". ", $html);
	
	$sentenceArray =explode("l>", $html);
/*	$sentence= explode("<br>", $sentence);
	$sentence =explode("<p>", $sentence);
	$sentenceArray=explode("<//div>", $sentence);
*/

	echo $sentenceArray[0], $sentenceArray[1], $sentenceArray[2], $sentenceArray[3] , $sentenceArray[4];
	
	/*
	# insert data into DB
	$sql = array(); 
	foreach( $linkArray as $key => $value ) {
        	if ($value != "") {$sql[] = '("'.$value.'")';}
	}
 # 'INSERT INTO WIKI_ProjectsLinks (LinkURL) VALUES '.implode(',', $sql);

 $mysqli->query('INSERT INTO WIKI_ProjectsLinks (LinkURL) VALUES '.implode(',', $sql));
 $mysqli->close();
 */
?>
</body>
</html>

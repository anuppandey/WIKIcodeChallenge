<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<title>WIKI WWI Project</title>
</head>
<body>
<?php

 include 'dbconnectors/conn_mysql.php';

# retrieve links to fetch html content for
$qry= "SELECT LinkURL, WIKI_LinkID FROM WIKI_ProjectsLinks where WIKI_LinkID >568 order by WIKI_LinkID";
$linkrecords= $mysqli->query($qry);
$num=mysqli_num_rows($linkrecords);
echo "number of rows:".$num."!!!";
$i=1;

while($row =$linkrecords->fetch_assoc())
{
 	$linktext=$row['LinkURL'];
 	$linkID=$row['WIKI_LinkID'];
	$url = "https://en.wikipedia.org".$linktext;
	$ch = curl_init();
	$timeout = 10;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$html = curl_exec($ch);
	curl_close($ch);
	
	# Create a DOM parser object
	$dom = new DOMDocument();
	
	# Parse the HTML and get all paragraphs or content with sentences
	
	@$dom->loadHTML($html);
		$paraArray=array();
		# Iterate over all the <p> tags
		foreach($dom->getElementsByTagName('p') as $para) {
		       
			$paracontent=  $para->textContent;
			# echo $paracontent;
			$sentences = preg_split('/(?<=[.\]])\s+(?=[a-z])/i', $paracontent);
		       		
			   	foreach( $sentences as $key => $value ) {
	        			if  ($value != "") {$sql[] = '(\''.$value.'\','.$linkID.')';}
			    	}
					  
			 	 if ($sql !="") {
		 				 $qry ='INSERT INTO WIKI_ProjectsSentences(Sentenc, WIKI_LinkID) VALUES '.implode(',', $sql);
		
						 $mysqli->query($qry);
				}
				$sql="";
		 	
		}
	
	$i++;	
} // While loop of linkrecords
mysqli_free_result($result);
$linkrecords->close();
$mysqli->close();
# insert links into DB for each URL/link
	
	
 
?>
</body>
</html>

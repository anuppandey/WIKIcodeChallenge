<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<title>Links - WIKI WWI Project</title>
</head>
<body>
<?php

 include 'dbconnectors/conn_mysql.php';

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

# Parse the HTML and get all paragraphs or content with sentences
$parentlinkID=1;
@$dom->loadHTML($html);
 
 $linkArray=array();
	# Iterate over all the <a> tags
	$i=0;
	foreach($dom->getElementsByTagName('p') as $para) {
			
			foreach($para->getElementsByTagName('a') as $link) {
			       
				$realLink =  $link->getAttribute('href');
			
				if (preg_match("/\#/", $realLink) or preg_match("/\.jpg/", $realLink) or preg_match("/File:/", $realLink)) {
			     	
				} else  {
			          array_push($linkArray, $realLink);
			        }    
			      
			      
		        
		       
			}
				
			foreach( $linkArray as $key => $value ) {
		        	if  ($value != "") {$sql[] = '(\''.$value.'\','.$parentlinkID.')';}
		        }
		        	
		   
		      		$qry='INSERT INTO WIKI_ProjectsLinks (LinkURL, WIKI_ParentID) VALUES '.implode(',', $sql);
		 $mysqli->query($qry);
		 $linkArray=array();
		   $sql="";
		
		 
	}
 	

#  $mysqli->query('INSERT INTO WIKI_ProjectsLinks (LinkURL) VALUES '.implode(',', $sql));
  $mysqli->close();
	      
		
	
 
?>
</body>
</html>

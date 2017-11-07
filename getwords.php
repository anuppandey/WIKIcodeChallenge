<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
	<title>WIKI WWI Project</title>
</head>
<body>
<?php
include 'dbconnectors/conn_mysql.php';


 
 
# retrieve sentences 
$qry= 'SELECT Sentenc, SentenceID FROM WIKI_ProjectsSentences';
$sentencerecords= $mysqli->query($qry);
$num=mysqli_num_rows($sentencerecords);
echo "number of rows:".$num."!!!";
$i=1;



while($row =mysqli_fetch_assoc($sentencerecords))
{
 	$word=$row["Sentenc"];
 	$SentID=$row["SentenceID"];
	#hasty solution due to close to deadline
	$notInclude= 			array(' i ','a ','about',' an ',' and ',' are ',' as ',' at ',' be ',' by ',' com ',' for',' from ',' how ',' in ',' is ',' it ',' of ',' on ',' or ','that ',' the ','this ',' to ',' was ',' what ',' when ','where','who','will','with','the','The ', 'This ','It ');
				   
	
$imp_words= str_replace($notInclude, " ",$word );
	
	
		
			$splitwords = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $imp_words, -1, PREG_SPLIT_NO_EMPTY);
					       		
			   	foreach( $splitwords as $key => $value ) {
	        			if  ($value != "") {$sql[] = '(\''.$value.'\','.$SentID.')';}
			    	}
					  
			 	 if ($sql !="") {
		 				 $qry ='INSERT INTO WIKI_ProjectsWords(WordWIKI,SentenceID) VALUES '.implode(',', $sql);
		
						 $mysqli->query($qry);
				}
				$sql="";
		 	
		
	if (i > 200) break;
	$i++;	
} // While loop of sentencerecords
mysqli_free_result($sentencerecords);
$sentencerecords->close();

# insert links into DB for each URL/link
	
	
 
?>
</body>
</html>

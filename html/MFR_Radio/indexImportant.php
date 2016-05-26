<?php

if(file_exists('/tmp/2request.log')){
	unlink('/tmp/2request.log');
}
$fp = fopen('/tmp/2request.log', 'a');

$language = $_REQUEST['language'];
fwrite($fp, "\nlanguage: $language");


/* Change only here the priority intended */
$priority = "Pesticides";


fwrite($fp, "\npriority: $priority");	

$path=__DIR__.'/../recordings';

$array=glob("$path/*\_$priority\_$language\_*.wav");

if(empty($array)){
	fwrite($fp, "\nThe system did not found any file matching the pattern"); 
}

$arrayPaths="[";

foreach($array as $filepath){
	$subFilePath = substr($filepath, strlen(__DIR__)+1+2);	
	$arrayPaths = $arrayPaths."'http://127.0.0.1".$subFilePath."'".",";
	fwrite($fp, "\npath: $subFilePath"); 
}

$arrayPaths=substr($arrayPaths, 0, -1);
$arrayPaths=$arrayPaths."]";

fwrite($fp, "\nwhatever was a success: $arrayPaths");
fwrite($fp,'\n');
fclose($fp);

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

<vxml version = "2.1" >
<form id="fetch">	
	<block>
		<prompt>
			<audio src="presentImportantMessages.wav" />
		</prompt>
		<foreach item="path" array="<?php echo $arrayPaths ?>" >		
			<log expr="'*****path=' + path + '*****'" />
			<prompt>
				<audio expr="path" />
			</prompt>
		</foreach>	
		<goto next="proceedMain.vxml" />		
	</block>
</form>
</vxml>

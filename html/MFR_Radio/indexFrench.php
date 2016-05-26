<?php

if(file_exists('/tmp/request.log')){
	unlink('/tmp/request.log');
}
$fp = fopen('/tmp/request.log', 'a');

$language = $_REQUEST['language'];
fwrite($fp, "\nlanguage: $language");

$choice = $_REQUEST['choice_user'];
fwrite($fp, "\nchoice: $choice");	

$path=__DIR__.'/../recordings';

$array=glob("$path/*\_$choice\_$language\_*.wav");

if(empty($array)){
	fwrite($fp, "\nbig problem array empty"); 
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
		<foreach item="path" array="<?php echo $arrayPaths ?>" >
			<log expr="'*****path=' + path + '*****'" />
			<prompt>
				<audio expr="path" />
			</prompt>
		</foreach>
		
		<audio src="thanksFrench.wav" />
		
	</block>
</form>
</vxml>

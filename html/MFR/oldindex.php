<?xml version="1.0" encoding="UTF-8"?>
<vxml version = "2.1" >
<form>
<?php
echo 'hello';
$req_dump = print_r($_POST['message'], TRUE);

if(file_exists('/tmp/request.log')){
	unlink('/tmp/request.log');
}

$fp = fopen('/tmp/request.log', 'a');

$recAudio = 'file:///tmp/cacheContent/record_1_1.WAV';
$storeAudio = 'file:///home/pi/KasaDaka/recordings/saved '.date("Y/m/d h:i:sa").'.WAV';

fwrite($fp, "\n");
fwrite($fp, file_exists('///home/pi/KasaDaka/recordings/'));

if(!isset($_FILES['message'])){
	fwrite($fp, "big bug");
	return; //not a post from our script
}


switch($_FILES['message']['error']){
    case UPLOAD_ERR_OK:
        $success_path=file_exists($_FILES['message']['tmp_name']);
	fwrite($fp, "\ncheck path origin: ".$success_path);
	$success=move_uploaded_file($_FILES['message']['tmp_name'], '/home/pi/KasaDaka/recordings/' . $_FILES['message']['name']);
	fwrite($fp, "\ncopy success: ".$success);
	$prompt = 'Thanks, your message has been saved.';
        break;
    default:
        $prompt = 'Sorry, we could not save your message.';
}
fclose($fp);

?>
</form>
</vxml>

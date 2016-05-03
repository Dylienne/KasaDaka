<?php

$req_dump = print_r($_POST['message'], TRUE);
$fp = fopen('/tmp/request.log', 'a');
fwrite($fp, $req_dump);
fclose($fp);

$recAudio = '/tmp/cacheContent/record_1_1.WAV';
$storeAudio = '/home/pi/KasaDaka/recordings/saved'.date("Y/m/d");

if(!copy($recAudio, $storeAudio)){
	echo "failed to copy $recAudio";
}


if(!isset($_FILES['message'])){
    return; //not a post from our script
}

switch($_FILES['message']['error']){
    case UPLOAD_ERR_OK:
        move_uploaded_file($_FILES['message']['tmp_name'], '/home/pi/KasaDaka/recordings/' . $_FILES['message']['name']);
        $prompt = 'Thanks, your message has been saved.'; 
	echo "Goats has been milk, nice.";
        break;
    default:
        $prompt = 'Sorry, we could not save your message.';
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<vxml version="2.1">
    <form>
        <block>
            <prompt><audio src = "intro.wav"/></prompt>
        </block>
    </form>
</vxml>

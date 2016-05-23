<?php

if(file_exists('/tmp/request.log')){
    unlink('/tmp/request.log');
}

$fp = fopen('/tmp/request.log', 'a');

if(!isset($_FILES['message'])){
    fwrite($fp, "big bug\n");
    return;
}

switch($_FILES['message']['error']){
    case UPLOAD_ERR_OK:

	$callerid = $_POST['callerID'];
	fwrite($fp, "\ncallerID: ".$callerid);

	$language = $_REQUEST['language'];
	fwrite($fp, "\nlanguage: ".$language);

	$choice = $_REQUEST['choice_user'];

	fwrite($fp, "\nwhat is this: ".$_FILES['message']['tmp_name']);
        $success_path=file_exists($_FILES['message']['tmp_name']);
	fwrite($fp, "\ncheck path origin: ".$success_path);
	$new_path=__DIR__.'/../recordings/';
	fwrite($fp, "\nnew path".$new_path);
	$success_path_d=file_exists($new_path);
	fwrite($fp, "\ncheck path destiny: ".$success_path_d);
	fwrite($fp, "\ncheck file name: ".$_FILES['message']['name']);
	
	$success=move_uploaded_file($_FILES['message']['tmp_name'], $new_path . $callerid . '_' . $choice . '_' . $language . '_' . date("Y_m_d_h_i_sa") . '.wav');

	fwrite($fp, "\ncopy success: ".$success);
	$prompt = 'Thanks, your message has been saved.';
        break;
    default:
        $prompt = 'Sorry, we could not save your message.';
}
fwrite($fp,'\n');
fclose($fp);

?>

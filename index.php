<?PHP
    header('Cache-Control: no-cache');
    error_reporting (0);
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<vxml version=\"2.0\">";
echo "<form id=\"record\">";
echo "<block>";
if ($HTTP_POST_FILES) {
    foreach ($HTTP_POST_FILES as $key => $value) {
        foreach ($value as $msg) {
            if (strpos($msg, "WINNT")) { $ServerSide = $msg; }
            if (strpos($msg, ".wav")) { $ClientSide = $msg; }
        } // for each statement
        $ServerSide = str_replace("\\\\", "/", $ServerSide);
        if (!copy($ServerSide, "/Users/VelijaVelic/Sites/MFR.project/temp.wav")) {
            echo "Could not save filename: " . $ServerSide;
        } // if statement
        else {
            echo "Successfully saved filename: " . $ServerSide;
        } // else statement
    } // for each statement
} // if statement
echo "</block>";
echo "</form>";
echo "</vxml>";
?>
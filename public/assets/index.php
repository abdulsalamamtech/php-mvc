<!-- data:[<MIME-type>][;charset="<encoding>"][;base64],<data> -->
<?php

function binToImg($file){
    $base64 = base64_encode($file);
    return ('data:'.'image/png'.';base64,'.$base64);
}

echo "<br>";
$file = file_get_contents("../../storage/images/app-flutterwave-plan.jpeg");
$file = binToImg($file);
// print_r($file);
?>


<br>
<img src="<?=$file?>" 
    alt="file inside the storage directory" 
    width="300px">
<br>
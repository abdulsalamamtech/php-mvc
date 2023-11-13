

<div>
    <h2 class="error">They was an error</h2>
    <?php
        if(!empty($errors)) {
            show($errors); 
            foreach($errors as $errror){
                show($error);
            }
            echo implode("<br>", $errors);
        }else{
            echo "no error";
        }
    ?>
</div>
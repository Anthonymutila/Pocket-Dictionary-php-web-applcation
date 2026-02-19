<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dictionary UI Template</title>
<link rel="stylesheet" href="static/styles.css">
</head>
<body>

<div class="container">
    <!-- Search form here -->
    <form action="<?php  htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="post">
            <div class="search-box">
                <input type="text" name="wordToSearch" placeholder="Search for any word..." />
            
            </div>
    </form>
 

<?php

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (empty($_POST['wordToSearch'])) {
        echo '<p>Please enter the word to search</p>';
    }else{
        $word = $_POST['wordToSearch'];  // word to search 
        $url = "https://api.dictionaryapi.dev/api/v2/entries/en/".urlencode($word);
        // data coming from the form
        $response = file_get_contents($url);
        $data = json_decode($response,True);
        echo "<!-- Word Header -->
        <div class='word-header'>
            <div>
                <h1>$word</h1>
                <p class='phonetic'>/ɪɡˈzɑːmpəl/</p>
            </div>
            <div class='play-btn'>▶</div>
        </div>";
        
        foreach ($data[0]['meanings'] as $meaning) {
            echo " <div class='section'><!-- START section -->
                       <div class=section-title'>
                            <span>".$meaning['partOfSpeech']."</span>
                            <div class='line'></div>
                       </div>";
        ?>
            <ul>
             <?php   
            foreach ($meaning['definitions'] as $definition) {
                        echo " <li>".$definition['definition']."</li>";
                     if (isset($definition['example'])) {
                echo "<p><em><b>Example: " . $definition['example']."</b></em></p>";
            }

               
            }?>
            </ul>

            <?php
             
        }
}
    
}

?>

    
<!------------- definations start here------------------->
</div><!--END CONTAINER-->

</body>
</html>

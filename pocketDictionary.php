<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pocket online Dictionary</title>
<link rel="stylesheet" href="static/styles.css">
</head>
<body>

<div class="container">
    <!--header-->
    <?php include("templates/header.html");?>
     



    <?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST['wordToSearch'])) {
            echo '<div class="error"><p>Please enter the word to search</p></div>';
        }else{
           
            if (isset($response)==false){
                echo '<div class="error"><p>Word not found please check the correct spelling</p></div>';
            }else{
            $response = file_get_contents($url);
            $word = $_POST['wordToSearch'];  // word to search 
            $url = "https://api.dictionaryapi.dev/api/v2/entries/en/".urlencode($word);

            // data coming from the form
            $response = file_get_contents($url);
            $data = json_decode($response,True);
            ?> 
            <!-- Word Header -->
            <div class='word-header'>
                <div>
                    <h1><?php echo $word; ?></h1>
                    <p class='phonetic'>/ɪɡˈzɑːmpəl/</p>
                </div>
                <div class='play-btn'>▶</div>
            </div>
            <?php
            foreach ($data[0]['meanings'] as $meaning) {
                ?>
                <div class='section'><!-- START section -->
                    <div class='section-title'>
                        <span><?php echo $meaning['partOfSpeech']; ?></span>
                        <div class='line'></div>
                    </div>
            
                <ul>
                <p class="meaning-label">Meaning</p>
                <?php   
                foreach ($meaning['definitions'] as $definition) {
                    ?>
                
                    
                        <li><?php echo $definition['definition'];?></li>
                    <?php    
                        if (isset($definition['example'])) {
                    ?>
                    <p><em><b>Example: <?php echo $definition['example'];?></b></em></p>
                <?php
                }  } }
                ?>
                </ul></div><!-- END section -->
                <?php
                
            }
    }
        
    }

    ?>

</div><!--END CONTAINER-->

</body>
</html>

<?php // We are creating  a pocket dictionary simple ,fast and lighter?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocket Dictionary</title>
</head>
<body>
     <h2>Pocket Dictionary</h2>
<?php 
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $word = $_POST['wordToSearch'];  // word to search 
    $url = "https://api.dictionaryapi.dev/api/v2/entries/en/".urlencode($word);

    $response = file_get_contents($url);
    $data = json_decode($response,True);
    echo  $data[0]['word'];
}
?>

<form action="<?php  htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="post">
    <label for="country">Enter word to check its meaning: </label><br>
    <input type="text" name="wordToSearch"><br>
    <input type="submit" name="submit" value="check">

</form>
</body>
</html>
<?php 



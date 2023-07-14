<?php 
require_once 'config.php';
include 'shortner.php';
if(isset($_GET['url']) && ($_GET['url'] != "")){

    $shortner = new Shortner($db);
    $slug = $shortner->GetShortUrl($_GET['url']);
    echo "<b><br> Provided Long URL :</b> ".$_GET['url']."<br>";
    echo "<b><br> Short url is :</b> <a href='".$base_url.$slug."'>".$base_url.$slug."</a>";
    echo "<br><br><a href='index.php'>HOME Page - URL Generator</a>";
}else{
   
    if(isset($_GET['randomvalue'])){
        $shortner = new Shortner($db); 
        $long_url = $shortner->GetRedirectUrl($_GET['randomvalue']);
        if($long_url){
            header('Location: '.$long_url);
        }else{
            header('Location: failure.php');
        }
    }else{
?>
    <h1> URL Shortner Home Page</h1>
    <p> Please enter the long URL you want to convert into short URL</p>
    <form action ="">
        <label for='url'> URL: </label>
        <input name="url" id='url' type="url" required>
        <input type="submit" value="submit">
    </form>
<?php }} ?>
<?php
if (!session_id()) @session_start();
$index = -1;
if(isset($_POST['step'])){
    $index = $_POST['step'];
    
}

$dest = '/';
$files = [ 
  'projetAvril.zip',  
];
$root = __DIR__;
if($index>=0 && $index<count($files)){
    $zip = new ZipArchive();
    $file = $files[$index];
    echo $root.'/'.$file;
    if ($zip && $zip->open($root.'/'.$file) === true) {
        for($i = 0; $i < $zip->numFiles; $i++) {
            $zip->extractTo($root.'/'.$dest, array($zip->getNameIndex($i)));
        }
        $zip->close();
    }
}else{
    echo 'debut/fin';
}
$index++;

?>

<form method="post" action="">
    <input type="hidden" name="step" value="<?php echo $index; ?>" />
    <input type="submit" name="next" value="Step <?php echo $index; ?>" />
</form>
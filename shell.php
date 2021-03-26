<?php 

$output = shell_exec('php artisan config:cache && php artisan config:clear && php artisan cache:clear'); 
  
echo "<pre>$output</pre>"; 
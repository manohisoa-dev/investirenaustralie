<?php 

$output = shell_exec('cd .. && php artisan config:cache && php artisan config:clear && php artisan cache:clear'); 
  
echo "<pre>$output</pre>"; 
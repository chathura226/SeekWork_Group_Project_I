<?php
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    foreach($modules as $value) {
        print $value;
        echo "</br>";
      }
    if (in_array('mod_rewrite', $modules)) {
        echo 'mod_rewrite is enabled';
    } else {
        echo 'mod_rewrite is not enabled';
    }
} else {
    echo 'apache_get_modules function not available';
}
?>

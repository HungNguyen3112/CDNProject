<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
$model_dir = $base_dir . 'model' . $ds;
$current_file = basename(__FILE__);
$files = glob($model_dir . '*');

// Lọc bỏ tệp tin hiện tại
$files = array_filter($files, function($file) use ($current_file) {
    return basename($file) !== $current_file;
});

foreach ($files as $file) {
    if (is_file($file)) { // Kiểm tra xem có phải là tệp tin không
        include $file; // Hoặc có thể sử dụng require $file;
    }
}
?>
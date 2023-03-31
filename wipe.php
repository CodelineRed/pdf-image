<?php
function formatFilesize($bytes, $decimals = 0, $decimalPoint = '.', $thousandsSeparator = ',', $unit = '') {
    $B = 1;
    $KB = 1024;
    $MB = 1048576; // 1024 * 1024
    $GB = 1073741824; // 1024 * 1024 * 1024
    $TB = 1099511627776; // 1024 * 1024 * 1024 * 1024
    $PB = 1125899906842624; // 1024 * 1024 * 1024 * 1024 * 1024

    if (empty($unit) || !in_array(strtoupper($unit), ['B', 'KB', 'MB', 'GB', 'TB', 'PB'])) {
        if ($bytes < $KB) {
            $decimals = 0;
            $unit = 'B';
        } elseif ($bytes >= $KB && $bytes < $MB) {
            $unit = 'KB';
        } elseif ($bytes >= $MB && $bytes < $GB) {
            $unit = 'MB';
        } elseif ($bytes >= $GB && $bytes < $TB) {
            $unit = 'GB';
        } elseif ($bytes >= $TB && $bytes < $PB) {
            $unit = 'TB';
        } else {
            $unit = 'PB';
        }
    }

    return number_format(intval($bytes) / $$unit, $decimals, $decimalPoint, $thousandsSeparator) . ' ' . $unit;
}


$files = glob('./files/pdf/**/*.pdf');
$deleted = 0;
foreach ($files as $filename) {
    if (file_exists($filename)) {
        echo $filename . ' (' . formatFilesize(filesize($filename), 2) . ')<br>';
    }

    if (unlink($filename)) {
        $deleted++;
    }
}

echo count($files) ? '<br>' : '';
echo 'Wipe completed!</br>';
echo 'Found ' . count($files) . ' files</br>';
echo 'Deleted ' . $deleted . ' files</br>';

echo '<style>body{background-color:black;color:white;}</style>';
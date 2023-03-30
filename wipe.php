<?php
$files = glob('files/pdf/**/*.pdf');
$deleted = 0;
foreach ($files as $filename) {
    if (unlink($filename)) {
        echo $filename . ' (' . round(filesize($filename) / 1048576, 1) . ' MB)<br>';
        $deleted++;
    }
}

echo count($files) ? '<br>' : '';
echo 'Wipe completed!</br>';
echo 'Found ' . count($files) . ' files</br>';
echo 'Deleted ' . $deleted . ' files</br>';

echo '<style>body{background-color:black;color:white;}</style>';
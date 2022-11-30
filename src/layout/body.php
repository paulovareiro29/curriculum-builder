<?php
$theme = "";
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $theme = "darkmode";
}
?>

<body class="<?= $theme ?>">
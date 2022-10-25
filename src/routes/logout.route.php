<?php

if(isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
    echo "<script>history.back()</script>";
}
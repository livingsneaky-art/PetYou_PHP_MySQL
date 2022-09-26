<?php
    include('./configs/constants.php');

    session_unset();
    session_destroy();

    header("location:".SITEURL."login-page.php");
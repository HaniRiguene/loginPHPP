<?php

session_start();
if(isset($_SESSION['username'])){
    header('Location: ../index.php?l=1');
}



include("../layout.php");
<?php require('adminAFM/conn.php'); ?>
<?php
      session_start();
      function locationHeader()
      {
          if($_SESSION['role'] == "administrator")
            {
                header('Location:adminAFM/index.php');
            }
            else if($_SESSION['role'] == "rider")
            {
            header('Location:riderAFM/profileRider.php');
            }
            else if($_SESSION['role'] == "ss")
            {
            header('Location:supervisorAFM/index.php');
            }
            else
            {
            session_destroy();   
            }
      }
      
      locationHeader();
?>
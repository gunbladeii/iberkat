<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname = "localhost";
$database = "iberkatm_iberkat";
$username = "iberkatm_iberkat";
$password = "shati5620";
$iBerkat = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
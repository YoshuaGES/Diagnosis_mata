<?php 
// mengaktifkan session
session_start();

session_unset(); // menghapus semua variabel session

// menghapus semua session
session_destroy();
 
// mengalihkan halaman sambil mengirim pesan logout
header("Location:login.php");

exit;

?>

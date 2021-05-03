<?php
$konek=mysqli_connect("localhost","root","","dbparkir");

if (mysqli_connect_errno()) {
	printf("Database tidak bisa dibuka: %s\n",      mysqli_connect_errno()); 
} 
 ?>
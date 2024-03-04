<?
session_start(); if(session_is_registered(nik))
{
include"koneksi.php"; header("location:index.html"); session_destroy();
}
else header("location:index1.html");
?>

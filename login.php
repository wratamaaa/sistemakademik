<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

// Lindungi dari SQL Injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$role     = mysqli_real_escape_string($conn, $role);

// Cek ke database
$query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
  $_SESSION['username'] = $username;
  $_SESSION['role']     = $role;

  // Redirect ke dashboard sesuai peran
  if ($role == 'siswa') {  
    header("Location: dashboard-siswa.html");
  } elseif ($role == 'guru') {
    header("Location: dashboard-guru.html");
  } elseif ($role == 'admin') {
    header("Location: dashboard-admin.html");
  }
  exit();
} else {
  echo "<script>
          alert('Login gagal! Periksa kembali username, password, dan role.');
          window.location.href='index.html';
        </script>";
}
?>

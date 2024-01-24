<?php
// mengaktifkan session php
include '../session.php';

// koneksi database
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "admin";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

// db_connect("SELECT * FROM $pilihan WHERE nama='$username' AND password='$password'");

$data = mysqli_query($conn, "SELECT * FROM $pilihan WHERE nama='$username' AND password='$password'");

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
$pilihan = $_POST['pilihan'];

$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:admin/index.php");
} else {
    header("location:index.php?pesan=gagal");
}

// // Mengecek apakah terdapat error ketika membuat koneksi
// // if (mysqli_connect_error()) {
// //     die("Koneksi gagal: " . mysqli_connect_error());
// // }

// // echo "Koneksi berhasil";

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Function to connect to the database
function db_connect($query)
{
    global $conn, $username, $password, $pilihan;


    return $conn;
}

// Function to fetch all rows from a table
function fetch_all($conn, $table)
{
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $rows;
}

// Function to insert a row into a table
function insert_row($conn, $table, $data)
{
    $keys = implode(", ", array_keys($data));
    $values = implode("', '", array_values($data));
    $query = "INSERT INTO $table ($keys) VALUES ('$values')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return true;
}

// Function to update a row in a table
function update_row($conn, $table, $id, $data)
{
    $set = "";
    foreach ($data as $key => $value) {
        $set .= "$key = '$value', ";
    }
    $set = rtrim($set, ", ");
    $query = "UPDATE $table SET $set WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return true;
}

// Function to delete a row from a table
function delete_row($conn, $table, $id)
{
    $query = "DELETE FROM $table WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return true;
}

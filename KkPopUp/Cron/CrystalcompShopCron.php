<?php
$servername = "localhost";
$username = "shopware-admin";
$password = "secret";
$dbname = "shopware";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, name, base_path FROM s_core_shops WHERE base_path IS NOT NULL";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $file = fopen("results.txt", "a",);
    while ($row = mysqli_fetch_assoc($result)) {
        $data = $row['id'] . "," . $row['name'] . "," . $row['base_path'] . "\n";
        fwrite($file, $data);
    }
    fclose($file);
}

mysqli_close($conn);

<!-- Nama : Rosidah Rahmati
     NIM  : 24060122140121
     Lab  : B1
-->

<?php
require_once('./lib/db_login.php');

if (isset($_GET['title'])) {
    // Ambil judul buku dari parameter GET
    $title = $db->real_escape_string($_GET['title']);

    // Buat query untuk mencari buku berdasarkan judul
    $query = "SELECT title, isbn, author, price, categoryid FROM books WHERE title LIKE '%$title%'";
    $result = $db->query($query);

    if (!$result) {
        // Jika ada kesalahan pada query
        echo "<div class='alert-danger alert-dismissible'><strong>Error!!</strong> Could not query the database.<br>";
        echo $db->error . "<br>Query: " . $query;
        echo "</div>";
    } else {
        // Jika ada hasil, tampilkan data buku
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='alert-success alert-dismissible' style='margin-bottom: 20px;'>"; // Tambahkan margin-bottom untuk spasi
                echo "<strong>Book Title:</strong> " . $row['title'] . "<br>";
                echo "<strong>Author:</strong> " . $row['author'] . "<br>";
                echo "<strong>ISBN:</strong> " . $row['isbn'] . "<br>";
                echo "<strong>Price:</strong> " . $row['price'] . "<br>";
                echo "<strong>Category ID:</strong> " . $row['categoryid'] . "<br>";
                echo "</div>";
            }
        } else {
            // Jika tidak ada hasil
            echo "<div class='alert-warning alert-dismissible'>No books found with the title: <strong>" . htmlspecialchars($title) . "</strong></div>";
        }
    }
    // Tutup koneksi database
    $db->close();
}
?>
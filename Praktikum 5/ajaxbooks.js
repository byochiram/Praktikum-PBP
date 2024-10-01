// Nama : Rosidah Rahmati
// NIM  : 24060122140121
// Lab  : B1

// Mendapatkan XMLHttpRequest
function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

// Fungsi untuk pencarian buku berdasarkan judul
function searchBook() {
    var xmlhttp = getXMLHTTPRequest();
    var title = encodeURI(document.getElementById('title').value); // Ambil input judul buku

    // Validasi: jika judul diinputkan, maka lakukan pencarian
    if (title != "") {
        var url = "get_book.php?title=" + title; // Mengirimkan judul ke get_book.php
        var inner = "detail_book";
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function() {
            document.getElementById(inner).innerHTML =
                '<img src="images/ajax_loader.png"/>'; // Menampilkan loader
            if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                document.getElementById(inner).innerHTML = xmlhttp.responseText; // Menampilkan hasil dari server
            }
            return false;
        }
        xmlhttp.send(null); // Kirimkan request
    } else {
        document.getElementById('detail_book').innerHTML = "<p>Please type the book title.</p>";
    }
}

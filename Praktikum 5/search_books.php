<!-- Nama : Rosidah Rahmati
     NIM  : 24060122140121
     Lab  : B1
-->
     
<?php include('./header.php'); ?>

<div class="row w-50 mx-auto">
    <div class="col">
        <div class="card mt-4">
            <div class="card-header">Search Book</div>
            <div class="card-body">
                <form method="GET" autocomplete="on" id="searchBookForm">
                    <div class="mb-3">
                        <label for="title" class="form-label">Book Title:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Type the book title">
                    </div>
                </form>
                <br>
                <div id="detail_book"></div> <!-- Tempat untuk menampilkan detail buku -->
            </div>
        </div>
    </div>
</div>

<!-- Memanggil file ajaxbooks.js -->
<script src="ajaxbooks.js"></script>

<script>
// Event listener ketika input judul diubah
document.getElementById('title').addEventListener('input', searchBook);
</script>

<?php include('./footer.php'); ?>

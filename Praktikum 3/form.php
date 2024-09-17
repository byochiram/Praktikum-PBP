<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error {color: #FF0000;}
        .form-container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f8f9fa;
            margin-top: 20px;
        }
        .form-title {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .ekstrakurikuler-group {
            display: none; 
        }
    </style>
</head>
<body>
    <?php
    // Mendeklarasikan variabel untuk menyimpan nilai dan pesan error
    $nisErr = $namaErr = $kelaminErr = $kelasErr = $ekstrakurikulerErr = "";
    $nis = $nama = $kelamin = $kelas = "";
    $ekstrakurikuler = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi NIS
        if (empty($_POST["nis"])) {
            $nisErr = "NIS harus diisi";
        } else {
            $nis = test_input($_POST["nis"]);
            if (!preg_match("/^[0-9]{10}$/", $nis)) {
                $nisErr = "NIS harus 10 karakter angka";
            }
        }

        // Validasi Nama
        if (empty($_POST["nama"])) {
            $namaErr = "Nama harus diisi";
        } else {
            $nama = test_input($_POST["nama"]);
        }

        // Validasi Jenis Kelamin
        if (empty($_POST["kelamin"])) {
            $kelaminErr = "Jenis kelamin harus dipilih";
        } else {
            $kelamin = test_input($_POST["kelamin"]);
        }

        // Validasi Kelas
        if (empty($_POST["kelas"])) {
            $kelasErr = "Kelas harus diisi";
        } else {
            $kelas = test_input($_POST["kelas"]);
        }

        // Validasi Ekstrakurikuler jika kelas X atau XI
        if ($kelas == "X" || $kelas == "XI") {
            if (empty($_POST["ekstrakurikuler"])) {
                $ekstrakurikulerErr = "Pilih minimal 1 ekstrakurikuler";
            } else {
                $ekstrakurikuler = $_POST["ekstrakurikuler"];
                if (count($ekstrakurikuler) > 3) {
                    $ekstrakurikulerErr = "Maksimal pilih 3 ekstrakurikuler";
                }
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Form Input Siswa</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mt-3">
                <div class="form-group">
                    <label for="nis">NIS:</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis;?>">
                    <?php if($nisErr) { echo "<div class='error'>$nisErr</div>"; } ?>
                </div>

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>">
                    <?php if($namaErr) { echo "<div class='error'>$namaErr</div>"; } ?>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="pria" name="kelamin" <?php if (isset($kelamin) && $kelamin=="Pria") echo "checked";?> value="Pria">
                        <label class="form-check-label" for="pria">Pria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="wanita" name="kelamin" <?php if (isset($kelamin) && $kelamin=="Wanita") echo "checked";?> value="Wanita">
                        <label class="form-check-label" for="wanita">Wanita</label>
                    </div>
                    <?php if($kelaminErr) { echo "<div class='error'>$kelaminErr</div>"; } ?>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas:</label>
                    <select class="form-control" id="kelas" name="kelas" onchange="toggleEkstrakurikuler()">
                        <option value="" <?php if ($kelas == "") echo "selected"; ?>>Pilih Kelas</option>
                        <option value="X" <?php if (isset($kelas) && $kelas=="X") echo "selected";?>>X</option>
                        <option value="XI" <?php if (isset($kelas) && $kelas=="XI") echo "selected";?>>XI</option>
                        <option value="XII" <?php if (isset($kelas) && $kelas=="XII") echo "selected";?>>XII</option>
                    </select>
                    <?php if($kelasErr) { echo "<div class='error'>$kelasErr</div>"; } ?>
                </div>

                <div class="form-group ekstrakurikuler-group" id="ekstrakurikuler-group">
                    <label>Ekstrakurikuler: <br>
                        (minimal 1 dan maksimal 3)</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Pramuka" <?php if (in_array("Pramuka", $ekstrakurikuler)) echo "checked";?>>
                        <label class="form-check-label">Pramuka</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Seni Tari" <?php if (in_array("Seni Tari", $ekstrakurikuler)) echo "checked";?>>
                        <label class="form-check-label">Seni Tari</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Sinematografi" <?php if (in_array("Sinematografi", $ekstrakurikuler)) echo "checked";?>>
                        <label class="form-check-label">Sinematografi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Basket" <?php if (in_array("Basket", $ekstrakurikuler)) echo "checked";?>>
                        <label class="form-check-label">Basket</label>
                    </div>
                    <?php if($ekstrakurikulerErr) { echo "<div class='error'>$ekstrakurikulerErr</div>"; } ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger" onclick="resetForm()">Reset</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nisErr) && empty($namaErr) && empty($kelaminErr) && empty($kelasErr) && empty($ekstrakurikulerErr)) {
                echo "<h2 class='mt-4'>Input Anda:</h2>";
                echo "NIS: " . $nis . "<br>";
                echo "Nama: " . $nama . "<br>";
                echo "Jenis Kelamin: " . $kelamin . "<br>";
                echo "Kelas: " . $kelas . "<br>";
                if (!empty($ekstrakurikuler)) {
                    echo "Ekstrakurikuler: " . implode(", ", $ekstrakurikuler) . "<br>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        function toggleEkstrakurikuler() {
            var kelas = document.getElementById('kelas').value;
            var ekstrakurikulerGroup = document.getElementById('ekstrakurikuler-group');

            if (kelas == 'X' || kelas == 'XI') {
                ekstrakurikulerGroup.style.display = 'block'; // Show ekstrakurikuler options
            } else {
                ekstrakurikulerGroup.style.display = 'none'; // Hide ekstrakurikuler options
            }
        }

        function resetForm() {
            // Reset form and hide ekstrakurikuler options
            document.getElementById('ekstrakurikuler-group').style.display = 'none';
        }

        // Initialize ekstrakurikuler visibility on page load based on current selection
        window.onload = function() {
            toggleEkstrakurikuler();
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

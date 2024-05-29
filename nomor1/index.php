<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuntungan Tertinggi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <?php
    $harga = [9, 8, 9, 7, 8, 5, 9, 4, 6, 10, 2, 4, 6];
    list($keuntunganMax, $hargaBeli, $hargaJual) = cariKeuntunganTertinggi($harga);
        
    function cariKeuntunganTertinggi($harga) {
        $hargaMin = PHP_INT_MAX;
        $keuntunganMax = 0;
        $hargaBeli = 0;
        $hargaJual = 0;

        foreach ($harga as $h) {
            if ($h < $hargaMin) {
                $hargaMin = $h;
            }
            $keuntungan = $h - $hargaMin;
            if ($keuntungan > $keuntunganMax) {
                $keuntunganMax = $keuntungan;
                $hargaBeli = $hargaMin;
                $hargaJual = $h;
            }
        }

        return [$keuntunganMax, $hargaBeli, $hargaJual];
    }

    ?>

    <div class="container mt-5">
        <h1 class="text-center">Keuntungan Tertinggi</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text">Daftar harga: <strong><?php echo implode(', ', $harga); ?></strong></p>
                <p class="card-text">Keuntungan tertinggi adalah: <strong><?php echo $keuntunganMax; ?></strong></p>
                <p class="card-text">Harga beli: <strong><?php echo $hargaBeli; ?></strong></p>
                <p class="card-text">Harga jual: <strong><?php echo $hargaJual; ?></strong></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

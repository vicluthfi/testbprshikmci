<?php
$jsonData = file_get_contents('data.json');
$data = json_decode($jsonData, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 clearfix">
    <div class="row">
        <div class="col-12">
        <form action="export.php" method="post" class="text-center mt-4">
            <h1 class="text-center">Export Data</h1>
                <button type="submit" name="format" value="xls" class="btn btn-primary mx-2 my-2">Export to Excel</button>
                <button type="submit" name="format" value="pdf" class="btn btn-danger mx-2 my-2">Export to PDF</button>
        </form>
        </div>
        </div>
        <div class="mt-5">
            <form class="transparent">
            <h2 class="text-center">Header</h2>
            <div class="table-responsive">
            <table id="headerTable" class="table table-bordered table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>dibuatOleh</th>
                        <th>kodeLJKPermintaan</th>
                        <th>kodeCabangPermintaan</th>
                        <th>kodeTujuanPermintaan</th>
                        <th>tanggalPermintaan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $data['header']['dibuatOleh']; ?></td>
                        <td><?php echo $data['header']['kodeLJKPermintaan']; ?></td>
                        <td><?php echo $data['header']['kodeCabangPermintaan']; ?></td>
                        <td><?php echo $data['header']['kodeTujuanPermintaan']; ?></td>
                        <td><?php echo $data['header']['tanggalPermintaan']; ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            <h3 class="text-center">Data Pokok Debitur</h3>
            <div class="table-responsive">
            <table id="dataPokokDebiturTable" class="table table-bordered table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>namaDebitur</th>
                        <th>namaLengkap</th>
                        <th>npwp</th>
                        <th>bentukBu</th>
                        <th>goPublic</th>
                        <th>bentukBuKet</th>
                        <th>tempatPendirian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['perusahaan']['dataPokokDebitur'] as $debitur): ?>
                    <tr>
                        <td><?php echo $debitur['namaDebitur']; ?></td>
                        <td><?php echo $debitur['namaLengkap']; ?></td>
                        <td><?php echo $debitur['npwp']; ?></td>
                        <td><?php echo $debitur['bentukBu']; ?></td>
                        <td><?php echo $debitur['goPublic']; ?></td>
                        <td><?php echo $debitur['bentukBuKet']; ?></td>
                        <td><?php echo $debitur['tempatPendirian']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <h3 class="text-center">Kelompok Pengurus Pemilik</h3>
            <div class="table-responsive">
            <table id="kelompokPengurusPemilikTable" class="table table-bordered table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>namaPengurus</th>
                        <th>jabatan</th>
                        <th>nomorIdentitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['perusahaan']['kelompokPengurusPemilik'] as $pengurus): ?>
                        <?php foreach ($pengurus['pengurusPemilik'] as $detailPengurus): ?>
                        <tr>
                            <td><?php echo isset($pengurus['namaLJK']) ? $pengurus['namaLJK'] : 'N/A'; ?></td>
                            <td><?php echo isset($detailPengurus['namaSesuaiIdentitas']) ? $detailPengurus['namaSesuaiIdentitas'] : 'N/A'; ?></td>
                            <td><?php echo isset($detailPengurus['nomorIdentitas']) ? $detailPengurus['nomorIdentitas'] : 'N/A'; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
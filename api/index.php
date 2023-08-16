<?php

function http_request($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$data = http_request("http://localhost/api/mahasiswa");
$data = json_decode($data, TRUE); 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tampil Barang</title>
        <link rel="stylesheet" href="layout/css/style.css"> </head>

    <body>
        <div class="wrap">
            <div class="header">
                <h1>STTI API</h1> </div>
            <div class="menu">
                <ul>
                    <li><a href="">Home</a></li>
                </ul>
            </div>
            <div class="badan">
                <div class="sidebar">
                    <ul>
                        <li><a href="../readapi/tampil.php">Produk</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
                <div class="content">
                    <p>DATA PRODUK</p> <a href="../readapi/tambah.php">Tambah Data</a>
                    <table style="width:100%">
                        <tr>
                            <td>nim</td>
                            <td>nama</td>
                        </tr>
                        <?php foreach ($data['data'] as $item) { ?>
                            <tr>
                                <td>
                                    <?= $item["nim"] ?>
                                </td>
                                <td>
                                    <?= $item["nama"] ?>
                                </td>
                            </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
            <div class="footer">
                <p> Sekolah Tinggi Teknologi Indonesia</p>
            </div>
        </div>
    </body>
    </html>
<?php

function http_request($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$data = http_request("http://localhost/api/mahasiswa/".$_GET['tahun']);
$data = json_decode($data, TRUE); 

$menuIdArray = []; // Array baru untuk menyimpan ID saja

foreach ($data["data"] as $item) {
    $menuIdArray[] = $item["menu_id"];
}

$menuIdArray = array_values(array_unique($menuIdArray));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>


    <title>TES - Venturo Camp Tahap 2 </title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="selectRedirect" onchange="redirectToPage()" class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <option value="http://localhost/api/index2.php?tahun=2021">2021</option>
                                    <option value="http://localhost/api/index2.php?tahun=2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                            <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu" class="btn btn-secondary">
                                Json Menu
                            </a>
                            <a href="http://tes-web.landa.id/intermediate/transaksi?tahun=2021" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                Json Transaksi
                            </a>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;">Periode Pada <?php echo $_GET['tahun'] ?>
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                </tr>
                                <?php foreach ($menuIdArray as $menuId) { 
                                    $td = 0;
                                    $x = 1;
                                    while($x <= 12) {
                                        $isTot = false;
                                        foreach ($data['data'] as $item) { 
                                            if($item["tipe_menu"] == 0){
                                                if($item["menu_id"] == $menuId){ 
                                                    if($td != 1){
                                                        echo "<tr> <td>".$item["nama_menu"]."</td>";
                                                        $td++;
                                                    }
                                                    $dateParts = date_parse($item["date"]);
                                                    $monthNumber = $dateParts["month"];
                                                    // echo $x;
                                                    if($monthNumber == $x){
                                                        echo '<td style="text-align: right;">'.$item["total"].'</td>';
                                                        $isTot = true;
                                                    }
                                                } 
                                            }
                                        }  
                                        if($td > 0){
                                            if($isTot == false){
                                                echo '<td style="text-align: right;">0</td>';
                                            }
                                            $x++;
                                        }
                                        // echo $x;

                                    } 
                                    echo "</tr>";
                                } ?>
                                <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                </tr>
                                <?php foreach ($menuIdArray as $menuId) { 
                                    $td = 0;
                                    $x = 1;
                                    while($x <= 12) {
                                        $isTot = false;
                                        foreach ($data['data'] as $item) { 
                                            if($item["tipe_menu"] == 1){
                                                if($item["menu_id"] == $menuId){ 
                                                    if($td != 1){
                                                        echo "<tr> <td>".$item["nama_menu"]."</td>";
                                                        $td++;
                                                    }
                                                    $dateParts = date_parse($item["date"]);
                                                    $monthNumber = $dateParts["month"];
                                                    // echo $x;
                                                    if($monthNumber == $x){
                                                        echo '<td style="text-align: right;">'.$item["total"].'</td>';
                                                        $isTot = true;
                                                    }
                                                } 
                                            }
                                        }  
                                        if($td > 0){
                                            if($isTot == false){
                                                echo '<td style="text-align: right;">0</td>';
                                            }
                                            $x++;
                                        }
                                        // echo $x;

                                    } 
                                    echo "</tr>";
                                } ?>

                                <!-- <tr>
                                    <td>Nasi Goreng</td>
                                    <td style="text-align: right;">
                                        130,000
                                    </td>
                                    <td style="text-align: right;">
                                        170,000
                                    </td>
                                    <td style="text-align: right;">
                                        50,000
                                    </td>
                                    <td style="text-align: right;">
                                        100,000
                                    </td>
                                    <td style="text-align: right;">
                                    </td>
                                    <td style="text-align: right;">
                                        65,000
                                    </td>
                                    <td style="text-align: right;">
                                        10,000
                                    </td>
                                    <td style="text-align: right;">
                                        10,000
                                    </td>
                                    <td style="text-align: right;">
                                        50,000
                                    </td>
                                    <td style="text-align: right;">
                                        10,000
                                    </td>
                                    <td style="text-align: right;">
                                        40,000
                                    </td>
                                    <td style="text-align: right;">
                                        30,000
                                    </td>
                                    <td style="text-align: right;"><b>665,000</b></td>
                                </tr>
                            
                            <tr>
                                <td>Nasi Goreng</td>
                                <td style="text-align: right;">
                                    130,000
                                </td>
                                <td style="text-align: right;">
                                    170,000
                                </td>
                                <td style="text-align: right;">
                                    50,000
                                </td>
                                <td style="text-align: right;">
                                    100,000
                                </td>
                                <td style="text-align: right;">
                                </td>
                                <td style="text-align: right;">
                                    65,000
                                </td>
                                <td style="text-align: right;">
                                    10,000
                                </td>
                                <td style="text-align: right;">
                                    10,000
                                </td>
                                <td style="text-align: right;">
                                    50,000
                                </td>
                                <td style="text-align: right;">
                                    10,000
                                </td>
                                <td style="text-align: right;">
                                    40,000
                                </td>
                                <td style="text-align: right;">
                                    30,000
                                </td>
                                <td style="text-align: right;"><b>665,000</b></td>
                            </tr>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            <tr>
                                <td>Teh Hijau</td>
                                <td style="text-align: right;">
                                    60,000
                                </td>
                                <td style="text-align: right;">
                                    70,000
                                </td>
                                <td style="text-align: right;">
                                    90,000
                                </td>
                                <td style="text-align: right;">
                                    190,000
                                </td>
                                <td style="text-align: right;">
                                    10,000
                                </td>
                                <td style="text-align: right;">
                                    150,000
                                </td>
                                <td style="text-align: right;">
                                    40,000
                                </td>
                                <td style="text-align: right;">
                                    10,000
                                </td>
                                <td style="text-align: right;">
                                    40,000
                                </td>
                                <td style="text-align: right;">
                                </td>
                                <td style="text-align: right;">
                                    20,000
                                </td>
                                <td style="text-align: right;">
                                    30,000
                                </td>
                                <td style="text-align: right;"><b>710,000</b></td>
                            </tr> -->
                            <tr class="table-dark">
                                <td><b>Total</b></td>
                                <td style="text-align: right;">
                                    <b>469,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>605,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>350,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>604,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>257,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>464,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>228,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>303,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>229,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>169,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>157,000</b>
                                </td>
                                <td style="text-align: right;">
                                    <b>130,000</b>
                                </td>
                                <td style="text-align: right;"><b>3,965,000</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(isset($menu)){?>
                
            <div class="row m-3">
                <div class="col-6"><h4>Isi Json Menu</h4><pre style="height: 400px; background:#eaeaea;"><?php var_dump($menu) ?></pre></div>
                <div class="col-6"><h4>Isi Json Transaksi</h4><pre style="height: 400px; background:#eaeaea;"><?php var_dump($transaksi) ?></pre></div>
            </div>
            <?php }?>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function redirectToPage() {
            var selectElement = document.getElementById("selectRedirect");
            var selectedValue = selectElement.value;
            
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html style="background:#20B2AA;">
<h1 style="text-align:center; font-family:broadway"> Dashboard Penjualan Barang </h1>
<p style="text-align:center; font-family:bold"> Created by : Moch. Toriqul Muchlissin </p>
<head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
</head>
<body>
    <br>
    <canvas id="barChart" style="border:1px solid black; background:#F8F8FF;padding-right:7px"></canvas>
    <div id="chartcontainer" style="position:absolute; top:850px; left:10px; width:650px; height:500px;">
    <canvas id="pieChart" style="border:1px solid black; background:#FFF0F5"></canvas>
    </div>
    <div id="chartcontainer" style="position:absolute; top:850px; right:10px; width:650px; height:500px;">
    <canvas id="polarChart" style="border:1px solid black; background:#F5FFFA"></canvas>
    </div>
    <?php

    // Koneksikan ke database
    $kon = mysqli_connect("localhost","root","","market");

    //Inisialisasi nilai variabel awal
    $nama_kategori= "";
    $jumlah_bar=null;
    //Query SQL
    $sql="select Kategori,COUNT(*) as 'total' from penjualan GROUP by Kategori";
    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai dari database
        $kategori=$data['Kategori'];
        $nama_kategori .= "'$kategori'". ", ";
        //Mengambil nilai total dari database
        $jum_bar=$data['total'];
        $jumlah_bar .= "$jum_bar". ", ";

    }

    
    //Inisialisasi nilai variabel awal
    $jumlah_profit= "";
    $jumlah_pie=null;
    //Query SQL
    $sql="Select City, SUM(PROFIT) as 'total' from Penjualan GROUP BY City";
    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai dari database
        $profit=$data['City'];
        $jumlah_profit .= "'$profit'". ", ";
        //Mengambil nilai total dari database
        $jum_pie=$data['total'];
        $jumlah_pie .= "$jum_pie". ", ";

    }

    //Inisialisasi nilai variabel awal
    $nama_barang= "";
    $jumlah_pol=null;
    //Query SQL
    $sql="select Nama_Barang,COUNT(*) as 'total' from penjualan GROUP by Qty";
    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai jurusan dari database
        $barang=$data['Nama_Barang'];
        $nama_barang .= "'$barang'". ", ";
        //Mengambil nilai total dari database
        $jum_pol=$data['total'];
        $jumlah_pol .= "$jum_pol". ", ";

    }

?>
<script>
    //BAR CHART
    var ctx = document.getElementById('barChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_kategori; ?>],
            datasets: [{
                label:'Data Kategori Barang',
                backgroundColor: [
                                    'rgb(249, 19, 147)',
                                    'rgb(251, 160, 122)',
                                    'rgb(253, 215, 3)',
                                    'rgb(72, 209, 204)',
                                    'rgb(65, 105, 225)'],
                borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)'],
                borderWidth: 5,
                borderSkipped: 'middle',
                barPercentage: 0.9,
                data: [<?php echo $jumlah_bar; ?>]
            }]
        },

        // Configuration options go here
        options: {
            indexAxis: 'y',
            responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'HORIZONTAL BAR CHART',
                color: '#911',
                 font: {
                    family: 'Comic Sans MS',
                    size: 20,
                    weight: 'bold',
                    lineHeight: 1.2,
          }
            }
        }
    }
});

    // PIE CHART
    var ctx = document.getElementById('pieChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels: [<?php echo $jumlah_profit; ?>],
            datasets: [{
                label:'Data Kuantitas Produk',
                backgroundColor: [
                                    'rgb(26, 128, 127)',
                                    'rgb(63, 255, 128)', 
                                    'rgb(123, 103, 238)'],
                borderColor: [
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)'
                            ],
                data: [<?php echo $jumlah_pie; ?>]
            }]
        },
        // Configuration options go here
        options: {
        plugins: {
            title: {
                display: true,
                text: 'PIE CHART',
                color: '#911',
                 font: {
                    family: 'Comic Sans MS',
                    size: 20,
                    weight: 'bold',
                    lineHeight: 1.2,
          }
            }
        }
    }
});
    //POLAR CHART
    var ctx = document.getElementById('polarChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type:'polarArea',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_barang; ?>],
            datasets: [{
                label: 'My First Dataset',
                backgroundColor: [
                                    'rgb(26, 128, 127)',
                                    'rgb(63, 255, 128)', 
                                    'rgb(123, 103, 238)',
                                    'rgb(251, 160, 122)',
                                    'rgb(124, 252, 2)',
                                    'rgb(75, 0, 130)',
                                    'rgb(218, 165, 32)'],
                borderColor: [
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)',
                                'rgb(0, 0, 0)'
                            ],
                clip :false,
                data: [<?php echo $jumlah_pol; ?>]
            }]
        },

        // Configuration options go here
        options: {
        plugins: {
            title: {
                display: true,
                text: 'POLAR CHART',
                color: '#911',
                 font: {
                    family: 'Comic Sans MS',
                    size: 20,
                    weight: 'bold',
                    lineHeight: 1.2,
          }
            }
        }
    }
});
</script>

</body>
</html>

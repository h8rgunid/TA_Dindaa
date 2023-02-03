*Notifikasi Laporan Harian* <br />
Posisi : <?php echo date("Y-m-d");?><br />

<?php 
    $no=1;
    foreach ($laporan as $row){
        echo "<br>
        ID : ".$row->id."<br>
        Tanggal : ".$row->tanggal."<br>
        Nama : ".$row->nama."<br>
        Penjualan : ".$row->penjualan."";
        $no++;
        }
?>
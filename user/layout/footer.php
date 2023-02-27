<?php
date_default_timezone_set("Asia/Jakarta");
// echo date_default_timezone_get();
$hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
$bulan = array(
    1 => "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
    "September", "Oktober", "September", "November", "Desember"
);
$tgl = date("d");
$bln = date("n");
$hr = date("w");
$thn = date("Y");
$time = date("H:i:s");
// echo("Kalender hari ini:");
// echo("$hari[$hr],$tgl $bulan[$bln] $thn");
?>

<footer class="sticky-footer bg-white ">
    <div class="container my-auto">
        <div class=" text-center  my-auto">
                <span>Copyright &copy; Ahmad Fahmy XI-RPA 2022 - <?= date('Y'); ?></span> 
                <span ><b><?= "$hari[$hr],$tgl $bulan[$bln] $thn "; ?></b></span>
                <b><span id="jam"></span></b>
        </div>
    </div>
</footer>
<script type="text/javascript">        
    function tampilkanwaktu(){         
    var waktu = new Date();  
    var sdate = waktu.getDate() + "";          
    var sh = waktu.getHours() + "";    
    var sm = waktu.getMinutes() + "";     
    var ss = waktu.getSeconds() + "";  
    document.getElementById("jam").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
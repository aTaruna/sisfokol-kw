<?php
session_start();

//////////////////////////////////////////////////////////////////////
// SISFOKOL-YAYASAN v1.0                                            //
// SISFOKOL khusus untuk kalangan internal yayasan,                 //
// agar bisa memantau sekolah - sekolah yang dimiliki.              //
//////////////////////////////////////////////////////////////////////
// Dikembangkan oleh : Agus Muhajir                                 //
// E-Mail : hajirodeon@gmail.com                                    //
// HP/SMS/WA : 081-829-88-54                                        //
// source code :                                                    //
//   http://github.com/hajirodeon                                   //
//   http://gitlab.com/hajirodeon                                   //
//////////////////////////////////////////////////////////////////////




require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admsekkeu.php");
$tpl = LoadTpl("../../template/admsekkeu.html");

nocache();

//nilai
$filenya = "lap_bulan.php";
$judul = "Per Bulan";
$judul = "[KEUANGAN]. Per Bulan";
$judulku = "$judul";
$judulx = $judul;
$uthn = nosql($_REQUEST['uthn']);

$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}










//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

















//isi *START
ob_start();


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");
?>
	
	
	  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>
  
<?php
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


echo '<div class="row">
	<div class="col-md-12">';
	

	echo "<p>
	Tahun : 
	<br>
	<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
	echo '<option value="'.$uthn.'" selected>'.$uthn.'</option>';
	
	for ($i=$tahun;$i<=$tahun+1;$i++)
		{
		echo '<option value="'.$filenya.'?uthn='.$i.'">'.$i.'</option>';
		}
				
	echo '</select>
	</p>		
	

	
	
	</div>
</div>';


if (empty($uthn))
	{
	echo '<font color="red">
	<h3>TAHUN Belum Dipilih...!!</h3>
	</font>';
	}

	
else
	{
	$warnatext = "white";
	echo '<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="150" align="center"><strong><font color="'.$warnatext.'">BULAN</font></strong></td>
	<td align="center"><strong><font color="'.$warnatext.'">TOTAL UANG MASUK</font></strong></td>
	<td align="center"><strong><font color="'.$warnatext.'">TOTAL UANG KELUAR</font></strong></td>
	<td align="center"><strong><font color="'.$warnatext.'">SISA</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	
	for ($k=1;$k<=12;$k++) 
		{
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		
		//jumlahnya masuk
		$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
										"FROM sekolah_uang_masuk ".
										"WHERE sekolah_kd = '$sekkd84_session' ".
										"AND round(DATE_FORMAT(per_tgl, '%m')) = '$k' ".
										"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$total_masuk = balikin($rku['totalnya']); 


		
		//jumlahnya keluar
		$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
										"FROM sekolah_uang_keluar ".
										"WHERE sekolah_kd = '$sekkd84_session' ".
										"AND round(DATE_FORMAT(per_tgl, '%m')) = '$k' ".
										"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$total_keluar = balikin($rku['totalnya']);



		//sisa
		$total_sisa = $total_masuk - $total_keluar;


		//cek minus ato null
		if (($total_sisa < 0) OR (empty($total_sisa)))
			{
			$cekya1 = "red";
			}
		else
			{
			$cekya1 = "orange";
			}
			


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$arrbln[$k].'</td>
		<td align="right">'.xduit3($total_masuk).'</td>
		<td align="right">'.xduit3($total_keluar).'</td>
		<td align="right" bgcolor="'.$cekya1.'">'.xduit3($total_sisa).'</td>
		</tr>';
		}
	
	
	
	//jumlahnya masuk
	$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
									"FROM sekolah_uang_masuk ".
									"WHERE sekolah_kd = '$sekkd84_session' ".
									"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$total_masuk = balikin($rku['totalnya']); 


	
	//jumlahnya keluar
	$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
									"FROM sekolah_uang_keluar ".
									"WHERE sekolah_kd = '$sekkd84_session' ".
									"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$total_keluar = balikin($rku['totalnya']);


	//sisa
	$total_sisa = $total_masuk - $total_keluar;


	//cek minus ato null
	if (($total_sisa < 0) OR (empty($total_sisa)))
		{
		$cekya1 = "red";
		}
	else
		{
		$cekya1 = "orange";
		}
		


	
	echo '<footer>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50" align="center"><strong><font color="'.$warnatext.'">TOTAL</font></strong></td>
	<td align="right"><strong><font color="'.$warnatext.'">'.xduit3($total_masuk).'</font></strong></td>
	<td align="right"><strong><font color="'.$warnatext.'">'.xduit3($total_keluar).'</font></strong></td>
	<td align="right" bgcolor="'.$cekya1.'"><strong><font color="'.$warnatext.'">'.xduit3($total_sisa).'</font></strong></td>
	</tr>
	
	</footer>
	
	</tbody>
	</table>
	</div>';
	}




//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>
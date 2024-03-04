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
require("../../inc/cek/admsek.php");
$tpl = LoadTpl("../../template/admsek.html");

nocache();

//nilai
$filenya = "lap_tgl.php";
$judul = "Per Tanggal";
$judul = "[KEUANGAN]. Per Tanggal";
$judulku = "$judul";
$judulx = $judul;
$ubln = nosql($_REQUEST['ubln']);
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
	Bulan : 
	<br>
	<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
	echo '<option value="'.$ubln.'" selected>'.$arrbln[$ubln].'</option>';
	
	for ($i=1;$i<=12;$i++)
		{
		echo '<option value="'.$filenya.'?ubln='.$i.'">'.$arrbln[$i].'</option>';
		}
				
	echo '</select>';
	


	echo "<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
	echo '<option value="'.$uthn.'" selected>'.$uthn.'</option>';
	
	for ($i=$tahun;$i<=$tahun+1;$i++)
		{
		echo '<option value="'.$filenya.'?ubln='.$ubln.'&uthn='.$i.'">'.$i.'</option>';
		}
				
	echo '</select>
	</p>		
	
	
	
	</div>
</div>

<hr>';


if (empty($ubln))
	{
	echo '<font color="red">
	<h3>BULAN Belum Dipilih...!!</h3>
	</font>';
	}


else if (empty($uthn))
	{
	echo '<font color="red">
	<h3>TAHUN Belum Dipilih...!!</h3>
	</font>';
	}
	
else
	{
	$warnatext = "white";
	$month = round($ubln);
	$year = round($uthn);
	
	//tanggal terakhir  
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		
	
	echo '<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50" align="center"><strong><font color="'.$warnatext.'">TANGGAL</font></strong></td>
	<td align="center"><strong><font color="'.$warnatext.'">TOTAL UANG MASUK</font></strong></td>
	<td align="center"><strong><font color="'.$warnatext.'">TOTAL UANG KELUAR</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	
	for ($k=1;$k<=$days_in_month;$k++) 
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
										"WHERE sekolah_kd = '$kd81_session' ".
										"AND round(DATE_FORMAT(per_tgl, '%d')) = '$k' ".
										"AND round(DATE_FORMAT(per_tgl, '%m')) = '$ubln' ".
										"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$total_masuk = balikin($rku['totalnya']); 


		
		//jumlahnya keluar
		$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
										"FROM sekolah_uang_keluar ".
										"WHERE sekolah_kd = '$kd81_session' ".
										"AND round(DATE_FORMAT(per_tgl, '%d')) = '$k' ".
										"AND round(DATE_FORMAT(per_tgl, '%m')) = '$ubln' ".
										"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$total_keluar = balikin($rku['totalnya']);



		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td align="center">'.$k.'.</td>
		<td align="right">'.xduit3($total_masuk).'</td>
		<td align="right">'.xduit3($total_keluar).'</td>
		</tr>';
		}
	
	


	//jumlahnya masuk
	$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
									"FROM sekolah_uang_masuk ".
									"WHERE sekolah_kd = '$kd81_session' ".
									"AND round(DATE_FORMAT(per_tgl, '%m')) = '$ubln' ".
									"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$total_masuk = balikin($rku['totalnya']); 


	
	//jumlahnya keluar
	$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
									"FROM sekolah_uang_keluar ".
									"WHERE sekolah_kd = '$kd81_session' ".
									"AND round(DATE_FORMAT(per_tgl, '%m')) = '$ubln' ".
									"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$uthn'");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$total_keluar = balikin($rku['totalnya']);
	
	echo '<footer>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50" align="center"><strong><font color="'.$warnatext.'">TOTAL</font></strong></td>
	<td align="right"><strong><font color="'.$warnatext.'">'.xduit3($total_masuk).'</font></strong></td>
	<td align="right"><strong><font color="'.$warnatext.'">'.xduit3($total_keluar).'</font></strong></td>
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
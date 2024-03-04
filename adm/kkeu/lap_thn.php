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
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/adm.html");

nocache();

//nilai
$filenya = "lap_thn.php";
$judul = "[KEUANGAN SEKOLAH]. Per Tahun";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);






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
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>


	<script>
	$(document).ready(function() {
	  		
		$.noConflict();
	    
	});
	</script>
	  
	

<?php
$warnatext = "white";

echo '<form action="'.$filenya.'" method="post" name="formx">
	
<div class="table-responsive">          
<table class="table" border="1">
<thead>

<tr valign="top" bgcolor="'.$warnaheader.'">
<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>';

for ($k=$tahun-1;$k<=$tahun;$k++)
	{
	echo '<td align="center"><strong><font color="'.$warnatext.'">'.$k.'</font></strong></td>';
	}

echo '</tr>

</thead>
<tbody>';



$warna = $warna01;
echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
echo '<td>UANG MASUK</td>';
		

for ($k=$tahun-1;$k<=$tahun;$k++)
	{
	//jumlahnya masuk
	$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
									"FROM sekolah_uang_masuk ".
									"WHERE round(DATE_FORMAT(per_tgl, '%Y')) = '$k'");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$total_masuk = balikin($rku['totalnya']); 
	
	echo '<td align="right">'.xduit2($total_masuk).'</td>';
	}
	
				
echo '</tr>';




$warna = $warna02;
echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
echo '<td>UANG KELUAR</td>';
		

for ($k=$tahun-1;$k<=$tahun;$k++)
	{
	//jumlahnya masuk
	$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
									"FROM sekolah_uang_keluar ".
									"WHERE round(DATE_FORMAT(per_tgl, '%Y')) = '$k'");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$total_keluar = balikin($rku['totalnya']); 
	
	echo '<td align="right">'.xduit2($total_keluar).'</td>';
	}
	
				
echo '</tr>';



echo '</tbody>	
	<tfoot>

	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td align="right"><strong><font color="'.$warnatext.'">SISA</font></strong></td>';
	
	
	for ($k=$tahun-1;$k<=$tahun;$k++)
		{
		//jumlahnya masuk
		$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
										"FROM sekolah_uang_masuk ".
										"WHERE round(DATE_FORMAT(per_tgl, '%Y')) = '$k'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$total_masuk = balikin($rku['totalnya']); 
			

		//jumlahnya keluar
		$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
										"FROM sekolah_uang_keluar ".
										"WHERE round(DATE_FORMAT(per_tgl, '%Y')) = '$k'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		$total_keluar = balikin($rku['totalnya']);
		
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
	
	
	
		echo '<td align="right" bgcolor="'.$cekya1.'"><strong><font color="'.$warnatext.'">'.xduit2($total_sisa).'</font></strong></td>';
		}
	
	echo '</tr>

	</tfoot>

  </table>





<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
<input name="jml" type="hidden" value="'.$count.'">
</td>
</tr>
</table>


</div>



</form>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>
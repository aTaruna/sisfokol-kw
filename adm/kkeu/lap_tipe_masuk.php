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
$filenya = "lap_tipe_masuk.php";
$judul = "[KEUANGAN SEKOLAH]. Per Tipe Masuk";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);
$tipenya = cegah($_REQUEST['tipenya']);
$tahunnya = cegah($_REQUEST['tahunnya']);



$limit = 100;














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
echo "<p>
Per Tipe : 
<select name=\"utglx\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
echo '<option value="'.$tipenya.'">'.$tipenya.'</option>';

//query
$qyuk = mysqli_query($koneksi, "SELECT * FROM m_uang_masuk ".
									"ORDER BY nama ASC");
$ryuk = mysqli_fetch_assoc($qyuk);
									
do
	{
	//nilai
	$yuk_kd = balikin($ryuk['kd']);
	$yuk_nama = balikin($ryuk['nama']);
	$yuk_nama2 = cegah($ryuk['nama']);
	
	
	echo '<option value="'.$filenya.'?tipenya='.$yuk_nama2.'">'.$yuk_nama.'</option>';
	}
while ($ryuk = mysqli_fetch_assoc($qyuk));
	
echo '</select>, '; 

echo "Tahun : 
<select name=\"utglx2\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
echo '<option value="'.$tahunnya.'">'.$tahunnya.'</option>';


for ($k=$tahun-1;$k<=$tahun;$k++)
	{
	echo '<option value="'.$filenya.'?tipenya='.$tipenya.'&tahunnya='.$k.'">'.$k.'</option>';
	}
	
echo '</select>
</p>

<hr>';


//jika null
if ((empty($tipenya)) OR (empty($tahunnya)))
	{
	echo '<font color="red">
	<h3>Pilih Dahulu...</h3>
	</font>';
	}

else
	{
	$warnatext = "white";
    echo '<form action="'.$filenya.'" method="post" name="formx">';


	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM m_sekolah ".
					"ORDER BY nama ASC";

	$sqlresult = $sqlcount;
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);


	echo '<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>';
		
		for ($k=1;$k<=12;$k++)
			{
			echo '<td align="center"><strong><font color="'.$warnatext.'">'.$arrbln[$k].'</font></strong></td>';
			}
		
		echo '</tr>
	
	</thead>
	<tbody>';


	
	if ($count != 0)
		{
		do {
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
	
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_nama = balikin($data['nama']);
			$i_nama2 = cegah($data['nama']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_nama.'</td>';
			

			for ($k=1;$k<=12;$k++)
				{
				//jumlahnya masuk
				$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
												"FROM sekolah_uang_masuk ".
												"WHERE sekolah_kd = '$i_kd' ".
												"AND tipe = '$tipenya' ". 
												"AND round(DATE_FORMAT(per_tgl, '%m')) = '$k' ".
												"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$tahunnya'");
				$rku = mysqli_fetch_assoc($qku);
				$tku = mysqli_num_rows($qku);
				$total_masuk = balikin($rku['totalnya']); 
		
					



				
				echo '<td align="right">'.xduit3($total_masuk).'</td>';
				}
				
							
	        echo '</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	

	
	echo '</tbody>	
		<tfoot>
	
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<th><strong><font color="'.$warnatext.'">TOTAL</font></strong></th>';
		
		
		for ($k=1;$k<=12;$k++)
			{
			//jumlahnya masuk
			$qku = mysqli_query($koneksi, "SELECT SUM(nilai) AS totalnya ".
											"FROM sekolah_uang_masuk ".
											"WHERE tipe = '$tipenya' ".
											"AND round(DATE_FORMAT(per_tgl, '%m')) = '$k' ".
											"AND round(DATE_FORMAT(per_tgl, '%Y')) = '$tahunnya'");
			$rku = mysqli_fetch_assoc($qku);
			$tku = mysqli_num_rows($qku);
			$total_masuk = balikin($rku['totalnya']); 
	

		
			echo '<td align="right"><strong><font color="'.$warnatext.'">'.xduit3($total_masuk).'</font></strong></td>';
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
	}



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>
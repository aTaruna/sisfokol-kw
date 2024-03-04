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
$filenya = "ukeluar.php";
$judul = "Uang Keluar";
$judul = "[KEUANGAN SEKOLAH]. Uang Keluar";
$judulku = "$judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
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








//nek baru
if ($_POST['btnBR'])
	{
	//re-direct
	$ke = "$filenya?s=baru&kd=$x";
	xloc($ke);
	exit();
	}





//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?kunci=$kunci";
	xloc($ke);
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
$warnatext = "white";

//jika null
if (empty($kunci))
	{
	$sqlcount = "SELECT * FROM sekolah_uang_keluar ".
					"ORDER BY per_tgl DESC";
	}
	
else
	{
	$sqlcount = "SELECT * FROM sekolah_uang_keluar ".
					"WHERE kode LIKE '%$kunci%' ".
					"OR sekolah_nama LIKE '%$kunci%' ".
					"OR tipe LIKE '%$kunci%' ".
					"OR nama LIKE '%$kunci%' ".
					"OR nilai LIKE '%$kunci%' ".
					"OR per_tgl LIKE '%$kunci%' ".
					"ORDER BY per_tgl DESC";
	}
	

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);




//ketahui totalnya
$qyuk = mysqli_query($koneksi, "SELECT SUM(nilai) AS total ".
									"FROM sekolah_uang_keluar");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_total = balikin($ryuk['total']);



echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
</p>
	

Total : <b>'.xduit3($yuk_total).'</b>
<div class="table-responsive">          
<table class="table" border="1">
<thead>

<tr valign="top" bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">PER TANGGAL</font></strong></td>
<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
<td align="center"><strong><font color="'.$warnatext.'">TIPE TUJUAN</font></strong></td>
<td align="center"><strong><font color="'.$warnatext.'">KODE</font></strong></td>
<td align="center"><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
<td align="center"><strong><font color="'.$warnatext.'">NOMINAL</font></strong></td>
<td align="center"><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
</tr>
</thead>
<tbody>';

if ($count != 0)
	{
	do 
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

		$nomer = $nomer + 1;
		$i_kd = nosql($data['kd']);
		$i_seknama = balikin($data['sekolah_nama']);
		$i_per_tgl = balikin($data['per_tgl']);
		$i_tipe = balikin($data['tipe']);
		$i_kode = balikin($data['kode']);
		$i_nama = balikin($data['nama']);
		$i_nilai = balikin($data['nilai']);
		$i_ket = balikin($data['ket']);
		$i_postdate = balikin($data['postdate']);

		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_per_tgl.'</td>
		<td>'.$i_seknama.'</td>
		<td>'.$i_tipe.'</td>
		<td>'.$i_kode.'</td>
		<td>'.$i_nama.'</td>
		<td align="right">'.xduit3($i_nilai).'</td>
		<td>'.$i_ket.'</td>
		<td>'.$i_postdate.'</td>
        </tr>';
		}
	while ($data = mysqli_fetch_assoc($result));
	}


echo '</tbody>
  </table>
  </div>


<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
<br>

<input name="jml" type="hidden" value="'.$count.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="page" type="hidden" value="'.$page.'">

</td>
</tr>
</table>
</form>';






//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>
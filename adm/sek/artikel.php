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
$filenya = "artikel.php";
$judul = "[PROFIL SEKOLAH]. Artikel/Info/Berita";
$judulku = "[PROFIL SEKOLAH]. Artikel/Info/Berita";
$judulx = $judul;





//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	



//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");




echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx3">';
//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM sekolah_cp_artikel ".
				"ORDER BY postdate DESC";
$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);

	

if ($count != 0)
	{
	?>
	
	
	  
	  <script>
	  	$(document).ready(function() {
	    $('#table-responsive').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>

	<?php			
	//view data
	echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
	
	
	<div class="table-responsive">          
  <table class="table" border="1">
    <thead>

	<tr bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
	<td><strong><font color="'.$warnatext.'">JUDUL</font></strong></td>
	</tr>
	
    </thead>
    <tbody>';


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

		//nilai
		$nomer = $nomer + 1;
		$i_kd = nosql($data['kd']);
		$i_sekkd = balikin($data['sekolah_kd']);
		$i_seknama = balikin($data['sekolah_nama']);
		$i_kategori = balikin($data['kategori']);
		$i_judul = balikin($data['judul']);
		$i_isi = balikin($data['isi']);
		$i_postdate = $data['postdate'];
		
		$i_filex = "$i_kd.png";
		$nil_foto = "$sumber/filebox/artikel/$i_sekkd/$i_kd/$i_filex";


		//pecah titik - titik
		$i_isi2 = pathasli2($i_isi);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_postdate.'</td>
		<td>
		'.$i_seknama.'
		</td>
		<td>
		<img src="'.$nil_foto.'" height="100">
		</td>
		<td>
		<h3>'.$i_judul.'</h3>
		
		'.$i_isi2.'
		<hr>
		[Kategori : '.$i_kategori.'].
		</td>
		</tr>';
		}
	while ($data = mysqli_fetch_assoc($result));

	echo '</tbody>
		  </table>
		  </div>

	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="300">
	<input name="jml" type="hidden" value="'.$limit.'">
	<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
	<input name="kdku" type="hidden" value="'.nosql($_REQUEST['kdku']).'">
	</td>
	<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
	</tr>
	</table>
	
	
	</form>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>TIDAK ADA DATA.</strong>
	</font>
	</p>';
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>
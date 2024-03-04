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
$filenya = "youtube.php";
$judul = "[PROFIL SEKOLAH]. Link Youtube";
$judulku = "[PROFIL SEKOLAH]. Link Youtube";
$judulx = $judul;
$s = nosql($_REQUEST['s']);




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


//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM sekolah_cp_youtube ".
				"ORDER BY judul ASC";
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
	<td><strong><font color="'.$warnatext.'">JUDUL</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
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
		$i_judul = balikin($data['judul']);
		$i_seknama = balikin($data['sekolah_nama']);
		$i_filex = balikin($data['filex']);
		$i_postdate = $data['postdate'];
		
		//ambil kode untuk embed
		$pecahku = explode("=", $i_filex);
		$i_kata1 = trim($pecahku[1]);
		
		//sebelum tanda &
		$pecahku2 = explode("&", $i_kata1);
		$i_filex2 = trim($pecahku2[0]);
		
		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		'.$i_judul.'
		<br>
		<br>
		
		<iframe width="100%" height="300" src="https://www.youtube.com/embed/'.$i_filex2.'"></iframe>
		<br>
		<a href="'.$i_filex.'" title="'.$i_judul.'" target="_blank">'.$i_filex.'</a>
		

		</td>
		<td>'.$i_seknama.'</td>
		<td>'.$i_postdate.'</td>
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
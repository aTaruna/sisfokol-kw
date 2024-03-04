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
require("../../inc/cek/admseksarpras.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admseksarpras.html");

nocache();

//nilai
$filenya = "forum_komentar.php";
$judul = "[FORUM]. Komentarku";
$judulku = "[FORUM]. Komentarku";
$judulx = $judul;

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






//detail sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
				"WHERE kd = '$sekkd83_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = cegah($rowx['kode']);
$e_nama = cegah($rowx['nama']);





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

?>


  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>

<?php			
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">

<div class="table-responsive">
	<table class="table" border="0">
    <thead>
	<tr>
	<td align="left">
	
		<p>
		<a href="forum.php" class="btn btn-success"><< KEMBALI KE FORUM</a>
		</p>
					
		
	</td>
	
	
	<td align="right">
		<p>
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Cari Topik...">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
		
	</td>
	</tr>
    </thead>
    
    </table>
</div>';
	
	

//query
$p = new Pager();
$start = $p->findStart($limit);

//jika null
if (empty($kunci))
	{
	$sqlcount = "SELECT * FROM user_forum_comment ".
					"WHERE user_kd = '$kd83_session' ".
					"AND user_posisi = 'SARPRAS' ".
					"ORDER BY postdate DESC";
	}
	
else
	{
	$sqlcount = "SELECT * FROM user_forum_comment ".
					"WHERE user_kd = '$kd83_session' ".
					"AND user_posisi = 'SARPRAS' ".
					"AND isi LIKE '%$kunci%' ".
					"ORDER BY postdate DESC";
	}

	
$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);


if ($count != 0)
	{
	//view data
	echo '<div class="table-responsive">
	<table class="table" border="1">
    <thead>
	<tr bgcolor="'.$warnaheader.'">
	<td><strong><font color="'.$warnatext.'">TOPIK FORUM</font></strong></td>
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
		$i_fkd = balikin($data['forum_kd']);
		$i_isi = balikin($data['isi']);
		$i_postdate = balikin($data['postdate']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<h3>'.$i_isi.'</h3>
		<br>
		[Postdate : <b>'.$i_postdate.'</b>].
		<br>
		<a href="forum.php?fkd='.$i_fkd.'" class="btn btn-danger">LIHAT TOPIK FORUM >></a>
		 
		</td>
		</tr>';
		}
	while ($data = mysqli_fetch_assoc($result));

	echo '</tbody>
		  </table>
		  </div>

	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>BELUM ADA KOMENTAR.</strong>
	</font>
	</p>';
	}




echo '</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>
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
$filenya = "memo.php";
$judul = "[SETTING]. Data Memo";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kdku']);
$kdku = nosql($_REQUEST['kdku']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}








//jika baru
if ($_POST['btnBARU'])
	{
	//re-direct
	$ke = "$filenya?s=baru&kdku=$x";
	xloc($ke);
	exit();
	}
	
	
	
	
	





//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	

//jika simpan
if($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);		
	$kdku = nosql($_POST['kdku']);
	$e_judul = cegah($_POST['e_judul']);
	$e_isi = cegah2($_POST['editor']);
	$e_kategori2 = cegah($_POST['e_kategori2']);


	
	//nek null
	if ((empty($e_kategori2)) OR (empty($e_judul)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=baru&kdku=$kdku";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ((empty($s)) OR ($s == "baru"))
			{
			//query
			mysqli_query($koneksi, "INSERT INTO info_dari_majelis(kd, kategori, judul, isi, postdate) VALUES ".
							"('$kdku', '$e_kategori2', '$e_judul', '$e_isi', '$today')");

			//re-direct
			xloc($filenya);
			exit();
			}
		else 
			{
			//query
			mysqli_query($koneksi, "UPDATE info_dari_majelis SET judul = '$e_judul', ".
							"isi = '$e_isi', ".
							"kategori = '$e_kategori2', ".
							"postdate = '$today' ".
							"WHERE kd = '$kdku'");

			
			//re-direct
			xloc($filenya);
			exit();
			}
		}


	exit();
	}






//jika hapus data
if($_POST['btnHPS'])
	{
	//ambil semua
	for ($i=1; $i<=$limit;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM info_dari_majelis ".
									"WHERE kd = '$kd'");

		}



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















	




//isi *START
ob_start();


?>



<script type="text/javascript" src="<?php echo $sumber;?>/inc/class/ckeditor/ckeditor.js"></script>



<?php
//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");




echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formxy">';



//jika edit
//tampilkan form
if (($s == 'baru') OR ($s == 'edit'))
	{
	//query
	$qx = mysqli_query($koneksi, "SELECT * FROM info_dari_majelis ".
									"WHERE kd = '$kdku'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_judul = balikin($rowx['judul']);
	$e_isi = balikin2($rowx['isi']);
	$e_kategori = balikin($rowx['kategori']);
	$e_kategori2 = cegah($rowx['kategori']);
	$e_postdate = $rowx['postdate'];

	//pecah titik - titik
	$e_isi2 = pathasli2($e_isi);
	
	
	
	echo '<h2>Entri Baru/Edit</h2>

	<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx2">
		
	<p>
	Judul : 
	<br>
	<input name="e_judul" id="e_judul" type="text" value="'.$e_judul.'" size="50" class="btn-warning">
	</p>
	
	<p>
	Isi : 
	<br>
	<textarea id="editor" name="editor" rows="20" cols="80" style="width: 100%" class="btn-warning">'.$e_isi2.'</textarea>
	</p>
	<br>
	
	<p>
	Kategori :
	<br>
	<select name="e_kategori2" id="e_kategori2" class="btn btn-warning">
	<option value="'.$e_kategori2.'" selected>--'.$e_kategori.'--</option>';
	
	$qst = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
							"ORDER BY nama ASC");
	$rowst = mysqli_fetch_assoc($qst);
	
	do
		{
		$st_kd = nosql($rowst['kd']);
		$st_nama = cegah($rowst['nama']);
		$st_nama1 = balikin($rowst['nama']);
	
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM info_dari_majelis ".
							"WHERE kategori = '$st_nama'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);
	
	
	
		echo '<option value="'.$st_nama.'">'.$st_nama1.' [Jumlah : '.$total.'].</option>';
		}
	while ($rowst = mysqli_fetch_assoc($qst));
	
	echo '</select>
	</p>
	
	


		
	<p>
	<input name="kdku" id="kdku" type="hidden" value="'.$kdku.'">
	<input name="s" type="hidden" value="'.$s.'">
	
	<button name="btnSMP" id="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">SIMPAN</button>
	
	<button name="btnBTL" id="btnBTL" type="submit" value="BATAL" class="btn btn-info">BATAL</button>
	</p>
	
	
	</form>';
	
	
	?>
	
	
		
	<script type="text/javascript">
	//<![CDATA[
	var roxyFileman = '<?php echo $sumber;?>/inc/class/ckeditor/plugins/fileman/index.html';
	 
	$(function(){
    CKEDITOR.replace( 'editor',{filebrowserBrowseUrl:roxyFileman,
                         filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                         removeDialogTabs: 'link:upload;image:upload'}); 
	});


	//]]>
	</script>
	
	<?php
	}







else 
	{
	$target = "$filenya?s=$s&kunci=$kunci";
	
	
	
	//jika null
	if (empty($kunci))
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT * FROM info_dari_majelis ".
						"ORDER BY postdate DESC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}
	else 
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT * FROM info_dari_majelis ".
						"WHERE kategori LIKE '%$kunci%' ".
						"OR judul LIKE '%$kunci%' ".
						"OR isi LIKE '%$kunci%' ".
						"ORDER BY postdate DESC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}


	echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
	<input name="katkd" type="hidden" value="'.$katkd.'">
	<input name="btnBARU" type="submit" value="ENTRI BARU" class="btn btn-danger">
	</p>
	<br>
	
	</form>



	<form action="'.$filenya.'" method="post" name="formx">
	<p>
	<input name="katkd" type="hidden" value="'.$katkd.'">
	<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
	<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
	</p>';
		


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
		echo '<div class="table-responsive">          
	  <table class="table" border="1">
	    <thead>

		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">KATEGORI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">URAIAN</font></strong></td>
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
			$i_kategori = balikin($data['kategori']);
			$i_judul = balikin($data['judul']);
			$i_isi = balikin($data['isi']);
			$i_postdate = $data['postdate'];




			//pecah titik - titik
			$i_isi2 = pathasli2($i_isi);



			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
    		</td>
			<td>
			<a href="'.$filenya.'?s=edit&kdku='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_postdate.'</td>
			<td>'.$i_kategori.'</td>
			<td>
			<h3>'.$i_judul.'</h3>
			
			'.$i_isi.'
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
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')" class="btn btn-success">
		<input name="btnBTL" type="reset" value="BATAL" class="btn btn-info">
		<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
		</td>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>TIDAK ADA DATA.</strong>
		</font>
		</p>';
		}
		
		
		
		
		
		
	echo '</form>';
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
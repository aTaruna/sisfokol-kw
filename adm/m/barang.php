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



//nilai
$filenya = "barang.php";
$judul = "Kode Barang";
$judul = "[SETTING]. Kode Barang";
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
//jika import
if ($_POST['btnIM'])
	{
	//re-direct
	$ke = "$filenya?s=import";
	xloc($ke);
	exit();
	}







//lama
//import sekarang
if ($_POST['btnIMX'])
	{
	$filex_namex2 = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex2))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=import";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex2, -4);

		if ($ext_filex == ".csv")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);

			//nama file import, diubah menjadi baru...
			$filex_namex2 = "kode_barang.csv";

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex2");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0755);
			chmod($path2,0777);
			chmod($path3,0777);

			//file-nya...
			$uploadfile = $path3;


			
			
			if (($handle = fopen($uploadfile, "r")) !== FALSE) {
				$row = 1;
			    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
						  $i_no = $i_no + 1;
				          $i_xyz = md5("$x$i_no");
					      $i_no = cegah(strip_tags($data[0]));
					      $i_gol = cegah(strip_tags($data[1]));
					      $i_bid = cegah(strip_tags($data[2]));
					      $i_kel = cegah(strip_tags($data[3]));
					      $i_kel_sub = cegah(strip_tags($data[4]));
					      $i_kel_sub_sub = cegah(strip_tags($data[5]));
					      $i_kode = cegah(strip_tags($data[6]));
					      $i_nama = cegah(strip_tags($data[7]));
						  $i_xyz = md5($i_kode);
						  
							//insert
							mysqli_query($koneksi, "INSERT INTO m_kib_kode(kd, golongan, bidang, ".
											"kelompok, kelompok_sub, kelompok_sub_sub, ".
											"kode, nama, postdate) VALUES ".
											"('$i_xyz', '$i_gol', '$i_bid', ".
											"'$i_kel', '$i_kel_sub', '$i_kel_sub_sub', ".
											"'$i_kode', '$i_nama', '$today')");
						  
					

						}
				  		
			
					
			    } //end while
			    fclose($handle);



			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0777);
			unlink ($path1);


			//re-direct
			xloc($filenya);
			exit();
			}
		else
			{
			//salah
			$pesan = "Bukan File .csv . Harap Diperhatikan...!!";
			$ke = "$filenya?s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}







//jika export
//export
if ($_POST['btnEX'])
	{
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "kode_barang.xls";
	$i_judul = "kode_barang";
	



	//header file
	function HeaderingExcel($i_filename)
		{
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$i_filename");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
		}

	
	
	
	//bikin...
	HeaderingExcel($i_filename);
	$workbook = new Workbook("-");
	$worksheet1 =& $workbook->add_worksheet($i_judul);
	$worksheet1->write_string(0,0,"NO.");
	$worksheet1->write_string(0,1,"GOLONGAN");
	$worksheet1->write_string(0,2,"BIDANG");
	$worksheet1->write_string(0,3,"KELOMPOK");
	$worksheet1->write_string(0,4,"SUB");
	$worksheet1->write_string(0,5,"SUB_SUB");
	$worksheet1->write_string(0,6,"KODE");
	$worksheet1->write_string(0,7,"NAMA");


	//data
	$qdt = mysqli_query($koneksi, "SELECT * FROM m_kib_kode ".
									"ORDER BY kode ASC");
	$rdt = mysqli_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_gol = balikin($rdt['golongan']);
		$dt_bid = balikin($rdt['bidang']);
		$dt_kel = balikin($rdt['kelompok']);
		$dt_kel_sub = balikin($rdt['kelompok_sub']);
		$dt_kel_sub_sub = balikin($rdt['kelompok_sub_sub']);
		$dt_kode = balikin($rdt['kode']);
		$dt_nama = balikin($rdt['nama']);


		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_gol);
		$worksheet1->write_string($dt_nox,2,$dt_bid);
		$worksheet1->write_string($dt_nox,3,$dt_kel);
		$worksheet1->write_string($dt_nox,4,$dt_kel_sub);
		$worksheet1->write_string($dt_nox,5,$dt_kel_sub_sub);
		$worksheet1->write_string($dt_nox,6,$dt_kode);
		$worksheet1->write_string($dt_nox,7,$dt_nama);
		}
	while ($rdt = mysqli_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}










//nek import
if ($_POST['btnIM'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}












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






//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);;
	$e_gol = cegah($_POST['e_gol']);
	$e_bid = cegah($_POST['e_bid']);
	$e_kel = cegah($_POST['e_kel']);
	$e_kel_sub = cegah($_POST['e_kel_sub']);
	$e_kel_sub_sub = cegah($_POST['e_kel_sub_sub']);
	$e_kode = cegah($_POST['e_kode']);
	$e_nama = cegah($_POST['e_nama']);


	//nek null
	if ((empty($e_kode)) OR (empty($e_gol)) OR (empty($e_nama)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika insert
		if ($s == "baru")
			{
			mysqli_query($koneksi, "INSERT INTO m_kib_kode(kd, golongan, bidang, kelompok, ".
							"kelompok_sub, kelompok_sub_sub, kode, nama, postdate) VALUES ".
							"('$x', '$e_gol', '$e_bid', '$e_kel', ".
							"'$e_kel_sub', '$e_kel_sub_sub', '$e_kode', '$e_nama', '$today')");


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
			
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE m_kib_kode SET golongan = '$e_gol', ".
							"bidang = '$e_bid', ".
							"kelompok = '$e_kel', ".
							"kelompok_sub = '$e_kel_sub', ".
							"kelompok_sub_sub = '$e_kel_sub_sub', ".
							"kode = '$e_kode', ".
							"nama = '$e_nama' ".
							"WHERE kd = '$kd'");


			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}








//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);
	$ke = "$filenya?page=$page";

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM m_kib_kode ".
						"WHERE kd = '$kd'");
		}

	//auto-kembali
	xloc($filenya);
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
									"WHERE user_posisi = 'MAJELIS' ".
									"AND dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;

//isi
$i_loker = ob_get_contents();
ob_end_clean();







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
//jika import
if ($s == "import")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" enctype="multipart/form-data" name="formxx2">
	
	<p>
	<b>File .csv dengan pembatas antar kolom tanda titik koma ;</b> 
	<br>
		<input name="filex_xls" type="file" size="30" accept=".csv" class="btn btn-warning">
	</p>

	<p>
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		<input name="btnIMX" type="submit" value="IMPORT >>" class="btn btn-danger">
	</p>
	
	
	</form>';	
	?>
		


	</div>
	
	</div>


	<?php
	}










//jika edit / baru
else if (($s == "baru") OR ($s == "edit"))
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysqli_query($koneksi, "SELECT * FROM m_kib_kode ".
						"WHERE kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_gol = balikin($rowx['golongan']);
	$e_bidang = balikin($rowx['bidang']);
	$e_kelompok = balikin($rowx['kelompok']);
	$e_kelompok_sub = balikin($rowx['kelompok_sub']);
	$e_kelompok_sub_sub = balikin($rowx['kelompok_sub_sub']);
	$e_kode = balikin($rowx['kode']);
	$e_nama = balikin($rowx['nama']);
	
	
	echo '<form action="'.$filenya.'" method="post" name="formx2">';
	?>
	
	
	
	<div class="row">

	<div class="col-md-3">
		
	<?php
	echo '<p>
	Golongan : 
	<br>
	<input name="e_gol" type="text" value="'.$e_gol.'" size="5" class="btn-warning" required>
	</p>

	<p>
	Bidang : 
	<br>
	<input name="e_bid" type="text" value="'.$e_bid.'" size="5" class="btn-warning" required>
	</p>
	
	<p>
	Kelompok : 
	<br>
	<input name="e_kel" type="text" value="'.$e_kelompok.'" size="5" class="btn-warning" required>
	</p>
	
	<p>
	Kelompok Sub : 
	<br>
	<input name="e_kel_sub" type="text" value="'.$e_kel_sub.'" size="5" class="btn-warning" required>
	</p>
	
	<p>
	Kelompok Sub. Sub : 
	<br>
	<input name="e_kel_sub_sub" type="text" value="'.$e_kel_sub_sub.'" size="5" class="btn-warning" required>
	</p>
	
	</div>
	
	
	</div>
	
	

	<hr>
	

	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	
	<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
	</form>';
	}
	




















else
	{
	$warnatext = "white";
	
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM m_kib_kode ".
						"ORDER BY round(kode) ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM m_kib_kode ".
						"WHERE kode LIKE '%$kunci%' ".
						"ORDER BY round(kode) ASC";
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
	
	
	
	echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
	<input name="btnBR" type="submit" value="ENTRI BARU" class="btn btn-danger">
	<input name="btnIM" type="submit" value="IMPORT EXCEL" class="btn btn-success">
	<input name="btnEX" type="submit" value="EXPORT" class="btn btn-success">
	</p>
	<br>
	
	</form>



	<form action="'.$filenya.'" method="post" name="formx">
	<p>
	<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
	<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
	</p>
		
	
	<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="20">&nbsp;</td>
	<td width="20">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td><strong><font color="'.$warnatext.'">GOLONGAN</font></strong></td>
	<td><strong><font color="'.$warnatext.'">BIDANG</font></strong></td>
	<td><strong><font color="'.$warnatext.'">KELOMPOK</font></strong></td>
	<td><strong><font color="'.$warnatext.'">SUB</font></strong></td>
	<td><strong><font color="'.$warnatext.'">SUB.SUB</font></strong></td>
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
			$i_kode = balikin($data['kode']);
			$i_nama = balikin($data['nama']);
			$i_gol = balikin($data['golongan']);
			$i_bid = balikin($data['bidang']);
			$i_kel = balikin($data['kelompok']);
			$i_kel_sub = balikin($data['kelompok_sub']);
			$i_kel_sub_sub = balikin($data['kelompok_sub_sub']);
			$i_postdate = balikin($data['postdate']);

			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
	        </td>
	        <td>
			<a href="'.$filenya.'?s=edit&page='.$page.'&kd='.$i_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_kode.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_gol.'</td>
			<td>'.$i_bid.'</td>
			<td>'.$i_kel.'</td>
			<td>'.$i_kel_sub.'</td>
			<td>'.$i_kel_sub_sub.'</td>
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
	
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$count.')" class="btn btn-primary">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-warning">
	<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
	
	</td>
	</tr>
	</table>
	</form>';
	}








//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>
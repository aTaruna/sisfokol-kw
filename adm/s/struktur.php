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
$filenya = "struktur.php";
$judul = "[SETTING] STRUKTUR ORGANISASI";
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





//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);;
	$e_nourut = cegah($_POST['e_nourut']);
	$e_kode = cegah($_POST['e_kode']);
	$e_nama = cegah($_POST['e_nama']);
	$e_jabatan = cegah($_POST['e_jabatan']);
	$e_tgl_awal = cegah($_POST['e_tgl_awal']);
	$e_tgl_akhir = cegah($_POST['e_tgl_akhir']);

	//pecah tanggal
	$tgl1_pecah = balikin($e_tgl_awal);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_tgl_awal = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
	
	
	//pecah tanggal
	$tgl1_pecah = balikin($e_tgl_akhir);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_tgl_akhir = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
	
	

				  
				  
	//nek null
	if ((empty($e_kode)) OR (empty($e_jabatan)) OR (empty($e_nama)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//set akses 
		$aksesnya = $e_kode;
		$passx = md5($aksesnya);
		
		
		//jika insert
		if ($s == "baru")
			{
			mysqli_query($koneksi, "INSERT INTO majelis_struktur_organisasi(kd, nourut, kode, nama, jabatan, ".
							"tgl_awal, tgl_akhir, postdate) VALUES ".
							"('$x', '$e_nourut', '$e_kode', '$e_nama', '$e_jabatan', ".
							"'$e_tgl_awal', '$e_tgl_akhir', '$today')");




			//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
			//detail
			$ku_kd = $kd071_session;
			$ku_kode = "MAJELIS";
			$ku_nama = "MAJELIS";

			$ku_ket = cegah("[MENU : $judul]. ENTRI BARU : $e_kode. $e_nama");			
			
			
			//insert
			mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"user_kd, user_kode, user_nama, ".
							"user_posisi, user_jabatan, ket, postdate) VALUES ".
							"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
							"'$ku_kd', '$ku_kode', '$ku_nama', ".
							"'MAJELIS', 'TATA USAHA', '$ku_ket', '$today')");
			//kasi log login ///////////////////////////////////////////////////////////////////////////////////

			
			


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
			
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE majelis_struktur_organisasi SET nourut = '$e_nourut', ".
							"kode = '$e_kode', ".
							"nama = '$e_nama', ".
							"jabatan = '$e_jabatan', ".
							"tgl_awal = '$e_tgl_awal', ".
							"tgl_akhir = '$e_tgl_akhir' ".
							"WHERE kd = '$kd'");





			//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
			//detail
			$ku_kd = $kd071_session;
			$ku_kode = "MAJELIS";
			$ku_nama = "MAJELIS";

			$ku_ket = cegah("[MENU : $judul]. UPDATE : $e_kode. $e_nama");			
			
			
			//insert
			mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"user_kd, user_kode, user_nama, ".
							"user_posisi, user_jabatan, ket, postdate) VALUES ".
							"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
							"'$ku_kd', '$ku_kode', '$ku_nama', ".
							"'MAJELIS', 'TATA USAHA', '$ku_ket', '$today')");
			//kasi log login ///////////////////////////////////////////////////////////////////////////////////





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
		mysqli_query($koneksi, "DELETE FROM majelis_struktur_organisasi ".
						"WHERE kd = '$kd'");
		}

	//auto-kembali
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
//jika edit / baru
if (($s == "baru") OR ($s == "edit"))
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysqli_query($koneksi, "SELECT * FROM majelis_struktur_organisasi ".
						"WHERE kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_nourut = balikin($rowx['nourut']);
	$e_kode = balikin($rowx['kode']);
	$e_nama = balikin($rowx['nama']);
	$e_jabatan = balikin($rowx['jabatan']);
	$e_tgl_awal = balikin($rowx['tgl_awal']);
	$e_tgl_akhir = balikin($rowx['tgl_akhir']);
	
	
	echo '<form action="'.$filenya.'" method="post" name="formx2">
	
	
	<div class="row">

		<div class="col-md-4">
		
			<p>
			NOMOR URUT : 
			<br>
			<input name="e_nourut" type="text" value="'.$e_nourut.'" size="5" class="btn-warning" required>
			</p>

					
			<p>
			NBM/NKTAM/NIP : 
			<br>
			<input name="e_kode" type="text" value="'.$e_kode.'" size="20" class="btn-warning" required>
			</p>
		
			<p>
			NAMA : 
			<br>
			<input name="e_nama" type="text" value="'.$e_nama.'" size="30" class="btn-warning" required>
			</p>
			
			<p>
			JABATAN : 
			<br>
			<input name="e_jabatan" type="text" value="'.$e_jabatan.'" size="15" class="btn-warning" required>
			</p>


		</div>
		
		<div class="col-md-4">
				
			
			<p>
			TMT AWAL : 
			<br>
			<input name="e_tgl_awal" type="date" value="'.$e_tgl_awal.'" size="10" class="btn-warning" required>  
			</p>
			
			<p>
			TMT AKHIR : 
			<br>
			<input name="e_tgl_akhir" type="date" value="'.$e_tgl_akhir.'" size="10" class="btn-warning" required>  
			</p>
				
		</div>
		
		
		
		</div>
	
		

	
	</div>
	
	

	<hr>
	

	<div class="row">

	<div class="col-md-12">

		<input name="jml" type="hidden" value="'.$count.'">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="kd" type="hidden" value="'.$kdx.'">
		<input name="page" type="hidden" value="'.$page.'">
		
		<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-block btn-danger">
	</div>
	
	</div>
	
	
	</form>';
	}
	




















else
	{
	$warnatext = "white";
	
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM majelis_struktur_organisasi ".
						"ORDER BY round(nourut) ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM majelis_struktur_organisasi ".
						"WHERE kode LIKE '%$kunci%' ".
						"OR nama LIKE '%$kunci%' ".
						"OR tgl_awal LIKE '%$kunci%' ".
						"OR tgl_akhir LIKE '%$kunci%' ".
						"OR jabatan LIKE '%$kunci%' ".
						"ORDER BY round(nourut) ASC";
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
	<td width="5"><strong><font color="'.$warnatext.'">NOURUT</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NBM/NIP</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td><strong><font color="'.$warnatext.'">JABATAN</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TMT.AWAL</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TMT.AKHIR</font></strong></td>
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
			$i_nourut = balikin($data['nourut']);
			$i_kode = balikin($data['kode']);
			$i_nama = balikin($data['nama']);
			$i_jabatan = balikin($data['jabatan']);
			$i_tgl_awal = balikin($data['tgl_awal']);
			$i_tgl_akhir = balikin($data['tgl_akhir']);
			$i_postdate = balikin($data['postdate']);

			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
	        </td>
	        <td>
			<a href="'.$filenya.'?s=edit&page='.$page.'&kd='.$i_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nourut.'</td>
			<td>'.$i_kode.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_jabatan.'</td>
			<td>'.$i_tgl_awal.'</td>
			<td>'.$i_tgl_akhir.'</td>
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
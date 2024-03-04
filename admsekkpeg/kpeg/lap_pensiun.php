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
require("../../inc/cek/admsekkepeg.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admsekkepeg.html");

nocache();

//nilai
$filenya = "lap_pensiun.php";
$judul = "Per Pensiun";
$judul = "[DATA]. Per Pensiun";
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
	$i_filename = "per_pensiun.xls";
	$i_judul = "per_pensiun";
	



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
	$worksheet1->write_string(0,1,"NBM/NIP");
	$worksheet1->write_string(0,2,"NAMA");
	$worksheet1->write_string(0,3,"ALAMAT");
	$worksheet1->write_string(0,4,"TELP");
	$worksheet1->write_string(0,5,"EMAIL");
	$worksheet1->write_string(0,6,"JABATAN");
	$worksheet1->write_string(0,7,"LAHIR_TMP");
	$worksheet1->write_string(0,8,"LAHIR_TGL");
	$worksheet1->write_string(0,9,"TAHUN_BEKERJA_DI_SINI");
	$worksheet1->write_string(0,10,"TAHUN_BEKERJA_DI_YAYASAN");
	$worksheet1->write_string(0,11,"IJAZAH");
	$worksheet1->write_string(0,12,"IJAZAH_PDDKN");
	$worksheet1->write_string(0,13,"MENGAJAR/TUGAS");
	$worksheet1->write_string(0,14,"SERTIFIKASI");



	//data
	$qdt = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
									"WHERE sekolah_kd = '$sekkd85_session' ".
									"AND pensiun = 'SUDAH' ".
									"ORDER BY pensiun_tgl DESC");
	$rdt = mysqli_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_kode = balikin($rdt['kode']);
		$dt_nama = balikin($rdt['nama']);
		$dt_alamat = balikin($rdt['alamat']);
		$dt_telp = balikin($rdt['telp']);
		$dt_email = balikin($rdt['email']);
		$dt_jabatan = balikin($rdt['jabatan']);
		$dt_lahir_tmp = balikin($rdt['lahir_tmp']);
		$dt_lahir_tgl = balikin($rdt['lahir_tgl']);
		$dt_tahun_disini = balikin($rdt['bekerja_sejak_disini']);
		$dt_tahun_dimuh = balikin($rdt['bekerja_sejak_dimuh']);
		$dt_ijazah = balikin($rdt['ijazah']);
		$dt_ijazah_pddkn = balikin($rdt['ijazah_pddkn']);
		$dt_tugas = balikin($rdt['mengajar']);
		$dt_sertifikasi = balikin($rdt['sertifikasi']);


		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_kode);
		$worksheet1->write_string($dt_nox,2,$dt_nama);
		$worksheet1->write_string($dt_nox,3,$dt_alamat);
		$worksheet1->write_string($dt_nox,4,$dt_telp);
		$worksheet1->write_string($dt_nox,5,$dt_email);
		$worksheet1->write_string($dt_nox,6,$dt_jabatan);
		$worksheet1->write_string($dt_nox,7,$dt_lahir_tmp);
		$worksheet1->write_string($dt_nox,8,$dt_lahir_tgl);
		$worksheet1->write_string($dt_nox,9,$dt_tahun_disini);
		$worksheet1->write_string($dt_nox,10,$dt_tahun_dimuh);
		$worksheet1->write_string($dt_nox,11,$dt_ijazah);
		$worksheet1->write_string($dt_nox,12,$dt_ijazah_pddkn);
		$worksheet1->write_string($dt_nox,13,$dt_tugas);
		$worksheet1->write_string($dt_nox,14,$dt_sertifikasi);
		}
	while ($rdt = mysqli_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
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
	$sqlcount = "SELECT * FROM sekolah_pegawai ".
					"WHERE sekolah_kd = '$sekkd85_session' ".
					"AND pensiun = 'SUDAH' ".
					"ORDER BY pensiun_tgl DESC";
	}
	
else
	{
	$sqlcount = "SELECT * FROM sekolah_pegawai ".
					"WHERE sekolah_kd = '$sekkd85_session' ".
					"AND pensiun = 'SUDAH' ".
					"AND (kode LIKE '%$kunci%' ".
					"OR nbm LIKE '%$kunci%' ".
					"OR nama LIKE '%$kunci%' ".
					"OR alamat LIKE '%$kunci%' ".
					"OR telp LIKE '%$kunci%' ".
					"OR email LIKE '%$kunci%' ".
					"OR jabatan LIKE '%$kunci%' ".
					"OR lahir_tmp LIKE '%$kunci%' ".
					"OR lahir_tgl LIKE '%$kunci%' ".
					"OR ijazah LIKE '%$kunci%' ".
					"OR ijazah_pddkn LIKE '%$kunci%' ".
					"OR bekerja_sejak_disini LIKE '%$kunci%' ".
					"OR bekerja_sejak_dimuh LIKE '%$kunci%') ".
					"ORDER BY pensiun_tgl DESC";
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
<td><strong><font color="'.$warnatext.'">TANGGAL PENSIUN</font></strong></td>
<td><strong><font color="'.$warnatext.'">NBM/NIP/USERNAME</font></strong></td>
<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
<td><strong><font color="'.$warnatext.'">TELP</font></strong></td>
<td><strong><font color="'.$warnatext.'">EMAIL</font></strong></td>
<td><strong><font color="'.$warnatext.'">JABATAN</font></strong></td>
<td><strong><font color="'.$warnatext.'">TEMPAT,TGL.LAHIR</font></strong></td>
<td><strong><font color="'.$warnatext.'">TAHUN BEKERJA DISINI</font></strong></td>
<td><strong><font color="'.$warnatext.'">TAHUN BEKERJA DI YAYASAN</font></strong></td>
<td><strong><font color="'.$warnatext.'">IJAZAH</font></strong></td>
<td><strong><font color="'.$warnatext.'">MENGAJAR/TUGAS</font></strong></td>
<td><strong><font color="'.$warnatext.'">SERTIFIKASI</font></strong></td>
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
		$i_alamat = balikin($data['alamat']);
		$i_telp = balikin($data['telp']);
		$i_email = balikin($data['email']);
		$i_jabatan = balikin($data['jabatan']);
		$i_lahir_tmp = balikin($data['lahir_tmp']);
		$i_lahir_tgl = balikin($data['lahir_tgl']);
		$i_tahun_disini = balikin($data['bekerja_sejak_disini']);
		$i_tahun_dimuh = balikin($data['bekerja_sejak_dimuh']);
		$i_ijazah = balikin($data['ijazah']);
		$i_ijazah_pddkn = balikin($data['ijazah_pddkn']);
		$i_tugas = balikin($data['mengajar']);
		$i_sertifikasi = balikin($data['sertifikasi']);
		$i_pensiun = balikin($data['pensiun']);
		$i_pensiun_tgl = balikin($data['pensiun_tgl']);
		$i_postdate = balikin($data['postdate']);

		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_pensiun_tgl.'</td>
		<td>'.$i_kode.'</td>
		<td>'.$i_nama.'</td>
		<td>'.$i_alamat.'</td>
		<td>'.$i_telp.'</td>
		<td>'.$i_email.'</td>
		<td>'.$i_jabatan.'</td>
		<td>'.$i_lahir_tmp.', '.$i_lahir_tgl.'</td>
		<td>'.$i_tahun_disini.'</td>
		<td>'.$i_tahun_dimuh.'</td>
		<td>'.$i_ijazah.', '.$i_ijazah_pddkn.'</td>
		<td>'.$i_tugas.'</td>
		<td>'.$i_sertifikasi.'</td>
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
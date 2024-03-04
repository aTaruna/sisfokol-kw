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




//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admsekpeg.php");
$tpl = LoadTpl("../../template/admsekpeg.html");

nocache();

//nilai
$filenya = "profil.php";
$judul = "Profil Diri";
$judulku = "[SETTING] $judul";
$juduli = $judul;









//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);;
	$e_kode = cegah($_POST['e_kode']);
	$e_nama = cegah($_POST['e_nama']);
	$e_alamat = cegah($_POST['e_alamat']);
	$e_telp = cegah($_POST['e_telp']);
	$e_email = cegah($_POST['e_email']);
	$e_jabatan = cegah($_POST['e_jabatan']);
	
	$e_lahir_tmp = cegah($_POST['e_lahir_tmp']);
	$e_lahir_tgl = cegah($_POST['e_lahir_tgl']);
	
	//pecah tanggal
	$tgl1_pecah = balikin($e_lahir_tgl);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_lahir_tgl = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
	
	
	
	$e_tahun_disini = cegah($_POST['e_tahun_disini']);
	$e_tahun_dimuh = cegah($_POST['e_tahun_dimuh']);
	$e_ijazah = cegah($_POST['e_ijazah']);
	$e_ijazah_pddkn = cegah($_POST['e_ijazah_pddkn']);
	$e_ijazah_pddkn = cegah($_POST['e_ijazah_pddkn']);
	$e_tugas = cegah($_POST['e_tugas']);
	$e_sertifikasi = cegah($_POST['e_sertifikasi']);
	
	$e_pensiun = cegah($_POST['e_pensiun']);
	$e_pensiun_tgl = cegah($_POST['e_pensiun_tgl']);
	
	//pecah tanggal
	$tgl1_pecah = balikin($e_pensiun_tgl);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_pensiun_tgl = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
	
	


	//detail sekolah
	$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
					"WHERE kd = '$sekkd82_session'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_sekkd = cegah($rowx['kd']);
	$e_sekkode = cegah($rowx['kode']);
	$e_seknama = cegah($rowx['nama']);
		
				  
				  
	//nek null
	if ((empty($e_telp)) OR (empty($e_jabatan)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//update
		mysqli_query($koneksi, "UPDATE sekolah_pegawai SET alamat = '$e_alamat', ".
						"telp = '$e_telp', ".
						"email = '$e_email', ".
						"jabatan = '$e_jabatan', ".
						"lahir_tmp = '$e_lahir_tmp', ".
						"lahir_tgl = '$e_lahir_tgl', ".
						"bekerja_sejak_disini = '$e_tahun_disini', ".
						"bekerja_sejak_dimuh = '$e_tahun_dimuh', ".
						"ijazah = '$e_ijazah', ".
						"ijazah_pddkn = '$e_ijazah_pddkn', ".
						"mengajar = '$e_tugas', ".
						"sertifikasi = '$e_sertifikasi', ".
						"pensiun = '$e_pensiun', ".
						"pensiun_tgl = '$e_pensiun_tgl', ".
						"postdate = '$today' ".
						"WHERE sekolah_kd = '$sekkd82_session' ".
						"AND kd = '$kd'");




	
		//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
		//detail
		$qku = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
								"WHERE kd = '$kd82_session'");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kd = cegah($rku['kd']);
		$ku_kode = cegah($rku['kode']);
		$ku_nama = cegah($rku['nama']);
	
		$ku_ket = cegah("$judul. UPDATE PROFIL DIRI : $ku_kode. $ku_nama");			
		
		
		
		//insert
		mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
						"user_kd, user_kode, user_nama, ".
						"user_posisi, user_jabatan, ket, postdate) VALUES ".
						"('$x', '$e_sekkd', '$e_sekkode', '$e_seknama', ".
						"'$ku_kd', '$ku_kode', '$ku_nama', ".
						"'SEKOLAH', 'PEGAWAI', '$ku_ket', '$today')");
		//kasi log login ///////////////////////////////////////////////////////////////////////////////////


		//re-direct
		xloc($filenya);
		exit();
		}
	}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//isi *START
ob_start();




//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$kdx = $kd82_session;

$qx = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
					"WHERE kd = '$kdx'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = balikin($rowx['kode']);
$e_nama = balikin($rowx['nama']);
$e_alamat = balikin($rowx['alamat']);
$e_telp = balikin($rowx['telp']);
$e_email = balikin($rowx['email']);
$e_jabatan = balikin($rowx['jabatan']);
$e_lahir_tmp = balikin($rowx['lahir_tmp']);
$e_lahir_tgl = balikin($rowx['lahir_tgl']);
$e_tahun_disini = balikin($rowx['bekerja_sejak_disini']);
$e_tahun_dimuh = balikin($rowx['bekerja_sejak_dimuh']);
$e_ijazah = balikin($rowx['ijazah']);
$e_ijazah_pddkn = balikin($rowx['ijazah_pddkn']);
$e_tugas = balikin($rowx['mengajar']);
$e_sertifikasi = balikin($rowx['sertifikasi']);
$e_pensiun = balikin($rowx['pensiun']);
$e_pensiun_tgl = balikin($rowx['pensiun_tgl']);
$e_postdate = balikin($rowx['postdate']);



echo '<form action="'.$filenya.'" method="post" name="formx2">


Update Terakhir : <b>'.$e_postdate.'</b> 
<hr>

<div class="row">

	<div class="col-md-4">
	
	<p>
	NBM/NIP : 
	<br>
	<b>'.$e_kode.'</b>
	</p>

	<p>
	NAMA : 
	<br>
	<b>'.$e_nama.'</b>
	</p>
	
	<p>
	ALAMAT : 
	<br>
	<input name="e_alamat" type="text" value="'.$e_alamat.'" size="30" class="btn-warning" required>
	</p>
	
	<p>
	TELPON/WA : 
	<br>
	<input name="e_telp" type="text" value="'.$e_telp.'" size="20" class="btn-warning" required>
	</p>
	
	<p>
	E-Mail : 
	<br>
	<input name="e_email" type="text" value="'.$e_email.'" size="30" class="btn-warning" required>
	</p>
	
	</div>
	
	<div class="col-md-4">
	
	
	<p>
	JABATAN : 
	<br>
	<input name="e_jabatan" type="text" value="'.$e_jabatan.'" size="20" class="btn-warning" required>
	</p>
	

	
	<p>
	TEMPAT, TANGGAL LAHIR : 
	<br>
	<input name="e_lahir_tmp" type="text" value="'.$e_lahir_tmp.'" size="10" class="btn-warning" required>, 
	<input name="e_lahir_tgl" type="date" value="'.$e_lahir_tgl.'" size="10" class="btn-warning" required>  
	</p>
	
	<p>
	TAHUN BEKERJA DISINI SEJAK : 
	<br>
	<input name="e_tahun_disini" type="text" value="'.$e_tahun_disini.'" size="10" class="btn-warning" required>
	</p>
	
	
	<p>
	TAHUN BEKERJA DI YAYASAN SEJAK : 
	<br>
	<input name="e_tahun_dimuh" type="text" value="'.$e_tahun_dimuh.'" size="10" class="btn-warning" required>
	</p>
	
	
		
	</div>
	
	<div class="col-md-4">
	
	<p>
	IJAZAH : 
	<br>
	<input name="e_ijazah" type="text" value="'.$e_ijazah.'" size="5" class="btn-warning" required>
	</p>
	
	
	<p>
	NAMA TEMPAT PENDIDIKAN TERAKHIR : 
	<br>
	<input name="e_ijazah_pddkn" type="text" value="'.$e_ijazah_pddkn.'" size="20" class="btn-warning" required>
	</p>
	
	
	<p>
	MENGAJAR/TUGAS : 
	<br>
	<input name="e_tugas" type="text" value="'.$e_tugas.'" size="30" class="btn-warning" required>
	</p>
	
	<p>
	SUDAH SERTIFIKASI...? : 
	<br>
	<input name="e_sertifikasi" type="text" value="'.$e_sertifikasi.'" size="20" class="btn-warning" required>
	</p>
	
	
	
	<p>
	SUDAH PENSIUN...? : 
	<br>
	<select name="e_pensiun" class="btn-warning" required>
	<option value="'.$e_pensiun.'" selected>'.$e_pensiun.'</option>
	<option value="BELUM">BELUM</option>
	<option value="SUDAH">SUDAH</option>
	</select>
	</p>
	
	<p>
	TANGGAL PENSIUN :
	<br>
	<input name="e_pensiun_tgl" type="date" value="'.$e_pensiun_tgl.'" size="10" class="btn-warning">
	</p>
	
	
	
	
	</div>

	


</div>



<hr>


<input name="jml" type="hidden" value="'.$count.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="page" type="hidden" value="'.$page.'">

<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-block btn-danger">
</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>
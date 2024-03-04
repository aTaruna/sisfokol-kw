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
$tpl = LoadTpl("../../template/adm.html");

nocache();

//nilai
$filenya = "kontak.php";
$judul = "Kontak";
$judulku = "[SETTING] $judul";
$juduli = $judul;









//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_history ".
									"WHERE dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;

//isi
$i_loker = ob_get_contents();
ob_end_clean();









//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}




//jika simpan
if (($_POST['btnSMP']) OR ($_POST['nama']))
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);
	$e_alamat = cegah($_POST['e_alamat']);
	$e_telp = cegah($_POST['e_telp']);
	$e_email = cegah($_POST['e_email']);


	//update
	mysqli_query($koneksi, "UPDATE m_majelis SET alamat = '$e_alamat', ".
								"telp = '$e_telp', ".
								"email = '$e_email', ".
								"postdate = '$today'");

	//re-direct
	xloc($ke);
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
$qx = mysqli_query($koneksi, "SELECT * FROM m_majelis");
$rowx = mysqli_fetch_assoc($qx);
$e_alamat = balikin($rowx['alamat']);
$e_telp = balikin($rowx['telp']);
$e_email = balikin($rowx['email']);


echo '<div class="row">
	<div class="col-md-4">
		<form action="'.$filenya.'" method="post" name="formx2">
		
		<p>
		Alamat : 
		<br>
		<input name="e_alamat" type="text" size="30" value="'.$e_alamat.'" class="btn btn-warning" required>
		</p>
		
		<p>
		Telepon : 
		<br>
		<input name="e_telp" type="text" size="20" value="'.$e_telp.'" class="btn btn-warning" required>
		</p>
		
		<p>
		E-Mail : 
		<br>
		<input name="e_email" type="text" size="25" value="'.$e_email.'" class="btn btn-warning" required>
		</p>
		
		
		<p>
		<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		</p>
		
		</form>
		
	</div>
	
</div>




<br><br><br>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>
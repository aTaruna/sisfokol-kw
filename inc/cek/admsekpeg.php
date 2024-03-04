<?php
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




///cek session //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sekkd82_session = cegah($_SESSION['sekkd82_session']);
$seknama82_session = balikin($_SESSION['seknama82_session']);
$xseknama82_session = cegah($_SESSION['seknama82_session']);
$kd82_session = cegah($_SESSION['kd82_session']);
$xkd82_session = cegah($_SESSION['xkd82_session']);
$nip82_session = cegah($_SESSION['nip82_session']);
$nm82_session = balikin2($_SESSION['nm82_session']);
$xnm82_session = cegah($_SESSION['nm82_session']);
$username82_session = cegah($_SESSION['username82_session']);
$sekpeg82_session = cegah($_SESSION['sekpeg82_session']);
$pass82_session = cegah($_SESSION['pass82_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);


$qbw = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND kd = '$kd82_session' ".
									"AND usernamex = '$username82_session' ".
									"AND passwordx = '$pass82_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($sekkd82_session))
	OR (empty($kd82_session))
	OR (empty($username82_session))
	OR (empty($pass82_session))
	OR (empty($sekpeg82_session))
	OR (empty($hajirobe_session)))
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$pesan = "ANDA BELUM LOGIN. SILAHKAN LOGIN DAHULU...!!!";
	pekem($pesan, $sumber);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////














//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND user_kd = '$kd82_session' ".
									"AND user_jabatan = 'PEGAWAI' ".
									"AND dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;


//isi
$i_loker1 = ob_get_contents();
ob_end_clean();





//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_login ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND user_kd = '$kd82_session' ".
									"AND user_jabatan = 'PEGAWAI' ".
									"AND dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;


//isi
$i_loker2 = ob_get_contents();
ob_end_clean();









//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_gps ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND user_kd = '$kd82_session' ".
									"AND user_jabatan = 'PEGAWAI' ".
									"AND dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;


//isi
$i_loker3 = ob_get_contents();
ob_end_clean();









//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE uuser_sekolah_kd = '$sekkd82_session' ".
									"AND uuser_kd = '$kd82_session' ".
									"AND uuser_posisi = 'PEGAWAI' ".
									"AND dibaca = 'false'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;


//isi
$i_loker4 = ob_get_contents();
ob_end_clean();











//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM info_dari_majelis");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;


//isi
$i_loker5 = ob_get_contents();
ob_end_clean();








//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM info_dari_cabang ".
									"WHERE cabang = '$cabang82_session'");
$jml_notif = mysqli_num_rows($qyuk);

echo $jml_notif;


//isi
$i_loker6 = ob_get_contents();
ob_end_clean();











//isi *START
ob_start();



//jml notif
$jml_notif = $i_loker1 + $i_loker2 + $i_loker3 + $i_loker4 + $i_loker5 + $i_loker6;
echo $jml_notif;


//isi
$i_loker = ob_get_contents();
ob_end_clean();





?>
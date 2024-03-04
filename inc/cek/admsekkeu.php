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
$sekkd84_session = cegah($_SESSION['sekkd84_session']);
$seknama84_session = balikin($_SESSION['seknama84_session']);
$xseknama84_session = cegah($_SESSION['seknama84_session']);
$kd84_session = cegah($_SESSION['kd84_session']);
$xkd84_session = cegah($_SESSION['xkd84_session']);
$nip84_session = cegah($_SESSION['nip84_session']);
$nm84_session = balikin2($_SESSION['nm84_session']);
$xnm84_session = cegah($_SESSION['nm84_session']);
$username84_session = cegah($_SESSION['username84_session']);
$sekkeu84_session = cegah($_SESSION['sekkeu84_session']);
$pass84_session = cegah($_SESSION['pass84_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);


$qbw = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
									"WHERE sekolah_kd = '$sekkd84_session' ".
									"AND kd = '$kd84_session' ".
									"AND usernamex = '$username84_session' ".
									"AND passwordx = '$pass84_session' ".
									"AND user_sarpras = 'true'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($sekkd84_session))
	OR (empty($kd84_session))
	OR (empty($username84_session))
	OR (empty($pass84_session))
	OR (empty($sekkeu84_session))
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
									"WHERE sekolah_kd = '$sekkd84_session' ".
									"AND user_kd = '$kd84_session' ".
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
									"WHERE sekolah_kd = '$sekkd84_session' ".
									"AND user_kd = '$kd84_session' ".
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
									"WHERE sekolah_kd = '$sekkd84_session' ".
									"AND user_kd = '$kd84_session' ".
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
									"WHERE uuser_sekolah_kd = '$sekkd84_session' ".
									"AND uuser_kd = 'KEUANGAN' ".
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
									"WHERE cabang = '$cabang84_session'");
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
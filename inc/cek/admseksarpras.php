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
$sekkd83_session = cegah($_SESSION['sekkd83_session']);
$seknama83_session = balikin($_SESSION['seknama83_session']);
$xseknama83_session = cegah($_SESSION['seknama83_session']);
$kd83_session = cegah($_SESSION['kd83_session']);
$xkd83_session = cegah($_SESSION['xkd83_session']);
$nip83_session = cegah($_SESSION['nip83_session']);
$nm83_session = balikin2($_SESSION['nm83_session']);
$xnm83_session = cegah($_SESSION['nm83_session']);
$username83_session = cegah($_SESSION['username83_session']);
$seksarpras83_session = cegah($_SESSION['seksarpras83_session']);
$pass83_session = cegah($_SESSION['pass83_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);


$qbw = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
									"WHERE sekolah_kd = '$sekkd83_session' ".
									"AND kd = '$kd83_session' ".
									"AND usernamex = '$username83_session' ".
									"AND passwordx = '$pass83_session' ".
									"AND user_sarpras = 'true'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($sekkd83_session))
	OR (empty($kd83_session))
	OR (empty($username83_session))
	OR (empty($pass83_session))
	OR (empty($seksarpras83_session))
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
									"WHERE sekolah_kd = '$sekkd83_session' ".
									"AND user_kd = '$kd83_session' ".
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
									"WHERE sekolah_kd = '$sekkd83_session' ".
									"AND user_kd = '$kd83_session' ".
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
									"WHERE sekolah_kd = '$sekkd83_session' ".
									"AND user_kd = '$kd83_session' ".
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
									"WHERE uuser_sekolah_kd = '$sekkd83_session' ".
									"AND uuser_kd = 'SARPRAS' ".
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
									"WHERE cabang = '$cabang83_session'");
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
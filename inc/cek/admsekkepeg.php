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
$sekkd85_session = cegah($_SESSION['sekkd85_session']);
$seknama85_session = balikin($_SESSION['seknama85_session']);
$xseknama85_session = cegah($_SESSION['seknama85_session']);
$kd85_session = cegah($_SESSION['kd85_session']);
$xkd85_session = cegah($_SESSION['xkd85_session']);
$nip85_session = cegah($_SESSION['nip85_session']);
$nm85_session = balikin2($_SESSION['nm85_session']);
$xnm85_session = cegah($_SESSION['nm85_session']);
$username85_session = cegah($_SESSION['username85_session']);
$sekkpeg85_session = cegah($_SESSION['sekkpeg85_session']);
$pass85_session = cegah($_SESSION['pass85_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);


$qbw = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
									"WHERE sekolah_kd = '$sekkd85_session' ".
									"AND kd = '$kd85_session' ".
									"AND usernamex = '$username85_session' ".
									"AND passwordx = '$pass85_session' ".
									"AND user_kepeg = 'true'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($sekkd85_session))
	OR (empty($kd85_session))
	OR (empty($username85_session))
	OR (empty($pass85_session))
	OR (empty($sekkpeg85_session))
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
									"WHERE sekolah_kd = '$sekkd85_session' ".
									"AND user_kd = '$kd85_session' ".
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
									"WHERE sekolah_kd = '$sekkd85_session' ".
									"AND user_kd = '$kd85_session' ".
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
									"WHERE sekolah_kd = '$sekkd85_session' ".
									"AND user_kd = '$kd85_session' ".
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
									"WHERE uuser_sekolah_kd = '$sekkd85_session' ".
									"AND uuser_kd = 'KEPEGAWAIAN' ".
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
									"WHERE cabang = '$cabang85_session'");
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
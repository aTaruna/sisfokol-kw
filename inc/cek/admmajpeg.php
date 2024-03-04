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
$sekkd072_session = cegah($_SESSION['sekkd072_session']);
$seknama072_session = balikin($_SESSION['seknama072_session']);
$xseknama072_session = cegah($_SESSION['seknama072_session']);
$kd072_session = cegah($_SESSION['kd072_session']);
$xkd072_session = cegah($_SESSION['xkd072_session']);
$nip072_session = cegah($_SESSION['nip072_session']);
$nm072_session = balikin2($_SESSION['nm072_session']);
$xnm072_session = cegah($_SESSION['nm072_session']);
$username072_session = cegah($_SESSION['username072_session']);
$sekpeg072_session = cegah($_SESSION['sekpeg072_session']);
$pass072_session = cegah($_SESSION['pass072_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);


$qbw = mysqli_query($koneksi, "SELECT * FROM majelis_pegawai ".
									"WHERE kd = '$kd072_session' ".
									"AND usernamex = '$username072_session' ".
									"AND passwordx = '$pass072_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($sekkd072_session))
	OR (empty($kd072_session))
	OR (empty($username072_session))
	OR (empty($pass072_session))
	OR (empty($sekpeg072_session))
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
									"WHERE sekolah_kd = '$sekkd072_session' ".
									"AND user_kd = '$kd072_session' ".
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
									"WHERE sekolah_kd = '$sekkd072_session' ".
									"AND user_kd = '$kd072_session' ".
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
									"WHERE sekolah_kd = '$sekkd072_session' ".
									"AND user_kd = '$kd072_session' ".
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
									"WHERE uuser_sekolah_kd = '$sekkd072_session' ".
									"AND uuser_kd = '$kd072_session' ".
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
$jml_notif = $i_loker1 + $i_loker2 + $i_loker3 + $i_loker4 + $i_loker5;
echo $jml_notif;


//isi
$i_loker = ob_get_contents();
ob_end_clean();





?>
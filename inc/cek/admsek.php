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
$kd81_session = cegah($_SESSION['kd81_session']);
$xkd81_session = cegah($_SESSION['xkd81_session']);
$nip81_session = cegah($_SESSION['nip81_session']);
$nm81_session = balikin2($_SESSION['nm81_session']);
$cabang81_session = cegah($_SESSION['cabang81_session']);
$xnm81_session = cegah($_SESSION['xnm81_session']);
$username81_session = cegah($_SESSION['username81_session']);
$sek81_session = cegah($_SESSION['sek81_session']);
$pos81_session = cegah($_SESSION['pos81_session']);
$pass81_session = cegah($_SESSION['pass81_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);




//cek
$qbw = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$kd81_session' ".
									"AND usernamex = '$username81_session' ".
									"AND passwordx = '$pass81_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd81_session))
	OR (empty($username81_session))
	OR (empty($pass81_session))
	OR (empty($sek81_session))
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
									"WHERE sekolah_kd = '$kd81_session' ".
									"AND user_kd = '$kd81_session' ".
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
									"WHERE sekolah_kd = '$kd81_session' ".
									"AND user_kd = '$kd81_session' ".
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
									"WHERE sekolah_kd = '$kd81_session' ".
									"AND user_kd = '$kd81_session' ".
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
									"WHERE uuser_sekolah_kd = '$kd81_session' ".
									"AND uuser_kd = 'TATA USAHA' ".
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
									"WHERE cabang = '$cabang81_session'");
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
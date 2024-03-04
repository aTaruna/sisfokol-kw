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
$kd071_session = cegah($_SESSION['kd071_session']);
$xkd071_session = cegah($_SESSION['xkd071_session']);
$nip071_session = cegah($_SESSION['nip071_session']);
$nm071_session = balikin2($_SESSION['nm071_session']);
$cabang071_session = cegah($_SESSION['cabang071_session']);
$xnm071_session = cegah($_SESSION['xnm071_session']);
$username071_session = cegah($_SESSION['username071_session']);
$sek071_session = cegah($_SESSION['sek071_session']);
$pos071_session = cegah($_SESSION['pos071_session']);
$pass071_session = cegah($_SESSION['pass071_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);




//cek
$qbw = mysqli_query($koneksi, "SELECT * FROM adminx ".
									"WHERE kd = '$kd071_session' ".
									"AND usernamex = '$username071_session' ".
									"AND passwordx = '$pass071_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (($tbw == 0) OR (empty($kd071_session))
	OR (empty($username071_session))
	OR (empty($pass071_session))
	OR (empty($sek071_session))
	OR (empty($hajirobe_session)))
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$pesan = "ANDA BELUM LOGIN. SILAHKAN LOGIN DAHULU...!!!";
	$ke = "$sumber/admin/majelis.php";
	pekem($pesan, $ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










//isi *START
ob_start();



//jml notif
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
									"WHERE sekolah_kd = '$kd071_session' ".
									"AND user_kd = '$kd071_session' ".
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
									"WHERE sekolah_kd = '$kd071_session' ".
									"AND user_kd = '$kd071_session' ".
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
									"WHERE sekolah_kd = '$kd071_session' ".
									"AND user_kd = '$kd071_session' ".
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
									"WHERE uuser_sekolah_kd = '$kd071_session' ".
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
$jml_notif = $i_loker1 + $i_loker2 + $i_loker3 + $i_loker4;
echo $jml_notif;


//isi
$i_loker = ob_get_contents();
ob_end_clean();




?>
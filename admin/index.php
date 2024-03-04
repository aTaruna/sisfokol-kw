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
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
$tpl = LoadTpl("../template/login.html");



nocache();

//nilai
$filenya = "index.php";
$filenya_ke = $sumber;
$judul = "Login";
$judulku = $judul;
$pesan = "Password Salah. Silahkan Ulangi Lagi...!!";






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}





if ($_POST['btnOK'])
	{
	//ambil nilai
	$etipe = nosql($_POST["etipe"]);
	$esekolah = nosql($_POST["esekolah"]);
	$username = cegah($_POST["usernamex"]);
	$password = md5(cegah($_POST["passwordx"]));

	//cek null
	if ((empty($etipe)) OR (empty($esekolah)) OR (empty($username)) OR (empty($password)))
		{
		//diskonek
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika admin sekolah
		if ($etipe == "tp081")
			{
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM m_sekolah ".
											"WHERE kd = '$esekolah' ".
											"AND usernamex = '$username' ".
											"AND passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['kd81_session'] = nosql($row['kd']);
				$_SESSION['nip81_session'] = cegah($row['kode']);
				$_SESSION['username81_session'] = $username;
				$_SESSION['pass81_session'] = $password;
				$_SESSION['sek81_session'] = "SEKOLAH";
				$_SESSION['pos81_session'] = "Tata Usaha";
				$_SESSION['cabang81_session'] = balikin($row['cabang']);
				$_SESSION['nm81_session'] = balikin($row['nama']);
				$_SESSION['xnm81_session'] = cegah($row['nama']);
				$_SESSION['hajirobe_session'] = $hajirobe;
	




				//kasi log login ///////////////////////////////////////////////////////////////////////////////////
				$todayx = $today;
					
				
				
					//ketahui ip
				function get_client_ip_env() {
					$ipaddress = '';
					if (getenv('HTTP_CLIENT_IP'))
						$ipaddress = getenv('HTTP_CLIENT_IP');
					else if(getenv('HTTP_X_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
					else if(getenv('HTTP_X_FORWARDED'))
						$ipaddress = getenv('HTTP_X_FORWARDED');
					else if(getenv('HTTP_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress = getenv('HTTP_FORWARDED');
					else if(getenv('REMOTE_ADDR'))
						$ipaddress = getenv('REMOTE_ADDR');
					else
						$ipaddress = 'UNKNOWN';
					
						return $ipaddress;
					}
				
				
				$ipku = get_client_ip_env();
				
				
									
			
			
																	
				
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"WHERE kd = '$esekolah'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_kode = cegah($rku['kode']);
				$ku_nama = cegah($rku['nama']);
			
					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$esekolah', '$ku_kode', '$ku_nama', ".
								"'$esekolah', '$ku_kode', '$ku_nama', ".
								"'SEKOLAH', 'TATA USAHA', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				


	
				//re-direct
				$ke = "../admsek/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);
	
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}
			
			
			
			
			
		//jika pegawai/karyawan
		else if ($etipe == "tp082")
			{
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM sekolah_pegawai ".
											"WHERE sekolah_kd = '$esekolah' ".
											"AND usernamex = '$username' ".
											"AND passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['sekkd82_session'] = nosql($row['sekolah_kd']);
				$_SESSION['seknama82_session'] = balikin($row['sekolah_nama']);
				$_SESSION['kd82_session'] = nosql($row['kd']);
				$_SESSION['nip82_session'] = nosql($row['kode']);
				$_SESSION['username82_session'] = $username;
				$_SESSION['pass82_session'] = $password;
				$_SESSION['sek82_session'] = "SEKOLAH";
				$_SESSION['sekpeg82_session'] = "PEGAWAI";
				$_SESSION['nm82_session'] = balikin($row['nama']);
				$_SESSION['xnm82_session'] = balikin($row['nama']);
				$_SESSION['hajirobe_session'] = $hajirobe;
				$e_kd = cegah($row['kd']);
				$e_kode = cegah($row['kode']);
				$e_nama = cegah($row['nama']);





				//kasi log login ///////////////////////////////////////////////////////////////////////////////////
				$todayx = $today;
					
				
				
					//ketahui ip
				function get_client_ip_env() {
					$ipaddress = '';
					if (getenv('HTTP_CLIENT_IP'))
						$ipaddress = getenv('HTTP_CLIENT_IP');
					else if(getenv('HTTP_X_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
					else if(getenv('HTTP_X_FORWARDED'))
						$ipaddress = getenv('HTTP_X_FORWARDED');
					else if(getenv('HTTP_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress = getenv('HTTP_FORWARDED');
					else if(getenv('REMOTE_ADDR'))
						$ipaddress = getenv('REMOTE_ADDR');
					else
						$ipaddress = 'UNKNOWN';
					
						return $ipaddress;
					}
				
				
				$ipku = get_client_ip_env();
				
				
									
			
			
																	
				
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"WHERE kd = '$esekolah'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_kode = cegah($rku['kode']);
				$ku_nama = cegah($rku['nama']);
			
					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$esekolah', '$ku_kode', '$ku_nama', ".
								"'$e_kd', '$e_kode', '$e_nama', ".
								"'SEKOLAH', 'PEGAWAI', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				

	
	
	
	
				//re-direct
				$ke = "../admsekpeg/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);
	
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
				
			}




		//jika sarpras
		else if ($etipe == "tp083")
			{
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM sekolah_pegawai ".
											"WHERE sekolah_kd = '$esekolah' ".
											"AND usernamex = '$username' ".
											"AND passwordx = '$password' ".
											"AND user_sarpras = 'true'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['sekkd83_session'] = nosql($row['sekolah_kd']);
				$_SESSION['seknama83_session'] = balikin($row['sekolah_nama']);
				$_SESSION['kd83_session'] = nosql($row['kd']);
				$_SESSION['nip83_session'] = nosql($row['sekolah_kode']);
				$_SESSION['username83_session'] = $username;
				$_SESSION['pass83_session'] = $password;
				$_SESSION['sek83_session'] = "SEKOLAH";
				$_SESSION['seksarpras83_session'] = "SARPRAS";
				$_SESSION['nm83_session'] = balikin($row['sekolah_nama']);
				$_SESSION['xnm83_session'] = balikin($row['sekolah_nama']);
				$_SESSION['cabang83_session'] = cegah($row['cabang']);
				$_SESSION['hajirobe_session'] = $hajirobe;





				//kasi log login ///////////////////////////////////////////////////////////////////////////////////
				$todayx = $today;
					
				
				
					//ketahui ip
				function get_client_ip_env() {
					$ipaddress = '';
					if (getenv('HTTP_CLIENT_IP'))
						$ipaddress = getenv('HTTP_CLIENT_IP');
					else if(getenv('HTTP_X_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
					else if(getenv('HTTP_X_FORWARDED'))
						$ipaddress = getenv('HTTP_X_FORWARDED');
					else if(getenv('HTTP_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress = getenv('HTTP_FORWARDED');
					else if(getenv('REMOTE_ADDR'))
						$ipaddress = getenv('REMOTE_ADDR');
					else
						$ipaddress = 'UNKNOWN';
					
						return $ipaddress;
					}
				
				
				$ipku = get_client_ip_env();
				
				
									
			
			
																	
				
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"WHERE kd = '$esekolah'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_kode = cegah($rku['kode']);
				$ku_nama = cegah($rku['nama']);
			
					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$esekolah', '$ku_kode', '$ku_nama', ".
								"'$esekolah', '$ku_kode', '$ku_nama', ".
								"'SEKOLAH', 'SARPRAS', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				







	
				//re-direct
				$ke = "../admseksarpras/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);
	
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
				
			}








		//jika keuangan
		else if ($etipe == "tp084")
			{
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM sekolah_pegawai ".
											"WHERE sekolah_kd = '$esekolah' ".
											"AND usernamex = '$username' ".
											"AND passwordx = '$password' ".
											"AND user_keu = 'true'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['sekkd84_session'] = nosql($row['sekolah_kd']);
				$_SESSION['seknama84_session'] = balikin($row['sekolah_nama']);
				$_SESSION['kd84_session'] = nosql($row['kd']);
				$_SESSION['nip84_session'] = nosql($row['sekolah_kode']);
				$_SESSION['username84_session'] = $username;
				$_SESSION['pass84_session'] = $password;
				$_SESSION['sek84_session'] = "SEKOLAH";
				$_SESSION['sekkeu84_session'] = "KEUANGAN";
				$_SESSION['nm84_session'] = balikin($row['sekolah_nama']);
				$_SESSION['xnm84_session'] = balikin($row['sekolah_nama']);
				$_SESSION['hajirobe_session'] = $hajirobe;





				//kasi log login ///////////////////////////////////////////////////////////////////////////////////
				$todayx = $today;
					
				
				
					//ketahui ip
				function get_client_ip_env() {
					$ipaddress = '';
					if (getenv('HTTP_CLIENT_IP'))
						$ipaddress = getenv('HTTP_CLIENT_IP');
					else if(getenv('HTTP_X_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
					else if(getenv('HTTP_X_FORWARDED'))
						$ipaddress = getenv('HTTP_X_FORWARDED');
					else if(getenv('HTTP_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress = getenv('HTTP_FORWARDED');
					else if(getenv('REMOTE_ADDR'))
						$ipaddress = getenv('REMOTE_ADDR');
					else
						$ipaddress = 'UNKNOWN';
					
						return $ipaddress;
					}
				
				
				$ipku = get_client_ip_env();
				
				
									
			
			
																	
				
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"WHERE kd = '$esekolah'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_kode = cegah($rku['kode']);
				$ku_nama = cegah($rku['nama']);
			
					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$esekolah', '$ku_kode', '$ku_nama', ".
								"'$esekolah', '$ku_kode', '$ku_nama', ".
								"'SEKOLAH', 'KEUANGAN', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				
	
				//re-direct
				$ke = "../admsekkeu/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//diskonek
				xfree($q);
				xclose($koneksi);
	
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
				
			}

			





		//jika kepegawaian
		else if ($etipe == "tp085")
			{
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM sekolah_pegawai ".
											"WHERE sekolah_kd = '$esekolah' ".
											"AND usernamex = '$username' ".
											"AND passwordx = '$password' ".
											"AND user_kepeg = 'true'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['sekkd85_session'] = nosql($row['sekolah_kd']);
				$_SESSION['seknama85_session'] = balikin($row['sekolah_nama']);
				$_SESSION['kd85_session'] = nosql($row['kd']);
				$_SESSION['nip85_session'] = nosql($row['sekolah_kode']);
				$_SESSION['username85_session'] = $username;
				$_SESSION['pass85_session'] = $password;
				$_SESSION['sek85_session'] = "SEKOLAH";
				$_SESSION['sekkpeg85_session'] = "KEPEGAWAIAN";
				$_SESSION['nm85_session'] = balikin($row['sekolah_nama']);
				$_SESSION['xnm85_session'] = balikin($row['sekolah_nama']);
				$_SESSION['hajirobe_session'] = $hajirobe;
	



				//kasi log login ///////////////////////////////////////////////////////////////////////////////////
				$todayx = $today;
					
				
				
					//ketahui ip
				function get_client_ip_env() {
					$ipaddress = '';
					if (getenv('HTTP_CLIENT_IP'))
						$ipaddress = getenv('HTTP_CLIENT_IP');
					else if(getenv('HTTP_X_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
					else if(getenv('HTTP_X_FORWARDED'))
						$ipaddress = getenv('HTTP_X_FORWARDED');
					else if(getenv('HTTP_FORWARDED_FOR'))
						$ipaddress = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress = getenv('HTTP_FORWARDED');
					else if(getenv('REMOTE_ADDR'))
						$ipaddress = getenv('REMOTE_ADDR');
					else
						$ipaddress = 'UNKNOWN';
					
						return $ipaddress;
					}
				
				
				$ipku = get_client_ip_env();
				
				
									
			
			
																	
				
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"WHERE kd = '$esekolah'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_kode = cegah($rku['kode']);
				$ku_nama = cegah($rku['nama']);
			
					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$esekolah', '$ku_kode', '$ku_nama', ".
								"'$esekolah', '$ku_kode', '$ku_nama', ".
								"'SEKOLAH', 'KEPEGAWAIAN', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				








	
				//re-direct
				$ke = "../admsekkpeg/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
				
			}

		}

	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







echo '<form action="'.$filenya.'" method="post" name="formx">

	<div class="input-group form-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-school"></i></span>
		</div>
		<select name="esekolah" class="form-control" required>
		<option value="" selected>Sekolah</option>';

		//list
		$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"ORDER BY nama ASC");
		$rku = mysqli_fetch_assoc($qku);

		do
			{
			//nilai
			$ku_kd = balikin($rku['kd']);
			$ku_nama = balikin($rku['nama']);
				
			
			echo '<option value="'.$ku_kd.'">'.$ku_nama.'</option>';
			}
		while ($rku = mysqli_fetch_assoc($qku));

		echo '</select>
	</div>


	<div class="input-group form-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user-circle"></i></span>
		</div>
		<select name="etipe" class="form-control" required>
			<option value="">Tipe User</option></option>
			<option value="tp081">Tata Usaha/Admin</option>
			<option value="tp085">Kepegawaian</option>
			<option value="tp083">Sarpras</option>
			<option value="tp084">Keuangan</option>
		</select>
	</div>

	<div class="input-group form-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input name="usernamex" type="text" class="form-control" placeholder="Username" required>
	</div>

	<div class="input-group form-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-key"></i></span>
		</div>
		<input name="passwordx"type="password" class="form-control" placeholder="Password" required>
	</div>

	<div class="form-group text-center">
		<input name="btnOK" type="submit" value="Masuk" class="btn login_btn">
	</div>

	<hr>
	<div class="d-flex justify-content-center">
		<a href="majelis.php" target="_blank" class="btn btn-primary">LOGIN MAJELIS/YAYASAN</a>
	</div>

</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();

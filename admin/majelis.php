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
$tpl = LoadTpl("../template/login_majelis.html");



nocache();

//nilai
$filenya = "majelis.php";
$filenya_ke = $sumber;
$judul = "Login Majelis/Yayasan";
$judulku = $judul;
$pesan = "Username atau Password Salah. Silahkan Ulangi Lagi...!!";






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}




//jika ok
if ($_POST['btnOK'])
	{
	//ambil nilai
	$etipe = cegah($_POST["etipe"]);
	$username = cegah($_POST["usernamex"]);
	$password = md5(cegah($_POST["passwordx"]));

	//cek null
	if ((empty($etipe)) OR (empty($username)) OR (empty($password)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika tata usaha/admin
		if ($etipe == "tp071")
			{	
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM adminx ".
											"WHERE usernamex = '$username' ".
											"AND passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['kd071_session'] = nosql($row['kd']);
				$_SESSION['nip071_session'] = "MAJELIS";
				$_SESSION['username071_session'] = $username;
				$_SESSION['pass071_session'] = $password;
				$_SESSION['sek071_session'] = "MAJELIS";
				$_SESSION['pos071_session'] = "Tata Usaha";
				$_SESSION['cabang071_session'] = "MAJELIS";
				$_SESSION['nm071_session'] = "MAJELIS";
				$_SESSION['xnm071_session'] = "MAJELIS";
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
				$ku_yes = "MAJELIS";
				$ku_kd = nosql($row['kd']);
				$ku_kode = $ku_yes;
				$ku_nama = $ku_yes;
			
					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$ku_kd', '$ku_kode', '$ku_nama', ".
								"'MAJELIS', 'TATA USAHA', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				

				
				
	
				//re-direct
				$ke = "../adm/index.php";
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
			//...................................................................................................
			}


			
		//jika pegawai/karyawan
		else if ($etipe == "tp072")
			{	
			//query
			$q = mysqli_query($koneksi,  "SELECT * FROM majelis_pegawai ".
											"WHERE usernamex = '$username' ".
											"AND passwordx = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);
			$e_kd = cegah($row['kd']);
			$e_kode = cegah($row['kode']);
			$e_nama = cegah($row['nama']);
			$ku_kode = "MAJELIS";
			$ku_nama = "MAJELIS";
			
	
			//cek login
			if ($total != 0)
				{
				session_start();
	
				//nilai
				$_SESSION['sekkd072_session'] = $e_kd;
				$_SESSION['seknama072_session'] = $e_nama;
				$_SESSION['kd072_session'] = nosql($row['kd']);
				$_SESSION['nip072_session'] = nosql($row['kode']);
				$_SESSION['username072_session'] = $username;
				$_SESSION['pass072_session'] = $password;
				$_SESSION['sek072_session'] = "MAJELIS";
				$_SESSION['sekpeg072_session'] = "PEGAWAI";
				$_SESSION['nm072_session'] = balikin($row['nama']);
				$_SESSION['xnm072_session'] = balikin($row['nama']);
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
				
				
									
			

					
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_login(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ipnya, postdate) VALUES ".
								"('$x', '$e_kd', '$ku_kode', '$ku_nama', ".
								"'$e_kd', '$e_kode', '$e_nama', ".
								"'MAJELIS', 'PEGAWAI', '$ipku', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////

				

	
	
				//re-direct
				$ke = "../admmajpeg/index.php";
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
			//...................................................................................................
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
			<span class="input-group-text"><i class="fas fa-user-circle"></i></span>
		</div>
		<select name="etipe" class="form-control" required>
			<option value="">Tipe User</option></option>
			<option value="tp072">Pegawai/Karyawan</option>
			<option value="tp071">Tata Usaha/Admin</option>
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


</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
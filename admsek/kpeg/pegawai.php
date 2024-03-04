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
require("../../inc/cek/admsek.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admsek.html");

nocache();

//nilai
$filenya = "pegawai.php";
$judul = "Data Pegawai";
$judul = "[KEPEGAWAIAN]. Data Pegawai";
$judulku = "$judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}






//detail sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
				"WHERE kd = '$kd81_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = cegah($rowx['kode']);
$e_nama = cegah($rowx['nama']);








//bikin khusus tata usaha
//insert
mysqli_query($koneksi, "INSERT INTO user(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
				"user_kd, user_kode, user_nama, ".
				"user_posisi, user_jabatan, postdate) VALUES ".
				"('$kd81_session', '$kd81_session', '$nip81_session','$xnm81_session', ".
				"'$kd81_session', 'TU', 'TATA USAHA', ".
				"'SEKOLAH', 'TATA USAHA', '$today')");













//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika import
if ($_POST['btnIM'])
	{
	//re-direct
	$ke = "$filenya?s=import";
	xloc($ke);
	exit();
	}







//lama
//import sekarang
if ($_POST['btnIMX'])
	{
	//detail sekolah
	$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
					"WHERE kd = '$kd81_session'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_sekkode = cegah($rowx['kode']);
	$e_seknama = cegah($rowx['nama']);
		
	

	$filex_namex2 = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex2))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=import";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex2, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);

			//nama file import, diubah menjadi baru...
			$filex_namex2 = "data_pegawai$kd81_session.xls";

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex2");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0755);
			chmod($path2,0777);
			chmod($path3,0777);

			//file-nya...
			$uploadfile = $path3;


			//require
			require('../../inc/class/PHPExcel.php');
			require('../../inc/class/PHPExcel/IOFactory.php');


			  // load excel
			  $load = PHPExcel_IOFactory::load($uploadfile);
			  $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
			
			  $i = 1;
			  foreach ($sheets as $sheet) 
			  	{
			    // karena data yang di excel di mulai dari baris ke 2
			    // maka jika $i lebih dari 1 data akan di masukan ke database
			    if ($i > 1) 
			    	{
				      // nama ada di kolom A
				      // sedangkan alamat ada di kolom B
				      $i_no = cegah($sheet['A']);
				      $i_kode = cegah($sheet['B']);
				      $i_xyz = md5($i_kode);
				      $i_nama = cegah($sheet['C']);
				      $i_alamat = cegah($sheet['D']);
				      $i_telp = cegah($sheet['E']);
				      $i_email = cegah($sheet['F']);
				      $i_jabatan = cegah($sheet['G']);
				      $i_lahir_tmp = cegah($sheet['H']);
				      $i_lahir_tgl = cegah($sheet['I']);
				      $i_tahun_disini = cegah($sheet['J']);
				      $i_tahun_dimuh = cegah($sheet['K']);
				      $i_ijazah = cegah($sheet['L']);
				      $i_ijazah_pddkn = cegah($sheet['M']);
				      $i_tugas = cegah($sheet['N']);
				      $i_sertifikasi = cegah($sheet['O']);
					  $i_akses = balikin($i_kode);
					  $i_passx = md5($i_akses);





						//pecah tanggal
						$tgl1_pecah = balikin($i_lahir_tgl);
						$tgl1_pecahku = explode("-", $tgl1_pecah);
						$tgl1_tgl = trim($tgl1_pecahku[2]);
						$tgl1_bln = trim($tgl1_pecahku[1]);
						$tgl1_thn = trim($tgl1_pecahku[0]);
						$i_lahir_tgl = "$tgl1_thn:$tgl1_bln:$tgl1_tgl";
						
						

						//insert
						mysqli_query($koneksi, "INSERT INTO sekolah_pegawai(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
										"kode, nbm, nama, telp, email, alamat, ".
										"jabatan, lahir_tmp, lahir_tgl, ".
										"bekerja_sejak_disini, bekerja_sejak_dimuh, ".
										"ijazah, ijazah_pddkn, mengajar, sertifikasi, ".
										"usernamex, passwordx, postdate) VALUES ".
										"('$i_xyz', '$kd81_session', '$e_sekkode', '$e_seknama', ".
										"'$i_kode', '$i_kode', '$i_nama', '$i_telp', '$i_email', '$i_alamat', ".
										"'$i_jabatan', '$i_lahir_tmp', '$i_lahir_tgl', ".
										"'$i_tahun_disini', '$i_tahun_dimuh', ".
										"'$i_ijazah', '$i_ijazah_pddkn', '$i_tugas', '$i_sertifikasi', ".
										"'$i_akses', '$i_passx', '$today')");


					  
				    }
			
			    $i++;
			  }





			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0777);
			unlink ($path1);



	
		
			//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
			//detail
			$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$kd81_session'");
			$rku = mysqli_fetch_assoc($qku);
			$ku_kd = cegah($rku['kd']);
			$ku_kode = cegah($rku['kode']);
			$ku_nama = cegah($rku['nama']);
		
			$ku_ket = cegah("$judul. IMPORT DATA");			
			
			
			
			//insert
			mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"user_kd, user_kode, user_nama, ".
							"user_posisi, user_jabatan, ket, postdate) VALUES ".
							"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
							"'$ku_kd', '$ku_kode', '$ku_nama', ".
							"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
			//kasi log login ///////////////////////////////////////////////////////////////////////////////////

			
			



			//re-direct
			xloc($filenya);
			exit();
			}
		else
			{
			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}







//jika export
//export
if ($_POST['btnEX'])
	{
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "data_pegawai.xls";
	$i_judul = "data_pegawai";
	



	//header file
	function HeaderingExcel($i_filename)
		{
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$i_filename");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
		}

	
	
	
	//bikin...
	HeaderingExcel($i_filename);
	$workbook = new Workbook("-");
	$worksheet1 =& $workbook->add_worksheet($i_judul);
	$worksheet1->write_string(0,0,"NO.");
	$worksheet1->write_string(0,1,"NBM/NIP");
	$worksheet1->write_string(0,2,"NAMA");
	$worksheet1->write_string(0,3,"ALAMAT");
	$worksheet1->write_string(0,4,"TELP");
	$worksheet1->write_string(0,5,"EMAIL");
	$worksheet1->write_string(0,6,"JABATAN");
	$worksheet1->write_string(0,7,"LAHIR_TMP");
	$worksheet1->write_string(0,8,"LAHIR_TGL");
	$worksheet1->write_string(0,9,"TAHUN_BEKERJA_DI_SINI");
	$worksheet1->write_string(0,10,"TAHUN_BEKERJA_DI_MUHAMMADIYAH");
	$worksheet1->write_string(0,11,"IJAZAH");
	$worksheet1->write_string(0,12,"IJAZAH_PDDKN");
	$worksheet1->write_string(0,13,"MENGAJAR/TUGAS");
	$worksheet1->write_string(0,14,"SERTIFIKASI");



	//data
	$qdt = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
									"WHERE sekolah_kd = '$kd81_session' ".
									"ORDER BY nama ASC");
	$rdt = mysqli_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_kode = balikin($rdt['kode']);
		$dt_nama = balikin($rdt['nama']);
		$dt_alamat = balikin($rdt['alamat']);
		$dt_telp = balikin($rdt['telp']);
		$dt_email = balikin($rdt['email']);
		$dt_jabatan = balikin($rdt['jabatan']);
		$dt_lahir_tmp = balikin($rdt['lahir_tmp']);
		$dt_lahir_tgl = balikin($rdt['lahir_tgl']);
		$dt_tahun_disini = balikin($rdt['bekerja_sejak_disini']);
		$dt_tahun_dimuh = balikin($rdt['bekerja_sejak_dimuh']);
		$dt_ijazah = balikin($rdt['ijazah']);
		$dt_ijazah_pddkn = balikin($rdt['ijazah_pddkn']);
		$dt_tugas = balikin($rdt['mengajar']);
		$dt_sertifikasi = balikin($rdt['sertifikasi']);


		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_kode);
		$worksheet1->write_string($dt_nox,2,$dt_nama);
		$worksheet1->write_string($dt_nox,3,$dt_alamat);
		$worksheet1->write_string($dt_nox,4,$dt_telp);
		$worksheet1->write_string($dt_nox,5,$dt_email);
		$worksheet1->write_string($dt_nox,6,$dt_jabatan);
		$worksheet1->write_string($dt_nox,7,$dt_lahir_tmp);
		$worksheet1->write_string($dt_nox,8,$dt_lahir_tgl);
		$worksheet1->write_string($dt_nox,9,$dt_tahun_disini);
		$worksheet1->write_string($dt_nox,10,$dt_tahun_dimuh);
		$worksheet1->write_string($dt_nox,11,$dt_ijazah);
		$worksheet1->write_string($dt_nox,12,$dt_ijazah_pddkn);
		$worksheet1->write_string($dt_nox,13,$dt_tugas);
		$worksheet1->write_string($dt_nox,14,$dt_sertifikasi);
		}
	while ($rdt = mysqli_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}










//nek import
if ($_POST['btnIM'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}












//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}








//nek baru
if ($_POST['btnBR'])
	{
	//re-direct
	$ke = "$filenya?s=baru&kd=$x";
	xloc($ke);
	exit();
	}





//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?kunci=$kunci";
	xloc($ke);
	exit();
	}






//nek pegawai : reset
if ($s == "reset")
	{ 
	//nilai
	$nilku = rand(11111,99999);
	
	//pass baru
	$passbarux = md5($nilku);
	
	
	//update
	mysqli_query($koneksi, "UPDATE sekolah_pegawai SET passwordx = '$passbarux' ".
					"WHERE kd = '$kd'"); 
	
	
	
		

	//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$kd81_session'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);

	$ku_ket = cegah("$judul. RESET PASWORD");			
	
	
	
	//insert
	mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
					"user_kd, user_kode, user_nama, ".
					"user_posisi, user_jabatan, ket, postdate) VALUES ".
					"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
					"'$ku_kd', '$ku_kode', '$ku_nama', ".
					"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////


	
	
	//re-direct
	$pesan = "Password Baru : $nilku";
	pekem($pesan,$filenya);
	exit();
	}








//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);;
	$e_kode = cegah($_POST['e_kode']);
	$e_nama = cegah($_POST['e_nama']);
	$e_alamat = cegah($_POST['e_alamat']);
	$e_telp = cegah($_POST['e_telp']);
	$e_email = cegah($_POST['e_email']);
	$e_jabatan = cegah($_POST['e_jabatan']);
	
	$e_lahir_tmp = cegah($_POST['e_lahir_tmp']);
	$e_lahir_tgl = cegah($_POST['e_lahir_tgl']);
	
	//pecah tanggal
	$tgl1_pecah = balikin($e_lahir_tgl);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_lahir_tgl = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
	
	
	
	$e_tahun_disini = cegah($_POST['e_tahun_disini']);
	$e_tahun_dimuh = cegah($_POST['e_tahun_dimuh']);
	$e_ijazah = cegah($_POST['e_ijazah']);
	$e_ijazah_pddkn = cegah($_POST['e_ijazah_pddkn']);
	$e_ijazah_pddkn = cegah($_POST['e_ijazah_pddkn']);
	$e_tugas = cegah($_POST['e_tugas']);
	$e_sertifikasi = cegah($_POST['e_sertifikasi']);
	
	$e_pensiun = cegah($_POST['e_pensiun']);
	$e_pensiun_tgl = cegah($_POST['e_pensiun_tgl']);
	
	//pecah tanggal
	$tgl1_pecah = balikin($e_pensiun_tgl);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_pensiun_tgl = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
	
	


	//detail sekolah
	$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
					"WHERE kd = '$kd81_session'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_sekkode = cegah($rowx['kode']);
	$e_seknama = cegah($rowx['nama']);
		
				  
				  
	//nek null
	if ((empty($e_kode)) OR (empty($e_telp)) OR (empty($e_nama)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//set akses 
		$aksesnya = $e_kode;
		$passx = md5($aksesnya);
		
		
		//jika insert
		if ($s == "baru")
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO sekolah_pegawai(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"kode, nbm, nama, ".
							"alamat, telp, email, ".
							"jabatan, lahir_tmp, lahir_tgl, ".
							"bekerja_sejak_disini, bekerja_sejak_dimuh, ".
							"ijazah, ijazah_pddkn, mengajar, sertifikasi, ".
							"pensiun, pensiun_tgl, usernamex, passwordx, postdate) VALUES ".
							"('$kd', '$kd81_session', '$e_sekkode','$e_seknama', ".
							"'$e_kode', '$e_kode', '$e_nama', ".
							"'$e_alamat', '$e_telp', '$e_email', ".
							"'$e_jabatan', '$e_lahir_tmp', '$e_lahir_tgl', ".
							"'$e_tahun_disini', '$e_tahun_dimuh', ".
							"'$e_ijazah', '$e_ijazah_pddkn', '$e_tugas', '$e_sertifikasi', ".
							"'$e_pensiun', '$e_pensiun_tgl', '$aksesnya', '$passx', '$today')");



				//insert
				mysqli_query($koneksi, "INSERT INTO user(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, postdate) VALUES ".
								"('$kd', '$kd81_session', '$e_sekkode','$e_seknama', ".
								"'$kd', '$e_kode', '$e_nama', ".
								"'SEKOLAH', 'PEGAWAI', '$today')");
	




	
		
				//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
										"WHERE kd = '$kd81_session'");
				$rku = mysqli_fetch_assoc($qku);
				$ku_kd = cegah($rku['kd']);
				$ku_kode = cegah($rku['kode']);
				$ku_nama = cegah($rku['nama']);
			
				$ku_ket = cegah("$judul. ENTRI BARU : $e_kode");			
				
				
				
				//insert
				mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"user_kd, user_kode, user_nama, ".
								"user_posisi, user_jabatan, ket, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$ku_kd', '$ku_kode', '$ku_nama', ".
								"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
				//kasi log login ///////////////////////////////////////////////////////////////////////////////////
	
				
			

			//re-direct
			xloc($filenya);
			exit();
			}
			
			
			
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE sekolah_pegawai SET kode = '$e_kode', ".
							"nbm = '$e_nbm', ".
							"nama = '$e_nama', ".
							"alamat = '$e_alamat', ".
							"telp = '$e_telp', ".
							"email = '$e_email', ".
							"jabatan = '$e_jabatan', ".
							"lahir_tmp = '$e_lahir_tmp', ".
							"lahir_tgl = '$e_lahir_tgl', ".
							"bekerja_sejak_disini = '$e_tahun_disini', ".
							"bekerja_sejak_dimuh = '$e_tahun_dimuh', ".
							"ijazah = '$e_ijazah', ".
							"ijazah_pddkn = '$e_ijazah_pddkn', ".
							"mengajar = '$e_tugas', ".
							"sertifikasi = '$e_sertifikasi', ".
							"pensiun = '$e_pensiun', ".
							"pensiun_tgl = '$e_pensiun_tgl' ".
							"WHERE sekolah_kd = '$kd81_session' ".
							"AND kd = '$kd'");



	
		
			//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
			//detail
			$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$kd81_session'");
			$rku = mysqli_fetch_assoc($qku);
			$ku_kd = cegah($rku['kd']);
			$ku_kode = cegah($rku['kode']);
			$ku_nama = cegah($rku['nama']);
		
			$ku_ket = cegah("$judul. UPDATE : $e_kode");			
			
			
			
			//insert
			mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"user_kd, user_kode, user_nama, ".
							"user_posisi, user_jabatan, ket, postdate) VALUES ".
							"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
							"'$ku_kd', '$ku_kode', '$ku_nama', ".
							"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
			//kasi log login ///////////////////////////////////////////////////////////////////////////////////


			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}








//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);
	$ke = "$filenya?page=$page";

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM sekolah_pegawai ".
						"WHERE kd = '$kd'");
		}



	
		
	//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$kd81_session'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);

	$ku_ket = cegah("$judul. HAPUS DATA");			
	
	
	
	//insert
	mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
					"user_kd, user_kode, user_nama, ".
					"user_posisi, user_jabatan, ket, postdate) VALUES ".
					"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
					"'$ku_kd', '$ku_kode', '$ku_nama', ".
					"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////

	
			
			
	//auto-kembali
	xloc($filenya);
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










//isi *START
ob_start();


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");
?>


  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>
  
<?php
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika import
if ($s == "import")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" enctype="multipart/form-data" name="formxx2">
	<p>
		<input name="filex_xls" type="file" size="30" class="btn btn-warning">
	</p>

	<p>
		<input name="btnBTL" type="submit" value="KEMBALI" class="btn btn-info">
		<input name="btnIMX" type="submit" value="IMPORT >>" class="btn btn-danger">
	</p>
	
	
	</form>';	
	?>
		


	</div>
	
	</div>


	<?php
	}










//jika edit / baru
else if (($s == "baru") OR ($s == "edit"))
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
						"WHERE kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_kode = balikin($rowx['kode']);
	$e_nama = balikin($rowx['nama']);
	$e_alamat = balikin($rowx['alamat']);
	$e_telp = balikin($rowx['telp']);
	$e_email = balikin($rowx['email']);
	$e_jabatan = balikin($rowx['jabatan']);
	$e_lahir_tmp = balikin($rowx['lahir_tmp']);
	$e_lahir_tgl = balikin($rowx['lahir_tgl']);
	$e_tahun_disini = balikin($rowx['bekerja_sejak_disini']);
	$e_tahun_dimuh = balikin($rowx['bekerja_sejak_dimuh']);
	$e_ijazah = balikin($rowx['ijazah']);
	$e_ijazah_pddkn = balikin($rowx['ijazah_pddkn']);
	$e_tugas = balikin($rowx['mengajar']);
	$e_sertifikasi = balikin($rowx['sertifikasi']);
	$e_pensiun = balikin($rowx['pensiun']);
	$e_pensiun_tgl = balikin($rowx['pensiun_tgl']);

	
	
	echo '<form action="'.$filenya.'" method="post" name="formx2">
	
	
	<div class="row">

		<div class="col-md-4">
		
		<p>
		NBM/NIP : 
		<br>
		<input name="e_kode" type="text" value="'.$e_kode.'" size="20" class="btn-warning" required>
		</p>
	
		<p>
		NAMA : 
		<br>
		<input name="e_nama" type="text" value="'.$e_nama.'" size="30" class="btn-warning" required>
		</p>
		
		<p>
		ALAMAT : 
		<br>
		<input name="e_alamat" type="text" value="'.$e_alamat.'" size="30" class="btn-warning" required>
		</p>
		
		<p>
		TELPON/WA : 
		<br>
		<input name="e_telp" type="text" value="'.$e_telp.'" size="20" class="btn-warning" required>
		</p>
		
		<p>
		E-Mail : 
		<br>
		<input name="e_email" type="text" value="'.$e_email.'" size="30" class="btn-warning" required>
		</p>
		
		</div>
		
		<div class="col-md-4">
		
		
		<p>
		JABATAN : 
		<br>
		<input name="e_jabatan" type="text" value="'.$e_jabatan.'" size="20" class="btn-warning" required>
		</p>
		
	
		
		<p>
		TEMPAT, TANGGAL LAHIR : 
		<br>
		<input name="e_lahir_tmp" type="text" value="'.$e_lahir_tmp.'" size="10" class="btn-warning" required>, 
		<input name="e_lahir_tgl" type="date" value="'.$e_lahir_tgl.'" size="10" class="btn-warning" required>  
		</p>
		
		<p>
		TAHUN BEKERJA DISINI SEJAK : 
		<br>
		<input name="e_tahun_disini" type="text" value="'.$e_tahun_disini.'" size="10" class="btn-warning" required>
		</p>
		
		
		<p>
		TAHUN BEKERJA DI YAYASAN SEJAK : 
		<br>
		<input name="e_tahun_dimuh" type="text" value="'.$e_tahun_dimuh.'" size="10" class="btn-warning" required>
		</p>
		
		
			
		</div>
		
		<div class="col-md-4">
		
		<p>
		IJAZAH : 
		<br>
		<input name="e_ijazah" type="text" value="'.$e_ijazah.'" size="5" class="btn-warning" required>
		</p>
		
		
		<p>
		NAMA TEMPAT PENDIDIKAN TERAKHIR : 
		<br>
		<input name="e_ijazah_pddkn" type="text" value="'.$e_ijazah_pddkn.'" size="20" class="btn-warning" required>
		</p>
		
		
		<p>
		MENGAJAR/TUGAS : 
		<br>
		<input name="e_tugas" type="text" value="'.$e_tugas.'" size="30" class="btn-warning" required>
		</p>
		
		<p>
		SUDAH SERTIFIKASI...? : 
		<br>
		<input name="e_sertifikasi" type="text" value="'.$e_sertifikasi.'" size="20" class="btn-warning" required>
		</p>
		
		
		
		<p>
		SUDAH PENSIUN...? : 
		<br>
		<select name="e_pensiun" class="btn-warning" required>
		<option value="'.$e_pensiun.'" selected>'.$e_pensiun.'</option>
		<option value="BELUM">BELUM</option>
		<option value="SUDAH">SUDAH</option>
		</select>
		</p>
		
		<p>
		TANGGAL PENSIUN :
		<br>
		<input name="e_pensiun_tgl" type="date" value="'.$e_pensiun_tgl.'" size="10" class="btn-warning">
		</p>
		
		
		
		
		</div>
	
		

	
	</div>
	
	

	<hr>
	

	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	
	<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-info">
	</form>';
	}
	




















else
	{
	$warnatext = "white";
	
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM sekolah_pegawai ".
						"WHERE sekolah_kd = '$kd81_session' ".
						"ORDER BY nama ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM sekolah_pegawai ".
						"WHERE sekolah_kd = '$kd81_session' ".
						"AND (kode LIKE '%$kunci%' ".
						"OR nbm LIKE '%$kunci%' ".
						"OR nama LIKE '%$kunci%' ".
						"OR alamat LIKE '%$kunci%' ".
						"OR telp LIKE '%$kunci%' ".
						"OR email LIKE '%$kunci%' ".
						"OR jabatan LIKE '%$kunci%' ".
						"OR lahir_tmp LIKE '%$kunci%' ".
						"OR lahir_tgl LIKE '%$kunci%' ".
						"OR ijazah LIKE '%$kunci%' ".
						"OR ijazah_pddkn LIKE '%$kunci%' ".
						"OR bekerja_sejak_disini LIKE '%$kunci%' ".
						"OR bekerja_sejak_dimuh LIKE '%$kunci%') ".
						"ORDER BY nama ASC";
		}
		

	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	
	
	
	echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
	<input name="btnBR" type="submit" value="ENTRI BARU" class="btn btn-danger">
	<input name="btnIM" type="submit" value="IMPORT EXCEL" class="btn btn-success">
	<input name="btnEX" type="submit" value="EXPORT" class="btn btn-success">
	</p>
	<br>
	
	</form>



	<form action="'.$filenya.'" method="post" name="formx">
	<p>
	<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
	<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
	</p>
		
	
	<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="20">&nbsp;</td>
	<td width="20">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NBM/NIP/USERNAME</font></strong></td>
	<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TELP</font></strong></td>
	<td><strong><font color="'.$warnatext.'">EMAIL</font></strong></td>
	<td><strong><font color="'.$warnatext.'">JABATAN</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TEMPAT,TGL.LAHIR</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TAHUN BEKERJA DISINI</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TAHUN BEKERJA DI YAYASAN</font></strong></td>
	<td><strong><font color="'.$warnatext.'">IJAZAH</font></strong></td>
	<td><strong><font color="'.$warnatext.'">MENGAJAR/TUGAS</font></strong></td>
	<td><strong><font color="'.$warnatext.'">SERTIFIKASI</font></strong></td>
	<td><strong><font color="'.$warnatext.'">PENSIUN</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	
	if ($count != 0)
		{
		do 
			{
			if ($warna_set ==0)
				{
				$warna = $warna01;
				$warna_set = 1;
				}
			else
				{
				$warna = $warna02;
				$warna_set = 0;
				}
	
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_kode = balikin($data['kode']);
			$i_nama = balikin($data['nama']);
			$i_alamat = balikin($data['alamat']);
			$i_telp = balikin($data['telp']);
			$i_email = balikin($data['email']);
			$i_jabatan = balikin($data['jabatan']);
			$i_lahir_tmp = balikin($data['lahir_tmp']);
			$i_lahir_tgl = balikin($data['lahir_tgl']);
			$i_tahun_disini = balikin($data['bekerja_sejak_disini']);
			$i_tahun_dimuh = balikin($data['bekerja_sejak_dimuh']);
			$i_ijazah = balikin($data['ijazah']);
			$i_ijazah_pddkn = balikin($data['ijazah_pddkn']);
			$i_tugas = balikin($data['mengajar']);
			$i_sertifikasi = balikin($data['sertifikasi']);
			$i_pensiun = balikin($data['pensiun']);
			$i_pensiun_tgl = balikin($data['pensiun_tgl']);
			$i_postdate = balikin($data['postdate']);

			
			
			//jika sudah
			if ($i_pensiun == "SUDAH")
				{
				$i_pensiunx = "$i_pensiun, $i_pensiun_tgl";
				}
			else
				{
				$i_pensiunx = "Belum";
				}
			
			
			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
	        </td>
	        <td>
			<a href="'.$filenya.'?s=edit&page='.$page.'&kd='.$i_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nama.'</td>
			<td>
			'.$i_kode.'
			<br>
			<a href="'.$filenya.'?s=reset&kd='.$i_kd.'" class="btn btn-primary">RESET PASSWORD >></a>
			</td>
			<td>'.$i_alamat.'</td>
			<td>'.$i_telp.'</td>
			<td>'.$i_email.'</td>
			<td>'.$i_jabatan.'</td>
			<td>'.$i_lahir_tmp.', '.$i_lahir_tgl.'</td>
			<td>'.$i_tahun_disini.'</td>
			<td>'.$i_tahun_dimuh.'</td>
			<td>'.$i_ijazah.', '.$i_ijazah_pddkn.'</td>
			<td>'.$i_tugas.'</td>
			<td>'.$i_sertifikasi.'</td>
			<td>'.$i_pensiunx.'</td>
			<td>'.$i_postdate.'</td>
	        </tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	
	
	echo '</tbody>
	  </table>
	  </div>
	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
	<br>

	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$count.')" class="btn btn-primary">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-warning">
	<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
	
	</td>
	</tr>
	</table>
	</form>';
	}








//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>
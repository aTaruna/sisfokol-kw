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
require("../inc/cek/admsekkeu.php");




//jika pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'pmasuk'))
	{
	//nilai
	$latx = cegah($_GET['latx']);
	$laty = cegah($_GET['laty']);


	$latx2 = balikin($_GET['latx']);
	$laty2 = balikin($_GET['laty']);
	


	$lat = balikin($latx2);
	$long = balikin($laty2);
	
	


	
	//akun cakmustofa
	$keyku = "AIzaSyBZ73oHLqNFmGX6bs3qyyRAoCim-_WxdqQ";
	
	
	function geo2address($lat,$long,$keyku) {
		
	    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=$keyku&latlng=$lat,$long&sensor=false";
	    $curlData=file_get_contents(    $url);
	    $address = json_decode($curlData);
	    $a=$address->results[0];
	    return explode(",",$a->formatted_address);
	}
	
	
	
	
	$nilku = geo2address($lat,$long,$keyku);
	
	
	$nil1 = $nilku[0];
	$nil2 = $nilku[1];
	$nil3 = $nilku[2];
	$nil4 = $nilku[3];
	$nil5 = $nilku[4];
	$nil6 = $nilku[5];
	$nil7 = $nilku[6];
	
	
	$nilaiku = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7");
	$nilaiku2 = balikin($nilaiku);
	//echo $nilaiku2;

	 	





	//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$sekkd84_session'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);

	$ku_ket = $nilaiku;			
	
	
	//insert
	mysqli_query($koneksi, "INSERT INTO user_log_gps(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
					"user_kd, user_kode, user_nama, ".
					"user_posisi, user_jabatan, lat_x, ".
					"lat_y, alamat_googlemap, postdate) VALUES ".
					"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
					"'$kd84_session', '$nip84_session', '$xnm84_session', ".
					"'SEKOLAH', 'KEUANGAN', '$lat', ".
					"'$long', '$ku_ket', '$today')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////
	}
	
	
	

//jika error
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'error'))
	{
	//echo "GPS Tidak Aktif";
	?>
		
		<div class="row">
		
		  <div class="col-lg-12">
		    <div class="info-box mb-3 bg-danger">
		      <span class="info-box-icon"><i class="fa fa-user-secret"></i></span>
		
		      <div class="info-box-content">
		        <span class="info-box-number">
		        		<b>GPS TIDAK AKTIF</b>
					</span>
		      </div>
		    </div>
		
			</div>
			
		</div>


	
	
	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	
	    <!-- Main content -->
	    <section class="content">
	      <div class="container-fluid">

			<h3>Silahkan Aktifkan GPS Terlebih Dahulu.</h3>
			<i>Kemudian Refresh Browser</i>				
	
	      </div>
	    </section>
	    <!-- /.content -->

	    
	    
	    
	  </div>
	  <!-- /.content-wrapper -->
	

		

	<?php	
	}


exit();
?>
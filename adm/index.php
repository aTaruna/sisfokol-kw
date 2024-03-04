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
require("../inc/cek/adm.php");
require("../inc/class/paging.php");
$tpl = LoadTpl("../template/adm.html");


nocache();

//nilai
$filenya = "index.php";
$ku_latx = "-6.9217721533469945";
$ku_laty = "110.20413801403278";

$diload = "getLocation();";








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//hapus dulu, sebelum insert
mysqli_query($koneksi, "DELETE FROM majelis_sekolah_kib_a");


//kumpulkan nilainya...
//list sekolah
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);
		
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS totalnya ".
										"FROM sekolah_kib_a ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_harga = balikin($ryuk['totalnya']);
	
	
	
	
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(luas) AS totalnya ".
										"FROM sekolah_kib_a ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_luas = balikin($ryuk['totalnya']);
	
	
	
	
	
	//insert kan
	mysqli_query($koneksi, "INSERT INTO majelis_sekolah_kib_a(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"tahun, luas, harga, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$tahun', '$yuk_luas', '$yuk_harga', '$today')");
		
	}
while ($rku = mysqli_fetch_assoc($qku));














//hapus dulu, sebelum insert
mysqli_query($koneksi, "DELETE FROM majelis_sekolah_kib_b");


//kumpulkan nilainya...
//list sekolah
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);
		
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS totalnya ".
										"FROM sekolah_kib_b ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_harga = balikin($ryuk['totalnya']);
	
	

	
	
	//insert kan
	mysqli_query($koneksi, "INSERT INTO majelis_sekolah_kib_b(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"tahun, harga, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$tahun', '$yuk_harga', '$today')");
		
	}
while ($rku = mysqli_fetch_assoc($qku));













//hapus dulu, sebelum insert
mysqli_query($koneksi, "DELETE FROM majelis_sekolah_kib_c");


//kumpulkan nilainya...
//list sekolah
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);
		
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(luas_lantai) AS totalnya ".
										"FROM sekolah_kib_c ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_luas_lantai = balikin($ryuk['totalnya']);
	
	
	
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(tanah_luas) AS totalnya ".
										"FROM sekolah_kib_c ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_luas_tanah = balikin($ryuk['totalnya']);
	
	
	
	
	
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS totalnya ".
										"FROM sekolah_kib_c ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_harga = balikin($ryuk['totalnya']);
	
	

	
	
	//insert kan
	mysqli_query($koneksi, "INSERT INTO majelis_sekolah_kib_c(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"tahun, luas_lantai, luas_tanah, harga, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$tahun', '$yuk_luas_lantai', '$yuk_luas_tanah', '$yuk_harga', '$today')");
		
	}
while ($rku = mysqli_fetch_assoc($qku));














//hapus dulu, sebelum insert
mysqli_query($koneksi, "DELETE FROM majelis_sekolah_kib_d");


//kumpulkan nilainya...
//list sekolah
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);
		
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(luas) AS totalnya ".
										"FROM sekolah_kib_d ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_luas = balikin($ryuk['totalnya']);
	
	
	

		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS totalnya ".
										"FROM sekolah_kib_d ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_harga = balikin($ryuk['totalnya']);
	
	

	
	
	//insert kan
	mysqli_query($koneksi, "INSERT INTO majelis_sekolah_kib_d(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"tahun, luas, harga, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$tahun', '$yuk_luas', '$yuk_harga', '$today')");
		
	}
while ($rku = mysqli_fetch_assoc($qku));

























//hapus dulu, sebelum insert
mysqli_query($koneksi, "DELETE FROM majelis_sekolah_kib_e");


//kumpulkan nilainya...
//list sekolah
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);
		
		
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS totalnya ".
										"FROM sekolah_kib_e ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_harga = balikin($ryuk['totalnya']);
	
	

	
	
	//insert kan
	mysqli_query($koneksi, "INSERT INTO majelis_sekolah_kib_e(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"tahun, harga, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$tahun', '$yuk_harga', '$today')");
		
	}
while ($rku = mysqli_fetch_assoc($qku));













//hapus dulu, sebelum insert
mysqli_query($koneksi, "DELETE FROM majelis_sekolah_kib_f");


//kumpulkan nilainya...
//list sekolah
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do
	{
	//nilai
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);
		
		
		
	//ketahui totalnya
	$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS totalnya ".
										"FROM sekolah_kib_f ".
										"WHERE sekolah_kd = '$ku_kd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_harga = balikin($ryuk['totalnya']);
	
	

	
	
	//insert kan
	mysqli_query($koneksi, "INSERT INTO majelis_sekolah_kib_f(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
								"tahun, harga, postdate) VALUES ".
								"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
								"'$tahun', '$yuk_harga', '$today')");
		
	}
while ($rku = mysqli_fetch_assoc($qku));



























//nilai
$judul = "DashBoard Admin $sek_nama";
$judulku = $judul;




//postdate entri
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
									"WHERE user_kd = '$kd071_session' ".
									"AND user_jabatan = 'TATA USAHA' ".
									"ORDER BY postdate DESC");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_entri_terakhir = balikin($ryuk['postdate']);






//postdate login
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_login ".
									"WHERE user_kd = '$kd071_session' ".
									"AND user_jabatan = 'TATA USAHA' ".
									"ORDER BY postdate DESC");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_login_terakhir = balikin($ryuk['postdate']);























//isi *START
ob_start();


echo '<div class="row">

  <div class="col-lg-12">
    <div class="info-box mb-3 bg-primary">
      <span class="info-box-icon"><i class="fa fa-graduation-cap"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">
        		'.$judul.'
			</span>

      </div>
    </div>

	</div>
</div>';




//isi
$judulku = ob_get_contents();
ob_end_clean();
              




















//isi *START
ob_start();




//detail 
$qx = mysqli_query($koneksi, "SELECT * FROM m_majelis");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = balikin($rowx['nama']);
$e_nama = balikin($rowx['nama']);
$e_postdate = balikin($rowx['postdate']);
$ku_lat_x = balikin($rowx['lat_x']);
$ku_lat_y = balikin($rowx['lat_y']);
$ku_alamat = balikin($rowx['alamat_googlemap']);



//jika belum ada, berikan yang dari google map
if ((empty($ku_lat_x)) OR (empty($ku_lat_y)))
	{
	$e_lat_x = $ku_latx;
	$e_lat_y = $ku_laty;
	}
else
	{
	$e_lat_x = $ku_lat_x;
	$e_lat_y = $ku_lat_y;
	}









//isi *START
ob_start();


echo "['$e_kode, $e_nama', $e_lat_x,$e_lat_y],";



//isi
$isi_gps2 = ob_get_contents();
ob_end_clean();












//isi *START
ob_start();
	
echo "['<div class=\"info_content\">' +
    '<h3>$e_nama</h3>' +
    '<p>$e_alamat_googlemap</p>' +
    '<p>Last Update : $e_postdate</p>' +
    '</div>'],";	


//isi
$isi_gps3 = ob_get_contents();
ob_end_clean();














//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Ymd',mktime(0,0,0,$m,($de-$i),$y)); 

	echo "$nilku, ";
	}


//isi
$isi_data1 = ob_get_contents();
ob_end_clean();










//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui ordernya...
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_login ".
							"WHERE user_kd = '$kd071_session' ".
							"AND user_jabatan = 'TATA USAHA' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
									
									
	if (empty($tyuk))
		{
		$tyuk = "1";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data2 = ob_get_contents();
ob_end_clean();









//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
							"WHERE user_kd = '$kd071_session' ".
							"AND user_jabatan = 'TATA USAHA' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
	if (empty($tyuk))
		{
		$tyuk = "1";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data3 = ob_get_contents();
ob_end_clean();













//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_gps ".
							"WHERE user_kd = '$kd071_session' ".
							"AND user_jabatan = 'TATA USAHA' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
	if (empty($tyuk))
		{
		$tyuk = "1";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data4 = ob_get_contents();
ob_end_clean();











//isi *START
ob_start();


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jumlah sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah");
$rowx = mysqli_fetch_assoc($qx);
$e_total_sekolah = mysqli_num_rows($qx);




//jumlah pegawai
$qx = mysqli_query($koneksi, "SELECT SUM(total_pegawai) AS totalnya ".
								"FROM m_sekolah");
$rowx = mysqli_fetch_assoc($qx);
$e_total_pegawai = balikin($rowx['totalnya']);



//jumlah siswa
$qx = mysqli_query($koneksi, "SELECT SUM(total_siswa) AS totalnya ".
									"FROM m_sekolah");
$rowx = mysqli_fetch_assoc($qx);
$e_total_siswa = balikin($rowx['totalnya']);



//jumlah kelas
$qx = mysqli_query($koneksi, "SELECT SUM(total_kelas) AS totalnya ".
								"FROM m_sekolah");
$rowx = mysqli_fetch_assoc($qx);
$e_total_kelas = balikin($rowx['totalnya']);





//spp atas
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"WHERE spp_bulanan <> '' ".
								"ORDER BY round(spp_bulanan) DESC");
$rowx = mysqli_fetch_assoc($qx);
$e_spp_atas = balikin($rowx['spp_bulanan']);




//spp bawah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"WHERE spp_bulanan <> '' ".
								"ORDER BY round(spp_bulanan) ASC");
$rowx = mysqli_fetch_assoc($qx);
$e_spp_bawah = balikin($rowx['spp_bulanan']);


$e_spp_rata = round(($e_spp_atas + $e_spp_bawah) / 2,2); 
?>







<p id="demoku"></p>

<script>
var xx = document.getElementById("demoku");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    xx.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
	
	
		$.ajax({
			url: "i_set_lokasi.php?aksi=pmasuk&latx="+position.coords.latitude+"&laty="+position.coords.longitude,
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){			
				$("#demoku").html(data);	
				}
			});
		return false;
}
</script>








<style>
	#map_wrapper {
    height: 400px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>


<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>




<script>
	jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "//maps.googleapis.com/maps/api/js?key=<?php echo $keyku;?>&sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers
    var markers = [<?php echo $isi_gps2;?>];
                        
    // Info Window Content
    var infoWindowContent = [<?php echo $isi_gps3;?>
    ];
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
</script>
     

Alamat Google Map :
<br>
<i><?php echo $ku_alamat;?></i>
<hr>
<br>     
     
     



		<!-- Info boxes -->
      <div class="row">


        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SEKOLAH</span>
              <span class="info-box-number"><?php echo $e_total_sekolah;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->




        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">GURU/PEGAWAI/KARYAWAN</span>
              <span class="info-box-number"><?php echo $e_total_pegawai;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SISWA</span>
              <span class="info-box-number"><?php echo $e_total_siswa;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">KELAS</span>
              <span class="info-box-number"><?php echo $e_total_kelas;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->





        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SPP Rata2</span>
              <span class="info-box-number"><?php echo xduit3($e_spp_rata);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->






        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">LOGIN TERAKHIR</span>
              <span class="info-box-number"><?php echo $yuk_login_terakhir;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        





        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ENTRI TERAKHIR</span>
              <span class="info-box-number"><?php echo $yuk_entri_terakhir;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        
                
      </div>
      <!-- /.row -->




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					
					  var $visitorsChart = $('#visitors-chart')
					  var visitorsChart  = new Chart($visitorsChart, {
					    data   : {
					      labels  : [<?php echo $isi_data1;?>],
					      datasets: [{
					        type                : 'line',
					        data                : [<?php echo $isi_data2;?>],
					        backgroundColor     : 'transparent',
					        borderColor         : 'blue',
					        pointBorderColor    : 'blue',
					        pointBackgroundColor: 'blue',
					        fill                : false
					        // pointHoverBackgroundColor: '#007bff',
					        // pointHoverBorderColor    : '#007bff'
					      },
					        {
					          type                : 'line',
					          data                : [<?php echo $isi_data3;?>],
					          backgroundColor     : 'tansparent',
					          borderColor         : 'orange',
					          pointBorderColor    : 'orange',
					          pointBackgroundColor: 'orange',
					          fill                : false
					          // pointHoverBackgroundColor: '#ced4da',
					          // pointHoverBorderColor    : '#ced4da'
					        },
					        {
					          type                : 'line',
					          data                : [<?php echo $isi_data4;?>],
					          backgroundColor     : 'tansparent',
					          borderColor         : 'pink',
					          pointBorderColor    : 'pink',
					          pointBackgroundColor: 'pink',
					          fill                : false
					          // pointHoverBackgroundColor: '#ced4da',
					          // pointHoverBorderColor    : '#ced4da'
					        }]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero : true,
					            suggestedMax: 200
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					})
	
				</script>
	
	
	
	
	
	

		<!-- Info boxes -->
      <div class="row">
	
        <!-- /.col -->
        <div class="col-md-12">
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : Login, Entri, GPS</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                  <canvas id="visitors-chart" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-blue"></i> Login
	                  </span>
	                  &nbsp;
	
	                  <span>
	                    <i class="fas fa-square text-orange"></i> Entri
	                  </span>
	                  
	                  &nbsp;
	                  &nbsp;
	                  
	                  <span>
	                    <i class="fas fa-square text-pink"></i> GPS
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
			</div>
			
		</div>
			            
	          

	
            
		<!-- Info boxes -->
      <div class="row">
	
        <!-- /.col -->
        <div class="col-md-6">
            
			<?php
			$limit = 100;
			$sqlcount = "SELECT * FROM m_sekolah ".
							"ORDER BY nama ASC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			?>
			
			
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">DAFTAR SEKOLAH [<?php echo $count;?>]</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>NAMA</th>
                      <th>KEPALA SEKOLAH</th>
                    </tr>
                    </thead>
                    <tbody>
                    	
                    <?php
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
							$i_ks_nama = balikin($data['ks_nama']);
							$i_nama = balikin($data['nama']);
						
							echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
							echo '<td>'.$nomer.'. '.$i_nama.'</td>
							<td>'.$i_ks_nama.'</td>
					        </tr>';
							}
						while ($data = mysqli_fetch_assoc($result));
						?>
						
						
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>

              <!-- /.card-footer -->
            </div>
            <!-- /.card -->



		</div>
		
		
        <!-- /.col -->
        <div class="col-md-6">

            
			<?php
			$limit = 50;
			$sqlcount = "SELECT * FROM sekolah_pegawai ".
							"WHERE pensiun = 'SUDAH' ".
							"ORDER BY pensiun_tgl DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			?>
			
			
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">PENSIUN</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>TGL.PENSIUN</th>
                      <th>SEKOLAH</th>
                      <th>PEGAWAI/KARYAWAN</th>
                    </tr>
                    </thead>
                    <tbody>
                    	
                    <?php
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
							$i_seknama = balikin($data['sekolah_nama']);
							$i_kode = balikin($data['kode']);
							$i_nama = balikin($data['nama']);
							$i_pensiun_tgl = balikin($data['pensiun_tgl']);
					
																	
						
							echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
							echo '<td>'.$i_pensiun_tgl.'</td>
							<td>'.$i_seknama.'</td>
							<td>
							<b>'.$i_nama.'</b>
							<br>
							'.$i_kode.'
							</td>
					        </tr>';
							}
						while ($data = mysqli_fetch_assoc($result));
						?>
						
						
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo $sumber;?>/adm/kpeg/lap_pensiun.php" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->


			<br>


            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">TOTAL ASET</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->

              <!-- /.card-body -->
              <div class="card-footer clearfix">

				<?php
				//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(harga) AS harganya ".
													"FROM majelis_sekolah_kib_a");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_harga = balikin($ryuk21['harganya']);


				//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(luas) AS harganya ".
													"FROM majelis_sekolah_kib_a");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_luas = balikin($ryuk21['harganya']);



				//last update
				$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM majelis_sekolah_kib_a ".
													"ORDER BY postdate DESC");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_postdate = balikin($ryuk21['postdate']);
				?>
		            <div class="info-box mb-3 bg-warning">
		              <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		
		              <div class="info-box-content">
		                <span class="info-box-text">A.TANAH</span>
		                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
		                <span class="info-box-number">Luas : <?php echo $j_luas;?> M2</span>
		                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>




				<?php
					//jumlah 
					$qyuk21 = mysqli_query($koneksi, "SELECT SUM(harga) AS harganya ".
														"FROM majelis_sekolah_kib_b");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_harga = balikin($ryuk21['harganya']);


					//last update
					$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM majelis_sekolah_kib_b ".
														"ORDER BY postdate DESC");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_postdate = balikin($ryuk21['postdate']);
				?>

		            <div class="info-box mb-3 bg-warning">
		              <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		
		              <div class="info-box-content">
		                <span class="info-box-text">B.PERALATAN DAN MESIN</span>
		                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
		                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>

			


				<?php
				//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(harga) AS harganya ".
													"FROM majelis_sekolah_kib_c");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_harga = balikin($ryuk21['harganya']);
				
				//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(luas_tanah) AS harganya ".
													"FROM majelis_sekolah_kib_c");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_luas_tanah = balikin($ryuk21['harganya']);

				
				
				//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(luas_lantai) AS harganya ".
													"FROM majelis_sekolah_kib_c");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_luas_lantai = balikin($ryuk21['harganya']);
				
				

				//last update
				$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM majelis_sekolah_kib_c ".
													"ORDER BY postdate DESC");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_postdate = balikin($ryuk21['postdate']);
				?>			
		            <div class="info-box mb-3 bg-warning">
		              <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		
		              <div class="info-box-content">
		                <span class="info-box-text">C.GEDUNG DAN BANGUNAN</span>
		                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
		                <span class="info-box-number">Luas Lantai : <?php echo $j_luas_lantai;?> M2</span>
		                <span class="info-box-number">Luas Tanah : <?php echo $j_luas_lantai;?> M2</span>
		                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            
		            


				<?php
					//jumlah 
					$qyuk21 = mysqli_query($koneksi, "SELECT SUM(harga) AS harganya ".
														"FROM majelis_sekolah_kib_d");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_harga = balikin($ryuk21['harganya']);


					//jumlah 
					$qyuk21 = mysqli_query($koneksi, "SELECT SUM(luas) AS harganya ".
														"FROM majelis_sekolah_kib_d");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_luas = balikin($ryuk21['harganya']);



					//last update
					$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM majelis_sekolah_kib_d ".
														"ORDER BY postdate DESC");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_postdate = balikin($ryuk21['postdate']);
				
				?>		            
		            <div class="info-box mb-3 bg-warning">
		              <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		
		              <div class="info-box-content">
		                <span class="info-box-text">D.JALAN,IRIGASI DAN JARINGAN</span>
		                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
		                <span class="info-box-number">Luas : <?php echo $j_luas;?> M2</span>
		                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>





				<?php
						//jumlah 
						$qyuk21 = mysqli_query($koneksi, "SELECT SUM(harga) AS harganya ".
															"FROM majelis_sekolah_kib_e");
						$ryuk21 = mysqli_fetch_assoc($qyuk21);
						$j_harga = balikin($ryuk21['harganya']);

	
						//last update
						$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM majelis_sekolah_kib_e ".
															"ORDER BY postdate DESC");
						$ryuk21 = mysqli_fetch_assoc($qyuk21);
						$j_postdate = balikin($ryuk21['postdate']);
				
				?>

		            <div class="info-box mb-3 bg-warning">
		              <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		
		              <div class="info-box-content">
		                <span class="info-box-text">E.ASET TETAP LAINNYA</span>
		                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
		                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>


			
			




				<?php
						//jumlah 
						$qyuk21 = mysqli_query($koneksi, "SELECT SUM(harga) AS harganya ".
															"FROM majelis_sekolah_kib_f");
						$ryuk21 = mysqli_fetch_assoc($qyuk21);
						$j_harga = balikin($ryuk21['harganya']);

	
						//last update
						$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM majelis_sekolah_kib_f ".
															"ORDER BY postdate DESC");
						$ryuk21 = mysqli_fetch_assoc($qyuk21);
						$j_postdate = balikin($ryuk21['postdate']);
				
				?>

		            <div class="info-box mb-3 bg-warning">
		              <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		
		              <div class="info-box-content">
		                <span class="info-box-text">F.KONTRUKSI DALAM PENYELESAIAN</span>
		                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
		                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>


			


			

			
						
			
	          </div>
	        </div>
	          



              


		</div>
	</div>





		<!-- Info boxes -->
      <div class="row">
	
        <!-- /.col -->
        <div class="col-md-6">
    





            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">TOTAL KEUANGAN MASUK</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->

              <!-- /.card-body -->
              <div class="card-footer clearfix">
              	
              	<?php
              	//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(nilai) AS harganya ".
													"FROM sekolah_uang_masuk");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_harga = balikin($ryuk21['harganya']);
				
				$j_total = xduit3($j_harga);
              	

				echo "<h3>$j_total</h3> <hr>";



				//list uang masuk
				$qmboh = mysqli_query($koneksi, "SELECT * FROM m_uang_masuk ".
													"ORDER BY nama ASC");
				$rmboh = mysqli_fetch_assoc($qmboh);
	
				
				
				do
					{
					//nilai
					$j_nama = balikin($rmboh['nama']);
					$j_tipe = cegah($rmboh['nama']);
					
					
					//jumlah 
					$qyuk21 = mysqli_query($koneksi, "SELECT SUM(nilai) AS harganya ".
														"FROM sekolah_uang_masuk ".
														"WHERE tipe = '$j_tipe'");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_harga = balikin($ryuk21['harganya']);
	
	
					//postdate 
					$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM sekolah_uang_masuk ".
														"WHERE tipe = '$j_tipe' ".
														"ORDER BY postdate DESC");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_postdate = balikin($ryuk21['postdate']);
	
					?>
			            <div class="info-box mb-3 bg-success">
			              <span class="info-box-icon"><i class="spinner-grow text-dark"></i></span>
			
			              <div class="info-box-content">
			                <span class="info-box-text"><?php echo $j_nama;?></span>
			                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
			                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
			              </div>
			              <!-- /.info-box-content -->
			            </div>
	
					<?php
					}
				while ($rmboh = mysqli_fetch_assoc($qmboh));
				?>	

			
						
			
	          </div>
	        </div>
	          




		</div>

        <!-- /.col -->
        <div class="col-md-6">
    





            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">TOTAL KEUANGAN KELUAR</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->

              <!-- /.card-body -->
              <div class="card-footer clearfix">

				<?php
				//jumlah 
				$qyuk21 = mysqli_query($koneksi, "SELECT SUM(nilai) AS harganya ".
													"FROM sekolah_uang_keluar");
				$ryuk21 = mysqli_fetch_assoc($qyuk21);
				$j_harga = balikin($ryuk21['harganya']);
				
				$j_total = xduit3($j_harga);
              	

				echo "<h3>$j_total</h3> <hr>";

				
				
				
				
				//list uang masuk
				$qmboh = mysqli_query($koneksi, "SELECT * FROM m_uang_keluar ".
													"ORDER BY nama ASC");
				$rmboh = mysqli_fetch_assoc($qmboh);
	
				
				
				do
					{
					//nilai
					$j_nama = balikin($rmboh['nama']);
					$j_tipe = cegah($rmboh['nama']);
					
					
					//jumlah 
					$qyuk21 = mysqli_query($koneksi, "SELECT SUM(nilai) AS harganya ".
														"FROM sekolah_uang_keluar ".
														"WHERE tipe = '$j_tipe'");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_harga = balikin($ryuk21['harganya']);
	
	
					//postdate 
					$qyuk21 = mysqli_query($koneksi, "SELECT postdate FROM sekolah_uang_keluar ".
														"WHERE tipe = '$j_tipe' ".
														"ORDER BY postdate DESC");
					$ryuk21 = mysqli_fetch_assoc($qyuk21);
					$j_postdate = balikin($ryuk21['postdate']);
	
					?>
			            <div class="info-box mb-3 bg-danger">
			              <span class="info-box-icon"><i class="spinner-grow text-dark"></i></span>
			
			              <div class="info-box-content">
			                <span class="info-box-text"><?php echo $j_nama;?></span>
			                <span class="info-box-number"><?php echo xduit3($j_harga);?></span>
			                <span class="info-box-text"><i>Per Update : <?php echo $j_postdate;?></i></span>
			              </div>
			              <!-- /.info-box-content -->
			            </div>
	
					<?php
					}
				while ($rmboh = mysqli_fetch_assoc($qmboh));
				?>	

			
						
			
	          </div>
	        </div>
	          



			</div>
			
		</div>



			<br>


		<!-- Info boxes -->
      <div class="row">
	
        <!-- /.col -->
        <div class="col-md-12">
	
	
			<?php
			//isi *START
			ob_start();

		
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_i = $mb_i + 1;
				$mb_kd = balikin($rmboh['kd']);
				$mb_kode = balikin($rmboh['kode']);
				$mb_nama = balikin($rmboh['nama']);
				
				echo "'$mb_nama', ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			//isi
			$isi_data11 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);
				
				
				
				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(nilai) AS total ".
													"FROM sekolah_uang_masuk ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			
			//isi
			$isi_data21 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);

				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(nilai) AS total ".
													"FROM sekolah_uang_keluar ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			
			

			//isi
			$isi_data31 = ob_get_contents();
			ob_end_clean();
			
			
			




			
			
			
			?>




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					  var $salesChart = $('#sales-chart2')
					  var salesChart  = new Chart($salesChart, {
					    type   : 'bar',
					    data   : {
					      labels  : [<?php echo $isi_data11;?>],
					      datasets: [
					        {
					          backgroundColor: 'green',
					          borderColor    : 'green',
					          data           : [<?php echo $isi_data21;?>]
					        },
					        {
					          backgroundColor: 'red',
					          borderColor    : 'red',
					          data           : [<?php echo $isi_data31;?>]
					        }
					      ]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero: true,
					
					            // Include a dollar sign in the ticks
					            callback: function (value, index, values) {
					              if (value >= 1000) {
					                value /= 1000
					                value += 'k'
					              }
					              return '' + value
					            }
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					


					})
	
				</script>
	
	
	
		
		
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : Uang Masuk, Uang Keluar</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                	<canvas id="sales-chart2" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-green"></i> Uang Masuk
	                  </span>
	                  &nbsp;
	
	                  <span>
	                    <i class="fas fa-square text-red"></i> Uang Keluar
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	


			<br>










			<?php
			//per tipe masuk /////////////////////////////////////////////////////////////////////////
			
			//query
			$qyuk = mysqli_query($koneksi, "SELECT * FROM m_uang_masuk ".
												"ORDER BY nama ASC");
			$ryuk = mysqli_fetch_assoc($qyuk);
												
			do
				{
				//nilai
				$yuk_no = $yuk_no + 1;
				$yuk_kd = balikin($ryuk['kd']);
				$yuk_nama = balikin($ryuk['nama']);
				$yuk_nama2 = cegah($ryuk['nama']);
				

				
				?>
	
	
	
	
		
					<script>
						$(function () {
						  'use strict'
						
						  var ticksStyle = {
						    fontColor: '#495057',
						    fontStyle: 'bold'
						  }
						
						  var mode      = 'index'
						  var intersect = true
						
						  var $salesChart = $('#sales-chart7<?php echo $yuk_no;?>')
						  var salesChart  = new Chart($salesChart, {
						    type   : 'bar',
						    data   : {
						      labels  : [<?php 
						      
						      					
			
								//daftar sekolah
								$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
																	"ORDER BY nama ASC");
								$rmboh = mysqli_fetch_assoc($qmboh);
								
								do
									{
									//nilai
									$mb_i = $mb_i + 1;
									$mb_kd = balikin($rmboh['kd']);
									$mb_kode = balikin($rmboh['kode']);
									$mb_nama = balikin($rmboh['nama']);
									
									echo "'$mb_nama', ";
									}	
								while ($rmboh = mysqli_fetch_assoc($qmboh));
								
					
										      
						      
						      
						      ?>],
						      datasets: [
						        {
						          backgroundColor: 'green',
						          borderColor    : 'green',
						          data           : [<?php 
						          				//daftar sekolah
									$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
																		"ORDER BY nama ASC");
									$rmboh = mysqli_fetch_assoc($qmboh);
									
									do
										{
										//nilai
										$mb_kd = balikin($rmboh['kd']);
										$mb_nama = balikin($rmboh['nama']);
										
										
										
										
										//ketahui totalnya
										$qyuk2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS total ".
																			"FROM sekolah_uang_masuk ".
																			"WHERE sekolah_kd = '$mb_kd' ".
																			"AND tipe = '$yuk_nama2'");
										$ryuk2 = mysqli_fetch_assoc($qyuk2);
										$yuk2_total = balikin($ryuk2['total']);
										
										
										
										echo "$yuk2_total, ";
										}	
									while ($rmboh = mysqli_fetch_assoc($qmboh));
									
						          
						          ?>]
						        }
						      ]
						    },
						    options: {
						      maintainAspectRatio: false,
						      tooltips           : {
						        mode     : mode,
						        intersect: intersect
						      },
						      hover              : {
						        mode     : mode,
						        intersect: intersect
						      },
						      legend             : {
						        display: false
						      },
						      scales             : {
						        yAxes: [{
						          // display: false,
						          gridLines: {
						            display      : true,
						            lineWidth    : '4px',
						            color        : 'rgba(0, 0, 0, .2)',
						            zeroLineColor: 'transparent'
						          },
						          ticks    : $.extend({
						            beginAtZero: true,
						
						            // Include a dollar sign in the ticks
						            callback: function (value, index, values) {
						              if (value >= 1000) {
						                value /= 1000
						                value += 'k'
						              }
						              return '' + value
						            }
						          }, ticksStyle)
						        }],
						        xAxes: [{
						          display  : true,
						          gridLines: {
						            display: false
						          },
						          ticks    : ticksStyle
						        }]
						      }
						    }
						  })
						
	
	
						})
		
					</script>
		
		
		
			
			
		
		
		
		
	
		            <div class="card">
		              <div class="card-header border-transparent">
		                <h3 class="card-title">Grafik Uang Masuk : <?php echo $yuk_nama;?></h3>
		
		                <div class="card-tools">
		                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                    <i class="fas fa-minus"></i>
		                  </button>
		                </div>
		              </div>
		              <div class="card-body">
		
		
		
		                <div class="position-relative mb-4">
		                	<canvas id="sales-chart7<?php echo $yuk_no;?>" height="200"></canvas>
		                </div>
		
		                <div class="d-flex flex-row justify-content-end">
		                  <span class="mr-2">
		                    <i class="fas fa-square text-green"></i> Uang Masuk : <?php echo $yuk_nama;?>
		                  </span>
		                </div>
		
		
		                
		                
		              </div>
		            </div>
		
		
					<br>
		
				<?php
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
						
				
			
			//per tipe masuk /////////////////////////////////////////////////////////////////////////
			?>





			<br>







			<?php
			//per tipe keluar /////////////////////////////////////////////////////////////////////////
			
			//query
			$qyuk = mysqli_query($koneksi, "SELECT * FROM m_uang_keluar ".
												"ORDER BY nama ASC");
			$ryuk = mysqli_fetch_assoc($qyuk);
												
			do
				{
				//nilai
				$yuk_no = $yuk_no + 1;
				$yuk_kd = balikin($ryuk['kd']);
				$yuk_nama = balikin($ryuk['nama']);
				$yuk_nama2 = cegah($ryuk['nama']);
				

				
				?>
	
	
	
	
		
					<script>
						$(function () {
						  'use strict'
						
						  var ticksStyle = {
						    fontColor: '#495057',
						    fontStyle: 'bold'
						  }
						
						  var mode      = 'index'
						  var intersect = true
						
						  var $salesChart = $('#sales-chart8<?php echo $yuk_no;?>')
						  var salesChart  = new Chart($salesChart, {
						    type   : 'bar',
						    data   : {
						      labels  : [<?php 
						      
						      					
			
								//daftar sekolah
								$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
																	"ORDER BY nama ASC");
								$rmboh = mysqli_fetch_assoc($qmboh);
								
								do
									{
									//nilai
									$mb_i = $mb_i + 1;
									$mb_kd = balikin($rmboh['kd']);
									$mb_kode = balikin($rmboh['kode']);
									$mb_nama = balikin($rmboh['nama']);
									
									echo "'$mb_nama', ";
									}	
								while ($rmboh = mysqli_fetch_assoc($qmboh));
								
					
										      
						      
						      
						      ?>],
						      datasets: [
						        {
						          backgroundColor: 'red',
						          borderColor    : 'red',
						          data           : [<?php 
						          				//daftar sekolah
									$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
																		"ORDER BY nama ASC");
									$rmboh = mysqli_fetch_assoc($qmboh);
									
									do
										{
										//nilai
										$mb_kd = balikin($rmboh['kd']);
										$mb_nama = balikin($rmboh['nama']);
										
										
										
										
										//ketahui totalnya
										$qyuk2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS total ".
																			"FROM sekolah_uang_keluar ".
																			"WHERE sekolah_kd = '$mb_kd' ".
																			"AND tipe = '$yuk_nama2'");
										$ryuk2 = mysqli_fetch_assoc($qyuk2);
										$yuk2_total = balikin($ryuk2['total']);
										
										
										
										echo "$yuk2_total, ";
										}	
									while ($rmboh = mysqli_fetch_assoc($qmboh));
									
						          
						          ?>]
						        }
						      ]
						    },
						    options: {
						      maintainAspectRatio: false,
						      tooltips           : {
						        mode     : mode,
						        intersect: intersect
						      },
						      hover              : {
						        mode     : mode,
						        intersect: intersect
						      },
						      legend             : {
						        display: false
						      },
						      scales             : {
						        yAxes: [{
						          // display: false,
						          gridLines: {
						            display      : true,
						            lineWidth    : '4px',
						            color        : 'rgba(0, 0, 0, .2)',
						            zeroLineColor: 'transparent'
						          },
						          ticks    : $.extend({
						            beginAtZero: true,
						
						            // Include a dollar sign in the ticks
						            callback: function (value, index, values) {
						              if (value >= 1000) {
						                value /= 1000
						                value += 'k'
						              }
						              return '' + value
						            }
						          }, ticksStyle)
						        }],
						        xAxes: [{
						          display  : true,
						          gridLines: {
						            display: false
						          },
						          ticks    : ticksStyle
						        }]
						      }
						    }
						  })
						
	
	
						})
		
					</script>
		
		
		
			
			
		
		
		
		
	
		            <div class="card">
		              <div class="card-header border-transparent">
		                <h3 class="card-title">Grafik Uang Keluar : <?php echo $yuk_nama;?></h3>
		
		                <div class="card-tools">
		                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                    <i class="fas fa-minus"></i>
		                  </button>
		                </div>
		              </div>
		              <div class="card-body">
		
		
		
		                <div class="position-relative mb-4">
		                	<canvas id="sales-chart8<?php echo $yuk_no;?>" height="200"></canvas>
		                </div>
		
		                <div class="d-flex flex-row justify-content-end">
		                  <span class="mr-2">
		                    <i class="fas fa-square text-red"></i> Uang Keluar : <?php echo $yuk_nama;?>
		                  </span>
		                </div>
		
		
		                
		                
		              </div>
		            </div>
		
		
					<br>
		
				<?php
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
						
				
			
			//per tipe keluar /////////////////////////////////////////////////////////////////////////
			?>





			<br>






			<?php
			//isi *START
			ob_start();

		
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_i = $mb_i + 1;
				$mb_kd = balikin($rmboh['kd']);
				$mb_kode = balikin($rmboh['kode']);
				$mb_nama = balikin($rmboh['nama']);
				
				echo "'$mb_nama', ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			//isi
			$isi_data11 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);
				
				
				
				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS total ".
													"FROM sekolah_kib_a ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			
			//isi
			$isi_data21 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);

				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(luas) AS total ".
													"FROM sekolah_kib_a ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			
			

			//isi
			$isi_data31 = ob_get_contents();
			ob_end_clean();
			
			
			




			
			
			
			?>




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					  var $salesChart = $('#sales-chart3')
					  var salesChart  = new Chart($salesChart, {
					    type   : 'bar',
					    data   : {
					      labels  : [<?php echo $isi_data11;?>],
					      datasets: [
					        {
					          backgroundColor: 'yellow',
					          borderColor    : 'yellow',
					          data           : [<?php echo $isi_data21;?>]
					        },
					        {
					          backgroundColor: 'blue',
					          borderColor    : 'blue',
					          data           : [<?php echo $isi_data31;?>]
					        }
					      ]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero: true,
					
					            // Include a dollar sign in the ticks
					            callback: function (value, index, values) {
					              if (value >= 1000) {
					                value /= 1000
					                value += 'k'
					              }
					              return '' + value
					            }
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					


					})
	
				</script>
	
	
	
		
		
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : ASET KIB-A. TANAH</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                	<canvas id="sales-chart3" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-yellow"></i> NILAI RP
	                  </span>
	                  &nbsp;
	
	                  <span>
	                    <i class="fas fa-square text-blue"></i> LUAS M2
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	


			<br>




			<?php
			//isi *START
			ob_start();

		
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_i = $mb_i + 1;
				$mb_kd = balikin($rmboh['kd']);
				$mb_kode = balikin($rmboh['kode']);
				$mb_nama = balikin($rmboh['nama']);
				
				echo "'$mb_nama', ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			//isi
			$isi_data11 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);
				
				
				
				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS total ".
													"FROM sekolah_kib_b ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			
			//isi
			$isi_data21 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
						
			
			
			?>




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					  var $salesChart = $('#sales-chart4')
					  var salesChart  = new Chart($salesChart, {
					    type   : 'bar',
					    data   : {
					      labels  : [<?php echo $isi_data11;?>],
					      datasets: [
					        {
					          backgroundColor: 'yellow',
					          borderColor    : 'yellow',
					          data           : [<?php echo $isi_data21;?>]
					        }
					      ]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero: true,
					
					            // Include a dollar sign in the ticks
					            callback: function (value, index, values) {
					              if (value >= 1000) {
					                value /= 1000
					                value += 'k'
					              }
					              return '' + value
					            }
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					


					})
	
				</script>
	
	
	
		
		
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : ASET KIB-B. PERALATAN DAN MESIN</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                	<canvas id="sales-chart4" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-yellow"></i> NILAI RP
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	






			<br>






			<?php
			//isi *START
			ob_start();

		
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_i = $mb_i + 1;
				$mb_kd = balikin($rmboh['kd']);
				$mb_kode = balikin($rmboh['kode']);
				$mb_nama = balikin($rmboh['nama']);
				
				echo "'$mb_nama', ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			//isi
			$isi_data11 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);
				
				
				
				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS total ".
													"FROM sekolah_kib_c ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			
			//isi
			$isi_data21 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);

				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(luas_lantai) AS total ".
													"FROM sekolah_kib_c ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			
			

			//isi
			$isi_data31 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);

				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(tanah_luas) AS total ".
													"FROM sekolah_kib_c ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			
			

			//isi
			$isi_data41 = ob_get_contents();
			ob_end_clean();
			
			
			




			
			
			
			?>




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					  var $salesChart = $('#sales-chart5')
					  var salesChart  = new Chart($salesChart, {
					    type   : 'bar',
					    data   : {
					      labels  : [<?php echo $isi_data11;?>],
					      datasets: [
					        {
					          backgroundColor: 'yellow',
					          borderColor    : 'yellow',
					          data           : [<?php echo $isi_data21;?>]
					        },
					        {
					          backgroundColor: 'blue',
					          borderColor    : 'blue',
					          data           : [<?php echo $isi_data31;?>]
					        },
					        {
					          backgroundColor: 'cyan',
					          borderColor    : 'cyan',
					          data           : [<?php echo $isi_data41;?>]
					        }
					      ]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero: true,
					
					            // Include a dollar sign in the ticks
					            callback: function (value, index, values) {
					              if (value >= 1000) {
					                value /= 1000
					                value += 'k'
					              }
					              return '' + value
					            }
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					


					})
	
				</script>
	
	
	
		
		
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : ASET KIB-C. GEDUNG DAN BANGUNAN</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                	<canvas id="sales-chart5" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-yellow"></i> NILAI RP
	                  </span>
	                  &nbsp;
	
	                  <span>
	                    <i class="fas fa-square text-blue"></i> LUAS LANTAI M2
	                  </span>
	                  &nbsp;
	                  
	                  
	                  <span>
	                    <i class="fas fa-square text-cyan"></i> LUAS TANAH M2
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	












			<br>






			<?php
			//isi *START
			ob_start();

		
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_i = $mb_i + 1;
				$mb_kd = balikin($rmboh['kd']);
				$mb_kode = balikin($rmboh['kode']);
				$mb_nama = balikin($rmboh['nama']);
				
				echo "'$mb_nama', ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			//isi
			$isi_data11 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);
				
				
				
				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS total ".
													"FROM sekolah_kib_d ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			
			//isi
			$isi_data21 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);

				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(luas) AS total ".
													"FROM sekolah_kib_d ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			
			

			//isi
			$isi_data31 = ob_get_contents();
			ob_end_clean();
			?>




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					  var $salesChart = $('#sales-chart6')
					  var salesChart  = new Chart($salesChart, {
					    type   : 'bar',
					    data   : {
					      labels  : [<?php echo $isi_data11;?>],
					      datasets: [
					        {
					          backgroundColor: 'yellow',
					          borderColor    : 'yellow',
					          data           : [<?php echo $isi_data21;?>]
					        },
					        {
					          backgroundColor: 'blue',
					          borderColor    : 'blue',
					          data           : [<?php echo $isi_data31;?>]
					        }
					      ]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero: true,
					
					            // Include a dollar sign in the ticks
					            callback: function (value, index, values) {
					              if (value >= 1000) {
					                value /= 1000
					                value += 'k'
					              }
					              return '' + value
					            }
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					


					})
	
				</script>
	
	
	
		
		
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : ASET KIB-D. JALAN, IRIGASI DAN JARINGAN</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                	<canvas id="sales-chart6" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-yellow"></i> NILAI RP
	                  </span>
	                  &nbsp;
	
	                  <span>
	                    <i class="fas fa-square text-blue"></i> LUAS M2
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	
















			<br>






			<?php
			//isi *START
			ob_start();

		
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_i = $mb_i + 1;
				$mb_kd = balikin($rmboh['kd']);
				$mb_kode = balikin($rmboh['kode']);
				$mb_nama = balikin($rmboh['nama']);
				
				echo "'$mb_nama', ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			//isi
			$isi_data11 = ob_get_contents();
			ob_end_clean();
			
			
			
			
			
			
			
			
			
			
			//isi *START
			ob_start();
			
			
			
			
			//daftar sekolah
			$qmboh = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
												"ORDER BY nama ASC");
			$rmboh = mysqli_fetch_assoc($qmboh);
			
			do
				{
				//nilai
				$mb_kd = balikin($rmboh['kd']);
				$mb_nama = balikin($rmboh['nama']);
				
				
				
				
				//ketahui totalnya
				$qyuk = mysqli_query($koneksi, "SELECT SUM(harga) AS total ".
													"FROM sekolah_kib_e ".
													"WHERE sekolah_kd = '$mb_kd'");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_total = balikin($ryuk['total']);
				
				
				
				echo "$yuk_total, ";
				}	
			while ($rmboh = mysqli_fetch_assoc($qmboh));
			

			
			//isi
			$isi_data21 = ob_get_contents();
			ob_end_clean();
			?>




	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					  var $salesChart = $('#sales-chart7')
					  var salesChart  = new Chart($salesChart, {
					    type   : 'bar',
					    data   : {
					      labels  : [<?php echo $isi_data11;?>],
					      datasets: [
					        {
					          backgroundColor: 'yellow',
					          borderColor    : 'yellow',
					          data           : [<?php echo $isi_data21;?>]
					        }
					      ]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero: true,
					
					            // Include a dollar sign in the ticks
					            callback: function (value, index, values) {
					              if (value >= 1000) {
					                value /= 1000
					                value += 'k'
					              }
					              return '' + value
					            }
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					


					})
	
				</script>
	
	
	
		
		
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : ASET KIB-E. ASET TETAP LAINNYA</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                	<canvas id="sales-chart7" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-yellow"></i> NILAI RP
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	









            </div>
            
         </div>
            
            


		<!-- OPTIONAL SCRIPTS -->
		<script src="../template/adminlte3/plugins/chart.js/Chart.min.js"></script>
		




	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	$.noConflict();

	});
	
	</script>
	






<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>
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
require("../../inc/cek/admsekpeg.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admsekpeg.html");

nocache();

//nilai
$filenya = "gps.php";
$judul = "History GPS";
$judul = "[HISTORY]. History GPS";
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











//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//isi *START
ob_start();


//ketahui ordernya...
$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(user_kd) AS uskd ".
								"FROM user_log_gps ".
								"WHERE sekolah_kd = '$sekkd82_session' ".
								"AND user_kd = '$kd82_session' ".
								"AND user_jabatan = 'PEGAWAI' ".
								"AND lat_x <> '' ". 	
								"ORDER BY postdate DESC LIMIT 0,1000");
$ryuk = mysqli_fetch_assoc($qyuk);



do
	{
	//nilai
	$yuk_kd = balikin($ryuk['uskd']);
	
	
	
	//detailkan
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM user_log_gps ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND user_kd = '$yuk_kd' ".
									"AND lat_x <> '' ". 	
									"ORDER BY postdate DESC LIMIT 0,1");
	$ryuk2 = mysqli_fetch_assoc($qyuk2);
	$yuk_kode = balikin($ryuk2['user_kode']);
	$yuk_nama = balikin($ryuk2['user_nama']);
	$yuk_latx = balikin($ryuk2['lat_x']);
	$yuk_laty = balikin($ryuk2['lat_y']);
	

	
	
	echo "['$yuk_kode, $yuk_nama', $yuk_latx,$yuk_laty],";
	}
while ($ryuk = mysqli_fetch_assoc($qyuk));



//isi
$isi_gps2 = ob_get_contents();
ob_end_clean();












//isi *START
ob_start();


//ketahui ordernya...
$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(user_kd) AS uskd ".
								"FROM user_log_gps ".
								"WHERE sekolah_kd = '$sekkd82_session' ".
								"AND user_kd = '$kd82_session' ".
								"AND user_jabatan = 'PEGAWAI' ".
								"AND lat_x <> '' ". 	
								"ORDER BY postdate DESC LIMIT 0,1000");
$ryuk = mysqli_fetch_assoc($qyuk);


do
	{
	//nilai
	$yuk_kd = balikin($ryuk['uskd']);
	
	
	
	//detailkan
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM user_log_gps ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND user_kd = '$yuk_kd' ".
									"AND lat_x <> '' ". 	
									"ORDER BY postdate DESC LIMIT 0,1");
	$ryuk2 = mysqli_fetch_assoc($qyuk2);
	$yuk_kode = balikin($ryuk2['user_kode']);
	$yuk_nama = balikin($ryuk2['user_nama']);
	$yuk_latx = balikin($ryuk2['lat_x']);
	$yuk_laty = balikin($ryuk2['lat_y']);	
	$yuk_alamat = balikin($ryuk2['alamat_googlemap']);
	$yuk_postdate = balikin($ryuk2['postdate']);
	
	echo "['<div class=\"info_content\">' +
        '<h3>$yuk_nama</h3>' +
        '<p>$yuk_kode</p>' +
        '<p>$yuk_jabatan</p>' +
        '<p>$yuk_alamat</p>' +
        '<i>$yuk_postdate</i>' +        
        '</div>'],";	
	}
while ($ryuk = mysqli_fetch_assoc($qyuk));



//isi
$isi_gps3 = ob_get_contents();
ob_end_clean();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//isi *START
ob_start();


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");
?>




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
        this.setZoom(10);
        google.maps.event.removeListener(boundsListener);
    });
    
}
</script>
     

<br>     
     




  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>


  
<?php
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika null
if (empty($kunci))
	{
	$sqlcount = "SELECT * FROM user_log_gps ".
					"WHERE sekolah_kd = '$sekkd82_session' ".
					"AND user_kd = '$kd82_session' ".
					"AND user_jabatan = 'PEGAWAI' ".
					"ORDER BY postdate DESC";
	}
	
else
	{
	$sqlcount = "SELECT * FROM user_log_gps ".
					"WHERE sekolah_kd = '$sekkd82_session' ".
					"AND user_kd = '$kd82_session' ".
					"AND user_jabatan = 'PEGAWAI' ".
					"AND (user_kode LIKE '%$kunci%' ".
					"OR user_nama LIKE '%$kunci%' ".
					"OR user_jabatan LIKE '%$kunci%' ".
					"OR lat_x LIKE '%$kunci%' ".
					"OR lat_y LIKE '%$kunci%' ".
					"OR alamat_googlemap LIKE '%$kunci%') ".
					"ORDER BY postdate DESC";
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



echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
</p>
	

<div class="table-responsive">          
<table class="table" border="1">
<thead>

<tr valign="top" bgcolor="'.$warnaheader.'">
<td><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
<td><strong><font color="'.$warnatext.'">KOORDINAT</font></strong></td>
<td><strong><font color="'.$warnatext.'">ALAMAT GOOGLEMAP</font></strong></td>
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
		$i_postdate = balikin($data['postdate']);
		$i_ujabatan = balikin($data['user_jabatan']);
		$i_ukode = balikin($data['user_kode']);
		$i_lat_x = balikin($data['lat_x']);
		$i_lat_y = balikin($data['lat_y']);
		$i_ket = balikin($data['alamat_googlemap']);
		
		
		//set udah dibaca
		mysqli_query($koneksi, "UPDATE user_log_gps SET dibaca = 'true', ".
									"dibaca_postdate = '$today' ".
									"WHERE sekolah_kd = '$sekkd82_session' ".
									"AND kd = '$i_kd'");
		
		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_postdate.'</td>
		<td>
		'.$i_lat_x.'
		<br>
		'.$i_lat_y.'
		</td>
		<td>'.$i_ket.'</td>
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
</td>
</tr>
</table>
</form>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>
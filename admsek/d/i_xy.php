<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$lokkd = balikin($_POST['lokkd']);
$nilx = balikin($_POST['nilx']);
$nily = balikin($_POST['nily']);




//update
mysqli_query($koneksi, "UPDATE m_sekolah SET lat_x = '$nilx', ".
				"lat_y = '$nily', ".
				"postdate_update = '$today' ".
				"WHERE kd = '$lokkd'");
				
				



	
//jadikan alamat //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$qyuk = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$lokkd'");
$ryuk = mysqli_fetch_assoc($qyuk);
$kdku = balikin($ryuk['kd']);
$lat = balikin($ryuk['lat_x']);
$long = balikin($ryuk['lat_y']);




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

 	
//update
mysqli_query($koneksi, "UPDATE m_sekolah SET alamat_googlemap = '$nilaiku', ".
							"postdate_update = '$today' ".
							"WHERE kd = '$lokkd'");







				
exit();
?>
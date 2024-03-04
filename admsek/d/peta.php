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
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/admsek.php");
$tpl = LoadTpl("../../template/admsek.html");


nocache();

//nilai
$filenya = "peta.php";
$judul = "[PROFIL SEKOLAH]. Peta Lokasi";
$judulku = "$judul";



$ku_latx = "-6.923503266104782";
$ku_laty = "110.20223736763";










//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP2'])
	{
	//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$kd81_session'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);

	$ku_ket = cegah("$judul. UPDATE");			
	
	
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
	}
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//isi *START
ob_start();






     	
echo '<form action="'.$filenya.'" method="post" name="formx">';


//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"WHERE kd = '$kd81_session'");
$rku = mysqli_fetch_assoc($qku);
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);
$ku_alamat = balikin($rku['alamat_googlemap']);



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




$diload = "peta_awal(18);setpeta('$e_lat_x','$e_lat_y','$kdx',18)";

echo '<form action="'.$filenya.'" method="post" name="formx2">';
?>



	<script type="text/javascript" src="<?php echo $sumber;?>/inc/js/jquery.js"></script>

  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&&callback=initMap&key=<?php echo $keyku;?>"></script>

	<script type="text/javascript" src="<?php echo $sumber;?>/inc/js/gmap3.js"></script>
	<script type="text/javascript">
	var peta;
	var dataku;

	function peta_awal(zoomnya){
	var indonesia = new google.maps.LatLng(<?php echo $e_lat_x;?>, <?php echo $e_lat_y;?>);
	var petaoption = {
		zoom: zoomnya,
		center: indonesia,
		mapTypeId: google.maps.MapTypeId.HYBRID
		};
	peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
	google.maps.event.addListener(peta,'click',function(event){
		kasihtanda(event.latLng);
	});
	}

	function kasihtanda(lokasi, dataku){
	$("#cx").val(lokasi.lat());
	$("#cy").val(lokasi.lng());


	tanda.setMap(null);
	
        $.ajax({
            type : 'POST',
            url : 'i_xy.php',
            data: {
                nilx : $('#cx').val(),
                nily : $('#cy').val(),
                lokkd : $('#dataku').val()
            },
            success:function (data) {
                $("#testku").append(data);

            }
        });



	tanda = new google.maps.Marker({
		position: lokasi,
		map: peta
		});
		
	
	tanda.setMap(peta);
	}



	function setpeta(x,y,id,zoomnya){
	var lokasibaru = new google.maps.LatLng(x,y);
	var petaoption = {
		zoom: zoomnya,
		center: lokasibaru,
		mapTypeId: google.maps.MapTypeId.HYBRID
		};
	peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
	tanda = new google.maps.Marker({
		position: lokasibaru,
		map: peta
	});
	var idnya = "#"+id;
	var isistring = "<?php echo $e_nama;?>";
	var infowindow = new google.maps.InfoWindow({
		content: isistring
	});






	google.maps.event.addListener(tanda, 'click', function() {
	infowindow.open(peta,tanda);
	});
	google.maps.event.addListener(peta,'click',function(event){
		kasihtanda(event.latLng);
	});




	var cluster1 = [

	<?php
	//data di database
	$qdt = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$kd81_session'");
	$rdt = mysqli_fetch_assoc($qdt);
	$tdt = mysqli_num_rows($qdt);
	$dt_x = balikin($rdt['lat_x']);


	//jika gak null
	if (!empty($dt_x))
		{
		do
			{
			$dt_x = balikin($rdt['lat_x']);
			$dt_y = balikin($rdt['lat_y']);

			echo 'new google.maps.LatLng('.$dt_x.', '.$dt_y.'), ';
			}
		while ($rdt = mysqli_fetch_assoc($qdt));
		}
		
	else
		{
		$e_lat_x = $ku_latx;
		$e_lat_y = $ku_laty;
	
		$dt_x = $e_lat_x;
		$dt_y = $e_lat_y;
	
		echo 'new google.maps.LatLng('.$dt_x.', '.$dt_y.'), ';
		
		}
	?>
	];

	var p1 = new google.maps.Polygon({
	map: peta,
	path: cluster1,
	strokeColor: "#FF0000",
	strokeOpacity: 0.8,
	strokeWeight: 2,
	fillColor: "#FF0000",
	fillOpacity: 0.35
	});
	}


	</script>



	<p>
	Alamat Google MAP : 
	<br>
		<i>
			<?php echo $ku_alamat;?>
			<br>
			
			<?php echo $ku_lat_x;?>, <?php echo $ku_lat_y;?> 
		</i>
	</p>

	<div id="petaku" style="width:100%; height:600px"></div>

	<input type="hidden" name="lat_x" id="cx" size="25" value="<?php echo $e_lat_x;?>">
	<input type="hidden" name="lat_y" id="cy" size="25" value="<?php echo $e_lat_y;?>">
	<input name="dataku" id="dataku" type="hidden" value="<?php echo $kd81_session;?>">
	<div class="testku" id="testku"></div>


	<img src="<?php echo $sumber;?>/img/wait.gif" style="display:none" id="loading">


<br>
<p>
<input name="btnSMP2" type="submit" value="SIMPAN >>" class="btn btn-block btn-danger">
</p>


</form>




<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>
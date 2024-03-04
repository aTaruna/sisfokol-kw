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



//nilai
$filenya = "profil.php";
$judul = "[PROFIL SEKOLAH] Data Profil";
$judulku = "$judul";
$juduli = $judul;








//detail sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
				"WHERE kd = '$kd81_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = cegah($rowx['kode']);
$e_nama = cegah($rowx['nama']);













//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnKRM26'])
	{
	//ambil nilai
	$e_kode_nss6 = cegah($_POST['e_kode_nss6']);
	$e_kode_nds6 = cegah($_POST['e_kode_nds6']);
	$e_alamat6 = cegah($_POST['e_alamat6']);
	$e_telp6 = cegah($_POST['e_telp6']);
	$e_email6 = cegah($_POST['e_email6']);
	
	$e_thn_berdiri6 = cegah($_POST['e_thn_berdiri6']);
	$e_status6 = cegah($_POST['e_status6']);
	$e_noskstatus6 = cegah($_POST['e_noskstatus6']);
	$e_noskstatustgl6 = cegah($_POST['e_noskstatustgl6']);
	
		//pecah tanggal
	$tgl1_pecah = balikin($e_noskstatustgl6);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_noskstatustgl6 = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";

	
	
	$e_seleng6 = cegah($_POST['e_seleng6']);
	$e_noskdiri6 = cegah($_POST['e_noskdiri6']);
	$e_nosktgl6 = cegah($_POST['e_nosktgl6']);

		//pecah tanggal
	$tgl1_pecah = balikin($e_nosktgl6);
	$tgl1_pecahku = explode("-", $tgl1_pecah);
	$tgl1_tgl = trim($tgl1_pecahku[2]);
	$tgl1_bln = trim($tgl1_pecahku[1]);
	$tgl1_thn = trim($tgl1_pecahku[0]);
	$e_nosktgl6 = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";





	$e_ks_nama6 = cegah($_POST['e_ks_nama6']);
	$e_ks_ijazah6 = cegah($_POST['e_ks_ijazah6']);
	$e_ks_nbsm6 = cegah($_POST['e_ks_nbsm6']);
	$e_tanah_luas6 = cegah($_POST['e_tanah_luas6']);
	$e_tanah_status6 = cegah($_POST['e_tanah_status6']);
	$e_bang_luas6 = cegah($_POST['e_bang_luas6']);
	$e_masjid6 = cegah($_POST['e_masjid6']);
	
	$e_jml_l = cegah($_POST['e_jml_l']);
	$e_jml_p = cegah($_POST['e_jml_p']);
	$e_jml_siswa = cegah($_POST['e_jml_siswa']);
	$e_jml_kelas = cegah($_POST['e_jml_kelas']);

	
	$peg_jml_l = cegah($_POST['peg_jml_l']);
	$peg_jml_p = cegah($_POST['peg_jml_p']);
	$peg_jml_total = cegah($_POST['peg_jml_total']);


	
	$e_postdate = $today;

	
	
	//detail sekolah
	$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
					"WHERE kd = '$kd81_session'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_kode = cegah($rowx['kode']);
	$e_nama = cegah($rowx['nama']);
		
				  
				  

	//update
	mysqli_query($koneksi, "UPDATE m_sekolah SET kode_nss = '$e_kode_nss6', ".
								"kode_nds = '$e_kode_nss6', ".
								"alamat = '$e_alamat6', ".
								"telp = '$e_telp6', ".
								"email = '$e_email6', ".
								"thn_berdiri = '$e_thn_berdiri6', ".
								"status = '$e_status6', ".
								"sk_status_nomor = '$e_noskstatus6', ".
								"sk_status_tgl = '$e_noskstatustgl6', ".
								"penyelenggara = '$e_seleng6', ".
								"sk_pendirian_nomor = '$e_noskdiri6', ".
								"sk_pendirian_tgl = '$e_nosktgl6', ".
								"ks_nama = '$e_ks_nama6', ".
								"ks_ijazah = '$e_ks_ijazah6', ".
								"ks_kode = '$e_ks_nbsm6', ".
								"sarpras_luas_tanah = '$e_tanah_luas6', ".
								"sarpras_status = '$e_tanah_status6', ".
								"sarpras_luas_bangunan = '$e_bang_luas6', ".
								"sarpras_masjid = '$e_masjid6', ".
								"total_siswa_l = '$e_jml_l', ".
								"total_siswa_p = '$e_jml_p', ".
								"total_siswa = '$e_jml_siswa', ".
								"total_kelas = '$e_jml_kelas', ".
								"total_pegawai_l = '$peg_jml_l', ".
								"total_pegawai_p = '$peg_jml_p', ".
								"total_pegawai = '$peg_jml_total', ".
								"postdate_update = '$e_postdate' ".
								"WHERE kd = '$kd81_session'");







	//hapus dulu, trus entri baru
	mysqli_query($koneksi, "DELETE FROM sekolah_jml_siswa ".
								"WHERE sekolah_kd = '$kd81_session'");
								
								
	mysqli_query($koneksi, "DELETE FROM sekolah_jml_karyawan ".
								"WHERE sekolah_kd = '$kd81_session'");
								
								
								


	//jumlah siswa
	for ($k=1;$k<=6;$k++)
		{
		//nilai
		$xku = "$kd81_session$k";

		$yuk = "e_nil2";
		$yuhu = "$yuk$k";
		$e_nil2 = cegah($_POST["$yuhu"]);

		$yuk = "e_nil3";
		$yuhu = "$yuk$k";
		$e_nil3 = cegah($_POST["$yuhu"]);

		$yuk = "e_nil4";
		$yuhu = "$yuk$k";
		$e_nil4 = cegah($_POST["$yuhu"]);
		
		$yuk = "e_nil5";
		$yuhu = "$yuk$k";
		$e_nil5 = cegah($_POST["$yuhu"]);
		
		$yuk = "e_nil6";
		$yuhu = "$yuk$k";
		$e_nil6 = cegah($_POST["$yuhu"]);



		//insert
		mysqli_query($koneksi, "INSERT INTO sekolah_jml_siswa(kd, sekolah_kd, sekolah_kode, ".
									"sekolah_nama, kelas, jml_l, jml_p, ".
									"jml_total, jml_kelas, spp_bulanan, postdate) VALUES ".
									"('$xku', '$kd81_session', '$e_kode', ".
									"'$e_nama', '$k', '$e_nil2', '$e_nil3', ".
									"'$e_nil4', '$e_nil5', '$e_nil6', '$today');");

		}

	







	//list keadaan karyawan
	$qyuk = mysqli_query($koneksi, "SELECT * FROM m_keadaan_karyawan ".
										"ORDER BY round(nourut) ASC");
	$ryuk = mysqli_fetch_assoc($qyuk);	
	
	do	
		{
		//nilai
		$yuk_kd = balikin($ryuk['kd']);
		$yuk_nourut = cegah($ryuk['nourut']);
		$yuk_nama = cegah($ryuk['nama']);
		$k = $yuk_nourut;


		//nilai
		$xku = "$kd81_session$k";

		$yuk = "g_nil2";
		$yuhu = "$yuk$k";
		$g_nil2 = cegah($_POST["$yuhu"]);

		$yuk = "g_nil3";
		$yuhu = "$yuk$k";
		$g_nil3 = cegah($_POST["$yuhu"]);

		$yuk = "g_nil4";
		$yuhu = "$yuk$k";
		$g_nil4 = cegah($_POST["$yuhu"]);
		
		$yuk = "g_nil5";
		$yuhu = "$yuk$k";
		$g_nil5 = cegah($_POST["$yuhu"]);



		//insert
		mysqli_query($koneksi, "INSERT INTO sekolah_jml_karyawan(kd, sekolah_kd, sekolah_kode, ".
									"sekolah_nama, nourut, keadaan, jml_l, jml_p, ".
									"jml_total, keterangan, postdate) VALUES ".
									"('$xku', '$kd81_session', '$e_kode', ".
									"'$e_nama', '$k', '$yuk_nama', '$g_nil2', '$g_nil3', ".
									"'$g_nil4', '$g_nil5', '$today');");
		}
	while ($ryuk = mysqli_fetch_assoc($qyuk));










	//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$kd81_session'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);

	$ku_ket = cegah("[MENU : $judul]. UPDATE");			
	
	
	//insert
	mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
					"user_kd, user_kode, user_nama, ".
					"user_posisi, user_jabatan, ket, postdate) VALUES ".
					"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
					"'$ku_kd', '$ku_kode', '$ku_nama', ".
					"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////






	//auto-kembali
	//$pesan = "Update Berhasil SIMPAN. [Postdate : '$e_postdate].";
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



<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendors/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>


<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

	  $('#e_kode_nss6').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});

	  $('#e_kode_nds6').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});

	  $('#e_thn_berdiri6').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});

	  $('#e_tanah_luas6').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});

	  $('#e_bang_luas6').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});

	  $('#e_masjid6').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  		});







	<?php
	for ($k=1;$k<=6;$k++)
		{
		?>

		  $('#e_nil2<?php echo $k;?>').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_nil3<?php echo $k;?>').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_nil4<?php echo $k;?>').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_nil5<?php echo $k;?>').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

		  $('#e_nil6<?php echo $k;?>').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

	
		    $('#e_nil2<?php echo $k;?>').on("keyup", function () {
				hitungkabeh<?php echo $k;?>();
		    })

	
		    $('#e_nil3<?php echo $k;?>').on("keyup", function () {
				hitungkabeh<?php echo $k;?>();
		    })
	  		
		  		
		    function hitungkabeh<?php echo $k;?>() {
	
					var e_nil1 = parseInt($('#e_nil2<?php echo $k;?>').val());
					var e_nil2 = parseInt($('#e_nil3<?php echo $k;?>').val());
					
				    totalnya = e_nil1 + e_nil2;
				    
					$('#e_nil4<?php echo $k;?>').val(totalnya);

		
					var e_nil1 = parseInt($('#e_nil21').val());
					var e_nil2 = parseInt($('#e_nil22').val());
					var e_nil3 = parseInt($('#e_nil23').val());
					var e_nil4 = parseInt($('#e_nil24').val());
					var e_nil5 = parseInt($('#e_nil25').val());
					var e_nil6 = parseInt($('#e_nil26').val());
					totalnya1 = e_nil1 + e_nil2 + e_nil3 + e_nil4 + e_nil5 + e_nil6;
					
					$('#e_jml_l').val(totalnya1);



		
					var e_nil1 = parseInt($('#e_nil31').val());
					var e_nil2 = parseInt($('#e_nil32').val());
					var e_nil3 = parseInt($('#e_nil33').val());
					var e_nil4 = parseInt($('#e_nil34').val());
					var e_nil5 = parseInt($('#e_nil35').val());
					var e_nil6 = parseInt($('#e_nil36').val());
					totalnya2 = e_nil1 + e_nil2 + e_nil3 + e_nil4 + e_nil5 + e_nil6;
					
					$('#e_jml_p').val(totalnya2);
					
					
					
					totalnya3 = totalnya1 + totalnya2;
					$('#e_jml_siswa').val(totalnya3);

					
				}
		    
		    



	
		    $('#e_nil5<?php echo $k;?>').on("keyup", function () {
				hitungkabehx<?php echo $k;?>();
		    })
	  		
		  		
		    function hitungkabehx<?php echo $k;?>() {
	
					var e_nil1 = parseInt($('#e_nil51').val());
					var e_nil2 = parseInt($('#e_nil52').val());
					var e_nil3 = parseInt($('#e_nil53').val());
					var e_nil4 = parseInt($('#e_nil54').val());
					var e_nil5 = parseInt($('#e_nil55').val());
					var e_nil6 = parseInt($('#e_nil56').val());
					totalnya1 = e_nil1 + e_nil2 + e_nil3 + e_nil4 + e_nil5 + e_nil6;
					
					$('#e_jml_kelas').val(totalnya1);

					
				}
		    


	    
		<?php
		}
		
		
		
		
		
		//list keadaan
		$qyuk = mysqli_query($koneksi, "SELECT * FROM m_keadaan_karyawan ".
											"ORDER BY round(nourut) ASC");
		$ryuk = mysqli_fetch_assoc($qyuk);	
		
		do	
			{
			//nilai
			$yuk_kd = balikin($ryuk['kd']);
			$yuk_nourut = balikin($ryuk['nourut']);
			$yuk_nama = balikin($ryuk['nama']);
			?>
			
			  $('#g_nil2<?php echo $yuk_nourut;?>').bind('keyup paste', function(){
		        this.value = this.value.replace(/[^0-9]/g, '');
		  		});
		  	
			  $('#g_nil3<?php echo $yuk_nourut;?>').bind('keyup paste', function(){
		        this.value = this.value.replace(/[^0-9]/g, '');
		  		});
		  		
			  $('#g_nil4<?php echo $yuk_nourut;?>').bind('keyup paste', function(){
		        this.value = this.value.replace(/[^0-9]/g, '');
		  		});
		  	
			  $('#g_nil5<?php echo $yuk_nourut;?>').bind('keyup paste', function(){
		        this.value = this.value.replace(/[^0-9]/g, '');
		  		});

		
			    $('#g_nil2<?php echo $yuk_nourut;?>').on("keyup", function () {
					hitungkabehh<?php echo $yuk_nourut;?>();
			    })
	
		
			    $('#g_nil3<?php echo $yuk_nourut;?>').on("keyup", function () {
					hitungkabehh<?php echo $yuk_nourut;?>();
			    })
		  		
			  		
			    function hitungkabehh<?php echo $yuk_nourut;?>() {
		
						var e_nil1 = parseInt($('#g_nil2<?php echo $yuk_nourut;?>').val());
						var e_nil2 = parseInt($('#g_nil3<?php echo $yuk_nourut;?>').val());
						
					    totalnya = e_nil1 + e_nil2;
					    
						$('#g_nil4<?php echo $yuk_nourut;?>').val(totalnya);
						
						
				
						var e_nil1 = parseInt($('#g_nil21').val());
						var e_nil2 = parseInt($('#g_nil22').val());
						var e_nil3 = parseInt($('#g_nil23').val());
						var e_nil4 = parseInt($('#g_nil24').val());
						var e_nil5 = parseInt($('#g_nil25').val());
						var e_nil6 = parseInt($('#g_nil26').val());
						var e_nil7 = parseInt($('#g_nil27').val());
						totalnya1 = e_nil1 + e_nil2 + e_nil3 + e_nil4 + e_nil5 + e_nil6 + e_nil7;
						
						$('#peg_jml_l').val(totalnya1);







				
						var e_nil1 = parseInt($('#g_nil31').val());
						var e_nil2 = parseInt($('#g_nil32').val());
						var e_nil3 = parseInt($('#g_nil33').val());
						var e_nil4 = parseInt($('#g_nil34').val());
						var e_nil5 = parseInt($('#g_nil35').val());
						var e_nil6 = parseInt($('#g_nil36').val());
						var e_nil7 = parseInt($('#g_nil37').val());
						totalnya1 = e_nil1 + e_nil2 + e_nil3 + e_nil4 + e_nil5 + e_nil6 + e_nil7;
						
						$('#peg_jml_p').val(totalnya1);










						
						
						var e_nil1 = parseInt($('#g_nil41').val());
						var e_nil2 = parseInt($('#g_nil42').val());
						var e_nil3 = parseInt($('#g_nil43').val());
						var e_nil4 = parseInt($('#g_nil44').val());
						var e_nil5 = parseInt($('#g_nil45').val());
						var e_nil6 = parseInt($('#g_nil46').val());
						var e_nil7 = parseInt($('#g_nil47').val());
						totalnya1 = e_nil1 + e_nil2 + e_nil3 + e_nil4 + e_nil5 + e_nil6 + e_nil7;
						
						$('#peg_jml_total').val(totalnya1);

					}
		    
		    
		  	
			<?php				
			}
		while ($ryuk = mysqli_fetch_assoc($qyuk));

	
	?>


		
});

</script>



	
<?php
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
					"WHERE kd = '$kd81_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = balikin($rowx['kode']);
$e_kode_nss = balikin($rowx['kode_nss']);
$e_kode_nds = balikin($rowx['kode_nds']);
$e_nama = balikin($rowx['nama']);
$e_telp = balikin($rowx['telp']);
$e_alamat = balikin($rowx['alamat']);
$e_email = balikin($rowx['email']);
$e_postdate_update = balikin($rowx['postdate_update']);

$e_thn_berdiri = balikin($rowx['thn_berdiri']);
$e_status = balikin($rowx['status']);
$e_sk_status_nomor = balikin($rowx['sk_status_nomor']);
$e_sk_status_tgl = balikin($rowx['sk_status_tgl']);
$e_penyelenggara = balikin($rowx['penyelenggara']);
$e_sk_pendirian_nomor = balikin($rowx['sk_pendirian_nomor']);
$e_sk_pendirian_tgl = balikin($rowx['sk_pendirian_tgl']);
$e_ks_nama = balikin($rowx['ks_nama']);
$e_ks_ijazah = balikin($rowx['ks_ijazah']);
$e_ks_kode = balikin($rowx['ks_kode']);
$e_sarpras_luas_tanah = balikin($rowx['sarpras_luas_tanah']);
$e_sarpras_status = balikin($rowx['sarpras_status']);
$e_sarpras_luas_bangunan = balikin($rowx['sarpras_luas_bangunan']);
$e_sarpras_masjid = balikin($rowx['sarpras_masjid']);

$e_total_siswa_l = balikin($rowx['total_siswa_l']);
$e_total_siswa_p = balikin($rowx['total_siswa_p']);
$e_total_siswa = balikin($rowx['total_siswa']);

								
								

echo '<form action="'.$filenya.'" method="post" name="formx2">

<div class="row">

	<div class="col-md-4">
		
	<p>
	Kode/Username : 
	<br>
	<b>'.$e_kode.'</b>
	</p>
	</div>
	
	
	<div class="col-md-4">
	
	<p>
	Nama Sekolah : 
	<br>
	<b>'.$e_nama.'</b>
	</p>

	</div>



</div>


<hr>

<b>UPDATE TERAKHIR</b> : <font color="red">'.$e_postdate_update.'</font>

<hr>



<div class="row">

	<div class="col-md-4">

	<p>
	NSS : 
	<br>
	<input name="e_kode_nss6" id="e_kode_nss6" type="text" size="20" class="btn-warning" value="'.$e_kode_nss.'" required>
	</p>

	<p>
	NDS : 
	<br>
	<input name="e_kode_nds6" id="e_kode_nds6" type="text" size="20" class="btn-warning" value="'.$e_kode_nds.'" required>
	</p>
	<br>

	</div>
	
	<div class="col-md-4">
	

	<p>
	Alamat : 
	<br>
	<input name="e_alamat6" id="e_alamat6" type="text" size="30" class="btn-warning" value="'.$e_alamat.'" required>
	</p>
	<br>

	</div>
	
	<div class="col-md-4">
	
	<p>
	Telepon/HP/WA : 
	<br>
	<input name="e_telp6" id="e_telp6" type="text" size="20" class="btn-warning" value="'.$e_telp.'" required>
	</p>
	
	
	
	<p>
	E-Mail : 
	<br> 
	<input name="e_email6" id="e_email6" type="text" size="30" class="btn-warning" value="'.$e_email.'" required>
	</p>

	</div>



</div>





<hr>

<div class="row">
			
			<div class="col-md-4">
		
			
				<p>
				Tahun Berdiri : 
				<br>
				<input name="e_thn_berdiri6" id="e_thn_berdiri6" type="text" size="5" class="btn-warning" value="'.$e_thn_berdiri.'" required>
				</p>
				<br>

				<p>
				Status / Peringkat Sekolah Swasta : 
				<br>
				<input name="e_status6" id="e_status6" type="text" class="btn-block btn-warning" value="'.$e_status.'" required>
				</p>
				<br>
				
				
								
				<p>
				No.SK Status Jenjang Akreditasi : 
				<br>
				<input name="e_noskstatus6" id="e_noskstatus6" type="text" class="btn-block btn-warning" value="'.$e_sk_status_nomor.'" required>
				<br>
				
				Tanggal SK Status : 
				<br>
				<input name="e_noskstatustgl6" id="e_noskstatustgl6" type="date" class="btn-block btn-warning" value="'.$e_sk_status_tgl.'" required>
				
				</p>
				<br>
				
												
			</div>
			
			<div class="col-md-4">
				
				<p>
				Penyelenggara Sekolah : 
				<br>
				<input name="e_seleng6" id="e_seleng6" type="text" class="btn-block btn-warning" value="'.$e_penyelenggara.'" required>
				</p>
				<br>
				
				<p>
				No. SK Pendirian : 
				<br>
				<input name="e_noskdiri6" id="e_noskdiri6" type="text" class="btn-block btn-warning" value="'.$e_sk_pendirian_nomor.'" required>
				<br>
				
				Tanggal SK Pendirian: 
				<br>
				<input name="e_nosktgl6" id="e_nosktgl6" type="date" class="btn-block btn-warning" value="'.$e_sk_pendirian_tgl.'" required>
				</p>
				<br>
				
			</div>
			
	</div>




	<div class="row">
			
			<div class="col-md-12">
			<hr>
	
			<p>
				Jumlah Siswa, Kelas dan SPP	:
				<br>
				
					<div class="table-responsive6">          
					  <table class="table" border="1">
					    <tbody>
					    
					    <tr bgcolor="'.$warnaheader.'">
					    	<td width="50" align="center">
					    		<b><font color="white">KELAS</font></b>
				              </td>
					        <td align="center">
					        	<b><font color="white">LAKI-LAKI</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">PEREMPUAN</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">JUMLAH SISWA</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">JUMLAH KELAS</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">SPP TIAP BULAN (Rp.)</font></b>
					        	</td>
				        </tr>';
					
						
					for ($k=1;$k<=6;$k++)
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
			
				
						//nilai
						$nomer = $nomer + 1;
			
			
						//nilainya
						$qyuk = mysqli_query($koneksi, "SELECT * FROM sekolah_jml_siswa ".
															"WHERE sekolah_kd = '$kd81_session' ".
															"AND kelas = '$k'");
						$ryuk = mysqli_fetch_assoc($qyuk);
						$yuk_jml_l = balikin($ryuk['jml_l']);
						$yuk_jml_p = balikin($ryuk['jml_p']);
						$yuk_total = $yuk_jml_l + $yuk_jml_p;
						$yuk_jml_kelas = balikin($ryuk['jml_kelas']);
						$yuk_spp_bulanan = balikin($ryuk['spp_bulanan']);
			
						echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
						echo '<td align="center">
						'.$k.'
						</td>
						<td>
						<input name="e_nil2'.$k.'" id="e_nil2'.$k.'" type="text" class="btn-block btn-warning" value="'.$yuk_jml_l.'" required>
						</td>
						<td>
						<input name="e_nil3'.$k.'" id="e_nil3'.$k.'" type="text" class="btn-block btn-warning" value="'.$yuk_jml_p.'" required>
						</td>
						<td>
						<input name="e_nil4'.$k.'" id="e_nil4'.$k.'" type="text" class="btn-block btn-info" value="'.$yuk_total.'" readonly>
						</td>
						<td>
						<input name="e_nil5'.$k.'" id="e_nil5'.$k.'" type="text" class="btn-block btn-warning" value="'.$yuk_jml_kelas.'" required>
						</td>
						<td>
						<input name="e_nil6'.$k.'" id="e_nil6'.$k.'" type="text" class="btn-block btn-warning" value="'.$yuk_spp_bulanan.'" required>
						</td>
				    	</tr>';
						}


			
					//nilainya
					$qyuk3 = mysqli_query($koneksi, "SELECT SUM(jml_l) AS total_jml_l, ".
														"SUM(jml_p) AS total_jml_p, ".
														"SUM(jml_kelas) AS total_jml_kelas ".
														"FROM sekolah_jml_siswa ".
														"WHERE sekolah_kd = '$kd81_session'");
					$ryuk3 = mysqli_fetch_assoc($qyuk3);
					$yuk3_jml_l = balikin($ryuk3['total_jml_l']);
					$yuk3_jml_p = balikin($ryuk3['total_jml_p']);
					$yuk3_jml_siswa = $yuk3_jml_l + $yuk3_jml_p;
					$yuk3_jml_kelas = balikin($ryuk3['total_jml_kelas']);
			
			
					echo '<tr bgcolor="'.$warnaheader.'">
				    	<th>
				    		<span><font color="white">JUMLAH</font></span>
			              </th>
				        <th>
							<input name="e_jml_l" id="e_jml_l" type="text" class="btn-block btn-info" value="'.$yuk3_jml_l.'" readonly>
				        	</th>
				        <th>
							<input name="e_jml_p" id="e_jml_p" type="text" class="btn-block btn-info" value="'.$yuk3_jml_p.'" readonly>
				        	</th>
				        <th>
							<input name="e_jml_siswa" id="e_jml_siswa" type="text" class="btn-block btn-info" value="'.$yuk3_jml_siswa.'" readonly>
				        	</th>
				        <th>
							<input name="e_jml_kelas" id="e_jml_kelas" type="text" class="btn-block btn-info" value="'.$yuk3_jml_kelas.'" readonly>
				        	</th>
				        <th>
				        	&nbsp;
				        	</th>
			        </tr>';
				
		
				
				echo '</tbody>
				  </table>
				  
				  </div>
									
			
			
			</p>
	
	
			</div>
			
	</div>



	<hr>



	<div class="row">
			
			<div class="col-md-12">
	
			<p>
				Guru dan Karyawan	:
				<br>
				
					<div class="table-responsive6">          
					  <table class="table" border="1">
					    <tbody>
					    
					    <tr bgcolor="'.$warnaheader.'">
					    	<td align="center">
					    		<b><font color="white">KEADAAN GURU/KARYAWAN</font></b>
				              </td>
					        <td align="center">
					        	<b><font color="white">LAKI-LAKI</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">PEREMPUAN</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">JUMLAH</font></b>
					        	</td>
					        <td align="center">
					        	<b><font color="white">KETERANGAN</font></b>
					        	</td>
				        </tr>';
					
			
					//list keadaan
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_keadaan_karyawan ".
														"ORDER BY round(nourut) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);	
					
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
			
				
						//nilai
						$yuk_kd = balikin($ryuk['kd']);
						$yuk_nourut = balikin($ryuk['nourut']);
						$yuk_nama = balikin($ryuk['nama']);
			


						//nilainya
						$qyuk4 = mysqli_query($koneksi, "SELECT * FROM sekolah_jml_karyawan ".
															"WHERE sekolah_kd = '$kd81_session' ".
															"AND nourut = '$yuk_nourut'");
						$ryuk4 = mysqli_fetch_assoc($qyuk4);
						$yuk4_jml_l = balikin($ryuk4['jml_l']);
						$yuk4_jml_p = balikin($ryuk4['jml_p']);
						$yuk4_total = $yuk4_jml_l + $yuk4_jml_p;
						$yuk4_ket = balikin($ryuk4['keterangan']);
			
			
						echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
						echo '<td>
						'.$arrrkolom[$yuk_nourut].'. '.$yuk_nama.'
						</td>
						<td>
						<input name="g_nil2'.$yuk_nourut.'" id="g_nil2'.$yuk_nourut.'" type="text" class="btn-block btn-warning" value="'.$yuk4_jml_l.'" required>
						</td>
						<td>
						<input name="g_nil3'.$yuk_nourut.'" id="g_nil3'.$yuk_nourut.'" type="text" class="btn-block btn-warning" value="'.$yuk4_jml_p.'" required>
						</td>
						<td>
						<input name="g_nil4'.$yuk_nourut.'" id="g_nil4'.$yuk_nourut.'" type="text" class="btn-block btn-info" value="'.$yuk4_total.'" readonly>
						</td>
						<td>
						<input name="g_nil5'.$yuk_nourut.'" id="g_nil5'.$yuk_nourut.'" type="text" class="btn-block btn-warning" value="'.$yuk4_ket.'" required>
						</td>
				    	</tr>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));




					//nilainya
					$qyuk31 = mysqli_query($koneksi, "SELECT SUM(jml_l) AS total_jml_l, ".
														"SUM(jml_p) AS total_jml_p ".
														"FROM sekolah_jml_karyawan ".
														"WHERE sekolah_kd = '$kd81_session'");
					$ryuk31 = mysqli_fetch_assoc($qyuk31);
					$yuk31_jml_l = balikin($ryuk31['total_jml_l']);
					$yuk31_jml_p = balikin($ryuk31['total_jml_p']);
					$yuk31_jml_total = $yuk31_jml_l + $yuk31_jml_p;
			
			
			
					echo '<tr bgcolor="'.$warnaheader.'">
				    	<th>
				    		<span><font color="white">JUMLAH</font></span>
			              </th>
				        <th>
							<input name="peg_jml_l" id="peg_jml_l" type="text" class="btn-block btn-info" value="'.$yuk31_jml_l.'" readonly>
				        	</th>
				        <th>
							<input name="peg_jml_p" id="peg_jml_p" type="text" class="btn-block btn-info" value="'.$yuk31_jml_p.'" readonly>
				        	</th>
				        <th>
							<input name="peg_jml_total" id="peg_jml_total" type="text" class="btn-block btn-info" value="'.$yuk31_jml_total.'" readonly>
				        	</th>
				        <th>
							&nbsp;
				        	</th>
			        </tr>';
				
		
				
				echo '</tbody>
				  </table>
				  
				  </div>
									
			
			
			</p>
	
	
			</div>
			
	</div>



	<hr>

	<div class="row">
			
			<div class="col-md-4">

				<p>
				Nama Kepala Sekolah : 
				<br>
				<input name="e_ks_nama6" id="e_ks_nama6" type="text" class="btn-warning" value="'.$e_ks_nama.'" required>
				</p>
				<br>

				<p>
				Ijazah Terakhir : 
				<br>
				<input name="e_ks_ijazah6" id="e_ks_ijazah6" type="text" class="btn-warning" value="'.$e_ks_ijazah.'" required>
				</p>
				<br>
				
				<p>
				NBM/NKTAM/NIP : 
				<br>
				<input name="e_ks_nbsm6" id="e_ks_nbm6" type="text" class="btn-warning" value="'.$e_ks_kode.'" required>
				</p>
				<br>
				

				
			</div>

			
			<div class="col-md-3">

				<p>
				PRASARANA : 
				<br>
				a. Luas Tanah : 
				<br>
				<input name="e_tanah_luas6" id="e_tanah_luas6" type="text" class="btn-warning" value="'.$e_sarpras_luas_tanah.'" size="5" required> M2
				</p>
				<br>
				
				<p>
				Status Tanah : 
				<br>
				<input name="e_tanah_status6" id="e_tanah_status6" type="text" class="btn-warning" value="'.$e_sarpras_status.'" required>
				
				</p>
				<br>
				
			</div>

			
			<div class="col-md-3">
				<br>
	

				<p>
				b. Luas Bangunan : 
				<br>
				<input name="e_bang_luas6" id="e_bang_luas6" type="text" class="btn-warning" value="'.$e_sarpras_luas_bangunan.'" size="10" required> M2
				</p>
				<br>
				
				<p>
				c. Luas Masjid/Musholla : 
				<br>
				<input name="e_masjid6" id="e_masjid6" type="text" class="btn-warning" value="'.$e_sarpras_masjid.'" size="10" required> M2
				
				</p>
				<br>

				
			</div>
						
	</div>




	<div class="row">
		<div class="col-md-12">
		
			<hr>

			<input name="btnKRM26" type="submit" class="btn btn-block btn-danger" value="SIMPAN >>">
		</div>
	</div>




</form>';
















/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
exit();
?>
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
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/adm.html");

nocache();

//nilai
$filenya = "profil.php";
$judul = "Data Sekolah";
$judul = "[PROFIL SEKOLAH]. Data Sekolah";
$judulku = "$judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
$kdx = $kd;
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
	
	
	
	


//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kdx']);
	$page = nosql($_POST['page']);;
	$e_kode = cegah($_POST['e_kode']);
	$e_nama = cegah($_POST['e_nama']);


	//nek null
	if ((empty($e_kode)) OR (empty($e_nama)))
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
			//INSERT
			mysqli_query($koneksi, "INSERT INTO m_sekolah(kd, kode, nama, ".
							"usernamex, passwordx, postdate) VALUES ".
							"('$kd', '$e_kode', '$e_nama', ".
							"'$aksesnya', '$passx', '$today')");


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
			
		//jika update
		if ($s == "edit")
			{
			//update
			mysqli_query($koneksi, "UPDATE m_sekolah SET kode = '$e_kode', ".
							"nama = '$e_nama', ".
							"usernamex = '$aksesnya', ".
							"passwordx = '$passx' ".
							"WHERE kd = '$kd'");


			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}






//jika hapus sekolah
if ($s == "hapus")
	{
	//hapus
	mysqli_query($koneksi, "DELETE FROM m_sekolah ".
								"WHERE kd = '$kd'");
								
					
	//re-direct
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
//jika edit / baru
if (($s == "baru") OR ($s == "edit"))
	{
	$kdx = nosql($_REQUEST['kd']);

	//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$kdx'");
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
	
	<a href="'.$filenya.'" class="btn btn-danger"><< DAFTAR SEKOLAH</a>
	<hr>
	
	<div class="row">
	
		<div class="col-md-4">
			
		<p>
		Kode/Username : 
		<br>
		<input name="e_kode" id="e_kode" type="text" size="30" class="btn-warning" value="'.$e_kode.'" required>
		</p>
		</div>
		
		<div class="col-md-4">
		
		<p>
		Nama Sekolah : 
		<br>
		<input name="e_nama" id="e_nama" type="text" size="30" class="btn-warning" value="'.$e_nama.'" required>
		</p>
	
		</div>

	
	</div>

	<div class="row">
	
		<div class="col-md-12">
		
			<input name="s" type="hidden" value="'.$s.'">
			<input name="kdx" type="hidden" value="'.$kdx.'">
			<input name="btnSMP" type="submit" class="btn btn-block btn-danger" value="SIMPAN">
		</div>
	</div>
	

	</form>	
	
	<hr>
	
	<b>UPDATE TERAKHIR</b> : <font color="red">'.$e_postdate_update.'</font>
	
	<hr>
	
	
	
	<div class="row">
	
		<div class="col-md-4">
	
		<p>
		NSS : 
		<br>
		<input name="e_kode_nss6" id="e_kode_nss6" type="text" size="20" class="btn-info" value="'.$e_kode_nss.'" readonly>
		</p>
	
		<p>
		NDS : 
		<br>
		<input name="e_kode_nds6" id="e_kode_nds6" type="text" size="20" class="btn-info" value="'.$e_kode_nds.'" readonly>
		</p>
		<br>
	
		</div>
		
		<div class="col-md-4">
		
	
		<p>
		Alamat : 
		<br>
		<input name="e_alamat6" id="e_alamat6" type="text" size="30" class="btn-info" value="'.$e_alamat.'" readonly>
		</p>
		<br>
	
		</div>
		
		<div class="col-md-4">
		
		<p>
		Telepon/HP/WA : 
		<br>
		<input name="e_telp6" id="e_telp6" type="text" size="20" class="btn-info" value="'.$e_telp.'" readonly>
		</p>
		
		
		
		<p>
		E-Mail : 
		<br> 
		<input name="e_email6" id="e_email6" type="text" size="30" class="btn-info" value="'.$e_email.'" readonly>
		</p>
	
		</div>
	
	
	
	</div>
	
	
	
	
	
	<hr>
	
	<div class="row">
				
				<div class="col-md-4">
			
				
					<p>
					Tahun Berdiri : 
					<br>
					<input name="e_thn_berdiri6" id="e_thn_berdiri6" type="text" size="5" class="btn-info" value="'.$e_thn_berdiri.'" readonly>
					</p>
					<br>
	
					<p>
					Status / Peringkat Sekolah Swasta : 
					<br>
					<input name="e_status6" id="e_status6" type="text" class="btn-block btn-info" value="'.$e_status.'" readonly>
					</p>
					<br>
					
					
									
					<p>
					No.SK Status Jenjang Akreditasi : 
					<br>
					<input name="e_noskstatus6" id="e_noskstatus6" type="text" class="btn-block btn-info" value="'.$e_sk_status_nomor.'" readonly>
					<br>
					
					Tanggal SK Status : 
					<br>
					<input name="e_noskstatustgl6" id="e_noskstatustgl6" type="date" class="btn-block btn-info" value="'.$e_sk_status_tgl.'" readonly>
					
					</p>
					<br>
					
													
				</div>
				
				<div class="col-md-4">
					
					<p>
					Penyelenggara Sekolah : 
					<br>
					<input name="e_seleng6" id="e_seleng6" type="text" class="btn-block btn-info" value="'.$e_penyelenggara.'" readonly>
					</p>
					<br>
					
					<p>
					No. SK Pendirian : 
					<br>
					<input name="e_noskdiri6" id="e_noskdiri6" type="text" class="btn-block btn-info" value="'.$e_sk_pendirian_nomor.'" readonly>
					<br>
					
					Tanggal SK Pendirian: 
					<br>
					<input name="e_nosktgl6" id="e_nosktgl6" type="date" class="btn-block btn-info" value="'.$e_sk_pendirian_tgl.'" readonly>
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
																"WHERE sekolah_kd = '$kdx' ".
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
							<input name="e_nil2'.$k.'" id="e_nil2'.$k.'" type="text" class="btn-block btn-info" value="'.$yuk_jml_l.'" readonly>
							</td>
							<td>
							<input name="e_nil3'.$k.'" id="e_nil3'.$k.'" type="text" class="btn-block btn-info" value="'.$yuk_jml_p.'" readonly>
							</td>
							<td>
							<input name="e_nil4'.$k.'" id="e_nil4'.$k.'" type="text" class="btn-block btn-info" value="'.$yuk_total.'" readonly>
							</td>
							<td>
							<input name="e_nil5'.$k.'" id="e_nil5'.$k.'" type="text" class="btn-block btn-info" value="'.$yuk_jml_kelas.'" readonly>
							</td>
							<td>
							<input name="e_nil6'.$k.'" id="e_nil6'.$k.'" type="text" class="btn-block btn-info" value="'.$yuk_spp_bulanan.'" readonly>
							</td>
					    	</tr>';
							}
	
	
				
						//nilainya
						$qyuk3 = mysqli_query($koneksi, "SELECT SUM(jml_l) AS total_jml_l, ".
															"SUM(jml_p) AS total_jml_p, ".
															"SUM(jml_kelas) AS total_jml_kelas ".
															"FROM sekolah_jml_siswa ".
															"WHERE sekolah_kd = '$kdx'");
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
																"WHERE sekolah_kd = '$kdx' ".
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
							<input name="g_nil2'.$yuk_nourut.'" id="g_nil2'.$yuk_nourut.'" type="text" class="btn-block btn-info" value="'.$yuk4_jml_l.'" readonly>
							</td>
							<td>
							<input name="g_nil3'.$yuk_nourut.'" id="g_nil3'.$yuk_nourut.'" type="text" class="btn-block btn-info" value="'.$yuk4_jml_p.'" readonly>
							</td>
							<td>
							<input name="g_nil4'.$yuk_nourut.'" id="g_nil4'.$yuk_nourut.'" type="text" class="btn-block btn-info" value="'.$yuk4_total.'" readonly>
							</td>
							<td>
							<input name="g_nil5'.$yuk_nourut.'" id="g_nil5'.$yuk_nourut.'" type="text" class="btn-block btn-info" value="'.$yuk4_ket.'" readonly>
							</td>
					    	</tr>';
							}
						while ($ryuk = mysqli_fetch_assoc($qyuk));
	
	
	
	
						//nilainya
						$qyuk31 = mysqli_query($koneksi, "SELECT SUM(jml_l) AS total_jml_l, ".
															"SUM(jml_p) AS total_jml_p ".
															"FROM sekolah_jml_karyawan ".
															"WHERE sekolah_kd = '$kdx'");
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
					<input name="e_ks_nama6" id="e_ks_nama6" type="text" class="btn-info" value="'.$e_ks_nama.'" readonly>
					</p>
					<br>
	
					<p>
					Ijazah Terakhir : 
					<br>
					<input name="e_ks_ijazah6" id="e_ks_ijazah6" type="text" class="btn-info" value="'.$e_ks_ijazah.'" readonly>
					</p>
					<br>
					
					<p>
					NBM/NKTAM/NIP : 
					<br>
					<input name="e_ks_nbsm6" id="e_ks_nbm6" type="text" class="btn-info" value="'.$e_ks_kode.'" readonly>
					</p>
					<br>
					
	
					
				</div>
	
				
				<div class="col-md-3">
	
					<p>
					PRASARANA : 
					<br>
					a. Luas Tanah : 
					<br>
					<input name="e_tanah_luas6" id="e_tanah_luas6" type="text" class="btn-info" value="'.$e_sarpras_luas_tanah.'" size="5" readonly> M2
					</p>
					<br>
					
					<p>
					Status Tanah : 
					<br>
					<input name="e_tanah_status6" id="e_tanah_status6" type="text" class="btn-info" value="'.$e_sarpras_status.'" readonly>
					
					</p>
					<br>
					
				</div>
	
				
				<div class="col-md-3">
					<br>
		
	
					<p>
					b. Luas Bangunan : 
					<br>
					<input name="e_bang_luas6" id="e_bang_luas6" type="text" class="btn-info" value="'.$e_sarpras_luas_bangunan.'" size="10" readonly> M2
					</p>
					<br>
					
					<p>
					c. Luas Masjid/Musholla : 
					<br>
					<input name="e_masjid6" id="e_masjid6" type="text" class="btn-info" value="'.$e_sarpras_masjid.'" size="10" readonly> M2
					
					</p>
					<br>
	
					
				</div>
							
		</div>
	
	
	
	
		<div class="row">
			<div class="col-md-12">
			
				<hr>
	
				<input name="kdx" type="hidden" value="'.$kdx.'">
				
				
				<a href="'.$filenya.'?s=hapus&kd='.$kd.'" class="btn btn-block btn-danger">HAPUS SEKOLAH INI >></a>
			</div>
		</div>';

	}
	




















else
	{
	$warnatext = "white";
	
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM m_sekolah ".
						"ORDER BY nama ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM m_sekolah ".
						"WHERE kode LIKE '%$kunci%' ".
						"OR kode_nss LIKE '%$kunci%' ".
						"OR kode_nds LIKE '%$kunci%' ".
						"OR nama LIKE '%$kunci%' ".
						"OR alamat LIKE '%$kunci%' ".
						"OR telp LIKE '%$kunci%' ".
						"OR email LIKE '%$kunci%' ".
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
	
	
	
	echo '<form action="'.$filenya.'" method="post" name="formx">
	<p>
	<a href="'.$filenya.'?s=baru&kd='.$x.'" class="btn btn-danger">ENTRI BARU >></a>
	</p>
	
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
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td><strong><font color="'.$warnatext.'">KODE/USERNAME</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NSS</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NDS</font></strong></td>
	<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
	<td><strong><font color="'.$warnatext.'">TELP</font></strong></td>
	<td><strong><font color="'.$warnatext.'">EMAIL</font></strong></td>
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
			$i_kode_nss = balikin($data['kode_nss']);
			$i_kode_nds = balikin($data['kode_nds']);
			$i_nama = balikin($data['nama']);
			$i_alamat = balikin($data['alamat']);
			$i_telp = balikin($data['telp']);
			$i_email = balikin($data['email']);
			$i_postdate = balikin($data['postdate']);

			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<a href="'.$filenya.'?s=edit&page='.$page.'&kd='.$i_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_nama.'</td>
			<td>
			'.$i_kode.'
			</td>
			<td>'.$i_kode_nss.'</td>
			<td>'.$i_kode_nds.'</td>
			<td>'.$i_alamat.'</td>
			<td>'.$i_telp.'</td>
			<td>'.$i_email.'</td>
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
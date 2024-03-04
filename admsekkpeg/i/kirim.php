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
require("../../inc/cek/admsekkepeg.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admsekkepeg.html");

nocache();

//nilai
$filenya = "kirim.php";
$judul = "Kirim Pesan";
$judulku = "[INBOX PESAN] $judul";
$juduli = $judul;
$katkd = cegah($_REQUEST['katkd']);
$kankd = cegah($_REQUEST['kankd']);
$cabkd = cegah($_REQUEST['cabkd']);
$cabnama = cegah($_REQUEST['cabnama']);
$sekkd = cegah($_REQUEST['sekkd']);
$seknama = cegah($_REQUEST['seknama']);
$pegkd = cegah($_REQUEST['pegkd']);
$pegkode = cegah($_REQUEST['pegkode']);
$pegnama = cegah($_REQUEST['pegnama']);








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if($_POST['btnSMP'])
	{
	$e_judul = cegah($_POST['e_judul']);
	$e_isi = cegah2($_POST['editor']);
	$katkd = cegah($_POST['katkd']);
	$kankd = cegah($_POST['kankd']);
	$cabkd = cegah($_POST['cabkd']);
	$cabnama = cegah($_POST['cabnama']);
	$sekkd = cegah($_POST['sekkd']);
	$seknama = cegah($_POST['seknama']);
	$pegkd = cegah($_POST['pegkd']);
	$pegkode = cegah($_POST['pegkode']);
	$pegnama = cegah($_POST['pegnama']);





	//detail pengirim
	$ukat = "SEKOLAH";
	$ucab = $cabang85_session;
	$ucabkd = $cabang85_session;
	$usek = $xseknama85_session;
	$usekkd = $sekkd85_session;
	$ukd = $kd85_session;
	$ukode = $nip85_session;
	$unama = $nm85_session;
	$upos = "KEPEGAWAIAN";
	



	

	
	//nek null
	if ((empty($e_judul)) OR (empty($e_isi)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//query
		mysqli_query($koneksi, "INSERT INTO user_msg (kd, user_kategori, user_cabang, user_cabang_kd, ".
						"user_sekolah, user_sekolah_kd, ".
						"user_kd, user_kode, user_nama, user_posisi, ".
						"uuser_kategori, uuser_cabang, uuser_cabang_kd, ".
						"uuser_sekolah, uuser_sekolah_kd, ".
						"uuser_kd, uuser_kode, uuser_nama, uuser_posisi, ".
						"judul, isi, postdate) ".
						"VALUES ('$x', '$ukat', '$ucab', '$ucabkd', ".
						"'$usek', '$usekkd', ".
						"'$ukd', '$ukode', '$unama', '$upos', ".
						"'$katkd', '$cabnama', '$cabkd', ".
						"'$seknama', '$sekkd', ".
						"'$pegkd', '$pegkode', '$pegnama', '$kankd', ".
						"'$e_judul', '$e_isi', '$today');"); 



		/*	
		//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
		//detail
		$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"WHERE kd = '$kd85_session'");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kd = cegah($rku['kd']);
		$ku_kode = cegah($rku['kode']);
		$ku_nama = cegah($rku['nama']);
	
		$ku_ket = cegah("[MENU : $judul]. ENTRI : $e_judul");			
		
		
		//insert
		mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
						"user_kd, user_kode, user_nama, ".
						"user_posisi, user_jabatan, ket, postdate) VALUES ".
						"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
						"'$ku_kd', '$ku_kode', '$ku_nama', ".
						"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
		//kasi log login ///////////////////////////////////////////////////////////////////////////////////
		*/
	





		//re-direct
		$pesan = "Pesan Berhasil Terkirim.";
		$ke = "terkirim.php";
		pekem($pesan,$ke);
		exit();
		}


	exit();
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//ketahui jumlah inbox
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE uuser_sekolah_kd = '$sekkd85_session' ".
									"AND uuser_kd = 'KEPEGAWAIAN'");
$jml_inbox = mysqli_num_rows($qyuk);






//ketahui jumlah terkirim
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE user_kd = '$kd85_session' ".
									"AND user_sekolah_kd = '$sekkd85_session' ".
									"AND user_posisi = 'KEPEGAWAIAN'");
$jml_terkirim = mysqli_num_rows($qyuk);


?>

					
<script type="text/javascript" src="<?php echo $sumber;?>/inc/class/ckeditor/ckeditor.js"></script>
					
					


<div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folder</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="inbox.php" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right"><?php echo $jml_inbox;?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="terkirim.php" class="nav-link">
                    <i class="far fa-envelope"></i> Terkirim
                    <span class="badge bg-success float-right"><?php echo $jml_terkirim;?></span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">KIRIM PESAN</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body p-3">
					
					<?php
					echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx3">
					<table width="100%" border="0" cellspacing="0" cellpadding="3">
					<tr>
					<td>
					Kepada : 
					<br>';
					echo "<select name=\"e_kepada\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
					echo '<option value="'.$katkd.'" selected>--'.$katkd.'--</option>
					<option value="'.$filenya.'?katkd=MAJELIS">MAJELIS</option>
					<option value="'.$filenya.'?katkd=CABANG">CABANG</option>
					<option value="'.$filenya.'?katkd=SEKOLAH">SEKOLAH</option>
					</select>, ';
					
					
					
					//jika majelis
					if ($katkd == "MAJELIS")
						{
						echo "<select name=\"e_kantor\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
						echo '<option value="'.$pegkd.'" selected>'.$pegnama.' ['.$pegkode.']</option>
						<option value="'.$filenya.'?katkd='.$katkd.'&kankd=TATA USAHA&cabkd='.$cabkd.'&cabnama='.$cabnama.'&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=TATA USAHA&pegkode=TATA USAHA&pegnama=TATA USAHA">TATA USAHA</option>';
						
						
						//list pegawai
						$qku = mysqli_query($koneksi, "SELECT * FROM majelis_pegawai ".
														"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_kd = balikin($rku['kd']);
							$ku_nama = balikin($rku['nama']);
							$ku_nama2 = cegah($rku['nama']);
							$ku_kode = balikin($rku['kode']);
							$ku_kode2 = cegah($rku['kode']);
							
							
							echo '<option value="'.$filenya.'?katkd='.$katkd.'&kankd=PEGAWAI&cabkd='.$cabkd.'&cabnama='.$cabnama.'&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd='.$ku_kd.'&pegkode='.$ku_kode2.'&pegnama='.$ku_nama2.'">'.$ku_nama.' ['.$ku_kode.']</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));


						echo '</select>';
						}
					
					



					
					//jika cabang
					else if ($katkd == "CABANG")
						{
						//list cabang
						echo "<select name=\"e_kantor\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
						echo '<option value="'.$cabkd.'" selected>'.$cabnama.'</option>';
						
						//list cabang
						$qku = mysqli_query($koneksi, "SELECT * FROM m_cabang ".
														"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_kd = balikin($rku['kd']);
							$ku_nama = balikin($rku['nama']);
							$ku_nama2 = cegah($rku['nama']);
							$ku_kode = balikin($rku['kode']);
							$ku_kode2 = cegah($rku['kode']);
							
							
							echo '<option value="'.$filenya.'?katkd='.$katkd.'&kankd=&cabkd='.$ku_kd.'&cabnama='.$ku_nama2.'&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=&pegkode=&pegnama=">'.$ku_nama.'</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));


						echo '</select>';
						
						
						
						
						echo "<select name=\"e_peg\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
						echo '<option value="'.$pegkd.'" selected>'.$pegnama.' ['.$pegkode.']</option>
						<option value="'.$filenya.'?katkd='.$katkd.'&kankd=TATA USAHA&cabkd='.$cabkd.'&cabnama='.$cabnama.'&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=TATA USAHA&pegkode=TATA USAHA&pegnama=TATA USAHA">TATA USAHA</option>';
						
						
						//list pegawai
						$qku = mysqli_query($koneksi, "SELECT * FROM cabang_pegawai ".
														"WHERE cabang_nama = '$cabnama' ".
														"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_kd = balikin($rku['kd']);
							$ku_nama = balikin($rku['nama']);
							$ku_nama2 = cegah($rku['nama']);
							$ku_kode = balikin($rku['kode']);
							$ku_kode2 = cegah($rku['kode']);
							
							
							echo '<option value="'.$filenya.'?katkd='.$katkd.'&kankd=PEGAWAI&cabkd='.$cabkd.'&cabnama='.$cabnama.'&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd='.$ku_kd.'&pegkode='.$ku_kode2.'&pegnama='.$ku_nama2.'">'.$ku_nama.' ['.$ku_kode.']</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));


						echo '</select>';
						}
					






					
					//jika sekolah
					else if ($katkd == "SEKOLAH")
						{
						//list cabang
						echo "<select name=\"e_kantor\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
						echo '<option value="'.$sekkd.'" selected>'.$seknama.'</option>';
						
						//list sekolah
						$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
														"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_kd = balikin($rku['kd']);
							$ku_nama = balikin($rku['nama']);
							$ku_nama2 = cegah($rku['nama']);
							$ku_kode = balikin($rku['kode']);
							$ku_kode2 = cegah($rku['kode']);
							
							
							echo '<option value="'.$filenya.'?katkd='.$katkd.'&kankd=&cabkd=&cabnama=&sekkd='.$ku_kd.'&seknama='.$ku_nama.'&pegkd=&pegkode=&pegnama=">'.$ku_nama.'</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));


						echo '</select>';
						
						
						
						
						echo "<select name=\"e_peg\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";
						echo '<option value="'.$pegkd.'" selected>'.$pegnama.' ['.$pegkode.']</option>
						<option value="'.$filenya.'?katkd='.$katkd.'&kankd=TATA USAHA&cabkd=&cabnama=&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=TATA USAHA&pegkode=TATA USAHA&pegnama=TATA USAHA">TATA USAHA</option>
						<option value="'.$filenya.'?katkd='.$katkd.'&kankd=KEPEGAWAIAN&cabkd=&cabnama=&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=KEPEGAWAIAN&pegkode=KEPEGAWAIAN&pegnama=KEPEGAWAIAN">KEPEGAWAIAN</option>
						<option value="'.$filenya.'?katkd='.$katkd.'&kankd=SARPRAS&cabkd=&cabnama=&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=SARPRAS&pegkode=SARPRAS&pegnama=SARPRAS">SARPRAS</option>
						<option value="'.$filenya.'?katkd='.$katkd.'&kankd=KEUANGAN&cabkd=&cabnama=&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd=KEUANGAN&pegkode=KEUANGAN&pegnama=KEUANGAN">KEUANGAN</option>';
						
						
						//list pegawai
						$qku = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
														"WHERE sekolah_kd = '$sekkd' ".
														"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_kd = balikin($rku['kd']);
							$ku_nama = balikin($rku['nama']);
							$ku_nama2 = cegah($rku['nama']);
							$ku_kode = balikin($rku['kode']);
							$ku_kode2 = cegah($rku['kode']);
							
							
							echo '<option value="'.$filenya.'?katkd='.$katkd.'&kankd=PEGAWAI&cabkd=&cabnama=&sekkd='.$sekkd.'&seknama='.$seknama.'&pegkd='.$ku_kd.'&pegkode='.$ku_kode2.'&pegnama='.$ku_nama2.'">'.$ku_nama.' ['.$ku_kode.']</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));


						echo '</select>';
						}
					



					
					
					
					echo '<input name="katkd" type="hidden" value="'.$katkd.'">
					<input name="kankd" type="hidden" value="'.$kankd.'">
					<input name="cabkd" type="hidden" value="'.$cabkd.'">
					<input name="cabnama" type="hidden" value="'.$cabnama.'">
					<input name="sekkd" type="hidden" value="'.$sekkd.'">
					<input name="seknama" type="hidden" value="'.$seknama.'">
					<input name="pegkd" type="hidden" value="'.$pegkd.'">
					<input name="pegkode" type="hidden" value="'.$pegkode.'">
					<input name="pegnama" type="hidden" value="'.$pegnama.'">
					</td>
					</tr>
					</table>
					<hr>';
					
					//jika null
					if ((empty($katkd)) OR (empty($kankd)) OR (empty($pegkd)))
						{
						echo '<font color="red">
						<h3>
						Silahkan Tentukan Kirim Pesan Kepada Siapa..?
						</h3>
						</font>';
						}
						
					else
						{
						echo '<p>
						Subjek/Judul : 
						<br>
						<input name="e_judul" id="e_judul" type="text" value="'.$e_judul.'" size="100%" class="btn btn-warning" required>
						</p>
						
						<p>
						Isi Pesan : 
						<br>
						<textarea id="editor" name="editor" rows="20" cols="80" style="width: 100%" class="btn btn-block btn-warning" required>'.$e_isi2.'</textarea>
						</p>
						<br>
						
					
						<p>
						<button name="btnSMP" id="btnSMP" type="submit" value="KIRIM PESAN >>" class="btn btn-block btn-danger">KIRIM PESAN >></button>
						</p>';
						
						}
					

					
					echo '</form>
					
					<hr>';
									

				
				?>
				<script type="text/javascript">
				//<![CDATA[
				var roxyFileman = '<?php echo $sumber;?>/inc/class/ckeditor/plugins/fileman/index.html';
				 
				$(function(){
			    CKEDITOR.replace( 'editor',{filebrowserBrowseUrl:roxyFileman,
			                         filebrowserImageBrowseUrl:roxyFileman+'?type=image',
			                         removeDialogTabs: 'link:upload;image:upload'}); 
				});
			
			
				//]]>
				</script>



            </div>

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>
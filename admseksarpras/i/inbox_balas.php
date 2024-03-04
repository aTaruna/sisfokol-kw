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
require("../../inc/cek/admseksarpras.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admseksarpras.html");

nocache();

//nilai
$filenya = "inbox_balas.php";
$judul = "Balas Pesan";
$judulku = "[INBOX PESAN] $judul";
$juduli = $judul;
$ikd = cegah($_REQUEST['ikd']);
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
	$ucab = $cabang83_session;
	$ucabkd = $cabang83_session;
	$usek = $xseknama83_session;
	$usekkd = $sekkd83_session;
	$ukd = $kd83_session;
	$ukode = $nip83_session;
	$unama = $nm83_session;
	$upos = "SARPRAS";
	

	$e_judul2 = "BALAS : $e_judul";

	

	
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
						"'$e_judul2', '$e_isi', '$today');"); 



		/*	
		//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
		//detail
		$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
								"WHERE kd = '$kd83_session'");
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
		$pesan = "Balas Pesan Berhasil Terkirim.";
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
									"WHERE uuser_sekolah_kd = '$sekkd83_session' ".
									"AND uuser_kd = 'SARPRAS'");
$jml_inbox = mysqli_num_rows($qyuk);



//ketahui jumlah terkirim
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE user_kd = '$kd83_session' ".
									"AND user_sekolah_kd = '$sekkd83_session' ".
									"AND user_posisi = 'SARPRAS'");
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
              <h3 class="card-title">BALAS PESAN</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body p-3">
					
					<?php
					echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx3">
					
					
					<input name="katkd" type="hidden" value="'.$katkd.'">
					<input name="kankd" type="hidden" value="'.$kankd.'">
					<input name="cabkd" type="hidden" value="'.$cabkd.'">
					<input name="cabnama" type="hidden" value="'.$cabnama.'">
					<input name="sekkd" type="hidden" value="'.$sekkd.'">
					<input name="seknama" type="hidden" value="'.$seknama.'">
					<input name="pegkd" type="hidden" value="'.$pegkd.'">
					<input name="pegkode" type="hidden" value="'.$pegkode.'">
					<input name="pegnama" type="hidden" value="'.$pegnama.'">';
					
					//query
					$p = new Pager();
					$start = $p->findStart($limit);
				
					$sqlcount = "SELECT * FROM user_msg ".
									"WHERE kd = '$ikd'";
					$sqlresult = $sqlcount;
				
					$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
					$pages = $p->findPages($count, $limit);
					$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
					$pagelist = $p->pageList($_GET['page'], $pages, $target);
					$data = mysqli_fetch_array($result);
							
					//nilai
					$i_kd = nosql($data['kd']);
					$i_dari_nama = balikin($data['user_nama']);
					$i_dari_kat = balikin($data['user_kategori']);
					$i_dari_posisi = balikin($data['user_posisi']);
					$i_judul = balikin($data['judul']);
					$i_isi = balikin($data['isi']);
					$i_postdate = balikin($data['postdate']);
			
						
						
						//jika sekolah
						if ($i_dari_kat == "SEKOLAH")
							{
							$i_kannama = balikin($data['user_sekolah']);
							$i_kannama2 = balikin($data['user_nama']);
							$i_kannama3 = balikin($data['user_posisi']);
							}
	
						//jika cabang
						else if ($i_dari_kat == "CABANG")
							{
							$i_kannama = balikin($data['user_cabang']);
							$i_kannama2 = balikin($data['user_nama']);
							$i_kannama3 = balikin($data['user_posisi']);
							}
	
	
	
						//jika majelis
						else if ($i_dari_kat == "MAJELIS")
							{
							$i_kannama = balikin($data['user_nama']);
							$i_kannama2 = balikin($data['user_nama']);
							$i_kannama3 = balikin($data['user_posisi']);
							}
	
			
						
				
					echo '<p>
					<h3>'.$i_judul.'</h3>
					</p>
					
					<p>
					<b>Dari :</b>
					<br>
					'.$i_kannama.'. '.$i_kannama2.'. '.$i_kannama3.'
					</p>
					
					<p>
					<b>Dikirim pada :</b>
					<br>
					'.$i_postdate.'
					</p>
					
					<p>
					<b>Isi Pesan :</b>
					<br>
					'.$i_isi.'
					</p>
					
					<hr>
					<p>
					<a href="inbox_baca.php?ikd='.$ikd.'" class="btn btn-block btn-info"><< BATAL BALAS</a>
					</p>
					
					<hr>
					
					
					<p>
					Subjek/Judul : 
					<br>
					<b>BALAS : '.$i_judul.'
					</p>
					
					<p>
					Isi Pesan : 
					<br>
					<textarea id="editor" name="editor" rows="20" cols="80" style="width: 100%" class="btn btn-block btn-warning" required>'.$e_isi2.'</textarea>
					</p>
					<br>
				
					
					<p>
					
					<input name="e_judul" type="hidden" value="BALAS : '.$i_judul.'">
					<button name="btnSMP" id="btnSMP" type="submit" value="KIRIM PESAN >>" class="btn btn-block btn-danger">KIRIM PESAN >></button>
					</p>';
					
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
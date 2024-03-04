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
require("../../inc/cek/admsekkeu.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admsekkeu.html");

nocache();

//nilai
$filenya = "inbox_baca.php";
$judul = "Baca Pesan";
$judulku = "[INBOX PESAN] $judul";
$juduli = $judul;

$ikd = cegah($_REQUEST['ikd']);









//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();




//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//ketahui jumlah inbox
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE uuser_sekolah_kd = '$sekkd84_session' ".
									"AND uuser_kd = 'KEUANGAN'");
$jml_inbox = mysqli_num_rows($qyuk);


//ketahui jumlah terkirim
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE user_kd = '$kd84_session' ".
									"AND user_sekolah_kd = '$sekkd84_session' ".
									"AND user_posisi = 'KEUANGAN'");
$jml_terkirim = mysqli_num_rows($qyuk);



?>



<div class="row">
        <div class="col-md-3">
          <a href="inbox.php" class="btn btn-primary btn-block mb-3">KEMBALI KE INBOX</a>

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
        	


		<?php
		echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">';

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
		$i_dibaca = balikin($data['dibaca']);


		//update dibaca
		if ($i_dibaca == "false")
			{
			//update
			mysqli_query($koneksi, "UPDATE user_msg SET dibaca = 'true', ".
										"dibaca_postdate = '$today' ".
										"WHERE kd = '$ikd'");
			}
		



		
		$j_kat = cegah($data['user_kategori']);
		$j_cab = cegah($data['user_cabang']);
		$j_cabkd = cegah($data['user_cabang_kd']);
		$j_sek = cegah($data['user_sekolah']);
		$j_sekkd = cegah($data['user_sekolah_kd']);
		
		$j_kd = cegah($data['user_kd']);
		$j_kode = cegah($data['user_kode']);
		$j_nama = cegah($data['user_nama']);
		$j_posisi = cegah($data['user_posisi']);
		
		
		
		
							
		//jika sekolah
		if ($j_kat == "SEKOLAH")
			{
			$i_kannama = balikin($data['user_sekolah']);
			$i_kannama2 = balikin($data['user_nama']);
			$i_kannama3 = balikin($data['user_posisi']);
			}

		//jika cabang
		else if ($j_kat == "CABANG")
			{
			$i_kannama = balikin($data['user_cabang']);
			$i_kannama2 = balikin($data['user_nama']);
			$i_kannama3 = balikin($data['user_posisi']);
			}



		//jika majelis
		else if ($j_kat == "MAJELIS")
			{
			$i_kannama = balikin($data['user_nama']);
			$i_kannama2 = balikin($data['user_nama']);
			$i_kannama3 = balikin($data['user_posisi']);
			}
		
		?>
				
			
        	
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><b><?php echo $i_judul;?></b></h3>
              <br>
              <p class="card-title">Dari : 
              	<br>
              	<?php echo "$j_kat : $i_kannama. $i_kannama3. $i_kannama2";?>
              	</p>

              <div class="card-tools">
              	
					<p>
						<?php echo $i_postdate;?>
					</p>
              	
              	
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

	
				<?php
				echo '<p>
				'.$i_isi.'
				</p>

				<hr>
				
				
				<p>
					<a href="inbox_balas.php?ikd='.$ikd.'&katkd='.$j_kat.'&kankd='.$j_posisi.'&cabkd='.$j_cab.'&cabnama='.$j_cabkd.'&sekkd='.$j_sekkd.'&seknama='.$j_sek.'&pegkd='.$j_kd.'&pegkode='.$j_kode.'&pegnama='.$j_nama.'" class="btn btn-block btn-danger">BALAS PESAN >></a>
				</p>';
				?>

            </div>

          </div>
          <!-- /.card -->
          
          
          <?php
          echo '</form>';
					
		?>
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
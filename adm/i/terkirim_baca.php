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
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/adm.html");

nocache();

//nilai
$filenya = "terkirim_baca.php";
$judul = "Baca Terkirim";
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
									"WHERE uuser_sekolah_kd = '$kd071_session' ".
									"AND uuser_kd = 'TATA USAHA'");
$jml_inbox = mysqli_num_rows($qyuk);




//ketahui jumlah terkirim
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_msg ".
									"WHERE user_kd = '$kd071_session'");
$jml_terkirim = mysqli_num_rows($qyuk);


?>



<div class="row">
        <div class="col-md-3">
          <a href="terkirim.php" class="btn btn-primary btn-block mb-3">KEMBALI KE TERKIRIM</a>

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
		$i_dari_ket = balikin($data['user_ket']);
		$i_judul = balikin($data['judul']);
		$i_isi = balikin($data['isi']);
		$i_postdate = balikin($data['postdate']);

		
		$j_kat = cegah($data['uuser_kategori']);
		$j_cab = cegah($data['uuser_cabang']);
		$j_cabkd = cegah($data['uuser_cabang_kd']);
		$j_sek = cegah($data['uuser_sekolah']);
		$j_sekkd = cegah($data['uuser_sekolah_kd']);
		$j_kd = cegah($data['uuser_kd']);
		$j_kode = cegah($data['uuser_kode']);
		$j_nama = cegah($data['uuser_nama']);
		$j_posisi = cegah($data['uuser_posisi']);
		
		
								
			//jika sekolah
			if ($j_kat == "SEKOLAH")
				{
				$i_kannama = balikin($data['uuser_sekolah']);
				$i_kannama2 = balikin($data['uuser_nama']);
				$i_kannama3 = balikin($data['uuser_posisi']);
				}

			//jika cabang
			else if ($j_kat == "CABANG")
				{
				$i_kannama = balikin($data['uuser_cabang']);
				$i_kannama2 = balikin($data['uuser_nama']);
				$i_kannama3 = balikin($data['uuser_posisi']);
				}



			//jika majelis
			else if ($j_kat == "MAJELIS")
				{
				$i_kannama = balikin($data['uuser_nama']);
				$i_kannama2 = balikin($data['uuser_nama']);
				$i_kannama3 = balikin($data['uuser_posisi']);
				}


		?>
				
			
        	
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><b><?php echo $i_judul;?></b></h3>
              <br>
              <p class="card-title">Kepada :
              	<br> 
              	<?php echo "$j_kat : $i_kannama. $i_kannama2. $i_kannama3";?>
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
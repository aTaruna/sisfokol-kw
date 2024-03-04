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
$filenya = "terkirim.php";
$judul = "Terkirim Pesan";
$judulku = "[INBOX PESAN] $judul";
$juduli = $judul;

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



<div class="row">
        <div class="col-md-3">
          <a href="kirim.php" class="btn btn-primary btn-block mb-3">KIRIM PESAN</a>

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
		?>
				
			
        	
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">TERKIRIM PESAN</h3>

              <div class="card-tools">
              	
					<p>
					<input name="kunci" type="text" value="<?php echo $kunci2;?>" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
					<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
					<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
					</p>
              	
              	
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">

				<?php
				//query
				$p = new Pager();
				$start = $p->findStart($limit);
			
				//jika null
				if (empty($kunci))
					{
					$sqlcount = "SELECT * FROM user_msg ".
									"WHERE user_kd = '$kd83_session' ".
									"AND user_posisi = 'SARPRAS' ".
									"ORDER BY postdate DESC";
					}
					
				else
					{
					$sqlcount = "SELECT * FROM user_msg ".
									"WHERE user_kd = '$kd83_session' ".
									"AND user_posisi = 'SARPRAS' ".
									"AND (uuser_nama LIKE '%$kunci%' ".
									"OR uuser_kategori LIKE '%$kunci%' ".
									"OR uuser_sekolah LIKE '%$kunci%' ".
									"OR uuser_cabang LIKE '%$kunci%' ".
									"OR uuser_posisi LIKE '%$kunci%' ".
									"OR judul LIKE '%$kunci%' ".
									"OR isi LIKE '%$kunci%') ".
									"ORDER BY postdate DESC";
					}

					
				$sqlresult = $sqlcount;
			
				$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
				$pages = $p->findPages($count, $limit);
				$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
				$pagelist = $p->pageList($_GET['page'], $pages, $target);
				$data = mysqli_fetch_array($result);
						

				//jika ada				
				if (!empty($count))
					{
					echo '<div class="table-responsive">          
				    <table class="table" border="1">
				    <thead>
					<tr bgcolor="'.$warnaheader.'">
					<td width="200"><strong><font color="'.$warnatext.'">KEPADA</font></strong></td>
					<td><strong><font color="'.$warnatext.'">SUBJEK</font></strong></td>
					<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
					</tr>
				    </thead>
				    <tbody>';
			
			
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
						$nomer = $nomer + 1;
						$i_kd = nosql($data['kd']);
						$i_ke_nama = balikin($data['uuser_nama']);
						$i_ke_kat = balikin($data['uuser_kategori']);
						$i_ke_posisi = balikin($data['uuser_posisi']);
						$i_judul = balikin($data['judul']);
						$i_postdate = balikin($data['postdate']);
	
	
						//jika sekolah
						if ($i_ke_kat == "SEKOLAH")
							{
							$i_kannama = balikin($data['uuser_sekolah']);
							$i_kannama2 = balikin($data['uuser_nama']);
							$i_kannama3 = balikin($data['uuser_posisi']);
							}
	
						//jika cabang
						else if ($i_ke_kat == "CABANG")
							{
							$i_kannama = balikin($data['uuser_cabang']);
							$i_kannama2 = balikin($data['uuser_nama']);
							$i_kannama3 = balikin($data['uuser_posisi']);
							}
	
	
	
						//jika majelis
						else if ($i_ke_kat == "MAJELIS")
							{
							$i_kannama = balikin($data['uuser_nama']);
							$i_kannama2 = balikin($data['uuser_nama']);
							$i_kannama3 = balikin($data['uuser_posisi']);
							}
	
			
			
						echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
						echo '<td>
						'.$i_ke_kat.'.
						<br>
						'.$i_kannama.'.
						<br>
						'.$i_kannama3.'.
						<br>
						'.$i_kannama2.'
						</td>
						<td>
						'.$i_judul.'
						<br>
						<br>
						
						<a href="terkirim_baca.php?ikd='.$i_kd.'" class="btn btn-block btn-danger">BACA >></a>
						</td>
						<td>'.$i_postdate.'</td>
			    		</tr>';
						}
					while ($data = mysqli_fetch_assoc($result));
			
					echo '</tbody>
						  </table>
						  </div>
		
					<table width="100%" border="0" cellspacing="0" cellpadding="3">
					<tr>
					<td>
					<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
					</tr>
					</table>';
					}
				else
					{
					echo '<div align="center">
					<font color="red">
					<strong>TERKIRIM PESAN KOSONG.</strong>
					</font>
					</div>';
					}
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
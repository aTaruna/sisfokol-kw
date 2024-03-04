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
$filenya = "forum.php";
$judul = "[FORUM]. Topik Forum";
$judulku = "[FORUM]. Topik Forum";
$judulx = $judul;

$s = cegah($_REQUEST['s']);
$fkd = cegah($_REQUEST['fkd']);
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
	
	
	
	
	

//jika simpan baru
if ($_POST['btnSMPBR'])
	{
	$e_nama = cegah($_POST['e_nama']);
	$e_isi = cegah($_POST['e_isi']);
	
	//insert
	mysqli_query($koneksi, "INSERT INTO user_forum(kd, judul, isi, postdate) VALUES ".
					"('$x', '$e_nama', '$e_isi', '$today')");


	//re-direct
	xloc($filenya);
	exit();
	}









	
	
//jika simpan
if($_POST['btnSMP'])
	{
	$fkd = cegah($_POST['fkd']);
	$e_isi = cegah($_POST['e_isi']);


	//detail pengirim
	$ukd = $kd071_session;
	$ukode = $nip071_session;
	$unama = $nm071_session;
	$uket = $nm071_session;
	$ukat = $sek071_session;
	$upos = $pos071_session;
	
	
	//query
	mysqli_query($koneksi, "INSERT INTO user_forum_comment (kd, forum_kd, user_kd, ".
					"user_kode, user_nama, user_posisi, ".
					"user_kategori, user_ket, isi, postdate) ".
					"VALUES ('$x', '$fkd', '$ukd', ".
					"'$ukode', '$unama', '$upos', ".
					"'$ukat', '$uket', '$e_isi', '$today');"); 





	//re-direct
	$pesan = "Komentar Berhasil Terkirim.";
	$ke = "$filenya?fkd=$fkd#terbaru";
	pekem($pesan,$ke);
	exit();
	}







//jika hapus
if ($s == "hapus")
	{
	//hapus topik
	mysqli_query($koneksi, "DELETE FROM user_forum ".
								"WHERE kd = '$fkd'");
								
	
	//hapus comment
	mysqli_query($koneksi, "DELETE FROM user_forum_comment ".
								"WHERE forum_kd = '$fkd'");
	
	
								
	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//detail sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
				"WHERE kd = '$kd071_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = cegah($rowx['kode']);
$e_nama = cegah($rowx['nama']);





//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	




//isi *START
ob_start();


//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");





//jika list
if ((empty($fkd)) AND (empty($s)))
	{
	?>
	
	
	  
	  <script>
	  	$(document).ready(function() {
	    $('#table-responsive').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>
	
	<?php			
	//list komentar
	$qyuk = mysqli_query($koneksi, "SELECT kd FROM user_forum_comment ".
										"WHERE user_kd = '$kd071_session' ".
										"AND user_posisi = 'TATA USAHA'");
	$tyuk = mysqli_num_rows($qyuk);
	
	//jika null
	if (empty($tyuk))
		{
		$tyuk = 0;
		}
	
	
	
	echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
	
	<div class="table-responsive">
		<table class="table" border="0">
	    <thead>
		<tr>
		<td align="left">
				
			<p>
			<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Cari Topik...">
			<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
			<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
			</p>
		</td>
		
		
		<td align="right">
				
			<p>
			<a href="'.$filenya.'?s=baru" class="btn btn-danger">ENTRI TOPIK BARU >></a>
			<a href="forum_komentar.php" class="btn btn-success">[<b>'.$tyuk.'</b>] KOMENTARKU >></a>
			</p>
		</td>
		</tr>
	    </thead>
	    
	    </table>
	</div>';
		
		
	
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM user_forum ".
						"ORDER BY postdate DESC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM user_forum ".
						"WHERE judul LIKE '%$kunci%' ".
						"OR isi LIKE '%$kunci%' ".
						"ORDER BY postdate DESC";
		}
	
		
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	
	
	if ($count != 0)
		{
		//view data
		echo '<div class="table-responsive">
		<table class="table" border="1">
	    <thead>
		<tr bgcolor="'.$warnaheader.'">
		<td><strong><font color="'.$warnatext.'">TOPIK FORUM</font></strong></td>
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
			$i_judul = balikin($data['judul']);
			$i_isi = balikin($data['isi']);
			$i_postdate = balikin($data['postdate']);
			$i_jml_dilihat = balikin($data['jml_dilihat']);
			$i_jml_komentar = balikin($data['jml_komentar']);
	
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<h3>'.$i_judul.'</h3>
			
			<i>'.$i_isi.'</i>
			
			<br>
			[Postdate : <b>'.$i_postdate.'</b>]. [<b>'.$i_jml_dilihat.'</b> Dilihat]. [<b>'.$i_jml_komentar.'</b> Komentar].
			<br>
			
			<a href="'.$filenya.'?fkd='.$i_kd.'&s=hapus" class="btn btn-danger">HAPUS TOPIK</a>
			<a href="'.$filenya.'?fkd='.$i_kd.'" class="btn btn-success">BERI KOMENTAR >></a>
			</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
	
		echo '</tbody>
			  </table>
			  </div>
	
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>BELUM ADA TOPIK FORUM.</strong>
		</font>
		</p>';
		}
	
	
	
	
	echo '</form>';
	}



else if ((empty($fkd)) AND ($s == "baru"))
	{
	echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx2">
	
	<p>
	Judul Topik Forum: 
	<br>

	<input name="e_nama" type="text" size="30" value="'.$e_nama.'" class="btn-warning" required>
	</p>


	<p>
	Isi Topik : 
	<br>

	<input name="e_isi" type="text" size="50" value="'.$e_isi.'" class="btn-warning" required>
	</p>

	
	<p>
	<input name="btnSMPBR" type="submit" value="SIMPAN >>" class="btn btn-danger">
	</p>
	
	</form>';
	}




else
	{
	//detail.
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_forum ".
										"WHERE kd = '$fkd'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_judul = balikin($ryuk['judul']);
	$yuk_isi = balikin($ryuk['isi']);
	$yuk_jml_dilihat = balikin($ryuk['jml_dilihat']);
	$yuk_jml_komentar = balikin($ryuk['jml_komentar']);
	$yuk_postdate = balikin($ryuk['postdate']);
	
	
	
	
	//jika null
	if (empty($yuk_jml_dilihat))
		{
		//kasi jml.dilihat
		mysqli_query($koneksi, "UPDATE user_forum SET jml_dilihat = '1' ".
									"WHERE kd = '$fkd'");
		}
	else
		{
		//kasi jml.dilihat
		mysqli_query($koneksi, "UPDATE user_forum SET jml_dilihat = jml_dilihat + 1 ".
									"WHERE kd = '$fkd'");
		}
								
	
								
	//hitung jumlah komentar
	$qjuk = mysqli_query($koneksi, "SELECT kd FROM user_forum_comment ".
										"WHERE forum_kd = '$fkd'");
	$rjuk = mysqli_fetch_assoc($qjuk);
	$tjuk = mysqli_num_rows($qjuk);

	
	//jika null
	if (empty($tjuk))
		{
		$tjuk = 0;
		}
	
	//update
	mysqli_query($koneksi, "UPDATE user_forum SET jml_komentar = '$tjuk' ".
								"WHERE kd = '$fkd'");
								
	
	
	?>
	
	<p>
	<a href="forum.php" class="btn btn-success"><< DAFTAR TOPIK FORUM</a>
	</p>

	<div class="card card-widget">
              <div class="card-header">
                  <span class="username"><h3><?php echo $yuk_judul;?></h3></span>
                  <span class="description">[Postdate : <?php echo $yuk_postdate?>]. [<b><?php echo $yuk_jml_dilihat;?></b> Dilihat]. [<b><?php echo $yuk_jml_komentar;?></b> Komentar].</span>
                <!-- /.user-block -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <p><?php echo $yuk_isi;?></p>

              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
              	
              	<?php
              	//list komentar
				$qyuk2 = mysqli_query($koneksi, "SELECT * FROM user_forum_comment ".
													"WHERE forum_kd = '$fkd' ".
													"ORDER BY postdate ASC");
				$ryuk2 = mysqli_fetch_assoc($qyuk2);
				$tyuk2 = mysqli_num_rows($qyuk2);
				
				
				//jika ada
				if (!empty($tyuk2))
					{
					do
						{
						$yuk2_isi = balikin($ryuk2['isi']);
						$yuk2_kd = balikin($ryuk2['user_kd']);
						$yuk2_kode = balikin($ryuk2['user_kode']);
						$yuk2_nama = balikin($ryuk2['user_nama']);
						$yuk2_posisi = balikin($ryuk2['user_posisi']);
						$yuk2_kategori = balikin($ryuk2['user_kategori']);
						$yuk2_ket = balikin($ryuk2['user_ket']);
						$yuk2_postdate = balikin($ryuk2['postdate']);

		                echo '<div class="card-comment">
		                  <div class="comment-text">
		                    <span class="username">
		                      '.$yuk2_nama.' ['.$yuk2_kode.']. ['.$yuk2_kategori.']. ['.$yuk2_posisi.']. ['.$yuk2_ket.'].
		                      <span class="text-muted float-right">'.$yuk2_postdate.'</span>
		                    </span>
		                    

		                    '.$yuk2_isi.'
		                  </div>
		                </div>';
		                }
					while ($ryuk2 = mysqli_fetch_assoc($qyuk2));
					}
				?>

				<a name="terbaru"></a>


                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
				<form action="<?php echo $filenya;?>" enctype="multipart/form-data" method="post" name="formx3">
                  <div class="img-push">
                    <input type="text" name="e_isi" id="e_isi" class="form-control form-control-sm" placeholder="Beri Komentar..." required>
                    <br>
                    
                    <input type="hidden" name="fkd" id="fkd" value="<?php echo $fkd;?>">
					<button name="btnSMP" id="btnSMP" type="submit" value="KIRIM >>" class="btn btn-block btn-danger">KIRIM >></button>
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
	
	<?php
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>
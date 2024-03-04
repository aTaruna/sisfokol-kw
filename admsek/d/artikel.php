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
require("../../inc/cek/admsek.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admsek.html");

nocache();

//nilai
$filenya = "artikel.php";
$judul = "[PROFIL SEKOLAH]. Artikel/Info/Berita";
$judulku = "[PROFIL SEKOLAH]. Artikel/Info/Berita";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kdku']);
$kdku = nosql($_REQUEST['kdku']);
$katkd = nosql($_REQUEST['katkd']);



//detail sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
				"WHERE kd = '$kd81_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = cegah($rowx['kode']);
$e_nama = cegah($rowx['nama']);
$e_cabang = cegah($rowx['cabang']);



//update cabang
mysqli_query($koneksi, "UPDATE sekolah_cp_artikel SET cabang = '$e_cabang' ".
							"WHERE sekolah_kd = '$kd81_session'");




//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	

//jika simpan
if($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kdku = nosql($_POST['kdku']);
	$e_judul = cegah($_POST['e_judul']);
	$e_isi = cegah2($_POST['editor']);
	$e_kategori = cegah($_POST['e_kategori2']);


	
	//nek null
	if ((empty($e_kategori)) OR (empty($e_judul)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=baru&kdku=$kdku";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ((empty($s)) OR ($s == "baru"))
			{
			//query
			mysqli_query($koneksi, "INSERT INTO sekolah_cp_artikel (kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"kategori, judul, isi, postdate) ".
							"VALUES ('$kdku', '$kd81_session', '$e_kode', '$e_nama', ".
							"'$e_kategori', '$e_judul', '$e_isi', '$today');"); 



		
			//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
			//detail
			$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$kd81_session'");
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
		
		





			//re-direct
			$ke = "$filenya?katkd=$katkd";
			xloc($ke);
			exit();
			}
		else 
			{
			//query
			mysqli_query($koneksi, "UPDATE sekolah_cp_artikel SET judul = '$e_judul', ".
										"isi = '$e_isi', ".
										"kategori = '$e_kategori', ".
										"postdate = '$today' ".
										"WHERE sekolah_kd = '$kd81_session' ".
										"AND kd = '$kdku'");


			//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
			//detail
			$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
									"WHERE kd = '$kd81_session'");
			$rku = mysqli_fetch_assoc($qku);
			$ku_kd = cegah($rku['kd']);
			$ku_kode = cegah($rku['kode']);
			$ku_nama = cegah($rku['nama']);
		
			$ku_ket = cegah("[MENU : $judul]. UPDATE : $e_judul");			
			
			
			//insert
			mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
							"user_kd, user_kode, user_nama, ".
							"user_posisi, user_jabatan, ket, postdate) VALUES ".
							"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
							"'$ku_kd', '$ku_kode', '$ku_nama', ".
							"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
			//kasi log login ///////////////////////////////////////////////////////////////////////////////////

			
			
			//re-direct
			$ke = "$filenya?katkd=$katkd";
			xloc($ke);
			exit();
			}
		}


	exit();
	}






//jika hapus data
if($_POST['btnHPS'])
	{
	//ambil nilai
	$katkd = nosql($_POST['katkd']);


	//ambil semua
	for ($i=1; $i<=$limit;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM sekolah_cp_artikel ".
						"WHERE sekolah_kd = '$kd81_session' ".
						"AND kd = '$kd'");
		}

		
		
	
	
	//kasi log entri ///////////////////////////////////////////////////////////////////////////////////
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
							"WHERE kd = '$kd81_session'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['kode']);
	$ku_nama = cegah($rku['nama']);

	$ku_ket = cegah("[MENU : $judul]. HAPUS");			
	
	
	//insert
	mysqli_query($koneksi, "INSERT INTO user_log_entri(kd, sekolah_kd, sekolah_kode, sekolah_nama, ".
					"user_kd, user_kode, user_nama, ".
					"user_posisi, user_jabatan, ket, postdate) VALUES ".
					"('$x', '$ku_kd', '$ku_kode', '$ku_nama', ".
					"'$ku_kd', '$ku_kode', '$ku_nama', ".
					"'SEKOLAH', 'TATA USAHA', '$ku_ket', '$today')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////



	//re-direct
	$ke = "$filenya?katkd=$katkd";
	xloc($ke);
	exit();
	}



	




//isi *START
ob_start();


?>



<script type="text/javascript" src="<?php echo $sumber;?>/inc/class/ckeditor/ckeditor.js"></script>



<?php
//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");




echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx3">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Kategori : ';
echo "<select name=\"e_kategori\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";

//terpilih
$qstx2 = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
						"WHERE kd = '$katkd'");
$rowstx2 = mysqli_fetch_assoc($qstx2);
$stx2_kd = nosql($rowstx2['kd']);
$stx2_nama1 = balikin($rowstx2['nama']);
$stx2_nama2 = cegah($rowstx2['nama']);

echo '<option value="'.$stx2_nama2.'" selected>--'.$stx2_nama1.'--</option>';

$qst = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
						"ORDER BY nama ASC");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['kd']);
	$st_nama1 = balikin($rowst['nama']);
	$st_nama2 = cegah($rowst['nama']);

	//query
	$q = mysqli_query($koneksi, "SELECT * FROM sekolah_cp_artikel ".
						"WHERE sekolah_kd = '$kd81_session' ".
						"AND kategori = '$st_nama2'");
	$row = mysqli_fetch_assoc($q);
	$total = mysqli_num_rows($q);


	echo '<option value="'.$filenya.'?katkd='.$st_nama2.'">'.$st_nama1.' [Jumlah : '.$total.'].</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>

<input name="katkd" type="hidden" value="'.$katkd.'">
<input name="s" type="hidden" value="'.$s.'">
</td>
</tr>
</table>
<hr>

<a href="'.$filenya.'?s=baru&kdku='.$x.'" class="btn btn-danger"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"> Entri Baru</a>


</form>

<hr>';




//jika edit
//tampilkan form
if (($s == 'baru') OR ($s == 'edit'))
	{
	//query
	$qx = mysqli_query($koneksi, "SELECT * FROM sekolah_cp_artikel ".
									"WHERE sekolah_kd = '$kd81_session' ".
									"AND kd = '$kdku'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_judul = balikin($rowx['judul']);
	$e_isi = balikin2($rowx['isi']);
	$katkd = balikin($rowx['kategori']);
	$e_postdate = $rowx['postdate'];

	//pecah titik - titik
	$e_isi2 = pathasli2($e_isi);
	
	
	
	echo '<h2>Entri Baru/Edit</h2>

	';
	?>
	
	
	
		
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	
	
		<style type="text/css">
		.thumb-image{
		 float:left;
		 width:150px;
		 height:150px;
		 position:relative;
		 padding:5px;
		}
		</style>
		
		
		
		
			<table border="0" cellspacing="0" cellpadding="3">
			<tr valign="top">
			<td width="100">
				<div id="image-holder"></div>
			</td>
			
	
			</tr>
			</table>
		
		<script>
		$(document).ready(function() {
			
			
		        $("#image_upload").on('change', function() {
	          //Get count of selected files
	          var countFiles = $(this)[0].files.length;
	          var imgPath = $(this)[0].value;
	          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	          var image_holder = $("#image-holder");
	          image_holder.empty();
	          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	            if (typeof(FileReader) != "undefined") {
	              //loop for each file selected for uploaded.
	              for (var i = 0; i < countFiles; i++) 
	              {
	                var reader = new FileReader();
	                reader.onload = function(e) {
	                  $("<img />", {
	                    "src": e.target.result,
	                    "class": "thumb-image"
	                  }).appendTo(image_holder);
	                }
	                image_holder.show();
	                reader.readAsDataURL($(this)[0].files[i]);
	              }
	              
	
		    
	            } else {
	              alert("This browser does not support FileReader.");
	            }
	          } else {
	            alert("Pls select only images");
	          }
	        });
	        
	        
	
	
	        
	        
	        
	      });
	</script>
	
	<?php
	echo '<div id="loading" style="display:none">
	<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
		</div>
		
		
	   <form method="post" id="upload_image" enctype="multipart/form-data">
	<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />
	
	   </form>';
	
	?>
	
	
	<script>  
	$(document).ready(function(){
		
		
		
	       $('#image-holder').load("<?php echo $sumber;?>/admsek/d/i_artikel.php?aksi=lihat1&sekkd=<?php echo $kd81_session;?>&kd=<?php echo $kd;?>");
	
	
	
	        
	    $('#upload_image').on('change', function(event){
	     event.preventDefault();
	     
			$('#loading').show();
	
	
		
		     $.ajax({
		      url:"i_artikel_upload.php?sekkd=<?php echo $kd81_session;?>&kd=<?php echo $kd;?>",
		      method:"POST",
		      data:new FormData(this),
		      contentType:false,
		      cache:false,
		      processData:false,
		      success:function(data){
				$('#loading').hide();
		       $('#preview').load("<?php echo $sumber;?>/admsek/d/i_artikel.php?aksi=lihat&sekkd=<?php echo $kd81_session;?>&kd=<?php echo $kd;?>");
		       	
		      }
		     })
		    });
		    
		    
	});  
	</script>


	<?php	
	echo '<p>
	NB. File Image dengan Resolusi 800 x 800 pixel
	</p>
	
	
	<hr>
	
	
	<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx2">
		
	<p>
	Judul : 
	<br>
	<input name="e_judul" id="e_judul" type="text" value="'.$e_judul.'" size="50" class="btn btn-warning" required>
	</p>
	
	<p>
	Isi : 
	<br>
	<textarea id="editor" name="editor" rows="20" cols="80" style="width: 100%" class="btn btn-warning" required>'.$e_isi2.'</textarea>
	</p>
	<br>
	
	<p>
	Kategori :
	<br>
	<select name="e_kategori2" id="e_kategori2" class="btn btn-warning" required>
	<option value="'.$katkd.'" selected>--'.$katkd.'--</option>';
	
	$qst = mysqli_query($koneksi, "SELECT * FROM cp_m_kategori ".
										"ORDER BY nama ASC");
	$rowst = mysqli_fetch_assoc($qst);
	
	do
		{
		$st_kd = nosql($rowst['kd']);
		$st_nama1 = balikin($rowst['nama']);
		$st_nama2 = cegah($rowst['nama']);
	
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM sekolah_cp_artikel ".
										"WHERE sekolah_kd = '$kd81_session' ".
										"AND kategori = '$st_nama2'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);
	
	
	
		echo '<option value="'.$st_nama2.'">'.$st_nama1.' [Jumlah : '.$total.'].</option>';
		}
	while ($rowst = mysqli_fetch_assoc($qst));
	
	echo '</select>
	</p>
	
	


	<p>
	<input name="kdku" id="kdku" type="hidden" value="'.$kdku.'">
	<input name="katkd" id="katkd" type="hidden" value="'.$katkd.'">
	<input name="s" type="hidden" value="'.$s.'">
	
	<button name="btnSMP" id="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">SIMPAN</button>
	<button name="btnDF" id="btnDF" type="submit" value="KEMBALI KE DAFTAR" class="btn btn-info">KEMBALI KE DAFTAR >></button>
	</p>
	
	
	</form>';
	
	
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
	
	<?php
	}
else 
	{
	//jika null
	if (empty($katkd))
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT * FROM sekolah_cp_artikel ".
						"WHERE sekolah_kd = '$kd81_session' ".
						"ORDER BY postdate DESC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
		}
	else 
		{
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT * FROM sekolah_cp_artikel ".
						"WHERE sekolah_kd = '$kd81_session' ".
						"AND kategori = '$katkd' ".
						"ORDER BY postdate DESC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
	
	
		if ($count != 0)
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
			//view data
			echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
			
			
			<div class="table-responsive">          
		  <table class="table" border="1">
		    <thead>

			<tr bgcolor="'.$warnaheader.'">
			<td width="1">&nbsp;</td>
			<td width="1">&nbsp;</td>
			<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
			<td width="100"><strong><font color="'.$warnatext.'">KATEGORI</font></strong></td>
			<td width="50"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
			<td><strong><font color="'.$warnatext.'">JUDUL</font></strong></td>
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
				$i_kategori = balikin($data['kategori']);
				$i_judul = balikin($data['judul']);
				$i_isi = balikin($data['isi']);
				$i_postdate = $data['postdate'];
				
				$i_filex = "$i_kd.png";
				$nil_foto = "$sumber/filebox/artikel/$kd81_session/$i_kd/$i_filex";

	
				//pecah titik - titik
				$i_isi2 = pathasli2($i_isi);

	
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
				<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
	    		</td>
				<td>
				<a href="'.$filenya.'?s=edit&kdku='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
				</td>
				<td>'.$i_postdate.'</td>
				<td>'.$i_kategori.'</td>
				<td>
				<img src="'.$nil_foto.'" height="100">
				</td>
				<td>'.$i_judul.'</td>
	    		</tr>';
				}
			while ($data = mysqli_fetch_assoc($result));
	
			echo '</tbody>
				  </table>
				  </div>

			<table width="100%" border="0" cellspacing="0" cellpadding="3">
			<tr>
			<td width="300">
			<input name="jml" type="hidden" value="'.$limit.'">
			<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
			<input name="kdku" type="hidden" value="'.nosql($_REQUEST['kdku']).'">
			<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')" class="btn btn-success">
			<input name="btnBTL" type="reset" value="BATAL" class="btn btn-info">
			<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
			</td>
			<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
			</tr>
			</table>
			
			
			</form>';
			}
		else
			{
			echo '<p>
			<font color="red">
			<strong>TIDAK ADA DATA.</strong>
			</font>
			</p>';
			}
		}
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
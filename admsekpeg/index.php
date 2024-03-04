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
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/admsekpeg.php");
require("../inc/class/paging.php");
$tpl = LoadTpl("../template/admsekpeg.html");


nocache();

//nilai
$filenya = "index.php";
$diload = "getLocation();";





//detail sekolah
$qx = mysqli_query($koneksi, "SELECT * FROM m_sekolah ".
					"WHERE kd = '$sekkd82_session'");
$rowx = mysqli_fetch_assoc($qx);
$e_kode = balikin($rowx['kode']);
$e_kode_nss = balikin($rowx['kode_nss']);
$e_kode_nds = balikin($rowx['kode_nds']);
$e_nama = balikin($rowx['nama']);
$e_telp = balikin($rowx['telp']);
$e_alamat = balikin($rowx['alamat']);
$e_luas_tanah = balikin($rowx['sarpras_luas_tanah']);
$e_luas_bangunan = balikin($rowx['sarpras_luas_bangunan']);
$e_total_siswa = balikin($rowx['total_siswa']);
$e_total_pegawai = balikin($rowx['total_pegawai']);
$e_total_kelas = balikin($rowx['total_kelas']);
$e_alamat_googlemap = balikin($rowx['alamat_googlemap']);
$e_postdate = balikin($rowx['postdate']);







//detail pegawai
$qx2 = mysqli_query($koneksi, "SELECT * FROM sekolah_pegawai ".
					"WHERE kd = '$kd82_session'");
$rowx2 = mysqli_fetch_assoc($qx2);
$f_kode = balikin($rowx2['kode']);
$f_nama = balikin($rowx2['nama']);




//nilai
$judul = "DashBoard Pegawai/Karyawan : $f_nama";
$judulku = "DashBoard Pegawai/Karyawan : $f_nama";




//postdate entri
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
									"WHERE user_kd = '$kd82_session' ".
									"AND user_jabatan = 'PEGAWAI' ".
									"ORDER BY postdate DESC");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_entri_terakhir = balikin($ryuk['postdate']);




//postdate login
$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_login ".
									"WHERE user_kd = '$kd82_session' ".
									"AND user_jabatan = 'PEGAWAI' ".
									"ORDER BY postdate DESC");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_login_terakhir = balikin($ryuk['postdate']);























//isi *START
ob_start();


echo '<div class="row">

  <div class="col-lg-12">
    <div class="info-box mb-3 bg-warning">
      <span class="info-box-icon"><i class="fa fa-graduation-cap"></i></span>

      <div class="info-box-content">
        <span class="info-box-number">
        		SEKOLAH : '.$e_nama.'
			</span>
			
			
			<span class="info-box-text"><i>'.$e_alamat.'</i></span>
      </div>
    </div>

	</div>


</div>';




//isi
$judulku = ob_get_contents();
ob_end_clean();
              




























//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Ymd',mktime(0,0,0,$m,($de-$i),$y)); 

	echo "$nilku, ";
	}


//isi
$isi_data1 = ob_get_contents();
ob_end_clean();










//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui ordernya...
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_login ".
							"WHERE user_kd = '$kd82_session' ".
							"AND user_jabatan = 'PEGAWAI' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
									
									
	if (empty($tyuk))
		{
		$tyuk = "1";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data2 = ob_get_contents();
ob_end_clean();









//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_entri ".
							"WHERE user_kd = '$kd82_session' ".
							"AND user_jabatan = 'PEGAWAI' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
	if (empty($tyuk))
		{
		$tyuk = "1";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data3 = ob_get_contents();
ob_end_clean();













//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui
	$qyuk = mysqli_query($koneksi, "SELECT * FROM user_log_gps ".
							"WHERE user_kd = '$kd82_session' ".
							"AND user_jabatan = 'PEGAWAI' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
	if (empty($tyuk))
		{
		$tyuk = "1";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data4 = ob_get_contents();
ob_end_clean();











//isi *START
ob_start();


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>







<p id="demoku"></p>

<script>
var xx = document.getElementById("demoku");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    xx.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
	
	
		$.ajax({
			url: "i_set_lokasi.php?aksi=pmasuk&latx="+position.coords.latitude+"&laty="+position.coords.longitude,
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){			
				$("#demoku").html(data);	
				}
			});
		return false;
}
</script>










		<!-- Info boxes -->
      <div class="row">



        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo $f_nama;?></span>
              <span class="info-box-number"><?php echo $f_kode;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        






        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">LOGIN TERAKHIR</span>
              <span class="info-box-number"><?php echo $yuk_login_terakhir;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        


                
      </div>
      <!-- /.row -->







        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">


			<?php
			//info dari majelis //////////////////////////////////////////////////////////////////////
			$limit = 1;
			$sqlcount = "SELECT * FROM info_dari_majelis ".
							"ORDER BY postdate DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			
			$i_kategori = balikin($data['kategori']);
			$i_judul = balikin($data['judul']);
			$i_isi = balikin($data['isi']);
			$i_postdate = balikin($data['postdate']);


            echo '<div class="callout callout-info">
                  <h5>MEMO DARI MAJELIS BIASAWAE</h5>
                  <hr>';

			//jika ada
			if (!empty($count))
				{
				echo '<p>'.$i_judul.'</p>
                  
				  <p><i>'.$i_kategori.'. '.$i_postdate.'</i></p>
				  
				  <p>'.$i_isi.'</p>';
				}
			else
				{
				echo '<font color="red">
				<h3>Belum Ada Memo Terbaru...</h3>
				</font>';	
				}
                    
            echo '</div>';




			
			
			
			
			
			
			//info dari sekolah //////////////////////////////////////////////////////////////////////
			$limit = 1;
			$sqlcount = "SELECT * FROM sekolah_cp_artikel ".
							"WHERE sekolah_kd = '$sekkd82_session' ".
							"ORDER BY postdate DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			
			$i_kategori = balikin($data['kategori']);
			$i_judul = balikin($data['judul']);
			$i_isi = balikin($data['isi']);
			$i_postdate = balikin($data['postdate']);


            echo '<div class="callout callout-success">
                  <h5>ARTIKEL/BERITA/INFO DARI SEKOLAH</h5>
                  <hr>';

			//jika ada
			if (!empty($count))
				{
				echo '<p>'.$i_judul.'</p>
                  
				  <p><i>'.$i_kategori.'. '.$i_postdate.'</i></p>
				  
				  <p>'.$i_isi.'</p>';
				}
			else
				{
				echo '<font color="red">
				<h3>Belum Ada Info Terbaru...</h3>
				</font>';	
				}
                  
				    
            echo '</div>';
			?>

			











	
				<script>
					$(function () {
					  'use strict'
					
					  var ticksStyle = {
					    fontColor: '#495057',
					    fontStyle: 'bold'
					  }
					
					  var mode      = 'index'
					  var intersect = true
					
					
					  var $visitorsChart = $('#visitors-chart')
					  var visitorsChart  = new Chart($visitorsChart, {
					    data   : {
					      labels  : [<?php echo $isi_data1;?>],
					      datasets: [{
					        type                : 'line',
					        data                : [<?php echo $isi_data2;?>],
					        backgroundColor     : 'transparent',
					        borderColor         : 'blue',
					        pointBorderColor    : 'blue',
					        pointBackgroundColor: 'blue',
					        fill                : false
					        // pointHoverBackgroundColor: '#007bff',
					        // pointHoverBorderColor    : '#007bff'
					      },
					        {
					          type                : 'line',
					          data                : [<?php echo $isi_data3;?>],
					          backgroundColor     : 'tansparent',
					          borderColor         : 'orange',
					          pointBorderColor    : 'orange',
					          pointBackgroundColor: 'orange',
					          fill                : false
					          // pointHoverBackgroundColor: '#ced4da',
					          // pointHoverBorderColor    : '#ced4da'
					        },
					        {
					          type                : 'line',
					          data                : [<?php echo $isi_data4;?>],
					          backgroundColor     : 'tansparent',
					          borderColor         : 'pink',
					          pointBorderColor    : 'pink',
					          pointBackgroundColor: 'pink',
					          fill                : false
					          // pointHoverBackgroundColor: '#ced4da',
					          // pointHoverBorderColor    : '#ced4da'
					        }]
					    },
					    options: {
					      maintainAspectRatio: false,
					      tooltips           : {
					        mode     : mode,
					        intersect: intersect
					      },
					      hover              : {
					        mode     : mode,
					        intersect: intersect
					      },
					      legend             : {
					        display: false
					      },
					      scales             : {
					        yAxes: [{
					          // display: false,
					          gridLines: {
					            display      : true,
					            lineWidth    : '4px',
					            color        : 'rgba(0, 0, 0, .2)',
					            zeroLineColor: 'transparent'
					          },
					          ticks    : $.extend({
					            beginAtZero : true,
					            suggestedMax: 200
					          }, ticksStyle)
					        }],
					        xAxes: [{
					          display  : true,
					          gridLines: {
					            display: false
					          },
					          ticks    : ticksStyle
					        }]
					      }
					    }
					  })
					})
	
				</script>
	
	
	
	
	
	
	
	
	

	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Grafik : Login, Entri, GPS</h3>
	
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body">
	
	
	
	                <div class="position-relative mb-4">
	                  <canvas id="visitors-chart" height="200"></canvas>
	                </div>
	
	                <div class="d-flex flex-row justify-content-end">
	                  <span class="mr-2">
	                    <i class="fas fa-square text-blue"></i> Login
	                  </span>
	                  &nbsp;
	
	                  <span>
	                    <i class="fas fa-square text-orange"></i> Entri
	                  </span>
	                  
	                  &nbsp;
	                  &nbsp;
	                  
	                  <span>
	                    <i class="fas fa-square text-pink"></i> GPS
	                  </span>
	                </div>
	
	
	                
	                
	              </div>
	            </div>
	
	

            </div>
            
            
          <div class="col-md-4">
            
			<?php
			$limit = 5;
			$sqlcount = "SELECT * FROM sekolah_cp_foto ".
							"WHERE sekolah_kd = '$sekkd82_session' ".
							"ORDER BY postdate DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			?>
			
			
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">FOTO DARI SEKOLAH</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <tbody>
                    	
                    <?php
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
							$i_ket = balikin($data['ket']);
						
							$i_filex = "$i_kd.png";
							$nil_foto = "$sumber/filebox/foto/$sekkd82_session/$i_kd/$i_filex";
						
						
							echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
							echo '<td>
							<img src="'.$nil_foto.'" width="100%">
							'.$i_ket.'
							</td>
					        </tr>';
							}
						while ($data = mysqli_fetch_assoc($result));
						?>
						
						
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo $sumber;?>/admsekpeg/h/foto_sekolah.php" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->



				<br>
			
			
			<?php
			$limit = 5;
			$sqlcount = "SELECT * FROM sekolah_cp_youtube ".
							"WHERE sekolah_kd = '$sekkd82_session' ".
							"ORDER BY postdate DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			?>
			
			
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">LINK YOUTUBE DARI SEKOLAH</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <tbody>
                    	
                    <?php
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
							$i_judul = balikin($data['judul']);
							$i_filex = balikin($data['filex']);

						
							//ambil kode untuk embed
							$pecahku = explode("=", $i_filex);
							$i_kata1 = trim($pecahku[1]);
							
							//sebelum tanda &
							$pecahku2 = explode("&", $i_kata1);
							$i_filex2 = trim($pecahku2[0]);

						
							echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
							echo '<td>
							'.$i_judul.'
							<br>
							<br>
							
							<iframe width="100%" height="100" src="https://www.youtube.com/embed/'.$i_filex2.'"></iframe>
							<br>
							<a href="'.$i_filex.'" title="'.$i_judul.'" target="_blank">'.$i_filex.'</a>
							

							</td>
					        </tr>';
							}
						while ($data = mysqli_fetch_assoc($result));
						?>
						
						
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo $sumber;?>/admsekpeg/h/youtube_sekolah.php" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->




			
	          </div>
	        </div>
	          




              



		<!-- OPTIONAL SCRIPTS -->
		<script src="../template/adminlte3/plugins/chart.js/Chart.min.js"></script>
		




	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	$.noConflict();

	});
	
	</script>
	







<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>
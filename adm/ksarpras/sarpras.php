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
$filenya = "sarpras.php";
$judul = "K.I.B";
$judulku = "[SAPRAS SEKOLAH] $judul";
$juduli = $judul;
$s = cegah($_REQUEST['s']);
$katkd = cegah($_REQUEST['katkd']);
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
	//nilai
	$katkd = cegah($_POST['katkd']);

	//re-direct
	$ke = "$filenya?katkd=$katkd";
	xloc($ke);
	exit();
	}







//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$katkd = cegah($_POST['katkd']);
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?katkd=$katkd&kunci=$kunci";
	xloc($ke);
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
echo '<p>
Kartu Inventaris Barang (KIB) : ';
echo "<select name=\"e_kategori\" onChange=\"MM_jumpMenu('self',this,0)\" class=\"btn btn-warning\">";

//terpilih
$qstx2 = mysqli_query($koneksi, "SELECT * FROM m_kib_jenis ".
						"WHERE kd = '$katkd'");
$rowstx2 = mysqli_fetch_assoc($qstx2);
$stx2_kd = nosql($rowstx2['kd']);
$stx2_nama1 = balikin($rowstx2['nama']);

echo '<option value="'.$stx2_kd.'" selected>'.$stx2_kd.'. '.$stx2_nama1.'</option>';
echo '<option value="'.$filenya.'?katkd="></option>';

$qst = mysqli_query($koneksi, "SELECT * FROM m_kib_jenis ".
						"ORDER BY round(kd) ASC");
$rowst = mysqli_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['kd']);
	$st_nama1 = balikin($rowst['nama']);

	echo '<option value="'.$filenya.'?katkd='.$st_kd.'">'.$st_kd.'. '.$st_nama1.'</option>';
	}
while ($rowst = mysqli_fetch_assoc($qst));

echo '</select>
</p>
<hr>';


	//jika A /////////////////////////////////////////////////////////////////////////////////////////////
	if ($katkd == "A")
		{
		$warnatext = "white";
		
		//jika null
		if (empty($kunci))
			{
			$sqlcount = "SELECT * FROM sekolah_kib_a ".
							"ORDER BY postdate DESC";
			}
			
		else
			{
			$sqlcount = "SELECT * FROM sekolah_kib_a ".
							"WHERE barang_kode LIKE '%$kunci%' ".
							"OR barang_nama LIKE '%$kunci%' ".
							"OR sekolah_nama LIKE '%$kunci%' ".
							"OR register LIKE '%$kunci%' ".
							"OR luas LIKE '%$kunci%' ".
							"OR tahun_ada LIKE '%$kunci%' ".
							"OR alamat LIKE '%$kunci%' ".
							"OR status_hak LIKE '%$kunci%' ".
							"OR status_sertifikat_tgl LIKE '%$kunci%' ".
							"OR status_sertifikat_nomor LIKE '%$kunci%' ".
							"OR penggunaan LIKE '%$kunci%' ".
							"OR asal_usul LIKE '%$kunci%' ".
							"OR harga LIKE '%$kunci%' ".
							"OR ket LIKE '%$kunci%' ".
							"ORDER BY postdate DESC";
			}
			
			
		
		//query
		$target = "$filenya?katkd=$katkd";
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
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
		<input name="katkd" type="hidden" value="'.$katkd.'">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
			
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">REGISTER</font></strong></td>
		<td><strong><font color="'.$warnatext.'">LUAS M2</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN PENGADAAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
		<td><strong><font color="'.$warnatext.'">STATUS HAK</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SERTIFIKAT TANGGAL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SERTIFIKAT NOMOR</font></strong></td>
		<td><strong><font color="'.$warnatext.'">PENGGUNAAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ASAL_USUL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HARGA RP</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KET</font></strong></td>
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
				$i_seknama = balikin($data['sekolah_nama']);
				$i_kode = balikin($data['barang_kode']);
				$i_nama = balikin($data['barang_nama']);
				$i_register = balikin($data['register']);
				$i_luas = balikin($data['luas']);
				$i_tahun_ada = balikin($data['tahun_ada']);
				$i_alamat = balikin($data['alamat']);
				$i_status_hak = balikin($data['status_hak']);
				$i_sertifikat_tgl = balikin($data['status_sertifikat_tgl']);
				$i_sertifikat_nomor = balikin($data['status_sertifikat_nomor']);
				$i_penggunaan = balikin($data['penggunaan']);
				$i_asal_usul = balikin($data['asal_usul']);
				$i_harga = balikin($data['harga']);
				$i_ket = balikin($data['ket']);

				$i_postdate = balikin($data['postdate']);
	
				
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_seknama.'</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_register.'</td>
				<td>'.$i_luas.' M2</td>
				<td>'.$i_tahun_ada.'</td>
				<td>'.$i_alamat.'</td>
				<td>'.$i_status_hak.'</td>
				<td>'.$i_sertifikat_tgl.'</td>
				<td>'.$i_sertifikat_nomor.'</td>
				<td>'.$i_penggunaan.'</td>
				<td>'.$i_asal_usul.'</td>
				<td align="right">'.xduit3($i_harga).'</td>
				<td>'.$i_ket.'</td>
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
		
	
	
	
	//jika B /////////////////////////////////////////////////////////////////////////////////////////////
	else if ($katkd == "B")
		{
		$warnatext = "white";
		
		//jika null
		if (empty($kunci))
			{
			$sqlcount = "SELECT * FROM sekolah_kib_b ".
							"ORDER BY postdate DESC";
			}
			
		else
			{
			$sqlcount = "SELECT * FROM sekolah_kib_b ".
							"WHERE barang_kode LIKE '%$kunci%' ".
							"OR sekolah_nama LIKE '%$kunci%' ".
							"OR barang_nama LIKE '%$kunci%' ".
							"OR register LIKE '%$kunci%' ".
							"OR jumlah LIKE '%$kunci%' ".
							"OR satuan LIKE '%$kunci%' ".
							"OR merk_type LIKE '%$kunci%' ".
							"OR ukuran_cc LIKE '%$kunci%' ".
							"OR bahan LIKE '%$kunci%' ".
							"OR tahun_beli LIKE '%$kunci%' ".
							"OR nomor_pabrik LIKE '%$kunci%' ".
							"OR nomor_rangka LIKE '%$kunci%' ".
							"OR nomor_mesin LIKE '%$kunci%' ".
							"OR nomor_polisi LIKE '%$kunci%' ".
							"OR nomor_bpkb LIKE '%$kunci%' ".
							"OR asal_usul LIKE '%$kunci%' ".
							"OR harga LIKE '%$kunci%' ".
							"OR ket LIKE '%$kunci%' ".
							"ORDER BY postdate DESC";
			}
			
			
		
		//query
		$target = "$filenya?katkd=$katkd";
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
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
		<input name="katkd" type="hidden" value="'.$katkd.'">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
			
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">REGISTER</font></strong></td>
		<td><strong><font color="'.$warnatext.'">JUMLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SATUAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">MERK/TYPE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">UKURAN CC</font></strong></td>
		<td><strong><font color="'.$warnatext.'">BAHAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN BELI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NOMOR PABRIK</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NOMOR RANGKA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NOMOR MESIN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NOMOR POLISI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NOMOR BPKB</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ASAL USUL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HARGA RP</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KET</font></strong></td>
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
				$i_seknama = balikin($data['sekolah_nama']);
				$i_kode = balikin($data['barang_kode']);
				$i_nama = balikin($data['barang_nama']);
				$i_register = balikin($data['register']);
				$i_jumlah = balikin($data['jumlah']);
				$i_satuan = balikin($data['satuan']);
				$i_merk = balikin($data['merk_type']);
				$i_ukuran_cc = balikin($data['ukuran_cc']);
				$i_bahan = balikin($data['bahan']);
				$i_tahun_beli = balikin($data['tahun_beli']);
				$i_no_pabrik = balikin($data['nomor_pabrik']);
				$i_no_rangka = balikin($data['nomor_rangka']);
				$i_no_mesin = balikin($data['nomor_mesin']);
				$i_no_polisi = balikin($data['nomor_polisi']);
				$i_no_bpkb = balikin($data['nomor_bpkb']);
				$i_asal_usul = balikin($data['asal_usul']);
				$i_harga = balikin($data['harga']);
				$i_ket = balikin($data['ket']);

				$i_postdate = balikin($data['postdate']);
	
				
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_seknama.'</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_register.'</td>
				<td>'.$i_jumlah.'</td>
				<td>'.$i_satuan.'</td>
				<td>'.$i_merk.'</td>
				<td>'.$i_ukuran_cc.'</td>
				<td>'.$i_bahan.'</td>
				<td>'.$i_tahun_beli.'</td>
				<td>'.$i_no_pabrik.'</td>
				<td>'.$i_no_rangka.'</td>
				<td>'.$i_no_mesin.'</td>
				<td>'.$i_no_polisi.'</td>
				<td>'.$i_no_bpkb.'</td>
				<td>'.$i_asal_usul.'</td>
				<td align="right">'.xduit3($i_harga).'</td>
				<td>'.$i_ket.'</td>
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
		













	//jika C /////////////////////////////////////////////////////////////////////////////////////////////
	else if ($katkd == "C")
		{
		$warnatext = "white";
		
		//jika null
		if (empty($kunci))
			{
			$sqlcount = "SELECT * FROM sekolah_kib_c ".
							"ORDER BY postdate DESC";
			}
			
		else
			{
			$sqlcount = "SELECT * FROM sekolah_kib_c ".
							"WHERE barang_kode LIKE '%$kunci%' ".
							"OR sekolah_nama LIKE '%$kunci%' ".
							"OR barang_nama LIKE '%$kunci%' ".
							"OR register LIKE '%$kunci%' ".
							"OR kondisi LIKE '%$kunci%' ".
							"OR kontruksi_tingkat LIKE '%$kunci%' ".
							"OR kontruksi_beton LIKE '%$kunci%' ".
							"OR luas_lantai LIKE '%$kunci%' ".
							"OR alamat LIKE '%$kunci%' ".
							"OR dokumen_tgl LIKE '%$kunci%' ".
							"OR dokumen_nomor LIKE '%$kunci%' ".
							"OR tanah_luas LIKE '%$kunci%' ".
							"OR tanah_status LIKE '%$kunci%' ".
							"OR tanah_kode LIKE '%$kunci%' ".
							"OR tahun_ada LIKE '%$kunci%' ".
							"OR harga LIKE '%$kunci%' ".
							"OR ket LIKE '%$kunci%' ".
							"ORDER BY postdate DESC";
			}
			
			
		
		//query
		$target = "$filenya?katkd=$katkd";
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
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
		<input name="katkd" type="hidden" value="'.$katkd.'">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
			
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">REGISTER</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONDISI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONTRUKSI TINGKAT</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONTRUKSI BETON</font></strong></td>
		<td><strong><font color="'.$warnatext.'">LUAS LANTAI M2</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
		<td><strong><font color="'.$warnatext.'">DOKUMEN TANGGAL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">DOKUMEN NOMOR</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TANAH LUAS M2</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TANAH KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TANAH STATUS</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN PENGADAAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HARGA RP</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KET</font></strong></td>
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
				$i_seknama = balikin($data['sekolah_nama']);
				$i_kode = balikin($data['barang_kode']);
				$i_nama = balikin($data['barang_nama']);
				$i_register = balikin($data['register']);
				$i_kondisi = balikin($data['kondisi']);
				$i_kontruksi_tingkat = balikin($data['kontruksi_tingkat']);
				$i_kontruksi_beton = balikin($data['kontruksi_beton']);
				$i_luas_lantai = balikin($data['luas_lantai']);
				$i_alamat = balikin($data['alamat']);
				$i_dokumen_tgl = balikin($data['dokumen_tgl']);
				$i_dokumen_nomor = balikin($data['dokumen_nomor']);
				$i_tanah_luas = balikin($data['tanah_luas']);
				$i_tanah_status = balikin($data['tanah_status']);
				$i_tanah_kode = balikin($data['tanah_kode']);
				$i_tahun_ada = balikin($data['tahun_ada']);
				$i_harga = balikin($data['harga']);
				$i_ket = balikin($data['ket']);

				$i_postdate = balikin($data['postdate']);
	
				
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_seknama.'</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_register.'</td>
				<td>'.$i_kondisi.'</td>
				<td>'.$i_kontruksi_tingkat.'</td>
				<td>'.$i_kontruksi_beton.'</td>
				<td align="right">'.$i_luas_lantai.' M2</td>
				<td>'.$i_alamat.'</td>
				<td>'.$i_dokumen_tgl.'</td>
				<td>'.$i_dokumen_nomor.'</td>
				<td align="right">'.$i_tanah_luas.' M2</td>
				<td>'.$i_tanah_status.'</td>
				<td>'.$i_tanah_kode.'</td>
				<td>'.$i_tahun_ada.'</td>
				<td align="right">'.xduit3($i_harga).'</td>
				<td>'.$i_ket.'</td>
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










	//jika D /////////////////////////////////////////////////////////////////////////////////////////////
	else if ($katkd == "D")
		{
		$warnatext = "white";
		
		//jika null
		if (empty($kunci))
			{
			$sqlcount = "SELECT * FROM sekolah_kib_d ".
							"ORDER BY postdate DESC";
			}
			
		else
			{
			$sqlcount = "SELECT * FROM sekolah_kib_d ".
							"WHERE barang_kode LIKE '%$kunci%' ".
							"OR sekolah_nama LIKE '%$kunci%' ".
							"OR barang_nama LIKE '%$kunci%' ".
							"OR register LIKE '%$kunci%' ".
							"OR kontruksi LIKE '%$kunci%' ".
							"OR panjang LIKE '%$kunci%' ".
							"OR lebar LIKE '%$kunci%' ".
							"OR luas LIKE '%$kunci%' ".
							"OR lokasi LIKE '%$kunci%' ".
							"OR dokumen_tgl LIKE '%$kunci%' ".
							"OR dokumen_nomor LIKE '%$kunci%' ".
							"OR tanah_status LIKE '%$kunci%' ".
							"OR tanah_kode LIKE '%$kunci%' ".
							"OR asal_usul LIKE '%$kunci%' ".
							"OR tahun_ada LIKE '%$kunci%' ".
							"OR kondisi LIKE '%$kunci%' ".
							"OR harga LIKE '%$kunci%' ".
							"OR ket LIKE '%$kunci%' ".
							"ORDER BY postdate DESC";
			}
			
			
		
		//query
		$target = "$filenya?katkd=$katkd";
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
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
		<input name="katkd" type="hidden" value="'.$katkd.'">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
			
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">REGISTER</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONTRUKSI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">PANJANG (KM)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">LEBAR (M)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">LUAS (M2)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">LETAK/LOKASI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">DOKUMEN TANGGAL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">DOKUMEN NOMOR</font></strong></td>
		<td><strong><font color="'.$warnatext.'">STATUS TANAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE TANAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ASAL_USUL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN PENGADAAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HARGA (RP)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONDISI (B,KB,RB)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KET</font></strong></td>
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
				$i_seknama = balikin($data['sekolah_nama']);
				$i_kode = balikin($data['barang_kode']);
				$i_nama = balikin($data['barang_nama']);
				$i_register = balikin($data['register']);
				$i_kontruksi = balikin($data['kontruksi']);
				$i_panjang = balikin($data['panjang']);
				$i_lebar = balikin($data['lebar']);
				$i_luas = balikin($data['luas']);
				$i_lokasi = balikin($data['lokasi']);
				$i_dokumen_tgl = balikin($data['dokumen_tgl']);
				$i_dokumen_nomor = balikin($data['dokumen_nomor']);
				$i_tanah_status = balikin($data['tanah_status']);
				$i_tanah_kode = balikin($data['tanah_kode']);
				$i_asal_usul = balikin($data['asal_usul']);
				$i_tahun_ada = balikin($data['tahun_ada']);
				$i_harga = balikin($data['harga']);
				$i_kondisi = balikin($data['kondisi']);
				$i_ket = balikin($data['ket']);

				$i_postdate = balikin($data['postdate']);
	
				
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_seknama.'</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_register.'</td>
				<td>'.$i_kontruksi.'</td>
				<td>'.$i_panjang.'</td>
				<td>'.$i_lebar.'</td>
				<td align="right">'.$i_luas.' M2</td>
				<td>'.$i_lokasi.'</td>
				<td>'.$i_dokumen_tgl.'</td>
				<td>'.$i_dokumen_nomor.'</td>
				<td>'.$i_tanah_status.'</td>
				<td>'.$i_tanah_kode.'</td>
				<td>'.$i_asal_usul.'</td>
				<td>'.$i_tahun_ada.'</td>
				<td align="right">'.xduit3($i_harga).'</td>
				<td>'.$i_kondisi.'</td>
				<td>'.$i_ket.'</td>
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





	//jika E /////////////////////////////////////////////////////////////////////////////////////////////
	else if ($katkd == "E")
		{
		$warnatext = "white";
		
		//jika null
		if (empty($kunci))
			{
			$sqlcount = "SELECT * FROM sekolah_kib_e ".
							"ORDER BY postdate DESC";
			}
			
		else
			{
			$sqlcount = "SELECT * FROM sekolah_kib_e ".
							"WHERE barang_kode LIKE '%$kunci%' ".
							"OR sekolah_nama LIKE '%$kunci%' ".
							"OR barang_nama LIKE '%$kunci%' ".
							"OR buku_judul LIKE '%$kunci%' ".
							"OR buku_spek LIKE '%$kunci%' ".
							"OR corak_asal LIKE '%$kunci%' ".
							"OR corak_pencipta LIKE '%$kunci%' ".
							"OR corak_bahan LIKE '%$kunci%' ".
							"OR hewan_jenis LIKE '%$kunci%' ".
							"OR hewan_ukuran LIKE '%$kunci%' ".
							"OR jumlah LIKE '%$kunci%' ".
							"OR tahun_cetak LIKE '%$kunci%' ".
							"OR asal_usul LIKE '%$kunci%' ".
							"OR tahun_beli LIKE '%$kunci%' ".
							"OR harga LIKE '%$kunci%' ".
							"OR ket LIKE '%$kunci%' ".
							"ORDER BY postdate DESC";
			}
			
			
		
		//query
		$target = "$filenya?katkd=$katkd";
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
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
		<input name="katkd" type="hidden" value="'.$katkd.'">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
			
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">REGISTER</font></strong></td>
		<td><strong><font color="'.$warnatext.'">BUKU_JUDUL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">BUKU_SPEK</font></strong></td>
		<td><strong><font color="'.$warnatext.'">CORAK_ASAL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">CORAK_PENCIPTA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">CORAK_BAHAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HEWAN_JENIS</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HEWAN_UKURAN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">JUMLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN CETAK</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ASAL_USUL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN BELI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HARGA(RP)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KET</font></strong></td>
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
				$i_seknama = balikin($data['sekolah_nama']);
				$i_kode = balikin($data['barang_kode']);
				$i_nama = balikin($data['barang_nama']);
				$i_register = balikin($data['register']);
				$i_buku_judul = balikin($data['buku_judul']);
				$i_buku_spek = balikin($data['buku_spek']);
				$i_corak_asal = balikin($data['corak_asal']);
				$i_corak_pencipta = balikin($data['corak_pencipta']);
				$i_corak_bahan = balikin($data['corak_bahan']);
				$i_hewan_jenis = balikin($data['hewan_jenis']);
				$i_hewan_ukuran = balikin($data['hewan_ukuran']);
				$i_jumlah = balikin($data['jumlah']);
				$i_tahun_cetak = balikin($data['tahun_cetak']);
				$i_asal_usul = balikin($data['asal_usul']);
				$i_tahun_beli = balikin($data['tahun_beli']);
				$i_harga = balikin($data['harga']);
				$i_ket = balikin($data['ket']);

				$i_postdate = balikin($data['postdate']);
	
				
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_seknama.'</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_register.'</td>
				<td>'.$i_buku_judul.'</td>
				<td>'.$i_buku_spek.'</td>
				<td>'.$i_corak_asal.'</td>
				<td>'.$i_corak_pencipta.'</td>
				<td>'.$i_corak_bahan.'</td>
				<td>'.$i_hewan_jenis.'</td>
				<td>'.$i_hewan_ukuran.'</td>
				<td>'.$i_jumlah.'</td>
				<td>'.$i_tahun_cetak.'</td>
				<td>'.$i_asal_usul.'</td>
				<td>'.$i_tahun_beli.'</td>
				<td align="right">'.xduit3($i_harga).'</td>
				<td>'.$i_ket.'</td>
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







	//jika F /////////////////////////////////////////////////////////////////////////////////////////////
	else if ($katkd == "F")
		{
		$warnatext = "white";
		
		//jika null
		if (empty($kunci))
			{
			$sqlcount = "SELECT * FROM sekolah_kib_f ".
							"ORDER BY postdate DESC";
			}
			
		else
			{
			$sqlcount = "SELECT * FROM sekolah_kib_f ".
							"WHERE barang_kode LIKE '%$kunci%' ".
							"OR barang_nama LIKE '%$kunci%' ".
							"OR sekolah_nama LIKE '%$kunci%' ".
							"OR kontruksi_tingkat LIKE '%$kunci%' ".
							"OR kontruksi_beton LIKE '%$kunci%' ".
							"OR luas LIKE '%$kunci%' ".
							"OR alamat LIKE '%$kunci%' ".
							"OR dokumen_tgl LIKE '%$kunci%' ".
							"OR dokumen_nomor LIKE '%$kunci%' ".
							"OR mulai_tgl LIKE '%$kunci%' ".
							"OR tanah_status LIKE '%$kunci%' ".
							"OR tanah_kode LIKE '%$kunci%' ".
							"OR asal_usul LIKE '%$kunci%' ".
							"OR harga LIKE '%$kunci%' ".
							"OR ket LIKE '%$kunci%' ".
							"ORDER BY postdate DESC";
			}
			
			
		
		//query
		$target = "$filenya?katkd=$katkd";
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
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
		<input name="katkd" type="hidden" value="'.$katkd.'">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		</p>
			
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SEKOLAH</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td><strong><font color="'.$warnatext.'">REGISTER</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONTRUKSI TINGKAT</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KONTRUKSI BETON</font></strong></td>
		<td><strong><font color="'.$warnatext.'">LUAS(M2)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
		<td><strong><font color="'.$warnatext.'">DOKUMEN TANGGAL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">DOKUMEN NOMOR</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TANGGAL MULAI</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TANAH STATUS</font></strong></td>
		<td><strong><font color="'.$warnatext.'">TAHUN KODE</font></strong></td>
		<td><strong><font color="'.$warnatext.'">ASAL_USUL</font></strong></td>
		<td><strong><font color="'.$warnatext.'">HARGA(RP)</font></strong></td>
		<td><strong><font color="'.$warnatext.'">KET</font></strong></td>
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
				$i_seknama = balikin($data['sekolah_nama']);
				$i_kode = balikin($data['barang_kode']);
				$i_nama = balikin($data['barang_nama']);
				$i_register = balikin($data['register']);
				$i_kontruksi_tingkat = balikin($data['kontruksi_tingkat']);
				$i_kontruksi_beton = balikin($data['kontruksi_beton']);
				$i_luas = balikin($data['luas']);
				$i_alamat = balikin($data['alamat']);
				$i_dokumen_tgl = balikin($data['dokumen_tgl']);
				$i_dokumen_nomor = balikin($data['dokumen_nomor']);
				$i_mulai_tgl = balikin($data['mulai_tgl']);
				$i_tanah_status = balikin($data['tanah_status']);
				$i_tanah_kode = balikin($data['tanah_kode']);
				$i_asal_usul = balikin($data['asal_usul']);
				$i_harga = balikin($data['harga']);
				$i_ket = balikin($data['ket']);

				$i_postdate = balikin($data['postdate']);
	
				
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_seknama.'</td>
				<td>'.$i_kode.'</td>
				<td>'.$i_nama.'</td>
				<td>'.$i_register.'</td>
				<td>'.$i_kontruksi_tingkat.'</td>
				<td>'.$i_kontruksi_beton.'</td>
				<td align="right">'.$i_luas.' M2</td>
				<td>'.$i_alamat.'</td>
				<td>'.$i_dokumen_tgl.'</td>
				<td>'.$i_dokumen_nomor.'</td>
				<td>'.$i_mulai_tgl.'</td>
				<td>'.$i_tanah_status.'</td>
				<td>'.$i_tanah_kode.'</td>
				<td>'.$i_asal_usul.'</td>
				<td align="right">'.xduit3($i_harga).'</td>
				<td>'.$i_ket.'</td>
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






	else
		{
		//ketahui postdate terakhir
		$qku = mysqli_query($koneksi, "SELECT postdate FROM sekolah_kib_a ".
											"ORDER BY postdate DESC");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kib_a = balikin($rku['postdate']);
		
		//ketahui postdate terakhir
		$qku = mysqli_query($koneksi, "SELECT postdate FROM sekolah_kib_b ".
											"ORDER BY postdate DESC");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kib_b = balikin($rku['postdate']);
		
		//ketahui postdate terakhir
		$qku = mysqli_query($koneksi, "SELECT postdate FROM sekolah_kib_c ".
											"ORDER BY postdate DESC");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kib_c = balikin($rku['postdate']);
		
		//ketahui postdate terakhir
		$qku = mysqli_query($koneksi, "SELECT postdate FROM sekolah_kib_d ".
											"ORDER BY postdate DESC");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kib_d = balikin($rku['postdate']);
		
		//ketahui postdate terakhir
		$qku = mysqli_query($koneksi, "SELECT postdate FROM sekolah_kib_e ".
											"ORDER BY postdate DESC");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kib_e = balikin($rku['postdate']);
		
		//ketahui postdate terakhir
		$qku = mysqli_query($koneksi, "SELECT postdate FROM sekolah_kib_f ".
											"ORDER BY postdate DESC");
		$rku = mysqli_fetch_assoc($qku);
		$ku_kib_f = balikin($rku['postdate']);
		
		?>
		
		<h3>UPDATE TERAKHIR :</h3>
			
		<div class="row">
			
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">KIB-A.TANAH</span>
                <span class="info-box-number"><?php echo $ku_kib_a;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">KIB-B.PERALATAN DAN MESIN</span>
                <span class="info-box-number"><?php echo $ku_kib_b;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">KIB-C.GEDUNG DAN BANGUNAN</span>
                <span class="info-box-number"><?php echo $ku_kib_c;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          



          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">KIB-D.JALAN,IRIGASI DAN JARINGAN</span>
                <span class="info-box-number"><?php echo $ku_kib_d;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          



          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">KIB-E.ASET TETAP LAINNYA</span>
                <span class="info-box-number"><?php echo $ku_kib_e;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          


          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">KIB-F.KONTRUKSI DALAM PENYELESAIAN</span>
                <span class="info-box-number"><?php echo $ku_kib_f;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          

          
          <!-- /.col -->
        </div>
        <!-- /.row -->

	<?php
	}

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
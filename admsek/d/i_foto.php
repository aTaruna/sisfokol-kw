<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
	
nocache();




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//lihat gambar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'lihat1'))
	{
	//ambil nilai
	$kd = nosql($_GET['kd']);
	
	//edit
	$qx = mysqli_query($koneksi, "SELECT * FROM sekolah_cp_foto ".
									"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_sekkd = balikin($rowx['sekolah_kd']);


	$e_filex1 = "$kd.png";
	$nil_foto = "$sumber/filebox/foto/$e_sekkd/$kd/$e_filex1";
		
		
	//jika ada
	if (!file_exists($nil_foto))
		{
		$nil_fotox = $nil_foto;
		}
	else
		{
		$nil_fotox = "$sumber/template/img/bg-black.png";
		}
		
		
		

	echo '<img src="'.$nil_fotox.'" height="100">';
	}
	
	
	

?>
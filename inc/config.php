<?php
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



//error reporting //////////////////////////////////////////////////////////////////////////////
//matikan
error_reporting(0);

//tampilkan
//error_reporting(E_ALL & ~E_NOTICE);
//error reporting //////////////////////////////////////////////////////////////////////////////




//ALAMAT SITUS //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sumber = "https://sisfokol-yayasan.software-cgs.my.id";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//KONEKSI DATABASE //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$xhostname = "localhost";
$xdatabase = "sofw9743_sisfokolyayasan"; //sesuaikan dengan nama database yang dibikin
$xusername = "sofw9743_sisfokol-yayasan"; //sesuaikan dengan username mysql-server yang ada
$xpassword = "adminsisfokolyayasan"; //sesuaikan dengan password user mysql-server yang ada
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//SEKOLAH //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sek_nama = "YAYASAN MASJID AL-IMAN";
$sek_alamat = "Cipinang Elok";
$sek_kontak = "(021) 8517963";
$sek_kota = "Cipinang";
$sek_filex = "$sumber/img/logo_al-iman.png";

$sek_filexx = $sek_filex;
//SEKOLAH //////////////////////////////////////////////////////////////////////////////////////////////////////////////






//KEY GOOGLE MAP///////////////////////////////////////////////////////////////////////////////////////////////////////
$keyku = "AIzaSyBZ73oHLqNFmGX6bs3qyyRAoCim-_WxdqQ";
//KEY GOOGLE MAP///////////////////////////////////////////////////////////////////////////////////////////////////////














//JUMLAH DATA per HALAMAN ///////////////////////////////////////////////////////////////////////////////////////////////////////
$limit = "30";  //jumlah data dalam satu halaman
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//KONFIGURASI WARNA TABEL - DATA ////////////////////////////////////////////////////////////////////////////////////////////////
$warna01 = "#9696e0";
$warna02 = "#cecee0";
$warnaover = "#fdff2d";
$warnaheader = "#2a2abd";
$warnatext = "black";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//CHMOD utk. Upload Image ///////////////////////////////////////////////////////////////////////////////////////////////////////
$chmod = 0755;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//Lama-nya session //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sesidt = 3600; //detik
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php
	$work = $_POST['work'];
	$result = "";

	if($work == "default"){
		$result .= "<h4>
					Bukan hanya software dan website
                    <br> kami juga menangani masalah jaringan internet, pengadaan hardware,
                    <br> aplikasi mobile, dan karya seni digital. 
                    </h4>";
		echo $result;
	}

	if($work == "software"){
		$result .= "<h4>
					Pembuatan <strong style='color:#ae6665;'>Software </strong>
					  <br>
					Kami membuat aplikasi untuk desktop dan 
					<br>aplikasi pada android
                    </h4>
                    <span style='text-align:left;'>
	                    <br>-- Desktop Application 
	                    	<br> Seperti progam rental CD, progam kasir.
						<br>-- PoS (Jual beli)
						    <br>&nbsp;&nbsp;&nbsp;
						    POS adalah software yang bisa digunakan untuk menangani proses 
						    <br>transaksi penjualan, pembelian, serta menampilkan laporan-laporan hasil transaksi
						<br>-- Business Intelligence
						<br>-- Sistem informasi
						<br>-- Sistem Penggajian
						<br>-- Sistem Absensi
						<br>-- Digital Signage
						    <br>&nbsp;&nbsp;&nbsp;
						    Papan pengumuman digital yang bisa diakses secara sentral
						<br>-- Dan masih banyak lagi
					</span>
					";
		echo $result;
	}

	if($work == "website"){
		$result .= "<h4>
					Pembuatan <strong style='color:#dfba54;'>Website </strong>
					  <br>
					Tidak tahu cara untuk membuat website yang baik?
					<br><br> Siapapun tolong hubungi ...
					<br><strong>MAXEL </strong>!!!
                    </h4>
                    <span style='text-align:left;'>
	                    <br>-- Company Profile
						<br>-- Online Shop
						<br>-- Web Application
						<br>-- Online Reservation
					</span>";
		echo $result;
	}

	if($work == "internet"){
		$result .= "<h4>
					Jaringan <strong style='color:#DFE32D;'>Internet </strong>
					<br>
					Bahkan masalah hubungan perasaan anda 
					<br>dapat kami tangani. Mau coba?
                    </h4>
                    <span style='text-align:left;'>
	                    <br>-- Setting jaringan
						<br>-- Router
						<br>-- Cabling
						<br>-- Hardware allocation
					</span>";
		echo $result;
	}

	if($work == "hardware"){
		$result .= "<h4>
					Pembelian <strong style='color:#bfdf54;'>Hardware </strong>
					<br>
					  <div class='col-md-12' style='text-align:left;'>
					  	<div class='col-md-2' style='text-align:left;'></div>
					  	<div class='col-md-4' style='text-align:left;margin-left:20%;'>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Aplikasi Desktop
							    <br>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Aplikasi untuk Android
							  <br>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Website
							  <br>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Jaringan Internet
					  	</div>
					  </div>
					  <div class='col-md-12' style='text-align:center;margin-top:-40px;margin-bottom:-10px;'>
						Ummm... Hardware ? 
						<br><strong>Check !!</strong>
						<br><br>
					</div>
                    </h4>
                    <span style='text-align:left;'>
	                    <br><br>-- Pengadaan barang
					</span>";
		echo $result;
	}

	if($work == "design"){
		$result .= "<h4>
					Apa yang ada butuhkan untuk membuat sebuah <strong style='color:#2AB0C5;'>Desain Digital </strong> ??
					<br><br>
					~ dikerjakan oleh anda : <br>
					Ide -> Peralatan -> Kemampuan -> Waktu -> Selesai...
					<br><br>
					~ dikerjakan oleh MAXEL : <br>
					Ide -> Bagikan dengan kami di <strong>Planner</strong> -> Santai.... -> Selesai !!!
                    </h4>
                    <span style='text-align:left;'>
	                    <br>-- Design Logo
						<br>-- Design Web
						<br>-- Design Undangan
						<br>-- Design Kartu nama
						<br>-- 3D Modelling (lihat attachment)
					</span>";
		echo $result;
	}

	if($work == "video"){
		$result .= "<h4>
					Ceritakan dengan semua orang mengenai
					<br>
					pernikahan, ulang tahun ke 17, atau apapun cerita anda
					<br>
					dengan sebuah <strong style='color:#9669FE;'>Video Animasi </strong>
					<br>
					karena kata-kata tidak cukup untuk menggambarkannya.
                    </h4>
                    <span style='text-align:left;'>
	                    <br>-- Wedding animation video 
						<br><iframe width='420' height='250'
								src='https://www.youtube.com/watch?v=R3HR_G2QvxU'>
							</iframe>
						<br>-- Video kenangan  
					</span>";
		echo $result;
	}

?>
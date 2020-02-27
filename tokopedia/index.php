<?php
include '../koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('http://katalogpromosi.com/');
		$obj = json_decode($html,true);
		$no = 0;
		
	
		foreach($html->find('h3[class=entry-title]') as $element){
		$image[] =  $element->plaintext;
		}
	
		

			print_r($image);


		// foreach($html->find('.evo_start ') as $element){
			
		// $hari[] =  $element->find('.day', 0)->plaintext;

		// $tanggal[] =  $element->find('.date', 0)->plaintext;
		// $bulan[] =  $element->find('.month', 0)->plaintext;
		// }


		// print_r($test);
		// print_r($lokasi);
		// // print_r($tanggal);
		
	// foreach($html->find('div[class=col-12 col-sm-6 col-md-4 col-lg-3 mb-2]') as $element)
	// 	{
	// 		$select = mysqli_query($koneksi,"select id_event from event where nama_event =
	// 			'$nama_event[$no]'");	
	// 		$d = mysqli_num_rows($select);
		
	// 	if($d > 0){
	// 		mysqli_query($koneksi, "
	// 			update event set tanggal='$tanggal[$no]',lokasi='$lokasi[$no]', jenis='Pensi' where nama_event='$nama_event[$no]'");
			
		
	// 	} else {
	// 		mysqli_query($koneksi,"insert into event (nama_event, jenis, tanggal, lokasi, link_detail, gambar) values ('$nama_event[$no]','Pensi','$tanggal[$no]',
	// 			'$lokasi[$no]','$link[$no]','$image[$no]')");
			
	// 		// mysqli_query($koneksi,"insert into event (nama_event, jenis, tanggal, lokasi, link_detail, gambar) values ('$nama_event[$no]','pensi','$tanggal[$no]',
	// 		// 	'$lokasi[$no]','$link[$no]','$image[$no]'") or die(mysql_error());
	// 	}
	// 	$no++;
	// 	}

	
	   echo'selesai';
		// header("location:seminar.php");
	   	




	   	   ?>
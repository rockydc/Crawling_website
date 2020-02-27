<?php
include '../koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('https://eventkampus.com/event/kategori/musik');
		$obj = json_decode($html,true);
		$no = 0;
		
	
		foreach($html->find('.lazyload') as $element){
		$image[] =  $element->getAttribute('data-src');
		}
	
		


		foreach($html->find('.cd-beasiswa__judul ') as $element){
			
		$nama_event[] = $element->plaintext;
		}
		

		foreach($html->find('.cd-beasiswa__place') as $element){
		$lokasi[] =  substr(($element->plaintext),5);
	
		}
		

		foreach($html->find('.cd-beasiswa__judul a') as $element){
		$link[] =  $element->href;
	
		}
		

		
		foreach($html->find('div[class=cd-beasiswa__sub mt-auto]') as $element){
		$jenis[] =  $element->find('div[class=mb-2]',0)->plaintext;
		$tanggal[]= substr(($element->find('div[class=mb-2]',1)->plaintext),8);

				
		}


		// foreach($html->find('.evo_start ') as $element){
			
		// $hari[] =  $element->find('.day', 0)->plaintext;

		// $tanggal[] =  $element->find('.date', 0)->plaintext;
		// $bulan[] =  $element->find('.month', 0)->plaintext;
		// }

	foreach($html->find('div[class=col-12 col-sm-6 col-md-4 col-lg-3 mb-2]') as $element){
		$test[] =  $element->plaintext;
	
		}
		// print_r($test);
		// print_r($lokasi);
		// // print_r($tanggal);
		
	foreach($html->find('div[class=col-12 col-sm-6 col-md-4 col-lg-3 mb-2]') as $element)
		{
			$select = mysqli_query($koneksi,"select id_event from event where nama_event =
				'$nama_event[$no]'");	
			$d = mysqli_num_rows($select);
		
		if($d > 0){
			mysqli_query($koneksi, "
				update event set tanggal='$tanggal[$no]',lokasi='$lokasi[$no]', jenis='pensi' where nama_event='$nama_event[$no]'");
			
		
		} else {
			mysqli_query($koneksi,"insert into event (nama_event, jenis, tanggal, lokasi, link_detail, gambar) values ('$nama_event[$no]','pensi','$tanggal[$no]',
				'$lokasi[$no]','$link[$no]','$image[$no]')") ;
			echo $no;
			// mysqli_query($koneksi,"insert into event (nama_event, jenis, tanggal, lokasi, link_detail, gambar) values ('$nama_event[$no]','pensi','$tanggal[$no]',
			// 	'$lokasi[$no]','$link[$no]','$image[$no]'") or die(mysql_error());
		}
		$no++;
		}

	   echo'selesai';
		header("location:pensi.php");




	   	   ?>
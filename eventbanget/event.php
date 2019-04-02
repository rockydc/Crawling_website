<?php
include 'koneksi.php';
		include("simple_html_dom.php");
		$html = file_get_html('http://eventbanget.com/kompetisi/');
		$obj = json_decode($html,true);
		$no = 0;
		
	
	foreach($html->find('.ev_ftImg') as $element){
		$image[] =  $element->getAttribute('data-img');
		}
	


		foreach($html->find('span[class=evcal_desc2 evcal_event_title]') as $element){
			
		$nama_event[] = $element->plaintext;
		}
		

		foreach($html->find('.evo_start ') as $element){
			
		$hari[] =  $element->find('.day', 0)->plaintext;

		$tanggal[] =  $element->find('.date', 0)->plaintext;
		$bulan[] =  $element->find('.month', 0)->plaintext;
		}

		foreach($html->find('span[class=evcal_event_types ett3]') as $element){
			
			
		$lokasi[] = $element->plaintext;
		}
		
		foreach($html->find('.evo_event_schema a') as $element){
			
			
		$link[] = $element->href;
		}
		

		// foreach($html->find('.evcal_cblock .evo_start  ') as $element){
		// $tanggal[] =  $element->find('.day', 0)->plaintext;
		// $waktu[] =  $element->find('.date', 1)->plaintext;
		
		// }
		

			print_r($nama_event);

			echo '<br>';
			echo '<br>';



			print_r($image);

			print_r($hari);
			echo '<br>';
			echo '<br>';

			print_r($bulan);

			print_r($lokasi);
			print_r($link);
		// foreach($html->find('.card-event-body .event-category') as $element){
			
		// $jenis[] = $element->plaintext;
		// }
		
		// foreach($html->find('a[class=card-event uk-link-reset]') as $element){
			
		// $link[] = $element->href;
		// }
		
	
	
		
		// foreach($html->find('.card-event-body') as $element){
		// $select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]' AND jenis = '$jenis[$no]' AND tanggal='$tanggal[$no]'");	
		// $d = mysqli_num_rows($select);
		
		// if($d > 0){
		// }else{
		// 	mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal, waktu, lokasi, link_detail, gambar)values('','$nama_event[$no]','$jenis[$no]','$tanggal[$no]','$waktu[$no]','$lokasi[$no]','$link[$no]','$image[$no]')");
		// }
		// 	$no++;
		// }
	   
		// header("location:accommodation.php");
	   	




	   	   ?>
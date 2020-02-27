<?php
include 'koneksi.php';
		include("simple_html_dom.php");
		$html = file_get_html('https://www.eventbrite.com/d/indonesia/all-events/?page=1');
		$obj = json_decode($html,true);
		$no = 0;
		

		foreach($html->find('eds-media-card-content__image-wrapper') as $element){
		$image[] =  $element->src;
		}
	
		print_r($image)

		// foreach($html->find('.card-event-body .event-title') as $element){
			
		// $nama_event[] = $element->plaintext;
		// }
		
		// foreach($html->find('.card-event-body .event-category') as $element){
			
		// $jenis[] = $element->plaintext;
		// }
		
		// foreach($html->find('a[class=card-event uk-link-reset]') as $element){
			
		// $link[] = $element->href;
		// }
		
		// foreach($html->find('.card-event-body') as $element){
		// $tanggal[] =  $element->find('.detail-value', 0)->plaintext;
		// $waktu[] =  $element->find('.detail-value', 1)->plaintext;
		// $lokasi[] =  $element->find('.detail-value', 2)->plaintext;
		// }
		
		// // print_r($tanggal);
		
		// foreach($html->find('.card-event-body') as $element){
		// $select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]' AND jenis = '$jenis[$no]' AND tanggal='$tanggal[$no]'");	
		// $d = mysqli_num_rows($select);
		
		// if($d > 0){
		// 	mysqli_query($koneksi, "
		// 		update event set tanggal='$tanggal[$no]', jenis='$jenis[$no]' where nama_event='$nama_event[$no] AND jenis!='$jenis[$no]' AND tanggal!='$tanggal[$no]' ");
		// }else{
		// 	mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal, waktu, lokasi, link_detail, gambar)values('','$nama_event[$no]','$jenis[$no]','$tanggal[$no]','$waktu[$no]','$lokasi[$no]','$link[$no]','$image[$no]')");
		// }
		// 	$no++;
		// }
	   
	 //   echo'selesai';
		// // header("location:accommodation.php");
	   	




	   	   ?>
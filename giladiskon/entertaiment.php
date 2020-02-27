<?php


include '../koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('https://www.giladiskon.com/deals/category/entertainment');
		$obj = json_decode($html,true);
		$no = 0;
		$jenis = 'promo';
		
	
		foreach($html->find('.img') as $element){
		$image[] =  'https://giladiskon.com/'.substr(($element->getAttribute('style')),23,-2);
		
		}

		foreach($html->find('span[class=expiry-date]') as $element){
		$tanggal[] = substr(($element->plaintext),0,14).' - '.substr(($element->plaintext),15,-1);
		
		}

		foreach($html->find('div[class=col-8 col-lg-12]') as $element){
		$nama_event[] = substr(($element->plaintext),0,-29);
		
		}


		

		foreach($html->find('div[class=col-12 col-lg-3] a') as $element){
		$link[] =  'https://giladiskon.com'.$element->href;
		
		}	

				print_r($nama_event);	


		foreach($html->find('div[class=col-4 col-lg-12 pr-0 pr-lg-3]') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]' AND jenis = '$jenis' AND tanggal='$tanggal[$no]'");	
		$d = mysqli_num_rows($select);
		
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no], tanggal='$tanggal[$no]', jenis='$jenis',gambar='$image[$no]' where nama_event='$nama_event[$no]'' ");
		}else{
			mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal, lokasi, link_detail, gambar)values('','$nama_event[$no]','$jenis','$tanggal[$no]','','$link[$no]','$image[$no]')");
			$no++;
			
		}
				
		}
	   
		header("location:fashion.php");
	   	

	   	echo 'SELESAI';
?>
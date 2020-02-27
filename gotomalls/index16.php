<?php


include '../koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('https://www.gotomalls.com/promotions?country=Indonesia&lang=id&page=16');
		$obj = json_decode($html,true);
		$no = 0;

		
	
		foreach($html->find('div[class=item-media] img') as $element){
		$image[] =  $element->getAttribute('data-src');
		
		}

		foreach($html->find('h4[class=item-title]') as $element){
		$nama_event[] =  $element->plaintext;
		
		}

		foreach($html->find('p[class=item-expiration-date]') as $element){
		$tanggal[] =  'Berlaku hingga'.' - '.substr($element->plaintext,-17);
		
		}
		foreach($html->find('p[class=item-location truncate]') as $element){
		$lokasi[] =  'https://www.google.co.id/maps/search/'.$element->plaintext;
		
		}

		foreach($html->find('.item-media a') as $element){
		$link[] =  $element->href;
		
		}
		
		print_r($nama_event);

		foreach($html->find('div[class=grid-item-container"]') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]'AND tanggal='$tanggal[$no]'");	
		$d = mysqli_num_rows($select);
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no], tanggal='$tanggal[$no]', jenis='promo',sumber='gotomalls' , gambar='$image[$no]' where nama_event='$nama_event[$no]' ' ");
			echo '<br>';
			echo 'update'.$no;
		
		}else{
			mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal, lokasi, link_detail, gambar,sumber)values('','$nama_event[$no]','promo','$tanggal[$no]','$lokasi[$no]','$link[$no]','$image[$no]','gotomalls')");


			  	echo '<br>';
			echo'save'.$no;

		}  
				$no++;		
		}
	   
		// header("location:konsermusik.php");
	   	echo '<br>';
		echo '============';
	   	echo 'SELESAI bos';
	   	echo '============';
	   ?>
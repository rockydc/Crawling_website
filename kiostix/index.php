<?php


include '../koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('https://www.kiostix.com/id/1/events');
		$obj = json_decode($html,true);
		$no = 0;

		
	
		foreach($html->find('div[class=event-image thumb thumb-small] img') as $element){
		$image[] =  $element->src;
		
		}

		

		foreach($html->find('div[class=event-entry]') as $element){
		$nama_event[] =  $element->plaintext;
		
		}

		
		foreach($html->find('span[class=date start-date]') as $element){
		$tanggal[] =  'Berlaku hingga'.' - '.substr($element->plaintext,7);
		
		}
		
		foreach($html->find('div[class=event-venue]') as $element){
		$lokasi[] =  $element->plaintext;
		
		}

		foreach($html->find('a[class=eventBox]') as $element){
		$link[] =  $element->href;
		
		}
		
		print_r($link);
		


		foreach($html->find('div[class=event-box box flex-center]') as $element){
		$select = mysqli_query($koneksi,'select id_event from event 
			where link_Detail = "'.$link[$no].'"');

		$d = mysqli_num_rows($select);
		// echo $nama_event[$no];
		// echo $d;
	
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no]', tanggal='$tanggal[$no]', sumber='KiosTix', jenis='test', 
				gambar='$image[$no]' where nama_event='$nama_event[$no]'");
			echo '<br>';
			echo 'update'.$no;

		
		}
		else{
			mysqli_query($koneksi,'insert into event (id_event, nama_event, jenis, tanggal, lokasi, link_detail, gambar)values("","'.$nama_event[$no].'","festival","'.$tanggal[$no].'","'.$lokasi[$no].'","'.$link[$no].'","'.$image[$no].'")');


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
	 //   ?>
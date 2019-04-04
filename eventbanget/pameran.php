<?php
include 'koneksi.php';
		include("simple_html_dom.php");
		$html = file_get_html('http://eventbanget.com/pameran/');
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

	
		foreach($html->find('.evo_event_schema a') as $element){
			
			
		$link[] = $element->href;
		}
		
		foreach($html->find('span[class=evcal_event_types ett1]') as $element){
			
			
		$jenis[] = $element->plaintext;
		}
		

		foreach($html->find('.evcal_desc3 ') as $element){
			
		$tempat[] =  $element->plaintext;

	
		}
	
		
		$jmldata =count($nama_event);
		for($x=0; $x<$jmldata; $x++) {

		$mulai[] = $hari[$x].' '.$tanggal[$x].' '.$bulan[$x];
		$str = $tempat[$x];
		$lokasi[]=explode(":",$str);

		}
	
		print_r($nama_event);
		// print_r($lokasi);

		
		foreach($html->find('div[class=eventon_list_event evo_eventtop  event]') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]' AND jenis = '$jenis[$no]' AND tanggal='$mulai[$no]'");	
		$d = mysqli_num_rows($select);
		
		if($d > 0){
		}else{
			mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal, lokasi, link_detail, gambar)values('','$nama_event[$no]','$jenis[$no]','$mulai[$no]','".$lokasi[$no][3]."','$link[$no]','$image[$no]')");
			$no++;
		}
				
		}
	   
		header("location:seminar.php");
	   	
	   	   ?>
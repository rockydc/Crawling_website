<?php


include 'koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('http://katalogpromosi.com/category/event');
		$obj = json_decode($html,true);
		$no = 0;

		
	
		foreach($html->find('a[class=post-img]') as $element){
		$image[] =  substr(($element->getAttribute('style')),23,-3);
		
		}

		foreach($html->find('h2[class=entry-title]') as $element){
		$nama_event[] =  $element->plaintext;
		
		}

		foreach($html->find('h2[class=entry-title] a') as $element){
		$link[] = $element->href;
		}

		foreach($html->find('div[class=date] a') as $element){
		$tanggal = explode(',',($element->plaintext));
		$cek[] = $element->plaintext;
		$waktu =explode(' ',$tanggal[0]);
	
	 	if ($waktu[0]=='January'){

	 		$str=str_replace('January', 'Jan', $waktu[0]);
	 	
	 	} elseif ($waktu[0]=='February') {
	 		$str=str_replace('February', 'Feb', $waktu[0]);
	 	}elseif ($waktu[0]=='March') {
	 		$str=str_replace('March', 'Maret', $waktu[0]);
	 	}elseif ($waktu[0]=='April') {
	 		$str=str_replace('April', 'Apr', $waktu[0]);
	 	}elseif ($waktu[0]=='May') {
	 		$str=str_replace('May', 'May', $waktu[0]);
	 	}elseif ($waktu[0]=='June') {
	 		$str=str_replace('June', 'Jun', $waktu[0]);
	 	}elseif ($waktu[0]=='July') {
	 		$str=str_replace('July', 'Jul', $waktu[0]);
	 	}elseif ($waktu[0]=='August') {
	 		$str=str_replace('August', 'Aug', $waktu[0]);
	 	}elseif ($waktu[0]=='September') {
	 		$str=str_replace('September', 'Sep', $waktu[0]);
	 	}elseif ($waktu[0]=='October') {
	 		$str=str_replace('October', 'Oct', $waktu[0]);
	 	}elseif ($waktu[0]=='November') {
	 		$str=str_replace('November', 'Nov', $waktu[0]);
	 	}else{
	 		$str=str_replace('December', 'Dec', $waktu[0]);
	 	}


	    $fix[] = $waktu[1].' '.$str.' '.'2019';
	    
	 
		}
		
		
print_r($fix);
print_r($cek);
		foreach($html->find('div[class=col-sm-6 col-xxl-4 post-col]') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]'");	

		$d = mysqli_num_rows($select);
		echo $nama_event[$no];
		echo $d;
	
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no]', sumber='KatalogPromosi', jenis='Festival', 
				gambar='$image[$no]', tanggal='$fix[$no]' where link_detail='$link[$no]'");
			echo '<br>';
			echo 'update'.$no;

		
		}
		else{
		mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis,tanggal, link_detail, gambar,sumber)values('',
			'$nama_event[$no]','Festival','$fix[$no]','$link[$no]','$image[$no]','KatalogPromosi');");


			  	echo '<br>';
			echo'save'.$no;



		}  
		$no++;
		}
	   
		header("location:fashion.php");
	   	echo '<br>';
		echo '============';
	   	echo 'SELESAI bos';
	   	echo '============';
	 //   

	

	   	?>
<?php


include 'koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('http://katalogpromosi.com/category/toys-and-game-center');
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


		print_r($link);
		


		foreach($html->find('div[class=col-sm-6 col-xxl-4 post-col]') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where gambar = '$image[$no]'");	

		$d = mysqli_num_rows($select);
		echo $nama_event[$no];
		echo $d;
	
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no]', sumber='KatalogPromosi', jenis='promo', 
				gambar='$image[$no]' where link_detail='$link[$no]'");
			echo '<br>';
			echo 'update'.$no;

		
		}
		else{
		mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, link_detail, gambar,sumber)values('',
			'$nama_event[$no]','Promo','$link[$no]','$image[$no]','KatalogPromosi');");


			  	echo '<br>';
			echo'save'.$no;



		}  
		$no++;
		}
	   
		header("location:travel.php");
	   	echo '<br>';
		echo '============';
	   	echo 'SELESAI bos';
	   	echo '============';
	 //   

	

	   	?>
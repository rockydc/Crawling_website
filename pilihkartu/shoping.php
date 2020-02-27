<?php


include '../koneksi.php';
		include("../simple_html_dom.php");
		$html = file_get_html('https://pilihkartu.com/promo-kategori/shopping');
		$obj = json_decode($html,true);
		$no = 0;
		$a=1;
		$jenis='promo';
		
	
		foreach($html->find('div[class=box-title] h3') as $element){
		$nama_event[] = $element->plaintext;
		
		}

		// print_r($nama_event);


	
		foreach($html->find('img[class=img-responsive]') as $element){
		$image[] = $element->src;
		
		}
		// print_r($image);

		foreach($html->find('div[class=fot-holder] p') as $element){
	
		$tanggal = explode((' '),$element->plaintext);
		$tanggal1[] ='Berlaku Hingga - '.$tanggal[7].' '.substr($tanggal[8],0,3).' '.$tanggal[9];
	
		}
		

		foreach($html->find('div[class=syart] a') as $element){
		$link[] = 'https://pilihkartu.com'.$element->href;
		
		}

		print_r($image);
		foreach($html->find('div[class=holder offer-holder]') as $element){

		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no] '");	

		$d = mysqli_num_rows($select);
		echo $nama_event[$no];
		echo $d;
		echo $no;
	
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no]', tanggal='$tanggal1[$no]', sumber='PilihKartu',link_detail='$link[$no]',
				gambar='$image[$a]', jenis='promo' where link_Detail='$link[$no]'");
			echo '<br>';
			echo 'update'.$no;

		
		}
		else{
		mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal,link_detail, gambar,sumber)values('',
			'$nama_event[$no]','promo','$tanggal1[$no]','$link[$no]','$image[$a]','PilihKartu')");


			  	echo '<br>';
			echo'save'.$no;



		}
		$a++;  
		$no++;
		}
	   	

		// header("location:malang.php");
	   	echo '<br>';
		echo '============';
	   	echo 'SELESAI bos  = ';
	   	echo '============';
	   

	

	   	?>
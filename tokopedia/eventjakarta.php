<?php


include 'koneksi.php';
		include("simple_html_dom.php");
		$html = file_get_html('http://eventjakarta.com/?view_all');
		$obj = json_decode($html,true);
		$no = 0;
		$a=5;
		
	
		foreach($html->find('div[class=desc] h1') as $element){
		$nama_event[] = $element->plaintext;
		
		}

		// print_r($nama_event);



		foreach($html->find('img[class=attachment-thumbnail size-thumbnail wp-post-image]') as $element){
		$image[] = $element->src;
		
		}
		// print_r($image);

		foreach($html->find('div[class=desc] p a') as $element){
		$jenis= explode((','),$element->plaintext);
		$jum = count($jenis);
		}
		print_r($jenis);
		echo $jum;
		// print_r($nama_event);
		// foreach($html->find('div[class=et_home-topevents_item_detail_place]') as $element){
		// $lokasi[] = $element->plaintext;
		
		// }

		// foreach($html->find('div[class=et_home-categorycard_item_social_price]span.format_price') as $element){
		// $harga[] = $element->plaintext;
		
		// }

		
		// foreach($html->find('div[class=et_home-categorycard_item et_home_item_card]') as $element){
		// $link[] = $element->link;
		
		// }
		
		// print_r($harga);

	
		// foreach($html->find('div[class=et_home-categorycard_item et_home_item_card]') as $element){

		// $select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no] '");	

		// $d = mysqli_num_rows($select);
		// echo $nama_event[$no];
		// echo $d;
		// echo $no;
	
		// if($d > 0){

		// 	mysqli_query($koneksi, "
		// 		update event set nama_event='$nama_event[$no]',lokasi ='$lokasi[$no]', tanggal ='$tanggal[$no]', sumber='Tokopedia',link_detail='$link[$no]',harga='$harga[$a]',
		// 		gambar='$image[$no]' where link_Detail='$link[$no]'");
		// 	echo '<br>';
		// 	echo 'update'.$no;

		
		// }
		// else{
		// mysqli_query($koneksi,"insert into event (id_event, nama_event, harga, tanggal, lokasi ,link_detail, gambar,sumber)values('',
		// 	'$nama_event[$no]','$harga[$a]','$tanggal[$no]','$lokasi[$no]','$link[$no]','$image[$no]','Tokopedia')");


		// 	  	echo '<br>';
		// 	echo'save'.$no;



		// }
		// $a++;  
		// $no++;
		// }
	   	

		// // header("location:malang.php");
	 //   	echo '<br>';
		// echo '============';
	 //   	echo 'SELESAI bos  = '.$no;
	 //   	echo '============';
	 //   

	

	   	?>
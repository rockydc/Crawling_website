
<?php
include 'koneksi.php';
		include("simple_html_dom.php");
		$html = file_get_html('https://www.dicoding.com/events?q=&criteria=&sort=&sort_direction=desc&page=2');
		$obj = json_decode($html,true);
		$no = 0;
		
	
		foreach($html->find('.lazy') as $element){
		$image[] =  $element->getAttribute('data-original');
		}
	


		foreach($html->find('.item-box-name') as $element){
			
		$nama_event[] = $element->plaintext;
		}
		
		foreach($html->find('div[class=label label-md label-dicoding-blue]') as $element){
		

		$jenis[] = $element->plaintext;

		}

		foreach($html->find('a[class=item-box-image]') as $element){
		

		$link[] = $element->href;

		}
		
		foreach($html->find('.item-box-extra-information') as $element){
		

		$mulai[] = $element->find('span',0)->plaintext;
		$selesai[] = $element->find('span',1)->plaintext;
		$tempat[] = $element->find('span',4)->plaintext;
		

		
		// $original = $mulai[0];
		// $test = substr($original,8,12);
		// $selesai= substr($original,9,12);
	}	


	$jmldata =count($mulai);
	for($x=0; $x<$jmldata; $x++) {

	$tglmulai=substr($mulai[$x],8,12);
	$tglselesai=substr($selesai[$x],10,13);
	$wktmulai=substr($mulai[$x],-8);
	$wktend=substr($selesai[$x],-8);	
	$lokasi=$tempat[$x];
		// echo $tglmulai,' - ',$tglselesai,':',$wktmulai,'-',$wktend,':',$lokasi;
		// echo '<br>';

	$tanggal[]=$tglmulai.' - '.$tglselesai;
	$waktu[]=$wktmulai.'-'.$wktend;
	
	
	echo '========================'.'<br>';

	}
	
		// echo '<br>';
		// print_r($link).'<br>';
		// echo '<br>';
		// print_r($mulai);
		// echo '<br>';
		// print_r($selesai);
		// echo '<br>';
		// print_r($tempat);
		// echo '<br>';
		// echo '<br>';
		print_r($tanggal);
		print_r($waktu);
		
		foreach($html->find('div[class=item-box item-box-small clearfix]') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]' AND jenis = '$jenis[$no]' AND tanggal='$tanggal[$no]'");	
		$d = mysqli_num_rows($select);
		
		if($d > 0){
		}else{
			mysqli_query($koneksi,"insert into event (id_event, nama_event,jenis,tanggal,waktu,lokasi,link_detail,gambar)values('','$nama_event[$no]','$jenis[$no]','$tanggal[$no]','$waktu[$no]','$tempat[$no]','$link[$no]','$image[$no]')");
		}
			$no++;
		}
	   
 ?>
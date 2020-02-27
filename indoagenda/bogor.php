
<?php


include '../koneksi.php';
		include("simple_html_dom.php");
		$html = file_get_html('https://indoagenda.com/search?kw=&loc=11&waktu=-1');
		$obj = json_decode($html,true);
		$no = 0;
		$a=0;
		
	
		foreach($html->find('div[id=thumbevent] img') as $element){
		$image[] = $element->src;
		
		}

		foreach($html->find('div[id=infoevent] h4') as $element){
		$nama_event[] = $element->plaintext;
		
		}

		foreach($html->find('div[id=infoevent] a') as $element){
		$link[] = $element->href;
		
		}


		
		foreach($html->find('div[id=infoevent] p') as $element){
		$tanggal[] = $element->plaintext;
		$jum = count($tanggal)-1;

		}

 for($a=0;$a<=$jum;$a++)
        {
            if($a % 2 == 0)
                {$tanggals[]= $tanggal[$a];
					$waktu=explode(' ',$tanggal[$a]);
					
					$str=str_replace('Juni', 'Jun', $waktu[1]);
	 	
					if ($waktu[1]=='Januari'){

	 	
	 	} elseif ($waktu[1]=='Februari') {
	 		$str=str_replace('Februari', 'Feb', $waktu[1]);
	 	}elseif ($waktu[1]=='Maret') {
	 		$str=str_replace('Maret', 'Maret', $waktu[1]);
	 	}elseif ($waktu[1]=='April') {
	 		$str=str_replace('April', 'Apr', $waktu[1]);
	 	}elseif ($waktu[1]=='Mei') {
	 		$str=str_replace('Mei', 'May', $waktu[1]);
	 	}elseif ($waktu[1]=='Juni') {
	 		$str=str_replace('Juni', 'Jun', $waktu[1]);
	 	}elseif ($waktu[1]=='Juli') {
	 		$str=str_replace('Juli', 'Jul', $waktu[1]);
	 	}elseif ($waktu[1]=='Agustus') {
	 		$str=str_replace('Agustus', 'Aug', $waktu[1]);
	 	}elseif ($waktu[1]=='September') {
	 		$str=str_replace('September', 'Sep', $waktu[1]);
	 	}elseif ($waktu[1]=='Oktober') {
	 		$str=str_replace('Oktober', 'Oct', $waktu[1]);
	 	}elseif ($waktu[1]=='November') {
	 		$str=str_replace('November', 'Nov', $waktu[1]);
	 	}else{
	 		$str=str_replace('Desember', 'Dec', $waktu[1]);
	 	}

	 	$fix[] =preg_replace("/[^0-9]/","",$waktu[2]).' '.$str.' 2019'.' - '.preg_replace("/[^0-9]/","",$waktu[2]).' '.$str.' 2019 ';
                }
            else
               { 
               	$lokasi[] = $tanggal[$a].', DKI Jakarta';
       			}

        }
		print_r($fix);		
		echo '<br><br>';
		print_r($lokasi);
		echo '<br><br>';
		// echo ' jumlah data'.$a;
		print_r($link);

		foreach($html->find('div[id=event_item]') as $element){

		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no] '");	

		$d = mysqli_num_rows($select);
		echo $nama_event[$no];
		echo $d;
		echo $no;
	
		if($d > 0){

			mysqli_query($koneksi, "
				update event set nama_event='$nama_event[$no]',lokasi ='$lokasi[$no]', tanggal ='$fix[$no]', sumber='IndoAgenda',
				gambar='$image[$no]' where link_detail='$link[$no]'");
			echo '<br>';
			echo 'update'.$no;

		
		}
		else{
		mysqli_query($koneksi,"insert into event (id_event, nama_event, tanggal, lokasi ,link_detail, gambar,sumber)values('',
			'$nama_event[$no]','$fix[$no]','$lokasi[$no]' ,'$link[$no]','$image[$no]','IndoAgenda')");


			  	echo '<br>';
			echo'save'.$no;



		}  
		$no++;
		}
	   	

		header("location:jogja1.php");
	   	echo '<br>';
		echo '============';
	   	echo 'SELESAI bos  = '.$no;
	   	echo '============';
	 //   

	

	   	?>
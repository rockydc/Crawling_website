<?
foreach($html->find('.card-event-body') as $element){
		$select = mysqli_query($koneksi,"select id_event from event where nama_event = '$nama_event[$no]'");	
		$d = mysqli_num_rows($select);
		
		if($d > 0){
			mysqli_query($koneksi, "
				update event set tanggal='$tanggal[$no]',lokasi='$lokasi[$no]' ,waktu='$waktu[$no]', jenis='$jenis[$no]' where nama_event='$nama_event[$no]'");
		}else{
			mysqli_query($koneksi,"insert into event (id_event, nama_event, jenis, tanggal, waktu, lokasi, link_detail, gambar, sumber)values('','$nama_event[$no]','$jenis[$no]','$tanggal[$no]','$waktu[$no]','$lokasi[$no]','$link[$no]','$image[$no]','loket')");
		}
			$no++;
		}
	   
	   echo'selesai';
		// header("location:accommodation.php");
?>	   	




	   	   ?>
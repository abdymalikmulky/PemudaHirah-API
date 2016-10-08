	<?php
	header('Content-Type: application/json');

	include 'lib/shd.php';

	$url =  "http://pemudahijrah.com/";

	$method = $_GET['method'];

	if($method=="rekaman"){
		$urlUse = $url."/rekaman-kajian/";
		
		$html = file_get_html($urlUse);

		foreach($html->find('div.fap-grid-item') as $element) {
			$titles = explode(" &ndash; ", $element->find('h3',0)->plaintext);
			$img = $element->find('img',0)->src;
			$file = $element->find('a',0)->href;
			$title = $titles[0];
			if(count($titles)>1){
				$name = $titles[1];
			}
			
			$data[] = array(
				'rekaman' => 
					array(
						'title' => str_replace("&ndash;","-",trim($title)),
						'name' => str_replace("&ndash;","-",trim($name)),
						'image' => $img,
						'file' => $file
					)
				);
		}

		$data = array('rekamans' => $data);
	}



	$json = json_encode($data);
	echo $json;
?>
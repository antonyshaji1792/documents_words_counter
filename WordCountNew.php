<?php 

// $result = "123";
// $t=time();
// $fileName = "test";
// $filename_result = $t.$fileName;
// $dataset->filename_result = $filename_result;
// $dataset->result = $result;

// echo json_encode($dataset);exit;

session_start();

		// $listarray=array('English','Hebrew','German','Dutch','Spanish-spain','French','Polish', 'Romanian','Korean', 'Swedish','Russian','Japanese','Norwegian','Turkish','Chinese(traditional)','Chinese(simplified)');
		$listarray=array('English');
		$sesslanguage=$_SESSION['language'];
		if(in_array($sesslanguage,$listarray))
		{

		$allowedExts = array("pdf","docx","txt","xls","xlsx","csv","html","odt"); 
		// $allowedExts = array();
		$extension = end(explode(".", $_FILES["file"]["name"]));

			if(isset($_FILES["file"]))
			{
				
				$output_dir1 = "/var/www/vhosts/tomedes.com/pro.tomedes.com/WordCount/REST/Input/";
				$output_dir = "/var/www/vhosts/tomedes.com/pro.tomedes.com/WordCount/REST/Input1/";
				$fileName = $_FILES["file"]["name"];
				//$fileName1 = date("j-n-y_H-i-s").".".$extension;
				$fileName1 = preg_replace('/\s+/', '', $fileName);
				$fileName1 = str_replace(" ", "", $fileName);

				$fileName1 = str_replace("&", "", $fileName1);
				
				$fileName1 = preg_replace('/[^a-zA-Z0-9_.]/', '', $fileName1);
				$t=time();
				$filename_result = $t.$fileName;
				move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir.$t.$fileName);

				if (!copy($output_dir.$t.$fileName, $output_dir.$fileName1)) {
					$filename2 = $fileName1;  
				}else{
					$filename2 = $fileName1;  
				}
				// echo $filename2; die;
				if ( ( in_array($extension, $allowedExts ) ) ) {	
				try {
					
					$inputFilePath = getcwd() ."/". $output_dir.$filename2;

					$inputFile = basename($inputFilePath);

					// echo '<b>Total Word Count from PHYTHON      '.exec("python /var/www/vhosts/clone.tomedes.com/clone/wcnew/count.py $newFileName")."</b><br><br>";
					// $dataset->filename_result = "wptom14_design.txt";
					// $dataset->result = "123";
					
					// echo json_encode($dataset);exit;

					$result = exec("python /var/www/vhosts/tomedes.com/pro.tomedes.com/WordCountNew/EGB/count.py $inputFile");
		
				} catch (Exception $e) {
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}

			// if ( ( !in_array($extension, $allowedExts ) ) &&  ($extension != "txt"))
			// {
			// 	$result = "";
			// }


			$dataset->filename_result = $filename_result;
			$dataset->result = $result;
			
			echo json_encode($dataset);exit;
			// echo $result."##-##".$_FILES["file"]["name"]."##-##".$fileName1 ;
		}
	}

function word_count($str)
	{
		$loc = 0;
		$sp_array = array("~","`",".","_","!","@","#","$","%","^","*","(",")","+","=","-","-","[","]","\\","\'",";","/","{","}","|","\"",":","<",">","?");
		$str = str_replace($sp_array,'',$str);
		$word=explode(" ",$str);
			for($ij=0;$ij<sizeof($word);$ij++)
			{
				if(trim($word[$ij]))
					$loc++;
			}
		return $loc;
	} 	
		?>
		
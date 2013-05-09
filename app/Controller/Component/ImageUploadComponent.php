<?php  
class ImageUploadComponent extends Component { 
 
    function uploadImage($uploadedInfo, $uploadTo, $newImageName){ 
        $webpath = $uploadTo; 
        $upload_dir = WWW_ROOT.str_replace("/", DS, $uploadTo); 
        $upload_path = $upload_dir.DS;             // To specify directories in Cake
        $max_file = "34457280";                         // Sets file size to approx 30MB 
        $max_width = 1200;                              // Max width in pixels of the uploaded file.
        $newImageName = str_replace(' ', '_', $newImageName);
 
        $userfile_name = $uploadedInfo['name']; 
        $userfile_tmp =  $uploadedInfo["tmp_name"]; 
        $userfile_size = $uploadedInfo["size"]; 
        switch($uploadedInfo['type']) {
        // Determine file type and create proper name variable
        	case 'image/gif':
        		$filename = $newImageName.'.gif';
        		break;
        	case 'image/jpeg':
        		$filename = $newImageName.'.jpg';
        		break;
        	case 'image/png':
        		$filename = $newImageName.'.png';
        		break;
        }
        $uploadTarget = $upload_path.$filename; 
 
        if(empty($uploadedInfo)) { 
                  return false; 
                }   
 
        if (isset($uploadedInfo['name'])){ 
            move_uploaded_file($userfile_tmp, $uploadTarget ); 
            //chmod ($uploadTarget , 0777); 
        } 
        return $filename; 
    } 
}
?>
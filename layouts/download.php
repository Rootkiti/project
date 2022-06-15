<?php
include 'connect.php';
// create zip file_exists
$zip_file = 'test/all.zip';
touch($zip_file);
// end

// open zip file

$zip = new ZipArchive;
$this_zip = $zip->open($zip_file,ZipArchive::OVERWRITE);

if($this_zip === TRUE)
    {
    
    
    $id = $_GET['id'];
  //$folder = 'folders/'.$_GET['folder'];
  $query=$db->prepare("SELECT * FROM archives where id= :id");
  $query->execute(array(":id" => $id));
  $list=$query->fetchAll(PDO::FETCH_OBJ);
 foreach ($list as $list2) {
    $folder = $list2->path;
    $fname = $list2->fname;
    $lname = $list2->lname;
    $list2 = $list2->fileName;
    $list3 = explode(",",$list2);
    
    $count = count($list3) - 1;
    
    for ($i = 0; $i<$count; $i++)
               {
                   $file_with_path = $folder.'/'.$list3[$i];
                   $name = $list3[$i];
                   $zip->addFile($file_with_path,$name);
     }
    }
    $zip->close();
}

if(file_exists($zip_file))
    {
        $demo_name = "your_files.zip";
        header('Content-Type: application/zip');
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Disposition: attachment; filename="'.$demo_name.'"');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file);

    }
?>
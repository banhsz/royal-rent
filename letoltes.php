<?php
	session_start(); 
	if (!isset($_SESSION["jogosultsag"])) 
	{
		$_SESSION["jogosultsag"]="vendeg";
		$_SESSION["belepett_id"]="";
		$_SESSION["belepett_felhasznalonev"]="";
	}
    $_SESSION["oldal"]="index";
    if(($_SESSION["jogosultsag"]=="admin" || $_SESSION["jogosultsag"]=="moderátor") && isset($_GET["foglalasID"]) && is_numeric($_GET["foglalasID"]))
    {
        $id = (int)$_GET["foglalasID"];
        $dir = "bizonylatok/$id";
        $zip_file = 'bizonylat.zip';
        // Get real path for our folder
        $rootPath = realpath($dir);
        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
            );
        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }
        // Zip archive will be created only after closing object
        $zip->close();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zip_file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file); 
    }
    else
    {
        echo "<script>window.location.replace('index.php')</script>";
    }
?>
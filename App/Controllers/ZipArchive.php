<?php
namespace App\Controllers;

class ZipArchive
{
    private $zip;
    
    public function __construct()
    {
        $this->zip = new ZipArchive(); 
    }
    
    public function open($filename, $flags)
    {
        return $this->zip->open($filename, $flags);
    }
    
    public function addFile($filename, $localname)
    {
        return $this->zip->addFile($filename, $localname);
    }
    
    public function close()
    {
        return $this->zip->close();
    }
}

?>

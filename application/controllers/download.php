<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class download extends CI_Controller
{
public function index()
        {
            if (null != $this->input->get('className')) {
                 $className = $this->input->get('className');
            }
            if (null != $this->input->get('Angkatan')) {
                $Angkatan = $this->input->get('Angkatan');
            }
           if (isset($className) && isset($Angkatan))
           {
               $file = './uploads/'.$className.'/'.$Angkatan;
           }
           else
           {
            $file="";
           }

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
                        }
                        else
                        {
                            echo $file;
                        }
        }
}
 ?>

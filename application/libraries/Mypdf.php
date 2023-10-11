<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
class Mypdf 
{
  protected $ci;
  public function __construct()
  {
      $this->ci =& get_instance();
  }

  public function generate($view,$data = array())
  {
    $html = $this->ci->load->view($view, $data, TRUE);
    $dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portait');
    // Render the HTML as PDF
    $dompdf->render();
    ob_clean();
    $dompdf->stream("laporan.pdf", array("Attachment" => FALSE));
  }
}

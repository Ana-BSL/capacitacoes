require_once 'capacita/mpdf/autoload.php';

use Mpdf\Mpdf;

$pdf = new Mpdf();
$pdf->WriteHTML('Conteúdo do seu certificado');

$pdf->Output();
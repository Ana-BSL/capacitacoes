require_once 'vendor/autoload.php';

use Mpdf\Mpdf;

$pdf = new Mpdf();
$pdf->WriteHTML('Teste da classe mPDF');

$pdf->Output();
<?php
require_once APPPATH . 'third_party/dompdf/autoload.php';

use Dompdf\Dompdf;

class Pdf
{
    public function generate($html, $filename = '', $paper = '', $orientation = '', $stream = TRUE)
    {
        $pdf = new Dompdf();

        // $options = $pdf->getOptions();
        // $options->setIsHtml5ParserEnabled(true);
        // $options->set('isRemoteEnabled', true);
        // $pdf->setOptions($options);

        $pdf->setPaper($paper, $orientation);
        $pdf->loadHtml($html);
        $pdf->render();

        if ($stream) {
            $pdf->stream($filename . ".pdf", [
                'Attachment' => 0
            ]);
        } else {
            return $pdf->output();
        }
    }
}

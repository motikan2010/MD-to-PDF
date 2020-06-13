<?php


namespace App\Services;


use Dompdf\Dompdf;

class ConvertService
{

    public function convertMdToPdf(string $body) {
        $parsedown = new \Parsedown();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($parsedown->text($body));
        $dompdf->render();
        return $dompdf->output();
    }

}

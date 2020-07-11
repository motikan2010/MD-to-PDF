<?php


namespace App\Services;


use Dompdf\Dompdf;

class ConvertService
{

    /**
     * @param array $mdBodyList
     * @return string|null
     */
    public function convertMdToPdf(array $mdBodyList) {

        // MD to HTML
        $parsedown = new \Parsedown();
        $contentHtmlList = array_map(function ($body) use ($parsedown) { return $parsedown->text($body); }, $mdBodyList);
        $html = $this->generatePdfHtml($contentHtmlList);

        // HTML to PDF
        preg_match_all('/<img src="(.*?)" alt="(.*?)" \/>/', $html, $match);
        foreach ( $match[1] as $imgUrl ) {
            if ( preg_match('/^https?:\/\//', $imgUrl) && in_array(pathinfo($imgUrl, PATHINFO_EXTENSION), ['png','jpg','gif']) ) {
                $html = str_replace($imgUrl, 'data:image/png;base64,' . base64_encode(file_get_contents($imgUrl)), $html);
            } else {
                // TODO
            }
        }
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->output();
    }

    /**
     * @param array $contentHtmlList
     * @return array|string|null
     */
    private function generatePdfHtml(array $contentHtmlList) {
        try {
            return view('pdf.body')->with('result', [
                'content_html_list' => $contentHtmlList,
            ])->render();
        } catch(\Throwable $t) {
            // TODO
            return null;
        }
    }

}

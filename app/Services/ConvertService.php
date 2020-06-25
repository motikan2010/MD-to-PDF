<?php


namespace App\Services;


use Dompdf\Dompdf;

class ConvertService
{

    /**
     * @param string $body
     * @return string|null
     */
    public function convertMdToPdf(string $body) {
        $parsedown = new \Parsedown();
        $contentHtml = $parsedown->text($body);
        $html = $this->generatePdfHtml($contentHtml);
        preg_match_all('/<img src="(.*?)" alt="" \/>/', $html, $match);
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
     * @param $contentHtml
     * @return string
     */
    private function generatePdfHtml($contentHtml) {
        return <<<EOL
<html>
<style>
body {
font-family: ipag;
word-wrap: break-word;
}
img {
max-width: 100%;
height: auto;
}
</style>
<body>
{$contentHtml}
</body>
</html>
EOL;
    }

}

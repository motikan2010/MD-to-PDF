<html>
<style>
  body {
    font-family: ipag, serif;
    word-wrap: break-word;
  }
  img {
    max-width: 100%;
    height: auto;
  }
  pre {
    font-family: ipag, serif;
    padding: 8px;
    overflow: auto;
    font-size: 85%;
    line-height: 1.45;
    background-color: #f6f8fa;
    border-radius: 6px;
  }
  code {
    font-family: ipag, serif;
  }
</style>
<body>
@foreach( $result['content_html_list'] as $i => $contentHtml )
  {!! $contentHtml !!}
  @if( count($result['content_html_list']) - 1  > $i )
    <div style="page-break-before: always;"></div>
  @endif
@endforeach
</body>
</html>

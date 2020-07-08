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
  pre, code {
    font-family: ipag, serif;
    white-space: pre;
    font-size: 0.9em;
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

<html>
<style>
  body {
    font-family: ipag, serif;
    word-wrap: break-word;
  }
  /* Text */
  em {
    font-style: italic;
  }
  strong {
    font-weight: bold;
  }
  /* Block */
  pre {
    font-family: ipag, serif;
    padding: 8px;
    overflow: auto;
    font-size: 85%;
    line-height: 1.45;
    background-color: #f6f8fa;
    border-radius: 6px;
    white-space: pre-wrap;
  }
  code {
    font-family: ipag, serif;
  }
  blockquote {
    padding: 0 1em;
    color: #6a737d;
    border-left: .25em solid #dfe2e5;
  }
  /* Table */
  table {
    border: solid 1px gray;
    border-collapse: collapse;
  }
  th, td {
    padding: 5px;
    border: solid 1px gray;
  }
  /* Image */
  img {
    max-width: 100%;
    height: auto;
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

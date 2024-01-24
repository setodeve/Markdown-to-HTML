<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
	<title>Markdown-to-HTML</title>
	<link href="./lib/index.css" rel="stylesheet" />
  <link rel="icon" href="./lib/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script>hljs.highlightAll();</script>
</head>
<body>
<div id="container">
  <div id="editor-container"></div>
  <div id="show-container">
    <div id="button-container">
      <button onClick="switchtype('preview')">Preview</button>
      <button onClick="switchtype('html')">HTML</button>
      <button onClick="switchtype('download')">Download</button>
    </div>
    <div id="html-container"></div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
<script src="./lib/index.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
	<title>Markdown-to-HTML</title>
	<link href="index.css" rel="stylesheet" />
  <link rel="icon" href="icon.png">
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
<script>
    let editor
    const html = document.getElementById('html-container')
    let type = 'preview'
    window.addEventListener("load", (event) => {
      proceed();
    });
    
    require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs' }});
    require(['vs/editor/editor.main'], function() {
      editor = monaco.editor.create(document.getElementById('editor-container'), {
            value: [
                '',
                '# Title1',
                '## Title2',
                '### Title3',
                "[Github setodeve](https://github.com/setodeve)\n",
                '- section',
                '    - section',
                '         - section',
                '',
                '```javascript',
                'function x() {',
                '\tconsole.log("Hello world!");',
                '}',
                '```',
                '',
                '```diff',
                '+import {test}',
                '-import {test}',
                '```',
                '---'
            ].join('\n'),
            language: 'markdown',
            automaticLayout: true
        });
        monaco.editor.setTheme('default')
        editor.onDidChangeModelContent(e => {
          proceed()
        });

      });
      
    function download_txt(file_name, data) { 
      const blob = new Blob([data], {type: 'text/plain'});
      const url = URL.createObjectURL(blob);
      const a = document.createElement("a");
      document.body.appendChild(a);
      a.download = file_name;
      a.href = url;
      a.click();
      a.remove();
      URL.revokeObjectURL(url);
    }

    function switchtype(tmp){
      type = tmp
      proceed()
    }
    
    function proceed() {
      fetch('api.php', {
          method: 'POST',
          body: JSON.stringify({
            "textData":editor.getValue(),
            "type": type
          })
      })
      .then(response => response.text())
      .then(res => {
        if ((type=="preview") || (type=="download")){
          html.innerHTML = res
          document.querySelectorAll('pre code').forEach((el) => {
            hljs.highlightElement(el);
          });

          if (type=="download"){
            let head = document.createElement('head');
            let style = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">'
            head.innerHTML += style
            html.prepend(head)
            download_txt("test.html",html.innerHTML)
          }
        }else{
          html.innerHTML = res
        }
      })
      .catch(error => {
          console.log(error);
      });
    }

</script>
</body>
</html>
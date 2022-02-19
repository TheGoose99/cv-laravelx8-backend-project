<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.tiny.cloud/1/68iykg2ijhkivveikgjrn93qc6yii2z83chrafont44jidj7/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
        tinymce.activeEditor.uploadImages(function(success) {
            document.forms[0].submit();
        });
    </script>
</head>
<body>
    <h1>TinyMCE Quick Start Guide</h1>
    <form method="post">
        <textarea id="mytextarea" name="mytextarea">Hello, World!</textarea>
    </form>
</body>
</html>
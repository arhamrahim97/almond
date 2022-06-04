<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>jQuery File Upload Example</title>
</head>

<style>
    .file {
        position: relative;
        background: linear-gradient(to right, lightblue 50%, transparent 50%);
        background-size: 200% 100%;
        background-position: right bottom;
        transition: all 1s ease;
    }

    .file.done {
        background: lightgreen;
    }

    .file a {
        display: block;
        position: relative;
        padding: 5px;
        color: black;
    }

</style>

<body>
    <form method="POST" enctype="multipart/form-data" action="{{ url('aset-tidak-bergerak') }}" id="test">
        @csrf
        <input id="fileupload" type="file" name="files[]" data-url="//jquery-file-upload.appspot.com/" multiple>
        {{-- submit --}}
        <input type="submit" value="Upload">
    </form>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://blueimp.github.io/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="https://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload.js"></script>
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
    <script src="js/jquery.fileupload.js"></script>
    <script>
        $("#fileupload").fileupload({
            dataType: "json",
            add: function(e, data) {
                data.context = $('<p class="file"></p>')
                    .append($('<a target="_blank"></a>').text(data.files[0].name))
                    .appendTo(document.body);
                data.submit();
            },
            progress: function(e, data) {
                var progress = parseInt((data.loaded / data.total) * 100, 10);
                data.context.css("background-position-x", 100 - progress + "%");
            },
            done: function(e, data) {
                data.context
                    .addClass("done")
                    .find("a")
                    .prop("href", data.result.files[0].url);
            }
        });
    </script>
</body>

</html>

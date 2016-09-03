<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<!-- <div id="queue"></div> -->
		<input id="file_upload" name="music_upload" type="file" multiple="false">
	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'fileTypeDesc' : 'Music Files',
        		'fileTypeExts' : '*.mp3',
        		'fileSizeLimit' : '10MB',
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php',
				'buttonClass' : 'some-class',
				//'buttonCursor' : '',
				//'buttonImage' : '',
				'buttonText' : 'asdasdsd',
				'onUploadSuccess' : function(file, data, response) {
		            alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
		        }
			});
		});
	</script>
</body>
</html>
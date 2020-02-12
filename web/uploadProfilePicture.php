
<?php
require 'vendor/autoload.php';
?>
<?php
	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];
		$temp_file_location = $_FILES['image']['tmp_name'];



		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-2',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIAJ3XKZF2KD4RNHOTQ",
				'secret' => "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",
			]
		]);

		$result = $s3->putObject([
			'Bucket' => 'bear-link',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location,
      'ACL'    => 'public-read'
		]);
$profilepicture = $result->get('ObjectURL');
}
else {
	echo "Error uploading picture";
}

  ?>
  <html>
  <p>This is your profile picture<p>
  <img src="<?php echo $profilepicture; ?>">
</html>

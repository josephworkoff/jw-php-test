<?php
	/*if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];
		$temp_file_location = $_FILES['image']['tmp_name'];

		require 'vendor/autoload.php';

    $s3 = new Aws\S3\S3Client([
      'version'  => 'latest',
      'region'   => 'us-east-1',
  ]);
  $bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
  ?>
<?php
try {
		$result = $s3->putObject([
			'Bucket' => $bucket,
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location
		]);
}
		var_dump($result);
	} */
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
	<input type="file" name="image" />
	<input type="submit"/>
</form>

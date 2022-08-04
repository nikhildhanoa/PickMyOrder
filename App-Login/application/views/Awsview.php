<?php
include APPPATH . 'third_party/aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$s3Client = new S3Client([
		'version' => 'latest',
		'region'  => 'eu-west-2',
		'credentials' => [
			'key'    => 'AKIAYBHU5TTPYJHCIU7M',
			'secret' => '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'
		]
	]);
	  
	  
	$bucket = 'pmo-s3-json-input-bucket';
	$file_Path = __DIR__ . '/my-image.png';
	$key = basename($file_Path);
	  
	// Upload a publicly accessible file. The file size and type are determined by the SDK.
	try {
		$result = $s3Client->putObject([
			'Bucket' => $bucket,
			'Key'    => $key,
			'Body'   => fopen($file_Path, 'r'),
			'ACL'    => 'public-read', // make file 'public'
		]);
		return "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
	} catch (Aws\S3\Exception\S3Exception $e) {
		return "There was an error uploading the file.\n";
		return $e->getMessage();
	}	
			
		
	

?>
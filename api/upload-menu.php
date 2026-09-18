<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['menu'])) { http_response_code(400); echo json_encode(['ok'=>false,'message'=>'Choose a menu image first.']); exit; }
$file = $_FILES['menu']; $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/gif'=>'gif','image/webp'=>'webp'];
if ($file['error'] !== UPLOAD_ERR_OK) { echo json_encode(['ok'=>false,'message'=>'Upload failed.']); exit; }
if ($file['size'] > 8 * 1024 * 1024) { echo json_encode(['ok'=>false,'message'=>'Please keep images under 8 MB.']); exit; }
$info = @getimagesize($file['tmp_name']); $mime = $info['mime'] ?? '';
if (!$info || !isset($allowed[$mime])) { echo json_encode(['ok'=>false,'message'=>'Use JPG, PNG, GIF or WEBP.']); exit; }
$destination = __DIR__ . '/../assets/images/menu.jpg';
$image = @imagecreatefromstring(file_get_contents($file['tmp_name']));
if (!$image || !function_exists('imagejpeg')) { echo json_encode(['ok'=>false,'message'=>'PHP GD is required to convert the uploaded image to JPG.']); exit; }
$width = imagesx($image); $height = imagesy($image); $canvas = imagecreatetruecolor($width, $height); $white = imagecolorallocate($canvas, 255, 255, 255); imagefill($canvas, 0, 0, $white); imagecopy($canvas, $image, 0, 0, 0, 0, $width, $height); $ok = imagejpeg($canvas, $destination, 90); imagedestroy($image); imagedestroy($canvas);
echo json_encode(['ok'=>$ok,'message'=>$ok?'Menu uploaded and converted to JPG.':'Could not save the menu image.','path'=>'assets/images/menu.jpg']);

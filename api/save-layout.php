<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['ok'=>false,'message'=>'POST required']); exit; }
$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data) || !isset($data['dishes']) || !is_array($data['dishes'])) { http_response_code(422); echo json_encode(['ok'=>false,'message'=>'Invalid layout data']); exit; }
foreach ($data['dishes'] as &$dish) { foreach (['nx','ny','radius','scale'] as $key) if (isset($dish[$key])) $dish[$key] = max(0, min(1, (float)$dish[$key])); }
$path = __DIR__ . '/../assets/targets/layout.json';
$written = file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
if ($written === false) { http_response_code(500); echo json_encode(['ok'=>false,'message'=>'Layout folder is not writable']); exit; }
echo json_encode(['ok'=>true,'message'=>'Layout saved']);

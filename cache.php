<?php
// cache.php - 处理图片缓存请求
header('Content-Type: application/json');

// 获取图片ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id < 1 || $id > 210) {
    echo json_encode(['success' => false, 'message' => '无效的图片ID']);
    exit;
}

// 远程图片URL
$remoteUrl = "https://jp.5213140.xyz/{$id}.php?bt=安生";

// 本地保存路径
$localPath = "images/{$id}.jpg";

// 检查是否已存在
if (file_exists($localPath)) {
    echo json_encode(['success' => true, 'message' => '图片已存在', 'cached' => true]);
    exit;
}

// 确保目录存在
if (!is_dir('images')) {
    mkdir('images', 0777, true);
}

// 下载图片
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $remoteUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; ImageCache/1.0)');

$imageData = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200 && !empty($imageData)) {
    // 保存图片
    file_put_contents($localPath, $imageData);
    echo json_encode(['success' => true, 'message' => '缓存成功', 'id' => $id]);
} else {
    echo json_encode(['success' => false, 'message' => '下载失败', 'httpCode' => $httpCode]);
}
?>
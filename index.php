<?php
$menuImage = file_exists(__DIR__ . '/assets/images/menu.jpg') ? 'assets/images/menu.jpg' : 'assets/images/menu.svg';
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$arUrl = $baseUrl . '/ar.php';
$menuUrl = $baseUrl . '/menu.php';
$qrUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $menuUrl;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Plates in the Air | Web AR Menu</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="landing">
  <header class="site-header"><a class="brand" href="index.php"><span class="brand-mark">P</span><span>Plates in the Air</span></a><a class="text-link" href="compile.php">Operator tools <span>↗</span></a></header>
  <main class="home-grid">
    <section class="hero-copy"><p class="eyebrow">TABLESIDE WEB AR · 01</p><h1>Let the menu<br><em>come alive.</em></h1><p class="lede">A playful, camera-first menu for curious diners. Point your phone at a dish and meet it in three dimensions.</p><div class="hero-actions"><a class="button button-primary" href="menu.php">Display menu <span>→</span></a><a class="button button-quiet" href="ar.php">Scan menu in AR <span>⌁</span></a></div><div class="flow"><span>1</span><p>Open on your phone</p><i></i><span>2</span><p>Allow camera access</p><i></i><span>3</span><p>Point at a dish</p></div></section>
    <section class="poster-stage"><div class="poster-blob"></div><div class="poster-card"><img src="<?= htmlspecialchars($menuImage) ?>" alt="Plates in the Air food menu poster"></div><div class="float-note note-top">SCAN<br><strong>THE PLATE</strong></div><div class="float-note note-bottom">14 dishes<br><strong>∞ possibilities</strong></div></section>
  </main>
  <section class="home-lower"><div><p class="eyebrow">THE SHORT VERSION</p><h2>Real food. A little<br><em>extra dimension.</em></h2></div><div class="lower-right"><p>Scan the printed menu, move closer to a food photo, and watch the selected dish spin above the table. There is no app to install.</p><a class="button button-dark" href="<?= htmlspecialchars($arUrl) ?>">Prepare the experience <span>→</span></a></div><div class="qr-panel"><div class="qr" data-qr-value="<?= htmlspecialchars($qrUrl) ?>"></div><span>SCAN TO OPEN MENU</span></div></section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script><script>window.AR_QR_URL=<?= json_encode($qrUrl) ?>;</script><script src="assets/js/qr.js"></script>
</body>
</html>
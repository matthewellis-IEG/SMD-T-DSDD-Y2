<?php
// header.php
// Expect a $pageTitle variable to be set by the including page
if (!isset($pageTitle)) {
$pageTitle = 'Default title';
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
<h1><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
</header>
<main class="site-grid">
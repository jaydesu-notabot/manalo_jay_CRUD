<?php $isEdit = !empty($product); $value = function ($key) use ($product) { return htmlspecialchars((string) ($product[$key] ?? ''), ENT_QUOTES, 'UTF-8'); }; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($heading) ?> | Products</title>
    <link rel="stylesheet" href="<?= site_url('/css/app.css') ?>">
</head>
<body>
<main class="panel form-card">
    <p class="eyebrow">Inventory workspace</p>
    <h1><?= htmlspecialchars($heading) ?></h1>
    <p class="lead">Add clear details so your inventory stays accurate.</p>
    <form action="<?= htmlspecialchars($formAction) ?>" method="post">
        <label for="product_name">Product name</label>
        <input id="product_name" name="product_name" maxlength="100" value="<?= $value('product_name') ?>" required>
        <label for="description">Description</label>
        <textarea id="description" name="description"><?= $value('description') ?></textarea>
        <label for="price">Price</label>
        <input id="price" name="price" type="number" min="0" step="0.01" value="<?= $value('price') ?>" required>
        <label for="quantity">Quantity</label>
        <input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= $value('quantity') ?>" required>
        <div class="form-actions"><button type="submit"><?= $isEdit ? 'Update product' : 'Save product' ?> <span aria-hidden="true">→</span></button><a class="cancel" href="<?= site_url('/products') ?>">Cancel</a></div>
    </form>
</main>
</body>
</html>

<?php function product_escape($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); } ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Products | Inventory</title>
    <link rel="stylesheet" href="<?= site_url('/css/app.css') ?>">
</head>
<body>
<div class="confirm-backdrop" id="delete-confirmation" hidden>
    <section class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="delete-title">
        <h2 id="delete-title">Delete product?</h2>
        <p>This action cannot be undone. The product will be permanently removed.</p>
        <div class="confirm-actions">
            <button class="cancel" type="button" id="cancel-delete">Cancel</button>
            <a class="delete" id="confirm-delete" href="#">Delete product</a>
        </div>
    </section>
</div>
<main class="page-shell">
    <header class="topbar">
        <div><a class="brand" href="<?= site_url('/products') ?>">PRODUCTS<span class="brand-dot">.</span></a><p class="eyebrow product-intro">Inventory overview</p><h1>Your products.</h1><p class="lead">Keep your stock organized and up to date.</p></div>
        <div class="toolbar"><a class="button" href="<?= site_url('/products/create') ?>">＋ Add product</a><a class="logout" href="<?= site_url('/logout') ?>">Log out</a></div>
    </header>
    <?php if (!empty($message)): ?><div class="toast" role="status"><span><?= product_escape($message) ?></span><button class="toast-close" type="button" aria-label="Close notification" onclick="this.parentElement.remove()">×</button></div><?php endif; ?>
    <section class="panel table-wrap">
        <?php if (empty($products)): ?>
            <div class="empty"><strong>No products yet.</strong><br>Add your first item to start managing inventory.</div>
        <?php else: ?>
        <table><thead><tr><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th>Actions</th></tr></thead><tbody>
        <?php foreach ($products as $product): ?><tr><td><strong><?= product_escape($product['product_name']) ?></strong></td><td><?= nl2br(product_escape($product['description'])) ?></td><td><?= number_format((float) $product['price'], 2) ?></td><td><?= product_escape($product['quantity']) ?></td><td><?= product_escape($product['created_at']) ?></td><td class="actions"><a href="<?= site_url('/products/edit/' . (int) $product['id']) ?>">Edit</a><a class="delete delete-trigger" href="<?= site_url('/products/delete/' . (int) $product['id']) ?>">Delete</a></td></tr><?php endforeach; ?>
        </tbody></table>
        <?php endif; ?>
    </section>
</main>
<script>
const confirmation = document.getElementById('delete-confirmation');
const confirmDelete = document.getElementById('confirm-delete');
const cancelDelete = document.getElementById('cancel-delete');
document.querySelectorAll('.delete-trigger').forEach((trigger) => {
    trigger.addEventListener('click', (event) => {
        event.preventDefault();
        confirmDelete.href = trigger.href;
        confirmation.hidden = false;
    });
});
cancelDelete.addEventListener('click', () => { confirmation.hidden = true; });
confirmation.addEventListener('click', (event) => {
    if (event.target === confirmation) confirmation.hidden = true;
});
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') confirmation.hidden = true;
});
</script>
</body>
</html>

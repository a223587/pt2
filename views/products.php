<?php
ob_start();
?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Products</h2>
        <p class="text-muted mb-0">Manage and track all your portable Wi-Fi hotspots</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <!-- Form Header -->
        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>
                    <?php echo isset($aproduct) ? 'Edit Product' : 'Product Form'; ?>
                </h5>
                <small class="text-muted">Fill in the details of a product</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">* Required fields</span>
            </div>
        </div>

        <hr>

        <form action="<?= BASE_URL ?>productcontroller/<?= isset($aproduct) ? 'update' : 'save' ?>" method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="pid" class="form-label">Product ID <span class="text-danger">*</span></label>
                    <input name="product_num" id="pid" type="text" class="form-control" placeholder="Enter Product ID"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_num']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="product_name" id="name" type="text" class="form-control" placeholder="Enter Product Name"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_name']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                    <input name="product_price" id="price" type="number" class="form-control" placeholder="Enter Price" min="0" step="0.01"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_price']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="brand" class="form-label">Brand <span class="text-danger">*</span></label>
                    <?php
                    $brands = ['Huawei', 'ZTE', 'TP-Link', 'Netgear', 'Novatel', 'Generic'];
                    $selectedBrand = $aproduct['fld_product_brand'] ?? '';
                    ?>
                    <select name="product_brand" id="brand" class="form-select" required>
                        <option value="">Select Brand</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= htmlspecialchars($brand) ?>" <?= $selectedBrand === $brand ? 'selected' : '' ?>><?= htmlspecialchars($brand) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="network" class="form-label">Network Type <span class="text-danger">*</span></label>
                    <?php
                    $networks = ['3G', '4G LTE', '4G LTE-A', '5G'];
                    $selectedNetwork = $aproduct['fld_product_network'] ?? '';
                    ?>
                    <select name="product_network" id="network" class="form-select" required>
                        <option value="">Select Network Type</option>
                        <?php foreach ($networks as $network): ?>
                            <option value="<?= htmlspecialchars($network) ?>" <?= $selectedNetwork === $network ? 'selected' : '' ?>><?= htmlspecialchars($network) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="wifi" class="form-label">Wi-Fi Standard <span class="text-danger">*</span></label>
                    <?php
                    $wifis = ['Wi-Fi 4', 'Wi-Fi 5', 'Wi-Fi 6', 'Wi-Fi 6E'];
                    $selectedWifi = $aproduct['fld_product_wifi'] ?? '';
                    ?>
                    <select name="product_wifi" id="wifi" class="form-select" required>
                        <option value="">Select Wi-Fi Standard</option>
                        <?php foreach ($wifis as $wifi): ?>
                            <option value="<?= htmlspecialchars($wifi) ?>" <?= $selectedWifi === $wifi ? 'selected' : '' ?>><?= htmlspecialchars($wifi) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input name="product_quantity" id="quantity" type="number" class="form-control" placeholder="Enter Quantity" min="0"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_quantity']) : ''; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="product_image" class="form-label">Image</label>
                    <input name="product_image" id="product_image" type="text" class="form-control" placeholder="Enter image filename"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_image'] ?? '') : ''; ?>">
                </div>
            </div>

            <?php if (isset($aproduct)): ?>
                <input type="hidden" name="original_product_num" value="<?php echo htmlspecialchars($aproduct['fld_product_num']); ?>">
            <?php endif; ?>

            <hr class="mt-4 mb-3">

            <div>
                <button type="submit" name="<?= isset($aproduct) ? 'update' : 'create' ?>" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i><?= isset($aproduct) ? 'Update' : 'Create' ?>
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-table text-primary me-2"></i>
                    Product List
                </h5>
                <small class="text-muted">View and manage all products in the inventory</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Total: <?= count($products ?? []) ?> items</span>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['fld_product_num']); ?></td>
                        <td><?php echo htmlspecialchars($product['fld_product_name']); ?></td>
                        <td>RM <?php echo number_format((float)$product['fld_product_price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($product['fld_product_brand']); ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>productcontroller/edit/<?php echo htmlspecialchars($product['fld_product_num']); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= BASE_URL ?>images/<?= htmlspecialchars($product['fld_product_image'] ?? '') ?>" target="_blank" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-image"></i>
                            </a>
                            <a href="<?= BASE_URL ?>productcontroller/delete/<?= htmlspecialchars($product['fld_product_num']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No products found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="text-center container py-4" style="max-width: 1100px;">
    <!-- SECTION 1: TODAY'S SALES -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <h1>Today's Sales</h1>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle" style="font-size: 0.85rem;">
                    Total Nilai Penjualan Hari ini
                </div>
                <div class="card-body bg-white py-4">
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">Rp <?php echo e(number_format($ringkasan['total_penjualan'] ?? 0, 0, ',', '.')); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle" style="font-size: 0.85rem;">
                    Jumlah Transaksi Hari ini
                </div>
                <div class="card-body bg-white py-4">
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;"><?php echo e($ringkasan['total_transaksi'] ?? 0); ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 2: CASH & PAYMENT STATUS -->
    <div class="row mt-2">
        <div class="col-md-12 mb-3">
            <h1>Cash & Payment Status</h1>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle" style="font-size: 0.85rem;">
                    Total pembayaran tunai
                </div>
                <div class="card-body bg-white py-4">
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">Rp <?php echo e(number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.')); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle" style="font-size: 0.85rem;">
                    Total pembayaran non-tunai
                </div>
                <div class="card-body bg-white py-4">
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">Rp <?php echo e(number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.')); ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: CRITICAL INVENTORY STATUS -->
    <div class="row mt-2">
        <div class="col-md-12 mb-3">
            <h1>Critical Inventory Status</h1>
        </div>
        
        <!-- Box Tabel 1: Daftar Produk Stok Rendah -->
        <div class="col-md-6 mb-4 text-start">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle text-center" style="font-size: 0.85rem; font-weight: 500;">
                    Daftar produk stok rendah
                </div>
                <div class="card-body bg-white p-3">
                    <div class="table-responsive">
                        <table class="table align-middle mb-2" style="font-size: 0.9rem;">
                            <thead>
                                <tr class="text-secondary" style="font-size: 0.85rem;">
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" class="text-center" style="width: 65%">Nama</th>
                                    <th scope="col" class="text-end" style="width: 25%">Stok</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php if(isset($produkStokRendah) && count($produkStokRendah) > 0): ?>
                                    <?php $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($produkStokRendah->firstItem() + $index); ?></td>
                                            <td class="text-center text-muted"><?php echo e($produk->nama); ?></td>
                                            <td class="text-end fw-semibold text-dark"><?php echo e($produk->stok); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-3">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 0.8rem;">
                        <div class="text-muted small">
                            Showing <?php echo e(isset($produkStokRendah) ? $produkStokRendah->firstItem() : 0); ?> to <?php echo e(isset($produkStokRendah) ? $produkStokRendah->lastItem() : 0); ?> of <?php echo e(isset($produkStokRendah) ? $produkStokRendah->total() : 0); ?> results
                        </div>
                        <div>
                            <?php echo e(isset($produkStokRendah) ? $produkStokRendah->links('pagination::bootstrap-4') : ''); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Box Tabel 2: Produk Habis Stok -->
        <div class="col-md-6 mb-4 text-start">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle text-center" style="font-size: 0.85rem; font-weight: 500;">
                    Produk habis stok
                </div>
                <div class="card-body bg-white p-3">
                    <div class="table-responsive">
                        <table class="table align-middle mb-2" style="font-size: 0.9rem;">
                            <thead>
                                <tr class="text-secondary" style="font-size: 0.85rem;">
                                    <th scope="col" style="width: 10%">#</th>
                                    <th scope="col" class="text-center" style="width: 65%">Nama</th>
                                    <th scope="col" class="text-end" style="width: 25%">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($produkStokHabis) && count($produkStokHabis) > 0): ?>
                                    <?php $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($produkStokHabis->firstItem() + $index); ?></td>
                                            <td class="text-center text-muted"><?php echo e($produk->nama); ?></td>
                                            <td class="text-end fw-semibold text-dark"><?php echo e($produk->stok); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-3">
                                            Tidak ada produk dengan stok habis.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 0.8rem;">
                        <div class="text-muted small">
                            Showing <?php echo e(isset($produkStokHabis) ? $produkStokHabis->firstItem() : 0); ?> to <?php echo e(isset($produkStokHabis) ? $produkStokHabis->lastItem() : 0); ?> of <?php echo e(isset($produkStokHabis) ? $produkStokHabis->total() : 0); ?> results
                        </div>
                        <div>
                            <?php echo e(isset($produkStokHabis) ? $produkStokHabis->links('pagination::bootstrap-4') : ''); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 4: BEST SELLER PRODUCTS -->
    <div class="row mt-2">
        <div class="col-md-12 mb-3">
            <h1>Best Seller Products</h1>
        </div>
        <div class="col-md-12 text-start">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-dark text-white py-2" style="font-size: 0.85rem;">
                    Daftar Produk Terlaris Hari Ini
                </div>
                <div class="card-body bg-white p-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                            <thead class="table-light">
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS\resources\views/dashboard.blade.php ENDPATH**/ ?>
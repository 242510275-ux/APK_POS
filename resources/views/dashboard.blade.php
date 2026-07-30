@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

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
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">Rp {{ number_format($ringkasan['total_penjualan'] ?? 0, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle" style="font-size: 0.85rem;">
                    Jumlah Transaksi Hari ini
                </div>
                <div class="card-body bg-white py-4">
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">{{ $ringkasan['total_transaksi'] ?? 0 }}</h5>
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
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">Rp {{ number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border border-secondary-subtle" style="border-radius: 6px; overflow: hidden;">
                <div class="card-header bg-body-secondary text-dark py-2 border-bottom border-secondary-subtle" style="font-size: 0.85rem;">
                    Total pembayaran non-tunai
                </div>
                <div class="card-body bg-white py-4">
                    <h5 class="card-title fw-bold my-0" style="font-size: 1.6rem;">Rp {{ number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.') }}</h5>
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
                                @if(isset($produkStokRendah) && count($produkStokRendah) > 0)
                                    @foreach ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="text-center text-muted">{{ $produk->nama }}</td>
                                            <td class="text-end fw-semibold text-dark">{{ $produk->stok }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-3">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 0.8rem;">
                        <div class="text-muted small">
                            Showing {{ isset($produkStokRendah) ? $produkStokRendah->firstItem() : 0 }} to {{ isset($produkStokRendah) ? $produkStokRendah->lastItem() : 0 }} of {{ isset($produkStokRendah) ? $produkStokRendah->total() : 0 }} results
                        </div>
                        <div>
                            {{ isset($produkStokRendah) ? $produkStokRendah->links('pagination::bootstrap-4') : '' }}
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
                                @if(isset($produkStokHabis) && count($produkStokHabis) > 0)
                                    @foreach ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="text-center text-muted">{{ $produk->nama }}</td>
                                            <td class="text-end fw-semibold text-dark">{{ $produk->stok }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-3">
                                            Tidak ada produk dengan stok habis.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2" style="font-size: 0.8rem;">
                        <div class="text-muted small">
                            Showing {{ isset($produkStokHabis) ? $produkStokHabis->firstItem() : 0 }} to {{ isset($produkStokHabis) ? $produkStokHabis->lastItem() : 0 }} of {{ isset($produkStokHabis) ? $produkStokHabis->total() : 0 }} results
                        </div>
                        <div>
                            {{ isset($produkStokHabis) ? $produkStokHabis->links('pagination::bootstrap-4') : '' }}
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
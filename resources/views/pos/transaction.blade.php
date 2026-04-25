@extends('layouts.app')

@section('title', 'Kasir / POS')
@section('page-title')
    🛒 <span>Kasir</span> POS
@endsection

@push('styles')
<style>
    [x-cloak] { display: none !important; }

    .pos-container {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 20px;
        height: calc(100vh - var(--topbar-h) - 40px);
        overflow: hidden;
    }

    @media (max-width: 1024px) {
        .pos-container {
            grid-template-columns: 1fr;
            height: auto;
            overflow: visible;
        }
        .cart-section {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 60px;
            border-radius: 0;
            flex-direction: row;
        }
        .cart-header, .cart-items, .summary-row, .summary-total {
            display: none;
        }
        .cart-footer {
            width: 100%;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            background: #fff;
        }
        .checkout-btn {
            margin-top: 0;
        }
    }

    /* Product Grid Side */
    .product-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
        overflow: hidden;
    }

    .category-scroll {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 5px;
        scrollbar-width: none;
    }
    .category-scroll::-webkit-scrollbar { display: none; }

    .category-pill {
        padding: 8px 18px;
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 99px;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-500);
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s;
    }
    .category-pill.active {
        background: var(--brand-500);
        border-color: var(--brand-500);
        color: #fff;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.25);
    }

    .pos-product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 15px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .pos-product-card {
        background: #fff;
        border-radius: 15px;
        border: 1px solid var(--gray-200);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
    }
    .pos-product-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: var(--brand-300);
    }
    .pos-product-image {
        width: 100%;
        aspect-ratio: 1/1;
        background: var(--gray-100);
        overflow: hidden;
        position: relative;
    }
    .pos-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .pos-product-info {
        padding: 12px;
    }
    .pos-product-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--dark-800);
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 34px;
    }
    .pos-product-price {
        font-size: 14px;
        font-weight: 800;
        color: var(--brand-600);
    }
    .pos-product-stock {
        font-size: 11px;
        color: var(--gray-400);
        margin-top: 4px;
    }

    /* Cart Side */
    .cart-section {
        background: #fff;
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .cart-header {
        padding: 18px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .cart-items {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .cart-item {
        display: flex;
        gap: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-100);
    }
    .cart-item-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        overflow: hidden;
        background: var(--gray-100);
    }
    .cart-item-image img { width: 100%; height: 100%; object-fit: cover; }
    .cart-item-info { flex: 1; }
    .cart-item-name { font-size: 13px; font-weight: 700; color: var(--dark-800); margin-bottom: 2px; }
    .cart-item-price { font-size: 12px; color: var(--gray-500); }
    .cart-item-qty {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
    }
    .qty-btn {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        border: 1px solid var(--gray-200);
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
    }
    .qty-btn:hover { background: var(--gray-100); }

    .cart-footer {
        padding: 18px;
        background: var(--gray-100);
        border-top: 1px solid var(--gray-200);
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
        color: var(--gray-500);
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px dashed var(--gray-300);
        font-size: 18px;
        font-weight: 800;
        color: var(--dark-800);
    }

    .checkout-btn {
        margin-top: 18px;
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--brand-500), var(--brand-700));
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
        transition: all 0.2s;
    }
    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }
    .checkout-btn:disabled {
        background: var(--gray-300);
        box-shadow: none;
        cursor: not-allowed;
    }

    /* Payment Modal Styles */
    .cash-nominal-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 15px;
    }
    .nominal-btn {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        padding: 12px;
        font-size: 14px;
        font-weight: 700;
        color: var(--dark-700);
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .nominal-btn:hover {
        border-color: var(--brand-400);
        background: var(--brand-50);
        color: var(--brand-600);
        transform: translateY(-2px);
    }
    .nominal-btn.active {
        background: var(--brand-500);
        border-color: var(--brand-500);
        color: #fff;
    }
    .nominal-btn .icon { font-size: 16px; opacity: 0.7; }

    .payment-input-wrapper {
        position: relative;
        margin-bottom: 20px;
    }
    .payment-input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: var(--gray-400);
    }
    .payment-input {
        width: 100%;
        height: 60px;
        padding-left: 50px;
        font-size: 24px;
        font-weight: 800;
        border-radius: 16px;
        border: 2px solid var(--gray-100);
        background: var(--gray-50);
        color: var(--dark-800);
        transition: all 0.2s;
    }
    .payment-input:focus {
        border-color: var(--brand-500);
        background: #fff;
        box-shadow: 0 0 0 4px var(--brand-50);
        outline: none;
    }

    /* Modal Overlay */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(8px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* Animation */
    .modal-enter { opacity: 0; transform: scale(0.9); }
    .modal-enter-active { transition: all 0.3s ease-out; }
    .modal-enter-to { opacity: 1; transform: scale(1); }
</style>
@endpush

@section('content')
<div class="pos-container" x-data="posSystem()">
    
    {{-- Left: Products Section --}}
    <div class="product-section">
        {{-- Search and Categories --}}
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <div style="position: relative;">
                <span style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--gray-400);">🔍</span>
                <input type="text" x-model="search" placeholder="Cari nama produk atau scan barcode..." 
                    class="form-control" style="padding-left: 42px; height: 48px; border-radius: 12px; background: #fff;">
            </div>

            <div class="category-scroll">
                <div class="category-pill" :class="selectedCategory === null ? 'active' : ''" @click="selectedCategory = null">
                    Semua Produk
                </div>
                @foreach($categories as $cat)
                <div class="category-pill" :class="selectedCategory === {{ $cat->id }} ? 'active' : ''" @click="selectedCategory = {{ $cat->id }}">
                    {{ $cat->name }}
                </div>
                @endforeach
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="pos-product-grid">
            <template x-for="product in filteredProducts()" :key="product.id">
                <div class="pos-product-card" @click="addToCart(product)">
                    <div class="pos-product-image">
                        <img :src="product.image_url" :alt="product.name" x-on:error="$el.src = '{{ asset('images/product-placeholder.png') }}'">
                        <template x-if="product.stock <= product.min_stock">
                            <div style="position: absolute; top: 8px; left: 8px; background: var(--danger); color: #fff; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 4px;">LIMIT</div>
                        </template>
                    </div>
                    <div class="pos-product-info">
                        <div class="pos-product-name" x-text="product.name"></div>
                        <div class="pos-product-price" x-text="formatCurrency(product.sell_price)"></div>
                        <div class="pos-product-stock" x-text="'Stok: ' + product.stock"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Right: Cart Section --}}
    <div class="cart-section">
        <div class="cart-header">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--dark-800);">Pesanan Baru</h3>
            <button @click="clearCart()" style="background: none; border: none; color: var(--danger); font-size: 12px; font-weight: 600; cursor: pointer;">Hapus Semua</button>
        </div>

        <div class="cart-items">
            <template x-if="cart.length === 0">
                <div style="text-align: center; padding-top: 50px; color: var(--gray-400);">
                    <div style="font-size: 40px; margin-bottom: 10px;">🛒</div>
                    <p>Keranjang masih kosong</p>
                </div>
            </template>

            <template x-for="(item, index) in cart" :key="item.id">
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img :src="item.image_url" :alt="item.name" x-on:error="$el.src = '{{ asset('images/product-placeholder.png') }}'">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-name" x-text="item.name"></div>
                        <div class="cart-item-price" x-text="formatCurrency(item.sell_price)"></div>
                        <div class="cart-item-qty">
                            <button class="qty-btn" @click="updateQty(index, -1)">-</button>
                            <span style="font-weight: 700; font-size: 14px; min-width: 20px; text-align: center;" x-text="item.qty"></span>
                            <button class="qty-btn" @click="updateQty(index, 1)">+</button>
                        </div>
                    </div>
                    <div style="text-align: right; display: flex; flex-direction: column; justify-content: space-between; align-items: flex-end;">
                        <div style="font-size: 13px; font-weight: 700; color: var(--dark-800);" x-text="formatCurrency(item.sell_price * item.qty)"></div>
                        <button @click="removeFromCart(index)" style="background: none; border: none; color: var(--gray-400); cursor: pointer; margin-top: 5px;">🗑️</button>
                    </div>
                </div>
                {{-- Notes Input --}}
                <div style="margin: -10px 15px 15px 75px;">
                    <input type="text" x-model="item.notes" placeholder="Tambah catatan (misal: Less sugar, extra ice...)" 
                        style="width: 100%; border: none; border-bottom: 1px solid var(--gray-100); font-size: 11px; padding: 4px 0; background: transparent; outline: none; color: var(--gray-500);">
                </div>
            </template>
        </div>

        {{-- General Order Note --}}
        <div style="padding: 15px; border-top: 1px solid var(--gray-100); background: var(--gray-50);">
            <label style="display: block; font-size: 11px; font-weight: 800; color: var(--gray-400); text-transform: uppercase; margin-bottom: 8px;">Catatan Pesanan (Umum)</label>
            <textarea x-model="orderNotes" rows="2" placeholder="Contoh: Meja nomor 5, bawa perlahan..." 
                style="width: 100%; border: 1px solid var(--gray-200); border-radius: 8px; padding: 8px 12px; font-size: 13px; outline: none; background: #fff; color: var(--dark-700); resize: none;"></textarea>
        </div>

        {{-- Member Selection --}}
        <div style="padding: 15px; border-top: 1px solid var(--gray-100);">
            <div style="display: flex; gap: 8px;">
                <div style="flex: 1; position: relative;">
                    <select x-model="memberId" class="form-select" style="width: 100%; height: 40px;">
                        <option value="">Pilih Member (Opsional)</option>
                        @foreach($members as $m)
                        <option value="{{ $m->id }}">{{ $m->member_name }} - {{ $m->member_code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="cart-footer">
            {{-- Promo Code Input --}}
            <div style="margin-bottom: 15px; display: flex; gap: 8px;">
                <input type="text" x-model="promoCodeInput" placeholder="Kode Promo" 
                    class="form-control" style="height: 38px; font-size: 13px;" :disabled="appliedPromo">
                <button @click="applyPromo()" class="btn btn-primary" style="height: 38px; padding: 0 15px; font-size: 13px; width: auto;" 
                    x-show="!appliedPromo" :disabled="!promoCodeInput">Pakai</button>
                <button @click="removePromo()" class="btn" style="height: 38px; padding: 0 10px; font-size: 13px; width: auto; background: var(--gray-200);" 
                    x-show="appliedPromo">✕</button>
            </div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span x-text="formatCurrency(subtotal)"></span>
            </div>
            <div class="summary-row">
                <span>Pajak (10%)</span>
                <span x-text="formatCurrency(tax)"></span>
            </div>
            <div class="summary-row" x-show="memberDiscount > 0">
                <span>Diskon Member</span>
                <span style="color: var(--danger);" x-text="'-' + formatCurrency(memberDiscount)"></span>
            </div>
            <div class="summary-row" x-show="promoDiscount > 0">
                <span x-text="'Promo (' + appliedPromo.code + ')'"></span>
                <span style="color: var(--danger);" x-text="'-' + formatCurrency(promoDiscount)"></span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span x-text="formatCurrency(total)"></span>
            </div>

            <button class="checkout-btn" :disabled="cart.length === 0" @click.stop="showPaymentModal = true">
                Bayar Sekarang
            </button>
        </div>
    </div>

    {{-- Payment Modal --}}
    <div class="modal-overlay" 
         x-show="showPaymentModal" 
         x-transition:enter="modal-enter-active"
         x-transition:enter-start="modal-enter"
         x-transition:enter-end="modal-enter-to"
         x-cloak>
        <div class="card" style="width: 100%; max-width: 480px; padding: 0; overflow: hidden;" @click.outside="showPaymentModal = false">
            <div class="card-header" style="background: var(--dark-800); color: #fff;">
                <div class="card-title" style="color: #fff;">Pembayaran</div>
                <button @click="showPaymentModal = false" style="background: none; border: none; color: #fff; cursor: pointer; font-size: 20px;">✕</button>
            </div>
            <div class="card-body" style="padding: 24px;">
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="font-size: 14px; color: var(--gray-500); margin-bottom: 5px;">Total Tagihan</div>
                    <div style="font-size: 32px; font-weight: 800; color: var(--brand-600);" x-text="formatCurrency(total)"></div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="form-label">Metode Pembayaran</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <button class="quick-btn" :class="paymentMethod === 'cash' ? 'active' : ''" @click="paymentMethod = 'cash'" 
                            style="flex-direction: row; padding: 12px; justify-content: flex-start; gap: 10px;"
                            :style="paymentMethod === 'cash' ? 'border-color: var(--brand-500); background: var(--brand-50);' : ''">
                            <span style="font-size: 20px;">💵</span> <span>Tunai</span>
                        </button>
                        <button class="quick-btn" :class="paymentMethod === 'qris' ? 'active' : ''" @click="paymentMethod = 'qris'" 
                            style="flex-direction: row; padding: 12px; justify-content: flex-start; gap: 10px;"
                            :style="paymentMethod === 'qris' ? 'border-color: var(--brand-500); background: var(--brand-50);' : ''">
                            <span style="font-size: 20px;">📱</span> <span>QRIS</span>
                        </button>
                        <button class="quick-btn" :class="paymentMethod === 'card' ? 'active' : ''" @click="paymentMethod = 'card'" 
                            style="flex-direction: row; padding: 12px; justify-content: flex-start; gap: 10px;"
                            :style="paymentMethod === 'card' ? 'border-color: var(--brand-500); background: var(--brand-50);' : ''">
                            <span style="font-size: 20px;">💳</span> <span>Kartu</span>
                        </button>
                        <button class="quick-btn" :class="paymentMethod === 'e-wallet' ? 'active' : ''" @click="paymentMethod = 'e-wallet'" 
                            style="flex-direction: row; padding: 12px; justify-content: flex-start; gap: 10px;"
                            :style="paymentMethod === 'e-wallet' ? 'border-color: var(--brand-500); background: var(--brand-50);' : ''">
                            <span style="font-size: 20px;">📲</span> <span>E-Wallet</span>
                        </button>
                    </div>
                </div>

                <div x-show="paymentMethod === 'cash'">
                    <label class="form-label" style="margin-bottom: 12px; display: block;">Uang Diterima (Bayar)</label>
                    <div class="payment-input-wrapper">
                        <span class="payment-input-icon">Rp</span>
                        <input type="number" x-model="cashReceived" class="payment-input" placeholder="0">
                    </div>

                    <div class="cash-nominal-grid">
                        <button class="nominal-btn" :class="cashReceived == 20000 ? 'active' : ''" @click="cashReceived = 20000">
                            <span class="icon">💵</span> 20.000
                        </button>
                        <button class="nominal-btn" :class="cashReceived == 50000 ? 'active' : ''" @click="cashReceived = 50000">
                            <span class="icon">💵</span> 50.000
                        </button>
                        <button class="nominal-btn" :class="cashReceived == 100000 ? 'active' : ''" @click="cashReceived = 100000">
                            <span class="icon">💵</span> 100.000
                        </button>
                        <button class="nominal-btn" :class="cashReceived == total ? 'active' : ''" @click="cashReceived = total">
                            <span class="icon">✨</span> Uang Pas
                        </button>
                    </div>

                    <div style="margin-top: 24px; padding: 20px; background: #f8fafc; border: 1px solid var(--gray-100); border-radius: 16px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-size: 12px; color: var(--gray-400); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Kembalian</div>
                            <div style="font-size: 20px; font-weight: 800; color: var(--success); margin-top: 4px;" x-text="formatCurrency(Math.max(0, cashReceived - total))"></div>
                        </div>
                        <div style="font-size: 32px; opacity: 0.2;">💰</div>
                    </div>
                </div>

                <button class="checkout-btn" style="margin-top: 24px;" @click="processPayment()" :disabled="paymentMethod === 'cash' && cashReceived < total">
                    Selesaikan Transaksi
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function posSystem() {
        return {
            products: @json($products),
            cart: [],
            search: '',
            selectedCategory: null,
            memberId: '',
            promoCodeInput: '',
            appliedPromo: null,
            paymentMethod: 'cash',
            cashReceived: 0,
            showPaymentModal: false,
            orderNotes: '',
            
            filteredProducts() {
                return this.products.filter(p => {
                    const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase()) || p.sku.toLowerCase().includes(this.search.toLowerCase());
                    const matchCategory = this.selectedCategory === null || p.category_id === this.selectedCategory;
                    return matchSearch && matchCategory;
                });
            },

            addToCart(product) {
                if (product.stock <= 0) {
                    alert('Stok produk habis!');
                    return;
                }
                
                const index = this.cart.findIndex(item => item.id === product.id);
                if (index !== -1) {
                    if (this.cart[index].qty < product.stock) {
                        this.cart[index].qty++;
                    } else {
                        alert('Batas stok tercapai');
                    }
                } else {
                    this.cart.push({
                        ...product,
                        qty: 1,
                        notes: ''
                    });
                }
            },

            updateQty(index, delta) {
                const item = this.cart[index];
                if (delta > 0 && item.qty >= item.stock) {
                    alert('Batas stok tercapai');
                    return;
                }
                item.qty += delta;
                if (item.qty <= 0) this.removeFromCart(index);
            },

            removeFromCart(index) {
                this.cart.splice(index, 1);
            },

            clearCart() {
                if (confirm('Hapus semua item?')) {
                    this.cart = [];
                    this.removePromo();
                }
            },

            async applyPromo() {
                if (!this.promoCodeInput) return;
                
                try {
                    const response = await fetch('{{ route("pos.promotions.validate") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            code: this.promoCodeInput,
                            amount: this.subtotal - this.memberDiscount
                        })
                    });
                    
                    const result = await response.json();
                    if (result.success) {
                        this.appliedPromo = result.data;
                        alert('Promo berhasil digunakan: ' + result.data.name);
                    } else {
                        alert(result.message);
                    }
                } catch (error) {
                    console.error(error);
                    alert('Gagal memvalidasi promo');
                }
            },

            removePromo() {
                this.appliedPromo = null;
                this.promoCodeInput = '';
            },

            get subtotal() {
                return this.cart.reduce((sum, item) => sum + (item.sell_price * item.qty), 0);
            },

            get tax() {
                return (this.subtotal - this.memberDiscount - this.promoDiscount) * 0.1;
            },

            get memberDiscount() {
                // Find member discount from data
                const member = @json($members).find(m => m.id == this.memberId);
                return member ? (this.subtotal * member.discount_percentage / 100) : 0;
            },

            get promoDiscount() {
                return this.appliedPromo ? this.appliedPromo.discount : 0;
            },

            get total() {
                return (this.subtotal - this.memberDiscount - this.promoDiscount) + this.tax;
            },

            formatCurrency(val) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(val);
            },

            async processPayment() {
                try {
                    const payload = {
                        member_id: this.memberId,
                        promotion_code: this.appliedPromo ? this.appliedPromo.code : null,
                        payment_method: this.paymentMethod,
                        payment_status: 'completed',
                        notes: this.orderNotes,
                        items: this.cart.map(item => ({
                            product_id: item.id,
                            quantity: item.qty,
                            unit_price: item.sell_price,
                            notes: item.notes
                        }))
                    };

                    const response = await fetch('{{ route("pos.transaction.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();
                    if (result.success) {
                        alert('Transaksi Berhasil! Kode: ' + result.data.transaction_code);
                        this.cart = [];
                        this.appliedPromo = null;
                        this.promoCodeInput = '';
                        this.showPaymentModal = false;
                        this.cashReceived = 0;
                        location.reload(); 
                    } else {
                        alert('Gagal: ' + result.message);
                    }
                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan sistem');
                }
            }
        }
    }
</script>
@endpush

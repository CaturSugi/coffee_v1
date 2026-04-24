@extends('layouts.app')

@section('title', 'POS - Sistem Penjualan')

@section('content')
<div x-data="posSystem()" class="min-h-screen bg-gray-100 p-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        
        <!-- Main Product Area -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-4">
                <!-- Header -->
                <div class="mb-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">POS - BRAN COFFEE n CO</h1>
                    <div class="text-sm text-gray-600">
                        <span id="current-time"></span>
                    </div>
                </div>

                <!-- Search & Filter -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <input 
                        type="text" 
                        x-model="search" 
                        placeholder="Cari produk..."
                        @input="searchProducts()"
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                    
                    <select 
                        x-model="selectedCategory"
                        @change="filterByCategory()"
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <input 
                        type="text" 
                        placeholder="Cari member..."
                        @input="searchMember($event.target.value)"
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>

                <!-- Member Display -->
                <div x-show="selectedMember" class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-blue-900" x-text="selectedMember?.name"></p>
                            <p class="text-sm text-blue-700">
                                <span x-text="'Kode: ' + selectedMember?.code"></span> | 
                                <span x-text="'Tier: ' + selectedMember?.tier"></span> | 
                                <span x-text="'Diskon: ' + selectedMember?.discount + '%'"></span>
                            </p>
                        </div>
                        <button @click="selectedMember = null" class="text-blue-600 hover:text-blue-800">
                            ✕
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div class="bg-white border rounded-lg p-3 hover:shadow-lg transition cursor-pointer"
                             @click="addToCart(product)">
                            <div class="aspect-square bg-gray-200 rounded mb-2 flex items-center justify-center">
                                <img x-show="product.image" :src="'/storage/' + product.image" class="w-full h-full object-cover rounded">
                                <span x-show="!product.image" class="text-gray-400">Tidak ada gambar</span>
                            </div>
                            <p class="font-semibold text-sm" x-text="product.name"></p>
                            <p class="text-amber-600 font-bold" x-text="'Rp ' + formatCurrency(product.sell_price)"></p>
                            <p class="text-xs text-gray-500" x-text="'Stok: ' + product.stock"></p>
                            <button @click="addToCart(product)" class="mt-2 w-full bg-amber-500 hover:bg-amber-600 text-white py-1 rounded text-sm">
                                + Keranjang
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Cart Area -->
        <div class="bg-white rounded-lg shadow-lg p-4 sticky top-4">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Keranjang Belanja</h2>

            <!-- Cart Items -->
            <div class="border rounded-lg p-3 mb-4 max-h-96 overflow-y-auto" style="min-height: 300px;">
                <template x-show="cartItems.length === 0">
                    <p class="text-center text-gray-500">Keranjang kosong</p>
                </template>

                <template x-for="(item, index) in cartItems" :key="index">
                    <div class="border-b pb-3 mb-3">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold text-sm" x-text="item.name"></p>
                                <p class="text-amber-600 text-sm" x-text="'Rp ' + formatCurrency(item.price)"></p>
                            </div>
                            <button @click="removeFromCart(index)" class="text-red-500 hover:text-red-700">
                                ✕
                            </button>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-2">
                            <button @click="decreaseQuantity(index)" class="px-2 py-1 bg-gray-200 rounded">-</button>
                            <input type="number" x-model.number="item.quantity" @change="updateCart()" class="w-12 text-center border rounded">
                            <button @click="increaseQuantity(index)" class="px-2 py-1 bg-gray-200 rounded">+</button>
                        </div>

                        <div class="flex gap-2 mb-2">
                            <input type="number" x-model.number="item.price" @change="updateCart()" placeholder="Harga" class="flex-1 text-sm border rounded px-2 py-1" step="100">
                            <input type="text" x-model="item.notes" placeholder="Catatan" class="flex-1 text-sm border rounded px-2 py-1">
                        </div>

                        <p class="text-right text-sm font-semibold" x-text="'Subtotal: Rp ' + formatCurrency(item.subtotal)"></p>
                    </div>
                </template>
            </div>

            <!-- Promo Code -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Kode Promo</label>
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        x-model="promoCode" 
                        placeholder="Masukkan kode promo"
                        class="flex-1 px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                    <button @click="validatePromo()" class="px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded text-sm">
                        Terapkan
                    </button>
                </div>
                <p x-show="promoMessage" :class="{'text-green-600': promoValid, 'text-red-600': !promoValid}" class="mt-1 text-xs">
                    <span x-text="promoMessage"></span>
                </p>
            </div>

            <!-- Summary -->
            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span>Subtotal:</span>
                    <span x-text="'Rp ' + formatCurrency(subtotal)"></span>
                </div>

                <div x-show="discount > 0" class="flex justify-between text-sm text-red-600">
                    <span>Diskon:</span>
                    <span x-text="'- Rp ' + formatCurrency(discount)"></span>
                </div>

                <div class="flex justify-between text-sm">
                    <span>PPN (10%):</span>
                    <span x-text="'Rp ' + formatCurrency(tax)"></span>
                </div>

                <div class="flex justify-between text-lg font-bold border-t pt-2">
                    <span>TOTAL:</span>
                    <span class="text-amber-600" x-text="'Rp ' + formatCurrency(total)"></span>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="mt-4 mb-4">
                <label class="block text-sm font-semibold mb-2">Metode Pembayaran</label>
                <select x-model="paymentMethod" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <option value="cash">💵 Tunai</option>
                    <option value="card">💳 Kartu</option>
                    <option value="e-wallet">📱 E-Wallet</option>
                    <option value="qris">📲 QRIS</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2 mb-3">
                <button @click="clearCart()" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded font-semibold">
                    Bersihkan
                </button>
                <button @click="saveTransaction()" :disabled="cartItems.length === 0" class="flex-1 px-4 py-2 bg-green-500 hover:bg-green-600 disabled:bg-gray-300 text-white rounded font-semibold">
                    Simpan Transaksi
                </button>
            </div>

            <!-- Print Options (show after transaction saved) -->
            <div x-show="lastTransactionId" class="space-y-2">
                <button @click="printThermal()" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded font-semibold">
                    🖨️ Cetak Thermal
                </button>
                <button @click="printBluetooth()" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded font-semibold">
                    📡 Cetak Bluetooth
                </button>
                <button @click="downloadPDF()" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded font-semibold">
                    📄 Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function posSystem() {
    return {
        search: '',
        selectedCategory: '',
        cartItems: [],
        filteredProducts: @json($products),
        allProducts: @json($products),
        selectedMember: null,
        promoCode: '',
        promoMessage: '',
        promoValid: false,
        paymentMethod: 'cash',
        lastTransactionId: null,

        // Computed
        get subtotal() {
            return this.cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        },

        get memberDiscount() {
            return this.selectedMember ? this.selectedMember.discount : 0;
        },

        get discount() {
            let discount = (this.subtotal * this.memberDiscount) / 100;
            if (this.promoValid) {
                discount += (this.subtotal * 5) / 100; // Example promo value
            }
            return discount;
        },

        get tax() {
            return ((this.subtotal - this.discount) * 10) / 100;
        },

        get total() {
            return this.subtotal - this.discount + this.tax;
        },

        // Methods
        searchProducts() {
            if (this.search === '') {
                this.filteredProducts = this.selectedCategory 
                    ? this.allProducts.filter(p => p.category_id === parseInt(this.selectedCategory))
                    : this.allProducts;
            } else {
                this.filteredProducts = this.allProducts.filter(p =>
                    p.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    p.sku.toLowerCase().includes(this.search.toLowerCase())
                );
            }
        },

        filterByCategory() {
            this.searchProducts();
        },

        addToCart(product) {
            const existing = this.cartItems.find(item => item.product_id === product.id);
            
            if (existing) {
                existing.quantity++;
                existing.subtotal = existing.price * existing.quantity;
            } else {
                this.cartItems.push({
                    product_id: product.id,
                    name: product.name,
                    price: product.sell_price,
                    quantity: 1,
                    subtotal: product.sell_price,
                    notes: ''
                });
            }
            this.updateCart();
        },

        removeFromCart(index) {
            this.cartItems.splice(index, 1);
            this.updateCart();
        },

        increaseQuantity(index) {
            if (this.cartItems[index].quantity < 999) {
                this.cartItems[index].quantity++;
                this.updateCart();
            }
        },

        decreaseQuantity(index) {
            if (this.cartItems[index].quantity > 1) {
                this.cartItems[index].quantity--;
                this.updateCart();
            }
        },

        updateCart() {
            this.cartItems.forEach(item => {
                item.subtotal = item.price * item.quantity;
            });
            this.$nextTick(() => this.$watch);
        },

        clearCart() {
            if (confirm('Apakah Anda yakin ingin menghapus semua item?')) {
                this.cartItems = [];
                this.lastTransactionId = null;
                this.selectedMember = null;
                this.promoCode = '';
                this.promoMessage = '';
            }
        },

        searchMember(query) {
            if (query.length < 2) return;

            fetch(`{{ route('pos.members.search') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ q: query })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success && data.data.length > 0) {
                    this.selectedMember = data.data[0];
                }
            })
            .catch(e => console.error('Error:', e));
        },

        validatePromo() {
            if (!this.promoCode) return;

            fetch(`{{ route('pos.promotions.validate') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    code: this.promoCode,
                    amount: this.subtotal
                })
            })
            .then(r => r.json())
            .then(data => {
                this.promoValid = data.success;
                this.promoMessage = data.message;
            })
            .catch(e => console.error('Error:', e));
        },

        saveTransaction() {
            if (this.cartItems.length === 0) {
                alert('Keranjang kosong!');
                return;
            }

            const data = {
                items: this.cartItems,
                member_id: this.selectedMember?.id || null,
                promotion_code: this.promoValid ? this.promoCode : null,
                payment_method: this.paymentMethod,
                notes: ''
            };

            fetch(`{{ route('pos.transaction.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.lastTransactionId = data.data.id;
                    alert('Transaksi berhasil disimpan!');
                    // Reset untuk transaksi baru
                    setTimeout(() => {
                        this.clearCart();
                    }, 1000);
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(e => {
                console.error('Error:', e);
                alert('Terjadi kesalahan');
            });
        },

        printThermal() {
            this.printDocument('thermal');
        },

        printBluetooth() {
            this.printDocument('bluetooth');
        },

        downloadPDF() {
            window.location.href = `/pos/transactions/${this.lastTransactionId}/download-pdf`;
        },

        printDocument(type) {
            const route = type === 'thermal' 
                ? `{{ route('pos.print.thermal', '') }}/${this.lastTransactionId}`
                : `{{ route('pos.print.bluetooth', '') }}/${this.lastTransactionId}`;

            fetch(route, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(e => {
                console.error('Error:', e);
                alert('Terjadi kesalahan saat mencetak');
            });
        },

        formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        },

        init() {
            // Update current time
            setInterval(() => {
                const now = new Date();
                document.getElementById('current-time').textContent = now.toLocaleString('id-ID');
            }, 1000);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const app = posSystem();
    app.init();
});
</script>
@endsection

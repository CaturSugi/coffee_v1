@extends('layouts.app')

@section('title', 'Edit Produk — ' . $product->name)
@section('page-title')
    ✏️ <span>Edit</span> Produk
@endsection

@section('content')

<div style="max-width:900px;">

  <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--gray-400); margin-bottom:20px;">
    <a href="{{ route('admin.products.index') }}" style="color:var(--brand-500);">Produk</a>
    <span>›</span>
    <span>{{ $product->name }}</span>
  </div>

  <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

      {{-- Left panel --}}
      <div style="display:flex; flex-direction:column; gap:20px;">

        <div class="card">
          <div class="card-header"><div class="card-title">Informasi Produk</div></div>
          <div class="card-body" style="display:flex; flex-direction:column; gap:18px;">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Nama Produk *</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name) }}" required
                style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Deskripsi</label>
              <textarea name="description" rows="3" class="form-control"
                style="background:#fff; color:var(--dark-800); border-color:var(--gray-200); resize:vertical;">{{ old('description', $product->description) }}</textarea>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Kategori *</label>
                <select name="category_id" class="form-control" style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);" required>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                      {{ $cat->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">SKU *</label>
                <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                  value="{{ old('sku', $product->sku) }}" required
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
                @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header"><div class="card-title">💰 Harga</div></div>
          <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Harga Modal (Rp)</label>
                <input type="number" id="purchase_price" name="purchase_price" min="0" step="100"
                  value="{{ old('purchase_price', $product->purchase_price) }}"
                  class="form-control" style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Harga Jual (Rp) *</label>
                <input type="number" id="sell_price" name="sell_price" min="0" step="100" required
                  value="{{ old('sell_price', $product->sell_price) }}"
                  class="form-control" style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
              </div>
            </div>
            <div id="profit-preview" style="margin-top:16px; padding:14px; border-radius:10px; background:rgba(34,197,94,.06); border:1px solid rgba(34,197,94,.2); display:flex; align-items:center; justify-content:space-between;">
              <span style="font-size:13px; color:var(--gray-500);">💹 Margin:</span>
              <span id="profit-value" style="font-size:15px; font-weight:700; color:var(--success);"></span>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header"><div class="card-title">📦 Stok</div></div>
          <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Stok Saat Ini *</label>
                <input type="number" name="stock" min="0" required
                  value="{{ old('stock', $product->stock) }}"
                  class="form-control" style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Stok Minimum *</label>
                <input type="number" name="min_stock" min="0" required
                  value="{{ old('min_stock', $product->min_stock) }}"
                  class="form-control" style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
              </div>
            </div>
          </div>
        </div>

      </div>

      {{-- Right panel --}}
      <div style="display:flex; flex-direction:column; gap:20px;">

        <div class="card">
          <div class="card-header"><div class="card-title">🖼️ Foto Produk</div></div>
          <div class="card-body">
            <div id="image-preview-wrap" style="width:100%; aspect-ratio:4/3; border-radius:12px; overflow:hidden; background:var(--gray-100); border:2px dashed var(--gray-300); display:flex; align-items:center; justify-content:center; margin-bottom:14px; cursor:pointer; position:relative;"
               onclick="document.getElementById('image').click()"
               onmouseover="document.getElementById('upload-overlay').style.opacity='1'; this.style.borderColor='var(--brand-400)'"
               onmouseout="document.getElementById('upload-overlay').style.opacity='0'; this.style.borderColor='var(--gray-300)'">
              <img id="image-preview"
                src="{{ $product->image ? Storage::url($product->image) : asset('images/product-placeholder.png') }}"
                style="width:100%; height:100%; object-fit:cover;">
              <div id="upload-overlay" style="position:absolute; inset:0; background:rgba(0,0,0,.4); display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff; border-radius:10px; opacity:0; transition:opacity .2s;">
                <div style="font-size:32px; margin-bottom:6px;">📷</div>
                <div style="font-size:13px; font-weight:600;">Klik untuk ganti foto</div>
              </div>
            </div>
            <input type="file" id="image" name="image" accept="image/*" style="display:none;" onchange="previewImage(this)">
            <button type="button" onclick="document.getElementById('image').click()"
              style="width:100%; padding:9px; border:1px solid var(--gray-200); border-radius:9px; background:var(--gray-100); font-size:13px; font-weight:600; color:var(--dark-700); cursor:pointer; font-family:inherit;">
              📂 Ganti Foto
            </button>
          </div>
        </div>

        <div class="card">
          <div class="card-header"><div class="card-title">⚙️ Status Produk</div></div>
          <div class="card-body">
            <label style="display:flex; align-items:center; gap:12px; cursor:pointer; padding:14px; background:var(--gray-100); border-radius:10px;">
              <div style="position:relative;">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                  {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                  style="opacity:0; position:absolute;" onchange="toggleStatus(this)">
                <div id="toggle-track" style="width:42px; height:24px; border-radius:99px; background:{{ $product->is_active ? 'var(--success)' : 'var(--gray-300)' }}; transition:background .2s; position:relative;">
                  <div id="toggle-thumb" style="position:absolute; top:3px; {{ $product->is_active ? 'right:3px' : 'left:3px' }}; width:18px; height:18px; border-radius:50%; background:#fff; transition:all .2s;"></div>
                </div>
              </div>
              <div>
                <div style="font-size:13px; font-weight:600; color:var(--dark-800);" id="status-label">{{ $product->is_active ? 'Produk Aktif' : 'Produk Non-Aktif' }}</div>
                <div style="font-size:12px; color:var(--gray-400);">Produk akan terlihat di kasir</div>
              </div>
            </label>
          </div>
        </div>

        {{-- Product stats --}}
        <div class="card">
          <div class="card-header"><div class="card-title">📊 Statistik</div></div>
          <div class="card-body" style="display:grid; gap:12px;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px; background:var(--gray-100); border-radius:8px;">
              <span style="font-size:13px; color:var(--gray-500);">Total Terjual</span>
              <span style="font-weight:700; color:var(--dark-800);">{{ $totalSold ?? 0 }} item</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px; background:var(--gray-100); border-radius:8px;">
              <span style="font-size:13px; color:var(--gray-500);">Total Revenue</span>
              <span style="font-weight:700; color:var(--brand-600);">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px; background:var(--gray-100); border-radius:8px;">
              <span style="font-size:13px; color:var(--gray-500);">Ditambahkan</span>
              <span style="font-size:12px; color:var(--gray-400);">{{ $product->created_at->format('d M Y') }}</span>
            </div>
          </div>
        </div>

        <div style="display:flex; flex-direction:column; gap:10px;">
          <button type="submit" class="btn btn-primary" style="width:100%; padding:13px;">💾 Perbarui Produk</button>
          <a href="{{ route('admin.products.index') }}"
            style="display:block; padding:12px; text-align:center; border:1px solid var(--gray-200); border-radius:10px; font-size:13px; font-weight:600; color:var(--dark-700);">
            Batal
          </a>
        </div>

      </div>
    </div>
  </form>
</div>

@endsection

@push('scripts')
<script>
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => document.getElementById('image-preview').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
  }
}
function toggleStatus(cb) {
  const track = document.getElementById('toggle-track');
  const thumb = document.getElementById('toggle-thumb');
  const label = document.getElementById('status-label');
  if (cb.checked) {
    track.style.background = 'var(--success)';
    thumb.style.left = ''; thumb.style.right = '3px';
    label.textContent = 'Produk Aktif';
  } else {
    track.style.background = 'var(--gray-300)';
    thumb.style.right = ''; thumb.style.left = '3px';
    label.textContent = 'Produk Non-Aktif';
  }
}
function calcProfit() {
  const buy  = parseFloat(document.getElementById('purchase_price').value) || 0;
  const sell = parseFloat(document.getElementById('sell_price').value) || 0;
  const val  = document.getElementById('profit-value');
  if (sell > 0 && buy > 0) {
    const margin = ((sell - buy) / buy * 100).toFixed(1);
    val.textContent = `Rp ${(sell-buy).toLocaleString('id-ID')} (${margin}%)`;
    val.style.color = (sell-buy) >= 0 ? 'var(--success)' : 'var(--danger)';
  }
}
document.getElementById('purchase_price').addEventListener('input', calcProfit);
document.getElementById('sell_price').addEventListener('input', calcProfit);
calcProfit();
</script>
@endpush

@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title')
    ➕ <span>Tambah</span> Produk
@endsection

@section('content')

<div style="max-width:900px;">

  {{-- Breadcrumb --}}
  <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--gray-400); margin-bottom:20px;">
    <a href="{{ route('admin.products.index') }}" style="color:var(--brand-500);">Produk</a>
    <span>›</span>
    <span>Tambah Baru</span>
  </div>

  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="product-form">
    @csrf

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

      {{-- Left: Main fields --}}
      <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Basic Info --}}
        <div class="card">
          <div class="card-header">
            <div class="card-title">Informasi Produk</div>
          </div>
          <div class="card-body" style="display:flex; flex-direction:column; gap:18px;">

            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label" for="name">Nama Produk <span style="color:var(--danger)">*</span></label>
              <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Contoh: Cappuccino Premium" value="{{ old('name') }}" required
                style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label" for="description">Deskripsi</label>
              <textarea id="description" name="description" rows="3"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Deskripsi singkat produk..."
                style="background:#fff; color:var(--dark-800); border-color:var(--gray-200); resize:vertical;">{{ old('description') }}</textarea>
              @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="category_id">Kategori <span style="color:var(--danger)">*</span></label>
                <select id="category_id" name="category_id"
                  class="form-control @error('category_id') is-invalid @enderror"
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);" required>
                  <option value="">Pilih Kategori</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                      {{ $cat->name }}
                    </option>
                  @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="sku">SKU <span style="color:var(--danger)">*</span></label>
                <input type="text" id="sku" name="sku"
                  class="form-control @error('sku') is-invalid @enderror"
                  placeholder="Contoh: CAP-001"
                  value="{{ old('sku') }}"
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);" required>
                @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

          </div>
        </div>

        {{-- Pricing --}}
        <div class="card">
          <div class="card-header">
            <div class="card-title">💰 Harga</div>
          </div>
          <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="purchase_price">Harga Modal (Rp)</label>
                <input type="number" id="purchase_price" name="purchase_price"
                  class="form-control @error('purchase_price') is-invalid @enderror"
                  placeholder="0" min="0" step="100" value="{{ old('purchase_price') }}"
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);">
                @error('purchase_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="sell_price">Harga Jual (Rp) <span style="color:var(--danger)">*</span></label>
                <input type="number" id="sell_price" name="sell_price"
                  class="form-control @error('sell_price') is-invalid @enderror"
                  placeholder="0" min="0" step="100" value="{{ old('sell_price') }}"
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);" required>
                @error('sell_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            {{-- Profit preview --}}
            <div id="profit-preview" style="
              margin-top:16px; padding:14px; border-radius:10px;
              background:rgba(34,197,94,.06); border:1px solid rgba(34,197,94,.2);
              display:none; align-items:center; justify-content:space-between;
            ">
              <span style="font-size:13px; color:var(--gray-500);">💹 Estimasi Margin:</span>
              <span id="profit-value" style="font-size:15px; font-weight:700; color:var(--success);"></span>
            </div>
          </div>
        </div>

        {{-- Stock --}}
        <div class="card">
          <div class="card-header">
            <div class="card-title">📦 Stok</div>
          </div>
          <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="stock">Stok Awal <span style="color:var(--danger)">*</span></label>
                <input type="number" id="stock" name="stock"
                  class="form-control @error('stock') is-invalid @enderror"
                  placeholder="0" min="0" value="{{ old('stock', 0) }}"
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);" required>
                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="min_stock">Stok Minimum <span style="color:var(--danger)">*</span></label>
                <input type="number" id="min_stock" name="min_stock"
                  class="form-control @error('min_stock') is-invalid @enderror"
                  placeholder="5" min="0" value="{{ old('min_stock', 5) }}"
                  style="background:#fff; color:var(--dark-800); border-color:var(--gray-200);" required>
                @error('min_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div style="margin-top:12px; font-size:12px; color:var(--gray-400); background:var(--gray-100); padding:10px 14px; border-radius:8px;">
              💡 Notifikasi akan muncul saat stok mencapai atau di bawah stok minimum
            </div>
          </div>
        </div>

      </div>

      {{-- Right: Image + Status --}}
      <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Image upload --}}
        <div class="card">
          <div class="card-header">
            <div class="card-title">🖼️ Foto Produk</div>
          </div>
          <div class="card-body">
            {{-- Preview area --}}
            <div id="image-preview-wrap" style="
              width:100%; aspect-ratio:4/3; border-radius:12px; overflow:hidden;
              background:var(--gray-100); border:2px dashed var(--gray-300);
              display:flex; align-items:center; justify-content:center;
              margin-bottom:14px; cursor:pointer; transition:border-color .2s;
              position:relative;
            " onclick="document.getElementById('image').click()"
               onmouseover="this.style.borderColor='var(--brand-400)'"
               onmouseout="this.style.borderColor='var(--gray-300)'">
              <img id="image-preview" src="{{ asset('images/product-placeholder.png') }}"
                style="width:100%; height:100%; object-fit:cover;">
              <div id="upload-overlay" style="
                position:absolute; inset:0; background:rgba(0,0,0,.4);
                display:flex; flex-direction:column; align-items:center; justify-content:center;
                color:#fff; border-radius:10px; opacity:0; transition:opacity .2s;
              ">
                <div style="font-size:32px; margin-bottom:6px;">📷</div>
                <div style="font-size:13px; font-weight:600;">Klik untuk ganti foto</div>
              </div>
            </div>

            <input type="file" id="image" name="image" accept="image/*"
              style="display:none;" onchange="previewImage(this)">

            <button type="button" onclick="document.getElementById('image').click()"
              style="width:100%; padding:9px; border:1px solid var(--gray-200); border-radius:9px; background:var(--gray-100); font-size:13px; font-weight:600; color:var(--dark-700); cursor:pointer; font-family:inherit; transition:all .15s;"
              onmouseover="this.style.background='var(--gray-200)'"
              onmouseout="this.style.background='var(--gray-100)'">
              📂 Pilih Foto
            </button>
            <p style="font-size:11px; color:var(--gray-400); text-align:center; margin-top:8px;">
              JPEG, PNG, WebP maks. 2MB
            </p>
          </div>
        </div>

        {{-- Status --}}
        <div class="card">
          <div class="card-header">
            <div class="card-title">⚙️ Status Produk</div>
          </div>
          <div class="card-body">
            <label style="display:flex; align-items:center; gap:12px; cursor:pointer; padding:14px; background:var(--gray-100); border-radius:10px;">
              <div style="position:relative;">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                  {{ old('is_active', true) ? 'checked' : '' }}
                  style="opacity:0; position:absolute;"
                  onchange="toggleStatus(this)">
                <div id="toggle-track" style="
                  width:42px; height:24px; border-radius:99px; background:var(--success);
                  transition:background .2s; position:relative;
                ">
                  <div id="toggle-thumb" style="
                    position:absolute; top:3px; right:3px;
                    width:18px; height:18px; border-radius:50%; background:#fff;
                    transition:right .2s;
                  "></div>
                </div>
              </div>
              <div>
                <div style="font-size:13px; font-weight:600; color:var(--dark-800);" id="status-label">Produk Aktif</div>
                <div style="font-size:12px; color:var(--gray-400);">Produk akan terlihat di kasir</div>
              </div>
            </label>
          </div>
        </div>

        {{-- Action buttons --}}
        <div style="display:flex; flex-direction:column; gap:10px;">
          <button type="submit" class="btn btn-primary" style="width:100%; padding:13px; font-size:14px;">
            💾 Simpan Produk
          </button>
          <a href="{{ route('admin.products.index') }}"
            style="display:block; padding:12px; text-align:center; border:1px solid var(--gray-200); border-radius:10px; font-size:13px; font-weight:600; color:var(--dark-700); transition:background .15s;"
            onmouseover="this.style.background='var(--gray-100)'"
            onmouseout="this.style.background='transparent'">
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
// Image preview
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('image-preview').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Toggle status
function toggleStatus(cb) {
  const track = document.getElementById('toggle-track');
  const thumb = document.getElementById('toggle-thumb');
  const label = document.getElementById('status-label');
  if (cb.checked) {
    track.style.background = 'var(--success)';
    thumb.style.right = '3px';
    label.textContent = 'Produk Aktif';
  } else {
    track.style.background = 'var(--gray-300)';
    thumb.style.right = 'calc(100% - 21px)';
    label.textContent = 'Produk Non-Aktif';
  }
}

// Profit margin calculator
function calcProfit() {
  const buy  = parseFloat(document.getElementById('purchase_price').value) || 0;
  const sell = parseFloat(document.getElementById('sell_price').value) || 0;
  const preview = document.getElementById('profit-preview');
  const val     = document.getElementById('profit-value');

  if (sell > 0 && buy > 0) {
    const margin = ((sell - buy) / buy * 100).toFixed(1);
    const profit = sell - buy;
    val.textContent = `Rp ${profit.toLocaleString('id-ID')} (${margin}%)`;
    val.style.color = profit >= 0 ? 'var(--success)' : 'var(--danger)';
    preview.style.display = 'flex';
  } else {
    preview.style.display = 'none';
  }
}

document.getElementById('purchase_price').addEventListener('input', calcProfit);
document.getElementById('sell_price').addEventListener('input', calcProfit);

// Image overlay hover
const wrap = document.getElementById('image-preview-wrap');
const overlay = document.getElementById('upload-overlay');
wrap.addEventListener('mouseover', () => overlay.style.opacity = '1');
wrap.addEventListener('mouseout', () => overlay.style.opacity = '0');

// Auto-generate SKU from name
document.getElementById('name').addEventListener('input', function() {
  const sku = document.getElementById('sku');
  if (!sku.dataset.manual) {
    const slug = this.value
      .toUpperCase()
      .replace(/[^A-Z0-9\s]/g, '')
      .trim()
      .split(/\s+/)
      .map(w => w.substring(0,3))
      .join('-');
    sku.value = slug + (slug ? '-001' : '');
  }
});
document.getElementById('sku').addEventListener('input', function() {
  this.dataset.manual = true;
});
</script>
@endpush

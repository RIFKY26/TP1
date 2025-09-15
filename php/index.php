<?php
require_once __DIR__ . '/Elektronik.php';
session_start();


// ---- 1) STORAGE SESSION -----------------------------------------------------
if(!isset($_SESSION['data'])) $_SESSION['data'] = []; // array of Elektronik
if(!isset($_SESSION['counter'])) $_SESSION['counter'] = 1; // auto-increment ID

// ---- 2) UTILITAS ------------------------------------------------------------
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function find_index_by_id($id){
    $id = (int)$id; $found = -1; $n = count($_SESSION['data']);
    for($i=0; $i<$n; $i++){
        $obj = $_SESSION['data'][$i];
        if($obj instanceof Elektronik && $obj->getId() === $id){
            $found = $i; // tidak pakai break (gaya DPBO)
        }
    }
    return $found;
}

function is_local_file_visible($path){
    if(preg_match('#^https?://#i', $path)) return false; // tolak URL; hanya path lokal
    return true; // longgar: biar browser coba render jika file tersedia
}

// ---- 3) HANDLER REQUEST -----------------------------------------------------
$errors = [];
$flash  = null;

// CREATE
if($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create'){
    try{
        $id = $_SESSION['counter'];
        $obj = new Elektronik(
            $id,
            $_POST['nama'] ?? '',
            $_POST['merk'] ?? '',
            $_POST['harga'] ?? '',
            $_POST['stok'] ?? '',
            $_POST['gambar'] ?? ''
        );
        $_SESSION['data'][] = $obj;
        $_SESSION['counter'] = $id + 1;
        $flash = 'Produk berhasil ditambahkan.';
    }catch(Throwable $e){ $errors[] = $e->getMessage(); }
}

// UPDATE
if($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update'){
    $id = (int)($_POST['id'] ?? 0);
    $idx = find_index_by_id($id);
    if($idx === -1){ $errors[] = 'ID tidak ditemukan.'; }
    else{
        $obj = $_SESSION['data'][$idx];
        try{
            $obj->setNamaProduk($_POST['nama'] ?? '');
            $obj->setMerk($_POST['merk'] ?? '');
            $obj->setHarga($_POST['harga'] ?? '');
            $obj->setStok($_POST['stok'] ?? '');
            $obj->setGambarPath($_POST['gambar'] ?? '');
            $_SESSION['data'][$idx] = $obj;
            $flash = 'Produk berhasil diupdate.';
        }catch(Throwable $e){ $errors[] = $e->getMessage(); }
    }
}

// DELETE
if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $idx = find_index_by_id($id);
    if($idx === -1){ $errors[] = 'ID tidak ditemukan.'; }
    else{
        array_splice($_SESSION['data'], $idx, 1);
        $flash = 'Produk berhasil dihapus.';
    }
}

// SEARCH (by ID)
$searchResult = null;
if(isset($_GET['q']) && $_GET['q'] !== ''){
    $qid = (int)$_GET['q'];
    $idx = find_index_by_id($qid);
    if($idx !== -1){ $searchResult = $_SESSION['data'][$idx]; }
}

// EDIT MODE (prefill form)
$editObj = null; $isEdit = false;
if(isset($_GET['edit'])){
    $eid = (int)$_GET['edit'];
    $idx = find_index_by_id($eid);
    if($idx !== -1){ $editObj = $_SESSION['data'][$idx]; $isEdit = true; }
}

// ---- 4) VIEW (HTML + CSS ringan) -------------------------------------------
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Toko Elektronik (PHP, SESSION, 1 Class)</title>
<style>
  body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Arial,sans-serif;margin:24px;background:#f9fafb;color:#111827}
  .wrap{max-width:980px;margin:0 auto}
  h1{font-size:24px;margin:0 0 12px}
  .card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-bottom:16px;box-shadow:0 1px 2px rgba(0,0,0,.04)}
  .row{display:flex;gap:12px;flex-wrap:wrap}
  .col{flex:1 1 280px}
  label{display:block;font-size:14px;margin-bottom:4px;color:#374151}
  input[type=text],input[type=number]{width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb}
  .btn{display:inline-block;padding:10px 14px;border-radius:10px;border:1px solid #111827;background:#111827;color:#fff;text-decoration:none;font-weight:600}
  .btn.secondary{background:#fff;color:#111827}
  .btn.danger{background:#ef4444;border-color:#ef4444}
  .btn + .btn{margin-left:8px}
  table{width:100%;border-collapse:collapse}
  th,td{padding:10px;border-bottom:1px solid #e5e7eb;text-align:left;font-size:14px}
  th{background:#f3f4f6;font-weight:700}
  .muted{color:#6b7280}
  .img-thumb{width:64px;height:64px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;background:#f3f4f6}
  .alert{padding:10px 12px;border-radius:10px;margin-bottom:12px}
  .alert.ok{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0}
  .alert.err{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
</style>
</head>
<body>
<div class="wrap">
  <h1>Manajemen Toko Elektronik</h1>

  <?php if($flash): ?><div class="alert ok"><?=h($flash)?></div><?php endif; ?>
  <?php foreach($errors as $e): ?><div class="alert err"><?=h($e)?></div><?php endforeach; ?>

  <div class="card">
    <form method="get" class="row" style="align-items:flex-end">
      <div class="col">
        <label for="q">Cari berdasarkan ID</label>
        <input type="number" id="q" name="q" placeholder="Masukkan ID" value="<?= isset($_GET['q'])? h($_GET['q']) : '' ?>">
      </div>
      <div class="col" style="flex:0 0 auto">
        <button class="btn secondary" type="submit">Cari</button>
        <a class="btn secondary" href="?">Reset</a>
      </div>
    </form>

    <?php if($searchResult): ?>
      <div style="margin-top:12px">
        <strong>Hasil Pencarian (ID <?=h($searchResult->getId())?>)</strong>
        <div class="row" style="margin-top:8px">
          <div class="col"><span class="muted">Nama</span><br><?=h($searchResult->getNamaProduk())?></div>
          <div class="col"><span class="muted">Merk</span><br><?=h($searchResult->getMerk())?></div>
          <div class="col"><span class="muted">Harga</span><br>Rp <?=h($searchResult->getHargaFormatted())?></div>
          <div class="col"><span class="muted">Stok</span><br><?=h($searchResult->getStok())?></div>
          <div class="col"><span class="muted">Gambar</span><br>
            <?php $gp=$searchResult->getGambarPath(); if(is_local_file_visible($gp)): ?>
              <img class="img-thumb" src="<?=h($gp)?>" alt="Preview">
            <?php endif; ?>
            <div class="muted"><?=h($gp)?></div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="card">
    <h2 style="margin-top:0"><?= $isEdit ? 'Edit Produk (ID '.h($editObj->getId()).')' : 'Tambah Produk' ?></h2>
    <form method="post">
      <input type="hidden" name="action" value="<?= $isEdit ? 'update' : 'create' ?>">
      <?php if($isEdit): ?><input type="hidden" name="id" value="<?=h($editObj->getId())?>"><?php endif; ?>
      <div class="row">
        <div class="col">
          <label for="nama">Nama Produk</label>
          <input type="text" id="nama" name="nama" value="<?= $isEdit ? h($editObj->getNamaProduk()) : '' ?>" required>
        </div>
        <div class="col">
          <label for="merk">Merk</label>
          <input type="text" id="merk" name="merk" value="<?= $isEdit ? h($editObj->getMerk()) : '' ?>" required>
        </div>
        <div class="col">
          <label for="harga">Harga (Rp)</label>
          <input type="number" id="harga" name="harga" step="1" min="0" value="<?= $isEdit ? h($editObj->getHarga()) : '' ?>" required>
        </div>
        <div class="col">
          <label for="stok">Stok</label>
          <input type="number" id="stok" name="stok" step="1" min="0" value="<?= $isEdit ? h($editObj->getStok()) : '' ?>" required>
        </div>
        <div class="col">
          <label for="gambar">Path Gambar (lokal)</label>
          <input type="text" id="gambar" name="gambar" placeholder="contoh: img/tv_samsung.jpg" value="<?= $isEdit ? h($editObj->getGambarPath()) : '' ?>" required>
        </div>
      </div>
      <div style="margin-top:12px">
        <button class="btn" type="submit"><?= $isEdit ? 'Simpan Perubahan' : 'Tambah Produk' ?></button>
        <?php if($isEdit): ?><a class="btn secondary" href="?">Batal</a><?php endif; ?>
      </div>
    </form>
  </div>

  <div class="card">
    <h2 style="margin-top:0">Daftar Produk</h2>
    <div class="muted" style="margin-bottom:8px">Total: <?= count($_SESSION['data']) ?> item</div>
    <div style="overflow-x:auto">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Merk</th>
            <th>Harga (Rp)</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($_SESSION['data'])): ?>
            <tr><td colspan="7" class="muted">Belum ada data.</td></tr>
          <?php else: ?>
            <?php foreach($_SESSION['data'] as $item): ?>
              <?php if(!($item instanceof Elektronik)) continue; ?>
              <tr>
                <td><?= h($item->getId()) ?></td>
                <td><?= h($item->getNamaProduk()) ?></td>
                <td><?= h($item->getMerk()) ?></td>
                <td>Rp <?= h($item->getHargaFormatted()) ?></td>
                <td><?= h($item->getStok()) ?></td>
                <td>
                  <?php $p=$item->getGambarPath(); if(is_local_file_visible($p)): ?>
                    <img class="img-thumb" src="<?=h($p)?>" alt="Preview">
                  <?php endif; ?>
                  <div class="muted" style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"> <?= h($p) ?> </div>
                </td>
                <td>
                  <a class="btn secondary" href="?edit=<?=h($item->getId())?>">Edit</a>
                  <a class="btn danger" href="?delete=<?=h($item->getId())?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <p class="muted">Tip: Simpan gambar di folder proyek (mis. <code>img/</code>) dan isi path relatif, contohnya <code>img/kulkas_polytron.jpg</code>.</p>
</div>
</body>
</html>

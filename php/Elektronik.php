<?php


class Elektronik
{
    private int $id;            // read-only setelah konstruktor
    private string $namaProduk;
    private string $merk;
    private float $harga;
    private int $stok;
    private string $gambarPath; // path lokal, bukan URL

    public function __construct($id, $namaProduk, $merk, $harga, $stok, $gambarPath)
    {
        $this->id = (int)$id; // id hanya di-set saat pembuatan
        $this->setNamaProduk($namaProduk);
        $this->setMerk($merk);
        $this->setHarga($harga);
        $this->setStok($stok);
        $this->setGambarPath($gambarPath);
    }

    // ===== GETTER =====
    public function getId(): int { return $this->id; }
    public function getNamaProduk(): string { return $this->namaProduk; }
    public function getMerk(): string { return $this->merk; }
    public function getHarga(): float { return $this->harga; }
    public function getStok(): int { return $this->stok; }
    public function getGambarPath(): string { return $this->gambarPath; }

    // ===== SETTER + VALIDASI (enkapsulasi) =====
    public function setNamaProduk($v): void
    {
        $v = trim((string)$v);
        if ($v === '') throw new InvalidArgumentException('Nama produk tidak boleh kosong.');
        $this->namaProduk = $v;
    }

    public function setMerk($v): void
    {
        $v = trim((string)$v);
        if ($v === '') throw new InvalidArgumentException('Merk tidak boleh kosong.');
        $this->merk = $v;
    }

    public function setHarga($v): void
    {
        if (!is_numeric($v)) throw new InvalidArgumentException('Harga harus angka.');
        $v = (float)$v;
        if ($v < 0) throw new InvalidArgumentException('Harga tidak boleh negatif.');
        $this->harga = $v;
    }

    public function setStok($v): void
    {
        // harus bilangan bulat non-negatif (tolak desimal seperti "7.0")
        if (!is_numeric($v) || strpos((string)$v, '.') !== false) {
            throw new InvalidArgumentException('Stok harus bilangan bulat.');
        }
        $v = (int)$v;
        if ($v < 0) throw new InvalidArgumentException('Stok tidak boleh negatif.');
        $this->stok = $v;
    }

    public function setGambarPath($v): void
    {
        $v = trim((string)$v);
        if ($v === '') throw new InvalidArgumentException('Path gambar tidak boleh kosong.');
        // Opsional: larang URL agar tetap lokal
        if (preg_match('#^https?://#i', $v)) {
            throw new InvalidArgumentException('Gunakan path lokal (bukan URL).');
        }
        $this->gambarPath = $v;
    }

    // ===== Helper presentasi =====
    public function getHargaFormatted(): string
    {
        // Format: 1.234.567
        return number_format($this->harga, 0, ',', '.');
    }

    // Opsional untuk debug nyaman:
    public function __toString(): string
    {
        return "ID: {$this->id} | {$this->namaProduk} ({$this->merk}) - Rp {$this->getHargaFormatted()} | Stok: {$this->stok} | Gambar: {$this->gambarPath}";
    }
}
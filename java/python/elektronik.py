# Class Barang
class Barang:
    def __init__(self, nama_barang, harga, stok, merek):
        self.nama_barang = nama_barang
        self.harga = harga
        self.stok = stok
        self.merek = merek
    
    def tambah_stok(self, jumlah):
        self.stok += jumlah
    
    def kurangi_stok(self, jumlah):
        if self.stok >= jumlah:
            self.stok -= jumlah
        else:
            print(f"Stok {self.nama_barang} tidak cukup.")
    
    def tampilkan_info(self):
        print(f"Nama Barang: {self.nama_barang}")
        print(f"Harga: {self.harga}")
        print(f"Stok: {self.stok}")
        print(f"Merek: {self.merek}")

# Array/list untuk menyimpan objek Barang
barang_toko = []

# Menambah objek barang ke dalam array
barang1 = Barang("TV LED", 5000000, 10, "Samsung")
barang2 = Barang("Kulkas", 3500000, 5, "LG")

barang_toko.append(barang1)
barang_toko.append(barang2)

# Menampilkan informasi barang yang ada di toko
for barang in barang_toko:
    barang.tampilkan_info()

# Pembeli membeli barang
barang_toko[0].kurangi_stok(2)

# Menampilkan informasi barang setelah pembelian
print("\nSetelah Pembelian:")
for barang in barang_toko:
    barang.tampilkan_info()

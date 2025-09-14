from elektronik import Elektronik

def input_int(prompt: str) -> int:
    while True:
        try:
            return int(input(prompt))
        except ValueError:
            print("Input harus bilangan bulat. Coba lagi.")

def input_float(prompt: str) -> float:
    while True:
        try:
            return float(input(prompt))
        except ValueError:
            print("Input harus angka. Coba lagi.")

def input_str(prompt: str) -> str:
    while True:
        s = input(prompt).strip()
        if s:
            return s
        print("Tidak boleh kosong. Coba lagi.")

def tambah_data(data: list) -> None:
    print("\n=== Tambah Data ===")
    nama = input_str("Nama Produk: ")
    merk = input_str("Merk: ")
    harga = input_float("Harga: ")
    stok = input_int("Stok: ")
    path = input_str("Path Gambar: ")
    try:
        e = Elektronik(nama, merk, harga, stok, path)
        data.append(e)
        print("Produk berhasil ditambahkan!")
    except ValueError as err:
        print(f"Gagal menambah data: {err}")

def tampilkan_data(data: list) -> None:
    print("\n=== Daftar Produk ===")
    if not data:
        print("Belum ada data.")
        return
    for e in data:
        print(e)  # __str__ dari Elektronik sudah rapi

def cari_data(data: list) -> None:
    print("\n=== Cari Data ===")
    idc = input_int("Masukkan ID produk yang ingin dicari: ")
    for e in data:
        if e.id == idc:
            print("\n=== Data Ditemukan ===")
            print(e)
            return
    print("Produk dengan ID tersebut tidak ditemukan.")

def update_data(data: list) -> None:
    print("\n=== Update Data ===")
    idc = input_int("Masukkan ID produk yang ingin diupdate: ")
    for e in data:
        if e.id == idc:
            nama = input_str("Nama Produk baru: ")
            merk = input_str("Merk baru: ")
            harga = input_float("Harga baru: ")
            stok = input_int("Stok baru: ")
            path = input_str("Path Gambar baru: ")
            try:
                e.nama_produk = nama
                e.merk = merk
                e.harga = harga
                e.stok = stok
                e.gambar_path = path
                print("Produk berhasil diupdate!")
            except ValueError as err:
                print(f"Gagal mengupdate: {err}")
            return
    print("ID tidak ditemukan.")

def hapus_data(data: list) -> None:
    print("\n=== Hapus Data ===")
    idc = input_int("Masukkan ID produk yang ingin dihapus: ")
    for i, e in enumerate(data):
        if e.id == idc:
            data.pop(i)
            print("Produk berhasil dihapus!")
            return
    print("ID tidak ditemukan.")

def main():
    data: list[Elektronik] = []
    while True:
        print("\n=== Menu Toko Elektronik ===")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Update Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("0. Keluar")
        pilihan = input("Pilih menu: ").strip()

        if pilihan == "1":
            tambah_data(data)
        elif pilihan == "2":
            tampilkan_data(data)
        elif pilihan == "3":
            update_data(data)
        elif pilihan == "4":
            hapus_data(data)
        elif pilihan == "5":
            cari_data(data)
        elif pilihan == "0":
            print("Keluar program...")
            break
        else:
            print("Pilihan tidak valid.")

if __name__ == "__main__":
    main()
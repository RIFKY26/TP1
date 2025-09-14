class Elektronik:
    _counter = 1  # auto-increment ID (kelas ini yang pegang, bukan manager terpisah)

    def __init__(self, nama_produk: str, merk: str, harga: float, stok: int, gambar_path: str):
        self.__id = Elektronik._counter
        Elektronik._counter += 1

        self.nama_produk = nama_produk
        self.merk = merk
        self.harga = harga
        self.stok = stok
        self.gambar_path = gambar_path

    # --- ID (read-only) ---
    @property
    def id(self) -> int:
        return self.__id

    # --- nama_produk ---
    @property
    def nama_produk(self) -> str:
        return self.__nama_produk

    @nama_produk.setter
    def nama_produk(self, value: str) -> None:
        value = (value or "").strip()
        if not value:
            raise ValueError("Nama produk tidak boleh kosong.")
        self.__nama_produk = value

    # --- merk ---
    @property
    def merk(self) -> str:
        return self.__merk

    @merk.setter
    def merk(self, value: str) -> None:
        value = (value or "").strip()
        if not value:
            raise ValueError("Merk tidak boleh kosong.")
        self.__merk = value

    # --- harga ---
    @property
    def harga(self) -> float:
        return self.__harga

    @harga.setter
    def harga(self, value: float) -> None:
        try:
            val = float(value)
        except (TypeError, ValueError):
            raise ValueError("Harga harus berupa angka.")
        if val < 0:
            raise ValueError("Harga tidak boleh negatif.")
        self.__harga = val

    # --- stok ---
    @property
    def stok(self) -> int:
        return self.__stok

    @stok.setter
    def stok(self, value: int) -> None:
        try:
            val = int(value)
        except (TypeError, ValueError):
            raise ValueError("Stok harus berupa bilangan bulat.")
        if val < 0:
            raise ValueError("Stok tidak boleh negatif.")
        self.__stok = val

    # --- gambar_path ---
    @property
    def gambar_path(self) -> str:
        return self.__gambar_path

    @gambar_path.setter
    def gambar_path(self, value: str) -> None:
        value = (value or "").strip()
        if not value:
            raise ValueError("Path gambar tidak boleh kosong.")
        self.__gambar_path = value

    # --- util format harga ---
    def __format_harga(self) -> str:
        # Format 1.000.000 (pakai titik ribuan)
        return f"{self.__harga:,.0f}".replace(",", ".")

    # --- representasi & cetak ---
    def tampilkan_info(self) -> None:
        print(self.__str__())

    def __str__(self) -> str:
        return (
            f"ID: {self.__id}\n"
            f"Nama Produk: {self.__nama_produk}\n"
            f"Merk: {self.__merk}\n"
            f"Harga: Rp {self.__format_harga()}\n"
            f"Stok: {self.__stok}\n"
            f"Path Gambar: {self.__gambar_path}\n"
            f"----------------------------"
        )
        
    __repr__ = __str__
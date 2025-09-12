import java.text.DecimalFormat;
import java.util.ArrayList;

public class Elektronik {
    
    private int id;
    private String namaProduk;
    private String merk;
    private double harga;
    private int stok;
    private String gambarPath;

    public Elektronik(int id, String namaProduk, String merk, double harga, int stok, String gambarPath) {
        this.id = id;
        this.namaProduk = namaProduk;
        this.merk = merk;
        this.harga = harga;
        this.stok = stok;
        this.gambarPath = gambarPath;
    }

    public int getId() {
        return id;
    }

    public String getNamaProduk() {
        return namaProduk;
    }

    public void setNamaProduk(String namaProduk) {
        this.namaProduk = namaProduk;
    }

    public String getMerk() {
        return merk;
    }

    public void setMerk(String merk) {
        this.merk = merk;
    }

    public double getHarga() {
        return harga;
    }

    public void setHarga(double harga) {
        this.harga = harga;
    }

    public int getStok() {
        return stok;
    }

    public void setStok(int stok) {
        this.stok = stok;
    }

    public String getGambarPath() {
        return gambarPath;
    }

    public void setGambarPath(String gambarPath) {
        this.gambarPath = gambarPath;
    }

    // Method untuk menampilkan informasi produk dengan format harga
    public void tampilkanInfo() {
        // Format untuk menampilkan harga dengan koma sebagai pemisah ribuan
        DecimalFormat df = new DecimalFormat("###,###,###");
        String hargaFormatted = df.format(harga);

        System.out.println("ID: " + id);
        System.out.println("Nama Produk: " + namaProduk);
        System.out.println("Merk: " + merk);
        System.out.println("Harga: Rp " + hargaFormatted);
        System.out.println("Stok: " + stok);
        System.out.println("Path Gambar: " + gambarPath);
        System.out.println("----------------------------");
    }

    public static void main(String[] args) {
        ArrayList<Elektronik> produkList = new ArrayList<>();

        produkList.add(new Elektronik(1, "TV LED", "Samsung", 4500000, 10, "images/tv_led.jpg"));
        produkList.add(new Elektronik(2, "Kulkas 2 Pintu", "LG", 5500000, 5, "images/kulkas_2pintu.jpg"));
        produkList.add(new Elektronik(3, "Laptop Gaming", "Asus", 12000000, 3, "images/laptop_gaming.jpg"));

        // Tampilkan data produk
        for (Elektronik produk : produkList) {
            produk.tampilkanInfo();
        }

        // Update data produk berdasarkan ID
        updateProduk(produkList, 1, 4600000);
        System.out.println("Setelah Update:");
        produkList.get(0).tampilkanInfo();

        // Hapus data produk berdasarkan ID
        hapusProduk(produkList, 2);
        System.out.println("Setelah Hapus Produk Kedua:");
        for (Elektronik produk : produkList) {
            produk.tampilkanInfo();
        }

        // Cari data berdasarkan ID
        Elektronik produkDitemukan = cariProduk(produkList, 3);
        if (produkDitemukan != null) {
            System.out.println("Produk ditemukan: ");
            produkDitemukan.tampilkanInfo();
        }
    }

    // Method untuk update produk berdasarkan ID
    public static void updateProduk(ArrayList<Elektronik> produkList, int id, double hargaBaru) {
        for (Elektronik produk : produkList) {
            if (produk.getId() == id) {
                produk.setHarga(hargaBaru); // Mengubah harga
            }
        }
    }

    // Method untuk menghapus produk berdasarkan ID
    public static void hapusProduk(ArrayList<Elektronik> produkList, int id) {
        produkList.removeIf(produk -> produk.getId() == id); // Menghapus berdasarkan ID
    }

    // Method untuk mencari produk berdasarkan ID
    public static Elektronik cariProduk(ArrayList<Elektronik> produkList, int id) {
        for (Elektronik produk : produkList) {
            if (produk.getId() == id) {
                return produk;
            }
        }
        return null; // Jika tidak ditemukan
    }
}

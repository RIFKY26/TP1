import java.text.DecimalFormat;

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
}

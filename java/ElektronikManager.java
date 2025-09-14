import java.util.ArrayList;
import java.util.Scanner;

public class ElektronikManager {
    private ArrayList<Elektronik> list = new ArrayList<>();
    private int counter = 1; // auto-increment ID

    public void tambahData(Scanner sc) {
        System.out.print("Nama Produk: ");
        String nama = sc.nextLine();
        System.out.print("Merk: ");
        String merk = sc.nextLine();
        System.out.print("Harga: ");
        double harga = sc.nextDouble();
        System.out.print("Stok: ");
        int stok = sc.nextInt();
        sc.nextLine(); 
        System.out.print("Path Gambar: ");
        String path = sc.nextLine();

        Elektronik e = new Elektronik(counter++, nama, merk, harga, stok, path);
        list.add(e);
        System.out.println("Produk berhasil ditambahkan!");
    }

        public void tampilkanData() {
        if (list.isEmpty()) {
            System.out.println("Belum ada data.");
        } else {
            System.out.println("\n=== Daftar Produk ===");
            for (Elektronik e : list) {
                e.tampilkanInfo(); // <— ganti println(e) jadi ini
            }
        }
    }

    public void updateData(Scanner sc) {
        System.out.print("Masukkan ID produk yang ingin diupdate: ");
        int id = sc.nextInt();
        sc.nextLine();

        for (Elektronik e : list) {
            if (e.getId() == id) {
                System.out.print("Nama Produk baru: ");
                e.setNamaProduk(sc.nextLine());
                System.out.print("Merk baru: ");
                e.setMerk(sc.nextLine());
                System.out.print("Harga baru: ");
                e.setHarga(sc.nextDouble());
                System.out.print("Stok baru: ");
                e.setStok(sc.nextInt());
                sc.nextLine();
                System.out.print("Path Gambar baru: ");
                e.setGambarPath(sc.nextLine());

                System.out.println("Produk berhasil diupdate!");
                return;
            }
        }
        System.out.println("ID tidak ditemukan.");
    }

    public void hapusData(Scanner sc) {
        System.out.print("Masukkan ID produk yang ingin dihapus: ");
        int id = sc.nextInt();
        sc.nextLine();

        for (int i = 0; i < list.size(); i++) {
            if (list.get(i).getId() == id) {
                list.remove(i);
                System.out.println("Produk berhasil dihapus!");
                return;
            }
        }
        System.out.println("ID tidak ditemukan.");
    }

        public void cariData(Scanner sc) {
        System.out.print("Masukkan ID produk yang ingin dicari: ");
        int id = sc.nextInt();
        sc.nextLine();

        for (Elektronik e : list) {
            if (e.getId() == id) {
                System.out.println("\n=== Data Ditemukan ===");
                e.tampilkanInfo();      // <- ganti println(e) jadi ini
                return;
            }
        }
        System.out.println("Produk dengan ID tersebut tidak ditemukan.");
    }

}

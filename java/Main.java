import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        ElektronikManager manager = new ElektronikManager();
        
        int pilihan = -1;
        while (pilihan != 0) {  // jadi loop berhenti natural kalau pilihan = 0
            System.out.println("\n=== Menu Toko Elektronik ===");
            System.out.println("1. Tambah Data");
            System.out.println("2. Tampilkan Data");
            System.out.println("3. Update Data");
            System.out.println("4. Hapus Data");
            System.out.println("5. Cari Data");
            System.out.println("0. Keluar");
            System.out.print("Pilih menu: ");
            
            pilihan = sc.nextInt();
            sc.nextLine(); // buang newline

            if (pilihan == 1) {
                manager.tambahData(sc);
            } else if (pilihan == 2) {
                manager.tampilkanData();
            } else if (pilihan == 3) {
                manager.updateData(sc);
            } else if (pilihan == 4) {
                manager.hapusData(sc);
            } else if (pilihan == 5) {
                manager.cariData(sc);
            } else if (pilihan == 0) {
                System.out.println("Keluar program...");
            } else {
                System.out.println("Pilihan tidak valid.");
            }
        }
    }
}

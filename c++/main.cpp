#include <iostream>
#include <vector>
#include "Elektronik.h"

using namespace std;

class TokoElektronik {
private:
    vector<Elektronik> produkList;
    int counter;

public:
    TokoElektronik() : counter(1) {}

    // Add product
    void tambahData(string nama, string merk, float harga, int stok, string gambarPath) {
        Elektronik produk(counter, nama, merk, harga, stok, gambarPath);
        produkList.push_back(produk);
        counter++;
    }

    // Display all products
    void tampilkanData() const {
        if (produkList.empty()) {
            cout << "Belum ada data." << endl;
        } else {
            for (const auto &produk : produkList) {
                produk.display();
            }
        }
    }

    // Update product by ID
    bool updateData(int id, string nama, string merk, float harga, int stok, string gambarPath) {
        for (auto &produk : produkList) {
            if (produk.getId() == id) {
                produk = Elektronik(id, nama, merk, harga, stok, gambarPath);
                return true;
            }
        }
        return false;
    }

    // Delete product by ID
    bool hapusData(int id) {
        for (auto it = produkList.begin(); it != produkList.end(); ++it) {
            if (it->getId() == id) {
                produkList.erase(it);
                return true;
            }
        }
        return false;
    }

    // Search product by ID
    void cariData(int id) const {
        for (const auto &produk : produkList) {
            if (produk.getId() == id) {
                produk.display();
                return;
            }
        }
        cout << "Produk dengan ID tersebut tidak ditemukan." << endl;
    }
};

int main() {
    TokoElektronik toko;
    int pilihan;
    string nama, merk, gambarPath;
    float harga;
    int stok, id;

    while (true) {
        cout << "\n=== Menu Toko Elektronik ===" << endl;
        cout << "1. Tambah Data" << endl;
        cout << "2. Tampilkan Data" << endl;
        cout << "3. Update Data" << endl;
        cout << "4. Hapus Data" << endl;
        cout << "5. Cari Data" << endl;
        cout << "0. Keluar" << endl;
        cout << "Pilih menu: ";
        cin >> pilihan;
        cin.ignore(); // ignore newline after number input

        switch (pilihan) {
            case 1:
                cout << "\n--- Tambah Data ---" << endl;
                cout << "Nama Produk: ";
                getline(cin, nama);
                cout << "Merk: ";
                getline(cin, merk);
                cout << "Harga: ";
                cin >> harga;
                cout << "Stok: ";
                cin >> stok;
                cin.ignore(); // ignore newline after number input
                cout << "Path Gambar: ";
                getline(cin, gambarPath);
                toko.tambahData(nama, merk, harga, stok, gambarPath);
                break;
            case 2:
                cout << "\n--- Tampilkan Data ---" << endl;
                toko.tampilkanData();
                break;
            case 3:
                cout << "\n--- Update Data ---" << endl;
                cout << "Masukkan ID produk yang ingin diupdate: ";
                cin >> id;
                cin.ignore(); // ignore newline after number input
                cout << "Nama Produk baru: ";
                getline(cin, nama);
                cout << "Merk baru: ";
                getline(cin, merk);
                cout << "Harga baru: ";
                cin >> harga;
                cout << "Stok baru: ";
                cin >> stok;
                cin.ignore(); // ignore newline after number input
                cout << "Path Gambar baru: ";
                getline(cin, gambarPath);
                if (toko.updateData(id, nama, merk, harga, stok, gambarPath)) {
                    cout << "Produk berhasil diupdate!" << endl;
                } else {
                    cout << "ID tidak ditemukan!" << endl;
                }
                break;
            case 4:
                cout << "\n--- Hapus Data ---" << endl;
                cout << "Masukkan ID produk yang ingin dihapus: ";
                cin >> id;
                if (toko.hapusData(id)) {
                    cout << "Produk berhasil dihapus!" << endl;
                } else {
                    cout << "ID tidak ditemukan!" << endl;
                }
                break;
            case 5:
                cout << "\n--- Cari Data ---" << endl;
                cout << "Masukkan ID produk yang ingin dicari: ";
                cin >> id;
                toko.cariData(id);
                break;
            case 0:
                cout << "Keluar program..." << endl;
                return 0;
            default:
                cout << "Pilihan tidak valid." << endl;
        }
    }

    return 0;
}

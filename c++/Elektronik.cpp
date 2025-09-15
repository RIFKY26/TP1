#include "Elektronik.h"
#include <iostream>
#include <sstream>
#include <iomanip>
#include <stdexcept>

using namespace std;

// Constructor
Elektronik::Elektronik(int id, string namaProduk, string merk, float harga, int stok, string gambarPath)
    : id(id), namaProduk(namaProduk), merk(merk), harga(harga), stok(stok), gambarPath(gambarPath) {}

// Getter methods
int Elektronik::getId() const { return id; }
string Elektronik::getNamaProduk() const { return namaProduk; }
string Elektronik::getMerk() const { return merk; }
float Elektronik::getHarga() const { return harga; }
int Elektronik::getStok() const { return stok; }
string Elektronik::getGambarPath() const { return gambarPath; }

// Method to format harga
string Elektronik::getHargaFormatted() const {
    stringstream ss;
    ss << fixed << setprecision(0) << harga;
    return ss.str();
}

// Method to display data
void Elektronik::display() const {
    cout << "ID: " << id << " | Nama: " << namaProduk << " | Merk: " << merk
         << " | Harga: Rp " << getHargaFormatted() << " | Stok: " << stok
         << " | Gambar: " << gambarPath << endl;
}

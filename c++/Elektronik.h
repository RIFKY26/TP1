#ifndef ELEKTRONIK_H
#define ELEKTRONIK_H

#include <string>

using namespace std;

class Elektronik {
private:
    int id;
    string namaProduk;
    string merk;
    float harga;
    int stok;
    string gambarPath;

public:
    Elektronik(int id, string namaProduk, string merk, float harga, int stok, string gambarPath);

    // Getter methods
    int getId() const;
    string getNamaProduk() const;
    string getMerk() const;
    float getHarga() const;
    int getStok() const;
    string getGambarPath() const;

    // Method to format harga
    string getHargaFormatted() const;

    // Method to display data
    void display() const;
};

#endif // ELEKTRONIK_H

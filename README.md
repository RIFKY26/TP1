Saya nama Rifky Fadhillah Akbar dengan Nim 2401248 mengerjakan tugas praktikum 1
dalam mata kuliah DPBO untuk keberkahan-Nya maka saya
tidak akan melakukan kecurangan seperti yang telah di spesifikasikan Aamiin.


Penjelasan Desain Program
Program ini dirancang untuk mengelola data barang di sebuah toko elektronik menggunakan konsep Object-Oriented Programming (OOP). Desain program ini berfokus pada penggunaan satu kelas utama untuk mengelola data barang elektronik, yang terdiri dari beberapa atribut dan metode untuk mengelola data produk.

Desain Kelas: Elektronik
Atribut Kelas:
1.	ID (int): Sebagai identifikasi unik untuk setiap objek elektronik.
2.	Nama Produk (String): Nama dari produk elektronik yang dijual di toko.
3.	Merk (String): Merk dari produk elektronik.
4.	Harga (double): Harga jual produk elektronik.
5.	Gambar (String): Path lokal untuk gambar produk.

Metode Kelas:
1.	Constructor: Digunakan untuk membuat objek Elektronik baru dengan mengisi atribut berdasarkan input pengguna. Constructor juga mengatur ID produk secara otomatis.
2.	Getter dan Setter: Digunakan untuk mengakses dan memodifikasi atribut dari objek elektronik. Metode ini memungkinkan enkapsulasi data dengan menjaga atribut tetap private dan memberikan kontrol penuh terhadap perubahan data.
3.	Metode Tambah Data (tambahData): Menambah objek baru ke dalam array/list objek Elektronik.
4.	Metode Tampilkan Data (tampilkanData): Menampilkan semua objek Elektronik yang telah dimasukkan dalam array/list.
5.	Metode Update Data (updateData): Mengubah data objek berdasarkan ID produk, memungkinkan pengguna memperbarui data produk yang sudah ada.
6.	Metode Hapus Data (hapusData): Menghapus objek Elektronik berdasarkan ID produk.
7.	Metode Cari Data (cariData): Mencari dan menampilkan objek berdasarkan ID produk.

Alur Kode/Flow Program
1.	Program Dimulai: Program dimulai dengan menampilkan menu utama kepada pengguna dengan opsi untuk menambah, menampilkan, mengupdate, menghapus, atau mencari data produk elektronik.
2.	Menambah Data: Pengguna memilih opsi untuk menambah data, kemudian diminta untuk memasukkan nama produk, merk, harga, dan path gambar. ID produk akan diatur secara otomatis oleh constructor.
3.	Tampilkan Data: Pengguna dapat memilih untuk menampilkan semua data produk yang tersimpan. Program akan menampilkan setiap objek Elektronik dalam daftar dengan atribut lengkap.
4.	Update Data: Untuk mengupdate data produk, pengguna memilih opsi untuk mengupdate data berdasarkan ID. Program akan mencari objek dengan ID tersebut dan mengizinkan pengguna untuk mengubah data tertentu.
5.	Hapus Data: Pengguna dapat menghapus produk berdasarkan ID yang dimasukkan. Program akan mencari dan menghapus objek tersebut dari daftar.
6.	Cari Data: Pengguna bisa mencari produk berdasarkan ID, dan program akan menampilkan data produk yang cocok.

Penjelasan Alur Kerja Kode
1.	Main.java: Kode utama yang menangani interaksi dengan pengguna melalui terminal. Program akan memulai dengan menampilkan menu pilihan dan meminta input dari pengguna. Input dari pengguna akan diteruskan ke ElektronikManager untuk memproses data sesuai dengan opsi yang dipilih.
2.	ElektronikManager.java: Kelas ini berfungsi untuk menyimpan dan mengelola objek Elektronik dalam sebuah array atau list. Semua operasi CRUD (Create, Read, Update, Delete) dilakukan dalam kelas ini.
3.	Elektronik.java: Kelas yang merepresentasikan produk elektronik dengan atribut dan metode untuk mengelola data produk.

Contoh Alur Interaksi Pengguna
1.	Program akan meminta pengguna memilih opsi (misalnya, "1. Tambah Data").
2.	Setelah memilih opsi, pengguna akan diminta untuk memasukkan data produk yang relevan (misalnya, nama produk, harga, gambar).
3.	Program kemudian mengelola data tersebut dan memberikan respons, seperti menampilkan data yang baru ditambahkan atau melakukan pembaruan data produk.

Kesimpulan
Program ini dirancang untuk memberikan pengalaman manajemen data produk yang sederhana namun efektif di dalam toko elektronik. Dengan menggunakan OOP, program ini dapat mengelola data dengan cara yang terstruktur dan mudah dipelihara. Kode ini tidak menggunakan database, melainkan menggunakan penyimpanan sementara dalam bentuk array/list objek.

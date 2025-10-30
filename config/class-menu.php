<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Menu extends Database {

    // Method untuk input data menu
    public function inputMenu($data){
        // Mengambil data dari parameter $data
        $nama      = $data['nama'];
        $kategori  = $data['kategori'];
        $harga     = $data['harga'];
        $deskripsi = $data['deskripsi'];
        $status    = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
       $query = "SELECT tb_menu (nm_menu, kategori, harga, deskripsi, status)  VALUES (?, ?, ?, ?, ?)";
       $result = $this->conn->query($query);

        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssisi", $nama, $kategori, $harga, $deskripsi, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data menu
    public function getAllMenu(){
        // Menyiapkan query SQL untuk mengambil data menu
       $query = "SELECT id_menu, nm_menu, kategori, harga, deskripsi, status FROM tb_menu";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data menu
        $menu = [];
        // Mengecek apakah ada data yang ditemukan
         if($result && $result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
              while($row = $result->fetch_assoc()) {
            $menu[] = [
                'id' => $row['id_menu'],
                'nama' => $row['nama'],
                'kategori' => $row['kategori'],
                'harga' => $row['harga'],
                'deskripsi' => $row['deskripsi'],
                'status' => $row['status']
            ];
        }
    }
        // Mengembalikan array data menu
        return $menu;
    }

    // Method untuk mengambil data menu berdasarkan ID
    public function getUpdateMenu($id){
        // Menyiapkan query SQL untuk mengambil data menu berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_menu WHERE id_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data menu
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_menu'],
                'nama' => $row['nama'],
                'kategori' => $row['kategori'],
                'harga' => $row['harga'],
                'deskripsi' => $row['deskripsi'],
                'status' => $row['status']
            ];
        }
        $stmt->close();
        // Mengembalikan data menu
        return $data;
    }

    // Method untuk mengedit data menu
    public function editMenu($data){
        // Mengambil data dari parameter $data
        $id        = $data['id'];
        $nama      = $data['nama'];
        $kategori  = $data['kategori'];
        $harga     = $data['harga'];
        $deskripsi = $data['deskripsi'];
        $status    = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_menu SET nama = ?, kategori = ?, harga = ?, deskripsi = ?, status = ? WHERE id_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssisii", $nama, $kategori, $harga, $deskripsi, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data menu
    public function deleteMenu($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_menu WHERE id_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data menu berdasarkan kata kunci
    public function searchMenu($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data menu menggunakan prepared statement
        $query = "SELECT id_menu, nama, kategori, harga, deskripsi, status 
                  FROM tb_menu
                  WHERE nama LIKE ? OR kategori LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data menu
        $menu = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data menu dalam array
                $menu[] = [
                    'id' => $row['id_menu'],
                    'nama' => $row['nama'],
                    'kategori' => $row['kategori'],
                    'harga' => $row['harga'],
                    'deskripsi' => $row['deskripsi'],
                    'status' => $row['status']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data menu yang ditemukan
        return $menu;
    }

}

?>
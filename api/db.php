<?php

class Address {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function save($zipCode, $address) {
        $stmt = $this->db->prepare("INSERT INTO search_history (zip_Code, address) VALUES (:zipCode, :address)");
        $stmt->bindParam(':zipCode', $zipCode);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    }

    public function getHistory() {
        // 履歴を取得するメソッドを作成。件数は10件まで
        $stmt = $this->db->prepare("SELECT * FROM search_history ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        //fetchAllメソッドを使って、取得したデータを配列に変換している
        $history = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($history);
    }
}

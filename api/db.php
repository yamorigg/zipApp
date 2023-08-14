<?php

class Address {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }
    
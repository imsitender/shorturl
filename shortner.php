<?php
//namespace shortner;

class Shortner{

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    function GetShortUrl($url){
       
        $query = "SELECT * FROM short_urls WHERE long_url = '".$url."' "; 
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['short_url'];
        } else {
            $short_code = $this->generateUniqueID();
            $sql = "INSERT INTO short_urls (long_url, short_url, created_at)
            VALUES ('".$url."', '".$short_code."', now())";
            if ($this->db->query($sql) === TRUE) {
                return $short_code;
            } else { 
                die("Unknown Error Occured");
            }
        }
    }

    function generateUniqueID(){

        $token = substr(md5(uniqid()),0,5); 
        $query = "SELECT * FROM short_urls WHERE short_code = '".$token."' ";
        $result = $this->db->query($query); 
        if (($result !=false) && ($result->num_rows > 0)) {
            generateUniqueID();
        } else {
        return $token;
        }
    }

    function GetRedirectUrl($url){
        $query = "SELECT * FROM short_urls WHERE short_url = '".$url."' "; 
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
            return $row['long_url'];
        }
        else { 
            return false;
        }
       }
}

?>
<?php

namespace App\Models;

use App\Config\Config;

class user extends Config {

    private $id,$first_name,$last_name,$email,$phone,$gender,$status,
    $password,$image,$verifiction_code,$email_verificted_at,$created_at,$updated_at;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of first_name
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     */
    public function setFirstName($first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     */
    public function setLastName($last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     */
    public function setGender($gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of verifiction_code
     */
    public function getVerifictionCode()
    {
        return $this->verifiction_code;
    }

    /**
     * Set the value of verifiction_code
     */
    public function setVerifictionCode($verifiction_code): self
    {
        $this->verifiction_code = $verifiction_code;

        return $this;
    }

    /**
     * Get the value of email_verificted_at
     */
    public function getEmailVerifictedAt()
    {
        return $this->email_verificted_at;
    }

    /**
     * Set the value of email_verificted_at
     */
    public function setEmailVerifictedAt($email_verificted_at): self
    {
        $this->email_verificted_at = $email_verificted_at;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function insertToDataBase() {

        $query = "INSERT INTO USERS (first_name, last_name, password, gender, email, phone, verifiction_code) VALUES (?,?,?,?,?,?,?)";
        $statment =$this->conn->prepare($query);
        if (!$statment) {
            return $statment;
        }
        $statment->bind_param("sssssii", $this->first_name,$this->last_name,$this->password,$this->gender,$this->email,$this->phone, $this->verifiction_code);
        return $statment->execute();


    }

    public function checkcode() {

        $query = "SELECT * FROM users WHERE verifiction_code = ? AND email = ? ";
        $statment = $this->conn->prepare($query);

        if (! $statment) {

            return $statment;

        }

        $statment->bind_param("is", $this->verifiction_code, $this->email);
        $statment->execute();
        return $statment->get_result();
        
    }

    public function updateEmailverifyAt() {

        $query = 'UPDATE users SET email_verified_at = ? WHERE email = ? ';
        $statment = $this->conn->prepare($query);

        if (! $statment) {

            return $statment;

        }

        $statment->bind_param("ss", $this->email_verificted_at, $this->email);
        return $statment->execute();
        //return $this->email;
    }

    public function checkEmail() {
        
        $query = "SELECT * FROM USERS WHERE email = ?";
        $statment = $this->conn->prepare($query);
        if (! $statment) {

            return $statment;

        }

        $statment->bind_param("s", $this->email);
        $statment->execute();
        return $statment->get_result();

    }

    public function updateVerifyCode() {

        $query = 'UPDATE users SET verifiction_code = ? WHERE email = ? ';
        $statment = $this->conn->prepare($query);

        if (! $statment) {

            return $statment;

        }

        $statment->bind_param("is", $this->verifiction_code, $this->email);
        return $statment->execute();
        
    }
    public function updatePassword() {

        $query = 'UPDATE users SET password = ? WHERE email = ? ';
        $statment = $this->conn->prepare($query);

        if (! $statment) {

            return $statment;

        }

        $statment->bind_param("ss", $this->password, $this->email);
        return $statment->execute();
        
    }

    public function update() {
        
        $query = 'UPDATE users SET first_name = ? , last_name = ? , gender = ? WHERE email = ? ';
        $statment = $this->conn->prepare($query);
        $statment->bind_param("ssss", $this->first_name, $this->last_name, $this->gender, $this->email);
        return $statment->execute();

    }

    public function updateImage() {

        $query = 'UPDATE users SET image = ? WHERE email = ? ';
        $statment = $this->conn->prepare($query);
        if (! $statment) {

            return $statment;

        } 

        $statment->bind_param("ss", $this->image, $this->email);

        return $statment->execute();
    }









}



?>
<?php
namespace App\Models;

use App\Models\model;

class Category extends model {

    private $id;
    private $name_en;
    private $name_ar;
    private $details_en;
    private $details_ar;
    private $price;
    private $status;
    private $image;
    private $created_at;
    private $updated_at;


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
     * Get the value of name_en
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     */
    public function setNameEn($name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of name_ar
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     */
    public function setNameAr($name_ar): self
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of details_en
     */
    public function getDetailsEn()
    {
        return $this->details_en;
    }

    /**
     * Set the value of details_en
     */
    public function setDetailsEn($details_en): self
    {
        $this->details_en = $details_en;

        return $this;
    }

    /**
     * Get the value of details_ar
     */
    public function getDetailsAr()
    {
        return $this->details_ar;
    }

    /**
     * Set the value of details_ar
     */
    public function setDetailsAr($details_ar): self
    {
        $this->details_ar = $details_ar;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

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


    public function getRows(){

        $query = "SELECT * FROM categories WHERE status = 1";
        $statment = $this->conn->prepare($query);
        $statment->execute();
        return $statment->get_result();
        
    }

    public function find() {
        $query = "SELECT * FROM categories WHERE id = ? AND status = 1";
        $statment = $this->conn->prepare($query);
        $statment->bind_param("i", $this->id);
        $statment->execute();
        return $statment->get_result();
    }
    
}
<?php
namespace App\Models;

use App\Models\model;

class Review extends model {

    private $product_id;
    private $user_id;
    private $rate;
    private $comment;
    private $created_at;
    private $updated_at;





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


    /**
     * Get the value of product_id
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProductId($product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     */
    public function setRate($rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment($comment): self
    {
        $this->comment = $comment;

        return $this;
    }


    public function getProductReview() {

        $query = "SELECT CONCAT(users.first_name , ' ' , users.last_name) AS full_name,
        reviews.product_id,
        reviews.user_id,
        reviews.comment,
        reviews.rate,
        reviews.created_at,
        reviews.updated_at
        FROM
            `reviews`
        LEFT JOIN users ON users.id = reviews.user_id
        
        WHERE 
            reviews.product_id = ?";

        $statment = $this->conn->prepare($query);
        $statment->bind_param("i", $this->product_id);
        $statment->execute();
        return $statment->get_result();

    } 

    public function insertReview() {

        $query = "INSERT INTO reviews (product_id , user_id , rate, comment) VALUES (?,?,?,?)";
        $statment = $this->conn->prepare($query);
        $statment->bind_param("iiis", $this->product_id,$this->user_id,$this->rate,$this->comment);
        return $statment->execute();

    } 


    public function checkIfUserRev() {

        $query = "SELECT * FROM reviews WHERE user_id = ? AND product_id = ?";
        $statment = $this->conn->prepare($query);
        $statment->bind_param("ii", $this->user_id, $this->product_id);
        $statment->execute();
        return $statment->get_result();
    }



}
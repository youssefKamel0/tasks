<?php 

namespace App\Models;

class product extends model {


    private $id;
    private $name_en;
    private $name_ar;
    private $image;
    private $price;
    private $details_en;
    private $details_ar;
    private $quantity;
    private $created_at;
    private $updated_at;
    private $status;
    private $brand_id;
    private $subcategory_id;

    private $category_id;

    private const ACTIVE = 1;


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
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

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
     * Get the value of brand_id
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     */
    public function setBrandId($brand_id): self
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     */
    public function setSubcategoryId($subcategory_id): self
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }




    public function getNumOfProduct()
    {
        $query = "SELECT * FROM products WHERE status = " . self::ACTIVE;
        $statment = $this->conn->prepare($query);
        $statment->execute();

        return $statment->get_result();
    }

    public function getProductById(){

        $query = "SELECT * FROM product_details WHERE id = ?  AND status = " . self::ACTIVE; // مكان البرودكتس هنخلي الفيو الي هعمله النهاردة عشان هيبقي جي معاه كمان معلومات البراند اي دي والكاتجوري اي دي
        $statment = $this->conn->prepare($query);
        $statment->bind_param("s", $this->id);
        $statment->execute();
        return $statment->get_result();
        
    }


    /**
     * Get the value of category_id
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId($category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getNumOfProductBySub() {

        $query = "SELECT * FROM product_details WHERE subcategory_id = ?  AND status = " . self::ACTIVE;
        $statment = $this->conn->prepare($query);
        $statment->bind_param("s", $this->subcategory_id);
        $statment->execute();
        return $statment->get_result();
        
    }

    public function getNumOfProductByCat() {

        $query = "SELECT * FROM product_details WHERE category_id = ?  AND status = " . self::ACTIVE;
        $statment = $this->conn->prepare($query);
        $statment->bind_param("s", $this->category_id);
        $statment->execute();
        return $statment->get_result();
        
    }
    public function getNumOfProductByBrand() {

        $query = "SELECT * FROM products WHERE brand_id = ?  AND status = " . self::ACTIVE;
        $statment = $this->conn->prepare($query);
        $statment->bind_param("s", $this->brand_id);
        $statment->execute();
        return $statment->get_result();
        
    }


    public function showLatestProducts() {

        $query = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
        $statment = $this->conn->prepare($query);
        $statment->execute();
        return $statment->get_result();
        
    }

    
    public function showMostOrderd() {

        $query = "SELECT * FROM top_sales";
        $statment = $this->conn->prepare($query);
        $statment->execute();
        return $statment->get_result();

        /* CREATE VIEW `top_sales` AS SELECT products.name_en, products.image, products.price, products.details_en, products.quantity AS `avilable in stock`, COUNT(`product_id`) AS `num_of_orders` FROM ordes_products JOIN products ON products.id = ordes_products.product_id GROUP BY `product_id` ORDER BY COUNT(`product_id`) DESC LIMIT 4; */
        
    }















}




?>
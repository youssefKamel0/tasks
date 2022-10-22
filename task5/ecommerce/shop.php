<?php

use App\Models\Brands;
use App\Models\Category;
use App\Models\product;
use App\Models\Subcategories;

$title = "Shop";

include('layouts/header.php');
include('layouts/nav.php');
include('layouts/crumb.php');

$product = new product;
$subModel = new Subcategories;
$catModel = new Category;
$brandModel = new Brands;
$categoryModel = new Category;

if ($_GET) {

    if (isset($_GET['subcategory'])) {
        $subModel->setId($_GET['subcategory']);
        if ($subModel->find()->num_rows > 0) {

            $product->setSubcategoryId($_GET['subcategory']);
            $numOfProduct = $product->getNumOfProductBySub()->fetch_all(MYSQLI_ASSOC);
        } else {
            include('404.php');
            die;
        }
    } else if (isset($_GET['category'])) {
        $catModel->setId($_GET['category']);
        if ($catModel->find()->num_rows > 0) {

            $product->setCategoryId($_GET['category']);
            $numOfProduct = $product->getNumOfProductByCat()->fetch_all(MYSQLI_ASSOC);
        } else {

            include('404.php');
            die;
        }
    } else if (isset($_GET['brand'])) {

        $brandModel->setId($_GET['brand']);
        if ($brandModel->find()->num_rows > 0) {

            $product->setBrandId($_GET['brand']);
            $numOfProduct = $product->getNumOfProductByBrand()->fetch_all(MYSQLI_ASSOC);
        } else {
            include('404.php');
            die;
        }
    } else {
        include('404.php');
        die;
    }
} else {

    $numOfProduct = $product->getNumOfProduct()->fetch_all(MYSQLI_ASSOC);
}





?>
<!-- Shop Page Area Start -->
<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="shop-topbar-left">
                        <ul class="view-mode">
                            <li class="active"><a href="#product-grid" data-view="product-grid"><i class="fa fa-th"></i></a></li>
                            <li><a href="#product-list" data-view="product-list"><i class="fa fa-list-ul"></i></a></li>
                        </ul>

                        <p>Showing 1 - 20 of <?= count($numOfProduct) ?> results </p>
                    </div>
                    <div class="product-sorting-wrapper">
                        <div class="product-shorting shorting-style">
                            <label>View:</label>
                            <select>
                                <option value=""> 20</option>
                                <option value=""> 23</option>
                                <option value=""> 30</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">


                            <!-- loop here -->

                            <?php

                            foreach ($numOfProduct as $product) {   ?>

                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="product-details.php?name=<?= $product['name_en'] ?>&id=<?= $product['id'] ?>">
                                                <img style="height: 25rem;" alt="" src="assets/img/product/<?= $product['image'] ?>">
                                            </a>
                                            <div class="product-action">
                                                <a class="action-wishlist" href="#" title="Wishlist">
                                                    <i class="ion-android-favorite-outline"></i>
                                                </a>
                                                <a class="action-cart" href="#" title="Add To Cart">
                                                    <i class="ion-ios-shuffle-strong"></i>
                                                </a>
                                                <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                    <i class="ion-ios-search-strong"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content text-left">
                                            <div class="product-hover-style">
                                                <div class="product-title">
                                                    <h4>
                                                        <a href="product-details.php"> <?= $product['name_en'] ?> </a>
                                                    </h4>
                                                </div>
                                                <div class="cart-hover">
                                                    <h4><a href="product-details.php">+ Add to cart</a></h4>
                                                </div>
                                            </div>
                                            <div class="product-price-wrapper">
                                                <span><?= $product['price'] ?>EGP</span>
                                            </div>
                                        </div>
                                        <div class="product-list-details">
                                            <h4>
                                                <a href="product-details.php"> <?= $product['name_en'] ?> </a>
                                            </h4>
                                            <div class="product-price-wrapper">
                                                <span><?= $product['price'] ?>EGP</span>
                                            </div>
                                            <p> <?= $product['details_en'] ?> </p>
                                            <div class="shop-list-cart-wishlist">
                                                <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                                <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                    <i class="ion-ios-search-strong"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                    <div class="pagination-total-pages">
                        <div class="pagination-style">
                            <ul>
                                <li><a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i> </a></li>
                            </ul>
                        </div>
                        <div class="total-pages">
                            <p>Showing 1 - 20 of <?= count($numOfProduct) ?> results </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq">



                                <?php

                                $categoryrOWS = $categoryModel->getRows()->fetch_all(MYSQLI_ASSOC);

                                foreach ($categoryrOWS as $category) {
                                    $subModel->setCategoryId($category['id']);
                                    $subRows = $subModel->getSubByCatId(); ?>

                                    <li> <a data-toggle="collapse" style="font-weight: bold;" data-parent="#faq" href="shop.php?category=<?= $category['id'] ?>"><?= $category['name_en'] ?> <i class="ion-ios-arrow-down"></i></a>
                                        <ul id="shop-catigory-1" class="panel-collapse collapse show">
                                            <?php foreach ($subRows as $subcategory) { ?>
                                                <li><a href="shop.php?subcategory=<?= $subcategory['id'] ?>"><?= $subcategory['name_en'] ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>


                                <?php } ?>





                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Page Area End -->
<?php
include "layouts/footer.php";
include "layouts/scripts.php";
?>
<?php

use App\Models\product;
use App\Models\Review;
use App\Requests\Validition;

$title = $_GET['name'];
include('layouts/header.php');
include('layouts/nav.php');
include('layouts/crumb.php');

$product = new product;

$productData = $product->setId($_GET['id'])->getProductById()->fetch_object();


$review = new Review;

$ReviewRows = $review->setProductId($productData->id)->getProductReview();

// add review 
    // validate inputs
    $validation = new Validition;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation->setInputValue($_POST['message'])->setInputName('message')->required();

    // insert into db

    if (empty($validation->getErrorsList())) {

        $review->setUserId($_SESSION['user']->id)->setProductId($productData->id);

        if ($review->checkIfUserRev()->num_rows > 0) {

            $error = "<div class= 'alert alert-danger'> You Already Reviewed This Product </div>";

        } else {

            $review->setRate($_POST['star'])->setComment($_POST['message']);
            if ( $review->insertReview() ) {

                header("Refresh:0");

            } else { // developer mistake
        
                $error = "<div class= 'alert alert-danger'> unexpected Error, Please Try Again </div>";
        
            }

        }


    }

}


?>
<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img style="height: 25rem ;" class="zoompro" src="assets/img/product/<?= $productData->image ?>" data-zoom-image="assets/img/product-details/product-detalis-bl1.jpg" alt="zoom" />
                    <div id="gallery" class="mt-20 product-dec-slider owl-carousel">
                        <a data-image="assets/img/product-details/product-detalis-l1.jpg" data-zoom-image="assets/img/product-details/product-detalis-bl1.jpg">
                            <img src="assets/img/product-details/product-detalis-s1.jpg" alt="">
                        </a>
                        <a data-image="assets/img/product-details/product-detalis-l2.jpg" data-zoom-image="assets/img/product-details/product-detalis-bl2.jpg">
                            <img src="assets/img/product-details/product-detalis-s2.jpg" alt="">
                        </a>
                        <a data-image="assets/img/product-details/product-detalis-l3.jpg" data-zoom-image="assets/img/product-details/product-detalis-bl3.jpg">
                            <img src="assets/img/product-details/product-detalis-s3.jpg" alt="">
                        </a>
                        <a data-image="assets/img/product-details/product-detalis-l4.jpg" data-zoom-image="assets/img/product-details/product-detalis-bl4.jpg">
                            <img src="assets/img/product-details/product-detalis-s4.jpg" alt="">
                        </a>
                        <a data-image="assets/img/product-details/product-detalis-l5.jpg" data-zoom-image="assets/img/product-details/product-detalis-bl5.jpg">
                            <img src="assets/img/product-details/product-detalis-s5.jpg" alt="">
                        </a>
                        <a data-image="assets/img/product-details/product-detalis-l2.jpg" data-zoom-image="assets/img/product-details/product-detalis-bl2.jpg">
                            <img src="assets/img/product-details/product-detalis-s2.jpg" alt="">
                        </a>
                    </div>
                    <span>-29%</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $productData->name_en ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-review">
                            <ul>
                                <li> <?= $ReviewRows->num_rows ?> Reviews </li>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <li> <a href="#"> Add Your Reviews</a> </li>
                                <?php } else {
                                    echo '<li> <a href="login.php"> Sign In To Add Review </a> </li>';
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <span><?= $productData->price ?>EGP</span>
                    <div class="in-stock">
                        <?php

                        if ($productData->quantity == 0) {
                            $message = "out of stock";
                            $color = 'danger';
                        } else if ($productData->quantity > 0 && $productData->quantity <= 5) {
                            $message = " in stock ({$productData->quantity}) ";
                            $color = 'warning';
                        } else {
                            $message = " In stock";
                            $color = 'success';
                        }
                        ?>
                        <p>Available:<span class="text-<?= $color ?>"><?= $message ?></span></p>
                    </div>
                    <p><?= $productData->details_en ?> </p>
                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <select class="form-control">
                                <?php
                                for ($i = 1; $i < $productData->quantity + 1; $i++) { ?>

                                    <option value="<?= $i ?>"><?= $i ?></option>

                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title">Categories:</li>
                            <li><a href="shop.php?category=<?= $productData->category_id ?>"><?= $productData->category_name_en ?>,</a></li>
                            <li><a href="shop.php?subcategory=<?= $productData->subcategory_id ?>"><?= $productData->subcategory_name_en ?>,</a></li>
                            <li><a href="shop.php?brand=<?= $productData->brand_id ?>"><?= $productData->brand_name_en ?></a></li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p> <?= $productData->details_en ?> </p>

                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">

                        <?php

                        if ($ReviewRows->num_rows >= 1) {
                            foreach ($ReviewRows->fetch_all(MYSQLI_ASSOC) as $review) {  ?>

                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php for ($i = 0; $i < $review['rate']; $i++) { ?>

                                                <i class="ion-star theme-color"></i>

                                            <?php } ?>
                                            <?php for ($i = 0; $i < 5 - $review['rate']; $i++) { ?>

                                                <i class="ion-android-star-outline theme-color"></i>

                                            <?php } ?>
                                            <span>(<?= $review['rate'] ?>)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3><?= $review['full_name'] ?></h3>
                                            <span><?= $review['created_at'] ?></span>
                                        </div>
                                    </div>
                                    <p><?= $review['comment'] ?>.</p>
                                </div>

                        <?PHP
                            }
                        } else {
                            echo 'No Reviews Yet';
                        }
                        ?>
                    </div>

                    <style>
                        svg {
                            width: 3rem;
                            height: 3rem;
                            padding: 0.15rem;
                        }


                        /* hide radio buttons */

                        input[name="star"] {
                            display: inline-block;
                            width: 0;
                            opacity: 0;
                            margin-left: -2px;
                        }

                        /* hide source svg */

                        .star-source {
                            width: 0;
                            height: 0;
                            visibility: hidden;
                        }


                        /* set initial color to transparent so fill is empty*/

                        .star {
                            color: transparent;
                            transition: color 0.2s ease-in-out;
                        }

                        label {
                            cursor:pointer;
                        }


                        /* set direction to row-reverse so 5th star is at the end and ~ can be used to fill all sibling stars that precede last starred element*/

                        .star-container {
                            display: flex;
                            flex-direction: row-reverse;
                            justify-content: center;
                        }

                        label:hover~label .star,
                        svg.star:hover,
                        input[name="star"]:focus~label .star,
                        input[name="star"]:checked~label .star {
                            color: #d62a9d;
                        }

                        input[name="star"]:checked+label .star {
                            animation: starred 0.5s;
                        }

                        input[name="star"]:checked+label {
                            animation: scaleup 1s;
                        }

                        @keyframes scaleup {
                            from {
                                transform: scale(1.2);
                            }

                            to {
                                transform: scale(1);
                            }
                        }

                        @keyframes starred {
                            from {
                                color: #600040;
                            }

                            to {
                                color: #d62a9d;
                            }
                        }
                    </style>

                    <?php if (isset($_SESSION['user'])) { ?>
                        <?= $error ?? "" ?>
                        <?= $sucMessage ?? "" ?>
                        <div class="ratting-form-wrapper">
                            <h3>Add your Comments :</h3>
                            <div class="ratting-form">
                                <form method="POST">
                                    <div class="star-box">
                                        <h2>Rating:</h2>
                                        <div class="star-source">
                                            <svg>
                                                <linearGradient x1="50%" y1="5.41294643%" x2="87.5527344%" y2="65.4921875%" id="grad">
                                                    <stop stop-color="#bf209f" offset="0%"></stop>
                                                    <stop stop-color="#d62a9d" offset="60%"></stop>
                                                    <stop stop-color="#ED009E" offset="100%"></stop>
                                                </linearGradient>
                                                <symbol id="star" viewBox="153 89 106 108">
                                                    <polygon id="star-shape" stroke="url(#grad)" stroke-width="5" fill="currentColor" points="206 162.5 176.610737 185.45085 189.356511 150.407797 158.447174 129.54915 195.713758 130.842203 206 95 216.286242 130.842203 253.552826 129.54915 222.643489 150.407797 235.389263 185.45085"></polygon>
                                                </symbol>
                                            </svg>

                                        </div>
                                        <div class="star-container">
                                            <input type="radio" name="star" value="5" id="five">
                                            <label for="five">
                                                <svg class="star">
                                                    <use xlink:href="#star" />
                                                </svg>
                                            </label>
                                            <input type="radio" name="star" value="4" id="four">
                                            <label for="four">
                                                <svg class="star">
                                                    <use xlink:href="#star" />
                                                </svg>
                                            </label>
                                            <input type="radio" name="star" value="3" id="three">
                                            <label for="three">
                                                <svg class="star">
                                                    <use xlink:href="#star" />
                                                </svg>
                                            </label>
                                            <input type="radio" name="star" value="2" id="two">
                                            <label for="two">
                                                <svg class="star">
                                                    <use xlink:href="#star" />
                                                </svg>
                                            </label>
                                            <input type="radio" name="star" value="1" id="one" checked="checked">
                                            <label for="one">
                                                <svg class="star">
                                                    <use xlink:href="#star" />
                                                </svg>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="rating-form-style form-submit">
                                                <textarea name="message" placeholder="Message"></textarea>
                                                <?= $validation->error('message') ?? "" ?>
                                                <input type="submit" placeholder="add review">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } else {
                        echo "Sign In To Add Review";
                    } ?>





                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-white">Related Products</h3>
            </div>
        </div>
        <div class="featured-product-active hot-flower owl-carousel product-nav">
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.php">
                        <img alt="" src="assets/img/product/product-1.jpg">
                    </a>
                    <span>-30%</span>
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
                                <a href="product-details.php">Le Bongai Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.php">
                        <img alt="" src="assets/img/product/product-2.jpg">
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
                                <a href="product-details.php">Society Ice Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.php">
                        <img alt="" src="assets/img/product/product-3.jpg">
                    </a>
                    <span>-30%</span>
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
                                <a href="product-details.php">Green Tea Tulsi</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.php">
                        <img alt="" src="assets/img/product/product-4.jpg">
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
                                <a href="product-details.php">Best Friends Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.php">
                        <img alt="" src="assets/img/product/product-5.jpg">
                    </a>
                    <span>-30%</span>
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
                                <a href="product-details.php">Instant Tea Premix</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer style Start -->
<footer class="footer-area pt-75 gray-bg-3">
    <div class="footer-top gray-bg-3 pb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title mb-25">
                            <h4>My Account</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="my-account.php">My Account</a></li>
                                <li><a href="about-us.php">Order History</a></li>
                                <li><a href="wishlist.php">WishList</a></li>
                                <li><a href="#">Newsletter</a></li>
                                <li><a href="about-us.php">Order History</a></li>
                                <li><a href="#">International Orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title mb-25">
                            <h4>Information</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="about-us.php">About Us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title mb-25">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="#">Support Center</a></li>
                                <li><a href="#">Term & Conditions</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">FAQS</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer-widget-red footer-black-color mb-40">
                        <div class="footer-title mb-25">
                            <h4>Contact Us</h4>
                        </div>
                        <div class="footer-about">
                            <p>Your current address goes to here,120 haka, angladesh</p>
                            <div class="footer-contact mt-20">
                                <ul>
                                    <li>(+008) 254 254 254 25487</li>
                                    <li>(+009) 358 587 657 6985</li>
                                </ul>
                            </div>
                            <div class="footer-contact mt-20">
                                <ul>
                                    <li>yourmail@example.com</li>
                                    <li>example@admin.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pb-25 pt-25 gray-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright">
                        <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="payment-img f-right">
                        <a href="#">
                            <img alt="" src="assets/img/icon-img/payment.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer style End -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="assets/img/product-details/product-detalis-l1.jpg" alt="">
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="assets/img/product-details/product-detalis-l2.jpg" alt="">
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="assets/img/product-details/product-detalis-l3.jpg" alt="">
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="assets/img/product-details/product-detalis-l4.jpg" alt="">
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="product-thumbnail">
                            <div class="thumb-menu owl-carousel nav nav-style" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="assets/img/product-details/product-detalis-s1.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-2"><img src="assets/img/product-details/product-detalis-s2.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-3"><img src="assets/img/product-details/product-detalis-s3.jpg" alt=""></a>
                                <a data-toggle="tab" href="#pro-4"><img src="assets/img/product-details/product-detalis-s4.jpg" alt=""></a>
                            </div>
                        </div>
                        <!-- Thumbnail image end -->
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="modal-pro-content">
                            <h3>Dutchman's Breeches </h3>
                            <div class="product-price-wrapper">
                                <span class="product-price-old">£162.00 </span>
                                <span>£120.00</span>
                            </div>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet.</p>
                            <div class="quick-view-select">
                                <div class="select-option-part">
                                    <label>Size*</label>
                                    <select class="select">
                                        <option value="">S</option>
                                        <option value="">M</option>
                                        <option value="">L</option>
                                    </select>
                                </div>
                                <div class="quickview-color-wrap">
                                    <label>Color*</label>
                                    <div class="quickview-color">
                                        <ul>
                                            <li class="blue">b</li>
                                            <li class="red">r</li>
                                            <li class="pink">p</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-quantity">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                </div>
                                <button>Add to cart</button>
                            </div>
                            <span><i class="fa fa-check"></i> In stock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<!-- all js here -->
<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/ajax-mail.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>
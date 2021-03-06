<header class="header header--standard header--electronic" data-sticky="true">
    <div class="header__top">
        <div class="container">
            <div class="header__left">
                <p>Welcome to Martfury Online Shopping Store !</p>
            </div>
            <div class="header__right">
                <ul class="header__top-links">
                    <li><a href="#">Store Location</a></li>
                    <li><a href="#">Track Your Order</a></li>
                    <li>
                        <div class="ps-dropdown"><a href="#">US Dollar</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#">Us Dollar</a></li>
                                <li><a href="#">Euro</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="ps-dropdown language"><a href="#"><img src="<?= base_url("assets/") ?>img/flag/en.png" alt="">English</a>
                            <ul class="ps-dropdown-menu">
                                <li><a href="#"><img src="<?= base_url("assets/") ?>img/flag/germany.png" alt=""> Germany</a></li>
                                <li><a href="#"><img src="<?= base_url("assets/") ?>img/flag/fr.png" alt=""> France</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header__content">
        <div class="container">
            <div class="header__content-left"><a class="ps-logo" href="index.html"><img src="<?= base_url('uploads/logo/' . $site_info_data['site_logo']) ?>" alt=""></a>
                <div class="menu--product-categories">
                    <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Department</span></div>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <li><a href="#"><i class="icon-star"></i> Hot Promotions</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a href="#"><i class="icon-laundry"></i> Consumer Electronic</a>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Electronic<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#">Home Audio &amp; Theathers</a>
                                            </li>
                                            <li><a href="#">TV &amp; Videos</a>
                                            </li>
                                            <li><a href="#">Camera, Photos &amp; Videos</a>
                                            </li>
                                            <li><a href="#">Cellphones &amp; Accessories</a>
                                            </li>
                                            <li><a href="#">Headphones</a>
                                            </li>
                                            <li><a href="#">Videosgames</a>
                                            </li>
                                            <li><a href="#">Wireless Speakers</a>
                                            </li>
                                            <li><a href="#">Office Electronic</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-menu__column">
                                        <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#">Digital Cables</a>
                                            </li>
                                            <li><a href="#">Audio &amp; Video Cables</a>
                                            </li>
                                            <li><a href="#">Batteries</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#"><i class="icon-shirt"></i> Clothing &amp; Apparel</a>
                            </li>
                            <li><a href="#"><i class="icon-lampshade"></i> Home, Garden &amp; Kitchen</a>
                            </li>
                            <li><a href="#"><i class="icon-heart-pulse"></i> Health &amp; Beauty</a>
                            </li>
                            <li><a href="#"><i class="icon-diamond2"></i> Yewelry &amp; Watches</a>
                            </li>
                            <li class="menu-item-has-children has-mega-menu"><a href="#"><i class="icon-desktop"></i> Computer &amp; Technology</a>
                                <div class="mega-menu">
                                    <div class="mega-menu__column">
                                        <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                            <li><a href="#">Computer &amp; Tablets</a>
                                            </li>
                                            <li><a href="#">Laptop</a>
                                            </li>
                                            <li><a href="#">Monitors</a>
                                            </li>
                                            <li><a href="#">Networking</a>
                                            </li>
                                            <li><a href="#">Drive &amp; Storages</a>
                                            </li>
                                            <li><a href="#">Computer Components</a>
                                            </li>
                                            <li><a href="#">Security &amp; Protection</a>
                                            </li>
                                            <li><a href="#">Gaming Laptop</a>
                                            </li>
                                            <li><a href="#">Accessories</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#"><i class="icon-baby-bottle"></i> Babies &amp; Moms</a>
                            </li>
                            <li><a href="#"><i class="icon-baseball"></i> Sport &amp; Outdoor</a>
                            </li>
                            <li><a href="#"><i class="icon-smartphone"></i> Phones &amp; Accessories</a>
                            </li>
                            <li><a href="#"><i class="icon-book2"></i> Books &amp; Office</a>
                            </li>
                            <li><a href="#"><i class="icon-car-siren"></i> Cars &amp; Motocycles</a>
                            </li>
                            <li><a href="#"><i class="icon-wrench"></i> Home Improments</a>
                            </li>
                            <li><a href="#"><i class="icon-tag"></i> Vouchers &amp; Services</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header__content-center">
                <form class="ps-form--quick-search" action="http://nouthemes.net/html/martfury/index.html" method="get">
                    <div class="form-group--icon"><i class="icon-chevron-down"></i>
                        <select class="form-control">
                            <option value="1">All</option>
                            <option value="1">Smartphone</option>
                            <option value="1">Sounds</option>
                            <option value="1">Technology toys</option>
                        </select>
                    </div>
                    <input class="form-control" type="text" placeholder="I'm shopping for...">
                    <button>Search</button>
                </form>
                <div class="search__results">
                 
                </div>
            </div>
            <div class="header__content-right">
                <div class="header__actions"><a class="header__extra" href="#"><i class="icon-heart"></i><span><i>0</i></span></a>
                    <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i>0</i></span></a>
                        <div class="ps-cart__content">
                            <div class="ps-cart__items">
                                <div class="ps-product--cart-mobile">
                                    <div class="ps-product__thumbnail"><a href="#"><img src="<?= base_url("assets/") ?>img/products/clothing/7.jpg" alt=""></a></div>
                                    <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                        <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                    </div>
                                </div>
                                <div class="ps-product--cart-mobile">
                                    <div class="ps-product__thumbnail"><a href="#"><img src="<?= base_url("assets/") ?>img/products/clothing/5.jpg" alt=""></a></div>
                                    <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                        <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-cart__footer">
                                <h3>Sub Total:<strong>$59.99</strong></h3>
                                <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
                            </div>
                        </div>
                    </div>
                    <div class="ps-block--user-header">
                        <div class="ps-block__left"><i class="icon-user"></i></div>
                        <div class="ps-block__right"><a href="my-account.html">Login</a><a href="my-account.html">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container">
            <ul class="menu menu--electronic">
                <li class="menu-item-has-children"><a href="<?= base_url() ?>"><i class="icon-home"></i> Home</a><span class="sub-toggle"></span>
                    <ul class="sub-menu">
                        <li class="current-menu-item "><a href="<?= base_url() ?>">Marketplace Full Width</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-2.html">Home Auto Parts</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-10.html">Home Technology</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-9.html">Home Organic</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-3.html">Home Marketplace V1</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-4.html">Home Marketplace V2</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-5.html">Home Marketplace V3</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-6.html">Home Marketplace V4</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-7.html">Home Electronic</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-8.html">Home Furniture</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-kids.html">Home Kids</a>
                        </li>
                        <li class="current-menu-item "><a href="homepage-photo-and-video.html">Home photo and picture</a>
                        </li>
                    </ul>
                </li>
                <li><a href="homepage-4.html"><i class="icon-laundry"></i> Home Electronics</a>
                </li>
                <li><a href="homepage-4.html"><i class="icon-laptop"></i> Computer &amp; Technology</a>
                </li>
                <li><a href="homepage-4.html"><i class="icon-camera2"></i> Camera &amp; Videos</a>
                </li>
                <li><a href="homepage-4.html"><i class="icon-surveillance"></i> Office Electronics</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<template>
        <!-- ****** Welcome Slides Area Start ****** -->
        <!-- OWL CAROUSEL NOT WORKING -->
        <!-- ****** Welcome Slides Area End ****** -->

        <!-- ****** Top Catagory Area Start ****** -->
        <section class="top_catagory_area d-md-flex clearfix">
            <!-- Single Catagory -->
            <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(backend_theme/img/bg-img/bg-2.jpg);">
                <div class="catagory-content">
                    <h6>On Accesories</h6>
                    <h2>Sale 30%</h2>
                    <a href="#" class="btn karl-btn">SHOP NOW</a>
                </div>
            </div>
            <!-- Single Catagory -->
            <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(backend_theme/img/bg-img/bg-3.jpg);">
                <div class="catagory-content">
                    <h6>in Bags excepting the new collection</h6>
                    <h2>Designer bags</h2>
                    <a href="#" class="btn karl-btn">SHOP NOW</a>
                </div>
            </div>
        </section>
        <!-- ****** Top Catagory Area End ****** -->

        <!-- ****** New Arrivals Area Start ****** -->
        <section class="new_arrivals_area section_padding_100_0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>New Arrivals</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="karl-projects-menu mb-100">
                <div class="text-center portfolio-menu">
                    <button class="btn active" data-filter="*">ALL</button>
                    <button class="btn" data-filter=".women">WOMAN</button>
                    <button class="btn" data-filter=".man">MAN</button>
                    <button class="btn" data-filter=".access">ACCESSORIES</button>
                    <button class="btn" data-filter=".shoes">shoes</button>
                    <button class="btn" data-filter=".kids">KIDS</button>
                </div>
            </div> -->

            <div class="container">
                <div class="row karl-new-arrivals">
                    <!-- Single gallery Item Start -->
                    <div v-for="(stock) in stocklists" :key="stock.id" class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-bs-wow-delay="0.2s">
                        <!-- Product Image -->
                        <div class="product-img" style="height: 380px;">
                            <img v-bind:src="'/' + stock.path" /> 
                            <div class="product-quicview">
                                <a href="#" data-bs-toggle="modal" v-bind:data-bs-target="'#quickview' + stock.id"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">&#8369;{{stock.tag_price}}</h4>
                            <p>{{stock.brand}} {{stock.style}} {{stock.color}} {{stock.description}} {{stock.size}}</p>
                        </div>

                        <!-- ****** Quick View Modal Area Start ****** -->
                        <div class="modal fade" v-bind:id="'quickview' + stock.id" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close btn float-end" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="modal-body">
                                        <div class="quickview_body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12 col-lg-5">
                                                        <div class="quickview_pro_img">
                                                            <img v-bind:src="'/' + stock.path"/> 
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-7">
                                                        <div class="quickview_pro_des">
                                                            <h4 class="title">{{stock.brand_name}} {{stock.style}}</h4>
                                                            <div class="top_seller_product_rating mb-15">
                                                                <i v-for="index in stock.score_condition_id" :key="index" class="fa fa-shopping-bag" aria-hidden="true" style="font-size: 18px; color: #800000;"></i>
                                                            </div>
                                                            <h5 class="price">
                                                                &#8369;{{stock.tag_price}} 
                                                                <span v-if="stock.before_price">&#8369;{{stock.before_price}}</span>
                                                            </h5>
                                                            <p>{{stock.brand_name}} {{stock.style}} {{stock.color}} {{stock.description}} {{stock.size}}</p>

                                                            <a class="btn btn-light text-decoration-none" :href="'/stock_detail/' + stock.id">View Full Product Details</a>

                                                            <!-- NEED TO STABILIZE THE STOCK DETAILS NAPUPUTOL -->
                                                            <!-- <router-link :to="{name: 'stock detail', params: { stockId: stock.id }}" class="btn btn-primary">View Full Product Details</router-link> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ****** Quick View Modal Area End ****** -->
                    </div>
                </div>
            </div>
        </section>
        <!-- ****** New Arrivals Area End ****** -->

        <!-- ****** Offer Area Start ****** -->
        <section class="offer_area height-700 section_padding_100 bg-img" style="background-image: url(backend_theme/img/bg-img/bg-5.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-end justify-content-end">
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                            <h2>TESTING WORDS <span class="karl-level">Hot</span></h2>
                            <p>SAMPLE SAMPLE SAMPLE</p>
                            <div class="offer-product-price">
                                <h3><span class="regular-price">$25.90</span> $15.90</h3>
                            </div>
                            <a href="#" class="btn karl-btn mt-30">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ****** Offer Area End ****** -->
</template>
 
<script>
    export default {
        data() {
            return {
                stocklists: [],
                counter: 0,
            }
        },
        created() {
            this.axios
                .get(this.websiteLink + '/api/stocks')
                .then(response => {
                    this.stocklists = response.data;
                });
        },
        methods: {},
        props: ['websiteLink'],
    }
</script>
<template>
        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
        <section class="single_product_details_area section_padding_0_100 pt-5">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-bs-ride="carousel">

                                <ol class="carousel-indicators" style="height: 120px;">
                                    <li class="active" data-bs-target="#product_details_slider" data-bs-slide-to="0" v-bind:style="{ 'background-image': 'url(/' + stock[0].path + ')', 'height': 'inherit' }">
                                    </li>
                                    <li data-bs-target="#product_details_slider" data-bs-slide-to="1" v-bind:style="{ 'background-image': 'url(/' + stock[1].path + ')', 'height': 'inherit' }">
                                    </li>
                                    <li data-bs-target="#product_details_slider" data-bs-slide-to="2" v-bind:style="{ 'background-image': 'url(/' + stock[2].path + ')', 'height': 'inherit' }">
                                    </li>
                                    <li data-bs-target="#product_details_slider" data-bs-slide-to="3" v-bind:style="{ 'background-image': 'url(/' + stock[3].path + ')', 'height': 'inherit' }">
                                    </li>
                                </ol>

                                <div class="carousel-inner pb-5 border-0">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" v-bind:src="'/' + stock[0].path" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" v-bind:src="'/' + stock[1].path" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" v-bind:src="'/' + stock[2].path" alt="Third slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" v-bind:src="'/' + stock[3].path" alt="Fourth slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">
                            <div class="mx-3">
                                <h4 class="title">
                                    <router-link :to="{name: 'stocklist display', params: { category: category, brandId: stock[0].brand_id, styleId: stock[0].style_id }}">
                                        {{stock[0].brand_name}} {{stock[0].style}}
                                    </router-link>
                                </h4>

                                <h4 class="price">&#8369;{{stock[0].tag_price}}</h4>

                                <p class="available">Available: <span class="text-muted">In Stock</span></p>

                                <div class="single_product_ratings mb-15">
                                    <i v-for="index in stock[0].score_condition_id" :key="index" class="fa fa-shopping-bag" aria-hidden="true" style="font-size: 20px; color: #800000;"></i>
                                </div>
                            </div>
                            


                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information</a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <p>{{stock[0].color}} {{stock[0].description}} {{stock[0].size}}</p>
                                            <p>{{stock[0].other_remarks}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Catalog Information</a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <p> Model: {{stock[0].model}}</p>
                                            <p> {{stock[0].catalog_notes}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

        <!-- <<<<<<<<<<<<<<<<<<<< RELATED PRODUCTS >>>>>>>>>>>>>>>>>>>>>>>> -->
        <section class="new_arrivals_area section_padding_100_0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>RELATED PRODUCTS</h2>
                        </div>
                    </div>
                </div>
            </div>

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
 
</template>
 
<script>
    export default {
        data() {
            return {
                stock: {},
                category: "ALL",
                stocklists: [],
            }
        },
        created() {
            this.axios
                .get(`${this.websiteLink}/api/stocks/view/${this.$route.params.stockId}`)
                .then((response) => {
                    this.stock = response.data;
                });
            
            this.axios
                .get(`${this.websiteLink}/api/stocks/view/related_stocks/${this.$route.params.stockId}`)
                .then((response) => {
                    this.stocklists = response.data;
                });
        },
        methods: {},
        props: ['websiteLink'],
    }
</script>
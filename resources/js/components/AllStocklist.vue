<template>
        <section class="shop_grid_area section_padding_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="shop_sidebar_area">
                            <div class="widget catagory mb-50">
                                <!--  Side Nav  -->
                                <div class="nav-side-menu">
                                    <h6 class="my-0">FILTER SECTION</h6>
                                </div>
                            </div>

                            <div class="widget price mb-50">
                                <h6 class="widget-title mb-30">Sort by {{sorting}}</h6>
                                <div class="widget-desc">
                                    <ul id="menu-content2" class="out">
                                        <!-- Single Item -->
                                        <li>
                                            <div class="form-check">
                                                <input v-model="sorting" @change="updateSortingAjax()" class="form-check-input" type="radio" name="sorting" id="sortingNewest" value="NEWEST" checked>
                                                <label class="form-check-label" for="sortingNewest">
                                                    NEWEST
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input v-model="sorting" @change="updateSortingAjax()" class="form-check-input" type="radio" name="sorting" id="sortingHighest" value="HIGHEST">
                                                <label class="form-check-label" for="sortingHighest">
                                                    HIGHEST
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input v-model="sorting" @change="updateSortingAjax()" class="form-check-input" type="radio" name="sorting" id="sortingLowest" value="LOWEST">
                                                <label class="form-check-label" for="sortingLowest">
                                                    LOWEST
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="widget price mb-50">
                                <h6 class="widget-title mb-30">Filter by Price</h6>
                                <div class="widget-desc">
                                    <div class="slider-range">
                                        <input v-model="maxPrice" type="range" @change="updateSortingAjax()" class="form-range w-100" :min="constantMinPrice + 20000" :max="constantMaxPrice" step="20000" id="maxPrice" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Maximum Price">
                                        <div class="range-price">Price: {{minPrice}} - {{maxPrice}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget color mb-70">
                                <h6 class="widget-title mb-30">Filter by Color {{color}}</h6>
                                <div class="widget-desc">
                                    <ul id="menu-color" class="out">
                                        <li>
                                            <div class="form-check">
                                                <input v-model="color" @change="updateSortingAjax()" class="form-check-input" type="radio" name="color" id="radioColorAll" value="ALL" checked>
                                                <label class="form-check-label" for="radioColorAll">
                                                    ALL
                                                </label>
                                            </div>
                                        </li>
                                        <li  v-for="(color_name) in colorList" :key="color_name.id">
                                            <div class="form-check">
                                                <input v-model="color" @change="updateSortingAjax()" class="form-check-input" type="radio" name="color" :id="'radio' + color_name" :value="color_name">
                                                <label class="form-check-label" :for="'radio' + color">
                                                    {{color_name}}
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="widget mb-50">
                                <h6 class="widget-title mb-30">Filter by Size {{size}}</h6>
                                <div class="widget-desc">
                                    <ul id="menu-size" class="out">
                                        <li>
                                            <div class="form-check">
                                                <input v-model="size" @change="updateSortingAjax()" class="form-check-input" type="radio" name="size" id="radioSizeAll" value="ALL" checked>
                                                <label class="form-check-label" for="radioSizeAll">
                                                    ALL
                                                </label>
                                            </div>
                                        </li>
                                        <li  v-for="(measurement) in sizeList" :key="measurement.id">
                                            <div class="form-check">
                                                <input v-model="size" @change="updateSortingAjax()" class="form-check-input" type="radio" name="size" :id="'radio' + measurement" :value="measurement">
                                                <label class="form-check-label" :for="'radio' + measurement">
                                                    {{measurement}}
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="shop_grid_product_area">
                            <h4 v-if="countStocks > 1 && keyword" class="mb-5">Search for the keyword "{{keyword}}" has {{countStocks}} items.</h4>
                            <h4 v-else-if="countStocks <= 1 && keyword" class="mb-5">Search for the keyword "{{keyword}}" has {{countStocks}} item.</h4>
                            <h4 v-else-if="countStocks > 1 && category" class="mb-5">Search for {{category}}, {{brandName}}, and {{styleName}} has {{countStocks}} items.</h4>
                            <h4 v-else-if="countStocks <= 1 && category" class="mb-5">Search for {{category}}, {{brandName}}, and {{styleName}} has {{countStocks}} item.</h4>
                            <h4 v-else-if="countStocks > 1" class="mb-5">Search for "ALL STOCKS" has {{countStocks}} item.</h4>
                            <h4 v-else class="mb-5">Search for "ALL STOCKS" has {{countStocks}} item.</h4>
                            <h4></h4>
                            <div class="row">
                                <!-- Single gallery Item -->
                                <div v-for="(stock) in stocklists[x]" :key="stock.id" class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-bs-wow-delay="0.2s">
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
                        

                        <div class="shop_pagination_area wow fadeInUp" data-bs-wow-delay="1.1s">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm">
                                    <li v-if="countStocks" v-bind:class="{ active: isActive, 'page-item': hasImplemented }"><a @click="paginationCounter(0)" class="page-link" href="#">1</a></li>

                                    <li v-for="number in paginationCreateIndex" :key="number" class="page-item">
                                        <a @click="paginationCounter(number.x)" class="page-link" href="#">{{number.z}}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </section>
</template>
 
<script>
    export default {
        data() {
            return {
                x: 0,
                constantStocklists: [],
                stocklists: [],
                countStocks: '',
                category: this.$route.params.category,
                keyword: this.$route.params.keyword,
                brandName: '',
                styleName: '',
                colorList: [],
                color: 'ALL',
                sizeList: [],
                size: 'ALL',
                isActive: true,
                hasImplemented: true,
                sorting: 'NEWEST',
                minPrice: 0,
                maxPrice: 0,
                constantMinPrice: 0,
                constantMaxPrice: 0,


                //VARAIBLE CHECKER 
                sampleAjax: [],
            }
        },
        props: ['websiteLink'],
        mounted() {
            this.axios
                .post(this.websiteLink + '/api/stocks/shop', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId})
                .then(response => {
                    this.stocklists = response.data;
                });
            this.axios
                .post(this.websiteLink + '/api/stocks/count', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId})
                .then(response => {
                    this.countStocks = response.data;
                });
            // SIZE AND COLOR LIST
            this.axios
                .post(this.websiteLink + '/api/stocks/colorlist', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId})
                .then(response => {
                    this.colorList = response.data;
                });
            this.axios
                .post(this.websiteLink + '/api/stocks/sizelist', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId})
                .then(response => {
                    this.sizeList = response.data;
                });
            // CONVERT TO GET THE BRAND AND STYLE
            this.axios
                .get(`${this.websiteLink}/api/stocks/brand/${this.$route.params.brandId}`)
                .then(response => {
                    this.brandName = response.data;
                });
            this.axios
                .get(`${this.websiteLink}/api/stocks/style/${this.$route.params.styleId}`)
                .then(response => {
                    this.styleName = response.data;
                });
            //MIN AND MAX PRICE IN THE RANGE INPUT
            this.axios
                .post(this.websiteLink + '/api/stocks/minPrice', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId})
                .then(response => {
                    if(response.data % 20000 != 0)
                    {
                        this.constantMinPrice = response.data -(response.data % 20000);
                    }
                    else
                    {
                        this.constantMinPrice = response.data;
                    }
                })
                .then(response => {
                    this.minPrice = this.constantMinPrice;
                });
            this.axios
                .post(this.websiteLink + '/api/stocks/maxPrice', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId})
                .then(response => {
                    if(response.data % 20000 != 0)
                    {
                        this.constantMaxPrice = response.data + (20000 - (response.data % 20000));
                    }
                    else
                    {
                        this.constantMaxPrice = response.data;
                    }
                })
                .then(response => {
                    this.maxPrice = this.constantMaxPrice;
                });
        },
        methods: {
            paginationCounter(e) {
                this.x = e;

                if(e != 0) {
                    this.isActive = false;
                }
            },
            updateSortingAjax() {
                this.axios
                .post(this.websiteLink + '/api/stocks/sorting/ajax', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId, minPrice: this.minPrice, maxPrice: this.maxPrice, sorting: this.sorting, color: this.color, size: this.size})
                .then(response => {
                    this.stocklists = response.data;
                });

                this.axios
                .post(this.websiteLink + '/api/stocks/sorting/update_count', {keyword: this.$route.params.keyword, category: this.$route.params.category, brandId: this.$route.params.brandId, styleId: this.$route.params.styleId, minPrice: this.minPrice, maxPrice: this.maxPrice, color: this.color, size: this.size})
                .then(response => {
                    this.countStocks = response.data;
                });
            },             
        },
        computed: {
            chunkCount() {
                return this.stocklists.length;
            },
            paginationCreateIndex() {

                let paginateArray = [];

                for (let x = 1, z = 2; x < this.chunkCount; x++,z++) {
                    paginateArray.push({x,z});
                }

                return paginateArray;
            },
        },
    }
</script>
<template>
        <!-- ****** Welcome Slides Area Start ****** -->
        <!-- OWL CAROUSEL NOT WORKING -->
        <!-- ****** Welcome Slides Area End ****** -->
        <div class="single_catagory_area w-100" style="background-image: url();">
            <h1 class="text-center">{{brand.brand_name}}</h1>
        </div>

        <!-- ****** Top Category Area Start ****** -->
        <section v-for="stylelist in stylelists" :key="stylelist.id" class="top_catagory_area d-md-flex clearfix">
            <!-- Single Category -->
            <div v-for="style in stylelist" :key="style.id" class="single_catagory_area d-flex align-items-center bg-img" v-bind:style="{ 'background-image': 'url(/' + style.path + ')' }">
                <div class="catagory-content">
                    <router-link :to="{name: 'stocklist display', params: { category: category, brandId: style.brand_id, styleId: style.style_id }}">
                        <a class="btn karl-btn btn-light"><h3>{{style.style}}</h3></a>
                    </router-link>

                </div>
            </div>
        </section>
        <!-- ****** Top Category Area End ****** -->
</template>
 
<script>
    export default {
        data() {
            return {
                id: this.$route.params.id,
                stylelists: [],
                brand: [],
                category: 'ALL',
            }
        },
        created() {
            this.axios
                .get(`${this.websiteLink}/api/brand_and_style/${this.$route.params.id}`)
                .then(response => {
                    this.stylelists = response.data;
                });
            this.axios
                .get(`${this.websiteLink}/api/specific_brand/${this.$route.params.id}`)
                .then(response => {
                    this.brand = response.data;
                });
        },
        methods: {},
        props: ['websiteLink'],
    }
</script>
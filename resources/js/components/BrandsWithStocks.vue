<template>
        <!-- ****** Welcome Slides Area Start ****** -->
        <!-- OWL CAROUSEL NOT WORKING -->
        <!-- ****** Welcome Slides Area End ****** -->

        <!-- ****** Top Category Area Start ****** -->
        <section v-for="brandlist in brandlists" :key="brandlist.id" class="top_catagory_area d-md-flex clearfix">
            <!-- Single Category -->
            <div v-for="brand in brandlist" :key="brand.id" class="single_catagory_area d-flex align-items-center bg-img" v-bind:style="{ 'background-image': 'url(/' + brand.path + ')' }">
                <div class="catagory-content">
                    <router-link :to="{name: 'styles with display stocks', params: { id: brand.id }}">
                        <a class="btn karl-btn btn-light"><h3>{{brand.brand_name}}</h3></a>
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
                brandlists: [],
            }
        },
        created() {
            this.axios
                .get(`${this.websiteLink}/api/stocks/brands`)
                .then(response => {
                    this.brandlists = response.data;
                });
        },
        methods: {},
        props: ['websiteLink'],
    }
</script>
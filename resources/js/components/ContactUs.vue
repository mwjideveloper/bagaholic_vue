<template>
    <div class="text-center mb-4">
        <h2 class="section-title px-5 py-4" style="background-color: #f2f2f2 !important;"><span class="px-2">Contact For Any Queries</span></h2>
    </div>
    
    <div v-for="branch in branches" :key="branch.id" class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div>
                <iframe v-bind:src="branch.google_map" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                    
            <div class="d-flex flex-column mb-4">
                <h5 class="font-weight-semi-bold mb-3">{{branch.branch_name}}</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-2"></i>{{branch.branch_address}}, {{branch.city}}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-1"></i>
                    {{branch.email_address}}
                </p>
                <p class="mb-2">
                    <i class="fa fa-phone-square text-primary mr-1"></i> {{branch.telephone_number_1}} <br>
                    <i v-if="branch.telephone_number_2" class="fa fa-phone-square text-primary mr-1 invisible"></i> {{branch.telephone_number_2}}
                </p>
                <p class="mb-2"><i class="fa fa-mobile text-primary mr-2"></i>
                    {{branch.cell_number}}
                </p>
                <p class="mb-2"><i class="fa fa-mobile text-primary mr-2 invisible"></i>
                    {{branch.operating_hours}}
                </p>
                <p class="mb-2"><i class="fa fa-mobile text-primary mr-2 invisible"></i>
                    {{branch.operational_days}}
                </p>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                branches: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/branches`)
                .then((response) => {
                    this.branches = response.data;
                });
        },
        methods: {

        }
    }
</script>
<template>
    <div class="mt-1">
        <span class="fa fa-heart" @click="star" v-bind:class="starClass" style="font-size: 16px"></span>
    </div>
</template>


<script>
    export default {
        props: ['status', 'opportunity'],
        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return{
                value: this.status
            }
        },
        methods:{
            star(){
                axios.post('/save/' + this.opportunity)
                    .then(response => {
                        // this.status = !this.status;
                        if(this.value == 0){
                            this.value = "1"
                        }else if(this.value > 0){
                            this.value = "0"
                        }
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if(errors.response.value == 401){
                            // window.location = '/home';
                        }
                    });

            }
        },
        computed: {
            starClass(){
                if(this.value == 0){
                    return "star"
                }else if(this.value > 0 ){
                    return "star-blue"
                }
            }
        }

    }
</script>

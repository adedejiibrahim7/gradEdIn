<template>
    <div>
        <span class="fa fa-star" @click="star" v-bind:class="starClass"></span>
    </div>
</template>


<script>
    export default {
        props: ['status', 'application'],
        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return{
                status: this.status
            }
        },
        methods:{
            star(){
                axios.post('/star/' + this.application)
                    .then(response => {
                        // this.status = !this.status;
                        if(this.status == "pending"){
                            this.status = "starred"
                        }else if(this.status == "starred"){
                            this.status = "pending"
                        }
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if(errors.response.status == 401){
                            // window.location = '/home';
                        }
                    });

            }
        },
        computed: {
            starClass(){
                if(this.status == "pending"){
                    return "star"
                }else if(this.status == "starred"){
                    return "star-blue"
                }
            }
        }

    }
</script>

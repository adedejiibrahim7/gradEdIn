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
                value: this.value
            }
        },
        methods:{
            star(){
                axios.post('/star/' + this.application)
                    .then(response => {
                        // this.value = !this.value;
                        if(this.value == "pending"){
                            this.value = "starred"
                        }else if(this.value == "starred"){
                            this.value = "pending"
                        }
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if(errors.response.value == 401){
                            console.log(errors.response);
                        }
                    });

            }
        },
        computed: {
            starClass(){
                if(this.value == "pending"){
                    return "star"
                }else if(this.value == "starred"){
                    return "star-blue"
                }
            }
        }

    }
</script>

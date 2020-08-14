<template>
    <div v-if="reklama!=null"> 
          <img :src="'/uploads/ads/'+reklama.banner" class="img-fluid" @click.prevent="clickOnAd()"/>
    </div>
</template>


<script>
  export default{
    props: ['size'],
    data () {
      return {
        reklama: null,
      }
    },
    methods: {
      clickOnAd () {
        axios.get(`api/reklama/click/${this.reklama.id}`)
           .then(
             window.open(this.reklama.url, "_blank")
           )
           .catch(error => {
             console.log(error)
             this.errored = true
           })
           .finally(() => this.loading = false);
      },
    },
    mounted() {
        axios.get(`api/reklama/show/${this.size}`)
           .then(response => {
             this.reklama = response.data
           })
           .catch(error => {
             console.log(error)
             this.errored = true
           })
           .finally(() => this.loading = false);
       },


  }


</script>
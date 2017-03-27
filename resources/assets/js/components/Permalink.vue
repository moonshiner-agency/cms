<style scoped>
  /*Permalink*/
  div {
    line-height: 24px;
    min-height: 25px;
    margin-top: 5px;
    padding: 0 10px;
    color: #666;
  }
</style>


<template>
  <div>
    <strong>Permalink:</strong>
    <span v-show="!show">
      <a :href="url + myslug">{{ url }}<span v-show="!show">{{ myslug }}</span>/</a>
      <a class="button" @click="show = true">Bearbeiten</a>
    </span>
    <span v-show="show">
        {{ url }}<input type="text" v-model="myslug" />
        <a class="button" @click="changeSlug">Ok</a>
    </span>
  </div>
</template>


<script>

  export default {
    /*
    * The component's data.
    */
    props: ['slug', 'updateSlug'],
    data: function() {
      return {
        show: false,
        myslug: ''
      };
    },
    watch: {
      "slug": function(newVal){
        this.myslug = newVal;
      }
    },
    computed: {
      url: function() {
        return window.location.protocol + "//" + window.location.hostname + "/";
      }
    },
    methods: {
      changeSlug: function() {
        this.show = false;
        const slug = encodeURI(this.myslug);
        this.updateSlug(slug);
      }
    }
  }
</script>
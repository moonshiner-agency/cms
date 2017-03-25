<style scoped>
    .detail {
        padding: 6px 10px 8px;
        line-height: 1.4em;
        font-size: 13px;
        display: block;
    }
</style>


<template>
    <div class="detail">
        {{parameter}}: <b>{{status}}</b>
        <a  @click="show = true" 
            v-show="!show">Edit</a>
        <div v-show="show">
            <slot name="input"></slot>
            <a class="button" @click="show = false">Ok</a>
        </div>
    </div>
</template>


<script>

  export default {
    /*
    * The component's data.
    */
    props: ['parameter', 'status'],
    data: function() {
      return {
        show: false
      };
    }
  }
</script>
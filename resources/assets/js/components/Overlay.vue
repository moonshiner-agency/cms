<style scoped>
    .overlay {
        top: 0;
        left: 0;
        display: block;
        position: fixed;
        z-index: 999999999;
        background: rgba(0,0,0,0.5);
        height: 100%;
        width: 100%;
    }

    .message {
        position: relative;
        display: block;
        background: #fff;
        border: 1px solid #ccc;
        width: 40%;
        margin: 40px auto;
        padding: 10px;
    }
</style>


<template>
    <div class="overlay">
        <div class="message">
            <slot></slot>
        </div>
    </div>
</div>
</template>


<script>

  export default {
    /*
    * The component's data.
    */
    data: function() {
      return {};
    }
  }
</script>
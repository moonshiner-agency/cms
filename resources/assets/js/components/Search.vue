<style scoped>
  p {
    float: right;
    margin: 0;
  }

  input[name="s"] {
    float: left;
    height: 28px;
    margin: 0 4px 0 0;
  }

  input[type="submit"] {
    vertical-align: baseline;
  }
</style>


<template>
  <p>
    <input type="search" name="s" value="">
    <input type="submit" value="Search Posts">
  </p>
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
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
    <span id="sample-permalink">
      <a href="http://wiener-online.dev/?p=154210&amp;preview=true">
        http://wiener-online.dev/2017/02/09/
        <span id="editable-post-name">highlights-entlang-der-neuen-u1</span>/
      </a>
    </span>
    <span id="edit-slug-buttons">
      <button type="button" class="button">Bearbeiten</button>
    </span>
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
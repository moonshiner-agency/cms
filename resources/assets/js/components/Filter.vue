<style scoped>
  ul {
    list-style: none;
    margin: 8px 0 0;
    padding: 0;
    font-size: 13px;
    color: #666;

    float: left;
  }

  li {
    display: inline-block;
    margin: 0;
    padding: 0;
    white-space: nowrap;
  }

  li a{
    text-decoration: none;
    line-height: 2;
    padding: .2em;
  }

  li a.current{
    font-weight: 600;
    border: none;
  }

  li span {
    color: #555d66;
    font-weight: 400;
  }
</style>


<template>
  <ul>
    <li class="all"><a href="edit.php?post_type=post" class="current">All <span class="count">(2,685)</span></a> |</li>
    <li class="publish"><a href="edit.php?post_status=publish&amp;post_type=post">Published <span class="count">(2,458)</span></a> |</li>
    <li class="draft"><a href="edit.php?post_status=draft&amp;post_type=post">Drafts <span class="count">(139)</span></a> |</li>
    <li class="private"><a href="edit.php?post_status=private&amp;post_type=post">Private <span class="count">(88)</span></a> |</li>
    <li class="trash"><a href="edit.php?post_status=trash&amp;post_type=post">Trash <span class="count">(28)</span></a></li>
  </ul>
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
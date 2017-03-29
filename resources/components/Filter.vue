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
    padding: 0px 20px 0px 0px;
    white-space: nowrap;
    text-transform: capitalize;
  }

  li a {
    text-decoration: underline;
    cursor: pointer;
  }
</style>


<template>
  <ul>
    <li>Filter Category:</li>
    <li>
      <a @click="filter('all')">All</a>
    </li>
    <li v-for="category in categories">
      <a @click="filter(category)">{{category}}</a>
    </li>
  </ul>
</template>


<script>

  export default {
    /*
    * The component's data.
    */
    props: ['categories', 'filter'],
    data: function() {
      return {};
    }
  }
</script>
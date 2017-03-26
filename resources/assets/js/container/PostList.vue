 
<template>
  <!-- START Rendering of List -->
  <div>
    <div>
      <h1 class="headline">Posts</h1>
      <a class="button primary" @click="changeRoute('create')">Add New</a>
      <hr />
      <PostFilter />
      <Search />
      <div class="clear"></div>
    </div>
    <CmsTable :posts="posts" :changeRoute="changeRoute"></CmsTable>
  </div>
  <!-- END Rendering of List -->
</template>

<script>

  import CmsTable from '../components/Table';
  import PostFilter from '../components/Filter';
  import Search from '../components/Search';

  import {fetch} from '../config';

  export default {
    /*
    * The component's data.
    */
    props: ['changeRoute'],
    data: function() {
      return {
        // data
        posts: []
      };
    },
    mounted: function () {
      // get the posts
      fetch('GET', 'pages', this.postsLoaded);
    },
    methods: {
      postsLoaded: function(data) {

        // the callback for the posts loaded
        this.posts = data;
      }
    },
    components: {
      CmsTable,
      PostFilter,
      Search,
    }
  }
</script>


<style scoped>

    *, *:before, *:after {
      box-sizing: border-box;
    }
    
    /*Typo*/
    .backend {
      background: #f1f1f1;
      color: #444;
      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
      font-size: 13px;
      line-height: 1.4em;
      min-width: 600px;

      padding: 10px 20px 0;

      height: auto;
      min-height: 100%;
      width: 100%;
      position: relative;
      -webkit-font-smoothing: subpixel-antialiased;
    }

    .backend * {

    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    }

    h1.headline {
      color: #23282d;

      font-size: 23px;
      font-weight: 400;
      margin: 0;
      padding: 9px 0 4px;
      line-height: 29px;

      display: inline-block;
      margin-right: 5px;
    }

    hr {
      border: 0;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #fafafa;
    }

    

    /*POST*/
    .post {
      padding-top: 10px;
    }

    /*Title*/
    .title > input {
      padding: 3px 8px;
      font-size: 1.7em;
      line-height: 100%;
      height: 1.7em;
      width: 100%;
      outline: 0;
      margin: 0 0 3px;
      background-color: #fff;
    }
</style>
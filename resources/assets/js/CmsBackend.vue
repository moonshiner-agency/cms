<style>
  input {
    border: 1px solid #ddd;
    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    background-color: #fff;
    color: #32373c;
    outline: 0;
    -webkit-transition: 50ms border-color ease-in-out;
    transition: 50ms border-color ease-in-out;
  }

  /*Button*/
  .cms-button {
    margin-left: 4px;
    padding: 4px 8px;
    position: relative;
    top: -3px;

    text-decoration: none;
    border: none;
    border: 1px solid #ccc;
    border-radius: 2px;

    background: #f7f7f7;
    text-shadow: none;
    font-weight: 600;
    font-size: 13px;
    line-height: normal;
    color: #0073aa;
    cursor: pointer;
    outline: 0;
  }
  .cms-button:hover {
    border-color: #008EC2;
    background: #00a0d2;
    color: #fff;
  }

  /*cms-Button*/
  .cms-button-s {
    display: inline-block;
    text-decoration: none;
    font-size: 13px;
    line-height: 26px;
    height: 28px;
    margin: 0;
    padding: 0 10px 1px;
    cursor: pointer;
    border-width: 1px;
    border-style: solid;
    -webkit-appearance: none;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    white-space: nowrap;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    
    color: #555;
    border-color: #ccc;
    background: #f7f7f7;
    -webkit-box-shadow: 0 1px 0 #ccc;
    box-shadow: 0 1px 0 #ccc;
    vertical-align: top;

    height: 24px;
    line-height: 22px;
    padding: 0 8px 1px;
    font-size: 11px;
  }
  .cms-button-s:hover {
    border-color: #008EC2;
    background: #00a0d2;
    color: #fff;
  }

  .clear {
    clear: both;
    float:none;
  }

</style>

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

<template>
  <div class="backend">

    <!-- START Rendering of List -->
    <div v-if="modus === 'liste'">
      <div>
        <h1 class="headline">Posts</h1>
        <a class="cms-button" v-on:click="modus = 'detail'">Add New</a>
        <hr />
        <PostFilter />
        <Search />
        <div class="clear"></div>
      </div>
      <CmsTable></CmsTable>
    </div>
    <!-- END Rendering of List -->

    <!-- START Rendering of Article Detail -->
    <div v-if="modus === 'detail'">
      <h1 class="headline">Beitrag bearbeiten</h1>
      <a href="#" class="cms-button" v-on:click="modus = 'liste'">Erstellen</a>
      <hr />
      <div class="post">
        <div class="title">
          <input type="text" name="post_title" size="30" value="Highlights entlang der neuen U1" id="title" spellcheck="true" autocomplete="off">
        </div>
        <Permalink />
      </div>
    </div>
    <!-- END Rendering of List -->

  </div>
</template>
<script>
  import CmsTable from './components/Table';
  import Permalink from './components/Permalink';
  import PostFilter from './components/Filter';
  import Search from './components/Search';

  export default {
  name: 'CmsBackend',
  /*
  * The component's data.
  */
 
  data: function() {
    return {
      modus: 'liste',
      posts: [],
      active: null
    };
  },
  components: {
    CmsTable,
    Permalink,
    PostFilter,
    Search,
  }
}
</script>
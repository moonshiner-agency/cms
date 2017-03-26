 
<template>
  <!-- START Rendering of Article Detail -->
  <article>
    <div class="main">
      <h1 class="headline">Beitrag bearbeiten</h1>
      <a class="button primary" @click="link('create')">Erstellen</a>
      <hr />
      <div class="post">
        <div class="title">
          <input type="text" v-model="currentPost.title">
        </div>
        <Permalink />
        <textarea v-model="currentPost.main_content"></textarea>
      </div>

      <template v-if="templateStructure != null">
        <Panel
          :headline="templateGroup.name"
          v-for="templateGroup in templateStructure.additional_fields"
          key="templateGroup.name">
            <AdditionalField
              v-bind:content="currentPost.content[templateGroup.name]"
              v-bind:template="templateGroup"
              @changed="newContent => { 
                // copy content
                const mycontent = JSON.parse(JSON.stringify(currentPost.content));
                // add parameter 
                mycontent[templateGroup.name] = newContent;
                //update the current post
                currentPost.content = mycontent;
              }"
            /> 
        </Panel>
      </template>

    </div>
    <div class="sidebar">
      
      <!-- START Settings Box -->
      <Panel
        headline="Publish">

        <CmsOption 
          parameter="Status"
          :status="currentPost.status">
          <select v-model="currentPost.status" slot="input">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
          </select>
        </CmsOption>

        <CmsOption 
          parameter="Visibility"
          :status="currentPost.visibility">
          <select v-model="currentPost.visibility" slot="input">
            <option value="public">Public</option>
            <option value="private">Private</option>
          </select>
        </CmsOption>

        <CmsOption 
          parameter="Published on: "
          :status="currentPost.published_at">
          <input 
            slot="input" 
            type="text"
            v-model="currentPost.published_at">
        </CmsOption>

        <template slot="footer">
          <a href="#" class="trash">Move to trash</a> <a class="button primary right">Update</a>
          <div class="clear"></div>
        </template>

      </Panel>
      <!-- END Settings Box -->

      <!-- START Template Box -->
      <Panel
        headline="Template">
        <select v-model="currentPost.template">
          <option v-for="template in templates" :value="template.id">{{template.name}}</option>
        </select>
      </Panel>
      <!-- END Template Box -->
      
      <!-- START Template Box -->
      <Panel
        headline="Featured Image">
        
      </Panel>
      <!-- END Template Box -->

    </div>
  </article>
  <!-- END Rendering of List -->
</template>

<script>

  import AdditionalField from '../components/AdditionalField';
  import CmsOption from '../components/Option';
  import Permalink from '../components/Permalink';
  import Panel from '../components/Panel';
  import Sidebar from './Sidebar';


  import {fetch} from '../config';

  export default {
    /*
    * The component's data.
    */
    props: ['post', 'templates', 'changeRoute'],
    data: function() {
      return {
        currentPost: {},
        initialPost: {},
        templateStructure: null,
        show: {
          publish: false,
          visibility: false,
          publishdate: false,
        },
      };
    },
    watch: {
        "post": function (val, oldVal) {

          if(!val) {
            this.currentPost = {};
            this.initialPost = {};
          }
        },
        "currentPost.template": function (val, oldVal) {
          this.changeTemplate(val);
        }
    },
    mounted: function() {
      if(this.post) {
        //when initiated and a post was given
        //use it to load all info about current post
        fetch('GET', `pages/${this.post.id}`, this.postLoaded);
      } else {
        //fresh Page
        this.postLoaded({template: 'default'});
      }
    },
    methods: {
      postLoaded: function(data) {
        this.currentPost = data;
        this.initialPost = data;
        this.changeTemplate(data.template)
      },
      link: function(route, post) {

        // if you opened a new post, ask if he really wants to leave
        if(this.post == undefined) {
          if(!confirm('You didn\'t save your changes, are you sure you want to continue?'))
            return;

        // if you changed something ask before leaving
        } else if(
          JSON.stringify(this.currentPost) != JSON.stringify(this.initialPost)) 
        {
          if(!confirm('You did some changes that are not saved yet, are you sure you want to continue?'))
            return;
        }

        // change to new page
        this.changeRoute(route, post);
      },
      changeTemplate: function(template){
        this.templateStructure = this.templates.find(x => x.id === template);
      }
    },
    components: {
      AdditionalField,
      Panel,
      Permalink,
      Sidebar,
      CmsOption,
    }
  }
</script>


<style scoped>
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

    textarea {
      width: 100%;
      min-height: 300px;
    }

    .main {
      width: 70%;
      float: left;
    }

    .sidebar {
      width: 25%;
      float: right;
      margin-top: 25px;
    }

    @media(max-width: 768px) {
      .main {
        width: 100%;
        float: none;
        clear: both;
      }
      .sidebar {
        width: 100%;
        float: none;
        clear: both;
      }
    }
</style>
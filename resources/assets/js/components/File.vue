<style scoped>
</style>


<template>
  <div>
    <div v-if="!displayImage">
      <input type="file" @change="onFileChange">
    </div>
    <div v-else>
      <img :src="displayImage" :style="loading" />
      <a @click="removeImage">Remove image</a>
    </div>
  </div>
</template>


<script>
  import {fetch} from '../config';

  export default {
    /*
    * The component's data.
    */
    props: ['updatePath', 'path'],
    data: function(){
      return {
        image: null,
        loading: ''
      }
    },
    computed: {
      displayImage: function() {

        if(this.image == null)
          return this.path;

        return this.image;
      }
    },
    methods: {
      onFileChange(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImage(files[0]);
      },
      createImage(file) {
        var reader = new FileReader();
        this.loading = 'opacity: 0.5';

        reader.onload = (e) => {
          this.image = e.target.result;

          fetch('POST', `image`, this.fileUploaded, {foto: e.target.result});
        };
        reader.readAsDataURL(file);
      },
      fileUploaded: function(data) {
        if(data.msg) {
          alert(data.msg);
          this.image = '';
        }

        this.loading = 'opacity: 1';
        this.updatePath(data.path);
      },
      removeImage: function (e) {
        this.image = '';
        this.updatePath('');
      }
    }
  }
</script>
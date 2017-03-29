<style scoped>
</style>


<template>
  <div>
    <div v-if="!displayPreview">
      <input type="file" @change="onFileChange">
    </div>
    <div v-else>
      <img :src="displayPreview" :style="loading" />
      <a @click="removePreview">Remove File</a>
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
        preview: null,
        loading: ''
      }
    },
    computed: {
      displayPreview: function() {

        if(this.preview == null)
          return this.path;

        return this.preview;
      }
    },
    methods: {
      onFileChange(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.uploadFile(files[0]);
      },
      uploadFile(file) {
        var reader = new FileReader();
        this.loading = 'opacity: 0.5';

        reader.onload = (e) => {

          const type = e.target.result.split(';')[0];

          console.log(type.indexOf('image'));

          if(type.indexOf('image') != -1) {
            console.log('image');
            this.preview = e.target.result;
          } else if(type.indexOf('svg') != -1) {

          } else if(type.indexOf('pdf') != -1) {
            console.log('pdf');
            this.preview = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADmklEQVRYhc2VSWgTURjHgycFPVsEtQdRXE96UFDxZHtRXFDRClrxICoIIl7EhWo9eFDEi+jFBRFxqRUFccEusY11abSKjSa2WZqmbZaZzGRt+/d9r5nxzSSpk9iCD34Mb/Le/P7vmy+Jzfafj6l+vx+Ez+fT0e4FAgH09fUhGAyiv7+fEwqFMDAwgMHBQY7T6VzPnjOl3AAVotzr9eoBSG4OQHIxwNDQELq7u4lzRQ3RShsmAwpEAXp6enhQj8dzpmCAMFssr5g5odAzqVIUgK7xeJxXjVXwdF6A0FwbzGRZWZOtLYgcOzI2D/Yh9dmJcG0Nnw+zMqe+OKE8fpS3V4NOHg6HeYBUKgVJkngl2H1jJYJssZm0x43Q5mok3znG5r88CK5cAvX1yz/zAvtEtABut1vvIbrncrnoeldvTP8cG8xkWRMpTW8QOrCfz0lI19TPH2Ofs9ImqSKXL+bt1SBZJBJBNBpFLBbjUBVkWeYw9XQeoJctNpNiFTDMWQDfupVQP37Q54X2GejtLSqnnmDqWTyAe7YNZhLfvhrmadYDSucneGu28Xmy+3veHjP0lS0mVxSFAlTyAC62eDKgd15MbgjwnS2eDOhrV0iuqipHD8DGbMb8Iqxrbm5GU1OTTktLC6e1tRV2ux1tbW1ob2/nOBwOdHR0oKuri/8iamKzPJFIGAJMY8wowmJqJjP0fjUK/UeQnBpQLLkoTyaThgDjjUp6kBmtuQj51VPED22HfP2SodyFTq3JSwogysSu1ohfqYfs+gZ5d7VBXExOv4qE5QCiTGwq/bQNdxB/cBvyvi3jijV5Op3mWA6QJ8ydUj9tMABp7ULEr14cVyzKM5mM9QAGWe6EIiSU1iyC2vnBkpjIZrPWA5hlIiRTO99D2rAa8uljlsTE8PCw9QBmoQjJ5JNHody8BrXxPpR7t/8qJkZGRqwHMJfVQMCHyPJ5SLx3QLlxDbH9NYju2Aj5Qj2ks6cgn6/LExOjo6PWA5jLqqG+eIZo9WrE9m6D+vwpMqrCT6s2PoR04jiUO7cwsHSBQU5igoblAGJJiZTfC+lgLeIX6hBetQxpWTKUmZ+YQr+1I+PtNYg1eUkBtPeoEavdyUNENlUhaW/Oe7/mUotScVgOIJ6MiB09jOiurUg8aRhXWkxccgBRUkhYirSsAKKokLAUaVkBzLJyhWUHmBDbPwSoYFQx9kwwVbln/3VMzS2snGAqcs+2/QZXZB6MU7ZPlQAAAABJRU5ErkJggg==';
          } else {
            console.log('anderes');
            this.preview = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAEHklEQVR42q2XS2wbVRSG/7ET17Fx7AZSUINwURCLLlhUSKxYVGIFYhVIkWhiO3FiL9I4bVXeICFAVEnt2J6gmgVJ3EQCSkkITRELUCUWXUVdIREhIaWqYjVPv2KPx7HHnDuOA61jzySZYx2NPHNn7jf/edw7HGpbC7mdnMP+7E/yvNrBez3cRB40mUyO9vZ2g06ne+hiqUTOflIJkiShUCwiv12AmN+GkM0gsbn+Ew07oxZiL4AbnZ2dHZFIBFarVZ5wd/KdiSuTCjkRidQWYmtxLN2PodnchOhVP+bn51VDPApwym63LywuLnKpjID0VuYhgIqxNy+SbzMIMY9UOoO1jQRstmacfukF0AuohngUwONyuSL82FdY3YjXvEkOQ4kgiv9BJAlC39CAk889A0ODHl1n365AdJJvqwUY8Hq9/OXhESRJ2npWgSgwiAILR56OEuxtrdgi9VpbrOhxOTEzM1NXiSoADwEMD19BiuRXMhadklRWIk8QWYI43nqU7s2C4zgZwuV0YHZ29hYN7SAXlQE8Hn54xI+trKAIULFKTqysJ/D8s21yPsgPVwFRBdBPACNX/BAEUd3sKFeHRNXxgKrh2BM2GA2N5RcgiXQ6DlaLGd3dXfh5bq4KohqgnwD8foii6l6yGw6mRGx1E6x3WMwmCk1Rzo8cPSseT8LrduCfv//y0tCvawL09ffzfn9ArvP92m5iForIscYkilQdWayuxxFbWcP41TAW7tw+R0PHagP0EUAgIDebg1gZotysWImyxGQluk4K+C9/jt9/vVkfwN3XxwcCQVnOg1olHMWdEs1Sx0xTZXz6yUeYm7muAOAmgNFRlPY15d4U0k6zqrTtD957F99/O10foNft5kdHg3IJacCwu3awxeqdSxcxfS2qANBLAMEg9Hr9oQFkCMoHiTxPABcvnEd0cqI+QM8OQCP1da2MQbAwnB/yYXJivD6Aq6eXD4ZCMDQ2agbAjCkwRAAT49+oAAiGcOSIQVMA1thUAThdPXyIFGgyGjUFEHI5+HwqQsAAWAjMTU2aAmQEAUNqABxOFykQhtmsMQDtEXy+QeUqYABMActjZk0B2PaOKaAI0O1wygo0W7QFYPtGpsC16GR9gC4ZIARbs0VTgEQqLSfhlCJAt4NCEMZRq7YA8WSaQjCIKaVWfLbLwYfCYbTQFltL20yk4BscxPRUfQDPm2feivD8GJ5sfVxTgJW1DZwbGMAP17+ruyM61db29MJvt//gjj91jCrBdOhVka0DbC8Qe7CKV06/XFpeXn6RTt+tBcDsxquvvd7x2Rdfwmqz4bCrMtshJRMJfPzh+/jl1s0f6dQb/79e8+PUaDQ67CdOGDhOp2qi2gAS7i0t5XO5XJT+DpFnlQAqdtDP8yoG8nvkm3td/Bd50FU/yjWlWgAAAABJRU5ErkJggg==';
          }

          fetch('POST', `file`, this.fileUploaded, {file: e.target.result});
        };
        reader.readAsDataURL(file);
      },
      fileUploaded: function(data) {
        if(data.msg) {
          alert(data.msg);
          this.preview = '';
        }

        this.loading = 'opacity: 1';
        this.updatePath(data.path);
      },
      removePreview: function (e) {
        this.preview = '';
        this.updatePath('');
      }
    }
  }
</script>
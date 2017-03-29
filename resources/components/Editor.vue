<template>
  <textarea :id="id" :value="value" class="main-content"></textarea>
</template>

<script>
export default {
  props : {
    id: {
      type: String,
      default: 'editor'
    },
    value: {
      type: String,
      default : ''
    }
  },
  data: function() {
    return {
      myeditor: undefined
    }
  },
  watch: {
    "value": function(newVal, oldVal){

      if(window.tinymce) {
        if(newVal != null && oldVal == '' && this.myeditor != null) {
          this.myeditor.setContent(newVal)
        }
      }
    }
  },
  mounted() {

    if(window.tinymce) {
      window.tinymce.init({
        selector: `#${this.id}`,
        height: 500,
        theme: 'modern',
        plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ],
        init_instance_callback: (editor) => {
          editor.on('KeyUp', (e) => {
            this.$emit('input', editor.getContent());
          });
          editor.on('Change', (e) => {
            this.$emit('input', editor.getContent());
          });

          this.myeditor = editor;
        }
      });
    }
  },
  destroyed () {
    if(window.tinymce) {
      this.myeditor.destroy();
    }
  }
}
</script>
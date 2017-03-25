<style scoped>
    .panel {
        border: 1px solid #e5e5e5;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
        background: #fff;
        margin-top: 25px;
    }

    .panel-heading {
        font-size: 14px;
        padding: 8px 12px;
        margin: 0;
        line-height: 1.4;
        border-bottom: 1px solid #eee;
        text-transform:capitalize;
    }

    .panel-body {
        padding: 10px;
    }

    .panel-footer {
        margin-top: 10px;
        border-top: 1px solid #e5e5e5;
        padding: 10px;
        background: #f5f5f5;
    }
</style>


<template>
  <div class="panel">
    <div class="panel-heading">
        <strong>{{headline}}</strong>
    </div>
    <div class="panel-body">
        <slot></slot>
    </div>
    <div class="panel-footer">
        <slot name="footer"></slot>
    </div>
</div>
</template>


<script>

  export default {
    /*
    * The component's data.
    */
    props: ['headline'],
    data: function() {
      return {};
    }
  }
</script>
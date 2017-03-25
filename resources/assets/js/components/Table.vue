<style scoped>
    table {
      table-layout: fixed;
      background: #fff;
      border-spacing: 0;
      width: 100%;
      clear: both;
      margin: 0;
    }

    td, th {
      font-weight: 400;
      border-bottom: 1px solid #e1e1e1;
      font-size: 14px;
      line-height: 1.4em;
      color: #32373c;
      padding: 8px 10px;
      word-wrap: break-word;
    }

    th {
      width: 5.5em;
      padding: 8px 0;
      text-align: left;
    }
</style>

<template>
  <table>
    <colgroup>
       <col span="1" style="width: 10%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 45%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
    </colgroup>
    <thead>
      <tr>
        <td></td>
        <th>Image</th>
        <th>Title</a></th>
        <th>Author</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <TableRow 
        v-for="(post, index) in posts" 
        :post="post" 
        :key="post.id"
        :changeRoute="changeRoute"
      ></TableRow>
    </tbody>
  </table>
</template> 

<script> 

  import TableRow from './TableRow';

  export default {
    /*
    * The component's data.
    */
    props: ['posts', 'changeRoute'],
    data: function() {
      return {
      };
    },
    components: {
      TableRow
    }
  }
</script>
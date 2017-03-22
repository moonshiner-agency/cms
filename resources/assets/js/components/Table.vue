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
    <thead>
      <tr>
        <td id="cb" class="manage-column column-cb check-column"></td>
        <th scope="col" id="thumb column-comments" class="manage-column column-thumb column-comments">Image</th>
        <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">Title</a></th>
        <th scope="col" id="author" class="manage-column column-author">Author</th>
        <th scope="col" id="date" class="manage-column column-date sortable asc"><a href="http://wiener-online.at/wp-admin/edit.php?orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>
      </tr>
    </thead>
    <tbody>
      <TableRow v-for="token in tokens"></TableRow>
    </tbody>
  </table>
</template>

<script> 

  import TableRow from './TableRow';

  export default {
    /*
    * The component's data.
    */
    data: function() {
      return {
        tokens: [1,2,3,4,5,6,7]
      };
    },
    components: {
      TableRow
    }
  }
</script>
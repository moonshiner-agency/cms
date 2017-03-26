<style scoped>
  td {
      font-weight: 400;
      border-bottom: 1px solid #e1e1e1;
      font-size: 14px;
      line-height: 1.4em;
      color: #32373c;
      padding: 8px 10px;
      word-wrap: break-word;
  }
  .options {
    opacity: 0;
    transition: 1s all;
  }

  td:hover .options{
    opacity: 1;
    transition: 1s all;
  }

  a.trash {
    color: red;
  }

  .post-title {
    text-decoration: none;
  }

  .preview-img {
    max-width: 100%;
    max-height: 40px;
  }
</style>

<template>
  <tr>
    <td>{{ post.id }}</td>
    <td><img width="36" height="21" :src="post.featured_image" class="attachment-widget size-widget wp-post-image"></td>
    <td>
      {{ post.title }}
      <div class="options">
        <a @click="changeRoute('edit', post)">Edit</a> | <a href="#" class="trash">Trash</a> | <a :href="post.slug" target="_blank">View</a>
      </div>
    </td>
    <td>{{ post.author }}</td>
    <td>{{ post.published_at }}</td>
  </tr>
</template>

<script>

  export default {
    /*
    * The component's data.
    */
    props: ['post', 'changeRoute'],
    data: function() {
      return {};
    }
  }
</script>
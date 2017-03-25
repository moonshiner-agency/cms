<style scoped>
    input {
        width: 100%;
    }
    input.withLabel {
        margin-bottom: 10px;
    }

    table {
        table-layout: fixed;
        background: #fff;
        border-spacing: 0;
        width: 100%;
        clear: both;
        margin: 0;
    }

    thead {
        text-align: left;
        font-size: 12px;
        text-transform:capitalize;
    }

    .action {
        width: 16px;
        height: 16px;
        display: block;
        border-radius: 100%;
        background: #ccc;
        color: #fff;
        font-weight: bold;
        text-align: center;
        line-height: 14px;
        text-decoration: none;
        cursor: pointer;

        transition: 500ms background ease-in-out;
    }

    .action:hover {
        background: red;

    }
</style>


<template>
    <div>
        <div v-if="template.type.constructor === Array">
            <table>
                <thead>
                    <tr>
                        <th v-for="templatePart in template.type">
                         {{templatePart.name}}
                        </th>
                        <th style="width: 16px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(localContent, index) in content">
                        <td v-for="templatePart in template.type">
                            <AdditionalField
                              v-bind:content="localContent[templatePart.name]"
                              v-bind:template="templatePart"
                              @changed="newContent => { 

                                //update full content
                                content[index][templatePart.name] = newContent;

                                //send all content back
                                updateValue(content);
                              }"
                            /> 
                        </td>
                        <td>
                            <a @click="() => { 
                                content.splice(index, 1);
                                updateValue(content);
                            }" class="action delete">-</a>
                        </td>
                    </tr>
                </tbody>
            </table>
                <a @click="() => { 
                    var freshContent = {};
                    for(var i = 0; i < template.length; i++)
                    {
                        freshContent[template[i].name] = '';
                    }
                    content.push(freshContent);
                    updateValue(content);
                }" class="button right">add</a>
            <div class="clear"></div>
        </div>
        <div v-else>
            <input
                ref="input"
                v-bind:value="content"
                v-on:input="updateValue($event.target.value)"/>
        </div>
    </div>
</template>


<script>

  export default {
    /*
    * The component's data.
    */
    props: ['content', 'template', 'showLabel'],
    beforeCreate () {
        // Recursive Loading of the Same component is not possible
        // this is the fix
        // https://github.com/vuejs/vue/issues/4117
        this.$options.components.AdditionalField = require('./AdditionalField.vue')
    },
    data: function() {
        return {};
    },
    methods: {
        // Instead of updating the value directly, this
        // method is used to format and place constraints
        // on the input's value
        updateValue: function (value) {
          // Emit the number value through the input event
          this.$emit('changed', value);
        }
    }
  }
</script>
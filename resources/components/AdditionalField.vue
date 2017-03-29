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

                                const mycontent = JSON.parse(JSON.stringify(content));
                                mycontent[index][templatePart.name] = newContent;

                                updateValue(mycontent);
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
            <a @click="addRow(template.type)" class="button right">add</a>
            <div class="clear"></div>
        </div>
        <div v-else>
            <File 
                v-if="template.type == 'file'"
                :updatePath="newPath => { updateValue(newPath) }"
                :path="content"
            />
            <Editor
                :id="template.name + Math.random().toString().substring(2)"
                v-else-if="template.type == 'longtext'"
                v-bind:value="content"
                v-on:input="newContent => { updateValue(newContent) }"/>
            <input
                ref="input"
                v-else
                v-bind:value="content"
                v-on:input="updateValue($event.target.value)"/>
        </div>
    </div>
</template>


<script>

  import Editor from './Editor';
  import File from './File';

  export default {
    /*
    * The component's data.
    */
    props: ['content', 'template'],
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
        },
        addRow: function(template) {

            //somehow we need to use two way binding it seems
            //@todo: do it more proper
            //if i only to updateValue it will not go back down it seems
            const content = this.content || [];

            // prepare new object
            const freshContent = {};
            for(let i = 0; i < template.length; i++)
            {
                freshContent[template[i].name] = '';
            }
            
            // add to content array
            content.push(freshContent);
            this.updateValue(content);
        }
    },
    components: {
      Editor,
      File,
    }
  }
</script>
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
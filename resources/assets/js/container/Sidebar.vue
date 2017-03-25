<style scoped>
    p {
        float: right;
        margin: 0;
    }

    input[name="s"] {
        float: left;
        height: 28px;
        margin: 0 4px 0 0;
    }

    input[type="submit"] {
        vertical-align: baseline;
    }

    

    .trash {
        color: red;
        line-height: 30px;
    }

    .detail {
        margin: 10px 0;
    }

    .featured-image {
        width: 100%;
    }
</style>


<template>
    <div class="panels">
        <div class="panel">
            <div class="panel-heading">
                <strong>Publish</strong> <button class="cms-button right">Preview Changes</button>
                <div class="clear"></div>
            </div>
            <div class="panel-body">
                <div class="detail">
                    Status: <b>Published</b> <a @click="statusChange" href="#">Edit</a>
                    <div id="visibilityOption" v-if="visibilityOption === 'yes'">
                        <br>
                        <select name="" id="">
                            <option value="">Published</option>
                            <option value="">Draft</option>
                        </select>
                        <button class="cms-button">Ok</button> <a href="#">Cancel</a>
                        <br>
                        <br>
                    </div>

                </div>
                <div class="detail">
                    Visibility: <b>Public</b> <a @click="visibility" href="#">Edit</a>
                    <div id="visibilityOption" v-if="visibilityOption === 'yes'">
                        <select name="" id="">
                            <option value="">Public</option>
                            <option value="">Private</option>
                        </select>
                        <button class="cms-button">Ok</button> <a href="#">Cancel</a>
                    </div>
                    <br>
                </div>
                <div class="detail">
                    Published on: <b>Mar 22, 2017 @ 17:06 </b> <a @click="datepicker" href="#">Edit</a>
                    <br>
                    <div id="visibilityOption" v-if="visibilityOption === 'yes'">
                        <input type="date">
                        <button class="cms-button">Ok</button> <a href="#">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="#" class="trash">Move to trash</a> <button  class="cms-button right" v-on:click="saveAction()">Update</button>
                <div class="clear"></div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <strong>Post Template</strong>
            </div>
            <div class="panel-body">
                <select disabled name="" id="" class="form-control">
            <option value="">Standard Template</option>
            <option value="">FAQ Template</option>
            <option value="">Template 2</option>
        </select>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <strong>Featured Image</strong>
            </div>
            <div class="panel-body">
                <img class="featured-image" src="http://drkeyurparmar.com/wp-content/uploads/2015/02/dummy-article-img-1.jpg" alt="">
                <strong>Click the image to edit or update</strong>
                <br>
                <a href="#" class="trash">Remove featured image</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        /*
        * The component's data.
        */
        props: ['post'],

        data: function () {
            return {
                'visibilityOption' : 'no',
            };
        },

        methods: {
            saveAction(){
              alert('Beitrag gespeichert');
            },

            statusChange: function() {

            },
            visibility: function(){
                // this.visibilityOption = 'yes';
            },
            datepicker: function(){

            },
        }
    }

</script>

<template>
    <div class="backend">
        <component :is="currentView" :posts="posts" :post="activePost" :changeRoute="changeRoute" :templates="templates" :categories="categories">
            <!-- component changes when vm.currentView changes! -->
        </component>
    </div>
</template>
<script>
// Pages
import PostList from './container/PostList';
import PostDetail from './container/PostDetail';

import {
    fetch
} from './config';

export default {
    name: 'cms-backend',
    /*
     * The component's data.
     */

    data: function() {
        return {
            // data
            posts: [],
            //structure
            templates: [],
            //structure
            categories: [],
            //the active post
            activePost: null,
            //the Current Page displayed
            currentView: PostList
        };
    },
    components: {
        PostList,
        PostDetail
    },
    mounted: function() {
        // get the posts
        fetch('GET', 'config', this.configLoaded);
    },
    methods: {
        configLoaded: function(data) {
            // the callback for the templates loaded
            this.templates = data.templates;
            this.categories = data.categories;
        },
        changeRoute: function(route, post) {
            switch (route) {
                case 'list':
                    this.currentView = PostList;
                    break;

                case 'edit':
                    this.activePost = post;
                    this.currentView = PostDetail;
                    break;

                case 'create':
                    this.activePost = null;
                    this.currentView = PostDetail;
                    break;

                default:
                    alert('404 - Page not found');

            }
        }
    }
}
</script>
<style>
.backend input,
.backend select,
.backend textarea,
.backend .button {
    box-sizing: border-box;
    border: 1px solid #ddd;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .07);
    background-color: #fff;
    color: #32373c;
    outline: 0;
    transition: 50ms border-color ease-in-out;
    vertical-align: bottom;
    padding: 2px;
    margin: 1px;
    line-height: 24px;
    height: 24px;
    font-size: 12px;
}

.backend img {
    max-width: 100%;
}

.backend a {
    text-decoration: underline;
    color: blue;
}


/*cms-Button*/

.backend .button {
    display: inline-block;
    text-decoration: none;
    padding: 0 10px 1px;
    cursor: pointer;
    border: 1px solid;
    border-radius: 3px;
    white-space: nowrap;
    color: #555;
    border-color: #ccc;
    background: #f7f7f7;
    box-shadow: 0 1px 0 #ccc;
    cursor: pointer;
}

.backend .button:hover {
    border-color: #008EC2;
    background: #00a0d2;
    color: #fff;
}


/*Button*/

.backend .button.primary {
    position: relative;
    top: -3px;
    border: 1px solid #ccc;
    border-radius: 2px;
    background: #f7f7f7;
    font-weight: 600;
    color: #0073aa;
    line-height: 28px;
    height: 28px;
    font-size: 14px;
}

.backend .button.primary:hover {
    border-color: #008EC2;
    background: #00a0d2;
    color: #fff;
}

.backend .right {
    float: right;
}

.backend .clear {
    clear: both;
    float: none;
}

.backend h1.headline {
    color: #23282d;
    font-size: 23px;
    font-weight: 400;
    margin: 0;
    padding: 9px 0 4px;
    line-height: 29px;
    display: inline-block;
    margin-right: 5px;
}

.backend hr {
    border: 0;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #fafafa;
}
</style>
<style scoped>
*,
*:before,
*:after {
    box-sizing: border-box;
}


/*Typo*/

.backend {
    color: #444;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    font-size: 13px;
    line-height: 1.4em;
    min-width: 600px;
    padding: 10px 20px 0;
    height: auto;
    min-height: 100%;
    width: 100%;
    position: relative;
    -webkit-font-smoothing: subpixel-antialiased;
}

.backend * {
    box-sizing: border-box;
}
</style>

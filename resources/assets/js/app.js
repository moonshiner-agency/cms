// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import CmsBackend from './CmsBackend'

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#cms',
  template: '<CmsBackend/>',
  components: { CmsBackend }
})

window._ = require('underscore')
window.Cookies = require('js-cookie')
window.$ = window.jQuery = require('jquery')
window.Bootstrap = require('bootstrap')
window.BootstrapMultiselect = require('bootstrap-multiselect')
window.SweetAlert = require('sweetalert')
window.Summernote = require('summernote')
window.Vue = require('vue')
window.VueResource = require('vue-resource')

Vue.config.debug = true
Vue.config.devtools = true

Vue.http.interceptors.push(
    require('./interceptors')
);

require('./components/bootstrap')

var app = new Vue({
    el: '#app'
});


//
//
//
//
// //$(document).ready(function () {
// //
// // call the tablesorter plugin
// //
// $("[data-sort=table]").tablesorter({
//     // Sort on the second column, in ascending order
//     sortList: [[1, 0]],
//     headers: {0: {sorter: false}}
// });
// e
// $("[data-sort=table]").bind("sortEnd", function () {
//     // fix Shift-select checkboxes
//     checkBoxes = $('.multiSelectCheckBox');
// });
//
//
// //
// // Check All
// //
// $('#CheckAll').on('click', function () {
//     var checked = $(this).prop('checked');
//     $('input').prop('checked', checked);
// });
//
// //
// // Shift-Select Checkboxes
// //
// var lastChecked = null;
// var checkBoxes = $('.multiSelectCheckBox');
//
// checkBoxes.click(function (e) {
//     if (!lastChecked) {
//         lastChecked = this;
//         return;
//     }
//
//     if (e.shiftKey) {
//         var start = checkBoxes.index(this);
//         var end = checkBoxes.index(lastChecked);
//
//         checkBoxes.slice(Math.min(start, end), Math.max(start, end) + 1).prop('checked', lastChecked.checked);
//     }
//
//     lastChecked = this;
// });
//
// //});
//

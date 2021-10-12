/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/js/page/inventory_ajax.js ***!
  \*********************************************/
var ed = function ed(e) {
  var id = e.getAttribute('data-arg');
  var value = e.value;
  var x = document.querySelector("meta[name='csrf-token']").getAttribute('content');
  var xhr = new XMLHttpRequest();
  xhr.open("POST", 'inventory/change_count', true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.reload();
    }
  };

  var data = JSON.stringify({
    _token: x,
    id: id,
    value: value
  });
  xhr.send(data);
};
/******/ })()
;
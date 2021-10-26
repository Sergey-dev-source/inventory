/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/page/inventory.js ***!
  \****************************************/
$(document).ready(function () {
  $('#table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/inventory/filter',
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: 'product.sku',
      name: 'product.sku'
    }, {
      data: 'product.name',
      name: 'product.name'
    }, {
      data: 'warehouse.name',
      name: 'warehouse.name'
    }, {
      data: 'count',
      name: 'count',
      render: function render(data, type, full, meta) {
        var color = '';

        if (data <= 30) {
          color = 'bg-danger';
        } else if (data <= 60) {
          color = 'bg-warning';
        } else {
          color = 'bg-success';
        }

        return "<div class=\"".concat(color, " text-white  btn\">").concat(data, "</div>");
      }
    }, {
      data: 'id',
      name: 'id',
      render: function render(data, type, full, meta) {
        return "<button type=\"button\" data-arg=\"".concat(data, "\" value=\"1\" class=\"btn btn-success text-white\" onclick=\"ed(this)\">+1</button>\n                <button type=\"button\" data-arg=\"").concat(data, "\" value=\"-1\" class=\"btn btn-danger text-white mi\" onclick=\"ed(this)\">-1</button>");
      }
    }, {
      data: 'product.id',
      name: 'product.id',
      render: function render(data, type, full, metta) {
        return "\n                        <div class='more'>\n\n                                    <div class='p_ic'>\n                                        <i class='bx bx-dots-horizontal-rounded'></i>\n                                    </div>\n                                    <div class='p_abs'>\n                                        <ul>\n                                            <li>\n                                                <a href='/product/view/".concat(data, "'>\n                                                    <i class='bx bx-search-alt'></i>\n                                                    View Product detail\n                                                </a>\n                                            </li>\n                                            <li>\n                                                <a href=\"/inventory/transfer/ ").concat(full.id, "\">\n                                                    <i class='bx bxs-ship'></i>\n                                                     Location Transfer\n                                                </a>\n                                            </li>\n                                            <li>\n                                                <a href=''>\n                                                    <i class='bx bx-trash' ></i>\n                                                    Delete Inventory product\n                                                </a>\n                                            </li>\n                                        </ul>\n                                    </div>\n                                </div>\n                    ");
      }
    }]
  });
});
/******/ })()
;
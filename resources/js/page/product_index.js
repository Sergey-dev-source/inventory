import axios from "axios";
let upl_pr = document.querySelector('#upl_pr');
if (upl_pr){
    upl_pr.addEventListener('change', evt => {
        let id = evt.target.getAttribute('data-arg');
        let formData = new FormData();
        let imagefile = document.querySelector('#file');
        formData.append("image",evt.target.files[0]);
        formData.append("id",id);
        axios.post('/product/image',formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                if (response.data.action == 'success'){
                    let host = window.location.host;
                    document.querySelector('.product_image_body').innerHTML = `<img src="/images/product/${response.data.img}" >`;
                }
            })
    })
}

$(document).ready( function () {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/product/filter',

        columns: [
            {
                data: 'id',
                name: 'id',
                render: function( data, type, full, meta ) {
                    return `<input type="checkbox" class="product_checkbox" value="${data}" /  >`
                }
            },
            { data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                    if (data !== ''){
                        return "<img src=\"/images/product/" + data + "\" height=\"50\" width=\"50\" />";
                    }else{
                        return "<img src=\"/images/imagecomingsoon_4.jpg\" height=\"50\" width=\"50\" />";
                    }
                }
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'sku',
                name: 'sku'
            },
            {
                data: 'uom',
                name: 'uom'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'id',
                name: 'id',
                render: function( data, type, full, meta ) {
                    return `<div class='more'>
                                    <div class='p_ic'>
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </div>
                                    <div class='p_abs'>
                                        <ul>
                                            <li>
                                                <a href='/product/view/${data}'>
                                                    <i class='bx bx-search-alt'></i>
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/product/edit/${data}">
                                                    <i class='bx bx-edit-alt' ></i>
                                                    Edit product
                                                </a>
                                            </li>
                                            <li>
                                                <a href=''>
                                                    <i class='bx bx-trash' ></i>
                                                    Delete product
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>`
                }
            },

        ]
    });
} );

import axios from "axios";

$(document).ready( function () {
    let url = '';
    if (id === 0){
         url =  '/inventory/filter';
    }else {
        url =  `/inventory/filter?id=${id}`
    }
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,

        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'product.sku',
                name: 'product.sku',
            },
            {
                data: 'product.name',
                name: 'product.name',
            },
            {
                data: 'warehouse.name',
                name: 'warehouse.name',
            },
            {
                data: 'count',
                name: 'count',
                render: function( data, type, full, meta ) {
                    let color = '';
                    if (data <= 30) {
                        color = 'bg-danger';
                    } else if (data <= 60) {
                            color = 'bg-warning';
                    } else {
                        color = 'bg-success';
                    }
                    return `<input type="text" data-arg="${full.id}"  class="${color} text-white  btn coun" value="${data}" >`;
                }
            },{
                data: 'id',
                name: 'id',
                render: function (data, type, full, meta) {
                    return `<button type="button" data-arg="${data}" value="1" class="btn btn-success text-white" onclick="ed(this)">+1</button>
                            <button type="button" data-arg="${data}" value="-1" class="btn btn-danger text-white mi" onclick="ed(this)">-1</button>`
                }
            },{
                data: 'product.id',
                name: 'product.id',
                render: function (data, type, full, metta) {
                    return `
                        <div class='more'>
                                    <div class='p_ic'>
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </div>
                                    <div class='p_abs'>
                                        <ul>
                                            <li>
                                                <a href='/product/view/${data}'>
                                                    <i class='bx bx-search-alt'></i>
                                                    View Product detail
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/inventory/transfer/ ${full.id}">
                                                    <i class='bx bxs-ship'></i>
                                                     Location Transfer
                                                </a>
                                            </li>
                                            <li>
                                                <a href=''>
                                                    <i class='bx bx-trash' ></i>
                                                    Delete Inventory product
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                    `
                }
            },
        ]
    });
    let c = '';
    $('#table').on('focus','input',function (e) {
        c = e.target.value;
        e.target.value = '';
    })
    $('#table').on('blur','input',function (e) {
        e.target.value = c;
    })
    $('#table').on('keypress','input',function (e) {
        if (e.which === 13){
            let id = e.target.getAttribute('data-arg');
            let value = e.target.value;
            axios.post('/inventory/counts',{
                id: id,
                value: value
            })
                .then(response=> {
                    if (response.data.action === 'error'){
                        e.target.blur();
                        $('body').append(`
                             <div id="error">
                                <div class="warn_icon">
                                    <i class='bx bx-error-alt'></i>
                                </div>
                                <div class="warn_text">
                                        <div>${response.data.message}</div>
                                </div>
                                <div class="warn_close" onclick="document.getElementById('error').remove();" >
                                    <i class='bx bx-x'></i>
                                </div>
                            </div>
                        `)
                        setTimeout(()=> {
                            document.getElementById('error').remove();
                        },4000);
                    }else if(response.data.action === 'success'){
                        let color = '';
                        if (value <= 30) {
                            color = 'bg-danger';
                        } else if (value <= 60) {
                            color = 'bg-warning';
                        } else {
                            color = 'bg-success';
                        }
                        if(e.target.classList.contains('bg-success') === true){
                            e.target.classList.remove('bg-success');
                        }else if(e.target.classList.contains('bg-warning') === true) {
                            e.target.classList.remove('bg-warning');
                        }else if(e.target.classList.contains('bg-danger') === true) {
                            e.target.classList.remove('bg-danger');
                        }
                        e.target.classList.add(color)
                        c = value;
                        e.target.blur();
                            $('body').append(`
                             <div id="success">
                                <div class="warn_icon">
                                    <i class='bx bx-check-double'></i>
                                </div>
                                <div class="warn_text">
                                    <div>${response.data.message}</div>
                                </div>
                                <div class="warn_close" onclick="document.getElementById('success').remove()" >
                                    <i class='bx bx-x'></i>
                                </div>
                            </div>
                        `)
                        setTimeout(()=> {
                            document.getElementById('success').remove();
                        },4000);
                    }
                } )
        }
    })
} );

import axios from "axios";

let select_basic = document.getElementById('select_basic')
let select_attributes = document.getElementById('select_attributes')
let shows = document.querySelectorAll('.shows')
let submit = document.getElementById('submit')
    let submit_bin = document.getElementById('submit_bin')

let submit_color = document.getElementById('submit_color')
let submit_size = document.getElementById('submit_size')

select_basic.addEventListener('click', e => {
    e.className = 'list_active';
    document.getElementById('select_attributes').className = '';
    document.getElementById('form_basic').style.display = 'block';
    document.getElementById('form_attributes').style.display = 'none';
})

select_attributes.addEventListener('click', e => {
    e.className = 'list_active';
    document.getElementById('select_basic').className = '';
    document.getElementById('form_basic').style.display = 'none';
    document.getElementById('form_attributes').style.display = 'block';
})
for (let i = 0; i < shows.length; i++) {
    shows[i].addEventListener('click', (e) => {
        let arg = e.target.getAttribute('data-arg');
        document.getElementById(arg).style.display = 'block'
    })
}


submit.addEventListener('click', () => {
    let name = document.querySelector('.category_input').value;
    let description = document.querySelector('.category_textarea').value;
    axios.post('/category', {
        name: name,
        description: description
    })
        .then((response) => {
            if (response.data.error != undefined && response.data.error != '') {
                alert(response.data.error)
            } else {
                document.getElementById('sel_cat').innerHTML += `<option value="${response.data.id}" selected>${response.data.name}</option>`
                document.getElementById('category').style.display = 'none';
            }

        })
    document.querySelector('.category_input').value = '';
    document.querySelector('.category_textarea').value = '';
})

submit_bin.addEventListener('click', () => {
    let name = document.querySelector('.bin_input').value;
    axios.post('/bin', {
        name: name,
    })
        .then((response) => {
            if (response.data.error != undefined && response.data.error != '') {
                alert(response.data.error)
            } else {
                document.getElementById('bin_select').innerHTML += `<option value="${response.data.id}" selected>${response.data.name}</option>`
                document.getElementById('bin').style.display = 'none';
            }

        })
    document.querySelector('.bin_input').value = '';
})
submit_color.addEventListener('click', () => {
    let code = document.querySelector('.color_code').value;
    let name = document.querySelector('.color_name').value;
    axios.post('/color', {
        name: name,
        code: code,
    })
        .then((response) => {
            if (response.data.error != undefined && response.data.error != '') {
                alert(response.data.error)
            } else {
                document.getElementById('color_select').innerHTML += `<option value="${response.data.id}" selected>${response.data.name}</option>`
                document.getElementById('color').style.display = 'none';
            }

        })
    document.querySelector('.color_code').value = '';
    document.querySelector('.color_name').value = '';
})


submit_size.addEventListener('click', () => {
    let name = document.querySelector('.size_name').value;
    axios.post('/size', {
        name: name,
    })
        .then((response) => {
            if (response.data.error != undefined && response.data.error != '') {
                alert(response.data.error)
            } else {
                document.getElementById('size_select').innerHTML += `<option value="${response.data.id}" selected>${response.data.name}</option>`
                document.getElementById('size').style.display = 'none';
            }

        })
    document.querySelector('.size_name').value = '';
})

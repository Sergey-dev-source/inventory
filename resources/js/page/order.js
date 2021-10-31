import axios from "axios";

let save_channel = document.getElementById('save_channel');

save_channel.addEventListener('click', () => {
    let name = document.getElementById('chanal_name').value;
    let description = document.getElementById('chanal_description').value;
    axios.post('/channel/create', {
            name: name,
            description: description
        })
        .then((response) => {
            if (response.data.error != undefined && response.data.error != '') {
                alert(response.data.error)
            } else {
                document.getElementById('channel').innerHTML += `<option value="${response.data.id}" selected>${response.data.name}</option>`
                document.querySelector('.modal-backdrop').remove();
                document.querySelector('.modal').remove();
            }

        })
})

$(function() {
    $('#countries').on('change', function() {
        let val = $(this).find(":selected").val();
        $('#state').children().remove();
        if (val === '1') {
            axios.get('/order/state')
                .then((response) => {
                    $('#state').append('<option value="">Select State (US Only):</option>');
                    response.data.forEach(element => {
                        $('#state').append(`<option value="${element.id}">${element.name}</option>`);
                    });
                })
            $('.province').hide();
            $('.state').show();
        } else {
            $('.province').show();
            $('.state').hide();
        }
    })
})
<script>

    let  ed = e => {
        let id = e.getAttribute('data-arg');
        let value = e.value
        let x = document.querySelector("meta[name='csrf-token']").getAttribute('content');
        let xhr = new XMLHttpRequest();
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
</script>

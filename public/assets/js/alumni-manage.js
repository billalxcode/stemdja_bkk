$(document).ready(function() {
    $("#table").DataTable({
        responsive: true,
        ajax: {
            url: BASE_URL + '/admin/jurusan/getall',
            method: 'POST',
        },
        columns: [
            {
                data: 'kode'
            },
            {
                data: 'name'
            },
            {
                data: 'short'
            },
            {
                data: 'id',
                render: function (data) {
                    let button_group = document.createElement('div')
                    button_group.className = 'btn-group'

                    // Button delete
                    let button_delete = document.createElement('a')
                    button_delete.className = 'btn btn-danger btn-sm'
                    button_delete.href = BASE_URL + '/admin/jurusan/delete?id=' + data
                    button_delete.innerHTML = '<i class="fa fa-trash"></i>'

                    button_group.appendChild(button_delete)
                    return button_group.outerHTML
                }
            }
        ]
    })
})

$(document).on("click", "#sendForm", function (event) {
    $("#triggerForm").submit();
})
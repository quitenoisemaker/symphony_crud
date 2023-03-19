<script>
    $(document).ready(function() {
        $('#filter_page').on('click', async function(event) {
            event.preventDefault();

            let data = {
                search_item: $('#searchItem').val()
            }
            
            axios.post("{{ route('item.search') }}", data)
                .then(function(response) {

                    if (response.data.success === true) {
                        axiosForFilter(response);
                    }
                })
                .catch(function(error) {
                })
        });

        function axiosForFilter(response) {
            $('#item-body').find('tr').remove();

            let htmlCode = '';

            if (response.data.totalRecords) {
                let i = 0;
                response.data.data.forEach(function(row) {

                    i++;
                    htmlCode += '<tr>';
                    htmlCode += '<td>' + i + '</td>';
                    htmlCode += '<td>' + row.name + '</td>';
                    htmlCode += '<td>' + row.description + '</td>';
                    htmlCode += '<td><img src="'+row.image +'" width="100"></td>';
                    htmlCode += '<td><a href="'+ row.editLink +'" class="btn btn-primary">Edit</a></td>';
                    htmlCode += '<td><form action="'+row.deleteLink +'" method="POST">';
                    htmlCode +='{{ method_field("DELETE") }}' ;
                    htmlCode +='@csrf' ;
                    htmlCode +='<button type="submit" class="btn btn-danger">Delete Item</button></form>' ;
                    htmlCode +=  '</td>';  
                
                });
            }else{
                htmlCode += 'No Items found'
            }

            $('#item-body').html(htmlCode);

        }

    });
</script>

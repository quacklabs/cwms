



// function createStoreOrder(grand_total) {
//     const item_rows = $("#items")
//     const rows = item_rows.find('tr')
//     var order = []
//     var validity = true;
//     rows.each(function(index, element) {
//         const current_stock = $(element).find('input').filter(function() {
//             return $(this).data('name') === 'current_stock';
//         }).first().val();

//         const quantity = $(element).find('input').filter(function() {
//             return $(this).data('name') === 'quantity';
//         }).first().val();

//         const serials = $(element).find('input').filter(function() {
//             return $(this).data('name') === 'serials';
//         }).first()

//         if(isNaN(quantity) || quantity <= 0) {
//             validity = false;
//             swal({
//                 title: "Quantity Required",
//                 text: "Please specify a quantity to continue",
//                 icon: 'error'
//             })
//             return
//         }

//         if(parseInt(quantity) > parseInt(current_stock)) {
//             validity = false;
//             swal({
//                 title: 'Invalid Quantity',
//                 text: 'Please ensure all quantities do not exceed the product stock',
//                 icon: 'error'
//             })
//             return
//         }

//         // const total_amount = price.val() * quantity.val()
//         const current = {
//             product_id: $(element).data('id'),
//             quantity: parseInt(quantity),
//         }
//         if(serials != undefined) {
//             if(serials.val() != '' && serials.val() != undefined && serials.val() != null) {
//                 current.serials = serials.val()
//             }
//         }
//         order.push(current)
//     })
//     if(validity == true && order.length > 0) {
//         const arg = JSON.stringify(order)
//         $("#order").val(arg)
//         const note = $("#collect_note").val()
//         $("#note").val(note)
//         $("#orderForm").submit()
//     } else {
//         swal({
//             title: 'Empty Transfer Order',
//             text: 'Please select some items to transfer',
//             icon: 'error'
//         })
//     }
// }

// function createWarehouseOrder(grand_total) {
//     const item_rows = $("#items")
//     const rows = item_rows.find('tr')
//     var order = []
//     var validity = true;
//     rows.each(function(index, element) {
//         const current_stock = $(element).find('input').filter(function() {
//             return $(this).data('name') === 'current_stock';
//         }).first().val();

//         const quantity = $(element).find('input').filter(function() {
//             return $(this).data('name') === 'quantity';
//         }).first().val();

//         const serials = $(element).find('input').filter(function() {
//             return $(this).data('name') === 'serials';
//         }).first()

//         if(isNaN(quantity) || quantity <= 0) {
//             validity = false;
//             swal({
//                 title: "Quantity Required",
//                 text: "Please specify a quantity to continue",
//                 icon: 'error'
//             })
//             return
//         }

//         if(parseInt(quantity) > parseInt(current_stock)) {
//             validity = false;
//             swal({
//                 title: 'Invalid Quantity',
//                 text: 'Please ensure all quantities do not exceed the product stock',
//                 icon: 'error'
//             })
//             return
//         }

//         // const total_amount = price.val() * quantity.val()
//         const current = {
//             product_id: $(element).data('id'),
//             quantity: parseInt(quantity),
//         }
//         if(serials != undefined) {
//             if(serials.val() != '' && serials.val() != undefined && serials.val() != null) {
//                 current.serials = serials.val()
//             }
//         }
//         order.push(current)
//     })
//     if(validity == true && order.length > 0) {
//         const arg = JSON.stringify(order)
//         $("#order").val(arg)
//         const note = $("#collect_note").val()
//         $("#note").val(note)
//         $("#orderForm").submit()
//     } else {
//         swal({
//             title: 'Empty Transfer Order',
//             text: 'Please select some items to transfer',
//             icon: 'error'
//         })
//     }
// }

// $(function() {

//     $("#warehouse_submit").click(function(e) {
//         const from_warehouse_id = $("#warehouse_from").val()
//         const to_warehouse_id = $("#warehouse_to").val()

//         if(from_warehouse_id == null || from_warehouse_id == '' || from_warehouse_id == undefined)  {
//             swal({
//                 title: "Warehouse Required",
//                 text: "Please select a warehouse to transfer from to continue",
//                 icon: 'error'
//             })
//             return
//         } else if(to_warehouse_id == '' || to_warehouse_id == null || to_warehouse_id == undefined) {
//             swal({
//                 title: "Warehouse Required",
//                 text: "Please select a warehouse to transfer to in order to continue",
//                 icon: 'error'
//             })
//             return
//         } else {
//             createWarehouseOrder()
//         }
//     });

//     $('#warehouse_transfer_date').datepicker({
//         format: 'dd-mm-yyyy',
//         autoclose: true
//     });

//     const warehouse_product_options = {
//         valueField: 'id', // Specify the key for option value
//         labelField: 'name', // Specify the key for option innerHTML
//         searchField: 'name', // Specify the key for search field
//         create: false,
//         closeAfterSelect: true,
//         render: {
//             option: function(item, escape) {
//                 // return null
//                 return '<div class="option" data-stock="'+escape(item.stock)+'" data-selectable="" data-name="'+item.name+'" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
//             }
//         },
//         load: function(query, callback) {
//             if (!query.length || !query.length < 3) return callback();
//             const warehouse = $("#warehouse_from")
//             if(warehouse.val() == '' || warehouse.val() == undefined) {
//                 swal({
//                     title: "Source Warehouse Required",
//                     text: "Please select a warehouse to transfer from",
//                     icon: 'error'
//                 })
//                 return
//             }
//             const url = "{{ route('api.findProduct') }}"+'ByWarehouse/'
//             search(url+warehouse.val(), query, callback)
//         },
//         onChange: function(value) {
//             if(value == '') { return }
//             var selectedOption = this.getOption(value);
//             var name = selectedOption.data('name');
//             var id = selectedOption.data('value');
//             var stock = selectedOption.data('stock');
//             console.log(selectedOption)
//             insertWarehouseItem(name, id, stock)
//             this.clearOptions()
//         }
//     }

    
//     $("#warehouse_product_select").selectize(warehouse_product_options)
//     // $('input').prop('autocomplete', 'off');
// })

// function insertWarehouseItem(name, id, stock = undefined) {
//     const item_rows = $("#warehouse_items")
//     const rows = item_rows.find('tr')
//     var exists = false;
//     rows.each(function(index, element) {
//         // console.log()
//         const this_id = $(element).data('id')
//         const existing = id
//         // console.log("row: "+this_id)
//         if(this_id === existing) {
//             exists = true
//             console.log(exists)
//             return;
//         }
        
//     })
//     if(exists == false) {
//         var newRow = '<tr id="row'+id+'" data-id="'+id+'">' +
//         '<td>'+name+'</td>' +
//         '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="current_stock" type="text" value="'+stock+'" readonly></td>'+
//         '<td>'+
//         '<input data-row="'+id+'" data-name="serials" type="text" style="display: none;" value="">'+
//         '<input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="0"></td>' +

//         '<td>'+
//             '<div class="buttons">'+
//             '<input data-row="'+id+'" data-name="file" class="file-input" type="file" style="display: none;" accept=".csv, .xls, .xlsx">'+
//             '<input data-row="'+id+'" data-name="serials" type="text" style="display: none;" value="">'+
//             '<button type="button" data-row="'+id+'" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash"></i> Remove</button>'+
//             '<button type="button" data-row="'+id+'" class="upload-btn btn btn-icon btn-dark"><i class="fas fa-upload"> Upload Serial Numbers</i></button>'+
//             '</div>'+
//         '</td>'+
//         '</tr>';
//         item_rows.append(newRow);
//     } else {
//         return
//     }
// }


// function search(url, query, callback) {
//     const user = "{{ auth()->user()->id }}"
//     $.ajax({
//         url: url,
//         type: 'POST',
//         dataType: 'JSON',
//         contentType: 'application/json',
//         headers: {
//             'Authorization': "Bearer {{ $api_token }}",
//             'X-XSRF-TOKEN': "{{ $x_token }}"
//         },
//         data: JSON.stringify({ query: query, user: user }),
//         error: function() {
//             console.log('failed');
//             callback();
//         },
//         success: function(res) {
//             console.log(res);
//             const transformedData = Object.values(res.data).map(item => ({
//                 id: item.id,
//                 name: item.name,
//                 stock: item.stock
//             }));
//             callback(transformedData);
//         }
//     });
// }


// $(document).on('click', '.delete-btn', function(e) {
//     // Event handler code
//     const row_id = $(this).data('row')
//     e.preventDefault()
//     const row = $("#row"+row_id)
//     row.remove();
// });


// $(document).on('click', '.upload-btn', function(e) {
//     const row_id = $(this).data('row')
//     const row = $("#row"+row_id)
//     const total = row.find('input').filter(function() {
//         return $(this).data('name') === 'file';
//     }).first();
//     total.click(); // Trigger the file input click event
// });

// $(document).on('input', '.file-input', function() {
//     var file = this.files[0]; // Get the selected file
//     const row_id = $(this).data('row')
//     const row = $("#row"+row_id)
//     const serials = row.find('input').filter(function() {
//         return $(this).data('name') === 'serials';
//     }).first();

//     const quantity = row.find('input').filter(function() {
//         return $(this).data('name') === 'quantity';
//     }).first();

//     // Create a FormData object
//     var formData = new FormData();
//     // formData
//     formData.append('file', file);

//     // Make an AJAX request to upload the file
//     $.ajax({
//     url: "{{ route('api.uploadSerials') }}",
//     type: 'POST',
//     data: formData,
//     processData: false,
//     contentType: false,
//     success: function(response) {
//         // Handle the success response
//         console.log('File uploaded successfully.');
//         const values = [];
//         const data = response.data

//         // Iterate over the outer object keys
//         for (const key in data) {
//             // Access the inner object
//             const innerObject = data[key];
        
//             // Iterate over the inner object values
//             for (const innerValue in innerObject) {
//                 // Push the inner value to the array
//                 values.push(innerObject[innerValue]);
//             }
//         }
//         serials.val(JSON.stringify(values))
//         quantity.val(values.length)
//         quantity.prop('readonly', true)
//     },
//     error: function(xhr, status, error) {
//         // Handle the error response
//         console.error('Error uploading file:', error);
//     }
//     });
// });



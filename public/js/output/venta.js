// Global variables
var items = [];

// Temporary variables
var selectedProduct;

$(document).on('ready', function () {
    $('#btnAdd').on('click', addItem);
    $(document).on('click', '[data-delete]', deleteItem);
    $('#btnAccept').on('click', addItemsSeries);
    $('#form').on('submit', registerEntry);
});

function registerEntry() {
    event.preventDefault();

    var _token = $(this).find('[name=_token]');
    var data = $(this).serializeArray();
    data.push({name: 'items', value: JSON.stringify(items)});
    $.ajax({
        url: 'compra',
        data: data,
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': _token }
    })
    .done(function( response ) {
        if(response.error)
            alert(response.message);
        else{
            alert('Compra registrada correctamente.');
            location.reload();
        }

    });
}

function addItem() {
    // Validate the product name
    var name = $('#producto').val();
    if (!name) return;

    // Validate quantity products
    var _quantity = $('#cantidad').val();
    var quantity = parseInt(_quantity);
    if (!quantity || quantity < 1)
        return;

    // Validate price products
    var _price = $('#precio').val();
    var price = parseFloat(_price);
    if (!price || price <= 0)
        return;


    $.ajax({
        url: '../producto/buscar/' + name
    })
    .done(function( data ) {
        if (data) {
            // if require series

            if (data.series) {

                $('#bodySeries').html('');
                for (var i = 0; i<quantity; ++i) {
                    renderTemplateSeries();
                }

                loadAutoCompleteItems(data);

                // Temporary variables
                selectedProduct = { id: data.id, name: name, price: price };

                $('#modalSeries').modal('show');
            } else {
                if (itemExists(data.id)) {
                    alert('Este producto ya se ha cargado');
                    return;
                }

                items.push({ id: data.id, series: 'S/S', quantity: quantity, price: price });
                updateTotal();
                renderTemplateItem(data.id, name, 'S/S', quantity, price, quantity*price);
            }
        } else {
            alert('Producto no existe');
        }
    });
}

function loadAutoCompleteItems(data) {
    $.ajax({
        url: '../items/producto/' + data.id

    })
        .done(function(datos){
            console.log(JSON.parse(datos));
            $('[data-search]').typeahead(
                {
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name: 'items',
                    source: substringMatcher(JSON.parse(datos))
                }
            );
        });
}

function addItemsSeries() {
    $('#bodySeries').find('input').each(function (i, element) {
        var series = $(element).val();
        if(series != "")
        {
            items.push({ id: selectedProduct.id, series: series, quantity: 1, price: selectedProduct.price });
            renderTemplateItem(selectedProduct.id, selectedProduct.name, series, 1, selectedProduct.price, selectedProduct.price);

        }
    });

    updateTotal();
    $('#modalSeries').modal('hide');
    console.log(items);
}

function deleteItem() {
    var $tr = $(this).parents('tr');
    var id = $(this).data('delete');
    var series = $tr.find('[data-series]').text();
    itemDelete(id, series);
    $tr.remove();
}

function itemExists(id) {
    for (var i = 0; i<items.length; ++i) {
        if (items[i].id == id)
            return true;
    }

    return false;
}

function itemDelete(id, series) {
    for (var i = 0; i<items.length; ++i) {
        if (items[i].id == id && items[i].series == series) {
            items.splice(i, 1);
            updateTotal();
            return;
        }
    }
}

function updateTotal() {
    var total = 0;
    for (var i=0; i<items.length; ++i)
        total += items[i].price * items[i].quantity;
    $('#total').val(total);
}


// Funciones relacionadas al template HTML5
function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
};

function renderTemplateItem(id, name, series, quantity, price, sub) {

    var clone = activateTemplate('#template-item');

    clone.querySelector("[data-name]").innerHTML = name;
    clone.querySelector("[data-series]").innerHTML = series;
    clone.querySelector("[data-quantity]").innerHTML = quantity;
    clone.querySelector("[data-price]").innerHTML = price;
    clone.querySelector("[data-sub]").innerHTML = sub;

    clone.querySelector("[data-delete]").setAttribute('data-delete', id);

    $('#table-items').append(clone);
}

function renderTemplateSeries() {

    var clone = activateTemplate('#template-series');

    $('#bodySeries').append(clone);
}

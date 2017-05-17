/**
 * Created by valmarjunior on 16/05/17.
 */


var brasilia = ol.proj.fromLonLat([-50, -15.16]);


var bootstrapMap = new ol.Map({
    target: 'mapZone',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],

    view: new ol.View({
        center: brasilia,
        zoom: 5
    })
});


/**
 * Controle de Zoom da Aplicação pelo botões Bootstrap
 */

document.getElementById('zoom_in').onclick = function () {
    var view = bootstrapMap.getView();
    var zoom = view.getZoom();
    view.setZoom(zoom + 0.5);
};

document.getElementById('zoom_out').onclick = function () {
    var view = bootstrapMap.getView();
    var zoom = view.getZoom();
    view.setZoom(zoom - 0.5);
};

/**
 * Popular os Selects
 */

$(document).ready(function() {

    if($('#estados').val().length != 0) {
        $.getJSON("home/listar_cidades_json",{
            estadoId: $('#estados').val()
        }, function(cidades) {
            if(cidades != null)
                popularListaDeCidades(cidades, $('#id-cidade').val());
        });
    }

    $('#estados').live('change', function() {
        if($(this).val().length != 0) {
            $.getJSON("home/listar_cidades_json",{
                estadoId: $(this).val()
            }, function(cidades) {
                if(cidades != null)
                    popularListaDeCidades(cidades);
            });
        } else
            popularListaDeCidades(null);
    });
});

function popularListaDeCidades(cidades, idCidade) {
    var options = '<option value>selecione uma cidade</option>';
    if(cidades != null) {
        $.each(cidades, function(index, cidade){
            if(idCidade == index)
                options += '<option selected="selected" value="' + index + '">' + cidade + '</option>';
            else
                options += '<option value="' + index + '">' + cidade + '</option>';
        });
    }
    $('#cidades').html(options);
}


''




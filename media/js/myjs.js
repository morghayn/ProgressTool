// TODO delete these functions after AJAX tests are complete

function getMapBounds(){
    return {
        minlat: "minlat",
        maxlat: "maxlat",
        minlng: "minlng",
        maxlng: "maxlng"
    }
}

function searchHere() {
    console.log("Search here");
    var mapBounds = getMapBounds();
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "mapsearch", format: "json", mapBounds: mapBounds },
        success: function(result, status, xhr) { displaySearchResults(result); },
        error: function() { console.log('ajax call failed'); },
    });
}

function displaySearchResults(result) {
    console.log("displaySearchResults here");
    if (result.success) {
        let html = "";
        html += "<p>" + result.data + "</p>";
        jQuery("#searchresults").html(html);
    } else {
        var msg = result.message;
        if ((result.messages) && (result.messages.error)) {
            for (var j=0; j<result.messages.error.length; j++) {
                msg += "<br/>" + result.messages.error[j];
            }
        }
        jQuery("#searchresults").html(msg);
    }
}
function checker(choice) {
    /**
     * TODO do AJAX call here
     */
    var token = jQuery("#token").attr("name");
    jQuery.ajax({
        data: { [token]: "1", task: "mapsearch", format: "json", choice: choice },
        success: function(result, status, xhr) { success(result); },
        error: function() { console.log('ajax call failed'); }, // todo do not allow selection of 'choice'
    });
}

function success(result)
{
    console.log(result.data)
    //deselector(result);
}

function deselector(choices) {
    /**
     *     TODO deselect check boxes passed through
     */
    //var token = jQuery("#token").attr("name");
}
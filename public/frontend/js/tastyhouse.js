function getSubCategories(cat_url, level) {
    $.ajax({
        type: 'GET',
        url: cat_url,
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                result = '<option value="">- - - Select - - -</option>';
                data.categories.forEach(element => {
                    result += '<option value="' + element.id + '">' + element.title + '</option>';
                });
                //console.log(result);
                $('#category'+level).html(result)
            }
        }
    });
}

/* Header Location Filter Starts */
$('#back-to-states').hide();
$('#location-search').on('input', function(){
    var userInput = $(this).val().toLowerCase();
    $('.location-select li').each(function(){
        let locationBox = $(this).find('a');
        let locationName = locationBox.find('h6').text().toLowerCase();
        if(locationName.substring(0, userInput.length) != userInput) {
            $(this).hide();
        }
        if(locationName.substring(0, userInput.length) == userInput) {
            $(this).show();
        }
    });
});

$('.location-select').on('click', 'li a', function (e) {
    //alert($(this).attr('class'));
    let stateId = $(this).find('input[type=hidden]').val();
    let stateName = $(this).find('h6').text();
    let locationType = $(this).attr('class');
    if (locationType.substring(0, 4) == 'city') {
        let locationChangeUrl = $('#locationChangeUrl').val() + '?type=' + locationType + '&id=' + stateId;
        window.location.href = locationChangeUrl;
        return;
    }
    $('#main_location_states').html($('.location-select').html());
    let locationUrl = $('#locationFilterUrl').val();
    $.ajax({
        type: 'GET',
        url: locationUrl + '/' + stateId,
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                result = '<li><a href="javascript:void(0)" class="cityall"><h6>All '+ stateName +' State</h6><input type="hidden" value="'+stateId+'"></a></li>';
                data.cities.forEach(element => {
                    result += '<li><a href="javascript:void(0)" class="city"><h6>';
                    result += element.name;
                    result += '</h6><input type="hidden" value="'+element.id+'"></a></li>';
                });
                //console.log(result);
                $('.location-select').html(result);
                $('#back-to-states').show('slow');
            }
        }
    });
});
$('#back-to-states').click(function() {
    $('.location-select').html($('#main_location_states').html());
    $(this).hide('slow');
});
/* Header Location Filter Ends */
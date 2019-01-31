$(document).ready(function () {
    
    /**
     * Click listener for the client's form add button. 
     * Here we delete the id input value cause we can't 
     * add new user with the same id (primary key)
     */
    $('.btn-add').on('click', function () {
        $('input#id').val(null);
    });

    /**
     * Click listener for client's form edit button
     */
    $('.btn-edit').on('click', function () {
        var id = $('input#id').val();
        $('.client-form').attr('action', '/clients/edit/' + id);
    });

    /**
     * Click listener for client's form delete button
     */
    $('.btn-delete').on('click', function () {
        var id = $('input#id').val();
        $('.client-form').attr('action', '/clients/delete/' + id);
    });



    var activeClient;
    /**
     * Fill form inputs with client's info by clicking 
     * on 'tr' in clients table
     */
    $('#clients-table-container #clients-table tr').on('click', function () {
        setTrActive(this);
        fillClientInputs(activeClient);
    });

    /**
     * Show client's interests by clicking on 'tr' 
     * in clients table
     */
    $('#clients-table-container.interests #clients-table tr').on('click', function () {
        setTrActive(this);
        showClientInterests(activeClient);
    });

    /**
     * Sets background of 'tr' to light gray (active effect)
     */
    function setTrActive(currentClicked) {
        if (currentClicked !== activeClient) {
            $(activeClient).removeAttr('style');
            activeClient = currentClicked;
            $(currentClicked).css('background-color', '#cbcbcb');
        }
    }

    /**
     * Fill form inputs
     */
    function fillClientInputs(client) {
        $('.client-form .form-control').each(function (index) {
            $(this).val(client.cells[index].innerText ? client.cells[index].innerText : '');
        });
    }

    /**
     * Make an Ajax call for getting client's interests
     */
    function showClientInterests(client) {
         $('#interests-table').hide();
         $('#btn-add-interest').hide();
         $('.preloader').show();
         var clientId = client.cells[0].innerText;
         $.ajax({
             type: "GET",
             url: "/interests/show-all/" + clientId,
             success: function (response) {
                 $('.preloader').hide();
                 $('#interests-table').html(response);
                 $('#interests-table').show();
                 $('#btn-add-interest').show();
             },
             error: function (xhr, errorThrown) {
                 console.log(xhr.status + " " + errorThrown);
             }
         });
    }
    
    $('#interests-form').submit(function() {
        $('#client-id').val(activeClient.cells[0].innerText);
        var request = $(this).serialize();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/interests/add.json",
            data: request,
            success: function (response) {
                //response = JSON.parse(response);
                response = response.result;
                alert(response.error + ' ' + response.error_text);
                console.log(response);
            },
            error: function (xhr, errorThrown) {
                alert(xhr.status + " " + errorThrown);
                console.log(xhr.status + " " + errorThrown);
            }
        });
        return false;
    });
    


});
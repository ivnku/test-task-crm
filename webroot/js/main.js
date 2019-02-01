$(document).ready(function () {

    var activeClient;       //The active 'tr' in the client table. Global var
    
    /**
     * Set background of 'tr' when clicked on it in the clients table
     */
    function setTrActive(currentClicked) {
        if (currentClicked !== activeClient) {
            $(activeClient).removeAttr('style');
            activeClient = currentClicked;
            $(currentClicked).css('background-color', '#cbcbcb');
        }
    }

/*================== Clients page scripts ==================*/
    /**
     * Fill form inputs with client's info by clicking 
     * on 'tr' in clients table
     */
    $('#clients-table-container #clients-table tr').on('click', function () {
        setTrActive(this);
        fillClientInputs(activeClient);
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

    /**
     * Fill the clients form inputs
     */
    function fillClientInputs(client) {
        $('.client-form .form-control').each(function (index) {
            $(this).val(client.cells[index].innerText ? client.cells[index].innerText : '');
        });
    }

/*================== Interests page scripts ==================*/    

    /**
     * Show client's interests by clicking on 'tr' 
     * in the clients table
     */
    $('#clients-table-container.interests #clients-table tr').on('click', function () {
        setTrActive(this);
        showClientInterests(activeClient);
    });

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
    
    /**
     * Click listener for the 'Add Interest' button
     */
    $('#btn-add-interest').on('click', function() {
        $('.modal-title').html('');
        $('#interests-form')[0].reset();
        $('.btn-edit').hide();
        $('.btn-add').show();
    });

    /**
     * Click listener for the ADD button of the interests form
     */
    $('#interests-form .btn-add').on('click', function (e) {
        $('.modal-title').html('');
        e.preventDefault();
            
        var form = $('#interests-form');

        if (isValid(form)) {
            var request = getInterestsFormData(form);

            $.ajax({
                type: "POST",
                url: "/interests/add",
                data: request,
                success: function (response) {
                    $('#interest-form-modal .modal-title').html(response);
                    form[0].reset();    // reset form, when interest added
                    showClientInterests(activeClient);
                },
                error: function (xhr, errorThrown) {
                    console.log(xhr.status + " " + errorThrown);
                }
            });
        }
    });

    /**
     * Click listener for EDIT button for a single interest
     */
    $('#interests-table').on('click', '.interest-edit', function () {
        console.log('edit btn');
        $('.modal-title').html('');
        $('.btn-add').hide();
        $('.btn-edit').show();

        fillInterestInputs(this);
        var interest = getCurrentInterest(this);
        
        // Click listener for the submit button edit of the interests form
        $('.btn-edit').on('click', function (e) {                
            e.preventDefault();
            var form = $('#interests-form');

            if (isValid(form)) {
                //Form the post request string from data which was gotten above
                var interestId = interest.protected.id;
                console.log('id = '+interestId);
                var form = $('#interests-form');
                var request = getInterestsFormData(form);
                console.log('request = ' + request);
                $.ajax({
                    type: "POST",
                    data: request,
                    url: "/interests/edit/" + interestId,
                    success: function (response) {
                        $('#interest-form-modal .modal-title').html(response);
                        showClientInterests(activeClient);
                    },
                    error: function (xhr, errorThrown) {
                        console.log(xhr.status + " " + errorThrown);
                    }
                });
            } else {
                $(this).off('click', e);
            }
        });
    });

    /**
     * Click listener for the DELETE button of the interests form
     */
    $('#interests-table').on('click', '.interest-delete', function () {
        console.log('delete btn');
        $('.modal-title').html('');
        
        var interest = getCurrentInterest(this);
        console.log(interest);
        var interestId = interest.protected.id;

        var method = $('[name=_method]').val();
        var csrfToken = $('[name=_csrfToken]').val();
        var request = '_method=' + method + '&_csrfToken=' + csrfToken;

        // Click listener for the button delete of the interests form
        $('.delete-confirm').on('click', function (ev) {
            $.ajax({
                type: "POST",
                data: request,
                url: "/interests/delete/" + interestId,
                success: function (response) {
                    $('#delete-confirm-modal .modal-title').html(response);
                    setTimeout(() => {
                        $('#delete-confirm-modal').modal('toggle');
                    }, 800);
                    showClientInterests(activeClient);
                },
                error: function (xhr, errorThrown) {
                    console.log(xhr.status + " " + errorThrown);
                }
            });
            $(this).off('click');
        });

        $('.delete-dismiss').on('click', function (ev) {
            $('.delete-confirm').off('click');
            $(this).off('click');
        });
    });
    
    /**
     * Get the current interest object with interest id and all the data from 'tr'
     * @param {jquery object} interestControlButton 
     */
    function getCurrentInterest(interestControlButton) {
        var interest = $(interestControlButton).parent().parent()[0];
        
        var interestId = interest.cells[0].innerText.trim();
        var text       = interest.cells[1].innerText.trim();
        var comment    = interest.cells[2].innerText.trim();
        var created_at = interest.cells[3].innerText.trim();
        var status_id  = interest.cells[4].innerText.trim();

        return {
            protected: {id: interestId},
            public: {
                text: text,
                comment: comment,
                created_at: created_at,
                status_id: status_id
            }
        }
    }
    
    /**
     * Fill all fields in the interests form
     * @param {jquery object} interestControlButton 
     */
    function fillInterestInputs(interestControlButton) {
        var interest = getCurrentInterest(interestControlButton);
        interest = Object.values(interest.public);
        //Here we fill inputs of the interests form with the data from the current 'tr'
        $('#interests-form input[name!=_method][name!=_csrfToken], \
            #interests-form textarea, \
            #interests-form select').each(function (index) {
            
                $(this).val(interest[index]);
        });
    }

    /**
     * Getting the Post request string from the interests form
     * @param {jquery object} form 
     */
    function getInterestsFormData(form) {
        // getting client id and date right. cause we don't use helpers
        var clientId = encodeURI('&clients[_ids][]=' + activeClient.cells[0].innerText);
        var date = $('#created-at').val().split('-');
        var date = encodeURI('&created_at[year]=' + date[0] +
            '&created_at[month]=' + date[1] +
            '&created_at[day]=' + date[2]);

        var request = $('input[id!=created-at], textarea, select', form).serialize();
        request += (date + clientId);

        return request;
    }        
    
    /**
     * Validate the interests form via ParsleyJS
     * @param {jquery object} form 
     */
    function isValid(form) {
        $(form).parsley({
            errorsMessagesDisabled: true
        });
        form.parsley().validate();
        if (form.parsley().isValid()) {
            return true;
        } else {
            return false;
        }
    }

});
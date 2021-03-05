(function($){

    var customer_logo_file = null;
    var customer_document_files = [];
    var logo_file_changed = 0;

    $(document).ready(function(){
        // customer page

        if($('.customer-edit-page').length == 0){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            
            var start_date = mm + '/' + dd + '/' + yyyy;
            if($('#end_date').length > 0){
                //Date picker
                var end_date = new Date(Date.now() + 31 * 24 * 60 * 60 * 1000);
                var end_date_dd = String(end_date.getDate()).padStart(2, '0');
                var end_date_mm = String(end_date.getMonth() + 1).padStart(2, '0'); //January is 0!
                var end_date_yyyy = end_date.getFullYear();
                
                var end_day_date = end_date_mm + '/' + end_date_dd + '/' + end_date_yyyy;
                $('#end_date').val(end_day_date);
                $('#end_date').datepicker({
                    autoclose: true,
                    dateFormat: 'mm/dd/yyyy'
                });
                
                // $('.date-picker').datepicker('setDate', new Date(Date.now() + 31 * 24 * 60 * 60 * 1000));
    
            }    
    
            if($('#start_date').length > 0){
                $('#start_date').val(start_date)
            }
        }
        else{
            $('.date-picker').datepicker({
                autoclose: true,
                dateFormat: 'mm/dd/yyyy'
            });
        }

        $(document).on('change', '#logo_file', function(e) {
            var file = e.originalEvent.srcElement.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                // img.src = reader.result;
                $('.logo-preview').attr('src', reader.result);
            }
            reader.readAsDataURL(file);

            customer_logo_file = file;

            logo_file_changed = 1;
        });

        $(document).on('click', '#document_add_btn', function(){
            $('#document_file').trigger('click');
        })

        function addDocument(file){
            var document_row = $('#document_row_template').clone();
            $(document_row).find('.document-file').text(file.name);
            $('#documents_list').append(document_row.html());

            $('#document_file').val('');

            customer_document_files.push(file);
        }

        $(document).on('change', '#document_file', function(e) {
            var max_documents_count = parseInt($('#max_documents_count').val());
            if($('#documents_list .document-row').length >= max_documents_count){
                alert('Please change max number of documents!');
                $('#max_documents_count').focus();
                return;
            }
            var file = e.originalEvent.srcElement.files[0];
            addDocument(file);
        });

        $(document).on('click', '.document-delete-btn', function(){
            
            if(confirm('Are you sure to delete?')){
                if($(this).parents('.document-row').hasClass('document-row-new')){
                    var doc_index = $('#documents_list .document-row-new').index($(this).parents('.document-row-new'));
                    customer_document_files.splice(doc_index, 1);
                }
                
                $(this).parents('.document-row').remove();

                if($(this).hasClass('doc--saved')){
                    var index = $(this).attr('doc-index');
                    if(index != ''){
                        index = parseInt(index);
                        removed_saved_docs.push(index);
                    }
                }
            }
            
        })

        function checkURLTag(){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '/check_url_tag',
                    type: "post",
                    data: {
                        url_tag: $('#url_tag').val()
                    },
                    success: function(resp){
                        resp = JSON.parse(resp);
                        resolve(resp);
                    }
                })
            })
        }

        async function customerAdd(){
            var check_url_tag_result = await checkURLTag();
            if(check_url_tag_result.success){
                if(check_url_tag_result.exist){
                    alert('url tag already exist! please use another url tag.')
                    $('#url_tag').focus();
                    return;
                }
            }

            var customer_data = new FormData($('#form_customer')[0]);
            for(var index = 0; index < customer_document_files.length; index++){
                customer_data.append('doc_file_' + index, customer_document_files[index]);
                customer_data.append('doc_file_label_' + index, $($('#documents_list .document-row')[index]).find('input').val() );
            }

            customer_data.append('docs_count', customer_document_files.length);

            $.ajax({
                url: '/customer_new',
                type: "post",
                contentType: false,
                processData: false,
                cache: false,
                enctype: 'multipart/form-data',
                data: customer_data,
                success: function(){
                    alert('Added Successfully!');
                }
            })
        }

        async function customerUpdate(){

            if($('#url_tag').val() != $('#url_tag_old').val()){
                var check_url_tag_result = await checkURLTag();
                if(check_url_tag_result.success){
                    if(check_url_tag_result.exist){
                        alert('url tag already exist! please use another url tag.')
                        $('#url_tag').focus();
                        return;
                    }
                }   
            }

            var customer_data = new FormData($('#form_customer')[0]);
            for(var index = 0; index < customer_document_files.length; index++){
                customer_data.append('doc_file_' + index, customer_document_files[index]);
                customer_data.append('doc_file_label_' + index, $($('#documents_list .document-row-new')[index]).find('input').val() );
            }

            customer_data.append('docs_count', customer_document_files.length);
            customer_data.append('customer_id', $('#btn_site_update').attr('customer-id'));
            customer_data.append('logo_file_changed', logo_file_changed);

            // delete removed index
            var new_saved_docs = [];
            for(var index = 0; index < saved_docs.length; index++){
                if(removed_saved_docs.indexOf(index) == -1){
                    new_saved_docs.push(saved_docs[index]);
                }
            }
            customer_data.append('saved_docs', JSON.stringify(new_saved_docs));
            
            $.ajax({
                url: '/customer_update',
                type: "post",
                contentType: false,
                processData: false,
                cache: false,
                enctype: 'multipart/form-data',
                data: customer_data,
                success: function(){
                    alert('Updated Successfully!');
                }
            })
        }

        function checkFields(){
            if($('#business_name').val() == ''){
                alert('Please input business name!');
                $('#business_name').focus();
                return false;
            }

            if($('#business_address').val() == ''){
                alert('Please input business address!');
                $('#business_address').focus();
                return false;
            }

            if($('#business_city').val() == ''){
                alert('Please input business city!');
                $('#business_city').focus();
                return false;
            }

            if($('#business_state').val() == ''){
                alert('Please input business state!');
                $('#business_state').focus();
                return false;
            }

            if($('#business_zip').val() == ''){
                alert('Please input business zip!');
                $('#business_zip').focus();
                return false;
            }

            if($('#business_phone').val() == ''){
                alert('Please input business phone!');
                $('#business_phone').focus();
                return false;
            }

            if($('#business_email').val() == ''){
                alert('Please input business email!');
                $('#business_email').focus();
                return false;
            }

            if(!ValidateEmail($('#business_email').val())){
                alert('Please input valid business email');
                $('#business_email').focus();
                return;
            }

            if($('#website').val() == ''){
                alert('Please input website!');
                $('#website').focus();
                return false;
            }

            if($('#contact_name').val() == ''){
                alert('Please input contact name!');
                $('#contact_name').focus();
                return false;
            }

            if($('#contact_email').val() == ''){
                alert('Please input contact email!');
                $('#contact_email').focus();
                return false;
            }

            if(!ValidateEmail($('#contact_email').val())){
                alert('Please input valid contact email');
                $('#contact_email').focus();
                return;
            }

            if($('#contact_phone').val() == ''){
                alert('Please input contact phone!');
                $('#contact_phone').focus();
                return false;
            }

            if($('#end_date').val() == ''){
                alert('Please input end date!');
                $('#end_date').focus();
                return false;
            }

            if($('#url_tag').val() == ''){
                alert('Please input url tag!');
                $('#url_tag').focus();
                return false;
            }

            return true;
        }

        $(document).on('click', '#btn_site_update', function(){
            
            if(checkFields()){
                customerUpdate();
            }           

        })

        $(document).on('click', '#btn_site_add', function(){
            
            if(checkFields()){
                customerAdd();
            }           

        })

        // Customer List Page
        $(document).on('click', '.customer-delete-btn', function(){
            if(confirm('Are you sure to delete?')){
                $.ajax({
                    url: '/customer_delete',
                    type: 'POST',
                    data: {
                        customer_id: $(this).attr('customer-id'),
                    },
                    success: function(response){
                        alert('Deleted Successfully!');
                        location.reload();
                    }
                })
            }
        })

        // Login Page
        function ValidateEmail(email) 
        {
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
            {
                return true;
            }
            return false;
        }

        $(document).on('click', '#btn_login', function(){
            if($('#email').val() == ''){
                alert('Please input email');
                $('#email').focus();
                return;
            }

            if(!ValidateEmail($('#email').val())){
                alert('Please input valid email');
                $('#email').focus();
                return;
            }

            if($('#password').val() == ''){
                alert('Please input password');
                $('#password').focus();
                return;
            }

            $.ajax({
                url: '/admin_api/login',
                type: 'POST',
                data: {
                    email: $('#email').val(),
                    password: $('#password').val()
                },
                success: function(response){
                    response = JSON.parse(response);
                    if(response.success){
                        location.href="/admin";
                    }
                    else{
                        alert('Please input correct login information');
                    }
                }
            })
        })

        $(document).on('click', '#btn_register', function(){
            if($('#full_name').val() == ''){
                alert('Please input full name');
                $('#full_name').focus();
                return;
            }

            if($('#email').val() == ''){
                alert('Please input email');
                $('#email').focus();
                return;
            }

            if(!ValidateEmail($('#email').val())){
                alert('Please input valid email');
                $('#email').focus();
                return;
            }

            if($('#password').val() == ''){
                alert('Please input password');
                $('#password').focus();
                return;
            }

            if($('#rt_password').val() == ''){
                alert('Please retype password');
                $('#rt_password').focus();
                return;
            }

            if($('#password').val() != $('#rt_password').val()){
                alert('Please input correct retype password');
                $('#rt_password').focus();
                return;
            }

            $.ajax({
                url: '/admin_api/register',
                type: 'POST',
                data: {
                    full_name: $('#full_name').val(),
                    email: $('#email').val(),
                    password: $('#password').val()
                },
                success: function(response){
                    response = JSON.parse(response);
                    if(response.success){
                        location.href="/login";
                    }
                    else{
                        alert('Register Failed');
                    }
                }
            })
        })
    })
})(jQuery)
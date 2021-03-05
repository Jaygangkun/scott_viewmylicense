<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Customer
    </h1>
</section>
<!-- Main content -->
<section class="content customer-edit-page">
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-body">
                    <form name="form_customer" id="form_customer">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="business_name">Customer Business Name</label>
                                    <input type="text" class="form-control" id="business_name" name="business_name" placeholder="" value="<?php echo $customer['business_name']?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_address">Customer Business Address</label>
                            <input type="text" class="form-control" id="business_address" name="business_address" placeholder="" value="<?php echo $customer['business_address']?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="business_city">Customer Business City</label>
                                    <input type="text" class="form-control" id="business_city" name="business_city" placeholder="" value="<?php echo $customer['business_city']?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="business_state">Customer Business State</label>
                                    <input type="text" class="form-control" id="business_state" name="business_state" placeholder="" value="<?php echo $customer['business_state']?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="business_zip">Customer Business Zip Code</label>
                                    <input type="text" class="form-control" id="business_zip" name="business_zip" placeholder="" value="<?php echo $customer['business_zip']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="business_phone">Customer Business Phone</label>
                                    <input type="text" class="form-control" id="business_phone" name="business_phone" placeholder="" value="<?php echo $customer['business_phone']?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="business_email">Customer Business Email</label>
                                    <input type="text" class="form-control" id="business_email" name="business_email" placeholder="" value="<?php echo $customer['business_email']?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="website">Customer Website</label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="" value="<?php echo $customer['website']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_name">Contact Name</label>
                                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="" value="<?php echo $customer['contact_name']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_email">Contact Email</label>
                                    <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="" value="<?php echo $customer['contact_email']?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_phone">Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="" value="<?php echo $customer['contact_phone']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="logo_file" accept="image/png, image/jpeg" name="logo_file">
                                    <div class="logo-preview-wrap">
                                        <img class="logo-preview" src="<?php echo $customer['logo'] != '' ? $customer['logo'] : '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control date-picker" id="start_date" name="start_date" value="<?php echo $customer['start_date']?>">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="text" class="form-control date-picker" id="end_date" name="end_date" placeholder="" value="<?php echo $customer['end_date']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="url_tag">Customer URL Tag</label>
                                    <input type="text" class="form-control" id="url_tag" name="url_tag" placeholder="" value="<?php echo $customer['url_tag']?>">
                                    <input type="hidden" id="url_tag_old" value="<?php echo $customer['url_tag']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_documents_count">Max Number of Documents</label>
                                    <input type="text" class="form-control" id="max_documents_count" name="max_documents_count" placeholder="" value="<?php echo $customer['max_docs_number']?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="documents">Documents</label> <span class="document-add-btn text-primary" id="document_add_btn"><i class="fa fa-plus"></i></span>
                                    <div class="documents-list" id="documents_list">
                                        <script>
                                            var saved_docs = [];
                                            var removed_saved_docs = [];
                                        </script>
                                        <?php
                                        $db_documents = $customer['documents'];
                                        if($db_documents != ''){
                                            $documents = json_decode($db_documents, true);

                                            if(count($documents) > 0){
                                                ?>
                                                <script>
                                                    var saved_docs = JSON.parse('<?php echo $db_documents?>');
                                                </script>
                                                <?php
                                                for($index = 0; $index < count($documents); $index++){
                                                    $document = $documents[$index];
                                                    ?>
                                                    <div class="document-row document-row-old">
                                                        <div class="document-title">
                                                            <input type="text" class="document-title-input" value="<?php echo $document['label']?>" placeholder="please input customer label">
                                                        </div>
                                                        <div class="document-file"><?php echo isset($document['file_name']) ? $document['file_name'] : ''; ?></div>
                                                        <div class="document-action">
                                                            <span class="document-delete-btn text-danger doc--saved" doc-index="<?php echo $index?>"><i class="fa fa-times"></i></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" id="btn_site_update" customer-id="<?php echo $customer['id']?>">Update</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<input type="file" class="hidden" id="document_file" accept="image/png, image/jpeg, application/pdf, application/tif" name="document_file">
<div class="hidden" id="document_row_template">
    <div class="document-row document-row-new">
        <div class="document-title">
            <input type="text" class="document-title-input" value="Business License" placeholder="please input customer label">
        </div>
        <div class="document-file"></div>
        <div class="document-action">
            <span class="document-delete-btn text-danger"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
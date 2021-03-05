<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customers List
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <table id="site_list" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>Contact Name</th>
                            <th>Contact Email</th>
                            <th>Contact Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($customers as $customer){
                            ?>
                            <tr>
                                <th>
                                    <div class="business-name-wrap">
                                        <span><?php echo $customer['business_name']?></a>
                                    </div>
                                </th>
                                <th>
                                    <div class="contact-name-wrap">
                                        <?php echo $customer['contact_name']?>
                                    </div>
                                </th>
                                <th>
                                    <div class="contact-email-wrap">
                                        <?php echo $customer['contact_email']?>
                                    </div>
                                </th>
                                <th>
                                    <div class="contact-phone-wrap">
                                        <?php echo $customer['contact_phone']?>
                                    </div>
                                </th>
                                <th>
                                    <div class="customer-action">
                                        <a class="text-primary" href="<?php echo base_url($customer['url_tag'])?>" target="_blank">View</button>
                                        <a href="/admin/customer_edit/<?php echo $customer['id']?>">Edit</a>
                                        <a class="text-danger customer-delete-btn" href="javascript:void" customer-id="<?php echo $customer['id'] ?>">Delete</span>
                                    </div>
                                </th>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Site URL</th>
                            <th>Employers</th>
                            <th>API Key</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script>
  $(function () {
    $("#site_list").DataTable();
  });
</script>
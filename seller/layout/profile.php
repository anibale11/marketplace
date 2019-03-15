
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update your Profile</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="http://localhost/magento23/marketplace/index/update" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                <input type="hidden" name="form_key" value="<?php echo $formkey; ?>">
                <input type="hidden" name="vendor_id" value="1">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" name="name" id="fullname" placeholder="Enter Full Name" value="<?php echo $vendor->getName(); ?>" required>
                </div>
                <div class="form-group">
                    <label for="streetaddress">Street Address</label>
                    <input type="text" class="form-control" name="street_address" id="streetaddress" placeholder="Enter Street Address" value="<?php echo $vendor->getStreetAddress(); ?>" required>
                </div>
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" required value="<?php echo $vendor->getPincode(); ?>">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" required value="<?php echo $vendor->getCity(); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required value="<?php echo $vendor->getEmail(); ?>">
                </div>
                <div class="form-group">
                    <label for="phoneno">Phone no</label>
                    <input type="text" class="form-control" name="phoneno" id="phoneno" placeholder="Enter Phone no" required pattern="[789][0-9]{9}" value="<?php echo $vendor->getPhoneno();?>" >
                </div>
                <div class="form-group">
                    <label for="shopname">Shop name</label>
                    <input type="text" class="form-control" name="store_name" id="shopname" placeholder="Enter Shop name" required value="<?php echo $vendor->getStoreName(); ?>">
                </div>
                <div class="form-group">
                    <label for="gstno">GST no</label>
                    <input type="text" class="form-control" name="gst_no" id="gstno" placeholder="Enter GST No" required value="<?php echo $vendor->getGstNo(); ?>">
                </div>
                <div class="form-group">
                    <label for="bankdetail">Bank Details</label>
                    <textarea class="form-control" name="bank_details" rows="5" cols="70" ><?php echo $vendor->getBankDetails(); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="shoplogo">Shop Logo</label>
                    <input type="file" name="vendor_logo" id="shoplogo">
                    <?php if($vendor->getVendorLogo()){ ?>
                        <img width='200' src="<?php echo 'http://localhost/magento23/pub/media/seller/'.$vendor->getVendorLogo(); ?>">
                    <?php } ?>
                   
                </div>
                <div class="form-group">
                    <label for="shopbanner">Shop Banner</label>
                    <input type="file" name="vendor_banner" id="shopbanner">
                    <?php if($vendor->getVendorBanner()){ ?>
                        <img  src="<?php echo 'http://localhost/magento23/pub/media/seller/'.$vendor->getVendorBanner(); ?>">
                    <?php } ?>
                </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
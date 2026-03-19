<?php defined("BASEPATH") or exit("No direct scripts allowed here"); ?>
<?php
if (isset($action)) {
    switch ($action) {

        case "AssignDelvieryBoy":
            ?>
            <form action="<?php echo base_url('Manager/ManageBooking/Update/') ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />

                <div class="form-group">
                    <label for="deliveryBoySelect">Select Delivery Boy</label>
                    <select class="form-control" id="deliveryBoySelect" name="delivery_boy" required>
                        <option value="">-- Select --</option>
                        <?php
                        $delivery_boys = $this->db->where('status', 'true')->order_by("id", "DESC")->get('delivery_boy')->result();
                        foreach ($delivery_boys as $boy):
                            ?>
                            <option value="<?= $boy->id ?>" <?= ($list[0]->delivery_boy_id == $boy->id) ? 'selected' : '' ?>>
                                <?= $boy->name ?> (
                                <?= $boy->mobile ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer px-0 pb-0 shadow-none border-0 mt-3">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Assign</button>
                </div>
            </form>
            <?php
            break;

        case 'EditDeliveryBoy':
            ?>
            <form action="<?php echo base_url('Manager/ManageDeliveryBoy/Update/') ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label fw-bold text-muted text-uppercase small">Full Name</label>
                        <input type="text" name="name" value="<?php echo $list[0]->name; ?>" class="form-control" required />
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label fw-bold text-muted text-uppercase small">Email Address</label>
                        <input type="email" name="email" value="<?php echo $list[0]->email; ?>" class="form-control" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label fw-bold text-muted text-uppercase small">Mobile Number</label>
                        <input type="tel" name="mobile" value="<?php echo $list[0]->mobile; ?>" class="form-control" minlength="10"
                            maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Please enter 10 digits starting with 6, 7, 8 or 9"
                            required oninput="validateMobile(this)" />
                        <span class="mobile-msg small"></span>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label fw-bold text-muted text-uppercase small">Password</label>
                        <input type="text" name="password" value="<?php echo $list[0]->password; ?>" class="form-control"
                            required />
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold text-muted text-uppercase small">Residential Address</label>
                    <textarea class="form-control" name="address" rows="2" required><?php echo $list[0]->address; ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label fw-bold text-muted text-uppercase small">Aadhar Number</label>
                        <input type="text" name="aadhar" value="<?php echo $list[0]->aadharno; ?>" class="form-control"
                            minlength="12" maxlength="12" required />
                    </div>
                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label fw-bold text-muted text-uppercase small">Status</label>
                        <select name="status" class="form-control">
                            <option value="true" <?= ($list[0]->status == 'true') ? 'selected' : '' ?>>Active</option>
                            <option value="false" <?= ($list[0]->status == 'false') ? 'selected' : '' ?>>Deactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer px-0 pb-0 shadow-none border-0">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Update Delivery Boy</button>
                </div>
            </form>
            <script>
                function validateMobile(input) {
                    const pattern = /^[6-9][0-9]{9}$/;
                    const msg = input.nextElementSibling;
                    if (pattern.test(input.value)) {
                        input.setCustomValidity("");
                        msg.textContent = "Valid mobile number";
                        msg.style.color = "green";
                    } else {
                        input.setCustomValidity("Please enter 10 digits starting with 6, 7, 8 or 9");
                        msg.textContent = "Invalid mobile number (Must be 10 digits starting with 6-9)";
                        msg.style.color = "red";
                    }
                }
            </script>
            <?php
            break;
    }
} else {
    echo 'Action is required.';
}
?>
<?php defined("BASEPATH") or exit("No direct scripts allowed here"); ?>
<?php
if (isset($action)) {
	switch ($action) {

		case 'EditUser':
			?>
			<form action="<?php echo base_url('Admin/ManageUser/Update/') ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-3">
							<label class="form-label fw-bold text-muted">Full Name</label>
							<input type="text" name="name" value="<?php echo $list[0]->name; ?>" class="form-control"
								placeholder="Enter Full Name" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-3">
							<label class="form-label fw-bold text-muted">Email Address</label>
							<input type="email" name="email" value="<?php echo $list[0]->email; ?>" class="form-control"
								placeholder="Enter Email" required />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-3">
							<label class="form-label fw-bold text-muted">Mobile Number</label>
							<input type="text" name="mobile" value="<?php echo $list[0]->mobile; ?>" class="form-control"
								placeholder="Enter Mobile" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-3">
							<label class="form-label fw-bold text-muted">Password</label>
							<input type="text" name="password" value="<?php echo $list[0]->password; ?>" class="form-control"
								placeholder="Enter Password" required />
						</div>
					</div>
				</div>
				<div class="modal-footer px-0 pb-0 shadow-none border-0">
					<button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary px-4">Save Changes</button>
				</div>
			</form>
			<?php
			break;

		case 'EditPrice':
			?>
			<form action="<?php echo base_url('Admin/ManagePricing/Update/') ?>" method="POST">
				<input type="hidden" name="old_from" value="<?php echo $from_pin; ?>" />
				<input type="hidden" name="old_to" value="<?php echo $to_pin; ?>" />
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-3">
							<label class="form-label fw-bold text-muted small uppercase">From Pincode</label>
							<input type="number" name="from" value="<?php echo $from_pin; ?>" class="form-control font-weight-bold"
								oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-3">
							<label class="form-label fw-bold text-muted small uppercase">To Pincode</label>
							<input type="number" name="to" value="<?php echo $to_pin; ?>" class="form-control font-weight-bold"
								oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);" required />
						</div>
					</div>
				</div>

				<div class="form-group mb-3">
					<label class="fw-bold mb-3 text-dark">Update Prices for Weight Slots</label>
					<div class="table-responsive border rounded" style="max-height: 250px; overflow-y: auto;">
						<table class="table table-bordered table-sm text-center mb-0">
							<thead class="bg-light">
								<tr>
									<th>Weight Range</th>
									<th>Price (₹)</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$slots = $this->db->get('weight_slots')->result();
								$existing_prices = [];
								if (!empty($list)) {
									foreach ($list as $p) {
										$existing_prices[$p->weight_slot_id] = $p->price_per_kg;
									}
								}
								foreach ($slots as $s): ?>
									<tr>
										<td class="align-middle">
											<span class="badge badge-info"><?= $s->slot_name ?></span>
											<br><small class="text-muted"><?= $s->min_weight ?>kg - <?= $s->max_weight ?>kg</small>
										</td>
										<td class="align-middle">
											<input type="number" step="0.01" class="form-control form-control-sm mx-auto"
												style="max-width: 120px;" name="prices[<?= $s->id ?>]"
												value="<?= $existing_prices[$s->id] ?? '' ?>" placeholder="0.00">
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<small class="text-muted mt-2 d-block">* Leave empty to remove pricing for a specific range.</small>
				</div>

				<div class="modal-footer px-0 pb-0 shadow-none border-0">
					<button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary px-4">Save Changes</button>
				</div>
			</form>
			<?php
			break;

		case 'EditDistance':
			?>
			<form action="<?php echo base_url('Admin/ManageDistance/Update/') ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
				<div class="form-group">
					<label for="Distance">Distance(km)</label>
					<input type="number" class="form-control" id="Distance" value="<?php echo $list[0]->distance; ?>"
						name="distance">
				</div>
				<div class="form-group">
					<label for="Weight">Weight</label>
					<input type="number" class="form-control" id="Weight" value="<?php echo $list[0]->weight; ?>" name="weight">
				</div>
				<div class="form-group">
					<label for="Price">Price(₹)</label>
					<input type="number" class="form-control" id="Price" value="<?php echo $list[0]->price; ?>" name="price">
				</div>
				<div class="modal-footer px-4">
					<button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary btn-pill">Update</button>
				</div>
			</form>
			<?php
			break;

		case 'EditDeliveryBoy':
			?>
			<form action="<?php echo base_url('Admin/ManageDeliveryBoy/Update/') ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
				<div class="row">
					<div class="col-md-6 form-group mb-3">
						<label class="form-label fw-bold text-muted">Full Name</label>
						<input type="text" name="name" value="<?php echo $list[0]->name; ?>" class="form-control" required />
					</div>
					<div class="col-md-6 form-group mb-3">
						<label class="form-label fw-bold text-muted">Email</label>
						<input type="email" name="email" value="<?php echo $list[0]->email; ?>" class="form-control" required />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group mb-3">
						<label class="form-label fw-bold text-muted">Mobile Number</label>
						<input type="tel" name="mobile" value="<?php echo $list[0]->mobile; ?>" class="form-control" minlength="10"
							maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Please enter 10 digits starting with 6, 7, 8 or 9"
							required oninput="validateMobile(this)" />
						<span class="mobile-msg small"></span>
					</div>
					<div class="col-md-6 form-group mb-3">
						<label class="form-label fw-bold text-muted">Password</label>
						<input type="text" name="password" value="<?php echo $list[0]->password; ?>" class="form-control"
							required />
					</div>
				</div>
				<div class="form-group mb-3">
					<label class="form-label fw-bold text-muted">Residential Address</label>
					<textarea class="form-control" name="address" rows="2" required><?php echo $list[0]->address; ?></textarea>
				</div>
				<div class="form-group mb-4">
					<label class="form-label fw-bold text-dark">Aadhar Number</label>
					<input type="text" name="aadhar" value="<?php echo $list[0]->aadharno; ?>" class="form-control" minlength="12"
						maxlength="14" required />
				</div>
				<div class="modal-footer px-0 pb-0 shadow-none border-0">
					<button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary px-4">Update Profile</button>
				</div>
			</form>
			<?php
			break;

		case "AssignDelvieryBoy":
			?>
			<form action="<?php echo base_url('Admin/ManageBooking/Update/') ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />

				<div class="form-group">
					<label for="deliveryBoySelect">Select Delivery Boy</label>
					<select class="form-control" id="deliveryBoySelect" name="delivery_boy">
						<?php
						$delivery_boys = $this->db->order_by("id", "DESC")->get('delivery_boy')->result();
						foreach ($delivery_boys as $boy):
							?>
							<option value="<?= $boy->id ?>"><?= $boy->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="modal-footer px-4">
					<button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary btn-pill">Assign</button>
				</div>
			</form>
			<?php
			break;

		case 'EditWeightSlot':
			?>
			<form action="<?php echo base_url('Admin/ManageWeightSlots/Update/') ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
				<div class="form-group mb-3">
					<label class="form-label fw-bold text-muted">Slot Name</label>
					<input type="text" name="slot_name" value="<?php echo $list[0]->slot_name; ?>" class="form-control"
						placeholder="e.g. Small (0.5kg - 2kg)" required />
				</div>
				<div class="row">
					<div class="col-md-6 form-group mb-3">
						<label class="form-label fw-bold text-muted">Min Weight (kg)</label>
						<input type="number" step="0.01" name="min_weight" placeholder="eg 0.500"
							value="<?php echo $list[0]->min_weight; ?>" class="form-control" required />
					</div>
					<div class="col-md-6 form-group mb-3">
						<label class="form-label fw-bold text-muted">Max Weight (kg)</label>
						<input type="number" step="0.01" name="max_weight" placeholder="eg 2"
							value="<?php echo $list[0]->max_weight; ?>" class="form-control" required />
					</div>
				</div>
				<div class="modal-footer px-0 pb-0 shadow-none border-0">
					<button type="button" class="btn btn-light px-4" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary px-4">Update Slot</button>
				</div>
			</form>
			<?php
			break;

		case 'EditManager':
			?>
			<form action="<?php echo base_url('Admin/ManageManager/Update/') ?>" method="POST">
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
						<input type="text" name="aadhar_number" value="<?php echo $list[0]->aadhar_number; ?>" class="form-control"
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
					<button type="submit" class="btn btn-primary px-4">Update Manager</button>
				</div>
			</form>
			<?php
			break;

	}
} else {
	echo 'Action is required.';
}
?>

<script>
	$('.dropify').dropify();
</script>
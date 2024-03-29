<h1>
	Users
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit Profile</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="" method="post">
					<div class="form-group <?= form_error('fullname') ? 'has-error' : null ?>">
						<label>Nama</label>
						<input type="hidden" name="user_id" value="<?= $row->id_user ?>">
						<input type="text" name="fullname" value="<?= $this->input->post('fullname') ?? $row->name ?>" class="form-control">
						<?= form_error('fullname') ?>
					</div>
					<div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
						<label>Username</label>
						<input type="text" name="username" value="<?= $this->input->post('username') ?? $row->username ?>" class="form-control">
						<?= form_error('username') ?>
					</div>
					<div class="form-group <?= form_error('email') ? 'has-error' : null ?>">
						<label>Email</label>
						<input type="email" name="email" value="<?= $this->input->post('email') ?? $row->email ?>" class="form-control">
						<?= form_error('email') ?>
					</div>
					<div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
						<label>Password</label><small> (Biarkan apabila tidak ada perubahan)</small>
						<input type="password" name="password" value="<?= $this->input->post('password') ?>" class="form-control">
						<?= form_error('password') ?>
					</div>
					<div class="form-group <?= form_error('passconf') ? 'has-error' : null ?>">
						<label>Ketik Ulang Password</label>
						<input type="password" name="passconf" value="<?= $this->input->post('passconf') ?>" class="form-control">
						<?= form_error('passconf') ?>
					</div>
					<div class="form-group">
						<button href="<?= site_url('Admin/edit_profile/edit/' . $row->id_user) ?>" type="submit" class="btn btn-success btn-flat">
							<i class="fa fa-paper-plane"></i> Simpan
						</button>
						<button type="reset" class="btn btn-flat">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

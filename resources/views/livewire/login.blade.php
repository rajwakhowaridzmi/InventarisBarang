<div>
<div>
  <div class="card mb-3">
    <div class="card-body">
      <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Login ke Barang Inventaris</h5>
        <p class="text-center small">Masukan username & password untuk login</p>
      </div>

      <form wire:submit.prevent="login" class="row g-3 needs-validation" novalidate>
        <div class="col-12">
          <label for="yourUsername" class="form-label">Username</label>
          <div class="input-group has-validation">
            <input type="text" wire:model="user_nama" class="form-control" id="yourUsername" required>
            <div class="invalid-feedback">Please enter your username.</div>
          </div>
        </div>

        <div class="col-12">
          <label for="yourPassword" class="form-label">Password</label>
          <input type="password" wire:model="user_pass" class="form-control" id="yourPassword" required>
          <div class="invalid-feedback">Please enter your password!</div>
        </div>

        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary w-100" type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

</div>

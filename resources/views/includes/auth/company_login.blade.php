
<label for="company_id">{{ ui_change('company_id', 'auth') }}</label>
<input type="text"    id="company_id" name="company_id" placeholder="enter your company id" required value="{{ $company_id }}">

<label for="domain">{{ ui_change('domain', 'auth') }}</label>
<input type="text"  id="domain"  name="domain" placeholder="enter your domain" required value="{{ $host }}">


<label for="email">{{ ui_change('Username', 'auth') }}</label>
<input type="text"  name="user_name" placeholder="enter your username" required>


<label for="password">{{ ui_change('Password', 'auth') }}</label>
<div class="password-input">
    <input type="password" name="password"  placeholder="************" required>

</div>
<script>
    const companyInput = document.getElementById('company_id');
    const domainInput = document.getElementById('domain');

    companyInput.addEventListener('input', function () {
        domainInput.value = companyInput.value ? companyInput.value + '.admin-pfm.finexerp.com' : '';
    });
</script>
<button type="submit" class="submit-btn">{{ __('general.submit') }}</button>
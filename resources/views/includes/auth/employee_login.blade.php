<label for="company_id">{{ ui_change('company_id', 'auth') }}</label>
<input type="text" id="employee_company_id" name="company_id" placeholder="enter your company id" required value="{{ $company_id }}">

<label for="domain">{{ ui_change('domain', 'auth') }}</label>
<input type="text" id="employee_domain" name="domain" placeholder="enter your domain" required  value="{{ $host }}">



<label for="email">{{ ui_change('Username', 'auth') }}</label>
<input type="text" name="username" placeholder="enter your username" required>

<label for="password">{{ ui_change('Password', 'auth') }}</label>
<div class="password-input">
    <input type="password" name="password" placeholder="************" required>

</div>



<button type="submit" class="submit-btn">{{ ui_change('submit', 'auth') }}</button>
<script>
    const EmployeeCompanyInput = document.getElementById('employee_company_id');
    const EmployeeDomainInput = document.getElementById('employee_domain');

    EmployeeCompanyInput.addEventListener('input', function() {
        EmployeeDomainInput.value = EmployeeCompanyInput.value ? EmployeeCompanyInput.value +
            '.admin-pfm.finexerp.com' : '';
    });
</script>
 
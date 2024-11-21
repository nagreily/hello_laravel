<!-- /resources/views/auth.blade.php -->

<label for="email">Email address</label>

<input id="email" type="email" class="@error('email', 'login') is-invalid @enderror">

{{--指定错误包的名称，作为@error的第二个参数 ，用于检索含有多个表单的页面的验证错误信息--}}
@error('email', 'login')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

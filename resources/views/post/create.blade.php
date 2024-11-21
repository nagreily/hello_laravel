<!-- /resources/views/post/create.blade.php -->

<label for="title">Post Title</label>

<input id="title" type="text" class="@error('title') is-invalid @enderror">

{{--使用@error 回显$message变量显示错误信息--}}
@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

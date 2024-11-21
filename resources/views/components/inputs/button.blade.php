<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{--    使用“.”来指定目录层级，默认在App\View\Components下--}}
    <x-inputs.button/>
{{--通过调用与方法名称相同的变量名来执行方法isSelected--}}
    <option  {{ $isSelected($value) ? 'selected="selected"' : '' }} value="{{$value}}">
        {{ $label }}
    </option>

</div>

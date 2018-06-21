<div id="uploader_{{str_random()}}" class="uploader-list" data-options="{{$uploader_options}}" data-name="{{$name}}" data-max="{{$max}}" data-accept="{{$accept}}">
    @if(isset($value))
    <div id="WU_FILE_0" class="img-item">
        <div class="delete"></div>
        <img class="img" style="width:75px;height:75px;" src="{{ asset('uploads/file/'.$value) }}">
        <div class="wrapper" style="display: none;">100%</div>
        <input type="hidden" name="cover" value="{{ $value }}">
    </div>
    @endif
    <div class="img-item picker"></div>
    <div class="cf"></div>
</div>
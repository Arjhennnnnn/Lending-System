@props(['name','type' => 'text'])
<input type="{{ $type }}" class="form-control mt-2" name="{{ $name }}" placeholder="{{ $name }}" value="{{ old($name) }}">
<x-form.error name="{{ $name }}"/>
@props(['name'])
<div class="form-outline">
    <textarea class="form-control mt-2" name="{{ $name }}" rows="4"></textarea>
    <label class="form-label" for="textAreaExample">{{ $name }}</label>
</div>
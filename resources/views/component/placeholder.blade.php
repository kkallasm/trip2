<div style="
    width: 100%;
    padding: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px dashed #888;
    margin-bottom: 14px;
    @if (isset($height))
        height: {{ $height }}px;
    @endif
">
{{ $text }}
</div>
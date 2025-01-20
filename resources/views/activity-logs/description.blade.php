@if(is_array($data))
    <div class="text-sm">
        @foreach($data as $key => $value)
            <div class="mb-1">
                <span class="font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                @if(is_array($value))
                    <pre class="text-xs">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                @else
                    <span>{{ $value }}</span>
                @endif
            </div>
        @endforeach
    </div>
@else
    {{ $data }}
@endif

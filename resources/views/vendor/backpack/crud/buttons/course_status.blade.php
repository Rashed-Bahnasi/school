@if ($crud->hasAccess('update', $entry))
    <div class="btn-group">
        <button id="statusButton-{{ $entry->getKey() }}" class="btn btn-sm btn-link" onclick="toggleStatusOptions(this)">
            {{ $entry->status }}
        </button>
        <div id="statusOptions-{{ $entry->getKey() }}" class="status-options" style="display: none;">
            <ul>
                @foreach (['active' => 'نشط', 'inactive' => 'متوقف', 'completed' => 'مكتمل'] as $key => $value)
                    <li>
                        <a href="{{ url($crud->route . '/' . $entry->getKey() . '/change-status/' . $key) }}">
                            {{ ucfirst($value) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<script>
    function toggleStatusOptions(button) {
        const options = document.getElementById('statusOptions-' + button.id.split('-')[1]);
        options.style.display = options.style.display === 'none' ? 'block' : 'none';
    }
</script>

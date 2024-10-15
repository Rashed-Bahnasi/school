@if ($crud->hasAccess('update', $entry))
<div class="btn-group">
    <button id="statusButton-{{ $entry->getKey() }}" class="btn btn-sm btn-link" onclick="toggleStatusOptions(this)">
        {{ ucfirst($entry->status) }}
    </button>
    <div id="statusOptions-{{ $entry->getKey() }}" class="status-options" style="display: none;">
        <ul>
            @foreach(['active', 'inactive', 'completed'] as $status)
                <li>
                    <a href="{{ url($crud->route.'/'.$entry->getKey().'/change-status/'.$status) }}">
                        {{ ucfirst($status) }}
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
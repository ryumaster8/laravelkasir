<div class="flex space-x-2">
    <a href="{{ route('suppliers.edit', $row->supplier_id) }}" 
       class="text-yellow-500 hover:text-yellow-600">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('suppliers.delete', $row->supplier_id) }}" 
          method="GET" 
          class="inline-block">
        <button type="submit" 
                class="text-red-500 hover:text-red-600"
                onclick="return confirm('Apakah Anda yakin ingin menghapus supplier {{ $row->supplier_name }}?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div> 
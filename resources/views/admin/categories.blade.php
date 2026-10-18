@extends('layouts.app', ['title' => 'Categories - Admin Panel'])

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    @include('layouts.sidebar_admin')

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Category Management</h3>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addCategoryModal" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                <i class="fa-solid fa-plus me-2"></i> Add Category
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Categories Table Card -->
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="py-3 ps-4" style="width: 80px;">No</th>
                                <th scope="col" class="py-3">Image</th>
                                <th scope="col" class="py-3">Category Name</th>
                                <th scope="col" class="py-3 text-end pe-4" style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $cat)
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-medium">{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('assets/kategori/' . $cat->category_image) }}" alt="{{ $cat->category_name }}" width="60" height="60" class="rounded object-fit-cover shadow-sm">
                                    </td>
                                    <td class="fw-semibold">{{ $cat->category_name }}</td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-primary me-2 edit-btn" data-id="{{ $cat->category_id }}" data-name="{{ $cat->category_name }}" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $cat->category_id }}" data-name="{{ $cat->category_name }}" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addCategoryLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" class="form-control" id="add_name" name="name" required placeholder="e.g. Sports">
                    </div>
                    <div class="mb-3">
                        <label for="add_image" class="form-label fw-semibold">Category Image</label>
                        <input type="file" class="form-control" id="add_image" name="image" required accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editCategoryLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label fw-semibold">Category Image <span class="text-muted small fw-normal">(Leave blank to keep current)</span></label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" style="background-color: var(--accent-color); border-color: var(--accent-color);">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-danger" id="deleteCategoryLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="delete_id">
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete category <strong id="delete_name"></strong>? All related shoes under this category will also be deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('edit_id').value = btn.getAttribute('data-id');
            document.getElementById('edit_name').value = btn.getAttribute('data-name');
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('delete_id').value = btn.getAttribute('data-id');
            document.getElementById('delete_name').innerText = btn.getAttribute('data-name');
        });
    });
</script>
@endpush

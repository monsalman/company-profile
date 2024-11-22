<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($portfolio) ? 'Edit Portfolio' : 'Tambah Portfolio' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Icon::where('key', 'favicon')->first()?->value ?? 'favicon.png') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .form-control:focus, .form-select:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #5c636a;
        }
        .card {
            border: none;
            box-shadow: 0 0 25px rgba(0,0,0,0.05);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .image-preview {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
            margin: 0 auto;
            display: block;
        }
        .preview-container {
            position: relative;
            display: block;
            width: 100%;
            text-align: center;
            margin: 0 auto;
        }
        .preview-container .remove-image {
            position: absolute;
            top: -10px;
            right: calc(50% - 250px);
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }
        .ck-editor__editable {
            min-height: 200px;
            max-height: 400px;
        }
        .ck-editor__editable:focus {
            border-color: #dc3545 !important;
        }
        .ck.ck-editor__main>.ck-editor__editable {
            background-color: #fff;
        }
        .ck.ck-toolbar {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        .ck.ck-toolbar .ck-toolbar__items {
            flex-wrap: wrap;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h5 class="mb-0">{{ isset($portfolio) ? 'Edit Portfolio' : 'Tambah Portfolio' }}</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ isset($portfolio) ? route('portfolio.update', $portfolio->id) : route('portfolio.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              id="portfolioForm">
                            @csrf
                            @if(isset($portfolio))
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <div class="preview-container mb-3" id="imagePreviewContainer" style="{{ isset($portfolio) && $portfolio->image ? '' : 'display: none;' }}">
                                    <img src="{{ isset($portfolio) ? asset('storage/' . $portfolio->image) : '' }}" 
                                         alt="Preview" 
                                         class="image-preview"
                                         id="imagePreview">
                                    <span class="remove-image" onclick="removeImage()">×</span>
                                </div>
                                <label class="form-label">Gambar Portfolio</label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       name="image" 
                                       id="image"
                                       accept="image/*"
                                       {{ !isset($portfolio) ? 'required' : '' }}>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Judul</label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       name="title" 
                                       id="title"
                                       value="{{ old('title', $portfolio->title ?? '') }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <div id="editor">{{ old('description', $portfolio->description ?? '') }}</div>
                                <textarea name="description" 
                                          id="description" 
                                          style="display: none"
                                          required>{{ old('description', $portfolio->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('home') }}#portofolio" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-save me-2"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview image sebelum upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').style.display = 'inline-block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Hapus preview image
        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.getElementById('imagePreview').src = '';
        }

        // Inisialisasi CKEditor
        let editor;
        
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            })
            .then(newEditor => {
                editor = newEditor;
                
                // Update hidden textarea dengan mempertahankan format HTML
                editor.model.document.on('change:data', () => {
                    const content = editor.getData();
                    document.querySelector('#description').value = content;
                });

                // Set initial content if exists
                const initialContent = document.querySelector('#description').value;
                if (initialContent) {
                    editor.setData(initialContent);
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Update form validation untuk CKEditor
        document.getElementById('portfolioForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = document.querySelector('input[name="title"]');
            let isValid = true;

            // Reset validasi
            title.classList.remove('is-invalid');
            document.querySelector('.ck-editor__main').style.border = '';

            // Validasi judul
            if (!title.value.trim()) {
                title.classList.add('is-invalid');
                isValid = false;
            }

            // Validasi deskripsi
            if (!editor.getData().trim()) {
                document.querySelector('.ck-editor__main').style.border = '1px solid #dc3545';
                isValid = false;
            }

            // Jika semua validasi berhasil, submit form
            if (isValid) {
                e.target.submit();
            }
        });
    </script>
</body>
</html> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inojob Index</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Additional CSS for the fixed preview div */
        #preview {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            height: 100%;
            background-color: #f8f9fa;
            overflow-y: scroll;
            padding: 20px;
            display: none; /* Initially hidden */
        }
    </style>
</head>
<body>
    <form id="search-form" action="{{ route('inojob-index') }}" method="GET">
        <div class="form-group">
            <label for="toggle-filter">Toggle Filter:</label>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="toggle-filter" name="toggle_filter">
                <label class="custom-control-label" for="toggle-filter">Toggle</label>
            </div>
        </div>
        <div class="form-group">
            <label for="select-filter">Select Filter:</label>
            <select class="form-control" id="select-filter" name="select_filter">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        
        // Get the form data
        const formData = new FormData(searchForm);
        
        // Send an AJAX request
        fetch('{{ route('inojob-index') }}', {
            method: 'GET',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response data and update your UI as needed
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

    </script>


    <div class="container mt-4">
        <h1 class="mb-4">لیست اینوجاب‌ها</h1>
        @foreach ($inojobs as $inojob)
        {{-- @dd($inojob->degrees->master) --}}
        <div class="card mb-3" onclick="showPreview({{ json_encode($inojob) }})">
                <div class="card-body">
                    <h5 class="card-title">#{{$inojob->id}} {{ $inojob->title }}</h5>
                    <p class="card-text">{{ $inojob->description }}</p>
                    <p>قیمت: {{$inojob->properties->salary ?? 'توافقی'}}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div id="preview">
        <h5 id="preview-title">عنوان</h5>
        <p id="preview-description">توضیحات</p>
    </div>

    <script>
        // Function to show the Inojob preview in the fixed div
        const preview = document.getElementById("preview");
        const previewTitle = document.getElementById("preview-title");
        const previewDescription = document.getElementById("preview-description");

        function showPreview(inojob) {
            previewTitle.textContent = inojob.title;
            previewDescription.textContent = inojob.description;
            preview.innerHTML = `
                <h5 id="preview-title">${inojob.title}</h5>
                <p id="preview-description">${inojob.description}</p>
                <p><strong>کارفرما:</strong> ${inojob.employer.name}</p>
                <p><strong>محل:</strong> ${inojob.location.spot}, ${inojob.location.province}</p>
                <p><strong>تعداد:</strong> ${inojob.count.count}</p>
                <p><strong>مقطع:</strong> ${inojob.degrees.master ? 'Master' : ''} ${inojob.degrees.doctora ? 'Doctora' : ''} ${inojob.degrees.bachelor ? 'Bachelor' : ''}</p>
            `;
            preview.style.display = "block";
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- <meta charset="UTF-8"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multiple File Upload</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for drag and drop */
    .upload-drop-zone {
      border: 2px dashed #007bff;
      height: 200px;
      text-align: center;
      padding: 40px;
    }
    .upload-drop-zone.drop {
      background-color: #f0f0f0;
    }
    .file-list {
      margin-top: 20px;
    }
    .file-item {
      display: flex;
      align-items: center;
    }
    .file-name {
      flex-grow: 1;
    }
    .remove-file-btn {
      margin-left: 10px;
    }
  </style>
</head>
<body>
<!-- session message -->
<?php
session_start();

if (isset($_SESSION['message'])) {
    echo htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
    unset($_SESSION['message']);
}
session_destroy();
?>
<!-- end session message -->


<div class="container mt-5">
  <h3 class="mb-4">Multiple File Upload</h3>
  
  <!-- Combined drag and drop area with file input -->
  <form id="uploadForm" action="/upload-and-zip" method="post" enctype="multipart/form-data">
    <div id="dropZone" class="upload-drop-zone">
      <p>Drag &amp; drop files here or <label for="files" class="btn btn-primary">Browse</label> to choose files</p>
      <input type="file" class="form-control-file" id="files" name="files[]" multiple accept="image/*,.pdf" style="display: none;">
    </div>
    
    <!-- Uploaded file list (will be populated dynamically) -->
    <div id="fileList" class="file-list"></div>
    
    <button type="submit" class="btn btn-primary mt-3">Upload and Zip</button>
  </form>
<?php if(isset($_SESSION['zip_file'])){  ?>
  <h2>Download Zip File</h2>
  <?php 
    $controller = new App\Controllers\UploadController();
    $controller->displayZipFile();
  }?>
</div>

<!-- Bootstrap JS and custom JavaScript for drag and drop functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Function to update file list
  function updateFileList(files) {
    var fileList = document.getElementById('fileList');
    if (!fileList) return;

    fileList.innerHTML = '';
    if (files.length === 0) {
      fileList.innerHTML = '<p>No files selected</p>';
    } else {
      var list = document.createElement('ul');
      list.classList.add('list-unstyled');
      for (var i = 0; i < files.length; i++) {
        var listItem = document.createElement('li');
        listItem.classList.add('file-item');
        
        var fileName = document.createElement('span');
        fileName.classList.add('file-name');
        fileName.textContent = files[i].name;
        listItem.appendChild(fileName);
        
        var removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-sm', 'btn-danger', 'remove-file-btn');
        removeButton.textContent = 'Remove';
        removeButton.setAttribute('data-index', i);
        removeButton.addEventListener('click', function() {
          var index = parseInt(this.getAttribute('data-index'));
          files.splice(index, 1);
          updateFileList(files);
        });
        listItem.appendChild(removeButton);
        
        list.appendChild(listItem);
      }
      fileList.appendChild(list);
    }
  }

  // Event listeners for drag and drop functionality
  var dropZone = document.getElementById('dropZone');
  dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    dropZone.classList.add('drop');
  });
  dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    dropZone.classList.remove('drop');
  });
  dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    dropZone.classList.remove('drop');

    // Handle dropped files
    var files = e.dataTransfer.files;
    console.log(files);
    updateFileList(files);
  
  });

  // Trigger file input click when "Browse" button is clicked
  document.getElementById('files').addEventListener('change', function(e) {
    var newFiles = Array.from(this.files);
    updateFileList(newFiles);
  });
</script>

</body>
</html>

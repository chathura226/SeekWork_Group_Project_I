// Get the file upload div
const fileUploadDiv = document.getElementById('fileUploadDiv');
const documentsInput = document.getElementById('documents');
const pTag = document.getElementById('pTag');
const dragAndDropLabel = document.getElementsByClassName('file-upload-label')[0];

// Prevent default behaviors for drag events
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    fileUploadDiv.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Highlight drop area when dragging over it
['dragenter', 'dragover'].forEach(eventName => {
    fileUploadDiv.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    fileUploadDiv.addEventListener(eventName, unhighlight, false);
});

function highlight() {
    pTag.textContent = "Release to upload"
    dragAndDropLabel.style = "border: 2px dashed blue;"
    // fileUploadDiv.classList.add('highlight');
}

function unhighlight() {
    pTag.textContent = "Drag and Drop"
    dragAndDropLabel.style = "border: 2px dashed rgb(82, 82, 82);"

    // fileUploadDiv.classList.remove('highlight');
}

// Handle dropped files
fileUploadDiv.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;

    handleFiles(files);
}

function handleFiles(files) {
    // Handle uploaded files here
    // Add dropped files to the documents input
    documentsInput.files = files;

}


//handle file selects
documentsInput.addEventListener('change', handleFileSelect, false);

function handleFileSelect(event) {
    const fileList = document.getElementById('file-list');
    // fileList.innerHTML = '';

    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const listItem = document.createElement('div');
        listItem.className = 'file-item';

        const fileName = document.createElement('span');
        fileName.setAttribute('data-value', file.name);
        fileName.innerHTML = '&#x25BA; ' + file.name;
        listItem.appendChild(fileName);

        const deleteButton = document.createElement('div');
        deleteButton.className = 'file-delete';
        deleteButton.innerHTML = "&nbsp&nbsp<svg style='fill:black !important;vertical-align: middle; ' viewBox=\"0 0 15 17.5\" height=\"25\" width=\"23\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\">\n" +
            "  <path transform=\"translate(-2.5 -1.25)\" d=\"M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z\" id=\"Fill\"></path>\n" +
            "</svg>";

        deleteButton.onclick = function () {
            removeFileByName(listItem.querySelector('span').getAttribute('data-value'));
            listItem.remove();
        };
        listItem.appendChild(deleteButton);

        fileList.appendChild(listItem);
    }
}


function removeFileByName(fileNameToRemove) {
    // console.log(documentsInput.files)

// Assuming input is your file input element
    const files = documentsInput.files;
    const fileToRemoveIndex = 0; // Index of the file you want to remove


    const newFileList = new DataTransfer();

    for (let i = 0; i < files.length; i++) {
        if (files[i].name !== fileNameToRemove) {
            newFileList.items.add(files[i]);
        }
    }
// console.log(newFileList)
    // Replace the files in the input with the modified FileList
    documentsInput.files = newFileList.files;
    // console.log(documentsInput.files)
}
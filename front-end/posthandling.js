
function submitPost(event) {
    // event.preventDefault() // Prevent the default form submission

    // Get the content of the contenteditable div
    var content = document.getElementById('textarea').innerHTML

    // Set the content as the value of the hidden input field
    document.getElementById('hiddenTextarea').value = content

    // Submit the form
    event.target.submit()
  }

const inputElement = document.querySelector('.custom-file-input')
const imgholder = document.querySelector('#ImageHolder')

inputElement.addEventListener('change', (event) => {
  const file = event.target.files[0];
  
  if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
      imgholder.src = event.target.result;
    };
    reader.readAsDataURL(file);
  }
  
})

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


function handledeletepost(id)
{
  const url = `endpoints/post.php?id=${id}`;
    
    var xhr = new XMLHttpRequest()

    xhr.open('DELETE', url, true)
    
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              const element = document.querySelector(`#post-${id}`);
              element.parentElement.removeChild(element)
           } else {
            
              console.error('Request failed. Status:', xhr.status);
          }
        }
      };
}



document.querySelectorAll("#post-info")?.forEach((button) =>{
  button.addEventListener("click",(event)=>{
      const target = event.target.nextElementSibling || event.target.parentElement.nextElementSibling;
      const prev = target.getAttribute('data-shown') === 'true'
      target.setAttribute('data-shown',!prev)
  })
  const options = button.nextElementSibling || button.parentElement.nextElementSibling;
  options.addEventListener('mouseleave',(event)=>event.target.setAttribute('data-shown',false))
}) 

function handlelike(event ,postid,userid)
{
    const element = event.target
    const countHolder = element.parentElement.previousElementSibling.children[0];
    var url;

    if(element.hasAttribute("data-done"))
     {
       url = 'endpoints/Dislike.php'
      element.removeAttribute("data-done");

     }
     else
     {
       url = 'endpoints/Like.php'
      element.setAttribute("data-done","");
     }



    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest()

   // Prepare the request
    var data = {
                    postid,userid
                }
    xhr.open('POST', url, true)
    
    xhr.setRequestHeader('Content-type', 'application/json')
    
    // Send the request
    xhr.send(JSON.stringify(data));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Request was successful, handle the response here
             countHolder.innerHTML = JSON.parse(xhr.responseText).count + ' Likes';
          } else {
            // There was an error, handle it here
            console.error('Request failed. Status:', xhr.status);
          }
        }
      };

}



function handleshowcomments(event ,postid,userid)
{
  const element = event.target
  const commentHolder = element.parentElement.nextElementSibling;
  if(!element.hasAttribute("data-done"))
   {
    const url = `endpoints/Comment.php?id=${postid}`

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest()
    xhr.open('GET', url, true)
    xhr.setRequestHeader('Content-type', 'application/json')

    // Send the request
    xhr.send();
   
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var comments = JSON.parse(xhr.responseText);
          comments.forEach(comment => {
            let newCom = document.createElement('div');
            newCom.className = 'comment';
            newCom.innerHTML = `<span>${comment.user}: ${comment.text}<span>`
            commentHolder.appendChild(newCom);
          });
            let form = document.createElement('form');
            form.method = "post"
            form.addEventListener('submit', (e)=>{handlecomment(e,postid,userid,commentHolder)})
            form.innerHTML =  `<input type='text' name='comment' placeholder='write a comment' required> <input type='submit' value='send'>`
            commentHolder.appendChild(form)
            element.setAttribute("data-done","");
        } else {
          // There was an error, handle it here
          console.error('Request failed. Status:', xhr.status);
        }
      }
    }
  }
}




function handlecomment(event ,postid,userid,commentHolder)
{
   event.preventDefault();
   var form = event.target;
   const countHolder = form.parentElement.previousElementSibling.previousElementSibling.children[1];
   var text = form.firstElementChild.value;
   var data = {
          postid,userid,text 
      }   

  const url = "endpoints/Comment.php"

  var xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);

  xhr.send(JSON.stringify(data));
 
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        try { 
        let response = JSON.parse(xhr.responseText)
         countHolder.innerHTML = response.count + ' Comments';
         let newCom = document.createElement('div');
          newCom.className = 'comment';
          newCom.innerHTML = `<span>${response.user}: ${text}<span>`
          commentHolder.insertBefore(newCom,form);
         form.firstElementChild.value="";}
         catch(error)
         {
          console.log(xhr.responseText)
          console.error(error);
         }
      } else {
        // There was an error, handle it here
        console.error('Request failed. Status:', xhr.status);
      }
    }
  };
}



function handleshare(event ,postid,userid)
{
    const element = event.target
    const countHolder = element.parentElement.previousElementSibling.children[2];

    if(!element.hasAttribute("data-done"))
     {
      const url = 'endpoints/Share.php'
      element.removeAttribute("data-done");

      // Create a new XMLHttpRequest object
      var xhr = new XMLHttpRequest()

      // Prepare the request
      var data = {
                      postid,userid
                  }
      xhr.open('POST', url, true)
      
      xhr.setRequestHeader('Content-type', 'application/json')
      
      // Send the request
      xhr.send(JSON.stringify(data));

      xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              // Request was successful, handle the response here
                countHolder.innerHTML = JSON.parse(xhr.responseText).count + ' Shares';
                element.setAttribute("data-done","");
            } else {
              // There was an error, handle it here
              console.error('Request failed. Status:', xhr.status);
            }
          }
        };
    }
}
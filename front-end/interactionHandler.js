
function handlelike(event ,postid,userid)
{
    const element = event.currentTarget
    const countHolder = element.children[1]
    const set = element.hasAttribute("data-done");
    const url = set ? 'endpoints/Dislike.php': 'endpoints/Like.php';


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
            if(set)
            {
              element.firstElementChild.className = "far fa-heart"
              element.removeAttribute("data-done")
            }
            else
            {
              element.firstElementChild.className = "fas fa-heart"
              element.setAttribute("data-done","")
            }
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
  const element = event.currentTarget
  const commentHolder = element.parentElement.nextElementSibling.appendChild(document.createElement('div'));
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
            newCom.className = "comment-holder"
            const profile = comment.image? comment.image :"images/Account.webp"
            newCom.innerHTML = `<img src=${profile}><div class ="comment"><span class ="sender">${comment.user}</span> </br> <span>${comment.text}</span></div>`
            commentHolder.appendChild(newCom);
          });
            let form = document.createElement('form');
            form.method = "post"
            form.addEventListener('submit', (e)=>{handlecomment(e,postid,userid,commentHolder)})
            form.innerHTML =  `<input autocomplete='off' type='text' name='comment' placeholder='write a comment' required> <input type='submit' value='send'>`
            commentHolder.parentElement.appendChild(form)
            element.setAttribute("data-done","");
            element.firstElementChild.className = "fas fa-comment"
            const feed = document.querySelector("#feed");
            feed.scrollTop += commentHolder.parentElement.scrollHeight;
        } else {
          // There was an error, handle it here
          console.error('Request failed. Status:', xhr.status);
        }
      }
    }
  }
  else
  {
    commentHolder.parentElement.innerHTML=""
    element.removeAttribute("data-done")
  }
}




function handlecomment(event ,postid,userid,commentHolder)
{
   event.preventDefault();
   var form = event.currentTarget;
   const countHolder = form.parentElement.previousElementSibling.children[1].children[1];
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
         const profile = response.image? response.image :"images/Account.webp"
          newCom.className = "comment-holder"
          newCom.innerHTML = `<img src=${profile}><div class ="comment"><span class ="sender">${response.user}</span> </br> <span>${text}</span></div>`      
          commentHolder.appendChild(newCom);
          commentHolder.scrollTop = commentHolder.scrollHeight;
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
    const element = event.currentTarget
    const countHolder = element.children[1]

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